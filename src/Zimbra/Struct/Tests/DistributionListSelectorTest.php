<?php declare(strict_types=1);

namespace Zimbra\Struct\Tests;

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
        $dl = new DistributionListSelector(DLBy::ID(), $value);
        $this->assertEquals(DLBy::ID(), $dl->getBy());
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME());
        $this->assertEquals(DLBy::NAME(), $dl->getBy());

        $xml = <<<EOT
<?xml version="1.0"?>
<dl by="name">$value</dl>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListSelector::class, 'xml'));

        $json = json_encode([
            'by' => 'name',
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListSelector::class, 'json'));
    }
}
