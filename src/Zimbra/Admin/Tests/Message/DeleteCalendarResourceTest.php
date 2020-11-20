<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteCalendarResourceBody;
use Zimbra\Admin\Message\DeleteCalendarResourceEnvelope;
use Zimbra\Admin\Message\DeleteCalendarResourceRequest;
use Zimbra\Admin\Message\DeleteCalendarResourceResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteCalendarResource.
 */
class DeleteCalendarResourceTest extends ZimbraStructTestCase
{
    public function testDeleteCalendarResource()
    {
        $id = $this->faker->uuid;
        $request = new DeleteCalendarResourceRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteCalendarResourceRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteCalendarResourceResponse();

        $body = new DeleteCalendarResourceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteCalendarResourceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteCalendarResourceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteCalendarResourceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:DeleteCalendarResourceRequest id="' . $id . '" />'
                    . '<urn:DeleteCalendarResourceResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteCalendarResourceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteCalendarResourceRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteCalendarResourceResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteCalendarResourceEnvelope::class, 'json'));
    }
}
