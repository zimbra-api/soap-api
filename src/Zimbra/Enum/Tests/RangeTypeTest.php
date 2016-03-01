<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\RangeType;

/**
 * Testcase class for RangeType.
 */
class RangeTypeTest extends PHPUnit_Framework_TestCase
{
    public function testRangeType()
    {
        $values = [
            'NONE'          => -1,
            'THISANDFUTURE' => 2,
            'THISANDPRIOR'  => 3,
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(RangeType::$enum()->value(), $value);
        }
    }
}
