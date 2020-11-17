<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckAuthConfigBody;
use Zimbra\Admin\Message\CheckAuthConfigEnvelope;
use Zimbra\Admin\Message\CheckAuthConfigRequest;
use Zimbra\Admin\Message\CheckAuthConfigResponse;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;


/**
 * Testcase class for CheckAuthConfig.
 */
class CheckAuthConfigTest extends ZimbraStructTestCase
{
    public function testCheckAuthConfigRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;

        $attr = new Attr($key, $value);
        $req = new CheckAuthConfigRequest(
            $name, $password, [$attr]
        );

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req = new CheckAuthConfigRequest(
            '', ''
        );
        $req->setName($name)
            ->setPassword($password)
            ->setAttrs([$attr]);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckAuthConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckAuthConfigRequest::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'password' => $password,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckAuthConfigRequest::class, 'json'));
    }

    public function testCheckAuthConfigResponse()
    {
        $code = $this->faker->word;
        $bindDn = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($bindDn, $res->getBindDn());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckAuthConfigResponse('', '');
        $res->setCode($code)
            ->setBindDn($bindDn)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($bindDn, $res->getBindDn());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckAuthConfigResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
                . '<bindDn>' . $bindDn . '</bindDn>'
            . '</CheckAuthConfigResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckAuthConfigResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
            'bindDn' => [
                '_content' => $bindDn,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckAuthConfigResponse::class, 'json'));
    }

    public function testCheckAuthConfigBody()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $code = $this->faker->uuid;
        $bindDn = $this->faker->uuid;
        $message = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $request = new CheckAuthConfigRequest(
            $name, $password, [$attr]
        );
        $response = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );

        $body = new CheckAuthConfigBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckAuthConfigBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</urn:CheckAuthConfigRequest>'
                . '<urn:CheckAuthConfigResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                    . '<bindDn>' . $bindDn . '</bindDn>'
                . '</urn:CheckAuthConfigResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckAuthConfigBody::class, 'xml'));

        $json = json_encode([
            'CheckAuthConfigRequest' => [
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckAuthConfigResponse' => [
                'code' => [
                    '_content' => $code,
                ],
                'message' => [
                    '_content' => $message,
                ],
                'bindDn' => [
                    '_content' => $bindDn,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckAuthConfigBody::class, 'json'));
    }

    public function testCheckAuthConfigEnvelope()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $name = $this->faker->word;
        $password = $this->faker->word;
        $code = $this->faker->uuid;
        $bindDn = $this->faker->uuid;
        $message = $this->faker->uuid;

        $attr = new Attr($key, $value);
        $request = new CheckAuthConfigRequest(
            $name, $password, [$attr]
        );
        $response = new CheckAuthConfigResponse(
            $code,
            $bindDn,
            $message
        );
        $body = new CheckAuthConfigBody($request, $response);

        $envelope = new CheckAuthConfigEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckAuthConfigEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                        . '<a n="' . $key . '">' . $value . '</a>'
                    . '</urn:CheckAuthConfigRequest>'
                    . '<urn:CheckAuthConfigResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                        . '<bindDn>' . $bindDn . '</bindDn>'
                    . '</urn:CheckAuthConfigResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckAuthConfigEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckAuthConfigRequest' => [
                    'name' => $name,
                    'password' => $password,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckAuthConfigResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    'bindDn' => [
                        '_content' => $bindDn,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckAuthConfigEnvelope::class, 'json'));
    }
}
