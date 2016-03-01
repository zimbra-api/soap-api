<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\InviteClass;

/**
 * Testcase class for InviteClass.
 */
class InviteClassTest extends PHPUnit_Framework_TestCase
{
    public function testInviteClass()
    {
        $values = [
            'PUB' => 'PUB',
            'PRI' => 'PRI',
            'CON' => 'CON',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(InviteClass::$enum()->value(), $value);
        }
    }
}
