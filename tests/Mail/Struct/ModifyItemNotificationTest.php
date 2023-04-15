<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

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

        $item = new StubModifyItemNotification($msgInfo, $changeBitmask);
        $this->assertSame($msgInfo, $item->getMessageInfo());

        $item = new StubModifyItemNotification(new ImapMessageInfo(), $changeBitmask);
        $item->setMessageInfo($msgInfo);
        $this->assertSame($msgInfo, $item->getMessageInfo());

        $xml = <<<EOT
<?xml version="1.0"?>
<result change="$changeBitmask" xmlns:urn="urn:zimbraMail">
    <urn:m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($item, 'xml'));
        $this->assertEquals($item, $this->serializer->deserialize($xml, StubModifyItemNotification::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubModifyItemNotification extends ModifyItemNotification
{
}
