<?php

namespace VHX;

class API
{
  public static $key;
  const HOST = 'api.crystal.dev';
  const PROTOCOL = 'http://';
  const PORT = '7000';
  const BASE_PATH = '/v1/';
  const API_VERSION = null;

  public static function setKey($api_key) {
    self::$key = $api_key;
  }
}
