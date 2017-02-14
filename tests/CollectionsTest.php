<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class CollectionsTest extends TestCase {
  public function testAll() {
    $collections = \VHX\Collections::all();
    $this->assertArrayHasKey('_links', $collections);
    $this->assertArrayHasKey('_embedded', $collections);
    $this->assertArrayHasKey('count', $collections);
    $this->assertArrayHasKey('collections', $collections['_embedded']);
  }

  public function testRetrieve() {
    $params = new Params();
    $collection = \VHX\Collections::retrieve($params->collection());
    $this->assertArrayHasKey('_links', $collection);
    $this->assertArrayHasKey('_embedded', $collection);
    $this->assertEquals(intval($params->collection()), $collection['id']);
  }

  public function testCreate() {
    $params = new Params();
    $collection = \VHX\Collections::create(array(
      'name' => 'My Collection', 'type' => 'series'
    ));
    $this->assertArrayHasKey('_links', $collection);
    $this->assertArrayHasKey('_embedded', $collection);
    $this->assertEquals('My Collection', $collection['name']);
  }

  public function testUpdate() {
    $params = new Params();
    $collection = \VHX\Collections::update($params->collection(), array(
      'description' => $params->description
    ));
    $this->assertArrayHasKey('_links', $collection);
    $this->assertArrayHasKey('_embedded', $collection);
    $this->assertEquals($params->description, $collection['description']);
  }
}