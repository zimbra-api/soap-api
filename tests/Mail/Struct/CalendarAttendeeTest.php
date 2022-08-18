<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\ParticipationStatus as PartStat;
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
        $partStat = PartStat::ACCEPT;
        $member = $this->faker->word;
        $delegatedTo = $this->faker->email;
        $delegatedFrom = $this->faker->word;

        $xparam = new XParam($name, $value);

        $at = new StubCalendarAttendee($address, $displayName, $role, $partStat, FALSE, [$xparam]);
        $this->assertSame($address, $at->getAddress());
        $this->assertSame($displayName, $at->getDisplayName());
        $this->assertSame($role, $at->getRole());
        $this->assertSame($partStat, $at->getPartStat());
        $this->assertFalse($at->getRsvp());
        $this->assertSame([$xparam], $at->getXParams());

        $at = new StubCalendarAttendee();
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
<result a="$address" url="$url" d="$displayName" sentBy="$sentBy" dir="$dir" lang="$language" cutype="$cuType" role="$role" ptst="AC" rsvp="true" member="$member" delegatedTo="$delegatedTo" delegatedFrom="$delegatedFrom" xmlns:urn="urn:zimbraMail">
    <urn:xparam name="$name" value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($at, 'xml'));
        $this->assertEquals($at, $this->serializer->deserialize($xml, StubCalendarAttendee::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubCalendarAttendee extends CalendarAttendee
{
}
