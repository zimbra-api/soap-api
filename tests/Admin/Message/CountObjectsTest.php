<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CountObjectsBody;
use Zimbra\Admin\Message\CountObjectsEnvelope;
use Zimbra\Admin\Message\CountObjectsRequest;
use Zimbra\Admin\Message\CountObjectsResponse;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Common\Enum\CompactIndexStatus;
use Zimbra\Common\Enum\CountObjectsType;
use Zimbra\Common\Enum\DomainBy;
use Zimbra\Common\Enum\UcServiceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CountObjects.
 */
class CountObjectsTest extends ZimbraTestCase
{
    public function testCountObjects()
    {
        $value = $this->faker->word;
        $num = $this->faker->randomNumber;
        $type = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME, $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME, $value);

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
        $response = new CountObjectsResponse();
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
            <urn:domain by="name">$value</urn:domain>
            <urn:ucservice by="name">$value</urn:ucservice>
        </urn:CountObjectsRequest>
        <urn:CountObjectsResponse num="$num" type="$type" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountObjectsEnvelope::class, 'xml'));
    }
}
