<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AttrMethod;

/**
 * Testcase class for AttrMethod.
 */
class AttrMethodTest extends TestCase
{
    public function testAttrMethod()
    {
        $values = [
            'GET_ATTRS' => 'getAttrs',
            'SET_ATTRS' => 'setAttrs',
            'GET_SET'   => 'getAttrs,setAttrs',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(AttrMethod::$enum()->getValue(), $value);
        }
    }
}
