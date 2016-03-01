<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\RssDataSourceNameOrId;

/**
 * Testcase class for RssDataSourceNameOrId.
 */
class RssDataSourceNameOrIdTest extends ZimbraMailTestCase
{
    public function testRssDataSourceNameOrId()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $rss = new RssDataSourceNameOrId($name, $id);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $rss);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<rss name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rss);

        $array = array(
            'rss' => array(
                'name' => $name,
                'id' => $id,
            ),
        );
        $this->assertEquals($array, $rss->toArray());
    }
}
