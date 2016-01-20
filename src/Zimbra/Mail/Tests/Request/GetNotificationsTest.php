<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetNotifications;

/**
 * Testcase class for GetNotifications.
 */
class GetNotificationsTest extends ZimbraMailApiTestCase
{
    public function testGetNotificationsRequest()
    {
        $req = new GetNotifications(true);
        $this->assertTrue($req->getMarkSeen());
        $req = new GetNotifications(false);
        $req->setMarkSeen(true);
        $this->assertTrue($req->getMarkSeen());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetNotificationsRequest markSeen="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetNotificationsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'markSeen' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetNotificationsApi()
    {
        $this->api->getNotifications(
            true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetNotificationsRequest markSeen="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
