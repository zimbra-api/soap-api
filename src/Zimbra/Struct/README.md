Zimbra Struct Component
=======================
Zimbra Struct provides interface and base class for building soap struct classes. With the Struct component it's possible to export struct classes into XML format or array structure for serializing to JSON format.
``StructInterface`` is the core interface of the Zimbra Struct.

## Installation

This package can be installed easily using `Composer <http://getcomposer.org>`.
Simply add the following to the composer.json file at the root of your project:

```javascript
{
    "require": {
        "zimbra-api/struct": "*"
    }
}
```
Then install your dependencies using ``composer.phar install``.
