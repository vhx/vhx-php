<?php

namespace VHX;

class Browse extends Resource {
 public static function all($params = array()) {
   return self::_list($params);
 }
}
