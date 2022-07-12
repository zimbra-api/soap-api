<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ImapMessageInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ImapMessageInfo.
 */
class ImapMessageInfoTest extends ZimbraTestCase
{
    public function testImapMessageInfo()
    {
        $id = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;
        $type = $this->faker->word;
        $flags = $this->faker->randomNumber;
        $tags = $this->faker->word;

        $info = new ImapMessageInfo($id, $imapUid, $type, $flags, $tags);
        $this->assertSame($type, $info->getType());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($tags, $info->getTags());

        $info = new ImapMessageInfo($id, $imapUid);
        $info->setType($type)
           ->setFlags($flags)
           ->setTags($tags);
        $this->assertSame($type, $info->getType());
        $this->assertSame($flags, $info->getFlags());
        $this->assertSame($tags, $info->getTags());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" i4uid="$imapUid" t="$type" f="$flags" tn="$tags" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, ImapMessageInfo::class, 'xml'));
    }
}
