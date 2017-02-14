<?php

require_once('init.php');
require_once('Params.php');

$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();

\VHX\API::setKey($_ENV['TEST_API_KEY'], true);

use PHPUnit\Framework\TestCase;

class CustomersTest extends TestCase {
  public function testAll() {
    $customers = \VHX\Customers::all();
    $this->assertArrayHasKey('_links', $customers);
    $this->assertArrayHasKey('_embedded', $customers);
    $this->assertArrayHasKey('count', $customers);
    $this->assertArrayHasKey('customers', $customers['_embedded']);
  }

  public function testRetrieve() {
    $params = new Params();
    $customer = \VHX\Customers::retrieve($params->customer());
    $this->assertArrayHasKey('_links', $customer);
    $this->assertArrayHasKey('_embedded', $customer);
    $this->assertArrayHasKey('email', $customer);
    $this->assertArrayHasKey('name', $customer);
    $this->assertEquals(intval($params->customer()), $customer['id']);
  }

  public function testCreate() {
    $params = new Params();
    $name = $params->name();
    $email = $params->email();

    $customer = \VHX\Customers::create(array(
      'name' => $name, 'email' => $email
    ));
    $this->assertArrayHasKey('_links', $customer);
    $this->assertArrayHasKey('_embedded', $customer);
    $this->assertEquals($name, $customer['name']);
    $this->assertEquals($email, $customer['email']);
  }

  public function testUpdate() {
    $params = new Params();
    $name = $params->name();

    $customer = \VHX\Customers::update($params->customer(), array(
      'name' => $name
    ));
    $this->assertArrayHasKey('_links', $customer);
    $this->assertArrayHasKey('_embedded', $customer);
    $this->assertEquals($name, $customer['name']);
  }

  public function testAddProduct() {
    $params = new Params();
    $name = $params->name();
    $email = $params->email();

    $customer = \VHX\Customers::create(array(
      'name' => $name, 'email' => $email
    ));

    $response = \VHX\Customers::addProduct($customer['id'], array(
      'product' => $params->product()
    ));

    $this->assertArrayHasKey('_links', $response);
    $this->assertArrayHasKey('_embedded', $response);
    $this->assertInternalType('array', $response['_embedded']['products']);
    $this->assertEquals(intval($params->product()), $response['_embedded']['products'][0]['id']);
  }

  public function testRemoveProduct() {
    $params = new Params();
    $name = $params->name();
    $email = $params->email();

    $customer = \VHX\Customers::create(array(
      'name' => $name, 'email' => $email
    ));

    \VHX\Customers::addProduct($customer['id'], array(
      'product' => $params->product()
    ));

    $response = \VHX\Customers::removeProduct($customer['id'], array(
      'product' => $params->product()
    ));

    $this->assertArrayHasKey('_links', $response);
    $this->assertArrayHasKey('_embedded', $response);
    $this->assertInternalType('array', $response['_embedded']['products']);
    $this->assertEquals(0, count($response['_embedded']['products']));
  }
}