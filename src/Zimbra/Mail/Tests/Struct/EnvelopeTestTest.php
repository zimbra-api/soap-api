<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Mail\Struct\EnvelopeTest;
use Zimbra\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EnvelopeTest.
 */
class EnvelopeTestTest extends ZimbraStructTestCase
{
    public function testEnvelopeTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;
        $part = $this->faker->word;
        $value = $this->faker->word;

        $test = new EnvelopeTest(
            $index, TRUE, $header, AddressPart::DOMAIN(), StringComparison::CONTAINS(), TRUE, $value, ValueComparison::EQUAL(), CountComparison::EQUAL(), ComparisonComparator::ASCII_NUMERIC()
        );
        $this->assertTrue($test instanceof AddressTest);

        $xml = <<<EOT
<?xml version="1.0"?>
<envelopeTest index="$index" negative="true" header="$header" part="domain" stringComparison="contains" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;ascii-numeric" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, EnvelopeTest::class, 'xml'));

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
        $this->assertEquals($test, $this->serializer->deserialize($json, EnvelopeTest::class, 'json'));
    }
}
