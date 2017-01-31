<?php

namespace VHX;

use VHX\API;

class ApiResource {

  private static function _getResourceName(){
    $class = get_called_class();
    if ($postfix_namespaces = strrchr($class, '\\')) {
      $class = strtolower(substr($postfix_namespaces, 1));
    }
    $name = urlencode($class);
    $name = strtolower($name);
    $name = self::_matchClassToResource($class);
    return $name;
  }

  private static function _hasID($id, $request) {
    if (isset($id)):
      return;
    else:
      $message = 'You must provide a ID or HREF when making an ' . $request . ' request.';
      throw new Error\InvalidRequest($message, 400);
    endif;
  }

  private static function _getType() {
    $resource = self::_getResourceName();

    if ($resource === 'videos'):
      return 'video';
    elseif ($resource === 'collections'):
      return 'collection';
    else:
      return 'id';
    endif;
  }

  private static function _parseHref($href) {
    if (intval($href, 10)):
      return $href;
    elseif (strrpos($href, API::$host)):
      if (substr($href, -1) === '/'):
        $href = substr($href, 0, -1);
      endif;
      $val = explode('/', $href);
      return $val[count($val)-1];
    endif;
  }

  private static function _getParameters($a, $b = null) {
    $params = array();
    $type = self::_getType();

    if (!isset($b)):
      $params['id'] = self::_parseHref($a);
    endif;

    if (is_array($a)):
      $params['id'] =  self::_parseHref($a[$type]);
      unset($a[$type]);
      $params['query'] = $b;
    else:
      $params['id'] = self::_parseHref($a);
      $params['query'] = $b;
    endif;

    return $params;
  }

  private static function _request($method, $path, $data = array()) {
    $curl = curl_init();
    $url = API::$protocol . API::$host . '/' . $path;

    if ($method === 'PUT'):
      $data['_method'] = 'PUT';
    endif;

    if ($method === 'POST' || $method === 'PUT'):
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data):
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
      endif;
    endif;

    if ($method === 'DELETE'):
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
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

  protected static function _retrieve($id, $scope = null) {
    $scope = isset($scope) ? '/' . $scope : '';
    $params = self::_getParameters($id);
    self::_hasID($id, 'retrieve');
    return self::_request('GET', self::_getResourceName() . '/' . $params['id'] . $scope);
  }

  protected static function _list($params) {
    return self::_request('GET', self::_getResourceName() . '/', $params);
  }

  protected static function _items($id, $query, $scope = null) {
    $scope = isset($scope) ? '/' . $scope : '/items';
    $params = self::_getParameters($id, $query);
    self::_hasID($params['id'], $scope);
    return self::_request('GET', self::_getResourceName() . '/' . $params['id'] . $scope, $params['query']);
  }

  protected static function _create($params) {
    return self::_request('POST', self::_getResourceName() . '/', $params);
  }

  protected static function _update($id, $query, $scope = null) {
    $scope = isset($scope) ? '/' . $scope : '';
    $params = self::_getParameters($id, $query);
    self::_hasID($params['id'], 'update');
    return self::_request('PUT', self::_getResourceName() . '/' . $params['id'] . $scope, $params['query']);
  }

  protected static function _delete($id, $query, $scope = null) {
    $scope = isset($scope) ? '/' . $scope : '';
    $params = self::_getParameters($id, $query);
    self::_hasID($params['id'], 'update');
    return self::_request('DELETE', self::_getResourceName() . '/' . $params['id'] . $scope, $params['query']);
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
        throw new Error\Connection($result, $code);
        break;
      case 500:
      default:
        throw new Error\Api($result, $code);
        break;
    }
  }

  protected static function _matchClassToResource($class) {
    switch ($class) {
      case 'watchlist':
        return 'customers';
        break;
      case 'watching':
        return 'customers';
      default:
        return $class;
        break;
    }
  }

  protected static function _handleCurlError($url, $errno, $message) {
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
      throw new Error\Connection($msg, 408);
  }
}
