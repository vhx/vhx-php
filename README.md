# VHX PHP Node Bindings

You can sign up for a VHX account at https://vhx.tv.

### Requirements

PHP 5.3.3 and later.

### Installation

**Composer**

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
  "require": {
    "vhx/vhx-php": "0.*"
  }
}
```

Then install via:

```bash
composer install
```

Then use Composer's [autoload](https://getcomposer.org/doc/00-intro.md#autoloading):

```php
require_once('vendor/autoload.php');
```

**Manual**

You can also download the [latest release](https://github.com/vhx/vhx-php/releases). Then simply include the `init.php` file.

```php
require_once('/path/to/vhx-php/init.php');
```

### Documentation

Documentation is available at http://dev.vhx.tv/docs/api/php.
Full API reference is available at http://dev.vhx.tv/docs/api?php.

### Getting Started

Every resource is accessed via the `\VHX` namespace:

```php
\VHX\API::setKey('your VHX API key');
```

Every resource method has one arguments. The argument is an options array.

```php

// \VHX\{resource}::{method}(options);

// example customer create
$customer = \VHX\Customers::create(array(
  email => 'customer@email.com',
  name => 'First Last',
  subscription => 'https://api.vhx.tv/subscriptions/1'
});
```

You can get a step-by-step tutorial on how to use the [VHX PHP API on our developer docs](https://dev.vhx.tv/api#php).

### Resources & methods

videos
  * [`create`](http://dev.vhx.tv/docs/api?php#create_customer)
  * [`update`](http://dev.vhx.tv/docs/api?php#update_customer)
  * [`retrieve`](http://dev.vhx.tv/docs/api?php#retrieve_customer)
  * [`list`](http://dev.vhx.tv/docs/api?php#list_customers)

collections
  * [`create`](http://dev.vhx.tv/docs/api?php#create_collection)
  * [`update`](http://dev.vhx.tv/docs/api?php#update_collection)
  * [`retrieve`](http://dev.vhx.tv/docs/api?php#retrieve_collection)
  * [`list`](http://dev.vhx.tv/docs/api?php#list_collections)

 customers
  * [`create`](http://dev.vhx.tv/docs/api?php#create_customer)
  * [`update`](http://dev.vhx.tv/docs/api?php#update_customer)
  * [`retrieve`](http://dev.vhx.tv/docs/api?php#retrieve_customer)
  * [`list`](http://dev.vhx.tv/docs/api?php#list_customers)

authorizations
  * [`create`](http://dev.vhx.tv/docs/api?php#create_authorization)
