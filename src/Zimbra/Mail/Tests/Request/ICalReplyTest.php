<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ICalReply;

/**
 * Testcase class for ICalReply.
 */
class ICalReplyTest extends ZimbraMailApiTestCase
{
    public function testICalReplyRequest()
    {
        $ical = $this->faker->word;
        $req = new ICalReply(
            $ical
        );
        $this->assertSame($ical, $req->getIcal());
        $req->setIcal($ical);
        $this->assertSame($ical, $req->getIcal());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ICalReplyRequest>'
                .'<ical>' . $ical . '</ical>'
            .'</ICalReplyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ICalReplyRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ical' => $ical,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testICalReplyApi()
    {
        $ical = $this->faker->word;
        $this->api->iCalReply($ical);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ICalReplyRequest>'
                        .'<urn1:ical>' . $ical . '</urn1:ical>'
                    .'</urn1:ICalReplyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
