<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{
    DeleteSignatureEnvelope,
    DeleteSignatureBody,
    DeleteSignatureRequest,
    DeleteSignatureResponse
};
use Zimbra\Account\Struct\NameId;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for DeleteSignature.
 */
class DeleteSignatureTest extends ZimbraTestCase
{
    public function testDeleteSignature()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $signature = new NameId($name, $id);

        $request = new DeleteSignatureRequest($signature);
        $this->assertSame($signature, $request->getSignature());
        $request = new DeleteSignatureRequest(new NameId());
        $request->setSignature($signature);
        $this->assertSame($signature, $request->getSignature());

        $response = new DeleteSignatureResponse();

        $body = new DeleteSignatureBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteSignatureBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteSignatureEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new DeleteSignatureEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:DeleteSignatureRequest>
            <urn:signature name="$name" id="$id" />
        </urn:DeleteSignatureRequest>
        <urn:DeleteSignatureResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteSignatureEnvelope::class, 'xml'));
    }
}
