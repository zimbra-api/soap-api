<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\QuotaSortBy;

/**
 * Testcase class for QuotaSortBy.
 */
class QuotaSortByTest extends PHPUnit_Framework_TestCase
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
            $this->assertSame(QuotaSortBy::$enum()->value(), $value);
        }
    }
}
