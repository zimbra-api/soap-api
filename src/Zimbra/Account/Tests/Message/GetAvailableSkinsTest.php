<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\GetAvailableSkinsBody;
use Zimbra\Account\Message\GetAvailableSkinsEnvelope;
use Zimbra\Account\Message\GetAvailableSkinsRequest;
use Zimbra\Account\Message\GetAvailableSkinsResponse;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAvailableSkinsTest.
 */
class GetAvailableSkinsTest extends ZimbraStructTestCase
{
    public function testGetAvailableSkins()
    {
        $name = $this->faker->word;

        $request = new GetAvailableSkinsRequest();

        $skin = new NamedElement($name);
        $response = new GetAvailableSkinsResponse([$skin]);
        $this->assertSame([$skin], $response->getSkins());
        $response = new GetAvailableSkinsResponse();
        $response->setSkins([$skin])
            ->addSkin($skin);
        $this->assertSame([$skin, $skin], $response->getSkins());
        $response->setSkins([$skin]);

        $body = new GetAvailableSkinsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAvailableSkinsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAvailableSkinsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAvailableSkinsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:GetAvailableSkinsRequest />
        <urn:GetAvailableSkinsResponse>
            <skin name="$name" />
        </urn:GetAvailableSkinsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAvailableSkinsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAvailableSkinsRequest' => [
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'GetAvailableSkinsResponse' => [
                    'skin' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAvailableSkinsEnvelope::class, 'json'));
    }
}
