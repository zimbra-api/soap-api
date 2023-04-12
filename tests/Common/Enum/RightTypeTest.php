<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RightType;

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
        foreach ($values as $name => $value) {
            $this->assertSame(RightType::from($value)->name, $name);
            $this->assertSame(RightType::from($value)->value, $value);
        }
    }
}
