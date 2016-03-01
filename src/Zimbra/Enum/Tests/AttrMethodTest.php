<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\AttrMethod;

/**
 * Testcase class for AttrMethod.
 */
class AttrMethodTest extends PHPUnit_Framework_TestCase
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
            $this->assertSame(AttrMethod::$enum()->value(), $value);
        }
    }
}
