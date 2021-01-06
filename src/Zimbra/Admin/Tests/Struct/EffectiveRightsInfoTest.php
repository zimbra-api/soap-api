<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveRightsInfo.
 */
class EffectiveRightsInfoTest extends ZimbraStructTestCase
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

        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);
        $this->assertSame($setAttrs, $rights->getSetAttrs());
        $this->assertSame($getAttrs, $rights->getGetAttrs());
        $this->assertSame([$right], $rights->getRights());

        $rights = new EffectiveRightsInfo(new EffectiveAttrsInfo(TRUE), new EffectiveAttrsInfo(FALSE));
        $rights->setSetAttrs($setAttrs)
            ->setGetAttrs($getAttrs)
            ->setRights([$right])
            ->addRight($right);
        $this->assertSame($setAttrs, $rights->getSetAttrs());
        $this->assertSame($getAttrs, $rights->getGetAttrs());
        $this->assertSame([$right, $right], $rights->getRights());
        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $xml = <<<EOT
<?xml version="1.0"?>
<rights>
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
</rights>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, EffectiveRightsInfo::class, 'xml'));

        $json = json_encode([
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
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rights, 'json'));
        $this->assertEquals($rights, $this->serializer->deserialize($json, EffectiveRightsInfo::class, 'json'));
    }
}
