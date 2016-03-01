<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AddressBookTest;

/**
 * Testcase class for AddressBookTest.
 */
class AddressBookTestTest extends ZimbraMailTestCase
{
    public function testAddressBookTest()
    {
        $index = mt_rand(1, 100);
        $header = $this->faker->word;

        $addressBookTest = new AddressBookTest(
            $index, $header, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $addressBookTest);
        $this->assertSame($header, $addressBookTest->getHeader());
        $addressBookTest->setHeader($header);
        $this->assertSame($header, $addressBookTest->getHeader());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<addressBookTest index="' . $index . '" negative="true" header="' . $header . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $addressBookTest);

        $array = array(
            'addressBookTest' => array(
                'index' => $index,
                'negative' => true,
                'header' => $header,
            ),
        );
        $this->assertEquals($array, $addressBookTest->toArray());
    }
}
