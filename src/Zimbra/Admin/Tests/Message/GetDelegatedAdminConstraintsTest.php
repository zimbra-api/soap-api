<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetDelegatedAdminConstraintsBody;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsEnvelope;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsRequest;
use Zimbra\Admin\Message\GetDelegatedAdminConstraintsResponse;
use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Struct\NamedElement;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetDelegatedAdminConstraintsTest.
 */
class GetDelegatedAdminConstraintsTest extends ZimbraStructTestCase
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

        $request = new GetDelegatedAdminConstraintsRequest(TargetType::ACCOUNT(), $id, $name, [$attr]);
        $this->assertEquals(TargetType::ACCOUNT(), $request->getType());
        $this->assertSame($name, $request->getName());
        $this->assertSame($id, $request->getId());
        $this->assertSame([$attr], $request->getAttrs());
        $request = new GetDelegatedAdminConstraintsRequest(TargetType::ACCOUNT());
        $request->setType(TargetType::DOMAIN())
            ->setName($name)
            ->setId($id)
            ->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertEquals(TargetType::DOMAIN(), $request->getType());
        $this->assertSame($name, $request->getName());
        $this->assertSame($id, $request->getId());
        $this->assertSame([$attr, $attr], $request->getAttrs());
        $request->setAttrs([$attr]);

        $response = new GetDelegatedAdminConstraintsResponse([$constraintAttr]);
        $this->assertSame([$constraintAttr], $response->getAttrs());
        $response = new GetDelegatedAdminConstraintsResponse();
        $response->setAttrs([$constraintAttr])
            ->addAttr($constraintAttr);
        $this->assertSame([$constraintAttr, $constraintAttr], $response->getAttrs());
        $response->setAttrs([$constraintAttr]);

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetDelegatedAdminConstraintsRequest type="' . TargetType::DOMAIN() . '" name="' . $name . '" id="' . $id . '">'
                        . '<a name="' . $name . '" />'
                    . '</urn:GetDelegatedAdminConstraintsRequest>'
                    . '<urn:GetDelegatedAdminConstraintsResponse>'
                        . '<a name="' . $name . '">'
                            . '<constraint>'
                                . '<min>' . $min . '</min>'
                                . '<max>' . $max . '</max>'
                                . '<values>'
                                    . '<v>' . $value . '</v>'
                                . '</values>'
                            . '</constraint>'
                        . '</a>'
                    . '</urn:GetDelegatedAdminConstraintsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDelegatedAdminConstraintsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDelegatedAdminConstraintsRequest' => [
                    'type' => TargetType::DOMAIN()->getValue(),
                    'name' => $name,
                    'id' => $id,
                    'a' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetDelegatedAdminConstraintsResponse' => [
                    'a' => [
                        [
                            'name' => $name,
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
                                            '_content' => $value,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDelegatedAdminConstraintsEnvelope::class, 'json'));
    }
}
