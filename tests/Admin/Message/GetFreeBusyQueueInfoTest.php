<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetFreeBusyQueueInfoBody;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoEnvelope;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoRequest;
use Zimbra\Admin\Message\GetFreeBusyQueueInfoResponse;

use Zimbra\Admin\Struct\FreeBusyQueueProvider;
use Zimbra\Struct\Id;
use Zimbra\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetFreeBusyQueueInfo.
 */
class GetFreeBusyQueueInfoTest extends ZimbraTestCase
{
    public function testGetFreeBusyQueueInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $providerName = new NamedElement($name);
        $providerInfo = new FreeBusyQueueProvider($name, [new Id($id)]);

        $request = new GetFreeBusyQueueInfoRequest($providerName);
        $this->assertSame($providerName, $request->getProvider());
        $request = new GetFreeBusyQueueInfoRequest();
        $request->setProvider($providerName);
        $this->assertSame($providerName, $request->getProvider());

        $response = new GetFreeBusyQueueInfoResponse([$providerInfo]);
        $this->assertSame([$providerInfo], $response->getProviders());
        $response = new GetFreeBusyQueueInfoResponse();
        $response->setProviders([$providerInfo])
            ->addProvider($providerInfo);
        $this->assertSame([$providerInfo, $providerInfo], $response->getProviders());
        $response->setProviders([$providerInfo]);

        $body = new GetFreeBusyQueueInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetFreeBusyQueueInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetFreeBusyQueueInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetFreeBusyQueueInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetFreeBusyQueueInfoRequest>
            <provider name="$name" />
        </urn:GetFreeBusyQueueInfoRequest>
        <urn:GetFreeBusyQueueInfoResponse>
            <provider name="$name">
                <account id="$id" />
            </provider>
        </urn:GetFreeBusyQueueInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetFreeBusyQueueInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetFreeBusyQueueInfoRequest' => [
                    'provider' => [
                        'name' => $name,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetFreeBusyQueueInfoResponse' => [
                    'provider' => [
                        [
                            'name' => $name,
                            'account' => [
                                [
                                    'id' => $id,
                                ],
                            ],
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetFreeBusyQueueInfoEnvelope::class, 'json'));
    }
}
