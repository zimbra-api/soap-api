<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ucs, 'xml'));
        $this->assertEquals($ucs, $this->serializer->deserialize($xml, UcServiceSelector::class, 'xml'));

        $json = json_encode([
            'by' => (string) UcServiceBy::NAME(),
            '_content' => $value,
        ]);
        $this->assertSame($json, $this->serializer->serialize($ucs, 'json'));
        $this->assertEquals($ucs, $this->serializer->deserialize($json, UcServiceSelector::class, 'json'));
    }
}
