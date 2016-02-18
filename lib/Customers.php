<?php

namespace VHX;

class Customers extends Resource {
  public static function all($params = array()) {
    return self::_list($params);
  }
  public static function update($id = null, $params = array()) {
    return self::_update($id, $params);
  }
  public static function retrieve($id = null) {
    return self::_retrieve($id);
  }
  public static function create($params = array()) {
    return self::_create($params);
  }
  public static function delete($id = null, $params = array()) {
    return self::_delete($id, $params);
  }
  public static function addProduct($id = null, $params = array()) {
    return self::_update($id, $params, 'products');
  }
  public static function removeProduct($id = null, $params = array()) {
    return self::_delete($id, $params, 'products');
  }
}
