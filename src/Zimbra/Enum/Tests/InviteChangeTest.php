<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\InviteChange;

/**
 * Testcase class for InviteChange.
 */
class InviteChangeTest extends TestCase
{
    public function testInviteChange()
    {
        $values = [
            'SUBJECT'    => 'subject',
            'LOCATION'   => 'location',
            'TIME'       => 'time',
            'RECURRENCE' => 'recurrence',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(InviteChange::$enum()->getValue(), $value);
        }
    }
}
