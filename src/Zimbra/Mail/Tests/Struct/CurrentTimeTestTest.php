<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CurrentTimeTest;

/**
 * Testcase class for CurrentTimeTest.
 */
class CurrentTimeTestTest extends ZimbraMailTestCase
{
    public function testCurrentTimeTest()
    {
        $index = mt_rand(1, 10);
        $comparison = $this->faker->word;
        $time = $this->faker->word;

        $currentTimeTest = new CurrentTimeTest(
            $index, $comparison, $time, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $currentTimeTest);
        $this->assertSame($comparison, $currentTimeTest->getDateComparison());
        $this->assertSame($time, $currentTimeTest->getTime());

        $currentTimeTest->setDateComparison($comparison)
                        ->setTime($time);
        $this->assertSame($comparison, $currentTimeTest->getDateComparison());
        $this->assertSame($time, $currentTimeTest->getTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<currentTimeTest index="' . $index . '" negative="true" dateComparison="' . $comparison . '" time="' . $time . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $currentTimeTest);

        $array = array(
            'currentTimeTest' => array(
                'index' => $index,
                'negative' => true,
                'dateComparison' => $comparison,
                'time' => $time,
            ),
        );
        $this->assertEquals($array, $currentTimeTest->toArray());
    }
}
