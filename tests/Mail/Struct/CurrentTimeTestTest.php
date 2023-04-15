<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CurrentTimeTest;
use Zimbra\Common\Enum\DateComparison;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CurrentTimeTest.
 */
class CurrentTimeTestTest extends ZimbraTestCase
{
    public function testCurrentTimeTest()
    {
        $index = mt_rand(1, 99);
        $time = $this->faker->word;

        $test = new CurrentTimeTest(
            $index, TRUE, DateComparison::AFTER, $time
        );
        $this->assertEquals(DateComparison::AFTER, $test->getDateComparison());
        $this->assertSame($time, $test->getTime());

        $test = new CurrentTimeTest($index, TRUE);
        $test->setDateComparison(DateComparison::BEFORE)
            ->setTime($time);
        $this->assertEquals(DateComparison::BEFORE, $test->getDateComparison());
        $this->assertSame($time, $test->getTime());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" dateComparison="before" time="$time" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CurrentTimeTest::class, 'xml'));
    }
}
