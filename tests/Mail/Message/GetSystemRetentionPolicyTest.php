<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetSystemRetentionPolicyEnvelope;
use Zimbra\Mail\Message\GetSystemRetentionPolicyBody;
use Zimbra\Mail\Message\GetSystemRetentionPolicyRequest;
use Zimbra\Mail\Message\GetSystemRetentionPolicyResponse;

use Zimbra\Common\Enum\Type;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Mail\Struct\RetentionPolicy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetSystemRetentionPolicy.
 */
class GetSystemRetentionPolicyTest extends ZimbraTestCase
{
    public function testGetSystemRetentionPolicy()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $lifetime = $this->faker->word;
        $retention = new RetentionPolicy(
            [new Policy(Type::SYSTEM(), $id, $name, $lifetime)], [new Policy(Type::USER(), $id, $name, $lifetime)]
        );

        $request = new GetSystemRetentionPolicyRequest();
        $response = new GetSystemRetentionPolicyResponse($retention);
        $this->assertSame($retention, $response->getRetentionPolicy());
        $response = new GetSystemRetentionPolicyResponse();
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
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetSystemRetentionPolicyRequest />
        <urn:GetSystemRetentionPolicyResponse>
            <urn:retentionPolicy>
                <urn:keep>
                    <urn:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
                </urn:keep>
                <urn:purge>
                    <urn:policy type="user" id="$id" name="$name" lifetime="$lifetime" />
                </urn:purge>
            </urn:retentionPolicy>
        </urn:GetSystemRetentionPolicyResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetSystemRetentionPolicyEnvelope::class, 'xml'));
    }
}
