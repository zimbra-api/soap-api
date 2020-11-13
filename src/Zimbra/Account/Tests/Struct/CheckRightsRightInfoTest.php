<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Struct\CheckRightsRightInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right allow="true">' . $right . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rightInfo, 'xml'));
        $this->assertEquals($rightInfo, $this->serializer->deserialize($xml, CheckRightsRightInfo::class, 'xml'));

        $json = json_encode([
            '_content' => $right,
            'allow' => TRUE,
        ]);
        $this->assertSame($json, $this->serializer->serialize($rightInfo, 'json'));
        $this->assertEquals($rightInfo, $this->serializer->deserialize($json, CheckRightsRightInfo::class, 'json'));
    }
}
