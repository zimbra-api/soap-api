<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\SimpleElement;

/**
 * Testcase class for SimpleElement.
 */
class SimpleElementTest extends ZimbraAdminTestCase
{
    public function testSimpleElement()
    {
        $el = new SimpleElement;

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<any />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $el);

        $array = [
            'any' => [],
        ];
        $this->assertEquals($array, $el->toArray());
    }
}
