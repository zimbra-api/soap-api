<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for UcServiceSelector.
 */
class UcServiceSelectorTest extends ZimbraStructTestCase
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
<ucservice by="name">$value</ucservice>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ucs, 'xml'));
        $this->assertEquals($ucs, $this->serializer->deserialize($xml, UcServiceSelector::class, 'xml'));

        $json = json_encode([
            'by' => 'name',
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ucs, 'json'));
        $this->assertEquals($ucs, $this->serializer->deserialize($json, UcServiceSelector::class, 'json'));
    }
}
