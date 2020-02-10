<?php

namespace Triangle\Core;

class Time {

  static function create() {
    return new static;
  }

  static function get($filename) {
    return date ("Y-m-d H:i", filemtime($filename));
  }

}
