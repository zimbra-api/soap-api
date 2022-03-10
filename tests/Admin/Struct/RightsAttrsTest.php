<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

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

        $attrs = new RightsAttrs(FALSE, [new Attr($key, $value)]);
        $this->assertFalse($attrs->getAll());

        $attrs->setAll(TRUE);
        $this->assertTrue($attrs->getAll());

        $xml = <<<EOT
<?xml version="1.0"?>
<result all="true">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attrs, 'xml'));
        $this->assertEquals($attrs, $this->serializer->deserialize($xml, RightsAttrs::class, 'xml'));

        $json = json_encode([
            'all' => TRUE,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attrs, 'json'));
        $this->assertEquals($attrs, $this->serializer->deserialize($json, RightsAttrs::class, 'json'));
    }
}
