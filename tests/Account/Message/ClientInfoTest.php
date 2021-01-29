<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Message;

use Zimbra\Account\Message\{ClientInfoEnvelope, ClientInfoBody, ClientInfoRequest, ClientInfoResponse};
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;
/**
 * Testcase class for ClientInfo.
 */
class ClientInfoTest extends ZimbraStructTestCase
{
    public function testClientInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $attr = new Attr($key, $value);

        $request = new ClientInfoRequest($domain);
        $this->assertSame($domain, $request->getDomain());

        $request = new ClientInfoRequest(new DomainSelector(DomainBy::NAME(), ''));
        $request->setDomain($domain);
        $this->assertSame($domain, $request->getDomain());

        $response = new ClientInfoResponse([$attr]);
        $this->assertSame([$attr], $response->getAttrList());

        $response = new ClientInfoResponse();
        $response->setAttrList([$attr]);
        $this->assertSame([$attr], $response->getAttrList());

        $body = new ClientInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ClientInfoBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ClientInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ClientInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">
    <soap:Body>
        <urn:ClientInfoRequest>
            <domain by="name">$value</domain>
        </urn:ClientInfoRequest>
        <urn:ClientInfoResponse>
            <a n="$key">$value</a>
        </urn:ClientInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ClientInfoEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ClientInfoRequest' => [
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
                'ClientInfoResponse' => [
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAccount',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ClientInfoEnvelope::class, 'json'));
    }
}
