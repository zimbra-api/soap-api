<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\UnknownDataSourceNameOrId;

/**
 * Testcase class for UnknownDataSourceNameOrId.
 */
class UnknownDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testUnknownDataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $unknown = new UnknownDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $unknown);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<unknown name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $unknown);

        $array = array(
            'unknown' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $unknown->toArray());
    }
}
