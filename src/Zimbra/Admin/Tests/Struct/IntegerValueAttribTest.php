<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\IntegerValueAttrib;

/**
 * Testcase class for IntegerValueAttrib.
 */
class IntegerValueAttribTest extends ZimbraAdminTestCase
{
    public function testIntegerValueAttrib()
    {
        $value = mt_rand(0, 100);
        $attr = new IntegerValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
                'value' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
