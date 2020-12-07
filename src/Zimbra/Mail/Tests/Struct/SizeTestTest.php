<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\SizeTest;
use Zimbra\Enum\NumberComparison;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SizeTest.
 */
class SizeTestTest extends ZimbraStructTestCase
{
    public function testSizeTest()
    {
        $index = mt_rand(1, 99);
        $size = $this->faker->word;

        $test = new SizeTest(
            $index, TRUE, NumberComparison::UNDER(), $size
        );
        $this->assertEquals(NumberComparison::UNDER(), $test->getNumberComparison());
        $this->assertSame($size, $test->getSize());

        $test = new SizeTest($index, TRUE);
        $test->setNumberComparison(NumberComparison::OVER())
            ->setSize($size);
        $this->assertEquals(NumberComparison::OVER(), $test->getNumberComparison());
        $this->assertSame($size, $test->getSize());

        $xml = <<<EOT
<?xml version="1.0"?>
<sizeTest index="$index" negative="true" numberComparison="over" s="$size" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, SizeTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'numberComparison' => 'over',
            's' => $size,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, SizeTest::class, 'json'));
    }
}
