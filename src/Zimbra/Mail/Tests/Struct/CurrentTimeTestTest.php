<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\CurrentTimeTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CurrentTimeTest.
 */
class CurrentTimeTestTest extends ZimbraStructTestCase
{
    public function testCurrentTimeTest()
    {
        $index = mt_rand(1, 99);
        $dateComparison = $this->faker->word;
        $time = $this->faker->word;

        $test = new CurrentTimeTest(
            $index, TRUE, $dateComparison, $time
        );
        $this->assertSame($dateComparison, $test->getDateComparison());
        $this->assertSame($time, $test->getTime());

        $test = new CurrentTimeTest($index, TRUE);
        $test->setDateComparison($dateComparison)
            ->setTime($time);
        $this->assertSame($dateComparison, $test->getDateComparison());
        $this->assertSame($time, $test->getTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<currentTimeTest index="$index" negative="true" dateComparison="$dateComparison" time="$time" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CurrentTimeTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'dateComparison' => $dateComparison,
            'time' => $time,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, CurrentTimeTest::class, 'json'));
    }
}
