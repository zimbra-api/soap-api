<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListRightSpec;

/**
 * Testcase class for DistributionListRightSpec.
 */
class DistributionListRightSpecTest extends ZimbraAccountTestCase
{
    public function testDistributionListRightSpec()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $value3 = $this->faker->word;
        $grantee1 = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value1);
        $grantee2 = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value2);
        $grantee3 = new DistributionListGranteeSelector(GranteeType::GRP(), DLGranteeBy::NAME(), $value3);

        $right = new DistributionListRightSpec($name, [$grantee1, $grantee2]);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2], $right->getGrantees()->all());

        $right->setRight($name)
              ->addGrantee($grantee3);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2, $grantee3], $right->getGrantees()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right right="' . $name . '">'
                . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value1 . '</grantee>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value2 . '</grantee>'
                . '<grantee type="' . GranteeType::GRP() . '" by="' . DLGranteeBy::NAME() . '">' . $value3 . '</grantee>'
            . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $right);

        $array = [
            'right' => [
                'right' => $name,
                'grantee' => [
                    [
                        'type' => GranteeType::ALL()->value(),
                        '_content' => $value1,
                        'by' => DLGranteeBy::NAME()->value(),
                    ],
                    [
                        'type' => GranteeType::USR()->value(),
                        '_content' => $value2,
                        'by' => DLGranteeBy::ID()->value(),
                    ],
                    [
                        'type' => GranteeType::GRP()->value(),
                        '_content' => $value3,
                        'by' => DLGranteeBy::NAME()->value(),
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $right->toArray());
    }
}
