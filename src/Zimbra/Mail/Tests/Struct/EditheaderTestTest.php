<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\EditheaderTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for EditheaderTest.
 */
class EditheaderTestTest extends ZimbraStructTestCase
{
    public function testEditheaderTest()
    {
        $matchType = $this->faker->word;
        $relationalComparator = $this->faker->word;
        $comparator = $this->faker->word;
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;

        $test = new EditheaderTest($matchType, FALSE, FALSE, $relationalComparator, $comparator, $headerName, [$headerValue]);
        $this->assertSame($matchType, $test->getMatchType());
        $this->assertFalse($test->getCount());
        $this->assertFalse($test->getValue());
        $this->assertSame($relationalComparator, $test->getRelationalComparator());
        $this->assertSame($comparator, $test->getComparator());
        $this->assertSame($headerName, $test->getHeaderName());
        $this->assertSame([$headerValue], $test->getHeaderValue());

        $test = new EditheaderTest();
        $test->setMatchType($matchType)
            ->setCount(TRUE)
            ->setValue(TRUE)
            ->setRelationalComparator($relationalComparator)
            ->setComparator($comparator)
            ->setHeaderName($headerName)
            ->setHeaderValue([$headerValue]);
        $this->assertSame($matchType, $test->getMatchType());
        $this->assertTrue($test->getCount());
        $this->assertTrue($test->getValue());
        $this->assertSame($relationalComparator, $test->getRelationalComparator());
        $this->assertSame($comparator, $test->getComparator());
        $this->assertSame($headerName, $test->getHeaderName());
        $this->assertSame([$headerValue], $test->getHeaderValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<test matchType="' . $matchType . '" countComparator="true" valueComparator="true" relationalComparator="' . $relationalComparator . '" comparator="' . $comparator . '">'
                . '<headerName>' . $headerName . '</headerName>'
                . '<headerValue>' . $headerValue . '</headerValue>'
            . '</test>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, EditheaderTest::class, 'xml'));

        $json = json_encode([
            'matchType' => $matchType,
            'countComparator' => TRUE,
            'valueComparator' => TRUE,
            'relationalComparator' => $relationalComparator,
            'comparator' => $comparator,
            'headerName' => [
                '_content' => $headerName,
            ],
            'headerValue' => [
                [
                    '_content' => $headerValue,
                ]
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, EditheaderTest::class, 'json'));
    }
}
