<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\CheckRightsRightInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRightsRightInfo.
 */
class CheckRightsRightInfoTest extends ZimbraTestCase
{
    public function testCheckRightsRightInfo()
    {
        $right = $this->faker->word;

        $rightInfo = new CheckRightsRightInfo($right, FALSE);
        $this->assertSame($right, $rightInfo->getRight());
        $this->assertFalse($rightInfo->getAllow());

        $rightInfo = new CheckRightsRightInfo();
        $rightInfo->setRight($right)
            ->setAllow(TRUE);
        $this->assertSame($right, $rightInfo->getRight());
        $this->assertTrue($rightInfo->getAllow());

        $xml = <<<EOT
<?xml version="1.0"?>
<result allow="true">$right</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rightInfo, 'xml'));
        $this->assertEquals($rightInfo, $this->serializer->deserialize($xml, CheckRightsRightInfo::class, 'xml'));
    }
}
