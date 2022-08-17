<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\InstanceDataInfo;
use Zimbra\Mail\Struct\CalOrganizer;
use Zimbra\Mail\Struct\GeoInfo;
use Zimbra\Mail\Struct\XParam;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InstanceDataInfo.
 */
class InstanceDataInfoTest extends ZimbraTestCase
{
    public function testInstanceDataInfo()
    {
        $startTime = $this->faker->unixTime;
        $category1 = $this->faker->unique->word;
        $category2 = $this->faker->unique->word;
        $fragment = $this->faker->word;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $url = $this->faker->url;
        $displayName = $this->faker->name;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;

        $organizer = new CalOrganizer(
            $address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]
        );
        $geo = new GeoInfo($latitude, $longitude);

        $inst = new StubInstanceDataInfo(
            $startTime, FALSE, $organizer, [$category1, $category2], $geo, $fragment
        );
        $this->assertSame($startTime, $inst->getStartTime());
        $this->assertFalse($inst->getIsException());
        $this->assertSame($organizer, $inst->getOrganizer());
        $this->assertSame([$category1, $category2], $inst->getCategories());
        $this->assertSame($geo, $inst->getGeo());
        $this->assertSame($fragment, $inst->getFragment());

        $inst = new StubInstanceDataInfo();
        $inst->setStartTime($startTime)
            ->setIsException(TRUE)
            ->setOrganizer($organizer)
            ->setCategories([$category1])
            ->addCategory($category2)
            ->setGeo($geo)
            ->setFragment($fragment);
        $this->assertSame($startTime, $inst->getStartTime());
        $this->assertTrue($inst->getIsException());
        $this->assertSame($organizer, $inst->getOrganizer());
        $this->assertSame([$category1, $category2], $inst->getCategories());
        $this->assertSame($geo, $inst->getGeo());
        $this->assertSame($fragment, $inst->getFragment());

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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inst, 'xml'));
        $this->assertEquals($inst, $this->serializer->deserialize($xml, StubInstanceDataInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubInstanceDataInfo extends InstanceDataInfo
{
}
