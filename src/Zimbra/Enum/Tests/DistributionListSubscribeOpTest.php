<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\DistributionListSubscribeOp;

/**
 * Testcase class for DistributionListSubscribeOp.
 */
class DistributionListSubscribeOpTest extends PHPUnit_Framework_TestCase
{
    public function testDistributionListSubscribeOp()
    {
        $values = [
            'SUBSCRIBE'   => 'subscribe',
            'UNSUBSCRIBE' => 'unsubscribe',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(DistributionListSubscribeOp::$enum()->value(), $value);
        }
    }
}
