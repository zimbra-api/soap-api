<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Account\Struct\DistributionListGranteeSelector;

/**
 * Testcase class for DistributionListGranteeSelector.
 */
class DistributionListGranteeSelectorTest extends ZimbraAccountTestCase
{
    public function testDistributionListGranteeSelector()
    {
        $value = $this->faker->word;
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::ID(), $value);
        $this->assertTrue($grantee->getType()->is('all'));
        $this->assertTrue($grantee->getBy()->is('id'));
        $this->assertSame($value, $grantee->getValue());

        $grantee->setType(GranteeType::USR())
                ->setBy(DLGranteeBy::NAME());
        $this->assertTrue($grantee->getType()->is('usr'));
        $this->assertTrue($grantee->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grantee);

        $array = [
            'grantee' => [
                'type' => GranteeType::USR()->value(),
                '_content' => $value,
                'by' => DLGranteeBy::NAME()->value(),
            ],
        ];
        $this->assertEquals($array, $grantee->toArray());
    }
}
