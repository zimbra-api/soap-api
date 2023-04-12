<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\FilterCondition;

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
        foreach ($values as $name => $value) {
            $this->assertSame(FilterCondition::from($value)->name, $name);
            $this->assertSame(FilterCondition::from($value)->value, $value);
        }
    }
}
