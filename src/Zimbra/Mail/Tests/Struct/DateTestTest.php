<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DateTest;

/**
 * Testcase class for DateTest.
 */
class DateTestTest extends ZimbraMailTestCase
{
    public function testDateTest()
    {
        $index = mt_rand(1, 10);
        $dateComparison = $this->faker->word;
        $date = mt_rand(1, 10);

        $dateTest = new DateTest(
            $index, $dateComparison, $date, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $dateTest);
        $this->assertSame($dateComparison, $dateTest->getDateComparison());
        $this->assertSame($date, $dateTest->getDate());

        $dateTest->setDateComparison($dateComparison)
                 ->setDate($date);
        $this->assertSame($dateComparison, $dateTest->getDateComparison());
        $this->assertSame($date, $dateTest->getDate());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<dateTest index="' . $index . '" negative="true" dateComparison="' . $dateComparison . '" d="' . $date . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dateTest);

        $array = array(
            'dateTest' => array(
                'index' => $index,
                'negative' => true,
                'dateComparison' => $dateComparison,
                'd' => $date,
            ),
        );
        $this->assertEquals($array, $dateTest->toArray());
    }
}
