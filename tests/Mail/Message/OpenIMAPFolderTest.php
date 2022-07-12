<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\OpenIMAPFolderEnvelope;
use Zimbra\Mail\Message\OpenIMAPFolderBody;
use Zimbra\Mail\Message\OpenIMAPFolderRequest;
use Zimbra\Mail\Message\OpenIMAPFolderResponse;

use Zimbra\Mail\Struct\ImapCursorInfo;
use Zimbra\Mail\Struct\ImapMessageInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for OpenIMAPFolder.
 */
class OpenIMAPFolderTest extends ZimbraTestCase
{
    public function testOpenIMAPFolder()
    {
        $folderId = $this->faker->word;
        $limit = $this->faker->randomNumber;
        $id = $this->faker->word;
        $imapId = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $type = $this->faker->word;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;

        $cursor = new ImapCursorInfo($id);
        $message = new ImapMessageInfo($imapId, $imapUid, $type, $flags, $tags);

        $request = new OpenIMAPFolderRequest($folderId, $limit, $cursor);
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($cursor, $request->getCursor());
        $request = new OpenIMAPFolderRequest();
        $request->setFolderId($folderId)
            ->setLimit($limit)
            ->setCursor($cursor);
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertSame($limit, $request->getLimit());
        $this->assertSame($cursor, $request->getCursor());

        $response = new OpenIMAPFolderResponse([$message], FALSE, $cursor);
        $this->assertSame([$message], $response->getMessages());
        $this->assertFalse($response->getHasMore());
        $this->assertSame($cursor, $response->getCursor());
        $response = new OpenIMAPFolderResponse();
        $response->setMessages([$message])
            ->addMessage($message)
            ->setHasMore(TRUE)
            ->setCursor($cursor);
        $this->assertSame([$message, $message], $response->getMessages());
        $this->assertTrue($response->getHasMore());
        $this->assertSame($cursor, $response->getCursor());
        $response->setMessages([$message]);

        $body = new OpenIMAPFolderBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new OpenIMAPFolderBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new OpenIMAPFolderEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new OpenIMAPFolderEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:OpenIMAPFolderRequest l="$folderId" limit="$limit">
            <urn:cursor id="$id" />
        </urn:OpenIMAPFolderRequest>
        <urn:OpenIMAPFolderResponse more="true">
            <urn:folder>
                <urn:m id="$imapId" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
            </urn:folder>
            <urn:cursor id="$id" />
        </urn:OpenIMAPFolderResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, OpenIMAPFolderEnvelope::class, 'xml'));
    }
}
