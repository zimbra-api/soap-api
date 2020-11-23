<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\ZimletPresence;

/**
 * Testcase class for ZimletPresence.
 */
class ZimletPresenceTest extends TestCase
{
    public function testZimletPresence()
    {
        $values = [
            'MANDATORY'  => 'mandatory',
            'ENABLED'  => 'enabled',
            'DISABLED' => 'disabled',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(ZimletPresence::$enum()->getValue(), $value);
        }
    }
}
