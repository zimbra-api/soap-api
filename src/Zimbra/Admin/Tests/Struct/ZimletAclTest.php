<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Enum\AclType;

/**
 * Testcase class for ZimletAcl.
 */
class ZimletAclTest extends ZimbraAdminTestCase
{
    public function testZimletAcl()
    {
        $cos = $this->faker->word;
        $acl = new ZimletAcl($cos, AclType::DENY());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame('deny', $acl->getAcl()->value());

        $acl->setCos($cos)
            ->setAcl(AclType::GRANT());
        $this->assertSame($cos, $acl->getCos());
        $this->assertSame('grant', $acl->getAcl()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<acl cos="' . $cos . '" acl="' . AclType::GRANT() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = [
            'acl' => [
                'cos' => $cos,
                'acl' => AclType::GRANT()->value(),
            ],
        ];
        $this->assertEquals($array, $acl->toArray());
    }
}
