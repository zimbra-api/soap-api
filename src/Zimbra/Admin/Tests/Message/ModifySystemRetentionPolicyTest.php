<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ModifySystemRetentionPolicyBody;
use Zimbra\Admin\Message\ModifySystemRetentionPolicyEnvelope;
use Zimbra\Admin\Message\ModifySystemRetentionPolicyRequest;
use Zimbra\Admin\Message\ModifySystemRetentionPolicyResponse;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ModifySystemRetentionPolicy.
 */
class ModifySystemRetentionPolicyTest extends ZimbraStructTestCase
{
    public function testModifySystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $request = new ModifySystemRetentionPolicyRequest($policy, $cos);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($policy, $request->getPolicy());

        $request = new ModifySystemRetentionPolicyRequest(new Policy(Type::SYSTEM(), '', '', ''));
        $request->setCos($cos)
            ->setPolicy($policy);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($policy, $request->getPolicy());

        $response = new ModifySystemRetentionPolicyResponse($policy);
        $this->assertSame($policy, $response->getPolicy());
        $response = new ModifySystemRetentionPolicyResponse(new Policy(Type::SYSTEM(), '', '', ''));
        $response->setPolicy($policy);
        $this->assertSame($policy, $response->getPolicy());

        $body = new ModifySystemRetentionPolicyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ModifySystemRetentionPolicyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifySystemRetentionPolicyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifySystemRetentionPolicyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:ModifySystemRetentionPolicyRequest>
            <cos by="name">$value</cos>
            <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:ModifySystemRetentionPolicyRequest>
        <urn:ModifySystemRetentionPolicyResponse>
            <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:ModifySystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifySystemRetentionPolicyEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifySystemRetentionPolicyRequest' => [
                    'cos' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'policy' => [
                        'type' => 'system',
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                        '_jsns' => 'urn:zimbraMail',
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ModifySystemRetentionPolicyResponse' => [
                    'policy' => [
                        'type' => 'system',
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                        '_jsns' => 'urn:zimbraMail',
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifySystemRetentionPolicyEnvelope::class, 'json'));
    }
}
