<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminCreateWaitSetBody;
use Zimbra\Admin\Message\AdminCreateWaitSetEnvelope;
use Zimbra\Admin\Message\AdminCreateWaitSetRequest;
use Zimbra\Admin\Message\AdminCreateWaitSetResponse;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\IdAndType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCreateWaitSet.
 */
class AdminCreateWaitSetTest extends ZimbraStructTestCase
{
    public function testAdminCreateWaitSetRequest()
    {
        $defaultInterests = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $a = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));

        $req = new AdminCreateWaitSetRequest(
            $defaultInterests, FALSE, [$a]
        );
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertFalse($req->getAllAccounts());
        $this->assertSame([$a], $req->getAccounts());

        $req = new AdminCreateWaitSetRequest('');
        $req->setDefaultInterests($defaultInterests)
            ->setAllAccounts(TRUE)
            ->setAccounts([$a])
            ->addAccount($a);
        $this->assertSame($defaultInterests, $req->getDefaultInterests());
        $this->assertTrue($req->getAllAccounts());
        $this->assertSame([$a, $a], $req->getAccounts());

        $req = new AdminCreateWaitSetRequest(
            $defaultInterests, TRUE, [$a]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetRequest defTypes="' . $defaultInterests . '" allAccounts="true">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                . '</add>'
            . '</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, AdminCreateWaitSetRequest::class, 'xml'));

        $json = json_encode([
            'defTypes' => $defaultInterests,
            'allAccounts' => TRUE,
            'add' => [
                'a' => [
                    [
                        'name' => $name,
                        'id' => $id,
                        'token' => $token,
                        'types' => 'f,m',
                    ],
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, AdminCreateWaitSetRequest::class, 'json'));
    }

    public function testAdminCreateWaitSetResponse()
    {
        $waitSetId = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $sequence = mt_rand(1, 99);

        $id = $this->faker->uuid;
        $type = $this->faker->word;
        $error = new IdAndType($id, $type);

        $res = new AdminCreateWaitSetResponse(
            $waitSetId, $defaultInterests, $sequence, [$error]
        );
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertSame($defaultInterests, $res->getDefaultInterests());
        $this->assertSame($sequence, $res->getSequence());
        $this->assertSame([$error], $res->getErrors());

        $res = new AdminCreateWaitSetResponse('', '', 0);
        $res->setWaitSetId($waitSetId)
            ->setDefaultInterests($defaultInterests)
            ->setSequence($sequence)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($waitSetId, $res->getWaitSetId());
        $this->assertSame($defaultInterests, $res->getDefaultInterests());
        $this->assertSame($sequence, $res->getSequence());
        $this->assertSame([$error, $error], $res->getErrors());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetResponse waitSet="' . $waitSetId . '" defTypes="' . $defaultInterests . '" seq="' . $sequence . '">'
                . '<error id="' . $id . '" type="' . $type . '" />'
                . '<error id="' . $id . '" type="' . $type . '" />'
            . '</AdminCreateWaitSetResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, AdminCreateWaitSetResponse::class, 'xml'));

        $json = json_encode([
            'waitSet' => $waitSetId,
            'defTypes' => $defaultInterests,
            'seq' => $sequence,
            'error' => [
                [
                    'id' => $id,
                    'type' => $type,
                ],
                [
                    'id' => $id,
                    'type' => $type,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, AdminCreateWaitSetResponse::class, 'json'));
    }

    public function testAdminCreateWaitSetBody()
    {
        $waitSetId = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $type = $this->faker->word;
        $sequence = mt_rand(1, 99);

        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $a = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $error = new IdAndType($id, $type);

        $request = new AdminCreateWaitSetRequest(
            $defaultInterests, TRUE, [$a]
        );
        $response = new AdminCreateWaitSetResponse(
            $waitSetId, $defaultInterests, $sequence, [$error]
        );

        $body = new AdminCreateWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AdminCreateWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:AdminCreateWaitSetRequest defTypes="' . $defaultInterests . '" allAccounts="true">'
                    .'<add>'
                        .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                    .'</add>'
                . '</urn:AdminCreateWaitSetRequest>'
                . '<urn:AdminCreateWaitSetResponse waitSet="' . $waitSetId . '" defTypes="' . $defaultInterests . '" seq="' . $sequence . '">'
                    . '<error id="' . $id . '" type="' . $type . '" />'
                . '</urn:AdminCreateWaitSetResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, AdminCreateWaitSetBody::class, 'xml'));

        $json = json_encode([
            'AdminCreateWaitSetRequest' => [
                'defTypes' => $defaultInterests,
                'allAccounts' => TRUE,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f,m',
                        ],
                    ]
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'AdminCreateWaitSetResponse' => [
                'waitSet' => $waitSetId,
                'defTypes' => $defaultInterests,
                'seq' => $sequence,
                'error' => [
                    [
                        'id' => $id,
                        'type' => $type,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, AdminCreateWaitSetBody::class, 'json'));
    }

    public function testAdminCreateWaitSetEnvelope()
    {
        $waitSetId = $this->faker->uuid;
        $defaultInterests = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $token = $this->faker->word;
        $type = $this->faker->word;
        $sequence = mt_rand(1, 99);

        $interests = [
            InterestType::FOLDERS()->getValue(),
            InterestType::MESSAGES()->getValue(),
        ];

        $a = new WaitSetAddSpec($name, $id, $token, implode(',', $interests));
        $error = new IdAndType($id, $type);

        $request = new AdminCreateWaitSetRequest(
            $defaultInterests, TRUE, [$a]
        );
        $response = new AdminCreateWaitSetResponse(
            $waitSetId, $defaultInterests, $sequence, [$error]
        );
        $body = new AdminCreateWaitSetBody($request, $response);

        $envelope = new AdminCreateWaitSetEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AdminCreateWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AdminCreateWaitSetRequest defTypes="' . $defaultInterests . '" allAccounts="true">'
                        .'<add>'
                            .'<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m" />'
                        .'</add>'
                    . '</urn:AdminCreateWaitSetRequest>'
                    . '<urn:AdminCreateWaitSetResponse waitSet="' . $waitSetId . '" defTypes="' . $defaultInterests . '" seq="' . $sequence . '">'
                        . '<error id="' . $id . '" type="' . $type . '" />'
                    . '</urn:AdminCreateWaitSetResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AdminCreateWaitSetEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AdminCreateWaitSetRequest' => [
                    'defTypes' => $defaultInterests,
                    'allAccounts' => TRUE,
                    'add' => [
                        'a' => [
                            [
                                'name' => $name,
                                'id' => $id,
                                'token' => $token,
                                'types' => 'f,m',
                            ],
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AdminCreateWaitSetResponse' => [
                    'waitSet' => $waitSetId,
                    'defTypes' => $defaultInterests,
                    'seq' => $sequence,
                    'error' => [
                        [
                            'id' => $id,
                            'type' => $type,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AdminCreateWaitSetEnvelope::class, 'json'));
    }
}
