<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\{
    SyncFolder,
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

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SyncFolder.
 */
class SyncFolderTest extends ZimbraTestCase
{
    public function testSyncFolder()
    {
        $id = $this->faker->uuid;
        $uuid = $this->faker->uuid;
        $ids = $this->faker->word;

        $tag = new TagIdsAttr($ids);
        $conv = new ConvIdsAttr($ids);
        $chat = new ChatIdsAttr($ids);
        $msg = new MsgIdsAttr($ids);
        $contact = new ContactIdsAttr($ids);
        $appt = new ApptIdsAttr($ids);
        $task = new TaskIdsAttr($ids);
        $note = new NoteIdsAttr($ids);
        $wiki = new WikiIdsAttr($ids);
        $doc = new DocIdsAttr($ids);
        $items = [
            $tag,
            $conv,
            $chat,
            $msg,
            $contact,
            $appt,
            $task,
            $note,
            $wiki,
            $doc,
        ];

        $folder = new StubSyncFolder($id, $uuid, $items);
        $this->assertSame($items, array_values($folder->getItemIds()));

        $folder = new StubSyncFolder($id, $uuid);
        $folder->setItemIds($items);
        $this->assertSame($items, array_values($folder->getItemIds()));

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" uuid="$uuid" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($folder, 'xml'));
        $this->assertEquals($folder, $this->serializer->deserialize($xml, StubSyncFolder::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubSyncFolder extends SyncFolder
{
}
