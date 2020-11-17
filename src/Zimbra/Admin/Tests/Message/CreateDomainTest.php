<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CreateDomainBody;
use Zimbra\Admin\Message\CreateDomainEnvelope;
use Zimbra\Admin\Message\CreateDomainRequest;
use Zimbra\Admin\Message\CreateDomainResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\DomainInfo;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateDomain.
 */
class CreateDomainTest extends ZimbraStructTestCase
{
    public function testCreateDomainRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CreateDomainRequest(
            $name, [$attr]
        );
        $this->assertSame($name, $req->getName());

        $req = new CreateDomainRequest('');
        $req->setName($name)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CreateDomainRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CreateDomainRequest::class, 'json'));
    }

    public function testCreateDomainResponse()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attr = new Attr($key, $value);
        $domain = new DomainInfo($name, $id, [$attr]);

        $res = new CreateDomainResponse($domain);
        $this->assertSame($domain, $res->getDomain());

        $res = new CreateDomainResponse(new DomainInfo('', ''));
        $res->setDomain($domain);
        $this->assertSame($domain, $res->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainResponse>'
                . '<domain name="' . $name . '" id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</domain>'
            . '</CreateDomainResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CreateDomainResponse::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CreateDomainResponse::class, 'json'));
    }

    public function testCreateDomainBody()
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
        $response = new CreateDomainResponse($domain);

        $body = new CreateDomainBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CreateDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CreateDomainRequest name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CreateDomainRequest>'
                . '<urn:CreateDomainResponse>'
                    . '<domain name="' . $name . '" id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</domain>'
                . '</urn:CreateDomainResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CreateDomainBody::class, 'xml'));

        $json = json_encode([
            'CreateDomainRequest' => [
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CreateDomainResponse' => [
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CreateDomainBody::class, 'json'));
    }

    public function testCreateDomainEnvelope()
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
        $response = new CreateDomainResponse($domain);

        $body = new CreateDomainBody($request, $response);
        $envelope = new CreateDomainEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CreateDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CreateDomainRequest name="' . $name . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CreateDomainRequest>'
                    . '<urn:CreateDomainResponse>'
                        . '<domain name="' . $name . '" id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</domain>'
                    . '</urn:CreateDomainResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CreateDomainEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CreateDomainRequest' => [
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CreateDomainResponse' => [
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CreateDomainEnvelope::class, 'json'));
    }
}
