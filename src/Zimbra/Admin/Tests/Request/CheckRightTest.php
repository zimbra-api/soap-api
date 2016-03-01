<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CheckRight;
use Zimbra\Admin\Struct\EffectiveRightsTargetSelector;
use Zimbra\Admin\Struct\GranteeSelector;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for CheckRight.
 */
class CheckRightTest extends ZimbraAdminApiTestCase
{
    public function testCheckRightRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $right = $this->faker->word;

        $attr = new KeyValuePair($key, $value);
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $req = new CheckRight($target, $grantee, $right, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
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
            . '<CheckRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right>' . $right . '</right>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckRightRequest' => [
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
                'right' => $right,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRightApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $secret = $this->faker->word;
        $right = $this->faker->word;
        $attr = new KeyValuePair($key, $value);
        $target = new EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->api->checkRight(
            $target, $grantee, $right, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckRightRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                        . '<urn1:right>' . $right . '</urn1:right>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CheckRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
