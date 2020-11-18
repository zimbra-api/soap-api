<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckRightsResponse;
use Zimbra\Account\Struct\{CheckRightsRightInfo, CheckRightsTargetInfo};
use Zimbra\Enum\{TargetType, TargetBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsResponse.
 */
class CheckRightsResponseTest extends ZimbraStructTestCase
{
    public function testCheckRightsResponse()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $rightInfo1 = new CheckRightsRightInfo($right1, TRUE);
        $rightInfo2 = new CheckRightsRightInfo($right2, FALSE);

        $target1 = new CheckRightsTargetInfo(
            TargetType::DOMAIN(), TargetBy::ID(), $key1, FALSE, [$rightInfo1]
        );
        $target2 = new CheckRightsTargetInfo(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key2, TRUE, [$rightInfo2]
        );

        $res = new CheckRightsResponse([$target1]);
        $this->assertSame([$target1], $res->getTargets());

        $res = new CheckRightsResponse();
        $res->setTargets([$target1])
            ->addTarget($target2);
        $this->assertSame([$target1, $target2], $res->getTargets());
    }
}
