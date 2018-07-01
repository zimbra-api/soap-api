Zimbra Enum Component
=====================
Zimbra Enum provides enumarable classes for Zimbra Soap Api

The example below demonstrates how you can set up an enum class:
```php
namespace Zimbra\Enum;

class CustomEnum extends Base
{
    const ENUM_CONST = 'enum value';
}

// $enum is a CustomEnum instance
$enum = CustomEnum::ENUM_CONST();

// this statement print 'enum value'
print $enum->value();

```

## Installation

This package can be installed easily using `Composer <http://getcomposer.org>`.
Simply add the following to the composer.json file at the root of your project:

```javascript
{
    "require": {
        "zimbra-api/enum": "*"
    }
}
```
Then install your dependencies using ``composer.phar install``.
