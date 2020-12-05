<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\AdminZimletInclude;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AdminZimletInclude.
 */
class AdminZimletIncludeTest extends ZimbraStructTestCase
{
    public function testAdminZimletInclude()
    {
        $value = $this->faker->word;
        $include = new AdminZimletInclude($value);
        $this->assertSame($value, $include->getValue());

        $include = new AdminZimletInclude('');
        $include->setValue($value);
        $this->assertSame($value, $include->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<include>$value</include>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($include, 'xml'));
        $this->assertEquals($include, $this->serializer->deserialize($xml, AdminZimletInclude::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($include, 'json'));
        $this->assertEquals($include, $this->serializer->deserialize($json, AdminZimletInclude::class, 'json'));
    }
}
