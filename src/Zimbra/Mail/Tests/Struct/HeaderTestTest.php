<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\HeaderTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for HeaderTest.
 */
class HeaderTestTest extends ZimbraStructTestCase
{
    public function testHeaderTest()
    {
        $index = mt_rand(1, 99);
        $headers = $this->faker->word;
        $stringComparison = $this->faker->word;
        $value = $this->faker->word;
        $valueComparison = $this->faker->word;
        $countComparison = $this->faker->word;
        $valueComparisonComparator = $this->faker->word;

        $test = new HeaderTest(
            $index, TRUE, $headers, $stringComparison, $valueComparison, $countComparison, $valueComparisonComparator, $value, FALSE
        );
        $this->assertSame($headers, $test->getHeaders());
        $this->assertSame($stringComparison, $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertSame($valueComparison, $test->getValueComparison());
        $this->assertSame($countComparison, $test->getCountComparison());
        $this->assertSame($valueComparisonComparator, $test->getValueComparisonComparator());

        $test = new HeaderTest($index, TRUE);
        $test->setHeaders($headers)
            ->setStringComparison($stringComparison)
            ->setCaseSensitive(TRUE)
            ->setValue($value)
            ->setValueComparison($valueComparison)
            ->setCountComparison($countComparison)
            ->setValueComparisonComparator($valueComparisonComparator);
        $this->assertSame($headers, $test->getHeaders());
        $this->assertSame($stringComparison, $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertSame($valueComparison, $test->getValueComparison());
        $this->assertSame($countComparison, $test->getCountComparison());
        $this->assertSame($valueComparisonComparator, $test->getValueComparisonComparator());

        $xml = <<<EOT
<?xml version="1.0"?>
<headerTest index="$index" negative="true" header="$headers" stringComparison="$stringComparison" valueComparison="$valueComparison" countComparison="$countComparison" valueComparisonComparator="$valueComparisonComparator" value="$value" caseSensitive="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, HeaderTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $headers,
            'stringComparison' => $stringComparison,
            'valueComparison' => $valueComparison,
            'countComparison' => $countComparison,
            'valueComparisonComparator' => $valueComparisonComparator,
            'value' => $value,
            'caseSensitive' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, HeaderTest::class, 'json'));
    }
}
