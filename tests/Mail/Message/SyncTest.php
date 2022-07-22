<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Message;

use Zimbra\Mail\Message\SyncEnvelope;
use Zimbra\Mail\Message\SyncBody;
use Zimbra\Mail\Message\SyncRequest;
use Zimbra\Mail\Message\SyncResponse;

use Zimbra\Mail\Struct\{
    SyncDeletedInfo,
    SyncFolder,
    FolderIdsAttr,
    SearchFolderIdsAttr,
    MountIdsAttr,
    TagIdsAttr,
    ConvIdsAttr,
    ChatIdsAttr,
    MsgIdsAttr,
    ContactIdsAttr,
    ApptIdsAttr,
    TaskIdsAttr,
    NoteIdsAttr,
    WikiIdsAttr,
    DocIdsAttr
};

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
 * Testcase class for Sync.
 */
class SyncTest extends ZimbraTestCase
{
    public function testSync()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ids = $this->faker->word;
        $token = $this->faker->text;
        $calendarCutoff = $this->faker->unixTime;
        $msgCutoff = $this->faker->unixTime;
        $folderId = $this->faker->uuid;
        $deleteLimit = $this->faker->randomNumber;
        $changeLimit = $this->faker->randomNumber;

        $changeDate = $this->faker->unixTime;
        $size = $this->faker->randomNumber;

        $request = new SyncRequest(
            $token, $calendarCutoff, $msgCutoff, $folderId, FALSE, $deleteLimit, $changeLimit
        );
        $this->assertSame($token, $request->getToken());
        $this->assertSame($calendarCutoff, $request->getCalendarCutoff());
        $this->assertSame($msgCutoff, $request->getMsgCutoff());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertFalse($request->getTypedDeletes());
        $this->assertSame($deleteLimit, $request->getDeleteLimit());
        $this->assertSame($changeLimit, $request->getChangeLimit());
        $request = new SyncRequest();
        $request->setToken($token)
            ->setCalendarCutoff($calendarCutoff)
            ->setMsgCutoff($msgCutoff)
            ->setFolderId($folderId)
            ->setTypedDeletes(TRUE)
            ->setDeleteLimit($deleteLimit)
            ->setChangeLimit($changeLimit);
        $this->assertSame($token, $request->getToken());
        $this->assertSame($calendarCutoff, $request->getCalendarCutoff());
        $this->assertSame($msgCutoff, $request->getMsgCutoff());
        $this->assertSame($folderId, $request->getFolderId());
        $this->assertTrue($request->getTypedDeletes());
        $this->assertSame($deleteLimit, $request->getDeleteLimit());
        $this->assertSame($changeLimit, $request->getChangeLimit());

        $deleted = new SyncDeletedInfo($ids, [
            new FolderIdsAttr($ids),
            new SearchFolderIdsAttr($ids),
            new MountIdsAttr($ids),
            new TagIdsAttr($ids),
            new ConvIdsAttr($ids),
            new ChatIdsAttr($ids),
            new MsgIdsAttr($ids),
            new ContactIdsAttr($ids),
            new ApptIdsAttr($ids),
            new TaskIdsAttr($ids),
            new NoteIdsAttr($ids),
            new WikiIdsAttr($ids),
            new DocIdsAttr($ids),
        ]);
        $folder = new SyncFolder($id, $uuid, [
            new TagIdsAttr($ids),
            new ConvIdsAttr($ids),
            new ChatIdsAttr($ids),
            new MsgIdsAttr($ids),
            new ContactIdsAttr($ids),
            new ApptIdsAttr($ids),
            new TaskIdsAttr($ids),
            new NoteIdsAttr($ids),
            new WikiIdsAttr($ids),
            new DocIdsAttr($ids),
        ]);
        $items = [
            $folder,
            new TagInfo($id),
            new NoteInfo($id),
            new ContactInfo($id),
            new CalendarItemInfo(),
            new TaskItemInfo(),
            new ConversationSummary($id),
            new CommonDocumentInfo($id),
            new DocumentInfo($id),
            new MessageSummary($id),
            new ChatSummary($id),
        ];

        $response = new SyncResponse(
            $changeDate, $token, $size, FALSE, $deleted, $items
        );
        $this->assertSame($changeDate, $response->getChangeDate());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($size, $response->getSize());
        $this->assertFalse($response->getMore());
        $this->assertSame($deleted, $response->getDeleted());
        $this->assertSame($items, array_values($response->getItems()));
        $response = new SyncResponse();
        $response->setChangeDate($changeDate)
            ->setToken($token)
            ->setSize($size)
            ->setMore(TRUE)
            ->setDeleted($deleted)
            ->setItems($items);
        $this->assertSame($changeDate, $response->getChangeDate());
        $this->assertSame($token, $response->getToken());
        $this->assertSame($size, $response->getSize());
        $this->assertTrue($response->getMore());
        $this->assertSame($deleted, $response->getDeleted());
        $this->assertSame($items, array_values($response->getItems()));

        $body = new SyncBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new SyncBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new SyncEnvelope($body);
        $this->assertSame($body, $envelope->getBody());
        $envelope = new SyncEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraMail">
    <soap:Body>
        <urn:SyncRequest token="$token" calCutoff="$calendarCutoff" msgCutoff="$msgCutoff" l="$folderId" typed="true" deleteLimit="$deleteLimit" changeLimit="$changeLimit" />
        <urn:SyncResponse md="$changeDate" token="$token" s="$size" more="true">
            <urn:deleted ids="$ids">
                <urn:folder ids="$ids" />
                <urn:search ids="$ids" />
                <urn:link ids="$ids" />
                <urn:tag ids="$ids" />
                <urn:c ids="$ids" />
                <urn:chat ids="$ids" />
                <urn:m ids="$ids" />
                <urn:cn ids="$ids" />
                <urn:appt ids="$ids" />
                <urn:task ids="$ids" />
                <urn:notes ids="$ids" />
                <urn:w ids="$ids" />
                <urn:doc ids="$ids" />
            </urn:deleted>
            <urn:folder id="$id" uuid="$uuid">
                <urn:tag ids="$ids" />
                <urn:c ids="$ids" />
                <urn:chat ids="$ids" />
                <urn:m ids="$ids" />
                <urn:cn ids="$ids" />
                <urn:appt ids="$ids" />
                <urn:task ids="$ids" />
                <urn:notes ids="$ids" />
                <urn:w ids="$ids" />
                <urn:doc ids="$ids" />
            </urn:folder>
            <urn:tag id="$id" />
            <urn:note id="$id" />
            <urn:cn id="$id" />
            <urn:appt />
            <urn:task />
            <urn:c id="$id" />
            <urn:w id="$id" />
            <urn:doc id="$id" />
            <urn:m id="$id" />
            <urn:chat id="$id" />
        </urn:SyncResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, SyncEnvelope::class, 'xml'));
    }
}
