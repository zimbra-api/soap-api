<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

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

        $by = DLBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<dl by="$by">$value</dl>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListSelector::class, 'xml'));

        $json = json_encode([
            'by' => $by,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DistributionListSelector::class, 'json'));
    }
}
