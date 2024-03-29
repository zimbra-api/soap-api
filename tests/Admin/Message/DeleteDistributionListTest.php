<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\DeleteDistributionListBody;
use Zimbra\Admin\Message\DeleteDistributionListEnvelope;
use Zimbra\Admin\Message\DeleteDistributionListRequest;
use Zimbra\Admin\Message\DeleteDistributionListResponse;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DeleteDistributionList.
 */
class DeleteDistributionListTest extends ZimbraTestCase
{
    public function testDeleteDistributionList()
    {
        $id = $this->faker->uuid;
        $request = new DeleteDistributionListRequest($id, FALSE);
        $this->assertSame($id, $request->getId());
        $this->assertFalse($request->isCascadeDelete());
        $request = new DeleteDistributionListRequest('');
        $request->setId($id)
            ->setCascadeDelete(TRUE);
        $this->assertSame($id, $request->getId());
        $this->assertTrue($request->isCascadeDelete());

        $response = new DeleteDistributionListResponse();

        $body = new DeleteDistributionListBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new DeleteDistributionListBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new DeleteDistributionListEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new DeleteDistributionListEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:DeleteDistributionListRequest id="$id" cascadeDelete="true" />
        <urn:DeleteDistributionListResponse />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, DeleteDistributionListEnvelope::class, 'xml'));
    }
}
