<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\DeclineCounterAppointment;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for DeclineCounterAppointment.
 */
class DeclineCounterAppointmentTest extends ZimbraMailApiTestCase
{
    public function testDeclineCounterAppointmentRequest()
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

        $req = new DeclineCounterAppointment(
            $m
        );
        $this->assertSame($m, $req->getMsg());
        $req = new DeclineCounterAppointment();
        $req->setMsg($m);
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeclineCounterAppointmentRequest>'
                .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</DeclineCounterAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeclineCounterAppointmentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
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

    public function testDeclineCounterAppointmentApi()
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
        $this->api->declineCounterAppointment(
            $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeclineCounterAppointmentRequest>'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:DeclineCounterAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
