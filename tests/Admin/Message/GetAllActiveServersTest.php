<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllActiveServersBody;
use Zimbra\Admin\Message\GetAllActiveServersEnvelope;
use Zimbra\Admin\Message\GetAllActiveServersRequest;
use Zimbra\Admin\Message\GetAllActiveServersResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllActiveServersTest.
 */
class GetAllActiveServersTest extends ZimbraTestCase
{
    public function testGetAllActiveServers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $server = new ServerInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllActiveServersRequest();

        $response = new GetAllActiveServersResponse([$server]);
        $this->assertSame([$server], $response->getServerList());
        $response = new GetAllActiveServersResponse();
        $response->setServerList([$server]);
        $this->assertSame([$server], $response->getServerList());

        $body = new GetAllActiveServersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllActiveServersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllActiveServersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllActiveServersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllActiveServersRequest />
        <urn:GetAllActiveServersResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:GetAllActiveServersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllActiveServersEnvelope::class, 'xml'));
    }
}
