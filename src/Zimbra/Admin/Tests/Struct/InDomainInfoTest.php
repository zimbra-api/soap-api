<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\InDomainInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for InDomainInfo.
 */
class InDomainInfoTest extends ZimbraStructTestCase
{
    public function testInDomainInfo()
    {
        $name = $this->faker->word;
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
        $domain = new NamedElement($name);

        $inDomain = new InDomainInfo($rights, [$domain]);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain], $inDomain->getDomains());

        $inDomain = new InDomainInfo(new EffectiveRightsInfo($setAttrs, $getAttrs));
        $inDomain->setRights($rights)
            ->setDomains([$domain])
            ->addDomain($domain);
        $this->assertSame($rights, $inDomain->getRights());
        $this->assertSame([$domain, $domain], $inDomain->getDomains());
        $inDomain = new InDomainInfo($rights, [$domain]);

        $xml = <<<EOT
<?xml version="1.0"?>
<inDomain>
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
</inDomain>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inDomain, 'xml'));
        $this->assertEquals($inDomain, $this->serializer->deserialize($xml, InDomainInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($inDomain, 'json'));
        $this->assertEquals($inDomain, $this->serializer->deserialize($json, InDomainInfo::class, 'json'));
    }
}
