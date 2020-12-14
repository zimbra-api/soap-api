<?php

namespace Zimbra\Enum\Tests;

use PHPUnit\Framework\TestCase;
use Zimbra\Enum\AddressPart;

/**
 * Testcase class for AddressPart.
 */
class AddressPartTest extends TestCase
{
    public function testAddressPart()
    {
        $values = [
            'ALL'     => 'all',
            'LOCALPART' => 'localpart',
            'DOMAIN'     => 'domain',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AddressPart::$enum()->getValue(), $value);
        }
    }
}
