<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\Attr;
use Zimbra\Admin\Struct\RightsAttrs;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightsAttrs.
 */
class RightsAttrsTest extends ZimbraTestCase
{
    public function testRightsAttrs()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;

        $attrs = new StubRightsAttrs(FALSE, [new Attr($key, $value)]);
        $this->assertFalse($attrs->getAll());

        $attrs->setAll(TRUE);
        $this->assertTrue($attrs->getAll());

        $xml = <<<EOT
<?xml version="1.0"?>
<result all="true" xmlns:urn="urn:zimbraAdmin">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, StubRightsAttrs::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubRightsAttrs extends RightsAttrs
{
}
