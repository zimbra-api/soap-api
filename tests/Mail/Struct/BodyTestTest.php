<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\BodyTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BodyTest.
 */
class BodyTestTest extends ZimbraTestCase
{
    public function testBodyTest()
    {
        $index = mt_rand(1, 99);
        $value = $this->faker->word;

        $test = new BodyTest(
            $index, TRUE, $value, FALSE
        );
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $test = new BodyTest($index, TRUE);
        $test->setCaseSensitive(TRUE)
            ->setValue($value);
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" value="$value" caseSensitive="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, BodyTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'value' => $value,
            'caseSensitive' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, BodyTest::class, 'json'));
    }
}
