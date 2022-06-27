<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetSystemRetentionPolicyBody;
use Zimbra\Admin\Message\GetSystemRetentionPolicyEnvelope;
use Zimbra\Admin\Message\GetSystemRetentionPolicyRequest;
use Zimbra\Admin\Message\GetSystemRetentionPolicyResponse;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Common\Enum\Type;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetSystemRetentionPolicy.
 */
class GetSystemRetentionPolicyTest extends ZimbraTestCase
{
    public function testGetSystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $keep = new Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $purge = new Policy(Type::USER(), $id, $name, $lifetime);
        $retention = new RetentionPolicy([$keep], [$purge]);

        $request = new GetSystemRetentionPolicyRequest($cos);
        $this->assertSame($cos, $request->getCos());
        $request = new GetSystemRetentionPolicyRequest();
        $request->setCos($cos);
        $this->assertSame($cos, $request->getCos());

        $response = new GetSystemRetentionPolicyResponse($retention);
        $this->assertSame($retention, $response->getRetentionPolicy());
        $response = new GetSystemRetentionPolicyResponse(new RetentionPolicy());
        $response->setRetentionPolicy($retention);
        $this->assertSame($retention, $response->getRetentionPolicy());

        $body = new GetSystemRetentionPolicyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetSystemRetentionPolicyBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetSystemRetentionPolicyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetSystemRetentionPolicyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:GetSystemRetentionPolicyRequest>
            <urn:cos by="name">$value</urn:cos>
        </urn:GetSystemRetentionPolicyRequest>
        <urn:GetSystemRetentionPolicyResponse>
            <urn1:retentionPolicy>
                <urn1:keep>
                    <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                </urn1:keep>
                <urn1:purge>
                    <urn1:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                </urn1:purge>
            </urn1:retentionPolicy>
        </urn:GetSystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSystemRetentionPolicyEnvelope::class, 'xml'));
    }
}
