<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\DateTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DateTest.
 */
class DateTestTest extends ZimbraStructTestCase
{
    public function testDateTest()
    {
        $index = mt_rand(1, 99);
        $dateComparison = $this->faker->word;
        $date = time();

        $test = new DateTest(
            $index, TRUE, $dateComparison, $date
        );
        $this->assertSame($dateComparison, $test->getDateComparison());
        $this->assertSame($date, $test->getDate());

        $test = new DateTest($index, TRUE);
        $test->setDateComparison($dateComparison)
            ->setDate($date);
        $this->assertSame($dateComparison, $test->getDateComparison());
        $this->assertSame($date, $test->getDate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<dateTest index="' . $index . '" negative="true" dateComparison="' . $dateComparison . '" date="' . $date . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, DateTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'dateComparison' => $dateComparison,
            'date' => $date,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, DateTest::class, 'json'));
    }
}
