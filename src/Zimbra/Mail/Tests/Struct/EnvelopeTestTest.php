<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Mail\Struct\EnvelopeTest;
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
        $comparison = $this->faker->word;
        $value = $this->faker->word;
        $valueComparison = $this->faker->word;
        $countComparison = $this->faker->word;
        $valueComparisonComparator = $this->faker->word;

        $test = new EnvelopeTest(
            $index, TRUE, $header, $part, $comparison, TRUE, $value, $valueComparison, $countComparison, $valueComparisonComparator
        );
        $this->assertTrue($test instanceof AddressTest);

        $xml = <<<EOT
<?xml version="1.0"?>
<envelopeTest index="$index" negative="true" header="$header" part="$part" stringComparison="$comparison" caseSensitive="true" value="$value" valueComparison="$valueComparison" countComparison="$countComparison" valueComparisonComparator="$valueComparisonComparator" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, EnvelopeTest::class, 'xml'));

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
        $this->assertEquals($test, $this->serializer->deserialize($json, EnvelopeTest::class, 'json'));
    }
}
