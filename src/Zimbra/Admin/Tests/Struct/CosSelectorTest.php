<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\CosSelector;
use Zimbra\Enum\CosBy;

/**
 * Testcase class for CosSelector.
 */
class CosSelectorTest extends ZimbraAdminTestCase
{
    public function testCosSelector()
    {
        $value = $this->faker->word;
        $cos = new CosSelector(CosBy::ID(), $value);
        $this->assertTrue($cos->getBy()->is('id'));
        $this->assertSame($value, $cos->getValue());

        $cos->setBy(CosBy::NAME());
        $this->assertTrue($cos->getBy()->is('name'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cos);

        $array = [
            'cos' => [
                'by' => CosBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $cos->toArray());
    }
}
