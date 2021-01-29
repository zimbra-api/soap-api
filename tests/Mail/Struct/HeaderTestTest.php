<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\HeaderTest;
use Zimbra\Enum\{ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HeaderTest.
 */
class HeaderTestTest extends ZimbraTestCase
{
    public function testHeaderTest()
    {
        $index = mt_rand(1, 99);
        $headers = $this->faker->word;
        $value = $this->faker->word;

        $test = new HeaderTest(
            $index, TRUE, $headers, StringComparison::IS(), ValueComparison::NOT_EQUAL(), CountComparison::NOT_EQUAL(), ComparisonComparator::OCTET(), $value, FALSE
        );
        $this->assertSame($headers, $test->getHeaders());
        $this->assertEquals(StringComparison::IS(), $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertEquals(ValueComparison::NOT_EQUAL(), $test->getValueComparison());
        $this->assertEquals(CountComparison::NOT_EQUAL(), $test->getCountComparison());
        $this->assertEquals(ComparisonComparator::OCTET(), $test->getValueComparisonComparator());

        $test = new HeaderTest($index, TRUE);
        $test->setHeaders($headers)
            ->setStringComparison(StringComparison::CONTAINS())
            ->setCaseSensitive(TRUE)
            ->setValue($value)
            ->setValueComparison(ValueComparison::EQUAL())
            ->setCountComparison(CountComparison::EQUAL())
            ->setValueComparisonComparator(ComparisonComparator::ASCII_NUMERIC());
        $this->assertSame($headers, $test->getHeaders());
        $this->assertEquals(StringComparison::CONTAINS(), $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertEquals(ValueComparison::EQUAL(), $test->getValueComparison());
        $this->assertEquals(CountComparison::EQUAL(), $test->getCountComparison());
        $this->assertEquals(ComparisonComparator::ASCII_NUMERIC(), $test->getValueComparisonComparator());

        $xml = <<<EOT
<?xml version="1.0"?>
<headerTest index="$index" negative="true" header="$headers" stringComparison="contains" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;ascii-numeric" value="$value" caseSensitive="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, HeaderTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $headers,
            'stringComparison' => 'contains',
            'valueComparison' => 'eq',
            'countComparison' => 'eq',
            'valueComparisonComparator' => 'i;ascii-numeric',
            'value' => $value,
            'caseSensitive' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, HeaderTest::class, 'json'));
    }
}
