<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RightClass;

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
        foreach ($values as $name => $value) {
            $this->assertSame(RightClass::from($value)->name, $name);
            $this->assertSame(RightClass::from($value)->value, $value);
        }
    }
}
