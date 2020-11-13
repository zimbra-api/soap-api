<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHealthBody;
use Zimbra\Admin\Message\CheckHealthEnvelope;
use Zimbra\Admin\Message\CheckHealthRequest;
use Zimbra\Admin\Message\CheckHealthResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealthEnvelope.
 */
class CheckHealthEnvelopeTest extends ZimbraStructTestCase
{
    public function testCheckHealthEnvelope()
    {
        $request = new CheckHealthRequest();
        $response = new CheckHealthResponse(TRUE);
        $body = new CheckHealthBody($request, $response);

        $envelope = new CheckHealthEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckHealthEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:CheckHealthRequest />'
                    . '<urn:CheckHealthResponse healthy="true" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckHealthEnvelope::class, 'json'));
    }
}
