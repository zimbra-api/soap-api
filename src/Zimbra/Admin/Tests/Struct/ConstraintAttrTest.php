<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintAttr;
use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ConstraintAttr.
 */
class ConstraintAttrTest extends ZimbraStructTestCase
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
<a name="$name">
    <constraint>
        <min>$min</min>
        <max>$max</max>
        <values>
            <v>$value</v>
        </values>
    </constraint>
</a>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, ConstraintAttr::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'constraint' => [
                'min' => [
                    '_content' => $min,
                ],
                'max' => [
                    '_content' => $max,
                ],
                'values' => [
                    'v' => [
                        [
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, ConstraintAttr::class, 'json'));
    }
}
