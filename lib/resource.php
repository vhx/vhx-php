<?php

namespace VHX;

use VHX\API;

class Resource {

  private static function _getResourceName(){
    $class = get_called_class();
    if ($postfix_namespaces = strrchr($class, '\\')) {
      $class = strtolower(substr($postfix_namespaces, 1));
    }
    $name = urlencode($class);
    $name = strtolower($name);
    return $name;
  }

  private static function _hasID($id, $request) {
    if (isset($id)):
      return;
    else:
      $message = 'You must provide a UUID when making an ' . $request . ' request.';
      throw new Error\InvalidRequest($message);
    endif;
  }

  private static function _request($method, $path, $data = array()) {
    $curl = curl_init();
    $url = API::PROTOCOL . API::HOST . '/' . $path;

    if ($method === 'PUT'):
      $data['_method'] = 'PUT';
    endif;

    if ($method === 'POST' || $method === 'PUT'):
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data):
        var_dump($data);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      endif;
    endif;

    if ($method === 'GET'):
      $url = sprintf("%s?%s", $url, http_build_query($data));
    endif;

    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, API::$key . ':');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    if (curl_errno($curl)) {
      die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
      curl_close($curl);
    }
    else {
      return $result;
      curl_close($curl);
    }
  }

  protected static function _retrieve($id) {
    self::_hasID($id, 'retrieve');
    return json_decode(self::_request('GET', self::_getResourceName() . '/' . $id), true);
  }

  protected static function _list($params) {
    return json_decode(self::_request('GET', self::_getResourceName() . '/', $params), true);
  }

  protected static function _items($id) {
    self::_hasID($id, 'items');
    return json_decode(self::_request('GET', self::_getResourceName() . '/' . $id . '/items'), true);
  }

  protected static function _create($params = null) {
    return json_decode(self::_request('POST', self::_getResourceName() . '/', $params), true);
  }

  protected static function _update($id, $params = null) {
    self::_hasID($id, 'update');
    return json_decode(self::_request('PUT', self::_getResourceName() . '/' . $id, $params), true);
  }

  protected static function _delete($id) {
    self::_hasID($id, 'delete');
    return json_decode( self::_request('DELETE', self::_getResourceName() . '/' . $id), true);
  }
}
