<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MeTest;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for MeTest.
 */
class MeTestTest extends ZimbraStructTestCase
{
    public function testMeTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;

        $test = new MeTest(
            $index, TRUE, $header
        );
        $this->assertSame($header, $test->getHeader());

        $test = new MeTest($index, TRUE);
        $test->setHeader($header);
        $this->assertSame($header, $test->getHeader());

        $xml = <<<EOT
<?xml version="1.0"?>
<meTest index="$index" negative="true" header="$header" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, MeTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, MeTest::class, 'json'));
    }
}
