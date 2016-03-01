<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ValueAttrib;

/**
 * Testcase class for ValueAttrib.
 */
class ValueAttribTest extends ZimbraAdminTestCase
{
    public function testValueAttrib()
    {
        $value = $this->faker->word;
        $attr = new ValueAttrib($value);
        $this->assertSame($value, $attr->getValue());

        $attr->setValue($value);
        $this->assertSame($value, $attr->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<a value="' . $value  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attr);

        $array = [
            'a' => [
                'value' => $value,
            ],
        ];
        $this->assertEquals($array, $attr->toArray());
    }
}
