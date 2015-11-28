<?php

namespace VHX\Error;

class ResourceNotFound extends Base {
  public function __construct($message = null, $http_status = null, $http_body = null, $json_body = null, $http_headers = null) {
    parent::__construct($message, $http_status, $http_body, $json_body, $http_headers);
  }
}
