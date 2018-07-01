<?php

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

        $info = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header\ChangeInfo', 'xml');
        $this->assertSame($changeId, $info->getChangeId());
        $this->assertSame($changeType, $info->getChangeType());
    }
}
