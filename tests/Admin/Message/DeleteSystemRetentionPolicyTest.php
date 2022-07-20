<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteSystemRetentionPolicyBody;
use Zimbra\Admin\Message\DeleteSystemRetentionPolicyEnvelope;
use Zimbra\Admin\Message\DeleteSystemRetentionPolicyRequest;
use Zimbra\Admin\Message\DeleteSystemRetentionPolicyResponse;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Mail\Struct\Policy;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Common\Enum\Type;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteSystemRetentionPolicy.
 */
class DeleteSystemRetentionPolicyTest extends ZimbraTestCase
{
    public function testDeleteSystemRetentionPolicy()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $lifetime = $this->faker->word;

        $cos = new CosSelector(CosBy::NAME(), $value);
        $policy = new Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $request = new DeleteSystemRetentionPolicyRequest($policy, $cos);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($policy, $request->getPolicy());
        $request = new DeleteSystemRetentionPolicyRequest(
            new Policy()
        );
        $request->setCos($cos)
            ->setPolicy($policy);
        $this->assertSame($cos, $request->getCos());
        $this->assertSame($policy, $request->getPolicy());

        $response = new DeleteSystemRetentionPolicyResponse();

        $body = new DeleteSystemRetentionPolicyBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteSystemRetentionPolicyBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteSystemRetentionPolicyEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteSystemRetentionPolicyEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin" xmlns:urn1="urn:zimbraMail">
    <soap:Body>
        <urn:DeleteSystemRetentionPolicyRequest>
            <urn:cos by="name">$value</urn:cos>
            <urn1:policy type="system" id="$id" name="$name" lifetime="$lifetime" />
        </urn:DeleteSystemRetentionPolicyRequest>
        <urn:DeleteSystemRetentionPolicyResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteSystemRetentionPolicyEnvelope::class, 'xml'));
    }
}
