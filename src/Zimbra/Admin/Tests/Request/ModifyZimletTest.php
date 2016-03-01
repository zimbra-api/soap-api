<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\ModifyZimlet;
use Zimbra\Admin\Struct\IntegerValueAttrib;
use Zimbra\Admin\Struct\ValueAttrib;
use Zimbra\Admin\Struct\ZimletAcl;
use Zimbra\Admin\Struct\ZimletAclStatusPri;
use Zimbra\Enum\AclType;
use Zimbra\Enum\ZimletStatus;

/**
 * Testcase class for ModifyZimlet.
 */
class ModifyZimletTest extends ZimbraAdminApiTestCase
{
    public function testModifyZimletRequest()
    {
        $cos = $this->faker->word;
        $name = $this->faker->word;
        $value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::DENY());
        $status = new ValueAttrib(ZimletStatus::DISABLED()->value());
        $priority = new IntegerValueAttrib($value);
        $zimlet = new ZimletAclStatusPri($name, $acl, $status, $priority);

        $req = new ModifyZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());
        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyZimletRequest>'
                . '<zimlet name="' . $name . '">'
                    . '<acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                    . '<status value="' . ZimletStatus::DISABLED() . '" />'
                    . '<priority value="' . $value . '" />'
                . '</zimlet>'
            . '</ModifyZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'zimlet' => [
                    'name' => $name,
                    'acl' => [
                        'cos' => $cos,
                        'acl' => AclType::DENY()->value(),
                    ],
                    'status' => [
                        'value' => ZimletStatus::DISABLED()->value(),
                    ],
                    'priority' => [
                        'value' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyZimletApi()
    {
        $cos = $this->faker->word;
        $name = $this->faker->word;
        $value = mt_rand(0, 10);

        $acl = new ZimletAcl($cos, AclType::DENY());
        $status = new ValueAttrib(ZimletStatus::DISABLED()->value());
        $priority = new IntegerValueAttrib($value);
        $zimlet = new ZimletAclStatusPri($name, $acl, $status, $priority);

        $this->api->modifyZimlet(
            $zimlet
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyZimletRequest>'
                        . '<urn1:zimlet name="' . $name . '">'
                            . '<urn1:acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                            . '<urn1:status value="' . ZimletStatus::DISABLED() . '" />'
                            . '<urn1:priority value="' . $value . '" />'
                        . '</urn1:zimlet>'
                    . '</urn1:ModifyZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
