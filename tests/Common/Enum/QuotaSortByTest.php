<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\QuotaSortBy;

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
        foreach ($values as $name => $value) {
            $this->assertSame(QuotaSortBy::from($value)->name, $name);
            $this->assertSame(QuotaSortBy::from($value)->value, $value);
        }
    }
}
