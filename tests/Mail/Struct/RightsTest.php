<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\Rights;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Rights.
 */
class RightsTest extends ZimbraTestCase
{
    public function testRights()
    {
        $effectivePermissions = $this->faker->word;

        $rights = new Rights($effectivePermissions);
        $this->assertSame($effectivePermissions, $rights->getEffectivePermissions());
        $rights = new Rights('');
        $rights->setEffectivePermissions($effectivePermissions);
        $this->assertSame($effectivePermissions, $rights->getEffectivePermissions());

        $xml = <<<EOT
<?xml version="1.0"?>
<result perm="$effectivePermissions" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, Rights::class, 'xml'));

        $json = json_encode([
            'perm' => $effectivePermissions,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rights, 'json'));
        $this->assertEquals($rights, $this->serializer->deserialize($json, Rights::class, 'json'));
    }
}
