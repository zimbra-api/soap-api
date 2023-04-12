<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\GalMode;

/**
 * Testcase class for GalMode.
 */
class GalModeTest extends TestCase
{
    public function testGalMode()
    {
        $values = [
            'BOTH'   => 'both',
            'LDAP'   => 'ldap',
            'ZIMBRA' => 'zimbra',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(GalMode::from($value)->name, $name);
            $this->assertSame(GalMode::from($value)->value, $value);
        }
    }
}
