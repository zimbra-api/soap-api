<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\RenameCosBody;
use Zimbra\Admin\Message\RenameCosEnvelope;
use Zimbra\Admin\Message\RenameCosRequest;
use Zimbra\Admin\Message\RenameCosResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\CosInfo;
use Zimbra\Admin\Struct\CosInfoAttr;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RenameCos.
 */
class RenameCosTest extends ZimbraStructTestCase
{
    public function testRenameCos()
    {
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $request = new RenameCosRequest(
            $id, $name
        );
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());
        $request = new RenameCosRequest('', '');
        $request->setId($id)
            ->setNewName($name);
        $this->assertSame($id, $request->getId());
        $this->assertSame($name, $request->getNewName());

        $cos = new CosInfo($name, $id, TRUE, [new CosInfoAttr($key, $value, TRUE, TRUE)]);
        $response = new RenameCosResponse($cos);
        $this->assertSame($cos, $response->getCos());
        $response = new RenameCosResponse(new CosInfo('', ''));
        $response->setCos($cos);
        $this->assertSame($cos, $response->getCos());

        $body = new RenameCosBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new RenameCosBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RenameCosEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new RenameCosEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:RenameCosRequest>
            <id>$id</id>
            <newName>$name</newName>
        </urn:RenameCosRequest>
        <urn:RenameCosResponse>
            <cos name="$name" id="$id" isDefaultCos="true">
                <a n="$key" c="true" pd="true">$value</a>
            </cos>
        </urn:RenameCosResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RenameCosEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'RenameCosRequest' => [
                    'id' => [
                        '_content' => $id,
                    ],
                    'newName' => [
                        '_content' => $name,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'RenameCosResponse' => [
                    'cos' => [
                        'name' => $name,
                        'id' => $id,
                        'isDefaultCos' => TRUE,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                                'c' => TRUE,
                                'pd' => TRUE,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, RenameCosEnvelope::class, 'json'));
    }
}
