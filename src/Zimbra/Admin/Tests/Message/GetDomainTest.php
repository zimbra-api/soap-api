<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetDomainBody;
use Zimbra\Admin\Message\GetDomainEnvelope;
use Zimbra\Admin\Message\GetDomainRequest;
use Zimbra\Admin\Message\GetDomainResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;

use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetDomainTest.
 */
class GetDomainTest extends ZimbraStructTestCase
{
    public function testGetDomain()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $domainSel = new DomainSelector(DomainBy::NAME(), $value);
        $domainInfo = new DomainInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetDomainRequest($domainSel, FALSE, $attrs);
        $this->assertSame($domainSel, $request->getDomain());
        $this->assertFalse($request->isApplyConfig());
        $this->assertSame($attrs, $request->getAttrs());

        $request = new GetDomainRequest();
        $request->setDomain($domainSel)
            ->setApplyConfig(TRUE)
            ->setAttrs($attrs);
        $this->assertSame($domainSel, $request->getDomain());
        $this->assertTrue($request->isApplyConfig());
        $this->assertSame($attrs, $request->getAttrs());

        $response = new GetDomainResponse($domainInfo);
        $this->assertSame($domainInfo, $response->getDomain());
        $response = new GetDomainResponse();
        $response->setDomain($domainInfo);
        $this->assertSame($domainInfo, $response->getDomain());

        $body = new GetDomainBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetDomainEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetDomainRequest attrs="' . $attrs . '" applyConfig="true">'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '</urn:GetDomainRequest>'
                    . '<urn:GetDomainResponse>'
                        . '<domain name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</domain>'
                    . '</urn:GetDomainResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetDomainEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetDomainRequest' => [
                    'attrs' => $attrs,
                    'applyConfig' => TRUE,
                    'domain' => [
                        'by' => (string) DomainBy::NAME(),
                        '_content' => $value,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetDomainResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetDomainEnvelope::class, 'json'));
    }
}
