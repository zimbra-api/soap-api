<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\CompleteTaskInstance;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DtTimeInfo;

/**
 * Testcase class for CompleteTaskInstance.
 */
class CompleteTaskInstanceTest extends ZimbraMailApiTestCase
{
    public function testCompleteTaskInstanceRequest()
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

        $req = new CompleteTaskInstance(
            $id, $exceptId, $timezone
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());

        $req->setId($id)
            ->setExceptionId($exceptId)
            ->setTimezone($timezone);
        $this->assertSame($id, $req->getId());
        $this->assertSame($exceptId, $req->getExceptionId());
        $this->assertSame($timezone, $req->getTimezone());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CompleteTaskInstanceRequest id="' . $id . '">'
                .'<exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
            .'</CompleteTaskInstanceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CompleteTaskInstanceRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompleteTaskInstanceApi()
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

        $this->api->completeTaskInstance(
            $id, $exceptId, $timezone
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CompleteTaskInstanceRequest id="' . $id . '">'
                        .'<urn1:exceptId d="' . $date . '" tz="' . $tz . '" u="' . $utc . '" />'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                    .'</urn1:CompleteTaskInstanceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
