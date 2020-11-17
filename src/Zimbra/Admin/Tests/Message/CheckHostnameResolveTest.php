<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHostnameResolveBody;
use Zimbra\Admin\Message\CheckHostnameResolveEnvelope;
use Zimbra\Admin\Message\CheckHostnameResolveRequest;
use Zimbra\Admin\Message\CheckHostnameResolveResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHostnameResolve.
 */
class CheckHostnameResolveTest extends ZimbraStructTestCase
{
    public function testCheckHostnameResolveRequest()
    {
        $hostname = $this->faker->word;

        $req = new CheckHostnameResolveRequest($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $req = new CheckHostnameResolveRequest('');
        $req->setHostname($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveRequest hostname="' . $hostname . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckHostnameResolveRequest::class, 'xml'));

        $json = json_encode([
            'hostname' => $hostname,
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckHostnameResolveRequest::class, 'json'));
    }

    public function testCheckHostnameResolveResponse()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;

        $res = new CheckHostnameResolveResponse(
            $code,
            $message
        );
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $res = new CheckHostnameResolveResponse('', '');
        $res->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $res->getCode());
        $this->assertSame($message, $res->getMessage());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveResponse>'
                . '<code>' . $code . '</code>'
                . '<message>' . $message . '</message>'
            . '</CheckHostnameResolveResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckHostnameResolveResponse::class, 'xml'));

        $json = json_encode([
            'code' => [
                '_content' => $code,
            ],
            'message' => [
                '_content' => $message,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckHostnameResolveResponse::class, 'json'));
    }

    public function testCheckHostnameResolveBody()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;
        $hostname = $this->faker->word;

        $request = new CheckHostnameResolveRequest($hostname);
        $response = new CheckHostnameResolveResponse(
            $code,
            $message
        );

        $body = new CheckHostnameResolveBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckHostnameResolveBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckHostnameResolveRequest hostname="' . $hostname . '" />'
                . '<urn:CheckHostnameResolveResponse>'
                    . '<code>' . $code . '</code>'
                    . '<message>' . $message . '</message>'
                . '</urn:CheckHostnameResolveResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckHostnameResolveBody::class, 'xml'));

        $json = json_encode([
            'CheckHostnameResolveRequest' => [
                'hostname' => $hostname,
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckHostnameResolveResponse' => [
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
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckHostnameResolveBody::class, 'json'));
    }

    public function testCheckHostnameResolveEnvelope()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;
        $hostname = $this->faker->word;

        $request = new CheckHostnameResolveRequest($hostname);
        $response = new CheckHostnameResolveResponse(
            $code,
            $message
        );
        $body = new CheckHostnameResolveBody($request, $response);

        $envelope = new CheckHostnameResolveEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckHostnameResolveEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckHostnameResolveRequest hostname="' . $hostname . '" />'
                    . '<urn:CheckHostnameResolveResponse>'
                        . '<code>' . $code . '</code>'
                        . '<message>' . $message . '</message>'
                    . '</urn:CheckHostnameResolveResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckHostnameResolveEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckHostnameResolveRequest' => [
                    'hostname' => $hostname,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckHostnameResolveResponse' => [
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
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckHostnameResolveEnvelope::class, 'json'));
    }
}
