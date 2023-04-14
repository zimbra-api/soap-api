<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Enum\DistributionListBy as DLBy;
use Zimbra\Common\Struct\DistributionListSelector;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListSelector.
 */
class DistributionListSelectorTest extends ZimbraTestCase
{
    public function testDistributionListSelector()
    {
        $value = $this->faker->word;
        $dl = new DistributionListSelector(DLBy::ID, $value);
        $this->assertEquals(DLBy::ID, $dl->getBy());
        $this->assertSame($value, $dl->getValue());

        $dl->setBy(DLBy::NAME;
        $this->assertEquals(DLBy::NAME, $dl->getBy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DistributionListSelector::class, 'xml'));
    }
}
