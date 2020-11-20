<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Soap\Header\ChangeInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ChangeInfo.
 */
class ChangeInfoTest extends ZimbraStructTestCase
{
    public function testHeaderChangeInfo()
    {
        $changeId = $this->faker->word;
        $changeType = $this->faker->word;

        $info = new ChangeInfo($changeId, $changeType);
        $this->assertSame($changeId, $info->getChangeId());
        $this->assertSame($changeType, $info->getChangeType());

        $info = new ChangeInfo();
        $info->setChangeId($changeId)
             ->setChangeType($changeType);
        $this->assertSame($changeId, $info->getChangeId());
        $this->assertSame($changeType, $info->getChangeType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<change token="' . $changeId . '" type="' . $changeType . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, ChangeInfo::class, 'xml'));

        $json = json_encode([
            'token' => $changeId,
            'type' => $changeType,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, ChangeInfo::class, 'json'));
    }
}
