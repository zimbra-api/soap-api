<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListRightSpec.
 */
class DistributionListRightSpecTest extends ZimbraStructTestCase
{
    public function testDistributionListRightSpec()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $grantee1 = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value1);
        $grantee2 = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value2);

        $right = new DistributionListRightSpec($name, [$grantee1]);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1], $right->getGrantees());

        $right = new DistributionListRightSpec('');
        $right->setRight($name)
              ->setGrantees([$grantee1])
              ->addGrantee($grantee2);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2], $right->getGrantees());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right right="' . $name . '">'
                . '<grantee type="' . GranteeType::ALL() . '" by="' . DLGranteeBy::NAME() . '">' . $value1 . '</grantee>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::ID() . '">' . $value2 . '</grantee>'
            . '</right>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));

        $right = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\DistributionListRightSpec', 'xml');
        $grantee1 = $right->getGrantees()[0];
        $grantee2 = $right->getGrantees()[1];

        $this->assertSame($name, $right->getRight());
        $this->assertSame(GranteeType::ALL()->value(), $grantee1->getType());
        $this->assertSame(DLGranteeBy::NAME()->value(), $grantee1->getBy());
        $this->assertSame($value1, $grantee1->getValue());
        $this->assertSame(GranteeType::USR()->value(), $grantee2->getType());
        $this->assertSame(DLGranteeBy::ID()->value(), $grantee2->getBy());
        $this->assertSame($value2, $grantee2->getValue());
    }
}
