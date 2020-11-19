<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\DeleteDomainBody;
use Zimbra\Admin\Message\DeleteDomainEnvelope;
use Zimbra\Admin\Message\DeleteDomainRequest;
use Zimbra\Admin\Message\DeleteDomainResponse;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DeleteDomain.
 */
class DeleteDomainTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:DeleteDomainRequest id="' . $id . '" />'
                    . '<urn:DeleteDomainResponse />'
                . '</soap:Body>'
            . '</soap:Envelope>';
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
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, DeleteDomainEnvelope::class, 'json'));
    }
}
