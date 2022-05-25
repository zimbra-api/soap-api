<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AddressPart;

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
