<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\SocialcastTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SocialcastTest.
 */
class SocialcastTestTest extends ZimbraTestCase
{
    public function testSocialcastTest()
    {
        $index = $this->faker->numberBetween(1, 99);

        $test = new SocialcastTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
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
