<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\GetDomainInfoBody;
use Zimbra\Admin\Message\GetDomainInfoEnvelope;
use Zimbra\Admin\Message\GetDomainInfoRequest;
use Zimbra\Admin\Message\GetDomainInfoResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Common\Enum\DomainBy;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetDomainInfoTest.
 */
class GetDomainInfoTest extends ZimbraTestCase
{
    public function testGetDomainInfo()
    {
        $name = $this->faker->domainName;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $domainSel = new DomainSelector(DomainBy::NAME, $value);
        $domainInfo = new DomainInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetDomainInfoRequest($domainSel, FALSE);
        $this->assertSame($domainSel, $request->getDomain());
        $this->assertFalse($request->isApplyConfig());

        $request = new GetDomainInfoRequest();
        $request->setDomain($domainSel)
            ->setApplyConfig(TRUE);
        $this->assertSame($domainSel, $request->getDomain());
        $this->assertTrue($request->isApplyConfig());

        $response = new GetDomainInfoResponse($domainInfo);
        $this->assertSame($domainInfo, $response->getDomain());
        $response = new GetDomainInfoResponse();
        $response->setDomain($domainInfo);
        $this->assertSame($domainInfo, $response->getDomain());

        $body = new GetDomainInfoBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDomainInfoBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDomainInfoEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDomainInfoEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetDomainInfoRequest applyConfig="true">
            <urn:domain by="name">$value</urn:domain>
        </urn:GetDomainInfoRequest>
        <urn:GetDomainInfoResponse>
            <urn:domain name="$name" id="$id">
                <urn:a n="$key">$value</urn:a>
            </urn:domain>
        </urn:GetDomainInfoResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDomainInfoEnvelope::class, 'xml'));
    }
}
