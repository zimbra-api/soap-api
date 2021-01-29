<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DistributionListGranteeBy;

/**
 * Testcase class for DistributionListGranteeBy.
 */
class DistributionListGranteeByTest extends TestCase
{
    public function testDistributionListGranteeBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DistributionListGranteeBy::$enum()->getValue(), $value);
        }
    }
}
