<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\InviteStatus;

/**
 * Testcase class for InviteStatus.
 */
class InviteStatusTest extends PHPUnit_Framework_TestCase
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
        foreach ($values as $enum => $value)
        {
            $this->assertSame(InviteStatus::$enum()->value(), $value);
        }
    }
}
