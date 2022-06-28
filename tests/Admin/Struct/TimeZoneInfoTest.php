<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\TimeZoneInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TimeZoneInfo.
 */
class TimeZoneInfoTest extends ZimbraTestCase
{
    public function testTimeZoneInfo()
    {
        $id = $this->faker->word;
        $displayName = $this->faker->word;

        $info = new TimeZoneInfo($id, $displayName);
        $this->assertSame($id, $info->getId());
        $this->assertSame($displayName, $info->getDisplayName());

        $info = new TimeZoneInfo();
        $info->setId($id)
           ->setDisplayName($displayName);
        $this->assertSame($id, $info->getId());
        $this->assertSame($displayName, $info->getDisplayName());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" displayName="$displayName" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, TimeZoneInfo::class, 'xml'));
    }
}
