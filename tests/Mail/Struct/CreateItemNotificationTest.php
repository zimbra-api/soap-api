<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\{CreateItemNotification, ImapMessageInfo};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CreateItemNotification.
 */
class CreateItemNotificationTest extends ZimbraTestCase
{
    public function testCreateItemNotification()
    {
        $id = mt_rand(1, 99);
        $imapUid = mt_rand(1, 99);
        $type = $this->faker->word;
        $flags = mt_rand(1, 99);
        $tags = $this->faker->word;
        $msgInfo = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);

        $created = new CreateItemNotification($msgInfo);
        $this->assertSame($msgInfo, $created->getMessageInfo());

        $created = new CreateItemNotification(new ImapMessageInfo(0, 0, '', 0, ''));
        $created->setMessageInfo($msgInfo);
        $this->assertSame($msgInfo, $created->getMessageInfo());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>
    <m id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($created, 'xml'));
        $this->assertEquals($created, $this->serializer->deserialize($xml, CreateItemNotification::class, 'xml'));
    }
}
