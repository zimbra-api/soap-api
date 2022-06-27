<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetServerBody;
use Zimbra\Admin\Message\GetServerEnvelope;
use Zimbra\Admin\Message\GetServerRequest;
use Zimbra\Admin\Message\GetServerResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ServerInfo;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetServerTest.
 */
class GetServerTest extends ZimbraTestCase
{
    public function testGetServer()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $serverSel = new ServerSelector(ServerBy::NAME(), $value);
        $serverInfo = new ServerInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetServerRequest($serverSel, FALSE, $attrs);
        $this->assertSame($serverSel, $request->getServer());
        $this->assertFalse($request->isApplyConfig());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetServerRequest();
        $request->setServer($serverSel)
            ->setApplyConfig(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($serverSel, $request->getServer());
        $this->assertTrue($request->isApplyConfig());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetServerResponse($serverInfo);
        $this->assertSame($serverInfo, $response->getServer());
        $response = new GetServerResponse();
        $response->setServer($serverInfo);
        $this->assertSame($serverInfo, $response->getServer());

        $body = new GetServerBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetServerBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetServerEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetServerEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerRequest attrs="$attrs" applyConfig="true">
            <urn:server by="name">$value</urn:server>
        </urn:GetServerRequest>
        <urn:GetServerResponse>
            <urn:server name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:server>
        </urn:GetServerResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetServerEnvelope::class, 'xml'));
    }
}
