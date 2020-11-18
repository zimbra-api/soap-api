<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\{CheckRightsBody, CheckRightsRequest, CheckRightsResponse};
use Zimbra\Account\Struct\{CheckRightsRightInfo, CheckRightsTargetInfo, CheckRightsTargetSpec};
use Zimbra\Enum\{TargetType, TargetBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsBody.
 */
class CheckRightsBodyTest extends ZimbraStructTestCase
{
    public function testCheckRightsBody()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $target1 = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key1, [$right1]
        );
        $request = new CheckRightsRequest([$target1]);

        $rightInfo2 = new CheckRightsRightInfo($right2, TRUE);
        $target2 = new CheckRightsTargetInfo(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key2, TRUE, [$rightInfo2]
        );
        $response = new CheckRightsResponse([$target2]);

        $body = new CheckRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new CheckRightsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
    }
}
