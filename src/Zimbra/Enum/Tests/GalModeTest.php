<?php

namespace Zimbra\Enum\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Enum\GalMode;

/**
 * Testcase class for GalMode.
 */
class GalModeTest extends PHPUnit_Framework_TestCase
{
    public function testGalMode()
    {
        $values = [
            'BOTH'   => 'both',
            'LDAP'   => 'ldap',
            'ZIMBRA' => 'zimbra',
        ];
        foreach ($values as $enum => $value)
        {
            $this->assertSame(GalMode::$enum()->value(), $value);
        }
    }
}
