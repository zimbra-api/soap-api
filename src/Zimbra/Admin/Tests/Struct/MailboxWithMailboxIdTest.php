<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\MailboxWithMailboxId;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MailboxWithMailboxId.
 */
class MailboxWithMailboxIdTest extends ZimbraStructTestCase
{
    public function testMailboxWithMailboxId()
    {
        $id = $this->faker->uuid;
        $mbxid = mt_rand(1, 100);
        $size = mt_rand(1, 100);

        $mbox = new MailboxWithMailboxId($mbxid, $id, $size);
        $this->assertSame($mbxid, $mbox->getMbxid());
        $this->assertSame($id, $mbox->getAccountId());
        $this->assertSame($size, $mbox->getSize());

        $mbox = new MailboxWithMailboxId(0, '');
        $mbox->setMbxid($mbxid)
            ->setAccountId($id)
            ->setSize($size);
        $this->assertSame($mbxid, $mbox->getMbxid());
        $this->assertSame($id, $mbox->getAccountId());
        $this->assertSame($size, $mbox->getSize());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<mbox mbxid="' . $mbxid . '" id="' . $id . '" s="' . $size . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($mbox, 'xml'));
        $this->assertEquals($mbox, $this->serializer->deserialize($xml, MailboxWithMailboxId::class, 'xml'));

        $json = json_encode([
            'mbxid' => $mbxid,
            'id' => $id,
            's' => $size,
        ]);
        $this->assertSame($json, $this->serializer->serialize($mbox, 'json'));
        $this->assertEquals($mbox, $this->serializer->deserialize($json, MailboxWithMailboxId::class, 'json'));
    }
}
