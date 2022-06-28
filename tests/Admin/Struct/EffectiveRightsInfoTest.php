<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveRightsInfo.
 */
class EffectiveRightsInfoTest extends ZimbraTestCase
{
    public function testEffectiveRightsInfo()
    {
        $name = $this->faker->name;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $max= $this->faker->word;
        $min= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);

        $rights = new StubEffectiveRightsInfo($setAttrs, $getAttrs, [$right]);
        $this->assertSame($setAttrs, $rights->getSetAttrs());
        $this->assertSame($getAttrs, $rights->getGetAttrs());
        $this->assertSame([$right], $rights->getRights());

        $rights = new StubEffectiveRightsInfo(new EffectiveAttrsInfo(), new EffectiveAttrsInfo());
        $rights->setSetAttrs($setAttrs)
            ->setGetAttrs($getAttrs)
            ->setRights([$right])
            ->addRight($right);
        $this->assertSame($setAttrs, $rights->getSetAttrs());
        $this->assertSame($getAttrs, $rights->getGetAttrs());
        $this->assertSame([$right, $right], $rights->getRights());
        $rights = new StubEffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:right n="$name" />
    <urn:setAttrs all="true">
        <urn:a n="$name">
            <urn:constraint>
                <urn:min>$min</urn:min>
                <urn:max>$max</urn:max>
                <urn:values>
                    <urn:v>$value1</urn:v>
                    <urn:v>$value2</urn:v>
                </urn:values>
            </urn:constraint>
            <urn:default>
                <urn:v>$value1</urn:v>
                <urn:v>$value2</urn:v>
            </urn:default>
        </urn:a>
    </urn:setAttrs>
    <urn:getAttrs all="false">
        <urn:a n="$name">
            <urn:constraint>
                <urn:min>$min</urn:min>
                <urn:max>$max</urn:max>
                <urn:values>
                    <urn:v>$value1</urn:v>
                    <urn:v>$value2</urn:v>
                </urn:values>
            </urn:constraint>
            <urn:default>
                <urn:v>$value1</urn:v>
                <urn:v>$value2</urn:v>
            </urn:default>
        </urn:a>
    </urn:getAttrs>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, StubEffectiveRightsInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubEffectiveRightsInfo extends EffectiveRightsInfo
{
}
