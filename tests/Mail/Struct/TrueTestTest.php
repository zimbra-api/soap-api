<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\TrueTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for TrueTest.
 */
class TrueTestTest extends ZimbraTestCase
{
    public function testTrueTest()
    {
        $index = $this->faker->numberBetween(1, 99);

        $test = new TrueTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, TrueTest::class, 'xml'));
    }
}
