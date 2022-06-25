<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $right = new RightInfo($name, RightType::PRESET(), RightClass::ALL(), $desc, $targetType, $attrs, $rights);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertEquals(RightClass::ALL(), $right->getRightClass());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame($targetType, $right->getTargetType());
        $this->assertSame($attrs, $right->getAttrs());
        $this->assertSame($rights, $right->getRights());

        $right = new RightInfo('', RightType::COMBO(), RightClass::ADMIN(), '');
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
<result name="$name" type="preset" targetType="$targetType" rightClass="ALL">
    <desc>$desc</desc>
    <attrs all="true">
        <a n="$key">$value</a>
    </attrs>
    <rights>
        <r n="$name" type="preset" targetType="$targetType" />
    </rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, RightInfo::class, 'xml'));
    }
}
