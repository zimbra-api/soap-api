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
        $value= $this->faker->word;
        $value1 = $this->faker->text;
        $value2 = $this->faker->text;
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

        $request = new GetCreateObjectAttrsRequest(new TargetWithType('', ''));
        $request->setTarget($target)
            ->setDomain($domain)
            ->setCos($cos);
        $this->assertSame($target, $request->getTarget());
        $this->assertSame($domain, $request->getDomain());
        $this->assertSame($cos, $request->getCos());

        $response = new GetCreateObjectAttrsResponse($setAttrs);
        $this->assertSame($setAttrs, $response->getSetAttrs());
        $response = new GetCreateObjectAttrsResponse(new EffectiveAttrsInfo(FALSE));
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
            <target type="$type">$value</target>
            <domain by="name">$value</domain>
            <cos by="name">$value</cos>
        </urn:GetCreateObjectAttrsRequest>
        <urn:GetCreateObjectAttrsResponse>
            <setAttrs all="true">
                <a n="$name">
                    <constraint>
                        <min>$min</min>
                        <max>$max</max>
                        <values>
                            <v>$value1</v>
                            <v>$value2</v>
                        </values>
                    </constraint>
                    <default>
                        <v>$value1</v>
                        <v>$value2</v>
                    </default>
                </a>
            </setAttrs>
        </urn:GetCreateObjectAttrsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetCreateObjectAttrsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetCreateObjectAttrsRequest' => [
                    'target' => [
                        'type' => $type,
                        '_content' => $value,
                    ],
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'cos' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetCreateObjectAttrsResponse' => [
                    'setAttrs' => [
                        'all' => TRUE,
                        'a' => [
                            [
                                'n' => $name,
                                'constraint' => [
                                    'min' => [
                                        '_content' => $min,
                                    ],
                                    'max' => [
                                        '_content' => $max,
                                    ],
                                    'values' => [
                                        'v' => [
                                            [
                                                '_content' => $value1,
                                            ],
                                            [
                                                '_content' => $value2,
                                            ],
                                        ],
                                    ],
                                ],
                                'default' => [
                                    'v' => [
                                        [
                                            '_content' => $value1,
                                        ],
                                        [
                                            '_content' => $value2,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetCreateObjectAttrsEnvelope::class, 'json'));
    }
}
