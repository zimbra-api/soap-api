<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHealthBody;
use Zimbra\Admin\Message\CheckHealthEnvelope;
use Zimbra\Admin\Message\CheckHealthRequest;
use Zimbra\Admin\Message\CheckHealthResponse;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealth.
 */
class CheckHealthTest extends ZimbraStructTestCase
{
    public function testCheckHealthRequest()
    {
        $req = new CheckHealthRequest();

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHealthRequest />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckHealthRequest::class, 'xml'));

        $json = '{}';
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckHealthRequest::class, 'json'));
    }

    public function testCheckHealthResponse()
    {
        $res = new CheckHealthResponse(FALSE);
        $this->assertFalse($res->isHealthy());
        $res->setHealthy(TRUE);
        $this->assertTrue($res->isHealthy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHealthResponse healthy="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckHealthResponse::class, 'xml'));

        $json = json_encode([
            'healthy' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckHealthResponse::class, 'json'));
    }

    public function testCheckHealthBody()
    {
        $request = new CheckHealthRequest();
        $response = new CheckHealthResponse(TRUE);

        $body = new CheckHealthBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckHealthBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
                . '<urn:CheckHealthRequest />'
                . '<urn:CheckHealthResponse healthy="true" />'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckHealthBody::class, 'xml'));

        $json = json_encode([
            'CheckHealthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
            'CheckHealthResponse' => [
                'healthy' => TRUE,
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckHealthBody::class, 'json'));
    }

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
