<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\DistributionListSubscribeStatus;

/**
 * Testcase class for DistributionListSubscribeStatus.
 */
class DistributionListSubscribeStatusTest extends TestCase
{
    public function testDistributionListSubscribeStatus()
    {
        $values = [
            'SUBSCRIBED'   => 'subscribed',
            'UNSUBSCRIBED' => 'unsubscribed',
            'AWAITING_APPROVAL' => 'awaiting_approval',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(DistributionListSubscribeStatus::$enum()->getValue(), $value);
        }
    }
}
