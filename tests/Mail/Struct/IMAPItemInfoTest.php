<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\IMAPItemInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IMAPItemInfo.
 */
class IMAPItemInfoTest extends ZimbraTestCase
{
    public function testIMAPItemInfo()
    {
        $id = $this->faker->randomNumber;
        $imapUid = $this->faker->randomNumber;

        $info = new IMAPItemInfo($id, $imapUid);
        $this->assertSame($id, $info->getId());
        $this->assertSame($imapUid, $info->getImapUid());

        $info = new IMAPItemInfo();
        $info->setId($id)
           ->setImapUid($imapUid);
        $this->assertSame($id, $info->getId());
        $this->assertSame($imapUid, $info->getImapUid());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" i4uid="$imapUid" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, IMAPItemInfo::class, 'xml'));
    }
}
