<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FilterTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FilterTest.
 */
class FilterTestTest extends ZimbraStructTestCase
{
    public function testFilterTest()
    {
        $index = mt_rand(1, 99);

        $test = new FilterTest($index, FALSE);
        $this->assertSame($index, $test->getIndex());
        $this->assertFalse($test->isNegative());

        $test = new FilterTest();
        $test->setIndex($index)
            ->setNegative(TRUE);
        $this->assertSame($index, $test->getIndex());
        $this->assertTrue($test->isNegative());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<test index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, FilterTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, FilterTest::class, 'json'));
    }
}
