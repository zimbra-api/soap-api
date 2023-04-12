<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\NumberComparison;

/**
 * Testcase class for NumberComparison.
 */
class NumberComparisonTest extends TestCase
{
    public function testNumberComparison()
    {
        $values = [
            'OVER' => 'over',
            'UNDER'  => 'under',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(NumberComparison::from($value)->name, $name);
            $this->assertSame(NumberComparison::from($value)->value, $value);
        }
    }
}
