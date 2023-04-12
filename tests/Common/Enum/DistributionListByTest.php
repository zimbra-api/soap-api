<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DistributionListBy;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DistributionListBy::from($value)->name, $name);
            $this->assertSame(DistributionListBy::from($value)->value, $value);
        }
    }
}
