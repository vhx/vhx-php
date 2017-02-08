<?php

namespace VHX;

class Authorizations extends ApiResource {
  public static function create($params = array(), $headers = null) {
    return self::_create($params, $headers);
  }
}
