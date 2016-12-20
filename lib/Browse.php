<?php

namespace VHX;

class Browse extends ApiResource {
 public static function all($params = array()) {
   return self::_list($params);
 }
}
