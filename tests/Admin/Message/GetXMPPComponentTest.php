<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\{GetXMPPComponentBody, GetXMPPComponentEnvelope, GetXMPPComponentRequest, GetXMPPComponentResponse};

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Enum\XmppComponentBy as XmppBy;

use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GetXMPPComponent.
 */
class GetXMPPComponentTest extends ZimbraStructTestCase
{
    public function testGetXMPPComponent()
    {
        $value = $this->faker->word;
        $name = $this->faker->name;
        $id = $this->faker->uuid;
        $domainName = $this->faker->domainName;
        $serverName = $this->faker->ipv4;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attr1 = $this->faker->word;
        $attr2 = $this->faker->word;
        $attr3 = $this->faker->word;
        $attrs = implode(',', [$attr1, $attr2, $attr3]);

        $xmppSel = new XMPPComponentSelector(XmppBy::NAME(), $value);
        $xmppInfo = new XMPPComponentInfo($name, $id, $domainName, $serverName, [new Attr($key, $value)]);

        $request = new GetXMPPComponentRequest($xmppSel, $attrs);
        $this->assertSame($xmppSel, $request->getComponent());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetXMPPComponentRequest(new XMPPComponentSelector(XmppBy::ID(), ''));
        $request->setComponent($xmppSel)
            ->setAttrs($attr1)
            ->addAttrs($attr2, $attr3);
        $this->assertSame($xmppSel, $request->getComponent());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetXMPPComponentResponse($xmppInfo);
        $this->assertSame($xmppInfo, $response->getComponent());
        $response = new GetXMPPComponentResponse(new XMPPComponentInfo('', '', '', ''));
        $response->setComponent($xmppInfo);
        $this->assertSame($xmppInfo, $response->getComponent());

        $body = new GetXMPPComponentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetXMPPComponentBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetXMPPComponentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetXMPPComponentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetXMPPComponentRequest attrs="$attrs">
            <xmppcomponent by="name">$value</xmppcomponent>
        </urn:GetXMPPComponentRequest>
        <urn:GetXMPPComponentResponse>
            <xmppcomponent name="$name" id="$id" x-domainName="$domainName" x-serverName="$serverName">
                <a n="$key">$value</a>
            </xmppcomponent>
        </urn:GetXMPPComponentResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetXMPPComponentEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetXMPPComponentRequest' => [
                    'attrs' => $attrs,
                    'xmppcomponent' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetXMPPComponentResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetXMPPComponentEnvelope::class, 'json'));
    }
}
