<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetServerNIfsBody;
use Zimbra\Admin\Message\GetServerNIfsEnvelope;
use Zimbra\Admin\Message\GetServerNIfsRequest;
use Zimbra\Admin\Message\GetServerNIfsResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\NetworkInformation;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Common\Enum\IpType;
use Zimbra\Common\Enum\ServerBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetServerNIfsTest.
 */
class GetServerNIfsTest extends ZimbraTestCase
{
    public function testGetServerNIfs()
    {
        $value = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $ni = new NetworkInformation([new Attr($key, $value)]);

        $request = new GetServerNIfsRequest($server, IpType::BOTH());
        $this->assertSame($server, $request->getServer());
        $this->assertEquals(IpType::BOTH(), $request->getType());
        $request = new GetServerNIfsRequest(new ServerSelector(ServerBy::NAME(), ''));
        $request->setServer($server)
            ->setType(IpType::BOTH());
        $this->assertSame($server, $request->getServer());
        $this->assertEquals(IpType::BOTH(), $request->getType());

        $response = new GetServerNIfsResponse([$ni]);
        $this->assertSame([$ni], $response->getNetworkInterfaces());
        $response = new GetServerNIfsResponse();
        $response->setNetworkInterfaces([$ni])
            ->addNetworkInterface($ni);
        $this->assertSame([$ni, $ni], $response->getNetworkInterfaces());
        $response->setNetworkInterfaces([$ni]);

        $body = new GetServerNIfsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetServerNIfsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetServerNIfsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetServerNIfsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetServerNIfsRequest type="both">
            <server by="name">$value</server>
        </urn:GetServerNIfsRequest>
        <urn:GetServerNIfsResponse>
            <ni>
                <a n="$key">$value</a>
            </ni>
        </urn:GetServerNIfsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetServerNIfsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetServerNIfsRequest' => [
                    'type' => 'both',
                    'server' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetServerNIfsResponse' => [
                    'ni' => [
                        [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetServerNIfsEnvelope::class, 'json'));
    }
}
