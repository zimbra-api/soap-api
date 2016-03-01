<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\CurrentDayOfWeekTest;

/**
 * Testcase class for CurrentDayOfWeekTest.
 */
class CurrentDayOfWeekTestTest extends ZimbraMailTestCase
{
    public function testCurrentDayOfWeekTest()
    {
        $index = mt_rand(1, 10);
        $value = $this->faker->word;

        $currentDayOfWeekTest = new CurrentDayOfWeekTest(
            $index, $value, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $currentDayOfWeekTest);
        $this->assertSame($value, $currentDayOfWeekTest->getValues());
        $currentDayOfWeekTest->setValues($value);
        $this->assertSame($value, $currentDayOfWeekTest->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<currentDayOfWeekTest index="' . $index . '" negative="true" value="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $currentDayOfWeekTest);

        $array = array(
            'currentDayOfWeekTest' => array(
                'index' => $index,
                'negative' => true,
                'value' => $value,
            ),
        );
        $this->assertEquals($array, $currentDayOfWeekTest->toArray());
    }
}
