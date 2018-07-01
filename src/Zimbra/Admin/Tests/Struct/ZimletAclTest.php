<?php

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
        $acl = new ZimletAcl($cos, AclType::DENY()->value());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame(AclType::DENY()->value(), $acl->getAcl());

        $acl = new ZimletAcl();
        $acl->setCos($cos)
            ->setAcl(AclType::GRANT()->value());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame(AclType::GRANT()->value(), $acl->getAcl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<acl cos="' . $cos . '" acl="' . AclType::GRANT() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($acl, 'xml'));

        $acl = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ZimletAcl', 'xml');
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame(AclType::GRANT()->value(), $acl->getAcl());
    }
}
