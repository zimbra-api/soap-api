<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CountObjectsBody;
use Zimbra\Admin\Message\CountObjectsEnvelope;
use Zimbra\Admin\Message\CountObjectsRequest;
use Zimbra\Admin\Message\CountObjectsResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\CompactIndexStatus;
use Zimbra\Enum\CountObjectsType;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for CountObjects.
 */
class CountObjectsTest extends ZimbraStructTestCase
{
    public function testCountObjects()
    {
        $value = $this->faker->word;
        $num = mt_rand(1, 100);
        $type = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $request = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT(), [$domain], $ucs, FALSE
        );
        $this->assertEquals(CountObjectsType::USER_ACCOUNT(), $request->getType());
        $this->assertSame([$domain], $request->getDomains());
        $this->assertSame($ucs, $request->getUcService());
        $this->assertFalse($request->getOnlyRelated());
        $request = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT()
        );
        $request->setType(CountObjectsType::ACCOUNT())
            ->setDomains([$domain])
            ->addDomain($domain)
            ->setUcService($ucs)
            ->setOnlyRelated(TRUE);
        $this->assertEquals(CountObjectsType::ACCOUNT(), $request->getType());
        $this->assertSame([$domain, $domain], $request->getDomains());
        $this->assertSame($ucs, $request->getUcService());
        $this->assertTrue($request->getOnlyRelated());
        $request->setDomains([$domain]);

        $response = new CountObjectsResponse($num, $type);
        $this->assertSame($num, $response->getNum());
        $this->assertSame($type, $response->getType());
        $response = new CountObjectsResponse(0, '');
        $response->setNum($num)
            ->setType($type);
        $this->assertSame($num, $response->getNum());
        $this->assertSame($type, $response->getType());

        $body = new CountObjectsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CountObjectsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CountObjectsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountObjectsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CountObjectsRequest type="account" onlyrelated="true">
            <domain by="name">$value</domain>
            <ucservice by="name">$value</ucservice>
        </urn:CountObjectsRequest>
        <urn:CountObjectsResponse num="$num" type="$type" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountObjectsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountObjectsRequest' => [
                    'type' => 'account',
                    'domain' => [
                        [
                            'by' => 'name',
                            '_content' => $value,
                        ],
                    ],
                    'ucservice' => [
                        'by' => 'name',
                        '_content' => $value,
                    ],
                    'onlyrelated' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CountObjectsResponse' => [
                    'num' => $num,
                    'type' => $type,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountObjectsEnvelope::class, 'json'));
    }
}
