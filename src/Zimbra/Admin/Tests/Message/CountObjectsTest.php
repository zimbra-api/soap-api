<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

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
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountObjects.
 */
class CountObjectsTest extends ZimbraStructTestCase
{
    public function testCountObjectsRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $req = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT(), [$domain], $ucs, FALSE
        );
        $this->assertEquals(CountObjectsType::USER_ACCOUNT(), $req->getType());
        $this->assertSame([$domain], $req->getDomains());
        $this->assertSame($ucs, $req->getUcService());
        $this->assertFalse($req->getOnlyRelated());

        $req = new CountObjectsRequest(
            CountObjectsType::USER_ACCOUNT()
        );
        $req->setType(CountObjectsType::ACCOUNT())
            ->setDomains([$domain])
            ->addDomain($domain)
            ->setUcService($ucs)
            ->setOnlyRelated(TRUE);
        $this->assertEquals(CountObjectsType::ACCOUNT(), $req->getType());
        $this->assertSame([$domain, $domain], $req->getDomains());
        $this->assertSame($ucs, $req->getUcService());
        $this->assertTrue($req->getOnlyRelated());

        $req = new CountObjectsRequest(
            CountObjectsType::ACCOUNT(), [$domain], $ucs, TRUE
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</CountObjectsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CountObjectsRequest::class, 'xml'));

        $json = json_encode([
            'type' => (string) CountObjectsType::ACCOUNT(),
            'domain' => [
                [
                    'by' => (string) DomainBy::NAME(),
                    '_content' => $value,
                ],
            ],
            'ucservice' => [
                'by' => (string) UcServiceBy::NAME(),
                '_content' => $value,
            ],
            'onlyrelated' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CountObjectsRequest::class, 'json'));
    }

    public function testCountObjectsResponse()
    {
        $num = mt_rand(1, 100);
        $type = $this->faker->word;
        $res = new CountObjectsResponse($num, $type);
        $this->assertSame($num, $res->getNum());
        $this->assertSame($type, $res->getType());

        $res = new CountObjectsResponse(0, '');
        $res->setNum($num)
            ->setType($type);
        $this->assertSame($num, $res->getNum());
        $this->assertSame($type, $res->getType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsResponse num="' . $num . '" type="' . $type . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CountObjectsResponse::class, 'xml'));

        $json = json_encode([
            'num' => $num,
            'type' => $type,
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CountObjectsResponse::class, 'json'));
    }

    public function testCountObjectsBody()
    {
        $value = $this->faker->word;
        $num = mt_rand(1, 100);
        $type = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $request = new CountObjectsRequest(
            CountObjectsType::ACCOUNT(), [$domain], $ucs, TRUE
        );
        $response = new CountObjectsResponse($num, $type);

        $body = new CountObjectsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CountObjectsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                    . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                . '</urn:CountObjectsRequest>'
                . '<urn:CountObjectsResponse num="' . $num . '" type="' . $type . '" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CountObjectsBody::class, 'xml'));

        $json = json_encode([
            'CountObjectsRequest' => [
                'type' => (string) CountObjectsType::ACCOUNT(),
                'domain' => [
                    [
                        'by' => (string) DomainBy::NAME(),
                        '_content' => $value,
                    ],
                ],
                'ucservice' => [
                    'by' => (string) UcServiceBy::NAME(),
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CountObjectsBody::class, 'json'));
    }

    public function testCountObjectsEnvelope()
    {
        $value = $this->faker->word;
        $num = mt_rand(1, 100);
        $type = $this->faker->word;

        $domain = new DomainSelector(DomainBy::NAME(), $value);
        $ucs = new UcServiceSelector(UcServiceBy::NAME(), $value);

        $request = new CountObjectsRequest(
            CountObjectsType::ACCOUNT(), [$domain], $ucs, TRUE
        );
        $response = new CountObjectsResponse($num, $type);
        $body = new CountObjectsBody($request, $response);

        $envelope = new CountObjectsEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountObjectsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CountObjectsRequest type="' . CountObjectsType::ACCOUNT() . '" onlyrelated="true">'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                        . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                    . '</urn:CountObjectsRequest>'
                    . '<urn:CountObjectsResponse num="' . $num . '" type="' . $type . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountObjectsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountObjectsRequest' => [
                    'type' => (string) CountObjectsType::ACCOUNT(),
                    'domain' => [
                        [
                            'by' => (string) DomainBy::NAME(),
                            '_content' => $value,
                        ],
                    ],
                    'ucservice' => [
                        'by' => (string) UcServiceBy::NAME(),
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountObjectsEnvelope::class, 'json'));
    }
}
