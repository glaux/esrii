<?php

namespace Triangle\Core;

class ServeFile
{
    public static function create()
    {
        return new static();
    }

    public public function pdf($filename)
    {
        if (file_exists('pdf/' . $filename)) {
            header('Content-type:application/pdf');

          // The download filename can be specified
            header('Content-Disposition:attachment;filename="' . $filename . '"');

          // The PDF source
            readfile('/pdf/' . $filename);
        }
    }
}
