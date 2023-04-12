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
            'FROM'         => 'f',
            'TO'           => 't',
            'CC'           => 'c',
            'BCC'          => 'b',
            'REPLY_TO'     => 'r',
            'SENDER'       => 's',
            'NOTIFICATION' => 'n',
            'RESENT_FROM'  => 'rf',
        ];
        foreach ($values as $name => $value) {
            $this->assertSame(AddressType::from($value)->name, $name);
            $this->assertSame(AddressType::from($value)->value, $value);
        }
    }
}
