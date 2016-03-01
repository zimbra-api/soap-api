<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\FilterCondition;

/**
 * Testcase class for FilterCondition.
 */
class FilterConditionTest extends PHPUnit_Framework_TestCase
{
    public function testFilterCondition()
    {
        $values = [
            'ALL_OF' => 'allof',
            'ANY_OF' => 'anyof',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(FilterCondition::$enum()->value(), $value);
        }
    }
}
