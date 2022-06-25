<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Common\Enum\UcServiceBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UcServiceSelector.
 */
class UcServiceSelectorTest extends ZimbraTestCase
{
    public function testUcServiceSelector()
    {
        $value = $this->faker->word;
        $ucs = new UcServiceSelector(UcServiceBy::ID(), $value);
        $this->assertEquals(UcServiceBy::ID(), $ucs->getBy());
        $this->assertSame($value, $ucs->getValue());

        $ucs = new UcServiceSelector(UcServiceBy::ID());
        $ucs->setBy(UcServiceBy::NAME())
            ->setValue($value);
        $this->assertEquals(UcServiceBy::NAME(), $ucs->getBy());
        $this->assertSame($value, $ucs->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ucs, 'xml'));
        $this->assertEquals($ucs, $this->serializer->deserialize($xml, UcServiceSelector::class, 'xml'));
    }
}
