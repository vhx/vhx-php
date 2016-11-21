<?php

namespace VHX;

class Api
{
  public static $key;
  const HOST = 'api.vhx.tv';
  const PROTOCOL = 'https://';
  const VERSION = '1.6.2';

  public static function setKey($api_key) {
    self::$key = $api_key;
  }
}
