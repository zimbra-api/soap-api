<?php declare(strict_types=1);

namespace Zimbra\Tests\Soap\Header;

use Zimbra\Soap\Header\NotifyInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for NotifyInfo.
 */
class NotifyInfoTest extends ZimbraTestCase
{
    public function testHeaderNotifyInfo()
    {
        $sequence = mt_rand(1, 100);

        $info = new NotifyInfo($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $info = new NotifyInfo();
        $info->setSequenceNum($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $xml = <<<EOT
<?xml version="1.0"?>
<result seq="$sequence" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, NotifyInfo::class, 'xml'));

        $json = json_encode([
            'seq' => $sequence,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, NotifyInfo::class, 'json'));
    }
}
