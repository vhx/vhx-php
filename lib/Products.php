<?php

namespace VHX;

class Products extends Resource {
  public static function all($params = array()) {
    return self::_list($params);
  }
  public static function retrieve($id = null) {
    return self::_retrieve($id);
  }
}
