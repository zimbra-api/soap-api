<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteDomainBody;
use Zimbra\Admin\Message\DeleteDomainEnvelope;
use Zimbra\Admin\Message\DeleteDomainRequest;
use Zimbra\Admin\Message\DeleteDomainResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteDomain.
 */
class DeleteDomainTest extends ZimbraTestCase
{
    public function testDeleteDomain()
    {
        $id = $this->faker->uuid;
        $request = new DeleteDomainRequest($id);
        $this->assertSame($id, $request->getId());
        $request = new DeleteDomainRequest('');
        $request->setId($id);
        $this->assertSame($id, $request->getId());

        $response = new DeleteDomainResponse();

        $body = new DeleteDomainBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteDomainBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteDomainEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteDomainEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDomainRequest id="$id" />
        <urn:DeleteDomainResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteDomainEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'DeleteDomainRequest' => [
                    'id' => $id,
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'DeleteDomainResponse' => [
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteDomainEnvelope::class, 'json'));
    }
}
