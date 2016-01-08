<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CalDataSourceNameOrId;

/**
 * Testcase class for CalDataSourceNameOrId.
 */
class CalDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testCalDataSourceNameOrId()
    {
        $id = $this->faker->word;
        $name = $this->faker->word;

        $cal = new CalDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $cal);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<cal name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'cal' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }
}
