<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Enum\ParticipationStatus as PartStat;
use Zimbra\Mail\Struct\CalendarAttendee;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarAttendee.
 */
class CalendarAttendeeTest extends ZimbraTestCase
{
    public function testCalendarAttendee()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $address = $this->faker->email;
        $url = $this->faker->url;
        $displayName = $this->faker->name;
        $sentBy = $this->faker->email;
        $dir = $this->faker->word;
        $language = $this->faker->word;
        $cuType = $this->faker->word;
        $role = $this->faker->word;
        $partStat = PartStat::ACCEPT();
        $member = $this->faker->word;
        $delegatedTo = $this->faker->email;
        $delegatedFrom = $this->faker->word;

        $xparam = new XParam($name, $value);

        $at = new CalendarAttendee($address, $displayName, $role, $partStat, FALSE, [$xparam]);
        $this->assertSame($address, $at->getAddress());
        $this->assertSame($displayName, $at->getDisplayName());
        $this->assertSame($role, $at->getRole());
        $this->assertSame($partStat, $at->getPartStat());
        $this->assertFalse($at->getRsvp());
        $this->assertSame([$xparam], $at->getXParams());

        $at = new CalendarAttendee();
        $at->setAddress($address)
            ->setUrl($url)
            ->setDisplayName($displayName)
            ->setSentBy($sentBy)
            ->setDir($dir)
            ->setLanguage($language)
            ->setCuType($cuType)
            ->setRole($role)
            ->setPartStat($partStat)
            ->setRsvp(TRUE)
            ->setMember($member)
            ->setDelegatedTo($delegatedTo)
            ->setDelegatedFrom($delegatedFrom)
            ->setXParams([$xparam])
            ->addXParam($xparam);
        $this->assertSame($address, $at->getAddress());
        $this->assertSame($url, $at->getUrl());
        $this->assertSame($displayName, $at->getDisplayName());
        $this->assertSame($sentBy, $at->getSentBy());
        $this->assertSame($dir, $at->getDir());
        $this->assertSame($language, $at->getLanguage());
        $this->assertSame($cuType, $at->getCuType());
        $this->assertSame($role, $at->getRole());
        $this->assertSame($partStat, $at->getPartStat());
        $this->assertTrue($at->getRsvp());
        $this->assertSame($member, $at->getMember());
        $this->assertSame($delegatedTo, $at->getDelegatedTo());
        $this->assertSame($delegatedFrom, $at->getDelegatedFrom());
        $this->assertSame([$xparam, $xparam], $at->getXParams());
        $at->setXParams([$xparam]);

        $xml = <<<EOT
<?xml version="1.0"?>
<at a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language" cutype="$cuType" role="$role" ptst="AC" rsvp="true" member="$member" delegatedTo="$delegatedTo" delegatedFrom="$delegatedFrom">
    <xparam name="$name" value="$value" />
</at>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($at, 'xml'));
        $this->assertEquals($at, $this->serializer->deserialize($xml, CalendarAttendee::class, 'xml'));

        $json = json_encode([
            'a' => $address,
            'url' => $url,
            'd' => $displayName,
            'sentBy' => $sentBy,
            'dir' => $dir,
            'lang' => $language,
            'cutype' => $cuType,
            'role' => $role,
            'ptst' => 'AC',
            'rsvp' => TRUE,
            'member' => $member,
            'delegatedTo' => $delegatedTo,
            'delegatedFrom' => $delegatedFrom,
            'xparam' => [
                [
                    'name' => $name,
                    'value' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($at, 'json'));
        $this->assertEquals($at, $this->serializer->deserialize($json, CalendarAttendee::class, 'json'));
    }
}
