<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ConstraintAttr.
 */
class ConstraintAttrTest extends ZimbraTestCase
{
    public function testConstraintAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new ConstraintInfo($min, $max, [$value]);
        $attr = new StubConstraintAttr($constraint, $name);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $attr = new StubConstraintAttr(new ConstraintInfo());
        $attr->setName($name)
             ->setConstraint($constraint);

        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:constraint>
        <urn:min>$min</urn:min>
        <urn:max>$max</urn:max>
        <urn:values>
            <urn:v>$value</urn:v>
        </urn:values>
    </urn:constraint>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, StubConstraintAttr::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubConstraintAttr extends ConstraintAttr
{
}
