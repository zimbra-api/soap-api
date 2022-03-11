<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\UnknownDataSourceId;
use Zimbra\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UnknownDataSourceId.
 */
class UnknownDataSourceIdTest extends ZimbraTestCase
{
    public function testUnknownDataSourceId()
    {
        $id = $this->faker->uuid;
        $unknown = new UnknownDataSourceId($id);
        $this->assertTrue($unknown instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($unknown, 'xml'));
        $this->assertEquals($unknown, $this->serializer->deserialize($xml, UnknownDataSourceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($unknown, 'json'));
        $this->assertEquals($unknown, $this->serializer->deserialize($json, UnknownDataSourceId::class, 'json'));
    }
}
