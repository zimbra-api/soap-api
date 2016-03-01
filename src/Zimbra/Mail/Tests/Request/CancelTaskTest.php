<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\CancelTask;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for CancelTask.
 */
class CancelTaskTest extends ZimbraMailApiTestCase
{
    public function testCancelTaskRequest()
    {
        $req = new CancelTask;
        $this->assertInstanceOf('Zimbra\Mail\Request\CancelAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CancelTaskRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CancelTaskRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCancelTaskApi()
    {
        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $timezone = new CalTZInfo($id, $stdoff, $dayoff);

        $range = $this->faker->word;
        $date = $this->faker->iso8601;
        $tz = $this->faker->word;
        $inst = new InstanceRecurIdInfo($range, $date, $tz);

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

        $comp = mt_rand(1, 10);
        $ms = mt_rand(1, 10);
        $rev = mt_rand(1, 10);

        $this->api->cancelTask(
            $inst, $timezone, $m, $id, $comp, $ms, $rev
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CancelTaskRequest id="' . $id . '" comp="' . $comp . '" ms="' . $ms . '" rev="' . $rev . '">'
                        .'<urn1:inst range="' . $range . '" d="' . $date . '" tz="' . $tz . '" />'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                        .'</urn1:m>'
                    .'</urn1:CancelTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
