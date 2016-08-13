<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\RevokeOAuthConsumer;

/**
 * Testcase class for RevokeOAuthConsumer.
 */
class RevokeOAuthConsumerTest extends ZimbraAccountApiTestCase
{
    public function testRevokeOAuthConsumerRequest()
    {
        $accessToken = $this->faker->word;

        $req = new RevokeOAuthConsumer(
            $accessToken
        );
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($accessToken, $req->getAccessToken());

        $req = new RevokeOAuthConsumer('');
        $req->setAccessToken($accessToken);
        $this->assertSame($accessToken, $req->getAccessToken());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeOAuthConsumerRequest accessToken="' . $accessToken . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeOAuthConsumerRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'accessToken' => $accessToken,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokeOAuthConsumerApi()
    {
        $accessToken = $this->faker->word;

        $this->api->revokeOAuthConsumer(
            $accessToken
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:RevokeOAuthConsumerRequest accessToken="' . $accessToken . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
