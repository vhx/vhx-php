<?php

namespace VHX;

class Watchlist extends Resource {
  public static function items($id = null, $params = array()) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_items($id, $params);
  }
  public static function addItem($id, $params = array()) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_update($id, $params, 'watchlist');
  }
  public static function removeItem($id, $params = array()) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_delete($id, $params, 'watchlist');
  }
}
