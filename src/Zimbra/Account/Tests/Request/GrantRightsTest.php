<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GrantRights;
use Zimbra\Account\Struct\AccountACEInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\AceRightType;

/**
 * Testcase class for GrantRights.
 */
class GrantRightsTest extends ZimbraAccountApiTestCase
{
    public function testGrantRightsRequest()
    {
        $zid = $this->faker->word;
        $dir = $this->faker->word;
        $key = $this->faker->word;
        $pw = $this->faker->word;

        $ace = new AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $dir, $key, $pw, true, false
        );
        $req = new GrantRights([$ace]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$ace], $req->getAces()->all());

        $req->addAce($ace);
        $this->assertSame([$ace, $ace], $req->getAces()->all());
        $req->getAces()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GrantRightsRequest>'
                . '<ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
            . '</GrantRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GrantRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'ace' => [
                    [
                        'gt' => GranteeType::ALL()->value(),
                        'right' => AceRightType::VIEW_FREE_BUSY()->value(),
                        'zid' => $zid,
                        'd' => $dir,
                        'key' => $key,
                        'pw' => $pw,
                        'deny' => true,
                        'chkgt' => false,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGrantRightsApi()
    {
        $zid = $this->faker->word;
        $dir = $this->faker->word;
        $key = $this->faker->word;
        $pw = $this->faker->word;
        $ace = new AccountACEInfo(
            GranteeType::ALL(), AceRightType::VIEW_FREE_BUSY(), $zid, $dir, $key, $pw, true, false
        );

        $this->api->grantRights([$ace]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GrantRightsRequest>'
                        . '<urn1:ace gt="' . GranteeType::ALL() . '" right="' . AceRightType::VIEW_FREE_BUSY() . '" zid="' . $zid . '" d="' . $dir . '" key="' . $key . '" pw="' . $pw . '" deny="true" chkgt="false" />'
                    . '</urn1:GrantRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
