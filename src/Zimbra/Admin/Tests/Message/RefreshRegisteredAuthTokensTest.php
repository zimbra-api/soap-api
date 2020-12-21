<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\RefreshRegisteredAuthTokensBody;
use Zimbra\Admin\Message\RefreshRegisteredAuthTokensEnvelope;
use Zimbra\Admin\Message\RefreshRegisteredAuthTokensRequest;
use Zimbra\Admin\Message\RefreshRegisteredAuthTokensResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RefreshRegisteredAuthTokens.
 */
class RefreshRegisteredAuthTokensTest extends ZimbraStructTestCase
{
    public function testRefreshRegisteredAuthTokens()
    {
        $token1 = $this->faker->word;
        $token2 = $this->faker->word;

        $request = new RefreshRegisteredAuthTokensRequest([$token1]);
        $this->assertSame([$token1], $request->getTokens());

        $request = new RefreshRegisteredAuthTokensRequest();
        $request->setTokens([$token1])
            ->addToken($token2);
        $this->assertSame([$token1, $token2], $request->getTokens());

        $response = new RefreshRegisteredAuthTokensResponse();

        $body = new RefreshRegisteredAuthTokensBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RefreshRegisteredAuthTokensBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RefreshRegisteredAuthTokensEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RefreshRegisteredAuthTokensEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body xmlns:urn="urn:zimbraAdmin">
        <urn:RefreshRegisteredAuthTokensRequest>
            <token>$token1</token>
            <token>$token2</token>
        </urn:RefreshRegisteredAuthTokensRequest>
        <urn:RefreshRegisteredAuthTokensResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RefreshRegisteredAuthTokensEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RefreshRegisteredAuthTokensRequest' => [
                    'token' => [
                        [
                            '_content' => $token1,
                        ],
                        [
                            '_content' => $token2,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RefreshRegisteredAuthTokensResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RefreshRegisteredAuthTokensEnvelope::class, 'json'));
    }
}
