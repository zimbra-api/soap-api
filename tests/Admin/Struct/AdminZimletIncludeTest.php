<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletInclude;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletInclude.
 */
class AdminZimletIncludeTest extends ZimbraTestCase
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
<result>$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($include, 'xml'));
        $this->assertEquals($include, $this->serializer->deserialize($xml, AdminZimletInclude::class, 'xml'));
    }
}
