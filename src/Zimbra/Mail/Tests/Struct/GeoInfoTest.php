<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GeoInfo.
 */
class GeoInfoTest extends ZimbraStructTestCase
{
    public function testGeoInfo()
    {
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;

        $geo = new GeoInfo($latitude, $longitude);
        $this->assertSame($latitude, $geo->getLatitude());
        $this->assertSame($longitude, $geo->getLongitude());

        $geo = new GeoInfo();
        $geo->setLatitude($latitude)
            ->setLongitude($longitude);
        $this->assertSame($latitude, $geo->getLatitude());
        $this->assertSame($longitude, $geo->getLongitude());

        $xml = <<<EOT
<?xml version="1.0"?>
<geo lat="$latitude" lon="$longitude" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($geo, 'xml'));
        $this->assertEquals($geo, $this->serializer->deserialize($xml, GeoInfo::class, 'xml'));

        $json = json_encode([
            'lat' => $latitude,
            'lon' => $longitude,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($geo, 'json'));
        $this->assertEquals($geo, $this->serializer->deserialize($json, GeoInfo::class, 'json'));
    }
}
