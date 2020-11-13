<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\CheckHealthResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckHealthResponse.
 */
class CheckHealthResponseTest extends ZimbraStructTestCase
{
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
}
