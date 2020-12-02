<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\TrueTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TrueTest.
 */
class TrueTestTest extends ZimbraStructTestCase
{
    public function testTrueTest()
    {
        $index = mt_rand(1, 99);

        $test = new TrueTest(
            $index, TRUE
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<trueTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, TrueTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, TrueTest::class, 'json'));
    }
}
