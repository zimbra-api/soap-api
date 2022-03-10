<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $attr = new EffectiveAttrInfo($name, $constraint, [$value1]);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());
        $this->assertSame([$value1], $attr->getValues());

        $attr = new EffectiveAttrInfo('');
        $attr->setName($name)
            ->setConstraint($constraint)
            ->setValues([$value1])
            ->addValue($value2);
        $this->assertSame($name, $attr->getName());
        $this->assertSame($constraint, $attr->getConstraint());
        $this->assertSame([$value1, $value2], $attr->getValues());

        $xml = <<<EOT
<?xml version="1.0"?>
<result n="$name">
    <constraint>
        <min>$min</min>
        <max>$max</max>
        <values>
            <v>$value1</v>
            <v>$value2</v>
        </values>
    </constraint>
    <default>
        <v>$value1</v>
        <v>$value2</v>
    </default>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attr, 'xml'));
        $this->assertEquals($attr, $this->serializer->deserialize($xml, EffectiveAttrInfo::class, 'xml'));

        $json = json_encode([
            'n' => $name,
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
                            '_content' => $value1,
                        ],
                        [
                            '_content' => $value2,
                        ],
                    ],
                ],
            ],
            'default' => [
                'v' => [
                    [
                        '_content' => $value1,
                    ],
                    [
                        '_content' => $value2,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attr, 'json'));
        $this->assertEquals($attr, $this->serializer->deserialize($json, EffectiveAttrInfo::class, 'json'));
    }
}
