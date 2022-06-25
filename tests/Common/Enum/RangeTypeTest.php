<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RangeType;

/**
 * Testcase class for RangeType.
 */
class RangeTypeTest extends TestCase
{
    public function testRangeType()
    {
        $values = [
            'NONE'          => 1,
            'THISANDFUTURE' => 2,
            'THISANDPRIOR'  => 3,
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(RangeType::$enum()->getValue(), $value);
        }
    }
}
