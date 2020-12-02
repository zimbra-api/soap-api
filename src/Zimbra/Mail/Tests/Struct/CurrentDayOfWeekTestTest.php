<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\CurrentDayOfWeekTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CurrentDayOfWeekTest.
 */
class CurrentDayOfWeekTestTest extends ZimbraStructTestCase
{
    public function testCurrentDayOfWeekTest()
    {
        $index = mt_rand(1, 99);
        $values = $this->faker->word;

        $test = new CurrentDayOfWeekTest(
            $index, TRUE, $values
        );
        $this->assertSame($values, $test->getValues());

        $test = new CurrentDayOfWeekTest($index, TRUE);
        $test->setValues($values);
        $this->assertSame($values, $test->getValues());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<currentDayOfWeekTest index="' . $index . '" negative="true" value="' . $values . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CurrentDayOfWeekTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'value' => $values,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, CurrentDayOfWeekTest::class, 'json'));
    }
}
