<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CaldavDataSourceNameOrId;

/**
 * Testcase class for CaldavDataSourceNameOrId.
 */
class CaldavDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testCaldavDataSourceNameOrId()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;

        $caldav = new CaldavDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $caldav);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<caldav name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $caldav);

        $array = array(
            'caldav' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $caldav->toArray());
    }
}
