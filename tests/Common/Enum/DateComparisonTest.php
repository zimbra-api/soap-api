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
        foreach ($values as $name => $value) {
            $this->assertSame(DateComparison::from($value)->name, $name);
            $this->assertSame(DateComparison::from($value)->value, $value);
        }
    }
}
