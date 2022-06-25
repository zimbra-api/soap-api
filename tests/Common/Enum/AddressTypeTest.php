<?php

namespace Zimbra\Tests\Common\Enum;

use PHPUnit\Framework\TestCase;
use Zimbra\Common\Enum\AddressType;

/**
 * Testcase class for AddressType.
 */
class AddressTypeTest extends TestCase
{
    public function testAddressType()
    {
        $values = [
            'FRO'          => 'f',
            'TO'           => 't',
            'CC'           => 'c',
            'BCC'          => 'b',
            'REPLY_TO'     => 'r',
            'SENDER'       => 's',
            'NOTIFICATION' => 'n',
            'RESENT_FROM'  => 'rf',
        ];
        foreach ($values as $enum => $value) {
            $this->assertSame(AddressType::$enum()->getValue(), $value);
        }
    }
}
