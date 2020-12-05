<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminCreateWaitSetBody;
use Zimbra\Admin\Message\AdminCreateWaitSetEnvelope;
use Zimbra\Admin\Message\AdminCreateWaitSetRequest;
use Zimbra\Admin\Message\AdminCreateWaitSetResponse;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\IdAndType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCreateWaitSet.
 */
class AdminCreateWaitSetTest extends ZimbraStructTestCase
{
    public function testAdminCreateWaitSet()
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
            $defaultInterests, FALSE, [$a]
        );
        $this->assertSame($defaultInterests, $request->getDefaultInterests());
        $this->assertFalse($request->getAllAccounts());
        $this->assertSame([$a], $request->getAccounts());

        $request = new AdminCreateWaitSetRequest('');
        $request->setDefaultInterests($defaultInterests)
            ->setAllAccounts(TRUE)
            ->setAccounts([$a])
            ->addAccount($a);
        $this->assertSame($defaultInterests, $request->getDefaultInterests());
        $this->assertTrue($request->getAllAccounts());
        $this->assertSame([$a, $a], $request->getAccounts());
        $request->setAccounts([$a]);

        $response = new AdminCreateWaitSetResponse(
            $waitSetId, $defaultInterests, $sequence, [$error]
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertSame($defaultInterests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertSame([$error], $response->getErrors());

        $response = new AdminCreateWaitSetResponse('', '', 0);
        $response->setWaitSetId($waitSetId)
            ->setDefaultInterests($defaultInterests)
            ->setSequence($sequence)
            ->setErrors([$error])
            ->addError($error);
        $this->assertSame($waitSetId, $response->getWaitSetId());
        $this->assertSame($defaultInterests, $response->getDefaultInterests());
        $this->assertSame($sequence, $response->getSequence());
        $this->assertSame([$error, $error], $response->getErrors());
        $response->setErrors([$error]);

        $body = new AdminCreateWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new AdminCreateWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AdminCreateWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AdminCreateWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:AdminCreateWaitSetRequest defTypes="$defaultInterests" allAccounts="true">
            <add>
                <a name="$name" id="$id" token="$token" types="f,m" />
            </add>
        </urn:AdminCreateWaitSetRequest>
        <urn:AdminCreateWaitSetResponse waitSet="$waitSetId" defTypes="$defaultInterests" seq="$sequence">
            <error id="$id" type="$type" />
        </urn:AdminCreateWaitSetResponse>
    </soap:Body>
</soap:Envelope>
EOT;
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AdminCreateWaitSetEnvelope::class, 'json'));
    }
}
