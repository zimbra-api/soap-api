<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Response;

use Zimbra\Admin\Message\AdminDestroyWaitSetBody;
use Zimbra\Admin\Message\AdminDestroyWaitSetEnvelope;
use Zimbra\Admin\Message\AdminDestroyWaitSetRequest;
use Zimbra\Admin\Message\AdminDestroyWaitSetResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminDestroyWaitSet.
 */
class AdminDestroyWaitSetTest extends ZimbraStructTestCase
{
    public function testAdminDestroyWaitSet()
    {
        $waitSetId = $this->faker->uuid;
        $request = new AdminDestroyWaitSetRequest(
            $waitSetId
        );
        $this->assertSame($waitSetId, $request->getWaitSetId());

        $request = new AdminDestroyWaitSetRequest('');
        $request->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $request->getWaitSetId());

        $response = new AdminDestroyWaitSetResponse(
            $waitSetId
        );
        $this->assertSame($waitSetId, $response->getWaitSetId());

        $response = new AdminDestroyWaitSetResponse('');
        $response->setWaitSetId($waitSetId);
        $this->assertSame($waitSetId, $response->getWaitSetId());

        $body = new AdminDestroyWaitSetBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new AdminDestroyWaitSetBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new AdminDestroyWaitSetEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new AdminDestroyWaitSetEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:AdminDestroyWaitSetRequest waitSet="' . $waitSetId . '" />'
                    . '<urn:AdminDestroyWaitSetResponse waitSet="' . $waitSetId . '" />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, AdminDestroyWaitSetEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'AdminDestroyWaitSetRequest' => [
                    'waitSet' => $waitSetId,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'AdminDestroyWaitSetResponse' => [
                    'waitSet' => $waitSetId,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, AdminDestroyWaitSetEnvelope::class, 'json'));
    }
}
