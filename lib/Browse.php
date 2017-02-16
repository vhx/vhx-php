<?php

namespace VHX;

class Browse extends ApiResource {
 public static function all($params = array(), $headers = null) {
   return self::_list($params, $headers);
 }
}
