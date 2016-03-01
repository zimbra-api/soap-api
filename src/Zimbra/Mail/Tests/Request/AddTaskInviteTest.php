<?php

namespace Zimbra\Mail\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\AddTaskInvite;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for AddTaskInvite.
 */
class AddTaskInviteTest extends ZimbraMailApiTestCase
{
    public function testAddTaskInviteRequest()
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

        $req = new AddTaskInvite(
            $m, ParticipationStatus::NEEDS_ACTION()
        );
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getPartStat()->is('NE'));

        $req = new AddTaskInvite();
        $req->setMsg($m)
            ->setPartStat(ParticipationStatus::NEEDS_ACTION());
        $this->assertSame($m, $req->getMsg());
        $this->assertTrue($req->getPartStat()->is('NE'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddTaskInviteRequest ptst="' . ParticipationStatus::NEEDS_ACTION() . '">'
                .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</AddTaskInviteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddTaskInviteRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddTaskInviteApi()
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

        $this->api->addTaskInvite(
            $m, ParticipationStatus::NEEDS_ACTION()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddTaskInviteRequest ptst="' . ParticipationStatus::NEEDS_ACTION() . '">'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:AddTaskInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
