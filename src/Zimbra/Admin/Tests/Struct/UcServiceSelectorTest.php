<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\UcServiceSelector;
use Zimbra\Enum\UcServiceBy;

/**
 * Testcase class for UcServiceSelector.
 */
class UcServiceSelectorTest extends ZimbraAdminTestCase
{
    public function testUcServiceSelector()
    {
        $value = $this->faker->word;
        $ucs = new UcServiceSelector(UcServiceBy::ID(), $value);
        $this->assertSame('id', $ucs->getBy()->value());

        $ucs->setBy(UcServiceBy::NAME());
        $this->assertSame('name', $ucs->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ucs);

        $array = [
            'ucservice' => [
                'by' => UcServiceBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $ucs->toArray());
    }
}
