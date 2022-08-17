<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Common\Enum\AclType;
use Zimbra\Common\Enum\ZimletStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ZimletAclStatusPri.
 */
class ZimletAclStatusPriTest extends ZimbraTestCase
{
    public function testZimletAclStatusPri()
    {
        $name = $this->faker->word;
        $cos = $this->faker->word;
        $value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::GRANT());
        $status = new ValueAttrib(ZimletStatus::ENABLED()->getValue());
        $priority = new IntegerValueAttrib($value);

        $zimlet = new StubZimletAclStatusPri($name, $acl, $status, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet = new StubZimletAclStatusPri();
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
<result name="$name" xmlns:urn="urn:zimbraAdmin">
    <urn:acl cos="$cos" acl="grant" />
    <urn:status value="enabled" />
    <urn:priority value="$value" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($zimlet, 'xml'));
        $this->assertEquals($zimlet, $this->serializer->deserialize($xml, StubZimletAclStatusPri::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubZimletAclStatusPri extends ZimletAclStatusPri
{
}
