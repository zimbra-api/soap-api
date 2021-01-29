<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\SimpleElement;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SimpleElement.
 */
class SimpleElementTest extends ZimbraTestCase
{
    public function testSimpleElement()
    {
        $el = new SimpleElement;

        $xml = <<<EOT
<?xml version="1.0"?>
<any />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($el, 'xml'));
        $this->assertEquals($el, $this->serializer->deserialize($xml, SimpleElement::class, 'xml'));

        $json = '{}';
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($el, 'json'));
        $this->assertEquals($el, $this->serializer->deserialize($json, SimpleElement::class, 'json'));
    }
}
