<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsRightInfo;
use Zimbra\Account\Struct\CheckRightsTargetInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRightsTargetInfo.
 */
class CheckRightsTargetInfoTest extends ZimbraTestCase
{
    public function testCheckRightsTargetInfo()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->unique()->word;
        $right2 = $this->faker->unique()->word;

        $rightInfo1 = new CheckRightsRightInfo($right1, TRUE);
        $rightInfo2 = new CheckRightsRightInfo($right2, FALSE);

        $target = new CheckRightsTargetInfo(
            TargetType::DOMAIN(), TargetBy::ID(), $key, FALSE, [$rightInfo1]
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getTargetType());
        $this->assertEquals(TargetBy::ID(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertFalse($target->getAllow());
        $this->assertSame([$rightInfo1], $target->getRights());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->setAllow(TRUE)
               ->addRight($rightInfo2);

        $this->assertEquals(TargetType::ACCOUNT(), $target->getTargetType());
        $this->assertEquals(TargetBy::NAME(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertTrue($target->getAllow());
        $this->assertSame([$rightInfo1, $rightInfo2], $target->getRights());

        $type = TargetType::ACCOUNT()->getValue();
        $by = TargetBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" by="$by" key="$key" allow="true">
    <right allow="true">$right1</right>
    <right allow="false">$right2</right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, CheckRightsTargetInfo::class, 'xml'));
    }
}
