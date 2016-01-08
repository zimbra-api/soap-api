<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\CalendarAttendee;
use Zimbra\Mail\Struct\XParam;

/**
 * Testcase class for CalendarAttendee.
 */
class CalendarAttendeeTest extends ZimbraMailTestCase
{
    public function testCalendarAttendee()
    {
        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $name2 = $this->faker->word;
        $value2 = $this->faker->word;

        $xparam1 = new XParam($name1, $value1);
        $xparam2 = new XParam($name2, $value2);

        $address = $this->faker->word;
        $url = $this->faker->word;
        $displayName = $this->faker->word;
        $sentBy = $this->faker->word;
        $dir = $this->faker->word;
        $lang = $this->faker->word;
        $cutype = $this->faker->word;
        $role = $this->faker->word;
        $member = $this->faker->word;
        $delTo = $this->faker->word;
        $delFrom = $this->faker->word;

        $cal = new CalendarAttendee(
            $address, $url, $displayName, $sentBy, $dir, $lang, $cutype, $role, ParticipationStatus::NEEDS_ACTION(), true, $member, $delTo, $delFrom, [$xparam1]
        );

        $this->assertSame([$xparam1], $cal->getXParams()->all());
        $this->assertSame($address, $cal->getAddress());
        $this->assertSame($url, $cal->getUrl());
        $this->assertSame($displayName, $cal->getDisplayName());
        $this->assertSame($sentBy, $cal->getSentBy());
        $this->assertSame($dir, $cal->getDir());
        $this->assertSame($lang, $cal->getLanguage());
        $this->assertSame($cutype, $cal->getCuType());
        $this->assertSame($role, $cal->getRole());
        $this->assertTrue($cal->getPartStat()->is('NE'));
        $this->assertTrue($cal->getRsvp());
        $this->assertSame($member, $cal->getMember());
        $this->assertSame($delTo, $cal->getDelegatedTo());
        $this->assertSame($delFrom, $cal->getDelegatedFrom());

        $cal->addXParam($xparam2);
        $this->assertSame([$xparam1, $xparam2], $cal->getXParams()->all());
        $cal->setAddress($address)
            ->setUrl($url)
            ->setDisplayName($displayName)
            ->setSentBy($sentBy)
            ->setDir($dir)
            ->setLanguage($lang)
            ->setCuType($cutype)
            ->setRole($role)
            ->setPartStat(ParticipationStatus::ACCEPT())
            ->setRsvp(true)
            ->setMember($member)
            ->setDelegatedTo($delTo)
            ->setDelegatedFrom($delFrom);
        $this->assertSame($address, $cal->getAddress());
        $this->assertSame($url, $cal->getUrl());
        $this->assertSame($displayName, $cal->getDisplayName());
        $this->assertSame($sentBy, $cal->getSentBy());
        $this->assertSame($dir, $cal->getDir());
        $this->assertSame($lang, $cal->getLanguage());
        $this->assertSame($cutype, $cal->getCuType());
        $this->assertSame($role, $cal->getRole());
        $this->assertTrue($cal->getPartStat()->is('AC'));
        $this->assertTrue($cal->getRsvp());
        $this->assertSame($member, $cal->getMember());
        $this->assertSame($delTo, $cal->getDelegatedTo());
        $this->assertSame($delFrom, $cal->getDelegatedFrom());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<at a="' . $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang . '" cutype="' . $cutype . '" role="' . $role . '" ptst="' . ParticipationStatus::ACCEPT() . '" rsvp="true" member="' . $member . '" delTo="' . $delTo . '" delFrom="' . $delFrom . '">'
                .'<xparam name="' . $name1 . '" value="' . $value1 . '" />'
                .'<xparam name="' . $name2 . '" value="' . $value2 . '" />'
            .'</at>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'at' => array(
                'a' => $address,
                'url' => $url,
                'd' => $displayName,
                'sentBy' => $sentBy,
                'dir' => $dir,
                'lang' => $lang,
                'cutype' => $cutype,
                'role' => $role,
                'ptst' => ParticipationStatus::ACCEPT()->value(),
                'rsvp' => true,
                'member' => $member,
                'delTo' => $delTo,
                'delFrom' => $delFrom,
                'xparam' => array(
                    array(
                        'name' => $name1,
                        'value' => $value1,
                    ),
                    array(
                        'name' => $name2,
                        'value' => $value2,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }
}
