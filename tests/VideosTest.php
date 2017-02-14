<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class VideosTest extends TestCase {
  public function testAll() {
    $videos = \VHX\Videos::all();
    $this->assertArrayHasKey('_links', $videos);
    $this->assertArrayHasKey('_embedded', $videos);
    $this->assertArrayHasKey('count', $videos);
    $this->assertArrayHasKey('videos', $videos['_embedded']);
  }

  public function testRetrieve() {
    $params = new Params();
    $video = \VHX\Videos::retrieve($params->video());
    $this->assertArrayHasKey('_links', $video);
    $this->assertArrayHasKey('_embedded', $video);
    $this->assertArrayHasKey('files', $video['_embedded']);
  }

  public function testCreate() {
    $params = new Params();
    $video = \VHX\Videos::create(array(
      'title' => 'My Video'
    ));
    $this->assertArrayHasKey('_links', $video);
    $this->assertArrayHasKey('_embedded', $video);
    $this->assertEquals('My Video', $video['title']);
    $this->assertArrayHasKey('files', $video['_embedded']);
  }

  public function testUpdate() {
    $params = new Params();
    $video = \VHX\Videos::update($params->video(), array(
      'description' => $params->description
    ));
    $this->assertArrayHasKey('_links', $video);
    $this->assertArrayHasKey('_embedded', $video);
    $this->assertEquals($params->description, $video['description']);
    $this->assertArrayHasKey('files', $video['_embedded']);
  }

  public function testRetrieveVideoFiles() {
    $params = new Params();
    $files = \VHX\Videos::files($params->video());

    $this->assertInternalType('array', $files);
    $this->assertArrayHasKey('format', $files[0]);
    $this->assertArrayHasKey('quality', $files[0]);
    $this->assertArrayHasKey('size', $files[0]);
  }
}