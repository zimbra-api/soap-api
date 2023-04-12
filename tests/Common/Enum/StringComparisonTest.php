<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\StringComparison;

/**
 * Testcase class for StringComparison.
 */
class StringComparisonTest extends TestCase
{
    public function testStringComparison()
    {
        $values = [
            'IS' =>    'is',
            'CONTAINS' => 'contains',
            'MATCHES'  => 'matches',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(StringComparison::from($value)->name, $name);
            $this->assertSame(StringComparison::from($value)->value, $value);
        }
    }
}
