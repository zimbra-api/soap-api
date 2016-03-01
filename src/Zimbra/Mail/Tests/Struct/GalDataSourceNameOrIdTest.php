<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\GalDataSourceNameOrId;

/**
 * Testcase class for GalDataSourceNameOrId.
 */
class GalDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testGalDataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $gal = new GalDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $gal);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<gal name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $gal);

        $array = array(
            'gal' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $gal->toArray());
    }
}
