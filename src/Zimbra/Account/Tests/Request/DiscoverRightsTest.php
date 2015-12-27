<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\DiscoverRights;

/**
 * Testcase class for DiscoverRights.
 */
class DiscoverRightsTest extends ZimbraAccountApiTestCase
{
    public function testDiscoverRightsRequest()
    {
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $req = new DiscoverRights([$right1]);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame([$right1], $req->getRights()->all());

        $req->addRight($right2);
        $this->assertSame([$right1, $right2], $req->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DiscoverRightsRequest>'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
            . '</DiscoverRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DiscoverRightsRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'right' => [
                    $right1,
                    $right2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDiscoverRightsApi()
    {
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;

        $this->api->discoverRights(
            [$right1, $right2]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:DiscoverRightsRequest>'
                        . '<urn1:right>' . $right1 . '</urn1:right>'
                        . '<urn1:right>' . $right2 . '</urn1:right>'
                    . '</urn1:DiscoverRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
