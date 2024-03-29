<?php

namespace Triangle\Core;

class File
{
    public static function create()
    {
        return new static();
    }

    public function loadFromDir($dir)
    {
        $files = scandir($dir);
        unset($files[array_search('.', $files, true)]);
        unset($files[array_search('..', $files, true)]);

        $r = [];

        foreach ($files as $filename) {
            $filename = $dir . '/' . $filename;
            if (file_exists($filename)) {
                $stream = file_get_contents($filename);
                if ($stream) {
                    $r[] = $stream;
                }
            }
        }

        return join(PHP_EOL, $r);
    }
}
