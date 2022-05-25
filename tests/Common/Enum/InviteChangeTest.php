<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\InviteChange;

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
