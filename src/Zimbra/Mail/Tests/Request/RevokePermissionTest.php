<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\GranteeType;
use Zimbra\Mail\Request\RevokePermission;
use Zimbra\Mail\Struct\AccountACEinfo;

/**
 * Testcase class for RevokePermission.
 */
class RevokePermissionTest extends ZimbraMailApiTestCase
{
    public function testRevokePermissionRequest()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha1;
        $ace = new AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, true
        );

        $req = new RevokePermission(
            [$ace]
        );
        $this->assertSame([$ace], $req->getAces()->all());
        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());

        $req = new RevokePermission(
            [$ace]
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<RevokePermissionRequest>'
                .'<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zimbraId . '" d="' . $displayName . '" key="' . $accessKey . '" pw="' . $password . '" deny="true" />'
            .'</RevokePermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RevokePermissionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'ace' => array(
                    array(
                        'gt' => GranteeType::USR()->value(),
                        'right' => AceRightType::INVITE()->value(),
                        'zid' => $zimbraId,
                        'd' => $displayName,
                        'key' => $accessKey,
                        'pw' => $password,
                        'deny' => true,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokePermissionApi()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha1;
        $ace = new AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, true
        );
        $this->api->revokePermission(
            [$ace]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RevokePermissionRequest>'
                        .'<urn1:ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zimbraId . '" d="' . $displayName . '" key="' . $accessKey . '" pw="' . $password . '" deny="true" />'
                    .'</urn1:RevokePermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
