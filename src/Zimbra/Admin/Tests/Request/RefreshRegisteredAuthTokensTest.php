<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RefreshRegisteredAuthTokens;

/**
 * Testcase class for RefreshRegisteredAuthTokens.
 */
class RefreshRegisteredAuthTokensTest extends ZimbraAdminApiTestCase
{
    public function testRefreshRegisteredAuthTokensRequest()
    {
        $token1 = $this->faker->word;
        $token2 = $this->faker->word;

        $req = new RefreshRegisteredAuthTokens([$token1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$token1], $req->getTokens()->all());

        $req->addToken($token2);
        $this->assertSame([$token1, $token2], $req->getTokens()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RefreshRegisteredAuthTokensRequest>'
                . '<token>' . $token1 . '</token>'
                . '<token>' . $token2 . '</token>'
            . '</RefreshRegisteredAuthTokensRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RefreshRegisteredAuthTokensRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'token' => [
                    $token1,
                    $token2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRefreshRegisteredAuthTokensApi()
    {
        $token1 = $this->faker->word;
        $token2 = $this->faker->word;
        $this->api->refreshRegisteredAuthTokens(
            [$token1, $token2]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RefreshRegisteredAuthTokensRequest>'
                        . '<urn1:token>' . $token1 . '</urn1:token>'
                        . '<urn1:token>' . $token2 . '</urn1:token>'
                    . '</urn1:RefreshRegisteredAuthTokensRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
