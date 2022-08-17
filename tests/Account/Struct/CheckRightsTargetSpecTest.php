<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\TargetBy;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRightsTargetSpec.
 */
class CheckRightsTargetSpecTest extends ZimbraTestCase
{
    public function testCheckRightsTargetSpec()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->unique()->word;
        $right2 = $this->faker->unique()->word;
        $right3 = $this->faker->unique()->word;

        $target = new MockCheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getTargetType());
        $this->assertEquals(TargetBy::ID(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2], $target->getRights());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->addRight($right3);

        $this->assertEquals(TargetType::ACCOUNT(), $target->getTargetType());
        $this->assertEquals(TargetBy::NAME(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights());

        $type = TargetType::ACCOUNT()->getValue();
        $by = TargetBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" by="$by" key="$key" xmlns:urn="urn:zimbraAccount">
    <urn:right>$right1</urn:right>
    <urn:right>$right2</urn:right>
    <urn:right>$right3</urn:right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, MockCheckRightsTargetSpec::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: 'urn')]
class MockCheckRightsTargetSpec extends CheckRightsTargetSpec
{
}
