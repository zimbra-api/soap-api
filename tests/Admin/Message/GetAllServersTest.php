<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllServersBody;
use Zimbra\Admin\Message\GetAllServersEnvelope;
use Zimbra\Admin\Message\GetAllServersRequest;
use Zimbra\Admin\Message\GetAllServersResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllServersTest.
 */
class GetAllServersTest extends ZimbraTestCase
{
    public function testGetAllServers()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $service = $this->faker->word;
        $alwaysOnClusterId = $this->faker->word;

        $server = new ServerInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllServersRequest($service, $alwaysOnClusterId, FALSE);
        $this->assertSame($service, $request->getService());
        $this->assertEquals($alwaysOnClusterId, $request->getAlwaysOnClusterId());
        $this->assertFalse($request->isApplyConfig());
        $request = new GetAllServersRequest();
        $request->setService($service)
             ->setAlwaysOnClusterId($alwaysOnClusterId)
             ->setApplyConfig(TRUE);
        $this->assertSame($service, $request->getService());
        $this->assertEquals($alwaysOnClusterId, $request->getAlwaysOnClusterId());
        $this->assertTrue($request->isApplyConfig());

        $response = new GetAllServersResponse([$server]);
        $this->assertSame([$server], $response->getServerList());

        $response = new GetAllServersResponse();
        $response->setServerList([$server])
            ->addServer($server);
        $this->assertSame([$server, $server], $response->getServerList());
        $response->setServerList([$server]);

        $body = new GetAllServersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllServersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllServersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllServersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllServersRequest service="$service" alwaysOnClusterId="$alwaysOnClusterId" applyConfig="true" />
        <urn:GetAllServersResponse>
            <server name="$name" id="$id">
                <a n="$key">$value</a>
            </server>
        </urn:GetAllServersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllServersEnvelope::class, 'xml'));
    }
}
