<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\RightClass;

/**
 * Testcase class for RightClass.
 */
class RightClassTest extends TestCase
{
    public function testRightClass()
    {
        $values = [
            'ADMIN' => 'ADMIN',
            'USER'  => 'USER',
            'ALL'   => 'ALL',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(RightClass::$enum()->getValue(), $value);
        }
    }
}
