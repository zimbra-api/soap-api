<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ComparisonComparator;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(ComparisonComparator::$enum()->getValue(), $value);
        }
    }
}
