<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\GetSignaturesBody;
use Zimbra\Account\Message\GetSignaturesEnvelope;
use Zimbra\Account\Message\GetSignaturesRequest;
use Zimbra\Account\Message\GetSignaturesResponse;
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Enum\ContentType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetSignaturesTest.
 */
class GetSignaturesTest extends ZimbraStructTestCase
{
    public function testGetSignatures()
    {
        $value = $this->faker->word;
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $cid = $this->faker->word;

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
            <signature name="$name" id="$id">
                <cid>$cid</cid>
                <content type="text/html">$value</content>
            </signature>
        </urn:GetSignaturesResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSignaturesEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetSignaturesRequest' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetSignaturesResponse' => [
                    'signature' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'cid' => [
                                '_content' => $cid,
                            ],
                            'content' => [
                                [
                                    'type' => 'text/html',
                                    '_content' => $value,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetSignaturesEnvelope::class, 'json'));
    }
}
