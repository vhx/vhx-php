<?php

namespace VHX\Error;

use Exception;

abstract class Base extends Exception {
  public function __construct($message, $http_status = null, $http_body = null, $json_body = null, $http_headers = null) {
    $this->message      = $message;
    $this->httpStatus   = $http_status;
    $this->httpBody     = $http_body;
    $this->jsonBody     = $json_body;
    $this->httpHeaders  = $http_headers;
  }
}
