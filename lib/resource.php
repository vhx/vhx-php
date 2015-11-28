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
      throw new Error\InvalidRequest($message, 400);
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
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      endif;
    endif;

    if ($method === 'GET'):
      $url = sprintf("%s?%s", $url, http_build_query($data));
    endif;

    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, API::$key . ':');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_TIMEOUT, 80);

    $result = curl_exec($curl);

    if ($result === false):
      $errno = curl_errno($curl);
      $message = curl_error($curl);
      curl_close($curl);
      return self::_handleCurlError($url, $errno, $message);
    else:
      $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
      $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      $body = substr($result, $header_size);
      curl_close($curl);
      return self::_handleResponse($body, $code);
    endif;
  }

  protected static function _retrieve($id) {
    self::_hasID($id, 'retrieve');
    return self::_request('GET', self::_getResourceName() . '/' . $id);
  }

  protected static function _list($params) {
    return self::_request('GET', self::_getResourceName() . '/', $params);
  }

  protected static function _items($id) {
    self::_hasID($id, 'items');
    return self::_request('GET', self::_getResourceName() . '/' . $id . '/items');
  }

  protected static function _create($params = null) {
    return self::_request('POST', self::_getResourceName() . '/', $params);
  }

  protected static function _update($id, $params = null) {
    self::_hasID($id, 'update');
    return self::_request('PUT', self::_getResourceName() . '/' . $id, $params);
  }

  protected static function _delete($id) {
    self::_hasID($id, 'delete');
    return self::_request('DELETE', self::_getResourceName() . '/' . $id);
  }

  protected static function _handleResponse($body, $code) {

    if ($code >= 200 && $code < 300):
      return json_decode($body, true);
    else:
      self::_handleResponseError($body, $code);
    endif;
  }

  protected static function _handleResponseError($result, $code) {
    switch ($code) {
      case 400:
        throw new Error\InvalidRequest($result, $code);
        break;
      case 401:
        throw new Error\Authentication($result, $code);
        break;
      case 404:
        throw new Error\ResourceNotFound($result, $code);
        break;
      case 408:
        throw new Error\ApiConnection($result, $code);
        break;
      case 500:
      default:
        throw new Error\API($result, $code);
        break;
    }
  }

  protected static function handleCurlError($url, $errno, $message) {
    switch ($errno) {
      case CURLE_COULDNT_CONNECT:
      case CURLE_COULDNT_RESOLVE_HOST:
      case CURLE_OPERATION_TIMEOUTED:
        $msg = "Could not connect to VHX ($url).  Please check your internet connection and try again.  If this problem persists, you should check VHX's service status at https://twitter.com/vhxstatus, http://status.vhx.tv/, or";
        break;
      default:
        $msg = "Unexpected error communicating with VHX. If this problem persists,";
      }
      $msg .= " let us know at support@vhx.tv. \n\n(Network error [errno $errno]: $message)";
      throw new Error\ApiConnection(msg, 408);
  }
}
