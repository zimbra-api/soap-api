<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DateComparison;

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
