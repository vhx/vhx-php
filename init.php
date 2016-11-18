<?php

// Core
require(dirname(__FILE__) . '/lib/Api.php');
require(dirname(__FILE__) . '/lib/Resource.php');

// Resources
require(dirname(__FILE__) . '/lib/Authorizations.php');
require(dirname(__FILE__) . '/lib/Analytics.php');
require(dirname(__FILE__) . '/lib/Collections.php');
require(dirname(__FILE__) . '/lib/Customers.php');
require(dirname(__FILE__) . '/lib/Products.php');
require(dirname(__FILE__) . '/lib/Videos.php');
require(dirname(__FILE__) . '/lib/Watchlist.php');

// Errors
require(dirname(__FILE__) . '/lib/Error/Base.php');
require(dirname(__FILE__) . '/lib/Error/Api.php');
require(dirname(__FILE__) . '/lib/Error/Connection.php');
require(dirname(__FILE__) . '/lib/Error/Authentication.php');
require(dirname(__FILE__) . '/lib/Error/InvalidRequest.php');
require(dirname(__FILE__) . '/lib/Error/ResourceNotFound.php');
