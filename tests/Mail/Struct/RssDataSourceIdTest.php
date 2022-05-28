<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RssDataSourceId;
use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RssDataSourceId.
 */
class RssDataSourceIdTest extends ZimbraTestCase
{
    public function testRssDataSourceId()
    {
        $id = $this->faker->uuid;
        $rss = new RssDataSourceId($id);
        $this->assertTrue($rss instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rss, 'xml'));
        $this->assertEquals($rss, $this->serializer->deserialize($xml, RssDataSourceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rss, 'json'));
        $this->assertEquals($rss, $this->serializer->deserialize($json, RssDataSourceId::class, 'json'));
    }
}
