<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Request;

use Zimbra\Admin\Message\GetLoggerStatsBody;
use Zimbra\Admin\Message\GetLoggerStatsEnvelope;
use Zimbra\Admin\Message\GetLoggerStatsRequest;
use Zimbra\Admin\Message\GetLoggerStatsResponse;

use Zimbra\Admin\Struct\HostName;
use Zimbra\Admin\Struct\StatsSpec;
use Zimbra\Admin\Struct\StatsValueWrapper;
use Zimbra\Admin\Struct\TimeAttr;

use Zimbra\Admin\Struct\HostStats;
use Zimbra\Admin\Struct\StatsInfo;
use Zimbra\Admin\Struct\StatsValues;
use Zimbra\Admin\Struct\NameAndValue;

use Zimbra\Struct\NamedElement;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GetLoggerStats.
 */
class GetLoggerStatsTest extends ZimbraTestCase
{
    public function testGetLoggerStats()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $note = $this->faker->word;
        $limit = $this->faker->word;
        $time = $this->faker->iso8601;
        $t = $this->faker->word;

        $hostName = new HostName($name);
        $stats = new StatsSpec(new StatsValueWrapper([new NamedElement($name)]), $name, $limit);
        $startTime = new TimeAttr($time);
        $endTime = new TimeAttr($time);

        $request = new GetLoggerStatsRequest($hostName, $stats, $startTime, $endTime);
        $this->assertSame($hostName, $request->getHostName());
        $this->assertSame($stats, $request->getStats());
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());
        $request = new GetLoggerStatsRequest();
        $request->setHostName($hostName)
            ->setStats($stats)
            ->setStartTime($startTime)
            ->setEndTime($endTime);
        $this->assertSame($hostName, $request->getHostName());
        $this->assertSame($stats, $request->getStats());
        $this->assertSame($startTime, $request->getStartTime());
        $this->assertSame($endTime, $request->getEndTime());

        $hostStats = new HostStats($name, new StatsInfo($name, new StatsValues($t, [new NameAndValue($name, $value)])));

        $response = new GetLoggerStatsResponse([$hostStats], $note);
        $this->assertSame([$hostStats], $response->getHostNames());
        $this->assertSame($note, $response->getNote());
        $response = new GetLoggerStatsResponse([]);
        $response->setHostNames([$hostStats])
            ->addHostName($hostStats)
            ->setNote($note);
        $this->assertSame([$hostStats, $hostStats], $response->getHostNames());
        $this->assertSame($note, $response->getNote());
        $response->setHostNames([$hostStats]);

        $body = new GetLoggerStatsBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new GetLoggerStatsBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new GetLoggerStatsEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new GetLoggerStatsEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:GetLoggerStatsRequest>
            <hostname hn="$name" />
            <stats name="$name" limit="$limit">
                <values>
                    <stat name="$name" />
                </values>
            </stats>
            <startTime time="$time" />
            <endTime time="$time" />
        </urn:GetLoggerStatsRequest>
        <urn:GetLoggerStatsResponse>
            <hostname hn="$name">
                <stats name="$name">
                    <values t="$t">
                        <stat name="$name" value="$value" />
                    </values>
                </stats>
            </hostname>
            <note>$note</note>
        </urn:GetLoggerStatsResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, GetLoggerStatsEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'GetLoggerStatsRequest' => [
                    'hostname' => [
                        'hn' => $name,
                    ],
                    'stats' => [
                        'name' => $name,
                        'limit' => $limit,
                        'values' => [
                            'stat' => [
                                [
                                    'name' => $name,
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
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'GetLoggerStatsResponse' => [
                    'hostname' => [
                        [
                            'hn' => $name,
                            'stats' => [
                                'name' => $name,
                                'values' => [
                                    't' => $t,
                                    'stat' => [
                                        [
                                            'name' => $name,
                                            'value' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'note' => [
                        '_content' => $note,
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, GetLoggerStatsEnvelope::class, 'json'));
    }
}
