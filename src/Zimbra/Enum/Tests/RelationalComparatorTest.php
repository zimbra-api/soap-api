<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\RelationalComparator;

/**
 * Testcase class for RelationalComparator.
 */
class RelationalComparatorTest extends TestCase
{
    public function testRelationalComparator()
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
            $this->assertSame(RelationalComparator::$enum()->getValue(), $value);
        }
    }
}
