<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ContactAttachSpec;

/**
 * Testcase class for ContactAttachSpec.
 */
class ContactAttachSpecTest extends ZimbraMailTestCase
{
    public function testContactAttachSpec()
    {
        $id = $this->faker->word;
        $cn = new ContactAttachSpec($id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\AttachSpec', $cn);
        $this->assertSame($id, $cn->getId());

        $cn->setId($id)
           ->setOptional(true);
        $this->assertSame($id, $cn->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cn id="' . $id . '" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => $id,
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }
}
