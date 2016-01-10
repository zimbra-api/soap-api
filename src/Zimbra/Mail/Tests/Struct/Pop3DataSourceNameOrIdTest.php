<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\Pop3DataSourceNameOrId;

/**
 * Testcase class for Pop3DataSourceNameOrId.
 */
class Pop3DataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testPop3DataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $pop3);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<pop3 name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pop3);

        $array = array(
            'pop3' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $pop3->toArray());
    }
}
