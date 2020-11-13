<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\{CreateItemNotification, ImapMessageInfo};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CreateItemNotification.
 */
class CreateItemNotificationTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<created>'
                . '<m id="' . $id . '" i4uid="' . $imapUid . '" t="' . $type . '" f="' . $flags . '" tn="' . $tags . '" />'
            . '</created>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($created, 'xml'));
        $this->assertEquals($created, $this->serializer->deserialize($xml, CreateItemNotification::class, 'xml'));

        $json = json_encode([
            'm' => [
                'id' => $id,
                'i4uid' => $imapUid,
                't' => $type,
                'f' => $flags,
                'tn' => $tags,
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($created, 'json'));
        $this->assertEquals($created, $this->serializer->deserialize($json, CreateItemNotification::class, 'json'));
    }
}
