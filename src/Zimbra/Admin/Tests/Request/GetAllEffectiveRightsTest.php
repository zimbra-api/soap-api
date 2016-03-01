<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllEffectiveRights;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;

/**
 * Testcase class for GetAllEffectiveRights.
 */
class GetAllEffectiveRightsTest extends ZimbraAdminApiTestCase
{
    public function testGetAllEffectiveRightsRequest()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $req = new GetAllEffectiveRights($grantee, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertFalse($req->getExpandAllAttrs());

        $req->setGrantee($grantee)
            ->setExpandAllAttrs(true);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertTrue($req->getExpandAllAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllEffectiveRightsRequest expandAllAttrs="true">'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetAllEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllEffectiveRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'expandAllAttrs' => true,
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

    public function testGetAllEffectiveRightsApi()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->api->getAllEffectiveRights(
            $grantee, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllEffectiveRightsRequest expandAllAttrs="true">'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetAllEffectiveRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
