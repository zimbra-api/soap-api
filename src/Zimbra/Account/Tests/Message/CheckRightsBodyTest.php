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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAccount">'
                . '<urn:CheckRightsRequest>'
                    . '<target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key1 . '">'
                        . '<right>' . $right1 . '</right>'
                    . '</target>'
                . '</urn:CheckRightsRequest>'
                . '<urn:CheckRightsResponse>'
                    . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key2 . '" allow="true">'
                        . '<right allow="true">' . $right2 . '</right>'
                    . '</target>'
                . '</urn:CheckRightsResponse>'
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, CheckRightsBody::class, 'xml'));

        $json = json_encode([
            'CheckRightsRequest' => [
                'target' => [
                    [
                        'type' => (string) TargetType::DOMAIN(),
                        'by' => (string) TargetBy::ID(),
                        'key' => $key1,
                        'right' => [
                            [
                                '_content' => $right1,
                            ],
                        ],
                    ],
                ],
                '_jsns' => 'urn:zimbraAccount',
            ],
            'CheckRightsResponse' => [
                'target' => [
                    [
                        'type' => (string) TargetType::ACCOUNT(),
                        'by' => (string) TargetBy::NAME(),
                        'key' => $key2,
                        'allow' => TRUE,
                        'right' => [
                            [
                                '_content' => $right2,
                                'allow' => TRUE,
                            ],
                        ],
                    ],
                ],
                '_jsns' => 'urn:zimbraAccount',
            ],
        ]);

        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, CheckRightsBody::class, 'json'));
    }
}
