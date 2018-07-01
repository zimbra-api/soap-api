<?php

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
        $ucs = new UcServiceSelector(UcServiceBy::ID()->value(), $value);
        $this->assertSame(UcServiceBy::ID()->value(), $ucs->getBy());
        $this->assertSame($value, $ucs->getValue());

        $ucs = new UcServiceSelector('');
        $ucs->setBy(UcServiceBy::NAME()->value())
            ->setValue($value);
        $this->assertSame(UcServiceBy::NAME()->value(), $ucs->getBy());
        $this->assertSame($value, $ucs->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ucs, 'xml'));

        $ucs = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\UcServiceSelector', 'xml');
        $this->assertSame(UcServiceBy::NAME()->value(), $ucs->getBy());
        $this->assertSame($value, $ucs->getValue());
    }
}
