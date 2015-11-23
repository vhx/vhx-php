<?php

// Core
require(dirname(__FILE__) . '/lib/api.php');
require(dirname(__FILE__) . '/lib/resource.php');

// Resources
require(dirname(__FILE__) . '/lib/resources/authorizations.php');
require(dirname(__FILE__) . '/lib/resources/collections.php');
require(dirname(__FILE__) . '/lib/resources/customers.php');
require(dirname(__FILE__) . '/lib/resources/videos.php');

// Errors
require(dirname(__FILE__) . '/lib/errors/base.php');
// require(dirname(__FILE__) . '/lib/Error/Api.php');
// require(dirname(__FILE__) . '/lib/Error/ApiConnection.php');
// require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/errors/invalidRequest.php');
// require(dirname(__FILE__) . '/lib/Error/RateLimit.php');
