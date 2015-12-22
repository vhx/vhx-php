<?php

namespace VHX;

class Api
{
  public static $key;
  const HOST = 'api.crystal.dev';
  const PROTOCOL = 'http://';
  const VERSION = '1.1.0';

  public static function setKey($api_key) {
    self::$key = $api_key;
  }
}
