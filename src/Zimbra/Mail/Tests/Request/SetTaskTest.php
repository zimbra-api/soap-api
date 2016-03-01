<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\SetTask;
use Zimbra\Mail\Struct\CalReply;
use Zimbra\Mail\Struct\Msg;
use Zimbra\Mail\Struct\Replies;
use Zimbra\Mail\Struct\SetCalendarItemInfo;

/**
 * Testcase class for SetTask.
 */
class SetTaskTest extends ZimbraMailApiTestCase
{
    public function testSetTaskRequest()
    {
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;

        $attendee = $this->faker->word;
        $sequence = mt_rand(1, 100);
        $date = mt_rand(1, 100);
        $rangeType = mt_rand(1, 100);
        $recurId = $this->faker->iso8601;
        $sentBy = $this->faker->word;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $t = $this->faker->word;
        $tn = $this->faker->word;
        $l = $this->faker->word;
        $nextAlarm = mt_rand(1, 10);

        $m = new Msg(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );
        $default = new SetCalendarItemInfo(
            $m, ParticipationStatus::NEEDS_ACTION()
        );
        $except = new SetCalendarItemInfo();
        $cancel = new SetCalendarItemInfo();

        $reply = new CalReply(
            $attendee, $sequence, $date, $rangeType, $recurId, $sentBy, ParticipationStatus::NEEDS_ACTION(), $tz, $ridZ
        );
        $replies = new Replies([$reply]);

        $req = new SetTask(
            $f, $t, $tn, $l, true, $nextAlarm, $default, [$except], [$cancel], $replies
        );
        $this->assertSame($f, $req->getFlags());
        $this->assertSame($t, $req->getTags());
        $this->assertSame($tn, $req->getTagNames());
        $this->assertSame($l, $req->getFolderId());
        $this->assertTrue($req->getNoNextAlarm());
        $this->assertSame($nextAlarm, $req->getNextAlarm());
        $this->assertSame($default, $req->getDefaultId());
        $this->assertSame([$except], $req->getExceptions()->all());
        $this->assertSame([$cancel], $req->getCancellations()->all());
        $this->assertSame($replies, $req->getReplies());

        $req = new SetTask();
        $req->setFlags($f)
            ->setTags($t)
            ->setTagNames($tn)
            ->setFolderId($l)
            ->setNoNextAlarm(true)
            ->setNextAlarm($nextAlarm)
            ->setDefaultId($default)
            ->setExceptions([$except])
            ->addException($except)
            ->setCancellations([$cancel])
            ->addCancellation($cancel)
            ->setReplies($replies);
        $this->assertSame($f, $req->getFlags());
        $this->assertSame($t, $req->getTags());
        $this->assertSame($tn, $req->getTagNames());
        $this->assertSame($l, $req->getFolderId());
        $this->assertTrue($req->getNoNextAlarm());
        $this->assertSame($nextAlarm, $req->getNextAlarm());
        $this->assertSame($default, $req->getDefaultId());
        $this->assertSame([$except, $except], $req->getExceptions()->all());
        $this->assertSame([$cancel, $cancel], $req->getCancellations()->all());
        $this->assertSame($replies, $req->getReplies());

        $req = new SetTask(
            $f, $t, $tn, $l, true, $nextAlarm, $default, [$except], [$cancel], $replies
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetTaskRequest f="' . $f . '" t="' . $t . '" tn="' . $tn . '" l="' . $l . '" noNextAlarm="true" nextAlarm="' . $nextAlarm . '">'
                .'<default ptst="' . ParticipationStatus::NEEDS_ACTION() . '">'
                    .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                        .'<content>' . $content . '</content>'
                        .'<fr>' . $fr . '</fr>'
                    .'</m>'
                .'</default>'
                .'<replies>'
                    .'<reply at="' . $attendee . '" seq="' . $sequence . '" d="' . $date . '" sentBy="' . $sentBy . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                .'</replies>'
                .'<except />'
                .'<cancel />'
            .'</SetTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetTaskRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'f' => $f,
                't' => $t,
                'tn' => $tn,
                'l' => $l,
                'noNextAlarm' => true,
                'nextAlarm' => $nextAlarm,
                'default' => array(
                    'ptst' => ParticipationStatus::NEEDS_ACTION()->value(),
                    'm' => array(
                        'aid' => $aid,
                        'origid' => $origid,
                        'rt' => ReplyType::REPLIED()->value(),
                        'idnt' => $idnt,
                        'su' => $su,
                        'irt' => $irt,
                        'l' => $l,
                        'f' => $f,
                        'content' => $content,
                        'fr' => $fr,
                    ),
                ),
                'except' => array(
                    array(),
                ),
                'cancel' => array(
                    array(),
                ),
                'replies' => array(
                    'reply' => array(
                        array(
                            'at' => $attendee,
                            'seq' => $sequence,
                            'd' => $date,
                            'sentBy' => $sentBy,
                            'ptst' => ParticipationStatus::NEEDS_ACTION()->value(),
                            'rangeType' => $rangeType,
                            'recurId' => $recurId,
                            'tz' => $tz,
                            'ridZ' => $ridZ,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetTaskApi()
    {
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;

        $attendee = $this->faker->word;
        $sequence = mt_rand(1, 100);
        $date = mt_rand(1, 100);
        $rangeType = mt_rand(1, 100);
        $recurId = $this->faker->iso8601;
        $sentBy = $this->faker->word;
        $tz = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $t = $this->faker->word;
        $tn = $this->faker->word;
        $l = $this->faker->word;
        $nextAlarm = mt_rand(1, 10);

        $m = new Msg(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );
        $default = new SetCalendarItemInfo(
            $m, ParticipationStatus::NEEDS_ACTION()
        );
        $except = new SetCalendarItemInfo();
        $cancel = new SetCalendarItemInfo();

        $reply = new CalReply(
            $attendee, $sequence, $date, $rangeType, $recurId, $sentBy, ParticipationStatus::NEEDS_ACTION(), $tz, $ridZ
        );
        $replies = new Replies([$reply]);

        $this->api->setTask(
            $f, $t, $tn, $l, true, $nextAlarm, $default, [$except], [$cancel], $replies
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetTaskRequest f="' . $f . '" t="' . $t . '" tn="' . $tn . '" l="' . $l . '" noNextAlarm="true" nextAlarm="' . $nextAlarm . '">'
                        .'<urn1:default ptst="' . ParticipationStatus::NEEDS_ACTION() . '">'
                            .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                                .'<urn1:content>' . $content . '</urn1:content>'
                                .'<urn1:fr>' . $fr . '</urn1:fr>'
                            .'</urn1:m>'
                        .'</urn1:default>'
                        .'<urn1:replies>'
                            .'<urn1:reply at="' . $attendee . '" seq="' . $sequence . '" d="' . $date . '" sentBy="' . $sentBy . '" ptst="' . ParticipationStatus::NEEDS_ACTION() . '" rangeType="' . $rangeType . '" recurId="' . $recurId . '" tz="' . $tz . '" ridZ="' . $ridZ . '" />'
                        .'</urn1:replies>'
                        .'<urn1:except />'
                        .'<urn1:cancel />'
                    .'</urn1:SetTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
