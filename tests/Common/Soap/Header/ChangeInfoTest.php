<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Header;

use Zimbra\Common\Soap\Header\ChangeInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ChangeInfo.
 */
class ChangeInfoTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result token="$changeId" type="$changeType" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, ChangeInfo::class, 'xml'));
    }
}
