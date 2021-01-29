<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\SocialcastTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for SocialcastTest.
 */
class SocialcastTestTest extends ZimbraStructTestCase
{
    public function testSocialcastTest()
    {
        $index = $this->faker->numberBetween(1, 99);

        $test = new SocialcastTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<socialcastTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, SocialcastTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, SocialcastTest::class, 'json'));
    }
}
