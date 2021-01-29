<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ResetAllLoggersBody;
use Zimbra\Admin\Message\ResetAllLoggersEnvelope;
use Zimbra\Admin\Message\ResetAllLoggersRequest;
use Zimbra\Admin\Message\ResetAllLoggersResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ResetAllLoggersTest.
 */
class ResetAllLoggersTest extends ZimbraTestCase
{
    public function testResetAllLoggers()
    {
        $request = new ResetAllLoggersRequest();
        $response = new ResetAllLoggersResponse();

        $body = new ResetAllLoggersBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new ResetAllLoggersBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ResetAllLoggersEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new ResetAllLoggersEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ResetAllLoggersRequest />
        <urn:ResetAllLoggersResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ResetAllLoggersEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ResetAllLoggersRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ResetAllLoggersResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ResetAllLoggersEnvelope::class, 'json'));
    }
}
