<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\PurgeAccountCalendarCacheBody;
use Zimbra\Admin\Message\PurgeAccountCalendarCacheEnvelope;
use Zimbra\Admin\Message\PurgeAccountCalendarCacheRequest;
use Zimbra\Admin\Message\PurgeAccountCalendarCacheResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for PurgeAccountCalendarCacheTest.
 */
class PurgeAccountCalendarCacheTest extends ZimbraStructTestCase
{
    public function testPurgeAccountCalendarCache()
    {
        $id = $this->faker->uuid;

        $request = new PurgeAccountCalendarCacheRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new PurgeAccountCalendarCacheRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new PurgeAccountCalendarCacheResponse();

        $body = new PurgeAccountCalendarCacheBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new PurgeAccountCalendarCacheBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new PurgeAccountCalendarCacheEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new PurgeAccountCalendarCacheEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:PurgeAccountCalendarCacheRequest id="$id" />
        <urn:PurgeAccountCalendarCacheResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, PurgeAccountCalendarCacheEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'PurgeAccountCalendarCacheRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'PurgeAccountCalendarCacheResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, PurgeAccountCalendarCacheEnvelope::class, 'json'));
    }
}
