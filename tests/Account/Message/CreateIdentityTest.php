<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{CreateIdentityEnvelope, CreateIdentityBody, CreateIdentityRequest, CreateIdentityResponse};
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for CreateIdentity.
 */
class CreateIdentityTest extends ZimbraTestCase
{
    public function testCreateIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $identity = new Identity($name, $id, [new Attr($name, $value, TRUE)]);

        $request = new CreateIdentityRequest($identity);
        $this->assertSame($identity, $request->getIdentity());
        $request = new CreateIdentityRequest(new Identity());
        $request->setIdentity($identity);
        $this->assertSame($identity, $request->getIdentity());

        $response = new CreateIdentityResponse($identity);
        $this->assertSame($identity, $response->getIdentity());
        $response = new CreateIdentityResponse();
        $response->setIdentity($identity);
        $this->assertSame($identity, $response->getIdentity());

        $body = new CreateIdentityBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateIdentityBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateIdentityEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateIdentityEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateIdentityRequest>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:CreateIdentityRequest>
        <urn:CreateIdentityResponse>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:CreateIdentityResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateIdentityEnvelope::class, 'xml'));
    }
}
