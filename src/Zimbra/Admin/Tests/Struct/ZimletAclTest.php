<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Enum\AclType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ZimletAcl.
 */
class ZimletAclTest extends ZimbraStructTestCase
{
    public function testZimletAcl()
    {
        $cos = $this->faker->word;
        $acl = new ZimletAcl($cos, AclType::DENY());
        $this->assertSame($cos, $acl->getCos());
        $this->assertEquals(AclType::DENY(), $acl->getAcl());

        $acl = new ZimletAcl();
        $acl->setCos($cos)
            ->setAcl(AclType::GRANT());
        $this->assertSame($cos, $acl->getCos());
        $this->assertEquals(AclType::GRANT(), $acl->getAcl());

        $type = AclType::GRANT()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<acl cos="$cos" acl="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acl, 'xml'));
        $this->assertEquals($acl, $this->serializer->deserialize($xml, ZimletAcl::class, 'xml'));

        $json = json_encode([
            'cos' => $cos,
            'acl' => $type,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($acl, 'json'));
        $this->assertEquals($acl, $this->serializer->deserialize($json, ZimletAcl::class, 'json'));
    }
}
