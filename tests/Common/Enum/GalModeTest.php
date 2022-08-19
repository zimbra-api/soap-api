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
        foreach ($values as $enum => $value) {
            $this->assertSame(GalMode::$enum()->getValue(), $value);
        }
    }
}
