<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RenewMobileGatewayAppToken;

/**
 * Testcase class for RenewMobileGatewayAppToken.
 */
class RenewMobileGatewayAppTokenTest extends ZimbraAccountApiTestCase
{
    public function testRenewMobileGatewayAppTokenRequest()
    {
        $appId = $this->faker->word;
        $appKey = $this->faker->word;

        $req = new RenewMobileGatewayAppToken(
            $appId, $appKey
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($appId, $req->getAppId());
        $this->assertSame($appKey, $req->getAppKey());

        $req = new RenewMobileGatewayAppToken('', '');
        $req->setAppId($appId)
            ->setAppKey($appKey);
        $this->assertSame($appId, $req->getAppId());
        $this->assertSame($appKey, $req->getAppKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenewMobileGatewayAppTokenRequest>'
                . '<appId>' . $appId . '</appId>'
                . '<appKey>' . $appKey . '</appKey>'
            . '</RenewMobileGatewayAppTokenRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenewMobileGatewayAppTokenRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'appId' => $appId,
                'appKey' => $appKey,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenewMobileGatewayAppTokenApi()
    {
        $appId = $this->faker->word;
        $appKey = $this->faker->word;

        $this->api->renewMobileGatewayAppToken(
            $appId, $appKey
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RenewMobileGatewayAppTokenRequest>'
                        . '<urn1:appId>' . $appId . '</urn1:appId>'
                        . '<urn1:appKey>' . $appKey . '</urn1:appKey>'
                    . '</urn1:RenewMobileGatewayAppTokenRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
