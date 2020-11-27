<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllXMPPComponentsBody;
use Zimbra\Admin\Message\GetAllXMPPComponentsEnvelope;
use Zimbra\Admin\Message\GetAllXMPPComponentsRequest;
use Zimbra\Admin\Message\GetAllXMPPComponentsResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\XMPPComponentInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllXMPPComponentsTest.
 */
class GetAllXMPPComponentsTest extends ZimbraStructTestCase
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
        $response->setComponents([$xmpp])
            ->addComponent($xmpp);
        $this->assertSame([$xmpp, $xmpp], $response->getComponents());
        $response->setComponents([$xmpp]);

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllXMPPComponentsRequest />'
                    . '<urn:GetAllXMPPComponentsResponse>'
                        . '<xmppcomponent name="' . $name . '" id="' . $id . '" x-domainName="' . $domainName . '" x-serverName="' . $serverName . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</xmppcomponent>'
                    . '</urn:GetAllXMPPComponentsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllXMPPComponentsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllXMPPComponentsRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllXMPPComponentsResponse' => [
                    'xmppcomponent' => [
                        [
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
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllXMPPComponentsEnvelope::class, 'json'));
    }
}
