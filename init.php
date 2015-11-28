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
require(dirname(__FILE__) . '/lib/errors/api.php');
require(dirname(__FILE__) . '/lib/errors/connection.php');
require(dirname(__FILE__) . '/lib/errors/authentication.php');
require(dirname(__FILE__) . '/lib/errors/invalidRequest.php');
require(dirname(__FILE__) . '/lib/errors/resourceNotFound.php');
