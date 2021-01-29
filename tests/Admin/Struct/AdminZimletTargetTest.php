<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AdminZimletTarget;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AdminZimletTarget.
 */
class AdminZimletTargetTest extends ZimbraTestCase
{
    public function testAdminZimletTarget()
    {
        $value = $this->faker->word;
        $target = new AdminZimletTarget($value);
        $this->assertSame($value, $target->getValue());

        $target = new AdminZimletTarget('');
        $target->setValue($value);
        $this->assertSame($value, $target->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<target>$value</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, AdminZimletTarget::class, 'xml'));

        $json = json_encode([
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, AdminZimletTarget::class, 'json'));
    }
}
