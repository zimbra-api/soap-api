<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\{CreateSignatureEnvelope, CreateSignatureBody, CreateSignatureRequest, CreateSignatureResponse};
use Zimbra\Account\Struct\NameId;
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Enum\ContentType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for CreateSignature.
 */
class CreateSignatureTest extends ZimbraStructTestCase
{
    public function testCreateSignature()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $signature = new Signature($name, $id, $cid, [new SignatureContent($value, ContentType::TEXT_HTML())]);

        $request = new CreateSignatureRequest($signature);
        $this->assertSame($signature, $request->getSignature());
        $request = new CreateSignatureRequest(new Signature());
        $request->setSignature($signature);
        $this->assertSame($signature, $request->getSignature());

        $signature = new NameId($name, $id);
        $response = new CreateSignatureResponse($signature);
        $this->assertSame($signature, $response->getSignature());
        $response = new CreateSignatureResponse(new NameId('', ''));
        $response->setSignature($signature);
        $this->assertSame($signature, $response->getSignature());

        $body = new CreateSignatureBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateSignatureBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateSignatureEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateSignatureEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:CreateSignatureRequest>
            <signature name="$name" id="$id">
                <cid>$cid</cid>
                <content type="text/html">$value</content>
            </signature>
        </urn:CreateSignatureRequest>
        <urn:CreateSignatureResponse>
            <signature name="$name" id="$id"/>
        </urn:CreateSignatureResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateSignatureEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateSignatureRequest' => [
                    'signature' => [
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
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'CreateSignatureResponse' => [
                    'signature' => [
                        'name' => $name,
                        'id' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateSignatureEnvelope::class, 'json'));
    }
}
