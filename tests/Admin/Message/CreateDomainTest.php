<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CreateDomainBody;
use Zimbra\Admin\Message\CreateDomainEnvelope;
use Zimbra\Admin\Message\CreateDomainRequest;
use Zimbra\Admin\Message\CreateDomainResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateDomain.
 */
class CreateDomainTest extends ZimbraTestCase
{
    public function testCreateDomain()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $domain = new DomainInfo($name, $id, [$attr]);

        $request = new CreateDomainRequest(
            $name, [$attr]
        );
        $this->assertSame($name, $request->getName());
        $request = new CreateDomainRequest('');
        $request->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $request->getName());

        $response = new CreateDomainResponse($domain);
        $this->assertSame($domain, $response->getDomain());
        $response = new CreateDomainResponse(new DomainInfo('', ''));
        $response->setDomain($domain);
        $this->assertSame($domain, $response->getDomain());

        $body = new CreateDomainBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CreateDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CreateDomainEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CreateDomainRequest name="$name">
            <urn:a n="$key">$value</urn:a>
        </urn:CreateDomainRequest>
        <urn:CreateDomainResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:CreateDomainResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDomainEnvelope::class, 'xml'));
    }
}
