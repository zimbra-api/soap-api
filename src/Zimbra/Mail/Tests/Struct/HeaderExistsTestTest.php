<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\HeaderExistsTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for HeaderExistsTest.
 */
class HeaderExistsTestTest extends ZimbraStructTestCase
{
    public function testHeaderExistsTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;

        $test = new HeaderExistsTest(
            $index, TRUE, $header
        );
        $this->assertSame($header, $test->getHeader());

        $test = new HeaderExistsTest($index, TRUE);
        $test->setHeader($header);
        $this->assertSame($header, $test->getHeader());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<headerExistsTest index="' . $index . '" negative="true" header="' . $header . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, HeaderExistsTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, HeaderExistsTest::class, 'json'));
    }
}
