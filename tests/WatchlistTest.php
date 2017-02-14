<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class WatchlistTest extends TestCase {
  public function testList() {
    $params = new Params();
    $watchlist = \VHX\Watchlist::items($params->customer());
    $this->assertArrayHasKey('_links', $watchlist);
    $this->assertArrayHasKey('_embedded', $watchlist);
    $this->assertArrayHasKey('count', $watchlist);
    $this->assertArrayHasKey('items', $watchlist['_embedded']);
  }

  public function testAddToQueue() {
    $params = new Params();
    \VHX\Watchlist::addItem($params->customer(), array(
      'video' => $params->video()
    ));
    $watchlist = \VHX\Watchlist::items($params->customer());

    $this->assertEquals($watchlist['_embedded']['items'][0]['id'], $params->video());
  }

  public function testRemoveFromQueue() {
    $params = new Params();
    \VHX\Watchlist::addItem($params->customer(), array(
      'video' => $params->video()
    ));
    \VHX\Watchlist::removeItem($params->customer(), array(
      'video' => $params->video()
    ));

    $watchlist = \VHX\Watchlist::items($params->customer());
    $this->assertEquals(0, count($watchlist['_embedded']['items']));
  }
}