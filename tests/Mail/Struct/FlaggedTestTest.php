<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FlaggedTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FlaggedTest.
 */
class FlaggedTestTest extends ZimbraTestCase
{
    public function testFlaggedTest()
    {
        $index = mt_rand(1, 99);
        $flag = $this->faker->word;

        $test = new FlaggedTest(
            $index, TRUE, $flag
        );
        $this->assertSame($flag, $test->getFlag());

        $test = new FlaggedTest($index, TRUE);
        $test->setFlag($flag);
        $this->assertSame($flag, $test->getFlag());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" negative="true" flagName="$flag" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, FlaggedTest::class, 'xml'));
    }
}
