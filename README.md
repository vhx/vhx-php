# VHX PHP API Client

API applications can be created in the [https://www.vhx.tv/admin/platforms](VHX admin) or by emailing [api@vhx.tv](mailto:api@vhx.tv).

### Installation
Requires PHP 5.3.3 and later.

**Composer**

You can install the bindings via [Composer](http://getcomposer.org/). Add this to your `composer.json`:

```json
{
  "require": {
    "vhx/vhx-php": "1.10.*"
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
  product => 'https://api.vhx.tv/products/1'
));
```

Headers can be passed in as the last argument, which would either be the second or third argument depending on the method. See each individual method for specifics.

```php

// example video create with header
$video = \VHX\Videos::create(array(
  title => 'My Video'
), array(
  'VHX-Client-IP' => '0.0.0.0'  
));
```

### Resources & methods

products
  * [`retrieve`](http://dev.vhx.tv/docs/api/?php#product-retrieve)
  * [`all`](http://dev.vhx.tv/docs/api/?php#product-list)

customers
  * [`create`](http://dev.vhx.tv/docs/api/?php#customer-create)
  * [`update`](http://dev.vhx.tv/docs/api/?php#customer-update)
  * [`retrieve`](http://dev.vhx.tv/docs/api/?php#customer-retrieve)
  * [`all`](http://dev.vhx.tv/docs/api/?php#customer-list)
  * [`delete`](http://dev.vhx.tv/docs/api/?php#customer-delete)
  * [`addProduct`](http://dev.vhx.tv/docs/api/?php#customer-add-product)
  * [`removeProduct`](http://dev.vhx.tv/docs/api/?php#customer-remove-product)

watchlist
  * [`items`](http://dev.vhx.tv/docs/api/?php#customer-watchlist-items)
  * [`addItem`](http://dev.vhx.tv/docs/api/?php#customer-watchlist-add-item)
  * [`removeItem`](http://dev.vhx.tv/docs/api/?php#customer-watchlist-remove-item)

watching
  * [`items`](http://dev.vhx.tv/docs/api/?php#customer-watching)

browse
  * [`all`](http://dev.vhx.tv/docs/api/?php#browse)

videos
  * [`create`](http://dev.vhx.tv/docs/api/?php#videos-create)
  * [`retrieve`](http://dev.vhx.tv/docs/api/?php#videos-get)
  * [`all`](http://dev.vhx.tv/docs/api/?php#videos-list)
  * [`files`](http://dev.vhx.tv/docs/api/?php#videos-list-files)

collections
  * [`create`](http://dev.vhx.tv/docs/api/?php#collections-create)
  * [`update`](http://dev.vhx.tv/docs/api/?php#collections-update)
  * [`retrieve`](http://dev.vhx.tv/docs/api/?php#collections-retrieve)
  * [`all`](http://dev.vhx.tv/docs/api/?php#collections-list)
  * [`items`](http://dev.vhx.tv/docs/api/?php#collection-items-list)

authorizations
  * [`create`](http://dev.vhx.tv/docs/api/?php#authorizations-create)

analytics
  * [`report`](http://dev.vhx.tv/docs/api/?php#analytics-report)
