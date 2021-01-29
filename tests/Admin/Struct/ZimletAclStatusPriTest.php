<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Enum\AclType;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ZimletAclStatusPri.
 */
class ZimletAclStatusPriTest extends ZimbraStructTestCase
{
    public function testZimletAclStatusPri()
    {
        $name = $this->faker->word;
        $cos = $this->faker->word;
        $value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::GRANT());
        $status = new ValueAttrib(ZimletStatus::ENABLED()->getValue());
        $priority = new IntegerValueAttrib($value);

        $zimlet = new ZimletAclStatusPri($name, $acl, $status, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet = new ZimletAclStatusPri('');
        $zimlet->setName($name)
               ->setAcl($acl)
               ->setStatus($status)
               ->setPriority($priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $xml = <<<EOT
<?xml version="1.0"?>
<zimlet name="$name">
    <acl cos="$cos" acl="grant" />
    <status value="enabled" />
    <priority value="$value" />
</zimlet>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, ZimletAclStatusPri::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'acl' => [
                'cos' => $cos,
                'acl' => 'grant',
            ],
            'status' => [
                'value' => 'enabled',
            ],
            'priority' => [
                'value' => $value,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($zimlet, 'json'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($json, ZimletAclStatusPri::class, 'json'));
    }
}
