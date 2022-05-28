<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteXMPPComponentBody;
use Zimbra\Admin\Message\DeleteXMPPComponentEnvelope;
use Zimbra\Admin\Message\DeleteXMPPComponentRequest;
use Zimbra\Admin\Message\DeleteXMPPComponentResponse;
use Zimbra\Admin\Struct\XMPPComponentSelector;
use Zimbra\Common\Enum\XmppComponentBy as XmppBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteXMPPComponent.
 */
class DeleteXMPPComponentTest extends ZimbraTestCase
{
    public function testDeleteXMPPComponent()
    {
        $value = $this->faker->word;
        $component = new XMPPComponentSelector(XmppBy::NAME(), $value);

        $request = new DeleteXMPPComponentRequest($component);
        $this->assertSame($component, $request->getComponent());
        $request = new DeleteXMPPComponentRequest();
        $request->setComponent($component);
        $this->assertSame($component, $request->getComponent());

        $response = new DeleteXMPPComponentResponse();

        $body = new DeleteXMPPComponentBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteXMPPComponentBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteXMPPComponentEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteXMPPComponentEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteXMPPComponentRequest>
            <xmppcomponent by="name">$value</xmppcomponent>
        </urn:DeleteXMPPComponentRequest>
        <urn:DeleteXMPPComponentResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteXMPPComponentEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteXMPPComponentRequest' => [
                    'xmppcomponent' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteXMPPComponentResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteXMPPComponentEnvelope::class, 'json'));
    }
}
