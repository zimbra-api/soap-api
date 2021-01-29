<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\CheckHealthBody;
use Zimbra\Admin\Message\CheckHealthEnvelope;
use Zimbra\Admin\Message\CheckHealthRequest;
use Zimbra\Admin\Message\CheckHealthResponse;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealth.
 */
class CheckHealthTest extends ZimbraStructTestCase
{
    public function testCheckHealth()
    {
        $request = new CheckHealthRequest();
        $response = new CheckHealthResponse(FALSE);
        $this->assertFalse($response->isHealthy());
        $response->setHealthy(TRUE);
        $this->assertTrue($response->isHealthy());

        $body = new CheckHealthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckHealthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckHealthEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckHealthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:CheckHealthRequest />
        <urn:CheckHealthResponse healthy="true" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckHealthEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'CheckHealthRequest' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'CheckHealthResponse' => [
                    'healthy' => TRUE,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckHealthEnvelope::class, 'json'));
    }
}
