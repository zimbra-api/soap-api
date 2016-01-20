<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\ForwardAppointment;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for ForwardAppointment.
 */
class ForwardAppointmentTest extends ZimbraMailApiTestCase
{
    public function testForwardAppointmentRequest()
    {
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);

        $exceptId = new DtTimeInfo(
            $date, $tz, $utc
        );

        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $timezone = new CalTZInfo($id, $stdoff, $dayoff);

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

        $req = new ForwardAppointment(
            $id, $exceptId, $timezone, $m
        );
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());
        $this->assertSame($m, $req->getMsg());
        $this->assertSame($id, $req->getId());

        $req = new ForwardAppointment();
        $req->setExceptionId($exceptId)
            ->setTimezone($timezone)
            ->setMsg($m)
            ->setId($id);
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());
        $this->assertSame($m, $req->getMsg());
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ForwardAppointmentRequest id="' . $id . '">'
                .'<exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                    .'<content>' . $content . '</content>'
                    .'<fr>' . $fr . '</fr>'
                .'</m>'
            .'</ForwardAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ForwardAppointmentRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
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

    public function testForwardAppointmentApi()
    {
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $utc = mt_rand(0, 24);

        $exceptId = new DtTimeInfo(
            $date, $tz, $utc
        );

        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $timezone = new CalTZInfo($id, $stdoff, $dayoff);

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

        $this->api->forwardAppointment(
            $id, $exceptId, $timezone, $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ForwardAppointmentRequest id="' . $id . '">'
                        .'<urn1:exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:ForwardAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
