<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateServerBody;
use Zimbra\Admin\Message\CreateServerEnvelope;
use Zimbra\Admin\Message\CreateServerRequest;
use Zimbra\Admin\Message\CreateServerResponse;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateServer.
 */
class CreateServerTest extends ZimbraStructTestCase
{
    public function testCreateServer()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;

        $request = new CreateServerRequest($name);
        $this->assertSame($name, $request->getName());

        $request = new CreateServerRequest('');
        $request->setName($name)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($name, $request->getName());

        $server = new ServerInfo($name, $id, [new Attr($key, $value)]);
        $response = new CreateServerResponse($server);
        $this->assertSame($server, $response->getServer());
        $response = new CreateServerResponse(new ServerInfo('', ''));
        $response->setServer($server);
        $this->assertSame($server, $response->getServer());

        $body = new CreateServerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateServerBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateServerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateServerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateServerRequest name="$name">
            <a n="$key">$value</a>
        </urn:CreateServerRequest>
        <urn:CreateServerResponse>
            <server name="$name" id="$id">
                <a n="$key">$value</a>
            </server>
        </urn:CreateServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateServerEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateServerRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateServerResponse' => [
                    'server' => [
                        'name' => $name,
                        'id' => $id,
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateServerEnvelope::class, 'json'));
    }
}
