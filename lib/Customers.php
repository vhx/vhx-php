<?php

namespace VHX;

class Customers extends ApiResource {
  public static function all($params = array(), $headers = null) {
    return self::_list($params, $headers);
  }
  public static function update($id = null, $params = array(), $headers = null) {
    return self::_update($id, $params, null, $headers);
  }
  public static function retrieve($id = null, $headers = null) {
    return self::_retrieve($id, null, $headers);
  }
  public static function create($params = array(), $headers = null) {
    return self::_create($params, $headers);
  }
  public static function delete($id = null, $params = array(), $headers = null) {
    return self::_delete($id, $params, $headers);
  }
  public static function addProduct($id = null, $params = array(), $headers = null) {
    return self::_update($id, $params, 'products', $headers);
  }
  public static function removeProduct($id = null, $params = array(), $headers = null) {
    return self::_delete($id, $params, 'products', $headers);
  }
}
