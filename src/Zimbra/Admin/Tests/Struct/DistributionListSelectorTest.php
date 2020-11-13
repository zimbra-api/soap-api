<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DistributionListSelector.
 */
class DistributionListSelectorTest extends ZimbraStructTestCase
{
    public function testDistributionListSelector()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::ID(), $value);
        $this->assertEquals(DLBy::ID(), $dl->getBy());
        $this->assertSame($value, $dl->getValue());

        $dl = new DistributionListSelector(DLBy::ID());
        $dl->setBy(DLBy::NAME())
           ->setValue($value);
        $this->assertEquals(DLBy::NAME(), $dl->getBy());
        $this->assertSame($value, $dl->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) DLBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListSelector::class, 'json'));
    }
}
