<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DistributionListGranteeBy;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DistributionListGranteeBy::from($value)->name, $name);
            $this->assertSame(DistributionListGranteeBy::from($value)->value, $value);
        }
    }
}
