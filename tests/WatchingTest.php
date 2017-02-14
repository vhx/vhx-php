<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class WatchingTest extends TestCase {

  public function testItems() {
    $params = new Params();
    $watching = \VHX\Watching::items($params->customer());
    $this->assertArrayHasKey('_links', $watching);
    $this->assertArrayHasKey('_embedded', $watching);
    $this->assertArrayHasKey('count', $watching);
    $this->assertArrayHasKey('items', $watching['_embedded']);
  }
  
}