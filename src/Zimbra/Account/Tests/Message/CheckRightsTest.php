<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Message;

use Zimbra\Account\Message\{CheckRightsEnvelope, CheckRightsBody, CheckRightsRequest, CheckRightsResponse};
use Zimbra\Account\Struct\{CheckRightsRightInfo, CheckRightsTargetInfo, CheckRightsTargetSpec};
use Zimbra\Enum\{TargetType, TargetBy};
use Zimbra\Struct\Tests\ZimbraStructTestCase;
/**
 * Testcase class for CheckRights.
 */
class CheckRightsTest extends ZimbraStructTestCase
{
    public function testCheckRights()
    {
        $key1 = $this->faker->word;
        $key2 = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $targetSpec = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key1, [$right1]
        );
        $rightInfo = new CheckRightsRightInfo($right2, TRUE);
        $targetInfo = new CheckRightsTargetInfo(
            TargetType::ACCOUNT(), TargetBy::NAME(), $key2, TRUE, [$rightInfo]
        );

        $request = new CheckRightsRequest([$targetSpec]);
        $this->assertSame([$targetSpec], $request->getTargets());

        $request = new CheckRightsRequest();
        $request->setTargets([$targetSpec])
            ->addTarget($targetSpec);
        $this->assertSame([$targetSpec, $targetSpec], $request->getTargets());
        $request->setTargets([$targetSpec]);

        $response = new CheckRightsResponse([$targetInfo]);
        $this->assertSame([$targetInfo], $response->getTargets());

        $response = new CheckRightsResponse();
        $response->setTargets([$targetInfo])
            ->addTarget($targetInfo);
        $this->assertSame([$targetInfo, $targetInfo], $response->getTargets());
        $response->setTargets([$targetInfo]);

        $body = new CheckRightsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());
        $body = new CheckRightsBody();
        $body->setRequest($request)
            ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new CheckRightsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new CheckRightsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAccount">'
                . '<soap:Body>'
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
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, CheckRightsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
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
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, CheckRightsEnvelope::class, 'json'));
    }
}
