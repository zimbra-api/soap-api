<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\{
    SyncDeletedInfo,
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

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SyncDeletedInfo.
 */
class SyncDeletedInfoTest extends ZimbraTestCase
{
    public function testSyncDeletedInfo()
    {
        $ids = $this->faker->word;

        $folder = new FolderIdsAttr($ids);
        $search = new SearchFolderIdsAttr($ids);
        $link = new MountIdsAttr($ids);
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
        $types = [
            $folder,
            $search,
            $link,
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

        $deleted = new StubSyncDeletedInfo($ids, $types);
        $this->assertSame($ids, $deleted->getIds());
        $this->assertSame($types, array_values($deleted->getTypes()));

        $deleted = new StubSyncDeletedInfo();
        $deleted->setIds($ids)
            ->setTypes($types);
        $this->assertSame($ids, $deleted->getIds());
        $this->assertSame($types, array_values($deleted->getTypes()));

        $xml = <<<EOT
<?xml version="1.0"?>
<result ids="$ids" xmlns:urn="urn:zimbraMail">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($deleted, 'xml'));
        $this->assertEquals($deleted, $this->serializer->deserialize($xml, StubSyncDeletedInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubSyncDeletedInfo extends SyncDeletedInfo
{
}
