<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{ModifyIdentityEnvelope, ModifyIdentityBody, ModifyIdentityRequest, ModifyIdentityResponse};
use Zimbra\Account\Struct\Attr;
use Zimbra\Account\Struct\Identity;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for ModifyIdentity.
 */
class ModifyIdentityTest extends ZimbraTestCase
{
    public function testModifyIdentity()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;

        $identity = new Identity($name, $id, [new Attr($name, $value, TRUE)]);

        $request = new ModifyIdentityRequest($identity);
        $this->assertSame($identity, $request->getIdentity());
        $request = new ModifyIdentityRequest(new Identity('', ''));
        $request->setIdentity($identity);
        $this->assertSame($identity, $request->getIdentity());

        $response = new ModifyIdentityResponse();

        $body = new ModifyIdentityBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyIdentityBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyIdentityEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyIdentityEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifyIdentityRequest>
            <urn:identity name="$name" id="$id">
                <urn:a name="$name" pd="true">$value</urn:a>
            </urn:identity>
        </urn:ModifyIdentityRequest>
        <urn:ModifyIdentityResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyIdentityEnvelope::class, 'xml'));
    }
}
