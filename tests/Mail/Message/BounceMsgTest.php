<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Enum\AddressType;

use Zimbra\Mail\Message\BounceMsgEnvelope;
use Zimbra\Mail\Message\BounceMsgBody;
use Zimbra\Mail\Message\BounceMsgRequest;
use Zimbra\Mail\Message\BounceMsgResponse;

use Zimbra\Mail\Struct\BounceMsgSpec;
use Zimbra\Mail\Struct\EmailAddrInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BounceMsg.
 */
class BounceMsgTest extends ZimbraTestCase
{
    public function testBounceMsg()
    {
        $id = $this->faker->uuid;
        $address = $this->faker->email;
        $personal = $this->faker->word;

        $msg = new BounceMsgSpec($id, [new EmailAddrInfo($address, AddressType::TO(), $personal)]);
        $request = new BounceMsgRequest($msg);
        $this->assertSame($msg, $request->getMsg());
        $request = new BounceMsgRequest(new BounceMsgSpec(''));
        $request->setMsg($msg);
        $this->assertSame($msg, $request->getMsg());

        $response = new BounceMsgResponse();

        $body = new BounceMsgBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new BounceMsgBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new BounceMsgEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new BounceMsgEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:BounceMsgRequest>
            <m id="$id">
                <e a="$address" t="t" p="$personal" />
            </m>
        </urn:BounceMsgRequest>
        <urn:BounceMsgResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, BounceMsgEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'BounceMsgRequest' => [
                    'm' => [
                        'id' => $id,
                        'e' => [
                            [
                                'a' => $address,
                                't' => 't',
                                'p' => $personal,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraMail',
                ],
                'BounceMsgResponse' => [
                    '_jsns' => 'urn:zimbraMail',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, BounceMsgEnvelope::class, 'json'));
    }
}
