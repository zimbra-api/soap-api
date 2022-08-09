<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllXMPPComponentsBody;
use Zimbra\Admin\Message\GetAllXMPPComponentsEnvelope;
use Zimbra\Admin\Message\GetAllXMPPComponentsRequest;
use Zimbra\Admin\Message\GetAllXMPPComponentsResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllXMPPComponentsTest.
 */
class GetAllXMPPComponentsTest extends ZimbraTestCase
{
    public function testGetAllXMPPComponents()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $domainName = $this->faker->word;
        $serverName = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $xmpp = new XMPPComponentInfo($name, $id, $domainName, $serverName, [new Attr($key, $value)]);

        $request = new GetAllXMPPComponentsRequest();

        $response = new GetAllXMPPComponentsResponse([$xmpp]);
        $this->assertSame([$xmpp], $response->getComponents());
        $response = new GetAllXMPPComponentsResponse();
        $response->setComponents([$xmpp]);
        $this->assertSame([$xmpp], $response->getComponents());

        $body = new GetAllXMPPComponentsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllXMPPComponentsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllXMPPComponentsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllXMPPComponentsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllXMPPComponentsRequest />
        <urn:GetAllXMPPComponentsResponse>
            <urn:xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <urn:a n="$key">$value</urn:a>
            </urn:xmppcomponent>
        </urn:GetAllXMPPComponentsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllXMPPComponentsEnvelope::class, 'xml'));
    }
}
