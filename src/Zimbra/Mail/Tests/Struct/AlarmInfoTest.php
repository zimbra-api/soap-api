<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AlarmAction;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Mail\Struct\AlarmInfo;
use Zimbra\Mail\Struct\AlarmTriggerInfo;
use Zimbra\Mail\Struct\CalendarAttach;
use Zimbra\Mail\Struct\CalendarAttendee;
use Zimbra\Mail\Struct\DateAttr;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\XParam;
use Zimbra\Mail\Struct\XProp;

/**
 * Testcase class for AlarmInfo.
 */
class AlarmInfoTest extends ZimbraMailTestCase
{
    public function testAlarmInfo()
    {
        $date = $this->faker->iso8601;
        $name = $this->faker->word;
        $value = $this->faker->word;

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);
        $count = mt_rand(0, 99);

        $uri = $this->faker->word;
        $ct = $this->faker->word;

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

        $description = $this->faker->word;
        $summary = $this->faker->word;

        $abs = new DateAttr($date);
        $rel = new DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $count);
        $trigger = new AlarmTriggerInfo($abs, $rel);

        $repeat = new DurationInfo(false, $weeks, $days, $hours, $minutes, $seconds, $related, $count);
        $attach = new CalendarAttach($uri, $ct, $value);

        $name1 = $this->faker->word;
        $value1 = $this->faker->word;
        $xparam1 = new XParam($name1, $value1);
        $at = new CalendarAttendee(
            $address, $url, $displayName, $sentBy, $dir, $lang, $cutype, $role, ParticipationStatus::NEEDS_ACTION(), true, $member, $delTo, $delFrom, [$xparam1]
        );

        $name2 = $this->faker->word;
        $value2 = $this->faker->word;
        $xparam2 = new XParam($name2, $value2);
        $xprop = new XProp($name, $value, [$xparam2]);

        $alarm = new AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, $description, $attach, $summary, [$at], [$xprop]
        );

        $this->assertSame('DISPLAY', (string) $alarm->getAction());
        $this->assertSame($trigger, $alarm->getTrigger());
        $this->assertSame($repeat, $alarm->getRepeat());
        $this->assertSame($description, $alarm->getDescription());
        $this->assertSame($attach, $alarm->getAttach());
        $this->assertSame($summary, $alarm->getSummary());
        $this->assertSame(array($at), $alarm->getAttendees()->all());
        $this->assertSame(array($xprop), $alarm->getXProps()->all());

        $alarm->addAttendee($at);
        $alarm->addXProp($xprop);
        $this->assertSame([$at, $at], $alarm->getAttendees()->all());
        $this->assertSame([$xprop, $xprop], $alarm->getXProps()->all());
        $alarm->setAction(AlarmAction::DISPLAY())
              ->setTrigger($trigger)
              ->setRepeat($repeat)
              ->setDescription($description)
              ->setAttach($attach)
              ->setSummary($summary);
        $this->assertSame('DISPLAY', (string) $alarm->getAction());
        $this->assertSame($trigger, $alarm->getTrigger());
        $this->assertSame($repeat, $alarm->getRepeat());
        $this->assertSame($description, $alarm->getDescription());
        $this->assertSame($attach, $alarm->getAttach());
        $this->assertSame($summary, $alarm->getSummary());

        $alarm->getAttendees()->remove(1);
        $alarm->getXProps()->remove(1);

        $rel = new DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $count);
        $xml = '<?xml version="1.0"?>' . "\n"
            .'<alarm action="' . AlarmAction::DISPLAY() . '">'
                .'<trigger>'
                    .'<abs d="' . $date . '" />'
                    .'<rel neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
                .'</trigger>'
                .'<repeat neg="false" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $count . '" />'
                .'<desc>' . $description . '</desc>'
                .'<attach uri="' . $uri . '" ct="' . $ct . '">' . $value . '</attach>'
                .'<summary>' . $summary . '</summary>'
                .'<at a="' . $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang . '" cutype="' . $cutype . '" role="' . $role . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rsvp="true" member="' . $member . '" delTo="' . $delTo . '" delFrom="' . $delFrom . '">'
                    .'<xparam name="' . $name1 . '" value="' . $value1 . '" />'
                .'</at>'
                .'<xprop name="' . $name . '" value="' . $value . '">'
                    .'<xparam name="' . $name2 . '" value="' . $value2 . '" />'
                .'</xprop>'
            .'</alarm>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'action' => AlarmAction::DISPLAY()->value(),
                'trigger' => array(
                    'abs' => array(
                        'd' => $date,
                    ),
                    'rel' => array(
                        'neg' => true,
                        'w' => $weeks,
                        'd' => $days,
                        'h' => $hours,
                        'm' => $minutes,
                        's' => $seconds,
                        'related' => $related,
                        'count' => $count,
                    ),
                ),
                'repeat' => array(
                    'neg' => false,
                    'w' => $weeks,
                    'd' => $days,
                    'h' => $hours,
                    'm' => $minutes,
                    's' => $seconds,
                    'related' => $related,
                    'count' => $count,
                ),
                'desc' => $description,
                'attach' => array(
                    'uri' => $uri,
                    'ct' => $ct,
                    '_content' => $value,
                ),
                'summary' => $summary,
                'at' => array(
                    array(
                        'a' => $address,
                        'url' => $url,
                        'd' => $displayName,
                        'sentBy' => $sentBy,
                        'dir' => $dir,
                        'lang' => $lang,
                        'cutype' => $cutype,
                        'role' => $role,
                        'ptst' => ParticipationStatus::NEEDS_ACTION()->value(),
                        'rsvp' => true,
                        'member' => $member,
                        'delTo' => $delTo,
                        'delFrom' => $delFrom,
                        'xparam' => array(
                            array(
                                'name' => $name1,
                                'value' => $value1,
                            ),
                        ),
                    ),
                ),
                'xprop' => array(
                    array(
                        'name' => $name,
                        'value' => $value,
                        'xparam' => array(
                            array(
                                'name' => $name2,
                                'value' => $value2,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }
}
