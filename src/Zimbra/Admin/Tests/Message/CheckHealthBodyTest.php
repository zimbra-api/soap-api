<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHealthBody;
use Zimbra\Admin\Message\CheckHealthRequest;
use Zimbra\Admin\Message\CheckHealthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealthBody.
 */
class CheckHealthBodyTest extends ZimbraStructTestCase
{
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
}
