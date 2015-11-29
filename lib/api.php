<?php

namespace VHX;

class Api
{
  public static $key;
  const HOST = 'api.vhx.tv';
  const PROTOCOL = 'https://';
  const VERSION = '0.1.0-beta.3';

  public static function setKey($api_key) {
    self::$key = $api_key;
  }
}
