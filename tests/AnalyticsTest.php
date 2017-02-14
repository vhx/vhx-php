<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();
\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class AnalyticsTest extends TestCase {
  public function testIncomeReport() {
    $report = \VHX\Analytics::report(array(
        'type' => 'income_statement',
        'from' => '2016-10-01',
        'to' => 'today'
      ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('revenue', $report['data']);
    $this->assertArrayHasKey('expenses', $report['data']);
  }

  public function testTrafficReport() {
    $report = \VHX\Analytics::report(array(
        'type' => 'traffic',
        'from' => '1-month-ago',
        'to' => 'today'
      ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('geo', $report['data']);
    $this->assertArrayHasKey('referrers', $report['data']);
  }

  public function testUnitsAggregateReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'units',
      'from' => '2016-07-19',
      'to' => '2016-07-20'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('products', $report['data']);
  }

  public function testUnitsTimeSeriesReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'units',
      'from' => '2016-07-19',
      'to' => '2016-07-20',
      'by' => 'day'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('timestamp', $report['data'][0]);
    $this->assertArrayHasKey('products', $report['data'][0]);
  }

  public function testSubscribersAggregateReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'subscribers',
      'from' => '2016-07-19',
      'to' => '2016-07-20'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('trend_metrics', $report['data']);
  }

  public function testSubscribersTimeSeriesReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'subscribers',
      'from' => '2016-07-19',
      'to' => '2016-07-20',
      'by' => 'day'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('timestamp', $report['data'][0]);
    $this->assertArrayHasKey('free_trial_created', $report['data'][0]);
  }

  public function testChurnAggregateReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'churn',
      'from' => '2016-07-19',
      'to' => '2016-07-20'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('pause_reasons', $report['data']);
  }

  public function testChurnTimeSeriesReport() {
    $report = \VHX\Analytics::report(array(
      'type' => 'churn',
      'from' => '2016-08-20',
      'to' => '2016-08-20',
      'by' => 'month'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('timestamp', $report['data'][0]);
    $this->assertArrayHasKey('pause_reasons', $report['data'][0]);
  }

  public function testVideoAggregateReport() {
    $params = new Params();
    $report = \VHX\Analytics::report(array(
      'type' => 'video',
      'video_id' => $params->video(),
      'from' => '2016-07-19',
      'to' => '2016-07-20'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertEquals('video', $report['type']);
    $this->assertArrayHasKey('data', $report);
    $this->assertArrayHasKey('plays', $report['data'][0]);
  }

  public function testVideoTimeSeriesReport() {
    $params = new Params();
    $report = \VHX\Analytics::report(array(
      'type' => 'video',
      'video_id' => $params->video(),
      'from' => '2016-07-19',
      'to' => '2016-07-20',
      'by' => 'day'
    ));

    $this->assertInternalType('array', $report);
    $this->assertArrayHasKey('_links', $report);
    $this->assertArrayHasKey('data', $report);
    $this->assertEquals('video', $report['type']);
    $this->assertArrayHasKey('interval_timestamp', $report['data'][0]);
  }
}