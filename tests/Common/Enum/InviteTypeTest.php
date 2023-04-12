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
        foreach ($values as $name => $value) {
            $this->assertSame(InviteType::from($value)->name, $name);
            $this->assertSame(InviteType::from($value)->value, $value);
        }
    }
}
