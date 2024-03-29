<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\InviteClass;

/**
 * Testcase class for InviteClass.
 */
class InviteClassTest extends TestCase
{
    public function testInviteClass()
    {
        $values = [
            'PUB' => 'PUB',
            'PRI' => 'PRI',
            'CON' => 'CON',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(InviteClass::from($value)->name, $name);
            $this->assertSame(InviteClass::from($value)->value, $value);
        }
    }
}
