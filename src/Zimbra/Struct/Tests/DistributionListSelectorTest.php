<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Struct\DistributionListSelector;

/**
 * Testcase class for DistributionListSelector.
 */
class DistributionListSelectorTest extends ZimbraStructTestCase
{
    public function testDistributionListSelector()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::ID()->value(), $value);
        $this->assertTrue(DLBy::ID()->is($dl->getBy()));
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME()->value());
        $this->assertTrue(DLBy::NAME()->is($dl->getBy()));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));

        $dl = $this->serializer->deserialize($xml, 'Zimbra\Struct\DistributionListSelector', 'xml');
        $this->assertTrue(DLBy::NAME()->is($dl->getBy()));
        $this->assertSame($value, $dl->getValue());
    }
}
