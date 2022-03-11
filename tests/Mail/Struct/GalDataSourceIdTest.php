<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\GalDataSourceId;
use Zimbra\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GalDataSourceId.
 */
class GalDataSourceIdTest extends ZimbraTestCase
{
    public function testGalDataSourceId()
    {
        $id = $this->faker->uuid;
        $gal = new GalDataSourceId($id);
        $this->assertTrue($gal instanceof Id);

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($gal, 'xml'));
        $this->assertEquals($gal, $this->serializer->deserialize($xml, GalDataSourceId::class, 'xml'));

        $json = json_encode([
            'id' => $id,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($gal, 'json'));
        $this->assertEquals($gal, $this->serializer->deserialize($json, GalDataSourceId::class, 'json'));
    }
}
