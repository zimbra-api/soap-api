<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetServerStats;
use Zimbra\Admin\Struct\Stat;

/**
 * Testcase class for GetServerStats.
 */
class GetServerStatsTest extends ZimbraAdminApiTestCase
{
    public function testGetServerStatsRequest()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $stat = new Stat($value, $name, $description);
        $req = new GetServerStats([$stat]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$stat], $req->getStats()->all());
        $req->addStat($stat);
        $this->assertSame([$stat, $stat], $req->getStats()->all());
        $req->getStats()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerStatsRequest>'
                . '<stat name="' . $name . '" description="' . $description . '">' . $value . '</stat>'
            . '</GetServerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'stat' => [
                    [
                        'name' => $name,
                        'description' => $description,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerStatsApi()
    {
        $value = $this->faker->word;
        $name = $this->faker->word;
        $description = $this->faker->word;

        $stat = new Stat($value, $name, $description);

        $this->api->getServerStats([$stat]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerStatsRequest>'
                        . '<urn1:stat name="' . $name . '" description="' . $description . '">' . $value . '</urn1:stat>'
                    . '</urn1:GetServerStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
