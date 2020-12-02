<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\SizeTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SizeTest.
 */
class SizeTestTest extends ZimbraStructTestCase
{
    public function testSizeTest()
    {
        $index = mt_rand(1, 99);
        $numberComparison = $this->faker->word;
        $size = $this->faker->word;

        $test = new SizeTest(
            $index, TRUE, $numberComparison, $size
        );
        $this->assertSame($numberComparison, $test->getNumberComparison());
        $this->assertSame($size, $test->getSize());

        $test = new SizeTest($index, TRUE);
        $test->setNumberComparison($numberComparison)
            ->setSize($size);
        $this->assertSame($numberComparison, $test->getNumberComparison());
        $this->assertSame($size, $test->getSize());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<sizeTest index="' . $index . '" negative="true" numberComparison="' . $numberComparison . '" s="' . $size . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, SizeTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'numberComparison' => $numberComparison,
            's' => $size,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, SizeTest::class, 'json'));
    }
}
