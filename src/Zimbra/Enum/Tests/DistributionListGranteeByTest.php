<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DistributionListGranteeBy;

/**
 * Testcase class for DistributionListGranteeBy.
 */
class DistributionListGranteeByTest extends PHPUnit_Framework_TestCase
{
    public function testDistributionListGranteeBy()
    {
        $values = [
            'ID'   => 'id',
            'NAME' => 'name',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DistributionListGranteeBy::$enum()->value(), $value);
        }
    }
}
