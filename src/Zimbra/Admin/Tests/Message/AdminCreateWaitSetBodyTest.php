<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\AdminCreateWaitSetBody;
use Zimbra\Admin\Message\AdminCreateWaitSetRequest;
use Zimbra\Admin\Message\AdminCreateWaitSetResponse;
use Zimbra\Enum\InterestType;
use Zimbra\Struct\IdAndType;
use Zimbra\Struct\WaitSetAddSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminCreateWaitSetBody.
 */
class AdminCreateWaitSetBodyTest extends ZimbraStructTestCase
{
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
}
