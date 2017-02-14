<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class AuthorizationsTest extends TestCase {
  public function testCreate() {
    $params = new Params();
    $authorization = \VHX\Authorizations::create(array(
      'customer' => $params->customer(),
      'video' => $params->video()
    ));
    $this->assertArrayHasKey('_links', $authorization);
    $this->assertArrayHasKey('_embedded', $authorization);
    $this->assertArrayHasKey('token', $authorization);
    $this->assertArrayHasKey('player', $authorization);
  }
}