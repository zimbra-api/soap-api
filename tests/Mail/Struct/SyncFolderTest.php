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

        $items = [
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
