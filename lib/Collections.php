<?php

namespace VHX;

class Collections extends ApiResource {
  public static function all($params = array(), $headers = null) {
    return self::_list($params, $headers);
  }
  public static function retrieve($id = null, $headers = null) {
    return self::_retrieve($id, null, $headers);
  }
  public static function create($params = array(), $headers = null) {
    return self::_create($params, $headers);
  }
  public static function update($id = null, $params = array(), $headers = null) {
    return self::_update($id, $params, null, $headers);
  }
  public static function items($id = null, $params = array(), $headers = null) {
    if (is_array($id) && isset($id['collection'])) {
      $params = $id;
      $id = $id['collection'];
    }
    return self::_items($id, $params, $headers);
  }

  // deprecated (same as items)
  public static function allItems($id = null, $params = array(), $headers = null) {
    return self::_items($id, $params, $headers);
  }
}
