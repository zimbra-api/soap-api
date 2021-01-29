<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\CheckRightsRightInfo;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsRightInfo.
 */
class CheckRightsRightInfoTest extends ZimbraStructTestCase
{
    public function testCheckRightsRightInfo()
    {
        $right = $this->faker->word;

        $rightInfo = new CheckRightsRightInfo($right, FALSE);
        $this->assertSame($right, $rightInfo->getRight());
        $this->assertFalse($rightInfo->getAllow());

        $rightInfo = new CheckRightsRightInfo('', FALSE);
        $rightInfo->setRight($right)
            ->setAllow(TRUE);
        $this->assertSame($right, $rightInfo->getRight());
        $this->assertTrue($rightInfo->getAllow());

        $xml = <<<EOT
<?xml version="1.0"?>
<right allow="true">$right</right>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rightInfo, 'xml'));
        $this->assertEquals($rightInfo, $this->serializer->deserialize($xml, CheckRightsRightInfo::class, 'xml'));

        $json = json_encode([
            '_content' => $right,
            'allow' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rightInfo, 'json'));
        $this->assertEquals($rightInfo, $this->serializer->deserialize($json, CheckRightsRightInfo::class, 'json'));
    }
}
