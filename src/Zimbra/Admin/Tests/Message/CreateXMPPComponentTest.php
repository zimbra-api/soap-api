<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateXMPPComponentBody;
use Zimbra\Admin\Message\CreateXMPPComponentEnvelope;
use Zimbra\Admin\Message\CreateXMPPComponentRequest;
use Zimbra\Admin\Message\CreateXMPPComponentResponse;
use Zimbra\Admin\Struct\{Attr, DomainSelector, ServerSelector, XMPPComponentInfo, XMPPComponentSpec};
use Zimbra\Enum\{DomainBy, ServerBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateXMPPComponent.
 */
class CreateXMPPComponentTest extends ZimbraStructTestCase
{
    public function testCreateXMPPComponent()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $domainName = $this->faker->word;
        $serverName = $this->faker->word;

        $attr = new Attr($key, $value);
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $xmppSpec = new XMPPComponentSpec($name, $domain, $server, [$attr]);
        $request = new CreateXMPPComponentRequest($xmppSpec);
        $this->assertSame($xmppSpec, $request->getComponent());
        $request = new CreateXMPPComponentRequest(new XMPPComponentSpec('', $domain, $server));
        $request->setComponent($xmppSpec);
        $this->assertSame($xmppSpec, $request->getComponent());


        $xmppInfo = new XMPPComponentInfo($name, $id, $domainName, $serverName, [$attr]);
        $response = new CreateXMPPComponentResponse($xmppInfo);
        $this->assertSame($xmppInfo, $response->getComponent());
        $response = new CreateXMPPComponentResponse(new XMPPComponentInfo('', ''));
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
            <xmppcomponent name="$name">
                <a n="$key">$value</a>
                <domain by="name">$value</domain>
                <server by="name">$value</server>
            </xmppcomponent>
        </urn:CreateXMPPComponentRequest>
        <urn:CreateXMPPComponentResponse>
            <xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <a n="$key">$value</a>
            </xmppcomponent>
        </urn:CreateXMPPComponentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateXMPPComponentEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateXMPPComponentRequest' => [
                    'xmppcomponent' => [
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'name' => $name,
                        'domain' => [
                            'by' => 'name',
                            '_content' => $value,
                        ],
                        'server' => [
                            'by' => 'name',
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateXMPPComponentResponse' => [
                    'xmppcomponent' => [
                        'name' => $name,
                        'id' => $id,
                        'x-domainName' => $domainName,
                        'x-serverName' => $serverName,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateXMPPComponentEnvelope::class, 'json'));
    }
}
