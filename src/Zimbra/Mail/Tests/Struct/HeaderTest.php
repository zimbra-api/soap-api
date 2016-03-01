<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\Header;

/**
 * Testcase class for Header.
 */
class HeaderTest extends ZimbraMailTestCase
{
    public function testHeader()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $header = new Header($name, $value);
        $this->assertSame($name, $header->getName());

        $header->setName($name);
        $this->assertSame($name, $header->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<header name="' . $name . '">' . $value . '</header>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $header);

        $array = array(
            'header' => array(
                'name' => $name,
                '_content' => $value,
            ),
        );
        $this->assertEquals($array, $header->toArray());
    }
}
