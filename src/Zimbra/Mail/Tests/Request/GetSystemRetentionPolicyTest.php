<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetSystemRetentionPolicy;

/**
 * Testcase class for GetSystemRetentionPolicy.
 */
class MailGetSystemRetentionPolicyTest extends ZimbraMailApiTestCase
{
    public function testGetSystemRetentionPolicyRequest()
    {
        $req = new GetSystemRetentionPolicy();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSystemRetentionPolicyRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSystemRetentionPolicyRequest' => array(
                '_jsns' => 'urn:zimbraMail',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSystemRetentionPolicyApi()
    {
        $this->api->getSystemRetentionPolicy();

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetSystemRetentionPolicyRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
