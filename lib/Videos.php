<?php

namespace VHX;

class Videos extends Resource {
  public static function all($params = array()) {
    return self::_list($params);
  }
  public static function files($id = null, $params = array()) {
    return self::_files($id, $params);
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

  // deprecated (same as files)
  public static function allFiles($id = null, $params = array()) {
    return self::_files($id, $params);
  }
}
