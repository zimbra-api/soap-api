<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\SendDeliveryReport;

/**
 * Testcase class for SendDeliveryReport.
 */
class SendDeliveryReportTest extends ZimbraMailApiTestCase
{
    public function testSendDeliveryReportRequest()
    {
        $mid = $this->faker->uuid;
        $req = new SendDeliveryReport(
            $mid
        );
        $this->assertSame($mid, $req->getMessageId());

        $req = new SendDeliveryReport('');
        $req->setMessageId($mid);
        $this->assertSame($mid, $req->getMessageId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendDeliveryReportRequest mid="' . $mid . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendDeliveryReportRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'mid' => $mid,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendDeliveryReportApi()
    {
        $mid = $this->faker->uuid;
        $this->api->sendDeliveryReport($mid);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendDeliveryReportRequest mid="' . $mid . '" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
