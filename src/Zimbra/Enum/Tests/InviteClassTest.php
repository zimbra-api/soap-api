<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\InviteClass;

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
        foreach ($values as $enum => $value) {
            $this->assertSame(InviteClass::$enum()->getValue(), $value);
        }
    }
}
