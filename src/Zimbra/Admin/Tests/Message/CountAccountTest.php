<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CountAccountBody;
use Zimbra\Admin\Message\CountAccountEnvelope;
use Zimbra\Admin\Message\CountAccountRequest;
use Zimbra\Admin\Message\CountAccountResponse;
use Zimbra\Admin\Struct\CosCountInfo;
use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Enum\DomainBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CountAccount.
 */
class CountAccountTest extends ZimbraStructTestCase
{
    public function testCountAccountRequest()
    {
        $value = $this->faker->word;
        $domain = new DomainSelector(DomainBy::NAME(), $value);

        $req = new CountAccountRequest($domain);
        $this->assertSame($domain, $req->getDomain());

        $req = new CountAccountRequest(new DomainSelector(DomainBy::ID(), $value));
        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</CountAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CountAccountRequest::class, 'xml'));

        $json = json_encode([
            'domain' => [
                'by' => (string) DomainBy::NAME(),
                '_content' => $value,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CountAccountRequest::class, 'json'));
    }

    public function testCountAccountResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);
        $cos = new CosCountInfo($name, $id, $count);

        $res = new CountAccountResponse([$cos]);
        $this->assertSame([$cos], $res->getCos());

        $res = new CountAccountResponse();
        $res->setCos([$cos])
            ->addCos($cos);
        $this->assertSame([$cos, $cos], $res->getCos());

        $res = new CountAccountResponse([$cos]);
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountAccountResponse>'
                . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
            . '</CountAccountResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CountAccountResponse::class, 'xml'));

        $json = json_encode([
            'cos' => [
                [
                    'name' => $name,
                    'id' => $id,
                    '_content' => $count,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CountAccountResponse::class, 'json'));
    }

    public function testCountAccountBody()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);

        $request = new CountAccountRequest(new DomainSelector(DomainBy::NAME(), $value));
        $response = new CountAccountResponse([new CosCountInfo($name, $id, $count)]);

        $body = new CountAccountBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CountAccountBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CountAccountRequest>'
                    . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '</urn:CountAccountRequest>'
                . '<urn:CountAccountResponse>'
                    . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
                . '</urn:CountAccountResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CountAccountBody::class, 'xml'));

        $json = json_encode([
            'CountAccountRequest' => [
                'domain' => [
                    'by' => (string) DomainBy::NAME(),
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CountAccountBody::class, 'json'));
    }

    public function testCountAccountEnvelope()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $count = mt_rand(1, 100);

        $request = new CountAccountRequest(new DomainSelector(DomainBy::NAME(), $value));
        $response = new CountAccountResponse([new CosCountInfo($name, $id, $count)]);
        $body = new CountAccountBody($request, $response);

        $envelope = new CountAccountEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CountAccountEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CountAccountRequest>'
                        . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                    . '</urn:CountAccountRequest>'
                    . '<urn:CountAccountResponse>'
                        . '<cos name="' . $name . '" id="' . $id . '">' . $count . '</cos>'
                    . '</urn:CountAccountResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CountAccountEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CountAccountRequest' => [
                    'domain' => [
                        'by' => (string) DomainBy::NAME(),
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CountAccountEnvelope::class, 'json'));
    }
}
