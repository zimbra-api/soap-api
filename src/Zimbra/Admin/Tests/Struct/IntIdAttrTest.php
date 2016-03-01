<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\IntIdAttr;

/**
 * Testcase class for IntIdAttr.
 */
class IntIdAttrTest extends ZimbraAdminTestCase
{
    public function testIntIdAttr()
    {
        $value = mt_rand(0, 100);
        $attr = new IntIdAttr($value);
        $this->assertSame($value, $attr->getId());

        $attr->setId($value);
        $this->assertSame($value, $attr->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<attr id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'attr' => [
                'id' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
