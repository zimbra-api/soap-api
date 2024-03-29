<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetIdentitiesBody;
use Zimbra\Account\Message\GetIdentitiesEnvelope;
use Zimbra\Account\Message\GetIdentitiesRequest;
use Zimbra\Account\Message\GetIdentitiesResponse;
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetIdentitiesTest.
 */
class GetIdentitiesTest extends ZimbraTestCase
{
    public function testGetIdentities()
    {
        $name = $this->faker->name;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $request = new GetIdentitiesRequest();

        $identity = new Identity($name, $id, [new Attr($name, $value, TRUE)]);
        $response = new GetIdentitiesResponse([$identity]);
        $this->assertSame([$identity], $response->getIdentities());
        $response = new GetIdentitiesResponse();
        $response->setIdentities([$identity]);
        $this->assertSame([$identity], $response->getIdentities());

        $body = new GetIdentitiesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetIdentitiesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetIdentitiesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetIdentitiesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetIdentitiesRequest />
        <urn:GetIdentitiesResponse>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:GetIdentitiesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetIdentitiesEnvelope::class, 'xml'));
    }
}
