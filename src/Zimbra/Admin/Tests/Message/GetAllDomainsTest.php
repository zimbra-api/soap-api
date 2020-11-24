<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\GetAllDomainsBody;
use Zimbra\Admin\Message\GetAllDomainsEnvelope;
use Zimbra\Admin\Message\GetAllDomainsRequest;
use Zimbra\Admin\Message\GetAllDomainsResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GetAllDomainsTest.
 */
class GetAllDomainsTest extends ZimbraStructTestCase
{
    public function testGetAllDomains()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $domain = new DomainInfo($name, $id, [new Attr($key, $value)]);

        $request = new GetAllDomainsRequest(FALSE);
        $this->assertFalse($request->isApplyConfig());
        $request->setApplyConfig(TRUE);
        $this->assertTrue($request->isApplyConfig());

        $response = new GetAllDomainsResponse([$domain]);
        $this->assertSame([$domain], $response->getDomainList());
        $response = new GetAllDomainsResponse();
        $response->setDomainList([$domain])
            ->addDomain($domain);
        $this->assertSame([$domain, $domain], $response->getDomainList());
        $response->setDomainList([$domain]);

        $body = new GetAllDomainsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetAllDomainsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetAllDomainsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetAllDomainsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:GetAllDomainsRequest applyConfig="true" />'
                    . '<urn:GetAllDomainsResponse>'
                        . '<domain name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</domain>'
                    . '</urn:GetAllDomainsResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetAllDomainsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetAllDomainsRequest' => [
                    'applyConfig' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetAllDomainsResponse' => [
                    'domain' => [
                        [
                            'name' => $name,
                            'id' => $id,
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetAllDomainsEnvelope::class, 'json'));
    }
}
