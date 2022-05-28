<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CountAccountBody;
use Zimbra\Admin\Message\CountAccountEnvelope;
use Zimbra\Admin\Message\CountAccountRequest;
use Zimbra\Admin\Message\CountAccountResponse;
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CountAccount.
 */
class CountAccountTest extends ZimbraTestCase
{
    public function testCountAccount()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $request = new CountAccountRequest($domain);
        $this->assertSame($domain, $request->getDomain());
        $request = new CountAccountRequest(new DomainSelector(DomainBy::ID(), ''));
        $request->setDomain($domain);
        $this->assertSame($domain, $request->getDomain());

        $cos = new CosCountInfo($name, $id, $count);
        $response = new CountAccountResponse([$cos]);
        $this->assertSame([$cos], $response->getCos());

        $response = new CountAccountResponse();
        $response->setCos([$cos])
            ->addCos($cos);
        $this->assertSame([$cos, $cos], $response->getCos());
        $response->setCos([$cos]);

        $body = new CountAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CountAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CountAccountEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CountAccountRequest>
            <domain by="name">$value</domain>
        </urn:CountAccountRequest>
        <urn:CountAccountResponse>
            <cos name="$name" id="$id">$count</cos>
        </urn:CountAccountResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountAccountRequest' => [
                    'domain' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CountAccountResponse' => [
                    'cos' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            '_content' => $count,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountAccountEnvelope::class, 'json'));
    }
}
