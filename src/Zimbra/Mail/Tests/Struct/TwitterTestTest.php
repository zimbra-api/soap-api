<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\TwitterTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for TwitterTest.
 */
class TwitterTestTest extends ZimbraStructTestCase
{
    public function testTwitterTest()
    {
        $index = mt_rand(1, 99);

        $test = new TwitterTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<twitterTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, TwitterTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, TwitterTest::class, 'json'));
    }
}
