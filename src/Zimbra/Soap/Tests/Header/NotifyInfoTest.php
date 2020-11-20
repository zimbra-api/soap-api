<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Soap\Header\NotifyInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for NotifyInfo.
 */
class NotifyInfoTest extends ZimbraStructTestCase
{
    public function testHeaderNotifyInfo()
    {
        $sequence = mt_rand(1, 100);

        $info = new NotifyInfo($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $info = new NotifyInfo();
        $info->setSequenceNum($sequence);
        $this->assertSame($sequence, $info->getSequenceNum());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<notify seq="' . $sequence . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, NotifyInfo::class, 'xml'));

        $json = json_encode([
            'seq' => $sequence,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, NotifyInfo::class, 'json'));
    }
}
