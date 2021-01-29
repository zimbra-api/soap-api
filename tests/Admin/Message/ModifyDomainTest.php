<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ModifyDomainBody;
use Zimbra\Admin\Message\ModifyDomainEnvelope;
use Zimbra\Admin\Message\ModifyDomainRequest;
use Zimbra\Admin\Message\ModifyDomainResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyDomain.
 */
class ModifyDomainTest extends ZimbraTestCase
{
    public function testModifyDomain()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $request = new ModifyDomainRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new ModifyDomainRequest('');
        $request->setId($id)
            ->setAttrs([new Attr($key, $value)]);
        $this->assertSame($id, $request->getId());

        $domain = new DomainInfo($name, $id, [new Attr($key, $value)]);
        $response = new ModifyDomainResponse($domain);
        $this->assertEquals($domain, $response->getDomain());
        $response = new ModifyDomainResponse();
        $response->setDomain($domain);
        $this->assertEquals($domain, $response->getDomain());

        $body = new ModifyDomainBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ModifyDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ModifyDomainEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ModifyDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ModifyDomainRequest id="$id">
            <a n="$key">$value</a>
        </urn:ModifyDomainRequest>
        <urn:ModifyDomainResponse>
            <domain name="$name" id="$id">
                <a n="$key">$value</a>
            </domain>
        </urn:ModifyDomainResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ModifyDomainEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ModifyDomainRequest' => [
                    'id' => $id,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ModifyDomainResponse' => [
                    'domain' => [
                        'name' => $name,
                        'id' => $id,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ModifyDomainEnvelope::class, 'json'));
    }
}
