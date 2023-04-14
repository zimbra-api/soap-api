<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetDelegatedAdminConstraintsBody;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsEnvelope;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsRequest;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsResponse;
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Common\Struct\NamedElement;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDelegatedAdminConstraintsTest.
 */
class GetDelegatedAdminConstraintsTest extends ZimbraTestCase
{
    public function testGetDelegatedAdminConstraints()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $attr = new NamedElement($name);
        $constraint = new ConstraintInfo($min, $max, [$value]);
        $constraintAttr = new ConstraintAttr($constraint, $name);

        $request = new GetDelegatedAdminConstraintsRequest(TargetType::ACCOUNT, $id, $name, [$attr]);
        $this->assertEquals(TargetType::ACCOUNT, $request->getType());
        $this->assertSame($name, $request->getName());
        $this->assertSame($id, $request->getId());
        $this->assertSame([$attr], $request->getAttrs());
        $request = new GetDelegatedAdminConstraintsRequest(TargetType::ACCOUNT);
        $request->setType(TargetType::DOMAIN)
            ->setName($name)
            ->setId($id)
            ->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertEquals(TargetType::DOMAIN, $request->getType());
        $this->assertSame($name, $request->getName());
        $this->assertSame($id, $request->getId());
        $this->assertSame([$attr, $attr], $request->getAttrs());
        $request->setAttrs([$attr]);

        $response = new GetDelegatedAdminConstraintsResponse([$constraintAttr]);
        $this->assertSame([$constraintAttr], $response->getAttrs());
        $response = new GetDelegatedAdminConstraintsResponse();
        $response->setAttrs([$constraintAttr]);
        $this->assertSame([$constraintAttr], $response->getAttrs());

        $body = new GetDelegatedAdminConstraintsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDelegatedAdminConstraintsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDelegatedAdminConstraintsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDelegatedAdminConstraintsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDelegatedAdminConstraintsRequest type="domain" name="$name" id="$id">
            <urn:a name="$name" />
        </urn:GetDelegatedAdminConstraintsRequest>
        <urn:GetDelegatedAdminConstraintsResponse>
            <urn:a name="$name">
                <urn:constraint>
                    <urn:min>$min</urn:min>
                    <urn:max>$max</urn:max>
                    <urn:values>
                        <urn:v>$value</urn:v>
                    </urn:values>
                </urn:constraint>
            </urn:a>
        </urn:GetDelegatedAdminConstraintsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDelegatedAdminConstraintsEnvelope::class, 'xml'));
    }
}
