<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DateComparison;

/**
 * Testcase class for DateComparison.
 */
class DateComparisonTest extends TestCase
{
    public function testDateComparison()
    {
        $values = [
            'BEFORE' => 'before',
            'AFTER'  => 'after',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DateComparison::$enum()->getValue(), $value);
        }
    }
}
