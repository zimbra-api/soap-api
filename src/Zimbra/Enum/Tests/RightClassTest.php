<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\RightClass;

/**
 * Testcase class for RightClass.
 */
class RightClassTest extends PHPUnit_Framework_TestCase
{
    public function testRightClass()
    {
        $values = [
            'ADMIN' => 'ADMIN',
            'USER'  => 'USER',
            'ALL'   => 'ALL',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(RightClass::$enum()->value(), $value);
        }
    }
}
