<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetCreateObjectAttrsBody, GetCreateObjectAttrsEnvelope, GetCreateObjectAttrsRequest, GetCreateObjectAttrsResponse};

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Enum\CosBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetCreateObjectAttrs.
 */
class GetCreateObjectAttrsTest extends ZimbraTestCase
{
    public function testGetCreateObjectAttrs()
    {
        $type = $this->faker->word;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $value1 = $this->faker->unique->word;
        $value2 = $this->faker->unique->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $target = new TargetWithType($type, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $cos = new CosSelector(CosBy::NAME(), $value);

        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);

        $request = new GetCreateObjectAttrsRequest($target, $domain, $cos);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($cos, $request->getCos());

        $request = new GetCreateObjectAttrsRequest(new TargetWithType());
        $request->setTarget($target)
            ->setDomain($domain)
            ->setCos($cos);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($cos, $request->getCos());

        $response = new GetCreateObjectAttrsResponse($setAttrs);
        $this->assertSame($setAttrs, $response->getSetAttrs());
        $response = new GetCreateObjectAttrsResponse();
        $response->setSetAttrs($setAttrs);
        $this->assertSame($setAttrs, $response->getSetAttrs());

        $body = new GetCreateObjectAttrsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetCreateObjectAttrsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetCreateObjectAttrsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetCreateObjectAttrsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetCreateObjectAttrsRequest>
            <urn:target type="$type">$value</urn:target>
            <urn:domain by="name">$value</urn:domain>
            <urn:cos by="name">$value</urn:cos>
        </urn:GetCreateObjectAttrsRequest>
        <urn:GetCreateObjectAttrsResponse>
            <urn:setAttrs all="true">
                <urn:a n="$name">
                    <urn:constraint>
                        <urn:min>$min</urn:min>
                        <urn:max>$max</urn:max>
                        <urn:values>
                            <urn:v>$value1</urn:v>
                            <urn:v>$value2</urn:v>
                        </urn:values>
                    </urn:constraint>
                    <urn:default>
                        <urn:v>$value1</urn:v>
                        <urn:v>$value2</urn:v>
                    </urn:default>
                </urn:a>
            </urn:setAttrs>
        </urn:GetCreateObjectAttrsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCreateObjectAttrsEnvelope::class, 'xml'));
    }
}
