<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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
        $attr = new ConstraintAttr($constraint, $name);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $attr = new ConstraintAttr(new ConstraintInfo(), '');
        $attr->setName($name)
             ->setConstraint($constraint);

        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name">
    <constraint>
        <min>$min</min>
        <max>$max</max>
        <values>
            <v>$value</v>
        </values>
    </constraint>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, ConstraintAttr::class, 'xml'));
    }
}
