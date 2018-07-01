<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\GranteeType;
use Zimbra\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListGranteeSelector.
 */
class DistributionListGranteeSelectorTest extends ZimbraStructTestCase
{
    public function testDistributionListGranteeSelector()
    {
        $value = $this->faker->word;
        $grantee = new DistributionListGranteeSelector(GranteeType::ALL()->value(), DLGranteeBy::ID()->value(), $value);
        $this->assertSame(GranteeType::ALL()->value(), $grantee->getType());
        $this->assertSame(DLGranteeBy::ID()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());

        $grantee = new DistributionListGranteeSelector('', '');
        $grantee->setType(GranteeType::USR()->value())
                ->setBy(DLGranteeBy::NAME()->value())
                ->setValue($value);
        $this->assertSame(GranteeType::USR()->value(), $grantee->getType());
        $this->assertSame(DLGranteeBy::NAME()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<grantee type="' . GranteeType::USR() . '" by="' . DLGranteeBy::NAME() . '">' . $value . '</grantee>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));

        $grantee = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\DistributionListGranteeSelector', 'xml');
        $this->assertSame(GranteeType::USR()->value(), $grantee->getType());
        $this->assertSame(DLGranteeBy::NAME()->value(), $grantee->getBy());
        $this->assertSame($value, $grantee->getValue());
    }
}
