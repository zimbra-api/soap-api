<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Mail\Struct\InstanceDataInterface;
use Zimbra\Mail\Struct\LegacyInstanceDataAttrs;
use Zimbra\Mail\Struct\LegacyInstanceDataInfo;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for LegacyInstanceDataInfo.
 */
class LegacyInstanceDataInfoTest extends ZimbraTestCase
{
    public function testLegacyInstanceDataInfo()
    {
        $startTime = $this->faker->randomNumber;
        $category1 = $this->faker->unique()->word;
        $category2 = $this->faker->unique()->word;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;

        $geo = new GeoInfo($latitude, $longitude);
        $organizer = new CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]);

        $data = new StubLegacyInstanceDataInfo(
            $startTime, FALSE, $organizer, [$category1, $category2], $geo, $fragment
        );
        $this->assertTrue($data instanceof InstanceDataInterface);
        $this->assertTrue($data instanceof LegacyInstanceDataAttrs);

        $this->assertSame($startTime, $data->getStartTime());
        $this->assertFalse($data->getIsException());
        $this->assertSame($organizer, $data->getOrganizer());
        $this->assertSame([$category1, $category2], $data->getCategories());
        $this->assertSame($geo, $data->getGeo());
        $this->assertSame($fragment, $data->getFragment());

        $data = new StubLegacyInstanceDataInfo();
        $data->setCategories([$category1])
            ->addCategory($category2)
            ->setGeo($geo)
            ->setOrganizer($organizer)
            ->setStartTime($startTime)
            ->setFragment($fragment)
            ->setIsException(TRUE);
        $this->assertSame($startTime, $data->getStartTime());
        $this->assertTrue($data->getIsException());
        $this->assertSame($organizer, $data->getOrganizer());
        $this->assertSame([$category1, $category2], $data->getCategories());
        $this->assertSame($geo, $data->getGeo());
        $this->assertSame($fragment, $data->getFragment());

        $xml = <<<EOT
<?xml version="1.0"?>
<result s="$startTime" ex="true" xmlns:urn="urn:zimbraMail">
    <urn:or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <urn:xparam name="$name" value="$value" />
    </urn:or>
    <urn:category>$category1</urn:category>
    <urn:category>$category2</urn:category>
    <urn:geo lat="$latitude" lon="$longitude" />
    <urn:fr>$fragment</urn:fr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, StubLegacyInstanceDataInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubLegacyInstanceDataInfo extends LegacyInstanceDataInfo
{
}
