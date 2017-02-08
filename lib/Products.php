<?php

namespace VHX;

class Products extends ApiResource {
  public static function all($params = array(), $headers = null) {
    return self::_list($params, $headers);
  }
  public static function retrieve($id = null, $headers = null) {
    return self::_retrieve($id, $headers);
  }
}
