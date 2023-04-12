<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ComparisonComparator;

/**
 * Testcase class for ComparisonComparator.
 */
class ComparisonComparatorTest extends TestCase
{
    public function testComparisonComparator()
    {
        $values = [
            'ASCII_NUMERIC' => 'i;ascii-numeric',
            'ASCII_CASEMAP' => 'i;ascii-casemap',
            'OCTET'         => 'i;octet',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(ComparisonComparator::from($value)->name, $name);
            $this->assertSame(ComparisonComparator::from($value)->value, $value);
        }
    }
}
