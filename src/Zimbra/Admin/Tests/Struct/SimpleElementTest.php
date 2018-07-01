<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\SimpleElement;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SimpleElement.
 */
class SimpleElementTest extends ZimbraStructTestCase
{
    public function testSimpleElement()
    {
        $el = new SimpleElement;

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<any />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($el, 'xml'));

        $el = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\SimpleElement', 'xml');
        $this->assertTrue($el instanceof SimpleElement);
    }
}
