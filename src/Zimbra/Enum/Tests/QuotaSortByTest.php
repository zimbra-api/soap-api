<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\QuotaSortBy;

/**
 * Testcase class for QuotaSortBy.
 */
class QuotaSortByTest extends TestCase
{
    public function testQuotaSortBy()
    {
        $values = [
            'PERCENT_USED' => 'percentUsed',
            'TOTAL_USED'   => 'totalUsed',
            'QUOTA_LIMIT'  => 'quotaLimit',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(QuotaSortBy::$enum()->getValue(), $value);
        }
    }
}
