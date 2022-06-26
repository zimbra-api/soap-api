<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{DeleteIdentityEnvelope, DeleteIdentityBody, DeleteIdentityRequest, DeleteIdentityResponse};
use Zimbra\Account\Struct\NameId;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for DeleteIdentity.
 */
class DeleteIdentityTest extends ZimbraTestCase
{
    public function testDeleteIdentity()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $identity = new NameId($name, $id);

        $request = new DeleteIdentityRequest($identity);
        $this->assertSame($identity, $request->getIdentity());
        $request = new DeleteIdentityRequest(new NameId('', ''));
        $request->setIdentity($identity);
        $this->assertSame($identity, $request->getIdentity());

        $response = new DeleteIdentityResponse();

        $body = new DeleteIdentityBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteIdentityBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteIdentityEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new DeleteIdentityEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DeleteIdentityRequest>
            <urn:identity name="$name" id="$id"/>
        </urn:DeleteIdentityRequest>
        <urn:DeleteIdentityResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteIdentityEnvelope::class, 'xml'));
    }
}
