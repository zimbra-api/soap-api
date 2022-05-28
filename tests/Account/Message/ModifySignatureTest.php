<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{ModifySignatureEnvelope, ModifySignatureBody, ModifySignatureRequest, ModifySignatureResponse};
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\SignatureContent;
use Zimbra\Common\Enum\ContentType;
use Zimbra\Tests\ZimbraTestCase;
/**
 * Testcase class for ModifySignature.
 */
class ModifySignatureTest extends ZimbraTestCase
{
    public function testModifySignature()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->word;
        $cid = $this->faker->word;

        $signature = new Signature($name, $id, $cid, [new SignatureContent($value, ContentType::TEXT_HTML())]);

        $request = new ModifySignatureRequest($signature);
        $this->assertSame($signature, $request->getSignature());
        $request = new ModifySignatureRequest(new Signature());
        $request->setSignature($signature);
        $this->assertSame($signature, $request->getSignature());

        $response = new ModifySignatureResponse();

        $body = new ModifySignatureBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifySignatureBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifySignatureEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifySignatureEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ModifySignatureRequest>
            <signature name="$name" id="$id">
                <cid>$cid</cid>
                <content type="text/html">$value</content>
            </signature>
        </urn:ModifySignatureRequest>
        <urn:ModifySignatureResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifySignatureEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifySignatureRequest' => [
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
                'ModifySignatureResponse' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifySignatureEnvelope::class, 'json'));
    }
}
