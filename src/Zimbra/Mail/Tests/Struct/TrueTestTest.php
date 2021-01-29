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
        $index = $this->faker->numberBetween(1, 99);

        $test = new TrueTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<trueTest index="$index" negative="true" />
EOT;
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
