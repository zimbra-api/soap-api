<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\GeoInfo;

/**
 * Testcase class for GeoInfo.
 */
class GeoInfoTest extends ZimbraMailTestCase
{
    public function testGeoInfo()
    {
        $lat = $this->faker->randomFloat;
        $lon = $this->faker->randomFloat;
        $geo = new GeoInfo($lat, $lon);
        $this->assertSame($lat, $geo->getLatitude());
        $this->assertSame($lon, $geo->getLongitude());

        $geo->setLatitude($lat)
            ->setLongitude($lon);
        $this->assertSame($lat, $geo->getLatitude());
        $this->assertSame($lon, $geo->getLongitude());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<geo lat="' . $lat . '" lon="' . $lon . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $geo);

        $array = array(
            'geo' => array(
                'lat' => $lat,
                'lon' => $lon,
            ),
        );
        $this->assertEquals($array, $geo->toArray());
    }
}
