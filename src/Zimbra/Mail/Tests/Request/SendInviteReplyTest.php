<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Enum\VerbType;
use Zimbra\Mail\Request\SendInviteReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for SendInviteReply.
 */
class SendInviteReplyTest extends ZimbraMailApiTestCase
{
    public function testSendInviteReplyRequest()
    {
        $compNum = mt_rand(1, 10);
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;

        $exceptId = new DtTimeInfo(
            $date, $tz, $utc
        );
        $timezone = new CalTZInfo($id, $stdoff, $dayoff);
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

        $req = new SendInviteReply(
            $id, $compNum, VerbType::ACCEPT(), true, $idnt, $exceptId, $timezone, $m
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($compNum, $req->getComponentNum());
        $this->assertSame('ACCEPT', $req->getVerb()->value());
        $this->assertTrue($req->getUpdateOrganizer());
        $this->assertSame($idnt, $req->getIdentityId());
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());
        $this->assertSame($m, $req->getMsg());

        $req = new SendInviteReply(
            '', 0, VerbType::DECLINE()
        );
        $req->setId($id)
            ->setComponentNum($compNum)
            ->setVerb(VerbType::ACCEPT())
            ->setUpdateOrganizer(true)
            ->setIdentityId($idnt)
            ->setExceptionId($exceptId)
            ->setTimezone($timezone)
            ->setMsg($m);
        $this->assertSame($id, $req->getId());
        $this->assertSame($compNum, $req->getComponentNum());
        $this->assertSame('ACCEPT', $req->getVerb()->value());
        $this->assertTrue($req->getUpdateOrganizer());
        $this->assertSame($idnt, $req->getIdentityId());
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendInviteReplyRequest id="' . $id . '" compNum="' . $compNum . '" verb="' . VerbType::ACCEPT() . '" updateOrganizer="true" idnt="' . $idnt . '">'
                .'<exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</SendInviteReplyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendInviteReplyRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
                'compNum' => $compNum,
                'verb' => VerbType::ACCEPT()->value(),
                'updateOrganizer' => true,
                'idnt' => $idnt,
                'exceptId' => array(
                    'd' => $date,
                    'tz' => $tz,
                    'u' => $utc,
                ),
                'tz' => array(
                    'id' => $id,
                    'stdoff' => $stdoff,
                    'dayoff' => $dayoff,
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendInviteReplyApi()
    {
        $compNum = mt_rand(1, 10);
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;

        $exceptId = new DtTimeInfo(
            $date, $tz, $utc
        );
        $timezone = new CalTZInfo($id, $stdoff, $dayoff);
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

        $this->api->sendInviteReply(
            $id, $compNum, VerbType::ACCEPT(), true, $idnt, $exceptId, $timezone, $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendInviteReplyRequest id="' . $id . '" compNum="' . $compNum . '" verb="' . VerbType::ACCEPT() . '" updateOrganizer="true" idnt="' . $idnt . '">'
                        .'<urn1:exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:SendInviteReplyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
