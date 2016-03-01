<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\YabDataSourceNameOrId;

/**
 * Testcase class for YabDataSourceNameOrId.
 */
class YabDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testYabDataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $yab = new YabDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $yab);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<yab name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $yab);

        $array = array(
            'yab' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $yab->toArray());
    }
}
