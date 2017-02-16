<?php

namespace VHX;

class Analytics extends ApiResource {
  public static function report($params = array(), $headers = null) {
    return self::_list($params, $headers);
  }
}
