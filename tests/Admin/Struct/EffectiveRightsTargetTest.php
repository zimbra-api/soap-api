<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\EffectiveRightsTarget;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Admin\Struct\RightsEntriesInfo;
use Zimbra\Enum\TargetType;
use Zimbra\Struct\NamedElement;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for EffectiveRightsTarget.
 */
class EffectiveRightsTargetTest extends ZimbraStructTestCase
{
    public function testEffectiveRightsTarget()
    {
        $name = $this->faker->word;
        $value1= $this->faker->text;
        $value2= $this->faker->text;
        $min= $this->faker->word;
        $max= $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);
        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);

        $domain = new NamedElement($name);
        $entry = new NamedElement($name);
        $inDomains = new InDomainInfo($rights, [$domain]);
        $entries = new RightsEntriesInfo($rights, [$entry]);

        $target = new EffectiveRightsTarget(TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]);
        $this->assertEquals(TargetType::ACCOUNT(), $target->getType());
        $this->assertSame($rights, $target->getAll());
        $this->assertSame([$inDomains], $target->getInDomainLists());
        $this->assertSame([$entries], $target->getEntriesLists());

        $target = new EffectiveRightsTarget(TargetType::ACCOUNT());
        $target->setType(TargetType::DOMAIN())
            ->setAll($rights)
            ->setInDomainLists([$inDomains])
            ->addInDomainList($inDomains)
            ->setEntriesLists([$entries])
            ->addEntriesList($entries);
        $this->assertEquals(TargetType::DOMAIN(), $target->getType());
        $this->assertSame($rights, $target->getAll());
        $this->assertSame([$inDomains, $inDomains], $target->getInDomainLists());
        $this->assertSame([$entries, $entries], $target->getEntriesLists());
        $target = new EffectiveRightsTarget(TargetType::ACCOUNT(), $rights, [$inDomains], [$entries]);

        $type = TargetType::ACCOUNT()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<target type="$type">
    <all>
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
    </all>
    <inDomains>
        <domain name="$name" />
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
    </inDomains>
    <entries>
        <entry name="$name" />
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
    </entries>
</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, EffectiveRightsTarget::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'all' => [
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
            ],
            'inDomains' => [
                [
                    'domain' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    'rights' => [
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
                    ],
                ],
            ],
            'entries' => [
                [
                    'entry' => [
                        [
                            'name' => $name,
                        ],
                    ],
                    'rights' => [
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
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, EffectiveRightsTarget::class, 'json'));
    }
}
