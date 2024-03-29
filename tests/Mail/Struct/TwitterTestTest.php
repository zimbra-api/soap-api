<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\TwitterTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TwitterTest.
 */
class TwitterTestTest extends ZimbraTestCase
{
    public function testTwitterTest()
    {
        $index = $this->faker->numberBetween(1, 99);

        $test = new TwitterTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, TwitterTest::class, 'xml'));
    }
}
