# VHX PHP API Client (BETA)

The VHX API is currently Private Beta. You can request an API key by emailing api@vhx.tv.

### Installation
Requires PHP 5.3.3 and later.

**Composer**

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
  "require": {
    "vhx/vhx-php": "1.0.*@beta"
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

Documentation, including a step-by-step tutorial is available on the [VHX Developer Docs ](http://dev.vhx.tv/api?php) site.
For Full API reference [go here](http://dev.vhx.tv/docs/api?php).

### Getting Started

Before requesting your first resource, you must setup your instance with your VHX API key:

```php
\VHX\Api::setKey('your VHX API key');
```

Every resource is accessed via the `\VHX` namespace:

```php

// example customer create
$customer = \VHX\Customers::create(array(
  email => 'customer@email.com',
  name => 'First Last',
  subscription => 'https://api.vhx.tv/subscriptions/1'
});
```

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

  [`items`](http://dev.vhx.tv/docs/api?php#list_collection_items)

customers
  * [`create`](http://dev.vhx.tv/docs/api?php#create_customer)
  * [`update`](http://dev.vhx.tv/docs/api?php#update_customer)
  * [`retrieve`](http://dev.vhx.tv/docs/api?php#retrieve_customer)
  * [`list`](http://dev.vhx.tv/docs/api?php#list_customers)

authorizations
  * [`create`](http://dev.vhx.tv/docs/api?php#create_authorization)
