<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {
  public function testAll() {    
    $products = \VHX\Products::all();
    $this->assertArrayHasKey('_links', $products);
    $this->assertArrayHasKey('_embedded', $products);
    $this->assertArrayHasKey('count', $products);
    $this->assertArrayHasKey('products', $products['_embedded']);
  }

  public function testRetrieve() {
    $params = new Params();
    $product = \VHX\Products::retrieve($params->product());
    $this->assertArrayHasKey('_links', $product);
    $this->assertArrayHasKey('price', $product);
    $this->assertArrayHasKey('is_active', $product);
  }
}