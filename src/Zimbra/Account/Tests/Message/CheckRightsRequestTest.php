<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\CheckRightsRequest;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Enum\{TargetType, TargetBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsRequest.
 */
class CheckRightsRequestTest extends ZimbraStructTestCase
{
    public function testCheckRightsRequest()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $target1 = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key1, [$right1]
        );
        $target2 = new CheckRightsTargetSpec(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key2, [$right2]
        );

        $req = new CheckRightsRequest([$target1]);
        $this->assertSame([$target1], $req->getTargets());

        $req = new CheckRightsRequest();
        $req->setTargets([$target1])
            ->addTarget($target2);
        $this->assertSame([$target1, $target2], $req->getTargets());
    }
}
