<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\AceRightType;
use Zimbra\Mail\Request\GrantPermission;
use Zimbra\Mail\Struct\AccountACEinfo;

/**
 * Testcase class for GrantPermission.
 */
class GrantPermissionTest extends ZimbraMailApiTestCase
{
    public function testGrantPermissionRequest()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha1;
        $ace = new AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, true
        );
        $req = new GrantPermission(
            [$ace]
        );
        $this->assertSame([$ace], $req->getAces()->all());
        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());

        $req = new GrantPermission(
            [$ace]
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GrantPermissionRequest>'
                .'<ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zimbraId . '" d="' . $displayName . '" key="' . $accessKey . '" pw="' . $password . '" deny="true" />'
            .'</GrantPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GrantPermissionRequest' => array(
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

    public function testGrantPermissionApi()
    {
        $zimbraId = $this->faker->uuid;
        $displayName = $this->faker->word;
        $accessKey = $this->faker->word;
        $password = $this->faker->sha1;
        $ace = new AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), $zimbraId, $displayName, $accessKey, $password, true
        );
        $this->api->grantPermission([$ace]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GrantPermissionRequest>'
                        .'<urn1:ace gt="' . GranteeType::USR() . '" right="' . AceRightType::INVITE() . '" zid="' . $zimbraId . '" d="' . $displayName . '" key="' . $accessKey . '" pw="' . $password . '" deny="true" />'
                    .'</urn1:GrantPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
