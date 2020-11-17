<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckExchangeAuthBody;
use Zimbra\Admin\Message\CheckExchangeAuthEnvelope;
use Zimbra\Admin\Message\CheckExchangeAuthRequest;
use Zimbra\Admin\Message\CheckExchangeAuthResponse;
use Zimbra\Admin\Struct\ExchangeAuthSpec;
use Zimbra\Enum\AuthScheme;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckExchangeAuth.
 */
class CheckExchangeAuthTest extends ZimbraStructTestCase
{
    public function testCheckExchangeAuthRequest()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;

        $auth = new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM(), $type);
        $req = new CheckExchangeAuthRequest(
            $auth
        );

        $this->assertSame($auth, $req->getAuth());

        $req = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec($url, $user, $pass, AuthScheme::BASIC(), $type)
        );
        $req->setAuth($auth);
        $this->assertSame($auth, $req->getAuth());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthRequest>'
                . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
            . '</CheckExchangeAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckExchangeAuthRequest::class, 'xml'));

        $json = json_encode([
            'auth' => [
                'url' => $url,
                'user' => $user,
                'pass' => $pass,
                'scheme' => (string) AuthScheme::FORM(),
                'type' => $type,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckExchangeAuthRequest::class, 'json'));
    }

    public function testCheckExchangeAuthResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckExchangeAuthResponse(
            $code,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckExchangeAuthResponse('', '');
        $res->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
            . '</CheckExchangeAuthResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckExchangeAuthResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckExchangeAuthResponse::class, 'json'));
    }

    public function testCheckExchangeAuthBody()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM(), $type)
        );
        $response = new CheckExchangeAuthResponse(
            $code,
            $message
        );

        $body = new CheckExchangeAuthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckExchangeAuthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckExchangeAuthRequest>'
                    . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                . '</urn:CheckExchangeAuthRequest>'
                . '<urn:CheckExchangeAuthResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                . '</urn:CheckExchangeAuthResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckExchangeAuthBody::class, 'xml'));

        $json = json_encode([
            'CheckExchangeAuthRequest' => [
                'auth' => [
                    'url' => $url,
                    'user' => $user,
                    'pass' => $pass,
                    'scheme' => (string) AuthScheme::FORM(),
                    'type' => $type,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckExchangeAuthResponse' => [
                'code' => [
                    '_content' => $code,
                ],
                'message' => [
                    '_content' => $message,
                ],
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckExchangeAuthBody::class, 'json'));
    }

    public function testCheckExchangeAuthEnvelope()
    {
        $url = $this->faker->word;
        $user = $this->faker->word;
        $pass = $this->faker->word;
        $type = $this->faker->word;
        $code = $this->faker->word;
        $message = $this->faker->word;

        $request = new CheckExchangeAuthRequest(
            new ExchangeAuthSpec($url, $user, $pass, AuthScheme::FORM(), $type)
        );
        $response = new CheckExchangeAuthResponse(
            $code,
            $message
        );
        $body = new CheckExchangeAuthBody($request, $response);

        $envelope = new CheckExchangeAuthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckExchangeAuthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckExchangeAuthRequest>'
                        . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                    . '</urn:CheckExchangeAuthRequest>'
                    . '<urn:CheckExchangeAuthResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                    . '</urn:CheckExchangeAuthResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckExchangeAuthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckExchangeAuthRequest' => [
                    'auth' => [
                        'url' => $url,
                        'user' => $user,
                        'pass' => $pass,
                        'scheme' => (string) AuthScheme::FORM(),
                        'type' => $type,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckExchangeAuthResponse' => [
                    'code' => [
                        '_content' => $code,
                    ],
                    'message' => [
                        '_content' => $message,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckExchangeAuthEnvelope::class, 'json'));
    }
}
