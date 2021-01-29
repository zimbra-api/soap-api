<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Tests\Struct\ZimbraStructTestCase;

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
        $value = $this->faker->word;

        $test = new AddressTest(
            $index, TRUE, $header, AddressPart::ALL(), StringComparison::IS(), FALSE, $value, ValueComparison::NOT_EQUAL(), CountComparison::NOT_EQUAL(), ComparisonComparator::OCTET()
        );
        $this->assertSame($header, $test->getHeader());
        $this->assertEquals(AddressPart::ALL(), $test->getPart());
        $this->assertEquals(StringComparison::IS(), $test->getStringComparison());
        $this->assertFalse($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertEquals(ValueComparison::NOT_EQUAL(), $test->getValueComparison());
        $this->assertEquals(CountComparison::NOT_EQUAL(), $test->getCountComparison());
        $this->assertEquals(ComparisonComparator::OCTET(), $test->getValueComparisonComparator());

        $test = new AddressTest($index, TRUE);
        $test->setHeader($header)
            ->setPart(AddressPart::DOMAIN())
            ->setStringComparison(StringComparison::CONTAINS())
            ->setCaseSensitive(TRUE)
            ->setValue($value)
            ->setValueComparison(ValueComparison::EQUAL())
            ->setCountComparison(CountComparison::EQUAL())
            ->setValueComparisonComparator(ComparisonComparator::ASCII_NUMERIC());
        $this->assertSame($header, $test->getHeader());
        $this->assertEquals(AddressPart::DOMAIN(), $test->getPart());
        $this->assertEquals(StringComparison::CONTAINS(), $test->getStringComparison());
        $this->assertTrue($test->isCaseSensitive());
        $this->assertSame($value, $test->getValue());
        $this->assertEquals(ValueComparison::EQUAL(), $test->getValueComparison());
        $this->assertEquals(CountComparison::EQUAL(), $test->getCountComparison());
        $this->assertEquals(ComparisonComparator::ASCII_NUMERIC(), $test->getValueComparisonComparator());

        $xml = <<<EOT
<?xml version="1.0"?>
<addressTest index="$index" negative="true" header="$header" part="domain" stringComparison="contains" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;ascii-numeric" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, AddressTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
            'part' => 'domain',
            'stringComparison' => 'contains',
            'caseSensitive' => TRUE,
            'value' => $value,
            'valueComparison' => 'eq',
            'countComparison' => 'eq',
            'valueComparisonComparator' => 'i;ascii-numeric',
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, AddressTest::class, 'json'));
    }
}
