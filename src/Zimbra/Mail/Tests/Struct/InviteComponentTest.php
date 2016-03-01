<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AlarmAction;
use Zimbra\Enum\FreeBusyStatus;
use Zimbra\Enum\Frequency;
use Zimbra\Enum\InviteClass;
use Zimbra\Enum\InviteChange;
use Zimbra\Enum\InviteStatus;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\RangeType;
use Zimbra\Enum\Transparency;
use Zimbra\Enum\WeekDay;

/**
 * Testcase class for InviteComponent.
 */
class InviteComponentTest extends ZimbraMailTestCase
{
    public function testInviteComponent()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

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

        $date = $this->faker->iso8601;

        $uri = $this->faker->word;
        $ct = $this->faker->word;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);
        $rangeType = mt_rand(1, 10);

        $weeks = mt_rand(1, 7);
        $days = mt_rand(1, 30);
        $hours = mt_rand(0, 23);
        $minutes = mt_rand(0, 59);
        $seconds = mt_rand(0, 59);
        $related = $this->faker->randomElement(['START', 'END']);

        $ordwk  = mt_rand(1, 54);
        $num = mt_rand(1, 1000);

        $quantity = mt_rand(5, 10);
        $numbers = self::randomRange(0, 59, $quantity);
        $seclist = $minlist = implode(',', $numbers);
        $numbers = self::randomRange(0, 23, $quantity);
        $hrlist = implode(',', $numbers);
        $numbers = self::randomRange(1, 31, $quantity);
        $modaylist = implode(',', $numbers);
        $numbers = self::randomRange(1, 366, $quantity);
        $yrdaylist = implode(',', $numbers);
        $numbers = self::randomRange(1, 53, $quantity);
        $wklist = implode(',', $numbers);
        $numbers = self::randomRange(1, 12, $quantity);
        $molist = implode(',', $numbers);
        $numbers = self::randomRange(1, 366, $quantity);
        $poslist = implode(',', $numbers);

        $lat = $this->faker->randomFloat;
        $lon = $this->faker->randomFloat;
        $desc = $this->faker->word;
        $summary = $this->faker->word;

        $method = $this->faker->word;
        $loc = $this->faker->word;

        $x_uid = $this->faker->uuid;
        $uid = $this->faker->uuid;

        $compNum = mt_rand(1, 10);
        $priority = mt_rand(1, 10);
        $percent = mt_rand(1, 100);
        $seq = mt_rand(1, 10);
        $d = mt_rand(1, 10);

        $calItemId = $this->faker->word;
        $apptId = $this->faker->word;
        $ciFolder = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $category = $this->faker->word;
        $comment = $this->faker->word;
        $contact = $this->faker->word;

        $fr = $this->faker->word;
        $descHtml = $this->faker->word;

        $xparam = new \Zimbra\Mail\Struct\XParam($name, $value);
        $at = new \Zimbra\Mail\Struct\CalendarAttendee(
            $address, $url, $displayName, $sentBy, $dir, $lang, $cutype, $role, ParticipationStatus::NEEDS_ACTION(), true, $member, $delTo, $delFrom, [$xparam]
        );
        $abs = new \Zimbra\Mail\Struct\DateAttr($date);
        $rel = new \Zimbra\Mail\Struct\DurationInfo(true, $weeks, $days, $hours, $minutes, $seconds, $related, $num);
        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo($abs, $rel);
        $repeat = new \Zimbra\Mail\Struct\DurationInfo(false, $weeks, $days, $hours, $minutes, $seconds, $related, $num);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach($uri, $ct, $value);
        $except = new \Zimbra\Mail\Struct\ExceptionRuleInfo(
            $rangeType, $date, null, null, $tz, $ridZ
        );
        $cancel = new \Zimbra\Mail\Struct\CancelRuleInfo(
            $rangeType, $date, $tz, $ridZ
        );
        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            $date, $tz, $utc
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(
            true, $weeks, $days, $hours, $minutes, $seconds, $related, $num
        );
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Mail\Struct\SingleDates($tz, [$dtval]);
        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), $ordwk);
        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr($date);
        $count = new \Zimbra\Mail\Struct\NumAttr($num);
        $interval = new \Zimbra\Mail\Struct\IntervalRule($num);
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule($seclist);
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule($seclist);
        $byhour = new \Zimbra\Mail\Struct\ByHourRule($hrlist);
        $byday = new \Zimbra\Mail\Struct\ByDayRule([$wkday]);
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule($modaylist);
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule($yrdaylist);
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule($wklist);
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule($molist);
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule($poslist);
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Mail\Struct\XNameRule($name, $value);
        $rule = new \Zimbra\Mail\Struct\SimpleRepeatingRule(
            Frequency::SECOND(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            [$xname]
        );
        $add = new \Zimbra\Mail\Struct\AddRecurrenceInfo([$except, $cancel, $dates, $rule]);
        $exclude = new \Zimbra\Mail\Struct\ExcludeRecurrenceInfo([$except, $cancel, $dates, $rule]);

        $geo = new \Zimbra\Mail\Struct\GeoInfo($lat, $lon);
        $xprop = new \Zimbra\Mail\Struct\XProp($name, $value, [$xparam]);
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, $desc, $attach, $summary, [$at], [$xprop]
        );

        $org = new \Zimbra\Mail\Struct\CalOrganizer(
            $address, $url, $displayName, $sentBy, $dir, $lang, [$xparam]
        );
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo([$add, $exclude, $except, $cancel, $dates, $rule]);
        $exceptId = new \Zimbra\Mail\Struct\ExceptionRecurIdInfo(
            $date, $tz, RangeType::NONE()
        );

        $comp = new \Zimbra\Mail\Struct\InviteComponent(
            $method,
            $compNum,
            true,
            $priority,
            $name,
            $loc,
            $percent,
            $date,
            true,
            FreeBusyStatus::FREE(),
            FreeBusyStatus::FREE(),
            Transparency::OPAQUE(),
            true,
            $x_uid,
            $uid,
            $seq,
            $d,
            $calItemId,
            $apptId,
            $ciFolder,
            InviteStatus::COMPLETED(),
            InviteClass::PUB(),
            $url,
            true,
            $ridZ,
            true,
            true,
            true,
            [InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()],
            [$category],
            [$comment],
            [$contact],
            $geo,
            [$at],
            [$alarm],
            [$xprop],
            $fr,
            $desc,
            $descHtml,
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $this->assertSame([$category], $comp->getCategories()->all());
        $this->assertSame([$comment], $comp->getComments()->all());
        $this->assertSame([$contact], $comp->getContacts()->all());
        $this->assertSame($geo, $comp->getGeo());
        $this->assertSame([$at], $comp->getAttendees()->all());
        $this->assertSame([$alarm], $comp->getAlarms()->all());
        $this->assertSame([$xprop], $comp->getXProps()->all());
        $this->assertSame($fr, $comp->getFragment());
        $this->assertSame($desc, $comp->getDescription());
        $this->assertSame($descHtml, $comp->getHtmlDescription());
        $this->assertSame($org, $comp->getOrganizer());
        $this->assertSame($recur, $comp->getRecurrence());
        $this->assertSame($exceptId, $comp->getExceptionId());
        $this->assertSame($s, $comp->getDtStart());
        $this->assertSame($e, $comp->getDtEnd());
        $this->assertSame($dur, $comp->getDuration());

        $comp->addCategory($category)
             ->addComment($comment)
             ->addContact($contact)
             ->setGeo($geo)
             ->addAttendee($at)
             ->addAlarm($alarm)
             ->addXProp($xprop)
             ->setFragment($fr)
             ->setDescription($desc)
             ->setHtmlDescription($descHtml)
             ->setOrganizer($org)
             ->setRecurrence($recur)
             ->setExceptionId($exceptId)
             ->setDtStart($s)
             ->setDtEnd($e)
             ->setDuration($dur);
        $this->assertSame([$category, $category], $comp->getCategories()->all());
        $this->assertSame([$comment, $comment], $comp->getComments()->all());
        $this->assertSame([$contact, $contact], $comp->getContacts()->all());
        $this->assertSame($geo, $comp->getGeo());
        $this->assertSame([$at, $at], $comp->getAttendees()->all());
        $this->assertSame([$alarm, $alarm], $comp->getAlarms()->all());
        $this->assertSame([$xprop, $xprop], $comp->getXProps()->all());
        $this->assertSame($fr, $comp->getFragment());
        $this->assertSame($desc, $comp->getDescription());
        $this->assertSame($descHtml, $comp->getHtmlDescription());
        $this->assertSame($org, $comp->getOrganizer());
        $this->assertSame($recur, $comp->getRecurrence());
        $this->assertSame($exceptId, $comp->getExceptionId());
        $this->assertSame($s, $comp->getDtStart());
        $this->assertSame($e, $comp->getDtEnd());
        $this->assertSame($dur, $comp->getDuration());

        $comp = new \Zimbra\Mail\Struct\InviteComponent(
            $method,
            $compNum,
            true,
            $priority,
            $name,
            $loc,
            $percent,
            $date,
            true,
            FreeBusyStatus::FREE(),
            FreeBusyStatus::FREE(),
            Transparency::OPAQUE(),
            true,
            $x_uid,
            $uid,
            $seq,
            $d,
            $calItemId,
            $apptId,
            $ciFolder,
            InviteStatus::COMPLETED(),
            InviteClass::PUB(),
            $url,
            true,
            $ridZ,
            true,
            true,
            true,
            [InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()],
            [$category],
            [$comment],
            [$contact],
            $geo,
            [$at],
            [$alarm],
            [$xprop],
            $fr,
            $desc,
            $descHtml,
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<comp'
                . ' method="' . $method . '"'
                . ' compNum="' . $compNum . '"'
                . ' rsvp="true"'
                . ' priority="' . $priority . '"'
                . ' name="' . $name . '"'
                . ' loc="' . $loc . '"'
                . ' percentComplete="' . $percent . '"'
                . ' completed="' . $date . '"'
                . ' noBlob="true"'
                . ' fba="' . FreeBusyStatus::FREE() . '"'
                . ' fb="' . FreeBusyStatus::FREE() . '"'
                . ' transp="' . Transparency::OPAQUE() . '"'
                . ' isOrg="true"'
                . ' x_uid="' . $x_uid . '"'
                . ' uid="' . $uid . '"'
                . ' seq="' . $seq . '"'
                . ' d="' . $d . '"'
                . ' calItemId="' . $calItemId . '"'
                . ' apptId="' . $apptId . '"'
                . ' ciFolder="' . $ciFolder . '"'
                . ' status="' . InviteStatus::COMPLETED() . '"'
                . ' class="' . InviteClass::PUB() . '"'
                . ' url="' . $url . '"'
                . ' ex="true"'
                . ' ridZ="' . $ridZ . '"'
                . ' allDay="true"'
                . ' draft="true"'
                . ' neverSent="true"'
                . ' changes="' . InviteChange::SUBJECT() . ',' . InviteChange::LOCATION() . ',' . InviteChange::TIME() . '">'
                . '<geo lat="' . $lat . '" lon="' . $lon . '" />'
                . '<fr>' . $fr . '</fr>'
                . '<desc>' . $desc . '</desc>'
                . '<descHtml>' . $descHtml . '</descHtml>'
                . '<or a="'. $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang . '">'
                    . '<xparam name="' . $name . '" value="' . $value . '" />'
                . '</or>'
                . '<recur>'
                    . '<add>'
                        . '<except rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                        . '<cancel rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                        . '<dates tz="' . $tz . '">'
                            . '<dtval>'
                                . '<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                                . '<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                                . '<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                            . '</dtval>'
                        . '</dates>'
                        . '<rule freq="' . Frequency::SECOND() . '">'
                            . '<until d="' . $date . '" />'
                            . '<count num="' . $num . '" />'
                            . '<interval ival="' . $num . '" />'
                            . '<bysecond seclist="' . $seclist . '" />'
                            . '<byminute minlist="' . $minlist . '" />'
                            . '<byhour hrlist="' . $hrlist . '" />'
                            . '<byday>'
                                . '<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk . '" />'
                            . '</byday>'
                            . '<bymonthday modaylist="' . $modaylist . '" />'
                            . '<byyearday yrdaylist="' . $yrdaylist . '" />'
                            . '<byweekno wklist="' . $wklist . '" />'
                            . '<bymonth molist="' . $molist . '" />'
                            . '<bysetpos poslist="' . $poslist . '" />'
                            . '<wkst day="' . WeekDay::SU() . '" />'
                            . '<rule-x-name name="' . $name . '" value="' . $value . '" />'
                        . '</rule>'
                    . '</add>'
                    . '<exclude>'
                        . '<except rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                        . '<cancel rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                        . '<dates tz="' . $tz . '">'
                            . '<dtval>'
                                . '<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                                . '<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                                . '<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                            . '</dtval>'
                        . '</dates>'
                        . '<rule freq="' . Frequency::SECOND() . '">'
                            . '<until d="' . $date . '" />'
                            . '<count num="' . $num . '" />'
                            . '<interval ival="' . $num . '" />'
                            . '<bysecond seclist="' . $seclist . '" />'
                            . '<byminute minlist="' . $minlist . '" />'
                            . '<byhour hrlist="' . $hrlist . '" />'
                            . '<byday>'
                                . '<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk . '" />'
                            . '</byday>'
                            . '<bymonthday modaylist="' . $modaylist . '" />'
                            . '<byyearday yrdaylist="' . $yrdaylist . '" />'
                            . '<byweekno wklist="' . $wklist . '" />'
                            . '<bymonth molist="' . $molist . '" />'
                            . '<bysetpos poslist="' . $poslist . '" />'
                            . '<wkst day="' . WeekDay::SU() . '" />'
                            . '<rule-x-name name="' . $name . '" value="' . $value . '" />'
                        . '</rule>'
                    . '</exclude>'
                    . '<except rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    . '<cancel rangeType="' . $rangeType . '" recurId="' . $date . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                    . '<dates tz="' . $tz . '">'
                        . '<dtval>'
                            . '<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            . '<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                            . '<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                        . '</dtval>'
                    . '</dates>'
                    . '<rule freq="' . Frequency::SECOND() . '">'
                        . '<until d="' . $date . '" />'
                        . '<count num="' . $num . '" />'
                        . '<interval ival="' . $num . '" />'
                        . '<bysecond seclist="' . $seclist . '" />'
                        . '<byminute minlist="' . $minlist . '" />'
                        . '<byhour hrlist="' . $hrlist . '" />'
                        . '<byday>'
                            . '<wkday day="' . WeekDay::SU() . '" ordwk="' . $ordwk . '" />'
                        . '</byday>'
                        . '<bymonthday modaylist="' . $modaylist . '" />'
                        . '<byyearday yrdaylist="' . $yrdaylist . '" />'
                        . '<byweekno wklist="' . $wklist . '" />'
                        . '<bymonth molist="' . $molist . '" />'
                        . '<bysetpos poslist="' . $poslist . '" />'
                        . '<wkst day="' . WeekDay::SU() . '" />'
                        . '<rule-x-name name="' . $name . '" value="' . $value . '" />'
                    . '</rule>'
                . '</recur>'
                . '<exceptId d="' . $date . '" tz="' . $tz . '" rangeType="' . RangeType::NONE() . '" />'
                . '<s d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                . '<e d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                . '<dur neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                . '<category>' . $category . '</category>'
                . '<comment>' . $comment . '</comment>'
                . '<contact>' . $contact . '</contact>'
                . '<at a="' . $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang . '" cutype="' . $cutype . '" role="' . $role . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rsvp="true" member="' . $member . '" delTo="' . $delTo . '" delFrom="' . $delFrom . '">'
                    . '<xparam name="' . $name . '" value="' . $value . '" />'
                . '</at>'
                . '<alarm action="' . AlarmAction::DISPLAY() . '">'
                    . '<trigger>'
                        . '<abs d="' . $date . '" />'
                        . '<rel neg="true" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                    . '</trigger>'
                    . '<repeat neg="false" w="' . $weeks . '" d="' . $days . '" h="' . $hours . '" m="' . $minutes . '" s="' . $seconds . '" related="' . $related . '" count="' . $num . '" />'
                    . '<desc>' . $desc . '</desc>'
                    . '<attach uri="' . $uri . '" ct="' . $ct . '">' . $value . '</attach>'
                    . '<summary>' . $summary . '</summary>'
                    . '<at a="' . $address . '" url="' . $url . '" d="' . $displayName . '" sentBy="' . $sentBy . '" dir="' . $dir . '" lang="' . $lang  . '" cutype="' . $cutype . '" role="' . $role . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rsvp="true" member="' . $member . '" delTo="' . $delTo . '" delFrom="' . $delFrom . '">'
                        . '<xparam name="' . $name . '" value="' . $value . '" />'
                    . '</at>'
                    . '<xprop name="' . $name . '" value="' . $value . '">'
                        . '<xparam name="' . $name . '" value="' . $value . '" />'
                    . '</xprop>'
                . '</alarm>'
                . '<xprop name="' . $name . '" value="' . $value . '">'
                    . '<xparam name="' . $name . '" value="' . $value . '" />'
                . '</xprop>'
            . '</comp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => $method,
                'compNum' => $compNum,
                'rsvp' => true,
                'priority' => $priority,
                'name' => $name,
                'loc' => $loc,
                'percentComplete' => $percent,
                'completed' => $date,
                'noBlob' => true,
                'fba' => FreeBusyStatus::FREE()->value(),
                'fb' => FreeBusyStatus::FREE()->value(),
                'transp' => Transparency::OPAQUE()->value(),
                'isOrg' => true,
                'x_uid' => $x_uid,
                'uid' => $uid,
                'seq' => $seq,
                'd' => $d,
                'calItemId' => $calItemId,
                'apptId' => $apptId,
                'ciFolder' => $ciFolder,
                'status' =>  InviteStatus::COMPLETED()->value(),
                'class' => InviteClass::PUB()->value(),
                'url' => $url,
                'ex' => true,
                'ridZ' => $ridZ,
                'allDay' => true,
                'draft' => true,
                'neverSent' => true,
                'changes' => InviteChange::SUBJECT()->value() . ',' . InviteChange::LOCATION()->value() . ',' . InviteChange::TIME()->value(),
                'category' => array(
                    $category,
                ),
                'comment' => array(
                    $comment,
                ),
                'contact' => array(
                    $contact,
                ),
                'geo' => array(
                    'lat' => $lat,
                    'lon' => $lon,
                ),
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
                                'name' => $name,
                                'value' => $value,
                            ),
                        ),
                    ),
                ),
                'alarm' => array(
                    array(
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
                                'count' => $num,
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
                            'count' => $num,
                        ),
                        'desc' => $desc,
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
                                        'name' => $name,
                                        'value' => $value,
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
                                        'name' => $name,
                                        'value' => $value,
                                    ),
                                ),
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
                                'name' => $name,
                                'value' => $value,
                            ),
                        ),
                    ),
                ),
                'fr' => $fr,
                'desc' => $desc,
                'descHtml' => $descHtml,
                'or' => array(
                    'a' => $address,
                    'url' => $url,
                    'd' => $displayName,
                    'sentBy' => $sentBy,
                    'dir' => $dir,
                    'lang' => $lang,
                    'xparam' => array(
                        array(
                            'name' => $name,
                            'value' => $value,
                        ),
                    ),
                ),
                'recur' => array(
                    'add' => array(
                        'except' => array(
                            'rangeType' => $rangeType,
                            'recurId' => $date,
                            'tz' => $tz,
                            'ridZ' => $ridZ,
                        ),
                        'cancel' => array(
                            'rangeType' => $rangeType,
                            'recurId' => $date,
                            'tz' => $tz,
                            'ridZ' => $ridZ,
                        ),
                        'dates' => array(
                            'tz' => $tz,
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => $date,
                                        'tz' => $tz,
                                        'u' => $utc,
                                    ),
                                    'e' => array(
                                        'd' => $date,
                                        'tz' => $tz,
                                        'u' => $utc,
                                    ),
                                    'dur' => array(
                                        'neg' => true,
                                        'w' => $weeks,
                                        'd' => $days,
                                        'h' => $hours,
                                        'm' => $minutes,
                                        's' => $seconds,
                                        'related' => $related,
                                        'count' => $num,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => Frequency::SECOND()->value(),
                            'until' => array(
                                'd' => $date,
                            ),
                            'count' => array(
                                'num' => $num,
                            ),
                            'interval' => array(
                                'ival' => $num,
                            ),
                            'bysecond' => array(
                                'seclist' => $seclist,
                            ),
                            'byminute' => array(
                                'minlist' => $minlist,
                            ),
                            'byhour' => array(
                                'hrlist' => $hrlist,
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => WeekDay::SU()->value(),
                                        'ordwk' => $ordwk,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => $modaylist,
                            ),
                            'byyearday' => array(
                                'yrdaylist' => $yrdaylist,
                            ),
                            'byweekno' => array(
                                'wklist' => $wklist,
                            ),
                            'bymonth' => array(
                                'molist' => $molist,
                            ),
                            'bysetpos' => array(
                                'poslist' => $poslist,
                            ),
                            'wkst' => array(
                                'day' => WeekDay::SU()->value(),
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => $name,
                                    'value' => $value,
                                ),
                            ),
                        ),
                    ),
                    'exclude' => array(
                        'except' => array(
                            'rangeType' => $rangeType,
                            'recurId' => $date,
                            'tz' => $tz,
                            'ridZ' => $ridZ,
                        ),
                        'cancel' => array(
                            'rangeType' => $rangeType,
                            'recurId' => $date,
                            'tz' => $tz,
                            'ridZ' => $ridZ,
                        ),
                        'dates' => array(
                            'tz' => $tz,
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => $date,
                                        'tz' => $tz,
                                        'u' => $utc,
                                    ),
                                    'e' => array(
                                        'd' => $date,
                                        'tz' => $tz,
                                        'u' => $utc,
                                    ),
                                    'dur' => array(
                                        'neg' => true,
                                        'w' => $weeks,
                                        'd' => $days,
                                        'h' => $hours,
                                        'm' => $minutes,
                                        's' => $seconds,
                                        'related' => $related,
                                        'count' => $num,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => Frequency::SECOND()->value(),
                            'until' => array(
                                'd' => $date,
                            ),
                            'count' => array(
                                'num' => $num,
                            ),
                            'interval' => array(
                                'ival' => $num,
                            ),
                            'bysecond' => array(
                                'seclist' => $seclist,
                            ),
                            'byminute' => array(
                                'minlist' => $minlist,
                            ),
                            'byhour' => array(
                                'hrlist' => $hrlist,
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => WeekDay::SU()->value(),
                                        'ordwk' => $ordwk,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => $modaylist,
                            ),
                            'byyearday' => array(
                                'yrdaylist' => $yrdaylist,
                            ),
                            'byweekno' => array(
                                'wklist' => $wklist,
                            ),
                            'bymonth' => array(
                                'molist' => $molist,
                            ),
                            'bysetpos' => array(
                                'poslist' => $poslist,
                            ),
                            'wkst' => array(
                                'day' => WeekDay::SU()->value(),
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => $name,
                                    'value' => $value,
                                ),
                            ),
                        ),
                    ),
                    'except' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $date,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'cancel' => array(
                        'rangeType' => $rangeType,
                        'recurId' => $date,
                        'tz' => $tz,
                        'ridZ' => $ridZ,
                    ),
                    'dates' => array(
                        'tz' => $tz,
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'e' => array(
                                    'd' => $date,
                                    'tz' => $tz,
                                    'u' => $utc,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => $weeks,
                                    'd' => $days,
                                    'h' => $hours,
                                    'm' => $minutes,
                                    's' => $seconds,
                                    'related' => $related,
                                    'count' => $num,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => Frequency::SECOND()->value(),
                        'until' => array(
                            'd' => $date,
                        ),
                        'count' => array(
                            'num' => $num,
                        ),
                        'interval' => array(
                            'ival' => $num,
                        ),
                        'bysecond' => array(
                            'seclist' => $seclist,
                        ),
                        'byminute' => array(
                            'minlist' => $minlist,
                        ),
                        'byhour' => array(
                            'hrlist' => $hrlist,
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => WeekDay::SU()->value(),
                                    'ordwk' => $ordwk,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => $modaylist,
                        ),
                        'byyearday' => array(
                            'yrdaylist' => $yrdaylist,
                        ),
                        'byweekno' => array(
                            'wklist' => $wklist,
                        ),
                        'bymonth' => array(
                            'molist' => $molist,
                        ),
                        'bysetpos' => array(
                            'poslist' => $poslist,
                        ),
                        'wkst' => array(
                            'day' => WeekDay::SU()->value(),
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => $name,
                                'value' => $value,
                            ),
                        ),
                    ),
                ),
                'exceptId' => array(
                    'd' => $date,
                    'tz' => $tz,
                    'rangeType' => RangeType::NONE()->value(),
                ),
                's' => array(
                    'd' => $date,
                    'tz' => $tz,
                    'u' => $utc,
                ),
                'e' => array(
                    'd' => $date,
                    'tz' => $tz,
                    'u' => $utc,
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => $weeks,
                    'd' => $days,
                    'h' => $hours,
                    'm' => $minutes,
                    's' => $seconds,
                    'related' => $related,
                    'count' => $num,
                ),
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }
}
