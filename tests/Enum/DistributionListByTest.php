<?php

namespace Zimbra\Tests\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DistributionListBy;

/**
 * Testcase class for DistributionListBy.
 */
class DistributionListByTest extends TestCase
{
    public function testDistributionListBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DistributionListBy::$enum()->getValue(), $value);
        }
    }
}
