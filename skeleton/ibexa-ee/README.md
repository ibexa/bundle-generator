# __PACKAGE_NAME__

## Installation

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require __VENDOR_NAME__/__PACKAGE_NAME__
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require __VENDOR_NAME__/__PACKAGE_NAME__
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md) of the Composer documentation.

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    __VENDOR_NAMESPACE__\Platform\Bundle\__BUNDLE_NAME__\__VENDOR_NAMESPACE__Platform__BUNDLE_NAME__Bundle::class => ['all' => true],
];
```

## COPYRIGHT

Copyright (C) 1999-2021 Ibexa AS (formerly eZ Systems AS). All rights reserved.

## LICENSE

This source code is available separately under the following licenses:

A - Ibexa Business Use License Agreement (Ibexa BUL),
version 2.3 or later versions (as license terms may be updated from time to time)
Ibexa BUL is granted by having a valid Ibexa DXP (formerly eZ Platform Enterprise) subscription,
as described at: https://www.ibexa.co/product
For the full Ibexa BUL license text, please see:
- LICENSE-bul file placed in the root of this source code, or
- https://www.ibexa.co/software-information/licenses-and-agreements (latest version applies)

AND

B - Ibexa Trial and Test License Agreement (Ibexa TTL),
version 2.2 or later versions (as license terms may be updated from time to time)
Trial can be granted by Ibexa, reach out to Ibexa AS for evaluation access: https://www.ibexa.co/about-ibexa/contact-us
For the full Ibexa TTL license text, please see:
- LICENSE file placed in the root of this source code, or
- https://www.ibexa.co/software-information/l
