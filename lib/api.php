<?php

namespace VHX;

class API
{
  public static $key;
  const HOST = 'api.vhx.tv';
  const PROTOCOL = 'https://';
  const API_VERSION = null;

  public static function setKey($api_key) {
    self::$key = $api_key;
  }
}
