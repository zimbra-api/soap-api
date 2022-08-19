<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\InviteStatus;

/**
 * Testcase class for InviteStatus.
 */
class InviteStatusTest extends TestCase
{
    public function testInviteStatus()
    {
        $values = [
            'TENTATIVE'  => 'TENT',
            'CONFIRMED'  => 'CONF',
            'CANCELLED'  => 'CANC',
            'COMPLETED'  => 'COMP',
            'INPROGRESS' => 'INPR',
            'WAITING'    => 'WAITING',
            'DEFERRED'   => 'DEFERRED',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(InviteStatus::$enum()->getValue(), $value);
        }
    }
}
