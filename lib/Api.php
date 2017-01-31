<?php

namespace VHX;

class Api
{
  public static $key;
  public static $host;
  public static $protocol;

  const VERSION = '1.9.0';

  public static function setKey($api_key, $dev = false) {
    self::$key = $api_key;

    if ($dev):
      self::$host = 'api.crystal.dev';
      self::$protocol = 'http://';
    else:
      self::$host = 'api.vhx.tv';
      self::$protocol = 'https://';
    endif;
  }
}
