<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ConditionOperator;

/**
 * Testcase class for ConditionOperator.
 */
class ConditionOperatorTest extends TestCase
{
    public function testConditionOperator()
    {
        $values = [
            'EQUAL'         => 'eq',
            'HAS'           => 'has',
            'GREATER_EQUAL' => 'ge',
            'LESS_EQUAL'    => 'le',
            'GREATER_THAN'  => 'gt',
            'LESS_THAN'     => 'lt',
            'STARTS_WITH'   => 'startswith',
            'ENDS_WITH'     => 'endswith',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(ConditionOperator::$enum()->getValue(), $value);
        }
    }
}
