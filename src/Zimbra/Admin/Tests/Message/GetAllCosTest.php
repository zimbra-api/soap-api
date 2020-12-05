<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllCosBody;
use Zimbra\Admin\Message\GetAllCosEnvelope;
use Zimbra\Admin\Message\GetAllCosRequest;
use Zimbra\Admin\Message\GetAllCosResponse;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllCosTest.
 */
class GetAllCosTest extends ZimbraStructTestCase
{
    public function testGetAllCos()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new CosInfoAttr($key, $value, TRUE, FALSE);
        $cos = new CosInfo($name, $id, TRUE, [$attr]);

        $request = new GetAllCosRequest();

        $response = new GetAllCosResponse([$cos]);
        $this->assertSame([$cos], $response->getCosList());
        $response = new GetAllCosResponse();
        $response->setCosList([$cos])
            ->addCos($cos);
        $this->assertSame([$cos, $cos], $response->getCosList());
        $response->setCosList([$cos]);

        $body = new GetAllCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllCosRequest />
        <urn:GetAllCosResponse>
            <cos name="$name" id="$id" isDefaultCos="true">
                <a n="$key" c="true" pd="false">$value</a>
            </cos>
        </urn:GetAllCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllCosRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllCosResponse' => [
                    'cos' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'isDefaultCos' => TRUE,
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                    'c' => TRUE,
                                    'pd' => FALSE,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllCosEnvelope::class, 'json'));
    }
}
