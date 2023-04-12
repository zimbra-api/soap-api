<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\RelationalComparator;

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
        foreach ($values as $name => $value) {
            $this->assertSame(RelationalComparator::from($value)->name, $name);
            $this->assertSame(RelationalComparator::from($value)->value, $value);
        }
    }
}
