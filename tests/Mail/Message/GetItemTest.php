<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\GetItemEnvelope;
use Zimbra\Mail\Message\GetItemBody;
use Zimbra\Mail\Message\GetItemRequest;
use Zimbra\Mail\Message\GetItemResponse;

use Zimbra\Mail\Struct\ItemSpec;

use Zimbra\Mail\Struct\Folder;
use Zimbra\Mail\Struct\TagInfo;
use Zimbra\Mail\Struct\NoteInfo;
use Zimbra\Mail\Struct\ContactInfo;
use Zimbra\Mail\Struct\CalendarItemInfo;
use Zimbra\Mail\Struct\TaskItemInfo;
use Zimbra\Mail\Struct\ConversationSummary;
use Zimbra\Mail\Struct\CommonDocumentInfo;
use Zimbra\Mail\Struct\DocumentInfo;
use Zimbra\Mail\Struct\MessageSummary;
use Zimbra\Mail\Struct\ChatSummary;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetItem.
 */
class GetItemTest extends ZimbraTestCase
{
    public function testGetItem()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $folderId = $this->faker->uuid;
        $name = $this->faker->name;
        $path = $this->faker->word;

        $item = new ItemSpec($id, $folderId, $name, $path);
        $request = new GetItemRequest($item);
        $this->assertSame($item, $request->getItem());
        $request = new GetItemRequest(new ItemSpec());
        $request->setItem($item);
        $this->assertSame($item, $request->getItem());

        $folder = new Folder($id, $uuid);
        $tag = new TagInfo($id);
        $note = new NoteInfo($id);
        $contact = new ContactInfo($id);
        $appt = new CalendarItemInfo();
        $task = new TaskItemInfo();
        $conv = new ConversationSummary($id);
        $wiki = new CommonDocumentInfo($id);
        $doc = new DocumentInfo($id);
        $msg = new MessageSummary($id);
        $chat = new ChatSummary($id);

        $response = new GetItemResponse($tag);
        $this->assertSame($tag, $response->getItem());
        $response = new GetItemResponse($note);
        $this->assertSame($note, $response->getItem());
        $response = new GetItemResponse($contact);
        $this->assertSame($contact, $response->getItem());
        $response = new GetItemResponse($appt);
        $this->assertSame($appt, $response->getItem());
        $response = new GetItemResponse($task);
        $this->assertSame($task, $response->getItem());
        $response = new GetItemResponse($conv);
        $this->assertSame($conv, $response->getItem());
        $response = new GetItemResponse($wiki);
        $this->assertSame($wiki, $response->getItem());
        $response = new GetItemResponse($doc);
        $this->assertSame($doc, $response->getItem());
        $response = new GetItemResponse($msg);
        $this->assertSame($msg, $response->getItem());
        $response = new GetItemResponse($chat);
        $this->assertSame($chat, $response->getItem());
        $response = new GetItemResponse($folder);
        $this->assertSame($folder, $response->getItem());

        $body = new GetItemBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new GetItemBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetItemEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new GetItemEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:GetItemRequest>
            <item id="$id" l="$folderId" name="$name" path="$path" />
        </urn:GetItemRequest>
        <urn:GetItemResponse>
            <folder id="$id" uuid="$uuid" />
        </urn:GetItemResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetItemEnvelope::class, 'xml'));
    }
}
