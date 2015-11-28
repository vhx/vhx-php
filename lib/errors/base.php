<?php

namespace VHX\Error;

use Exception;

abstract class Base extends Exception {
  public function __construct($message, $http_status = null) {
    $this->message  = $message;
    $this->httpStatus  = $http_status;
  }
  public function getHttpStatus() {
    return $this->httpStatus;
  }
  public function getErrorResponse() {
    return json_decode($this->message, true);
  }
  public function getErrorJSONResponse() {
    return $this->message;
  }
}
