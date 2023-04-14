<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EffectiveAttrsInfo.
 */
class EffectiveAttrsInfoTest extends ZimbraTestCase
{
    public function testEffectiveAttrsInfo()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->text;
        $value2 = $this->faker->text;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);

        $attrs = new StubEffectiveAttrsInfo(FALSE, [$attr]);
        $this->assertFalse($attrs->getAll());
        $this->assertSame([$attr], $attrs->getAttrs());

        $attrs = new StubEffectiveAttrsInfo();
        $attrs->setAll(TRUE)
            ->setAttrs([$attr]);
        $this->assertTrue($attrs->getAll());
        $this->assertSame([$attr], $attrs->getAttrs());
        $attrs = new StubEffectiveAttrsInfo(TRUE, [$attr]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result all="true" xmlns:urn="urn:zimbraAdmin">
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
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, StubEffectiveAttrsInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubEffectiveAttrsInfo extends EffectiveAttrsInfo
{
}
