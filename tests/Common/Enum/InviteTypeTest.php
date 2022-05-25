<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\InviteType;

/**
 * Testcase class for InviteType.
 */
class InviteTypeTest extends TestCase
{
    public function testInviteType()
    {
        $values = [
            'APPOINTMENT' => 'appt',
            'TASK'        => 'task',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(InviteType::$enum()->getValue(), $value);
        }
    }
}
