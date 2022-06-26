<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyServerBody;
use Zimbra\Admin\Message\ModifyServerEnvelope;
use Zimbra\Admin\Message\ModifyServerRequest;
use Zimbra\Admin\Message\ModifyServerResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyServer.
 */
class ModifyServerTest extends ZimbraTestCase
{
    public function testModifyServer()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyServerRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyServerRequest('');
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $server = new ServerInfo($name, $id, [new Attr($key, $value)]);
        $response = new ModifyServerResponse($server);
        $this->assertEquals($server, $response->getServer());
        $response = new ModifyServerResponse();
        $response->setServer($server);
        $this->assertEquals($server, $response->getServer());

        $body = new ModifyServerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyServerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyServerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyServerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyServerRequest id="$id">
            <urn:a n="$key">$value</urn:a>
        </urn:ModifyServerRequest>
        <urn:ModifyServerResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:ModifyServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyServerEnvelope::class, 'xml'));
    }
}
