<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\SendMsg;
use Zimbra\Mail\Struct\MsgToSend;

/**
 * Testcase class for SendMsg.
 */
class SendMsgTest extends ZimbraMailApiTestCase
{
    public function testSendMsgRequest()
    {
        $suid = $this->faker->uuid;
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $did = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $m = new MsgToSend(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $did,
            true,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );

        $req = new SendMsg(
            $m, true, true, true, $suid
        );
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getNeedCalendarSentbyFixup());
        $this->assertTrue($req->getIsCalendarForward());
        $this->assertTrue($req->getNoSaveToSent());
        $this->assertSame($suid, $req->getSendUid());

        $req = new SendMsg();
        $req->setMsg($m)
            ->setNeedCalendarSentbyFixup(true)
            ->setIsCalendarForward(true)
            ->setNoSaveToSent(true)
            ->setSendUid($suid);
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getNeedCalendarSentbyFixup());
        $this->assertTrue($req->getIsCalendarForward());
        $this->assertTrue($req->getNoSaveToSent());
        $this->assertSame($suid, $req->getSendUid());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendMsgRequest needCalendarSentByFixup="true" isCalendarForward="true" noSave="true" suid="' . $suid . '">'
                .'<m did="' . $did . '" sfd="true" aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</SendMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendMsgRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'needCalendarSentByFixup' => true,
                'isCalendarForward' => true,
                'noSave' => true,
                'suid' => $suid,
                'm' => array(
                    'did' => $did,
                    'sfd' => true,
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

    public function testSendMsgApi()
    {
        $suid = $this->faker->uuid;
        $content = $this->faker->word;
        $fr = $this->faker->word;
        $did = $this->faker->word;
        $aid = $this->faker->uuid;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $m = new MsgToSend(
            $content,
            NULL,
            NULL,
            NULL,
            $fr,
            $did,
            true,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f
        );

        $this->api->sendMsg(
            $m, true, true, true, $suid
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendMsgRequest needCalendarSentByFixup="true" isCalendarForward="true" noSave="true" suid="' . $suid . '">'
                        .'<urn1:m did="' . $did . '" sfd="true" aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:SendMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
