<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletIncludeCSS;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletIncludeCSS.
 */
class AdminZimletIncludeCSSTest extends ZimbraTestCase
{
    public function testAdminZimletIncludeCSS()
    {
        $value = $this->faker->word;
        $includeCSS = new AdminZimletIncludeCSS($value);
        $this->assertSame($value, $includeCSS->getValue());

        $includeCSS = new AdminZimletIncludeCSS('');
        $includeCSS->setValue($value);
        $this->assertSame($value, $includeCSS->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($includeCSS, 'xml'));
        $this->assertEquals($includeCSS, $this->serializer->deserialize($xml, AdminZimletIncludeCSS::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($includeCSS, 'json'));
        $this->assertEquals($includeCSS, $this->serializer->deserialize($json, AdminZimletIncludeCSS::class, 'json'));
    }
}
