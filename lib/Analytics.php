<?php

namespace VHX;

class Analytics extends Resource {
  public static function report($params = array()) {
    return self::_list($params);
  }
}
