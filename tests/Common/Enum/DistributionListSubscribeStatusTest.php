<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\DistributionListSubscribeStatus;

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
        foreach ($values as $name => $value) {
            $this->assertSame(DistributionListSubscribeStatus::from($value)->name, $name);
            $this->assertSame(DistributionListSubscribeStatus::from($value)->value, $value);
        }
    }
}
