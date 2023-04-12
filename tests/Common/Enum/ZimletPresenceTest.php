<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\ZimletPresence;

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
        foreach ($values as $name => $value) {
            $this->assertSame(ZimletPresence::from($value)->value, $value);
            $this->assertSame(ZimletPresence::from($value)->name, $name);
        }
    }
}
