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
    public function testCheckHostnameResolve()
    {
        $code = $this->faker->word;
        $message = $this->faker->word;
        $hostname = $this->faker->word;

        $request = new CheckHostnameResolveRequest($hostname);
        $this->assertSame($hostname, $request->getHostname());

        $request = new CheckHostnameResolveRequest('');
        $request->setHostname($hostname);
        $this->assertSame($hostname, $request->getHostname());

        $response = new CheckHostnameResolveResponse(
            $code,
            $message
        );
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());

        $response = new CheckHostnameResolveResponse('', '');
        $response->setCode($code)
            ->setMessage($message);
        $this->assertSame($code, $response->getCode());
        $this->assertSame($message, $response->getMessage());

        $body = new CheckHostnameResolveBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckHostnameResolveBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

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
