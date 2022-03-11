<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DateTest;
use Zimbra\Enum\DateComparison;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DateTest.
 */
class DateTestTest extends ZimbraTestCase
{
    public function testDateTest()
    {
        $index = mt_rand(1, 99);
        $date = time();

        $test = new DateTest(
            $index, TRUE, DateComparison::AFTER(), $date
        );
        $this->assertEquals(DateComparison::AFTER(), $test->getDateComparison());
        $this->assertSame($date, $test->getDate());

        $test = new DateTest($index, TRUE);
        $test->setDateComparison(DateComparison::BEFORE())
            ->setDate($date);
        $this->assertEquals(DateComparison::BEFORE(), $test->getDateComparison());
        $this->assertSame($date, $test->getDate());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" dateComparison="before" date="$date" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, DateTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'dateComparison' => 'before',
            'date' => $date,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, DateTest::class, 'json'));
    }
}
