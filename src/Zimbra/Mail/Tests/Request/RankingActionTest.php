<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\RankingActionOp;
use Zimbra\Mail\Request\RankingAction;
use Zimbra\Mail\Struct\RankingActionSpec;

/**
 * Testcase class for RankingAction.
 */
class RankingActionTest extends ZimbraMailApiTestCase
{
    public function testRankingActionRequest()
    {
        $email = $this->faker->email;
        $action = new RankingActionSpec(
            RankingActionOp::RESET(), $email
        );

        $req = new RankingAction(
            $action
        );
        $this->assertSame($action, $req->getAction());

        $req = new RankingAction(
            new RankingActionSpec(RankingActionOp::RESET(), '')
        );
        $req->setAction($action);
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RankingActionRequest>'
                .'<action op="' . RankingActionOp::RESET() . '" email="' . $email . '" />'
            .'</RankingActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RankingActionRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'action' => array(
                    'op' => RankingActionOp::RESET()->value(),
                    'email' => $email,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRankingActionApi()
    {
        $email = $this->faker->email;
        $action = new RankingActionSpec(
            RankingActionOp::RESET(), $email
        );
        $this->api->rankingAction(
            $action
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RankingActionRequest>'
                        .'<urn1:action op="' . RankingActionOp::RESET() . '" email="' . $email . '" />'
                    .'</urn1:RankingActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
