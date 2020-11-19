<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteUCServiceBody;
use Zimbra\Admin\Message\DeleteUCServiceEnvelope;
use Zimbra\Admin\Message\DeleteUCServiceRequest;
use Zimbra\Admin\Message\DeleteUCServiceResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteUCService.
 */
class DeleteUCServiceTest extends ZimbraStructTestCase
{
    public function testDeleteUCService()
    {
        $id = $this->faker->uuid;
        $request = new DeleteUCServiceRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteUCServiceRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteUCServiceResponse();

        $body = new DeleteUCServiceBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteUCServiceBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteUCServiceEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteUCServiceEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:DeleteUCServiceRequest>'
                        . '<id>' . $id . '</id>'
                    . '</urn:DeleteUCServiceRequest>'
                    . '<urn:DeleteUCServiceResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteUCServiceEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteUCServiceRequest' => [
                    'id' => [
                        '_content' => $id,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteUCServiceResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteUCServiceEnvelope::class, 'json'));
    }
}
