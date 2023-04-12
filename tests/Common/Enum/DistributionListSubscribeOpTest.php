<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DistributionListSubscribeOp;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DistributionListSubscribeOp::from($value)->name, $name);
            $this->assertSame(DistributionListSubscribeOp::from($value)->value, $value);
        }
    }
}
