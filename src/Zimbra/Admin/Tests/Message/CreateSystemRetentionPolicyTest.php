<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateSystemRetentionPolicyBody;
use Zimbra\Admin\Message\CreateSystemRetentionPolicyEnvelope;
use Zimbra\Admin\Message\CreateSystemRetentionPolicyRequest;
use Zimbra\Admin\Message\CreateSystemRetentionPolicyResponse;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\Policy;
use Zimbra\Admin\Struct\PolicyHolder;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\Type;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateSystemRetentionPolicy.
 */
class CreateSystemRetentionPolicyTest extends ZimbraStructTestCase
{
    public function testCreateSystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new PolicyHolder($policy);
        $purge = new PolicyHolder($policy);

        $request = new CreateSystemRetentionPolicyRequest($cos, $keep, $purge);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($keep, $request->getKeepPolicy());
        $this->assertSame($purge, $request->getPurgePolicy());

        $request = new CreateSystemRetentionPolicyRequest();
        $request->setCos($cos)
            ->setKeepPolicy($keep)
            ->setPurgePolicy($purge);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($keep, $request->getKeepPolicy());
        $this->assertSame($purge, $request->getPurgePolicy());

        $response = new CreateSystemRetentionPolicyResponse($policy);
        $this->assertSame($policy, $response->getPolicy());
        $response = new CreateSystemRetentionPolicyResponse(new Policy(Type::SYSTEM(), '', '', ''));
        $response->setPolicy($policy);
        $this->assertSame($policy, $response->getPolicy());

        $body = new CreateSystemRetentionPolicyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateSystemRetentionPolicyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateSystemRetentionPolicyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateSystemRetentionPolicyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">'
                . '<soap:Body>'
                    . '<urn:CreateSystemRetentionPolicyRequest>'
                        . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                        . '<keep>'
                            . '<urn1:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</keep>'
                        . '<purge>'
                            . '<urn1:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</purge>'
                    . '</urn:CreateSystemRetentionPolicyRequest>'
                    . '<urn:CreateSystemRetentionPolicyResponse>'
                        . '<urn1:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                    . '</urn:CreateSystemRetentionPolicyResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateSystemRetentionPolicyEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateSystemRetentionPolicyRequest' => [
                    'cos' => [
                        'by' => (string) CosBy::NAME(),
                        '_content' => $value,
                    ],
                    'keep' => [
                        'policy' => [
                            'type' => (string) Type::SYSTEM(),
                            'id' => $id,
                            'name' => $name,
                            'lifetime' => $lifetime,
                            '_jsns' => 'urn:zimbraMail',
                        ],
                    ],
                    'purge' => [
                        'policy' => [
                            'type' => (string) Type::SYSTEM(),
                            'id' => $id,
                            'name' => $name,
                            'lifetime' => $lifetime,
                            '_jsns' => 'urn:zimbraMail',
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateSystemRetentionPolicyResponse' => [
                    'policy' => [
                        'type' => (string) Type::SYSTEM(),
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateSystemRetentionPolicyEnvelope::class, 'json'));
    }
}
