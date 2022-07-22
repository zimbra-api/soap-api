<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetModifiedItemsIDsEnvelope;
use Zimbra\Mail\Message\GetModifiedItemsIDsBody;
use Zimbra\Mail\Message\GetModifiedItemsIDsRequest;
use Zimbra\Mail\Message\GetModifiedItemsIDsResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetModifiedItemsIDs.
 */
class GetModifiedItemsIDsTest extends ZimbraTestCase
{
    public function testGetModifiedItemsIDs()
    {
        $folderId = $this->faker->randomNumber;
        $modSeq = $this->faker->unixTime;
        $id1 = $this->faker->unique->randomNumber;
        $id2 = $this->faker->unique->randomNumber;

        $request = new GetModifiedItemsIDsRequest($folderId, $modSeq);
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($modSeq, $request->getModSeq());
        $request = new GetModifiedItemsIDsRequest();
        $request->setFolderId($folderId)
            ->setModSeq($modSeq);
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($modSeq, $request->getModSeq());

        $response = new GetModifiedItemsIDsResponse([$id1, $id2]);
        $this->assertSame([$id1, $id2], $response->getIds());
        $response = new GetModifiedItemsIDsResponse();
        $response->setIds([$id1])
            ->addId($id2);
        $this->assertSame([$id1, $id2], $response->getIds());

        $body = new GetModifiedItemsIDsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetModifiedItemsIDsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetModifiedItemsIDsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetModifiedItemsIDsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetModifiedItemsIDsRequest l="$folderId" ms="$modSeq" />
        <urn:GetModifiedItemsIDsResponse>
            <urn:ids>$id1</urn:ids>
            <urn:ids>$id2</urn:ids>
        </urn:GetModifiedItemsIDsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetModifiedItemsIDsEnvelope::class, 'xml'));
    }
}
