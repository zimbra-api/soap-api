<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckGalConfigBody;
use Zimbra\Admin\Message\CheckGalConfigEnvelope;
use Zimbra\Admin\Message\CheckGalConfigRequest;
use Zimbra\Admin\Message\CheckGalConfigResponse;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\GalContactInfo;
use Zimbra\Admin\Struct\LimitedQuery;

use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckGalConfig.
 */
class CheckGalConfigTest extends ZimbraStructTestCase
{
    public function testCheckGalConfigRequest()
    {
        $limit = mt_rand(0, 10);
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $query = new LimitedQuery($limit, $value);

        $req = new CheckGalConfigRequest($query, $action, [new Attr($key, $value)]);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($action, $req->getAction());

        $req = new CheckGalConfigRequest(new LimitedQuery($limit, $value), '', [new Attr($key, $value)]);
        $req->setQuery($query)
            ->setAction($action);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigRequest>'
                . '<query limit="' . $limit . '">' . $value . '</query>'
                . '<action>' . $action . '</action>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckGalConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckGalConfigRequest::class, 'xml'));

        $json = json_encode([
            'query' => [
                'limit' => $limit,
                '_content' => $value,
            ],
            'action' => [
                '_content' => $action,
            ],
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckGalConfigRequest::class, 'json'));
    }

    public function testCheckGalConfigResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $cn = new GalContactInfo($id, [new Attr($key, $value)]);

        $res = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());
        $this->assertSame([$cn], $res->getGalContacts());

        $res = new CheckGalConfigResponse('', '');
        $res->setCode($code)
            ->setMessage($message)
            ->setGalContacts([$cn])
            ->addGalContact($cn);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());
        $this->assertSame([$cn, $cn], $res->getGalContacts());

        $res = new CheckGalConfigResponse(
            $code,
            $message,
            [$cn]
        );
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
                . '<cn id="' . $id . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</cn>'
            . '</CheckGalConfigResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckGalConfigResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
            'cn' => [
                [
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    'id' => $id,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckGalConfigResponse::class, 'json'));
    }

    public function testCheckGalConfigBody()
    {
        $limit = mt_rand(0, 10);
        $id = $this->faker->uuid;
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckGalConfigRequest(new LimitedQuery($limit, $value), $action, [new Attr($key, $value)]);
        $response = new CheckGalConfigResponse(
            $code,
            $message,
            [new GalContactInfo($id, [new Attr($key, $value)])]
        );

        $body = new CheckGalConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckGalConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckGalConfigRequest>'
                    . '<query limit="' . $limit . '">' . $value . '</query>'
                    . '<action>' . $action . '</action>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CheckGalConfigRequest>'
                . '<urn:CheckGalConfigResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                    . '<cn id="' . $id . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</cn>'
                . '</urn:CheckGalConfigResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckGalConfigBody::class, 'xml'));

        $json = json_encode([
            'CheckGalConfigRequest' => [
                'query' => [
                    'limit' => $limit,
                    '_content' => $value,
                ],
                'action' => [
                    '_content' => $action,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckGalConfigResponse' => [
                'code' => [
                    '_content' => $code,
                ],
                'message' => [
                    '_content' => $message,
                ],
                'cn' => [
                    [
                        'a' => [
                            [
                                'n' => $key,
                                '_content' => $value,
                            ],
                        ],
                        'id' => $id,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckGalConfigBody::class, 'json'));
    }

    public function testCheckGalConfigEnvelope()
    {
        $limit = mt_rand(0, 10);
        $id = $this->faker->uuid;
        $action = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckGalConfigRequest(new LimitedQuery($limit, $value), $action, [new Attr($key, $value)]);
        $response = new CheckGalConfigResponse(
            $code,
            $message,
            [new GalContactInfo($id, [new Attr($key, $value)])]
        );
        $body = new CheckGalConfigBody($request, $response);

        $envelope = new CheckGalConfigEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckGalConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckGalConfigRequest>'
                        . '<query limit="' . $limit . '">' . $value . '</query>'
                        . '<action>' . $action . '</action>'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CheckGalConfigRequest>'
                    . '<urn:CheckGalConfigResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                        . '<cn id="' . $id . '">'
                            . '<a n="' . $key . '">' . $value . '</a>'
                        . '</cn>'
                    . '</urn:CheckGalConfigResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckGalConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckGalConfigRequest' => [
                    'query' => [
                        'limit' => $limit,
                        '_content' => $value,
                    ],
                    'action' => [
                        '_content' => $action,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckGalConfigResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    'cn' => [
                        [
                            'a' => [
                                [
                                    'n' => $key,
                                    '_content' => $value,
                                ],
                            ],
                            'id' => $id,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckGalConfigEnvelope::class, 'json'));
    }
}
