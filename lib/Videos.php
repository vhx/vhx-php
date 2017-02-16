<?php

namespace VHX;

class Videos extends ApiResource {
  public static function all($params = array(), $headers = null) {
    return self::_list($params, $headers);
  }
  public static function files($id = null, $params = array(), $headers = null) {
    return self::_items($id, $params, 'files', $headers);
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

  // deprecated (same as files)
  public static function allFiles($id = null, $params = array(), $headers = null) {
    return self::_items($id, $params, 'files', $headers);
  }
}
