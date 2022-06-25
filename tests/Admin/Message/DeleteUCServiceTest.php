<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteUCServiceBody;
use Zimbra\Admin\Message\DeleteUCServiceEnvelope;
use Zimbra\Admin\Message\DeleteUCServiceRequest;
use Zimbra\Admin\Message\DeleteUCServiceResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteUCService.
 */
class DeleteUCServiceTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteUCServiceRequest>
            <id>$id</id>
        </urn:DeleteUCServiceRequest>
        <urn:DeleteUCServiceResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteUCServiceEnvelope::class, 'xml'));
    }
}
