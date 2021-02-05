<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\{ModifyItemNotification, ImapMessageInfo};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ModifyItemNotification.
 */
class ModifyItemNotificationTest extends ZimbraTestCase
{
    public function testModifyItemNotification()
    {
        $changeBitmask = mt_rand(1, 99);
        $id = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $type = $this->faker->word;
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;
        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);

        $item = new ModifyItemNotification($msgInfo, $changeBitmask);
        $this->assertSame($msgInfo, $item->getMessageInfo());

        $item = new ModifyItemNotification(new ImapMessageInfo(0, 0, '', 0, ''), $changeBitmask);
        $item->setMessageInfo($msgInfo);
        $this->assertSame($msgInfo, $item->getMessageInfo());

        $xml = <<<EOT
<?xml version="1.0"?>
<modMsgs change="$changeBitmask">
    <m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
</modMsgs>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, ModifyItemNotification::class, 'xml'));

        $json = json_encode([
            'change' => $changeBitmask,
            'm' => [
                'id' => $id,
                'i4uid' => $imapUid,
                't' => $type,
                'f' => $flags,
                'tn' => $tags,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($item, 'json'));
        $this->assertEquals($item, $this->serializer->deserialize($json, ModifyItemNotification::class, 'json'));
    }
}