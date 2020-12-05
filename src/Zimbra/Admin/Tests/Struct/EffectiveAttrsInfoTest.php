<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveAttrsInfo.
 */
class EffectiveAttrsInfoTest extends ZimbraStructTestCase
{
    public function testEffectiveAttrsInfo()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);

        $attrs = new EffectiveAttrsInfo(FALSE, [$attr]);
        $this->assertFalse($attrs->getAll());
        $this->assertSame([$attr], $attrs->getAttrs());

        $attrs = new EffectiveAttrsInfo();
        $attrs->setAll(TRUE)
            ->setAttrs([$attr])
            ->addAttr($attr);
        $this->assertTrue($attrs->getAll());
        $this->assertSame([$attr, $attr], $attrs->getAttrs());
        $attrs = new EffectiveAttrsInfo(TRUE, [$attr]);

        $xml = <<<EOT
<?xml version="1.0"?>
<attrs all="true">
    <a n="$name">
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
    </a>
</attrs>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, EffectiveAttrsInfo::class, 'xml'));

        $json = json_encode([
            'all' => TRUE,
            'a' => [
                [
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
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attrs, 'json'));
        $this->assertEquals($attrs, $this->serializer->deserialize($json, EffectiveAttrsInfo::class, 'json'));
    }
}
