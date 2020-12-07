<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ValueComparison;

/**
 * Testcase class for ValueComparison.
 */
class ValueComparisonTest extends TestCase
{
    public function testValueComparison()
    {
        $values = [
            'GREATER_THAN'  => 'gt',
            'GREATER_EQUAL' => 'ge',
            'LESS_THAN'     => 'lt',
            'LESS_EQUAL'    => 'le',
            'EQUAL'         => 'eq',
            'NOT_EQUAL'     => 'ne',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ValueComparison::$enum()->getValue(), $value);
        }
    }
}
