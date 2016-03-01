<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\RankingActionOp;
use Zimbra\Mail\Struct\RankingActionSpec;

/**
 * Testcase class for RankingActionSpec.
 */
class RankingActionSpecTest extends ZimbraMailTestCase
{
    public function testRankingActionSpec()
    {
        $email = $this->faker->email;
        $action = new RankingActionSpec(
            RankingActionOp::RESET(), $email
        );
        $this->assertTrue($action->getOperation()->is('reset'));
        $this->assertSame($email, $action->getEmail());

        $action = new RankingActionSpec(
            RankingActionOp::DELETE(), ''
        );
        $action->setOperation(RankingActionOp::RESET())
               ->setEmail($email);
        $this->assertTrue($action->getOperation()->is('reset'));
        $this->assertSame($email, $action->getEmail());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<action op="' . RankingActionOp::RESET() . '" email="' . $email . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => RankingActionOp::RESET()->value(),
                'email' => $email,
            )
        );
        $this->assertEquals($array, $action->toArray());
    }
}
