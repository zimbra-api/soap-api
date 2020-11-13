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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightsRequest xmlns="urn:zimbraAccount">'
                . '<target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key1 . '">'
                    . '<right>' . $right1 . '</right>'
                . '</target>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key2 . '">'
                    . '<right>' . $right2 . '</right>'
                . '</target>'
            . '</CheckRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, CheckRightsRequest::class, 'xml'));

        $json = json_encode([
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
                [
                    'type' => (string) TargetType::ACCOUNT(),
                    'by' => (string) TargetBy::NAME(),
                    'key' => $key2,
                    'right' => [
                        [
                            '_content' => $right2,
                        ],
                    ],
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, CheckRightsRequest::class, 'json'));
    }
}
