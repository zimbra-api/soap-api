<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{RevokeOAuthConsumerEnvelope, RevokeOAuthConsumerBody, RevokeOAuthConsumerRequest, RevokeOAuthConsumerResponse};
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for RevokeOAuthConsumer.
 */
class RevokeOAuthConsumerTest extends ZimbraTestCase
{
    public function testRevokeOAuthConsumer()
    {
        $accessToken = $this->faker->uuid;

        $request = new RevokeOAuthConsumerRequest($accessToken);
        $this->assertSame($accessToken, $request->getAccessToken());
        $request = new RevokeOAuthConsumerRequest('');
        $request->setAccessToken($accessToken);
        $this->assertSame($accessToken, $request->getAccessToken());

        $response = new RevokeOAuthConsumerResponse();

        $body = new RevokeOAuthConsumerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RevokeOAuthConsumerBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RevokeOAuthConsumerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RevokeOAuthConsumerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:RevokeOAuthConsumerRequest accessToken="$accessToken" />
        <urn:RevokeOAuthConsumerResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RevokeOAuthConsumerEnvelope::class, 'xml'));
    }
}
