<?php

namespace VHX;

class Browse extends Resource {
 public static function all($params = array()) {
   return self::_list($params);
 }
}


 // \VHX\Browse::all()
 //
 // 1. Calling this https://api.vhx.net/browse
 // 2. returns JSON response
 //
 // Retrieves a paginated list of browse items (rows). Each row contains metadata and links to further fetch the items to be displayed. This is meant to be done in an asynchronous manner. A subscription product parameter is required to scope the retrieval.
 //
