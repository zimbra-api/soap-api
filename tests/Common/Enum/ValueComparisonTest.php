<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ValueComparison;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ValueComparison::from($value)->value, $value);
            $this->assertSame(ValueComparison::from($value)->name, $name);
        }
    }
}
