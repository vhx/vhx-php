<?php

namespace VHX;

class Collections extends Resource {
  public static function all($params = array()) {
    return self::_list($params);
  }
  public static function retrieve($id = null) {
    return self::_retrieve($id);
  }
  public static function create($params = array()) {
    return self::_create($params);
  }
  public static function update($id = null, $params = array()) {
    return self::_update($id, $params);
  }
  public static function items($id = null, $params = array()) {
    return self::_items($id, $params);
  }

  // deprecated (same as items)
  public static function allItems($id = null, $params = array()) {
    return self::_items($id, $params);
  }
}
