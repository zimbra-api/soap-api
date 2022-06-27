<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CurrentDayOfWeekTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CurrentDayOfWeekTest.
 */
class CurrentDayOfWeekTestTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" value="$values" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, CurrentDayOfWeekTest::class, 'xml'));
    }
}
