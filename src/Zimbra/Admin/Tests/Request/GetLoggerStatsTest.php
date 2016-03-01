<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetLoggerStats;
use Zimbra\Admin\Struct\HostName;
use Zimbra\Admin\Struct\TimeAttr;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for GetLoggerStats.
 */
class GetLoggerStatsTest extends ZimbraAdminApiTestCase
{
    public function testGetLoggerStatsRequest()
    {
        $host = $this->faker->word;
        $time = $this->faker->word;
        $name = $this->faker->word;
        $limit = $this->faker->word;

        $hostname = new HostName($host);
        $startTime = new TimeAttr($time);
        $endTime = new TimeAttr($time);

        $stat = new NamedElement($name);
        $values = new StatsValueWrapper([$stat]);
        $stats = new StatsSpec($values, $name, $limit);

        $req = new GetLoggerStats($hostname, $stats, $startTime, $endTime);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($hostname, $req->getHostName());
        $this->assertSame($stats, $req->getStats());
        $this->assertSame($startTime, $req->getStartTime());
        $this->assertSame($endTime, $req->getEndTime());

        $req->setHostName($hostname)
            ->setStats($stats)
            ->setStartTime($startTime)
            ->setEndTime($endTime);
        $this->assertSame($hostname, $req->getHostName());
        $this->assertSame($stats, $req->getStats());
        $this->assertSame($startTime, $req->getStartTime());
        $this->assertSame($endTime, $req->getEndTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetLoggerStatsRequest>'
                . '<hostname hn="' . $host.  '" />'
                . '<stats name="' . $name.  '" limit="' . $limit.  '">'
                    . '<values>'
                        . '<stat name="' . $name.  '" />'
                    . '</values>'
                . '</stats>'
                . '<startTime time="' . $time.  '" />'
                . '<endTime time="' . $time.  '" />'
            . '</GetLoggerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetLoggerStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'hostname' => [
                    'hn' => $host,
                ],
                'stats' => [
                    'name' => $name,
                    'limit' => $limit,
                    'values' => [
                        'stat' => [
                            [
                                'name' => $name
                            ],
                        ],
                    ],
                ],
                'startTime' => [
                    'time' => $time,
                ],
                'endTime' => [
                    'time' => $time,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLoggerStatsApi()
    {
        $host = $this->faker->word;
        $time = $this->faker->word;
        $name = $this->faker->word;
        $limit = $this->faker->word;

        $hostname = new HostName($host);
        $startTime = new TimeAttr($time);
        $endTime = new TimeAttr($time);

        $stat = new NamedElement($name);
        $values = new StatsValueWrapper([$stat]);
        $stats = new StatsSpec($values, $name, $limit);

        $this->api->getLoggerStats(
            $hostname, $stats, $startTime, $endTime
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetLoggerStatsRequest>'
                        . '<urn1:hostname hn="' . $host . '" />'
                        . '<urn1:stats name="' . $name . '" limit="' . $limit . '">'
                            . '<urn1:values>'
                                . '<urn1:stat name="' . $name . '" />'
                            . '</urn1:values>'
                        . '</urn1:stats>'
                        . '<urn1:startTime time="' . $time . '" />'
                        . '<urn1:endTime time="' . $time . '" />'
                    . '</urn1:GetLoggerStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
