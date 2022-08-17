<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Admin\Struct\RightsAttrs;
use Zimbra\Admin\Struct\RightInfo;
use Zimbra\Common\Enum\RightClass;
use Zimbra\Common\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightInfo.
 */
class RightInfoTest extends ZimbraTestCase
{
    public function testRightInfo()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;
        $desc = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attrs = new RightsAttrs(TRUE, [new Attr($key, $value)]);
        $rights = new ComboRights([new ComboRightInfo(
            $name, RightType::PRESET(), $targetType
        )]);

        $right = new StubRightInfo($name, RightType::PRESET(), RightClass::ALL(), $desc, $targetType, $attrs, $rights);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertEquals(RightClass::ALL(), $right->getRightClass());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame($targetType, $right->getTargetType());
        $this->assertSame($attrs, $right->getAttrs());
        $this->assertSame($rights, $right->getRights());

        $right = new StubRightInfo();
        $right->setName($name)
             ->setType(RightType::PRESET())
             ->setRightClass(RightClass::ALL())
             ->setDesc($desc)
             ->setTargetType($targetType)
             ->setAttrs($attrs)
             ->setRights($rights);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertEquals(RightClass::ALL(), $right->getRightClass());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame($targetType, $right->getTargetType());
        $this->assertSame($attrs, $right->getAttrs());
        $this->assertSame($rights, $right->getRights());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" type="preset" targetType="$targetType" rightClass="ALL" xmlns:urn="urn:zimbraAdmin">
    <urn:desc>$desc</urn:desc>
    <urn:attrs all="true">
        <urn:a n="$key">$value</urn:a>
    </urn:attrs>
    <urn:rights>
        <urn:r n="$name" type="preset" targetType="$targetType" />
    </urn:rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, StubRightInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubRightInfo extends RightInfo
{
}
