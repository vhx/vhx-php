<?php

namespace VHX;

class Analytics extends ApiResource {
  public static function report($params = array()) {
    return self::_list($params);
  }
}
