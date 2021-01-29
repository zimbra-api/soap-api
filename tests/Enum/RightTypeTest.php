<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\RightType;

/**
 * Testcase class for RightType.
 */
class RightTypeTest extends TestCase
{
    public function testRightType()
    {
        $values = [
            'PRESET' => 'preset',
            'GET_ATTRS'  => 'getAttrs',
            'SET_ATTRS'   => 'setAttrs',
            'COMBO'   => 'combo',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(RightType::$enum()->getValue(), $value);
        }
    }
}
