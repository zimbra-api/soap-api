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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightsResponse xmlns="urn:zimbraAccount">'
                . '<target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key1 . '" allow="false">'
                    . '<right allow="true">' . $right1 . '</right>'
                . '</target>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key2 . '" allow="true">'
                    . '<right allow="false">' . $right2 . '</right>'
                . '</target>'
            . '</CheckRightsResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, CheckRightsResponse::class, 'xml'));

        $json = json_encode([
            'target' => [
                [
                    'type' => (string) TargetType::DOMAIN(),
                    'by' => (string) TargetBy::ID(),
                    'key' => $key1,
                    'allow' => FALSE,
                    'right' => [
                        [
                            '_content' => $right1,
                            'allow' => TRUE,
                        ],
                    ],
                ],
                [
                    'type' => (string) TargetType::ACCOUNT(),
                    'by' => (string) TargetBy::NAME(),
                    'key' => $key2,
                    'allow' => TRUE,
                    'right' => [
                        [
                            '_content' => $right2,
                            'allow' => FALSE,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, CheckRightsResponse::class, 'json'));
    }
}
