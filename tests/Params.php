<?php

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();
define('HREF', intval($_ENV['TEST_HREF']) === 1 ? 'http://api.crystal.dev/' : false);

class Params {
  function __construct() {
    $this->description = 'New Description ' . rand(1, 100);
    $this->site_id = $_ENV['TEST_SITE_ID'];
  }

  function random($min, $max) {
    return floor(rand() * ($max - $min + 1)) + $min;
  }

  function name() {
    return 'Customer ' . $this->random(1, 100) . ' Name';
  }

  function email() {
    return 'customer' . $this->random(1, 500) . '@email.com';
  }

  function product() {
    $id = $_ENV['TEST_PRODUCT_ID'];
    return (HREF) ? HREF . 'products/' . $id : $id;
  }

  function customer() {
    $id = $_ENV['TEST_CUSTOMER_ID'];
    return (HREF) ? HREF . 'customers/' . $id : $id;
  }

  function video() {
    $id = $_ENV['TEST_VIDEO_ID'];
    return (HREF) ? HREF . 'videos/' . $id : $id;
  }

  function collection() {
    $id = $_ENV['TEST_COLLECTION_ID'];
    return (HREF) ? HREF . 'collections/' . $id : $id;
  }
}


