<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\Offset;

/**
 * Testcase class for Offset.
 */
class OffsetTest extends ZimbraAdminTestCase
{
    public function testOffset()
    {
        $value = mt_rand(0, 100);
        $offset = new Offset($value);
        $this->assertSame($value, $offset->getOffset());

        $offset->setOffset($value);
        $this->assertSame($value, $offset->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<offset offset="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $offset);

        $array = [
            'offset' => [
                'offset' => $value,
            ],
        ];
        $this->assertEquals($array, $offset->toArray());
    }
}
