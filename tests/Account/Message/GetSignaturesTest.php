<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\GetSignaturesBody;
use Zimbra\Account\Message\GetSignaturesEnvelope;
use Zimbra\Account\Message\GetSignaturesRequest;
use Zimbra\Account\Message\GetSignaturesResponse;
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Common\Enum\ContentType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetSignaturesTest.
 */
class GetSignaturesTest extends ZimbraTestCase
{
    public function testGetSignatures()
    {
        $value = $this->faker->word;
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $cid = $this->faker->uuid;

        $request = new GetSignaturesRequest();

        $signature = new Signature($name, $id, $cid, [new SignatureContent($value, ContentType::TEXT_HTML())]);
        $response = new GetSignaturesResponse([$signature]);
        $this->assertSame([$signature], $response->getSignatures());
        $response = new GetSignaturesResponse();
        $response->setSignatures([$signature])
            ->addSignature($signature);
        $this->assertSame([$signature, $signature], $response->getSignatures());
        $response->setSignatures([$signature]);

        $body = new GetSignaturesBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetSignaturesBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetSignaturesEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetSignaturesEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetSignaturesRequest />
        <urn:GetSignaturesResponse>
            <urn:signature name="$name" id="$id">
                <urn:cid>$cid</urn:cid>
                <urn:content type="text/html">$value</urn:content>
            </urn:signature>
        </urn:GetSignaturesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSignaturesEnvelope::class, 'xml'));
    }
}
