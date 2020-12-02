<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddressTest.
 */
class AddressTestTest extends ZimbraStructTestCase
{
    public function testAddressTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;
        $part = $this->faker->word;
        $comparison = $this->faker->word;
        $value = $this->faker->word;
        $valueComparison = $this->faker->word;
        $countComparison = $this->faker->word;
        $valueComparisonComparator = $this->faker->word;

        $test = new AddressTest(
            $index, TRUE, $header, $part, $comparison, FALSE, $value, $valueComparison, $countComparison, $valueComparisonComparator
        );
        $this->assertSame($header, $test->getHeader());
        $this->assertSame($part, $test->getPart());
        $this->assertSame($comparison, $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertSame($valueComparison, $test->getValueComparison());
        $this->assertSame($countComparison, $test->getCountComparison());
        $this->assertSame($valueComparisonComparator, $test->getValueComparisonComparator());

        $test = new AddressTest($index, TRUE);
        $test->setHeader($header)
            ->setPart($part)
            ->setStringComparison($comparison)
            ->setCaseSensitive(TRUE)
            ->setValue($value)
            ->setValueComparison($valueComparison)
            ->setCountComparison($countComparison)
            ->setValueComparisonComparator($valueComparisonComparator);
        $this->assertSame($header, $test->getHeader());
        $this->assertSame($part, $test->getPart());
        $this->assertSame($comparison, $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertSame($valueComparison, $test->getValueComparison());
        $this->assertSame($countComparison, $test->getCountComparison());
        $this->assertSame($valueComparisonComparator, $test->getValueComparisonComparator());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<addressTest index="' . $index . '" negative="true" header="' . $header . '" part="' . $part . '" stringComparison="' . $comparison . '" caseSensitive="true" value="' . $value . '" valueComparison="' . $valueComparison . '" countComparison="' . $countComparison . '" valueComparisonComparator="' . $valueComparisonComparator . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, AddressTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
            'part' => $part,
            'stringComparison' => $comparison,
            'caseSensitive' => TRUE,
            'value' => $value,
            'valueComparison' => $valueComparison,
            'countComparison' => $countComparison,
            'valueComparisonComparator' => $valueComparisonComparator,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, AddressTest::class, 'json'));
    }
}
