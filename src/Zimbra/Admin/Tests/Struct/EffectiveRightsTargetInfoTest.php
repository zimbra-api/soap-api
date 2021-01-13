<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTargetInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveRightsTargetInfo.
 */
class EffectiveRightsTargetInfoTest extends ZimbraStructTestCase
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

        $target = new EffectiveRightsTargetInfo(TargetType::ACCOUNT(), $id, $name, $setAttrs, $getAttrs, [$right]);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $target = new EffectiveRightsTargetInfo(TargetType::ACCOUNT(), '', '', $setAttrs, $getAttrs, [$right]);
        $target->setType(TargetType::DOMAIN())
            ->setId($id)
            ->setName($name);
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertSame($id, $target->getId());
        $this->assertSame($name, $target->getName());

        $type = TargetType::DOMAIN()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<target type="$type" id="$id" name="$name">
    <right n="$name" />
    <setAttrs all="true">
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
    </setAttrs>
    <getAttrs all="false">
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
    </getAttrs>
</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, EffectiveRightsTargetInfo::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'id' => $id,
            'name' => $name,
            'right' => [
                [
                    'n' => $name,
                ],
            ],
            'setAttrs' => [
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
            ],
            'getAttrs' => [
                'all' => FALSE,
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
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, EffectiveRightsTargetInfo::class, 'json'));
    }
}
