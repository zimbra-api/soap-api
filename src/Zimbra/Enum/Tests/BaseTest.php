<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\Base;

/**
 * Testcase class for Base.
 */
class BaseTest extends PHPUnit_Framework_TestCase
{
    public function testBase()
    {
        $values = [
            'CONST_01'          => 'value_01',
            'CONST_02'          => 'value_02',
        ];
        $this->assertSame(ZimbraLocalEnum::enums(), $values);
        foreach ($values as $enum => $value)
        {
            $this->assertTrue(ZimbraLocalEnum::has($value));
            $this->assertSame(ZimbraLocalEnum::$enum()->value(), $value);
            $this->assertTrue(ZimbraLocalEnum::$enum()->is($value));
            $this->assertTrue(ZimbraLocalEnum::$enum()->in($values));
        }
    }
}

class ZimbraLocalEnum extends Base
{
    const CONST_01 = 'value_01';
    const CONST_02 = 'value_02';
}
