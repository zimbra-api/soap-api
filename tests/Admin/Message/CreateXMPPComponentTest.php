<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateXMPPComponentBody;
use Zimbra\Admin\Message\CreateXMPPComponentEnvelope;
use Zimbra\Admin\Message\CreateXMPPComponentRequest;
use Zimbra\Admin\Message\CreateXMPPComponentResponse;
use Zimbra\Admin\Struct\{Attr, DomainSelector, ServerSelector, XMPPComponentInfo, XMPPComponentSpec};
use Zimbra\Common\Enum\{DomainBy, ServerBy};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateXMPPComponent.
 */
class CreateXMPPComponentTest extends ZimbraTestCase
{
    public function testCreateXMPPComponent()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $domainName = $this->faker->domainName;
        $serverName = $this->faker->word;

        $attr = new Attr($key, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $xmppSpec = new XMPPComponentSpec($name, $domain, $server, [$attr]);
        $request = new CreateXMPPComponentRequest($xmppSpec);
        $this->assertSame($xmppSpec, $request->getComponent());
        $request = new CreateXMPPComponentRequest(new XMPPComponentSpec($name, $domain, $server));
        $request->setComponent($xmppSpec);
        $this->assertSame($xmppSpec, $request->getComponent());


        $xmppInfo = new XMPPComponentInfo($name, $id, $domainName, $serverName, [$attr]);
        $response = new CreateXMPPComponentResponse($xmppInfo);
        $this->assertSame($xmppInfo, $response->getComponent());
        $response = new CreateXMPPComponentResponse();
        $response->setComponent($xmppInfo);
        $this->assertSame($xmppInfo, $response->getComponent());

        $body = new CreateXMPPComponentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateXMPPComponentBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateXMPPComponentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateXMPPComponentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateXMPPComponentRequest>
            <urn:xmppcomponent name="$name">
                <urn:a n="$key">$value</urn:a>
                <urn:domain by="name">$value</urn:domain>
                <urn:server by="name">$value</urn:server>
            </urn:xmppcomponent>
        </urn:CreateXMPPComponentRequest>
        <urn:CreateXMPPComponentResponse>
            <urn:xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <urn:a n="$key">$value</urn:a>
            </urn:xmppcomponent>
        </urn:CreateXMPPComponentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateXMPPComponentEnvelope::class, 'xml'));
    }
}
