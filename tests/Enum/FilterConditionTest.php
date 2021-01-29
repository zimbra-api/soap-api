<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\FilterCondition;

/**
 * Testcase class for FilterCondition.
 */
class FilterConditionTest extends TestCase
{
    public function testFilterCondition()
    {
        $values = [
            'ALL_OF' => 'allof',
            'ANY_OF' => 'anyof',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(FilterCondition::$enum()->getValue(), $value);
        }
    }
}
