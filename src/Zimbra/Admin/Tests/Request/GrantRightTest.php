<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GrantRight;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;

/**
 * Testcase class for GrantRight.
 */
class GrantRightTest extends ZimbraAdminApiTestCase
{
    public function testGrantRightRequest()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );
        $right = new RightModifierInfo($value, true, false, false, true);

        $req = new GrantRight($target, $grantee, $right);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GrantRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>'
            . '</GrantRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GrantRightRequest' => [
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
                'right' => [
                    'deny' => true,
                    'canDelegate' => false,
                    'disinheritSubGroups' => false,
                    'subDomain' => true,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGrantRightApi()
    {
        $value = $this->faker->word;
        $secret = $this->faker->word;

        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );
        $right = new RightModifierInfo($value, true, false, false, true);

        $this->api->grantRight(
            $target, $grantee, $right
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GrantRightRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                        . '<urn1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</urn1:right>'
                    . '</urn1:GrantRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
