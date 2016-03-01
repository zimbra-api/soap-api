<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetShareNotifications;

/**
 * Testcase class for GetShareNotifications.
 */
class GetShareNotificationsTest extends ZimbraMailApiTestCase
{
    public function testGetShareNotificationsRequest()
    {
        $req = new GetShareNotifications();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetShareNotificationsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetShareNotificationsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareNotificationsApi()
    {
        $this->api->getShareNotifications();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetShareNotificationsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
