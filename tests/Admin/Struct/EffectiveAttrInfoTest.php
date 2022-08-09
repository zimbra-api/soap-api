<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveAttrInfo.
 */
class EffectiveAttrInfoTest extends ZimbraTestCase
{
    public function testEffectiveAttrInfo()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->text;
        $value2 = $this->faker->text;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);

        $attr = new StubEffectiveAttrInfo($name, $constraint, [$value1]);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());
        $this->assertSame([$value1], $attr->getValues());

        $attr = new StubEffectiveAttrInfo();
        $attr->setName($name)
            ->setConstraint($constraint)
            ->setValues([$value1, $value2]);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());
        $this->assertSame([$value1, $value2], $attr->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name" xmlns:urn="urn:zimbraAdmin">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, StubEffectiveAttrInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubEffectiveAttrInfo extends EffectiveAttrInfo
{
}
