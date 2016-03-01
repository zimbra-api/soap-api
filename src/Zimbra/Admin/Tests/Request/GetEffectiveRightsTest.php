<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetEffectiveRights;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\AttrMethod;

/**
 * Testcase class for GetEffectiveRights.
 */
class GetEffectiveRightsTest extends ZimbraAdminApiTestCase
{
    public function testGetEffectiveRightsRequest()
    {
        $value = $this->faker->word;
        $secret = $this->faker->sha1;
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $req = new GetEffectiveRights($target, $grantee, AttrMethod::GET_ATTRS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame('getAttrs', $req->getExpandAllAttrs()->value());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setExpandAllAttrs(AttrMethod::SET_ATTRS());
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame('setAttrs', $req->getExpandAllAttrs()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetEffectiveRightsRequest expandAllAttrs="' . AttrMethod::SET_ATTRS() . '">'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetEffectiveRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'expandAllAttrs' => AttrMethod::SET_ATTRS()->value(),
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetEffectiveRightsApi()
    {
        $value = $this->faker->word;
        $secret = $this->faker->sha1;
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->api->getEffectiveRights(
            $target, $grantee, AttrMethod::SET_ATTRS()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetEffectiveRightsRequest expandAllAttrs="' . AttrMethod::SET_ATTRS() . '">'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetEffectiveRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
