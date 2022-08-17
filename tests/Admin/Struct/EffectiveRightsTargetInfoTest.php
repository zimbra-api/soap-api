<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTargetInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Common\Enum\TargetType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveRightsTargetInfo.
 */
class EffectiveRightsTargetInfoTest extends ZimbraTestCase
{
    public function testEffectiveRightsTargetInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $min= $this->faker->word;
        $max= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);

        $target = new StubEffectiveRightsTargetInfo($setAttrs, $getAttrs, TargetType::ACCOUNT(), $id, $name, [$right]);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $target = new StubEffectiveRightsTargetInfo($setAttrs, $getAttrs, TargetType::ACCOUNT(), '', '', [$right]);
        $target->setType(TargetType::DOMAIN())
            ->setId($id)
            ->setName($name);
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $type = TargetType::DOMAIN()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$type" id="$id" name="$name" xmlns:urn="urn:zimbraAdmin">
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
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, StubEffectiveRightsTargetInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubEffectiveRightsTargetInfo extends EffectiveRightsTargetInfo
{
}
