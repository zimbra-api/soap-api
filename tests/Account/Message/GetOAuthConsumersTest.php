<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetOAuthConsumersBody;
use Zimbra\Account\Message\GetOAuthConsumersEnvelope;
use Zimbra\Account\Message\GetOAuthConsumersRequest;
use Zimbra\Account\Message\GetOAuthConsumersResponse;
use Zimbra\Account\Struct\OAuthConsumer;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetOAuthConsumersTest.
 */
class GetOAuthConsumersTest extends ZimbraTestCase
{
    public function testGetOAuthConsumers()
    {
        $accessToken = $this->faker->sha256;
        $approvedOn = $this->faker->word;
        $applicationName = $this->faker->word;
        $device = $this->faker->word;

        $request = new GetOAuthConsumersRequest();

        $consumer = new OAuthConsumer($accessToken, $approvedOn, $applicationName, $device);
        $response = new GetOAuthConsumersResponse([$consumer]);
        $this->assertSame([$consumer], $response->getConsumers());
        $response = new GetOAuthConsumersResponse();
        $response->setConsumers([$consumer]);
        $this->assertSame([$consumer], $response->getConsumers());

        $body = new GetOAuthConsumersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetOAuthConsumersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetOAuthConsumersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetOAuthConsumersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetOAuthConsumersRequest />
        <urn:GetOAuthConsumersResponse>
            <urn:OAuthConsumer accessToken="$accessToken" approvedOn="$approvedOn" appName="$applicationName" device="$device" />
        </urn:GetOAuthConsumersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetOAuthConsumersEnvelope::class, 'xml'));
    }
}
