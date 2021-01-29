<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetAllFreeBusyProvidersBody;
use Zimbra\Admin\Message\GetAllFreeBusyProvidersEnvelope;
use Zimbra\Admin\Message\GetAllFreeBusyProvidersRequest;
use Zimbra\Admin\Message\GetAllFreeBusyProvidersResponse;
use Zimbra\Admin\Struct\FreeBusyProviderInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetAllFreeBusyProvidersTest.
 */
class GetAllFreeBusyProvidersTest extends ZimbraTestCase
{
    public function testGetAllFreeBusyProviders()
    {
        $name = $this->faker->word;
        $start = mt_rand(1, 100);
        $end = mt_rand(1, 100);
        $queue = $this->faker->word;
        $prefix = $this->faker->word;

        $provider = new FreeBusyProviderInfo($name, TRUE, $start, $end, $queue, $prefix);

        $request = new GetAllFreeBusyProvidersRequest();

        $response = new GetAllFreeBusyProvidersResponse([$provider]);
        $this->assertSame([$provider], $response->getProviders());
        $response = new GetAllFreeBusyProvidersResponse();
        $response->setProviders([$provider])
            ->addProvider($provider);
        $this->assertSame([$provider, $provider], $response->getProviders());
        $response->setProviders([$provider]);

        $body = new GetAllFreeBusyProvidersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllFreeBusyProvidersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllFreeBusyProvidersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllFreeBusyProvidersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetAllFreeBusyProvidersRequest />
        <urn:GetAllFreeBusyProvidersResponse>
            <provider name="$name" propagate="true" start="$start" end="$end" queue="$queue" prefix="$prefix" />
        </urn:GetAllFreeBusyProvidersResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllFreeBusyProvidersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllFreeBusyProvidersRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllFreeBusyProvidersResponse' => [
                    'provider' => [
                        [
                            'name' => $name,
                            'propagate' => TRUE,
                            'start' => $start,
                            'end' => $end,
                            'queue' => $queue,
                            'prefix' => $prefix,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllFreeBusyProvidersEnvelope::class, 'json'));
    }
}
