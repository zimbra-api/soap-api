<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DistributionListSubscribeOp;

/**
 * Testcase class for DistributionListSubscribeOp.
 */
class DistributionListSubscribeOpTest extends TestCase
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
