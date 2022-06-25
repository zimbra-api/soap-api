<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\AddressTest;
use Zimbra\Mail\Struct\EnvelopeTest;
use Zimbra\Common\Enum\{AddressPart, ComparisonComparator, CountComparison, StringComparison, ValueComparison};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EnvelopeTest.
 */
class EnvelopeTestTest extends ZimbraTestCase
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
<result index="$index" negative="true" header="$header" part="domain" stringComparison="contains" caseSensitive="true" value="$value" valueComparison="eq" countComparison="eq" valueComparisonComparator="i;ascii-numeric" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, EnvelopeTest::class, 'xml'));
    }
}
