<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\CheckRights;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;

/**
 * Testcase class for CheckRights.
 */
class CheckRightsTest extends ZimbraAccountApiTestCase
{
    public function testCheckRightsRequest()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $target = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );
        $req = new CheckRights([$target]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$target], $req->getTargets()->all());

        $req->addTarget($target);
        $this->assertSame([$target, $target], $req->getTargets()->all());
        $req->getTargets()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightsRequest>'
                . '<target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key . '">'
                    . '<right>' . $right1 . '</right>'
                    . '<right>' . $right2 . '</right>'
                . '</target>'
            . '</CheckRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'target' => [
                    [
                        'type' => TargetType::DOMAIN()->value(),
                        'by' => TargetBy::ID()->value(),
                        'key' => $key,
                        'right' => [
                            $right1,
                            $right2,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRightsApi()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $target = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );

        $this->api->checkRights([$target]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:CheckRightsRequest>'
                        . '<urn1:target type="' . TargetType::DOMAIN() . '" by="' . TargetBy::ID() . '" key="' . $key . '">'
                            . '<urn1:right>' . $right1 . '</urn1:right>'
                            . '<urn1:right>' . $right2 . '</urn1:right>'
                        . '</urn1:target>'
                    . '</urn1:CheckRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
