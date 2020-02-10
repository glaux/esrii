<?php

namespace Triangle\Core;

/**
 * CSS and JS are loaded from their respective directories defined in the
 * environment variables. These are loaded in alfabetically, so if order
 * matters, rename the files, for example by prefixing numbers.
 *
 * This direct method of embedding has no cache so performance might suffer a
 * bit. However this method requires no watch scripting and is very simple.
 */
class Head {

  protected $page_name = '';

  public static function create() {
    return new self;
  }

  function setPageName($name) {
    $this->page_name = $name;
    return $this;
  }

  function loadFromDir($dir) {
    $files = scandir($dir);
    unset($files[array_search('.', $files, true)]);
    unset($files[array_search('..', $files, true)]);

    $r = [];

    foreach ( $files as $filename ) {
      $filename = $dir . '/' . $filename;
      if ( file_exists($filename) ) {
        $stream = file_get_contents($filename);
        if ( $stream ) {
          $r[] = $stream;
        }
      }
    }

    return join(PHP_EOL, $r);
  }

  function build() {
    $r = [];

    $r[] = HTML::create()
      ->tag('title')
      ->wrap($this->page_name)
    ;

    $js = join(PHP_EOL, [
      $this->loadFromDir(getenv('JS_VENDOR_DIR')),
      $this->loadFromDir(getenv('JS_DIR'))
    ]);

    $r[] = HTML::create()
      ->tag('script')
      ->props([
        'type' => 'text/javascript',
      ])
      ->wrap($js)
    ;

    $css = join(PHP_EOL, [
      $this->loadFromDir(getenv('CSS_VENDOR_DIR')),
      $this->loadFromDir(getenv('CSS_DIR'))
    ]);

    $r[] = HTML::create()
      ->tag('style')
      ->props([
        'type' => 'text/css',
      ])
      ->wrap($css)
    ;

    $r[] = HTML::create()
      ->tag('link')
      ->props([
        'type' => 'text/css',
        'rel'  => 'stylesheet',
        'href' => 'https://fonts.googleapis.com/css?family=Roboto:100,300,400',
      ])
      ->single()
    ;

    $r[] = HTML::create()
      ->tag('meta')
      ->props([
        'name'    => 'viewport',
        'content' => 'width=device-width, initial-scale=1',
      ])
      ->single()
    ;

    $r[] = HTML::create()
      ->tag('meta')
      ->props([
        'charset' => 'utf-8',
      ])
      ->single()
    ;

    return join(PHP_EOL, $r);
  }
}
