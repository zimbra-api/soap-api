<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\FileSharedWithMeEnvelope;
use Zimbra\Mail\Message\FileSharedWithMeBody;
use Zimbra\Mail\Message\FileSharedWithMeRequest;
use Zimbra\Mail\Message\FileSharedWithMeResponse;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FileSharedWithMe.
 */
class FileSharedWithMeTest extends ZimbraTestCase
{
    public function testFileSharedWithMe()
    {
        $action = $this->faker->word;
        $fileName = $this->faker->word;
        $ownerFileId = $this->faker->randomNumber;
        $fileUUID = $this->faker->word;
        $fileOwnerName = $this->faker->word;
        $rights = $this->faker->word;
        $contentType = $this->faker->word;
        $size = $this->faker->randomNumber;
        $ownerAccountId = $this->faker->word;
        $date = $this->faker->randomNumber;
        $status = $this->faker->word;

        $request = new FileSharedWithMeRequest(
            $action, $fileName, $ownerFileId, $fileUUID, $fileOwnerName, $rights, $contentType, $size, $ownerAccountId,$date
        );
        $this->assertSame($action, $request->getAction());
        $this->assertSame($fileName, $request->getFileName());
        $this->assertSame($ownerFileId, $request->getOwnerFileId());
        $this->assertSame($fileUUID, $request->getFileUUID());
        $this->assertSame($fileOwnerName, $request->getFileOwnerName());
        $this->assertSame($rights, $request->getRights());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($size, $request->getSize());
        $this->assertSame($ownerAccountId, $request->getOwnerAccountId());
        $this->assertSame($date, $request->getDate());
        $request = new FileSharedWithMeRequest();
        $request->setAction($action)
            ->setFileName($fileName)
            ->setOwnerFileId($ownerFileId)
            ->setFileUUID($fileUUID)
            ->setFileOwnerName($fileOwnerName)
            ->setRights($rights)
            ->setContentType($contentType)
            ->setSize($size)
            ->setOwnerAccountId($ownerAccountId)
            ->setDate($date);
        $this->assertSame($action, $request->getAction());
        $this->assertSame($fileName, $request->getFileName());
        $this->assertSame($ownerFileId, $request->getOwnerFileId());
        $this->assertSame($fileUUID, $request->getFileUUID());
        $this->assertSame($fileOwnerName, $request->getFileOwnerName());
        $this->assertSame($rights, $request->getRights());
        $this->assertSame($contentType, $request->getContentType());
        $this->assertSame($size, $request->getSize());
        $this->assertSame($ownerAccountId, $request->getOwnerAccountId());
        $this->assertSame($date, $request->getDate());

        $response = new FileSharedWithMeResponse($status);
        $this->assertSame($status, $response->getStatus());
        $response = new FileSharedWithMeResponse();
        $response->setStatus($status);
        $this->assertSame($status, $response->getStatus());

        $body = new FileSharedWithMeBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new FileSharedWithMeBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new FileSharedWithMeEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new FileSharedWithMeEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:FileSharedWithMeRequest>
            <urn:action>$action</urn:action>
            <urn:filename>$fileName</urn:filename>
            <urn:itemId>$ownerFileId</urn:itemId>
            <urn:ruuid>$fileUUID</urn:ruuid>
            <urn:owner>$fileOwnerName</urn:owner>
            <urn:perm>$rights</urn:perm>
            <urn:ct>$contentType</urn:ct>
            <urn:s>$size</urn:s>
            <urn:rid>$ownerAccountId</urn:rid>
            <urn:d>$date</urn:d>
        </urn:FileSharedWithMeRequest>
        <urn:FileSharedWithMeResponse>
            <urn:status>$status</urn:status>
        </urn:FileSharedWithMeResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, FileSharedWithMeEnvelope::class, 'xml'));
    }
}
