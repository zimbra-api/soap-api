<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ConversationMsgHitInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConversationMsgHitInfo.
 */
class ConversationMsgHitInfoTest extends ZimbraTestCase
{
    public function testConversationMsgHitInfo()
    {
        $id = $this->faker->uuid;
        $size = $this->faker->randomNumber;
        $folderId = $this->faker->uuid;
        $flags = $this->faker->word;
        $autoSendTime = $this->faker->unixTime;
        $date = $this->faker->unixTime;

        $info = new ConversationMsgHitInfo(
            $id, $size, $folderId, $flags, $autoSendTime, $date
        );
        $this->assertSame($id, $info->getId());
        $this->assertSame($size, $info->getSize());
        $this->assertSame($folderId, $info->getFolderId());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($autoSendTime, $info->getAutoSendTime());
        $this->assertSame($date, $info->getDate());

        $info = new ConversationMsgHitInfo();
        $info->setId($id)
            ->setSize($size)
            ->setFolderId($folderId)
            ->setFlags($flags)
            ->setAutoSendTime($autoSendTime)
            ->setDate($date);
        $this->assertSame($id, $info->getId());
        $this->assertSame($size, $info->getSize());
        $this->assertSame($folderId, $info->getFolderId());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($autoSendTime, $info->getAutoSendTime());
        $this->assertSame($date, $info->getDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" s="$size" l="$folderId" f="$flags" autoSendTime="$autoSendTime" d="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, ConversationMsgHitInfo::class, 'xml'));
    }
}
