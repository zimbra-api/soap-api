<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ConditionOperator;

/**
 * Testcase class for ConditionOperator.
 */
class ConditionOperatorTest extends TestCase
{
    public function testConditionOperator()
    {
        $values = [
            'EQ'          => 'eq',
            'HAVE'        => 'has',
            'GE'          => 'ge',
            'LE'          => 'le',
            'GT'          => 'gt',
            'LT'          => 'lt',
            'STARTS_WITH' => 'startswith',
            'ENDS_WITH'   => 'endswith',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ConditionOperator::$enum()->value(), $value);
        }
    }
}
