<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

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
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $category1 = $this->faker->unique()->word;
        $category2 = $this->faker->unique()->word;
        $comment1 = $this->faker->unique()->word;
        $comment2 = $this->faker->unique()->word;
        $contact1 = $this->faker->unique()->email;
        $contact2 = $this->faker->unique()->email;
        $latitude = (string) $this->faker->latitude;
        $longitude = (string) $this->faker->longitude;
        $fragment = $this->faker->text;
        $description = $this->faker->text;
        $htmlDescription = $this->faker->text;

        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $displayName = $this->faker->name;
        $role = $this->faker->word;
        $url = $this->faker->url;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->locale;
        $dateTime = $this->faker->date;
        $timezone = $this->faker->timezone;
        $recurrenceRangeType = mt_rand(1, 3);
        $utcTime = time();
        $weeks = mt_rand(1, 100);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);

        $geo = new GeoInfo($latitude, $longitude);
        $organizer = new CalOrganizer($address, $url, $displayName, $sentBy, $dir, $language, [new XParam($name, $value)]);

        $data = new LegacyInstanceDataInfo(
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

        $data = new LegacyInstanceDataInfo();
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
<result s="$startTime" ex="true">
    <or a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language">
        <xparam name="$name" value="$value" />
    </or>
    <category>$category1</category>
    <category>$category2</category>
    <geo lat="$latitude" lon="$longitude" />
    <fr>$fragment</fr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, LegacyInstanceDataInfo::class, 'xml'));

        $json = json_encode([
            's' => $startTime,
            'ex' => TRUE,
            'or' => [
                'a' => $address,
                'url' => $url,
                'd' => $displayName,
                'sentBy' => $sentBy,
                'dir' => $dir,
                'lang' => $language,
                'xparam' => [
                    [
                        'name' => $name,
                        'value' => $value,
                    ],
                ],
            ],
            'category' => [
                [
                    '_content' => $category1,
                ],
                [
                    '_content' => $category2,
                ],
            ],
            'geo' => [
                'lat' => $latitude,
                'lon' => $longitude,
            ],
            'fr' => [
                '_content' => $fragment,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($data, 'json'));
        $this->assertEquals($data, $this->serializer->deserialize($json, LegacyInstanceDataInfo::class, 'json'));
    }
}
