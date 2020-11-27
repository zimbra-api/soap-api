<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ConstraintInfo;
use Zimbra\Admin\Struct\EffectiveAttrInfo;
use Zimbra\Admin\Struct\EffectiveAttrsInfo;
use Zimbra\Admin\Struct\EffectiveRightsInfo;
use Zimbra\Admin\Struct\RightsEntriesInfo;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Struct\NamedElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RightsEntriesInfo.
 */
class RightsEntriesInfoTest extends ZimbraStructTestCase
{
    public function testRightsEntriesInfo()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $max = $this->faker->word;
        $min = $this->faker->word;

        $right = new RightWithName($name);
        $constraint = new ConstraintInfo($min, $max, [$value1, $value2]);
        $attr = new EffectiveAttrInfo($name, $constraint, [$value1, $value2]);
        $setAttrs = new EffectiveAttrsInfo(TRUE, [$attr]);
        $getAttrs = new EffectiveAttrsInfo(FALSE, [$attr]);

        $rights = new EffectiveRightsInfo($setAttrs, $getAttrs, [$right]);
        $entry = new NamedElement($name);

        $entries = new RightsEntriesInfo($rights, [$entry]);
        $this->assertSame($rights, $entries->getRights());
        $this->assertSame([$entry], $entries->getEntries());

        $entries = new RightsEntriesInfo(new EffectiveRightsInfo($setAttrs, $getAttrs));
        $entries->setRights($rights)
            ->setEntries([$entry])
            ->addEntry($entry);
        $this->assertSame($rights, $entries->getRights());
        $this->assertSame([$entry, $entry], $entries->getEntries());
        $entries = new RightsEntriesInfo($rights, [$entry]);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<entries>'
                . '<entry name="' . $name . '" />'
                . '<rights>'
                    . '<right n="' . $name . '" />'
                    . '<setAttrs all="true">'
                        . '<a n="' . $name . '">'
                            . '<constraint>'
                                . '<min>' . $min . '</min>'
                                . '<max>' . $max . '</max>'
                                . '<values>'
                                    . '<v>' . $value1 . '</v>'
                                    . '<v>' . $value2 . '</v>'
                                . '</values>'
                            . '</constraint>'
                            . '<default>'
                                . '<v>' . $value1 . '</v>'
                                . '<v>' . $value2 . '</v>'
                            . '</default>'
                        . '</a>'
                    . '</setAttrs>'
                    . '<getAttrs all="false">'
                        . '<a n="' . $name . '">'
                            . '<constraint>'
                                . '<min>' . $min . '</min>'
                                . '<max>' . $max . '</max>'
                                . '<values>'
                                    . '<v>' . $value1 . '</v>'
                                    . '<v>' . $value2 . '</v>'
                                . '</values>'
                            . '</constraint>'
                            . '<default>'
                                . '<v>' . $value1 . '</v>'
                                . '<v>' . $value2 . '</v>'
                            . '</default>'
                        . '</a>'
                    . '</getAttrs>'
                . '</rights>'
            . '</entries>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($entries, 'xml'));
        $this->assertEquals($entries, $this->serializer->deserialize($xml, RightsEntriesInfo::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($entries, 'json'));
        $this->assertEquals($entries, $this->serializer->deserialize($json, RightsEntriesInfo::class, 'json'));
    }
}
