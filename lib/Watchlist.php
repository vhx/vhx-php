<?php

namespace VHX;

class Watchlist extends ApiResource {
  public static function items($id = null, $params = array(), $headers = null) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_items($id, $params, 'watchlist', $headers);
  }
  public static function addItem($id, $params = array(), $headers = null) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_update($id, $params, 'watchlist', $headers);
  }
  public static function removeItem($id, $params = array(), $headers = null) {
    if (is_array($id) && isset($id['customer'])) {
      $params = $id;
      $id = $id['customer'];
    }
    return self::_delete($id, $params, 'watchlist', $headers);
  }
}
