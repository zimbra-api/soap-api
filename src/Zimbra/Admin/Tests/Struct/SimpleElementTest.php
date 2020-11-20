<?php declare(strict_types=1);

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
        $this->assertEquals($el, $this->serializer->deserialize($xml, SimpleElement::class, 'xml'));

        $json = '{}';
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($el, 'json'));
        $this->assertEquals($el, $this->serializer->deserialize($json, SimpleElement::class, 'json'));
    }
}
