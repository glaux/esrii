<?php

namespace Triangle\Template;

use Triangle\Core\MenuItem;
use Triangle\Core\Head;

class Page
{
    protected $content = '';
    protected $menu_item;

    public static function create()
    {
        return new self();
    }

    public function setMenuItem(MenuItem $menu_item)
    {
        $this->menu_item = $menu_item;
        $this->loadContent();
        return $this;
    }

    public function loadContent()
    {
        $filename = $this->menu_item->getPath();
        if (file_exists($filename)) {
            $stream = file_get_contents($filename);
            if ($stream) {
                if ($this->menu_item->getExtension() === 'html') {
                    $this->content = file_get_contents($filename);
                }
                if ($this->menu_item->getExtension() === 'php') {
                    ob_start();
                    require $filename;
                    $this->content = ob_get_clean();
                }
            }
        }
    }

    public function build()
    {

        $head = Head::create()
        ->setPageName(join(' - ', [
        getenv('SITE_TITLE'),
        $this->menu_item->getPrettyName(),
        ]))
        ->build()
        ;
        $header = Header::create()->build();
        $footer = Footer::create()->build();
      // d($footer);

        $html = <<<HTML

      <!DOCTYPE html>
      <html>

        <head>

          <!-- Global site tag (gtag.js) - Google Analytics -->
          <script async src="https://www.googletagmanager.com/gtag/js?id=UA-132901038-2"></script>
          <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-132901038-2');
          </script>

          $head
        </head>

        <body>
          <header>
            $header
          </header>
          <main>
            $this->content
          </main>
          <footer>
            $footer
          </footer>
        </body>

      </html>

    HTML;

        return $html;
    }
}
