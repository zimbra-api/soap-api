<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Account\Struct\DistributionListSelector;

/**
 * Testcase class for DistributionListSelector.
 */
class DistributionListSelectorTest extends ZimbraAccountTestCase
{
    public function testDistributionListSelector()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::ID(), $value);
        $this->assertTrue($dl->getBy()->is('id'));
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME());
        $this->assertTrue($dl->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dl);

        $array = [
            'dl' => [
                'by' => DLBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $dl->toArray());
    }
}
