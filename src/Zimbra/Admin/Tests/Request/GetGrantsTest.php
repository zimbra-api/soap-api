<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetGrants;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;

/**
 * Testcase class for GetGrants.
 */
class GetGrantsTest extends ZimbraAdminApiTestCase
{
    public function testGetGrantsRequest()
    {
        $value = $this->faker->word;
        $secret = $this->faker->sha1;
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $req = new GetGrants($target, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());

        $req->setTarget($target)
            ->setGrantee($grantee);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetGrantsRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetGrantsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetGrantsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
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

    public function testGetGrantsApi()
    {
        $value = $this->faker->word;
        $secret = $this->faker->sha1;
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->api->getGrants(
            $target, $grantee
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetGrantsRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetGrantsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
