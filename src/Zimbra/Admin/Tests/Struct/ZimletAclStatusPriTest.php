<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Enum\AclType;
use Zimbra\Enum\ZimletStatus;

/**
 * Testcase class for ZimletAclStatusPri.
 */
class ZimletAclStatusPriTest extends ZimbraAdminTestCase
{
    public function testZimletAclStatusPri()
    {
        $name = $this->faker->word;
        $cos = $this->faker->word;
        $priority_value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::DENY());
        $status = new ValueAttrib(ZimletStatus::ENABLED()->value());
        $priority = new IntegerValueAttrib($priority_value);

        $zimlet = new ZimletAclStatusPri($name, $acl, $status, $priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $zimlet->setName($name)
               ->setAcl($acl)
               ->setStatus($status)
               ->setPriority($priority);
        $this->assertSame($name, $zimlet->getName());
        $this->assertSame($acl, $zimlet->getAcl());
        $this->assertSame($status, $zimlet->getStatus());
        $this->assertSame($priority, $zimlet->getPriority());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<zimlet name="' . $name . '">'
                . '<acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                . '<status value="' . ZimletStatus::ENABLED() . '" />'
                . '<priority value="' . $priority_value . '" />'
            . '</zimlet>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $zimlet);

        $array = [
            'zimlet' => [
                'name' => $name,
                'acl' => [
                    'cos' => $cos,
                    'acl' => AclType::DENY()->value(),
                ],
                'status' => [
                    'value' => ZimletStatus::ENABLED()->value(),
                ],
                'priority' => [
                    'value' => $priority_value,
                ],
            ],
        ];
        $this->assertEquals($array, $zimlet->toArray());
    }
}
