<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyDelegatedAdminConstraintsBody;
use Zimbra\Admin\Message\ModifyDelegatedAdminConstraintsEnvelope;
use Zimbra\Admin\Message\ModifyDelegatedAdminConstraintsRequest;
use Zimbra\Admin\Message\ModifyDelegatedAdminConstraintsResponse;
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyDelegatedAdminConstraints.
 */
class ModifyDelegatedAdminConstraintsTest extends ZimbraTestCase
{
    public function testModifyDelegatedAdminConstraints()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $attr = new ConstraintAttr(new ConstraintInfo($min, $max, [$value]), $name);

        $request = new ModifyDelegatedAdminConstraintsRequest(TargetType::DOMAIN(), $id, $name, [$attr]);
        $this->assertEquals(TargetType::DOMAIN(), $request->getType());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());
        $this->assertSame([$attr], $request->getAttrs());
        $request = new ModifyDelegatedAdminConstraintsRequest();
        $request->setType(TargetType::SERVER())
            ->setId($id)
            ->setName($name)
            ->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertEquals(TargetType::SERVER(), $request->getType());
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getName());
        $this->assertSame([$attr, $attr], $request->getAttrs());
        $request->setAttrs([$attr]);

        $response = new ModifyDelegatedAdminConstraintsResponse();

        $body = new ModifyDelegatedAdminConstraintsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyDelegatedAdminConstraintsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyDelegatedAdminConstraintsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyDelegatedAdminConstraintsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDelegatedAdminConstraintsRequest type="server" id="$id" name="$name">
            <urn:a name="$name">
                <urn:constraint>
                    <urn:min>$min</urn:min>
                    <urn:max>$max</urn:max>
                    <urn:values>
                        <urn:v>$value</urn:v>
                    </urn:values>
                </urn:constraint>
            </urn:a>
        </urn:ModifyDelegatedAdminConstraintsRequest>
        <urn:ModifyDelegatedAdminConstraintsResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyDelegatedAdminConstraintsEnvelope::class, 'xml'));
    }
}
