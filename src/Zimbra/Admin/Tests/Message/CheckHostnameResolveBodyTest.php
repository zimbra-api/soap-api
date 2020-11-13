<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHostnameResolveBody;
use Zimbra\Admin\Message\CheckHostnameResolveRequest;
use Zimbra\Admin\Message\CheckHostnameResolveResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHostnameResolveBody.
 */
class CheckHostnameResolveBodyTest extends ZimbraStructTestCase
{
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
}
