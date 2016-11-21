<?php

namespace VHX;

class Watching extends Resource {
  public static function items($id = null, $params = array()) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_items($id, $params, 'watching');
  }
}
