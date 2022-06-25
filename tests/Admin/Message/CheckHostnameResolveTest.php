<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckHostnameResolveBody;
use Zimbra\Admin\Message\CheckHostnameResolveEnvelope;
use Zimbra\Admin\Message\CheckHostnameResolveRequest;
use Zimbra\Admin\Message\CheckHostnameResolveResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckHostnameResolve.
 */
class CheckHostnameResolveTest extends ZimbraTestCase
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

        $envelope = new CheckHostnameResolveEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckHostnameResolveEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckHostnameResolveRequest hostname="$hostname" />
        <urn:CheckHostnameResolveResponse>
            <code>$code</code>
            <message>$message</message>
        </urn:CheckHostnameResolveResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckHostnameResolveEnvelope::class, 'xml'));
    }
}
