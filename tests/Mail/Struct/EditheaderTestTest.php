<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Common\Enum\{ComparisonComparator, MatchType, RelationalComparator};
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for EditheaderTest.
 */
class EditheaderTestTest extends ZimbraTestCase
{
    public function testEditheaderTest()
    {
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;

        $test = new StubEditheaderTest(
            MatchType::IS, FALSE, FALSE, RelationalComparator::NOT_EQUAL, ComparisonComparator::OCTET, $headerName, [$headerValue]
        );
        $this->assertEquals(MatchType::IS, $test->getMatchType());
        $this->assertFalse($test->getCount());
        $this->assertFalse($test->getValue());
        $this->assertEquals(RelationalComparator::NOT_EQUAL, $test->getRelationalComparator());
        $this->assertEquals(ComparisonComparator::OCTET, $test->getComparator());
        $this->assertSame($headerName, $test->getHeaderName());
        $this->assertSame([$headerValue], $test->getHeaderValue());

        $test = new StubEditheaderTest();
        $test->setMatchType(MatchType::CONTAINS)
            ->setCount(TRUE)
            ->setValue(TRUE)
            ->setRelationalComparator(RelationalComparator::EQUAL)
            ->setComparator(ComparisonComparator::ASCII_NUMERIC)
            ->setHeaderName($headerName)
            ->setHeaderValue([$headerValue]);
        $this->assertEquals(MatchType::CONTAINS, $test->getMatchType());
        $this->assertTrue($test->getCount());
        $this->assertTrue($test->getValue());
        $this->assertEquals(RelationalComparator::EQUAL, $test->getRelationalComparator());
        $this->assertEquals(ComparisonComparator::ASCII_NUMERIC, $test->getComparator());
        $this->assertSame($headerName, $test->getHeaderName());
        $this->assertSame([$headerValue], $test->getHeaderValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result matchType="contains" countComparator="true" valueComparator="true" relationalComparator="eq" comparator="i;ascii-numeric" xmlns:urn="urn:zimbraMail">
    <urn:headerName>$headerName</urn:headerName>
    <urn:headerValue>$headerValue</urn:headerValue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, StubEditheaderTest::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubEditheaderTest extends EditheaderTest
{
}
