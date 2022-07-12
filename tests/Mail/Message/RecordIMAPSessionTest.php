<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\RecordIMAPSessionEnvelope;
use Zimbra\Mail\Message\RecordIMAPSessionBody;
use Zimbra\Mail\Message\RecordIMAPSessionRequest;
use Zimbra\Mail\Message\RecordIMAPSessionResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RecordIMAPSession.
 */
class RecordIMAPSessionTest extends ZimbraTestCase
{
    public function testRecordIMAPSession()
    {
        $folderId = $this->faker->uuid;
        $lastItemId = $this->faker->randomNumber;
        $folderUuid = $this->faker->uuid;

        $request = new RecordIMAPSessionRequest($folderId);
        $this->assertSame($folderId, $request->getFolderId());
        $request = new RecordIMAPSessionRequest();
        $request->setFolderId($folderId);
        $this->assertSame($folderId, $request->getFolderId());

        $response = new RecordIMAPSessionResponse($lastItemId, $folderUuid);
        $this->assertSame($lastItemId, $response->getLastItemId());
        $this->assertSame($folderUuid, $response->getFolderUuid());
        $response = new RecordIMAPSessionResponse();
        $response->setLastItemId($lastItemId)
            ->setFolderUuid($folderUuid);
        $this->assertSame($lastItemId, $response->getLastItemId());
        $this->assertSame($folderUuid, $response->getFolderUuid());

        $body = new RecordIMAPSessionBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new RecordIMAPSessionBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new RecordIMAPSessionEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new RecordIMAPSessionEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:RecordIMAPSessionRequest id="$folderId" />
        <urn:RecordIMAPSessionResponse id="$lastItemId" luuid="$folderUuid" />
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, RecordIMAPSessionEnvelope::class, 'xml'));
    }
}
