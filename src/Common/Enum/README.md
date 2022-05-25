Zimbra  Enum Component
=====================
Zimbra Enum provides enumarable classes for Zimbra Soap Api

The example below demonstrates how you can set up an enum class:
```php
namespace Zimbra\Common\Enum;

use MyCLabs\Enum\Enum;

class CustomEnum extends Enum
{
    const ENUM_CONST = 'enum value';
}

// $enum is a CustomEnum instance
$enum = CustomEnum::ENUM_CONST();

// this statement print 'enum value'
print $enum->getValue();

```
