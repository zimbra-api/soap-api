<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MeTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MeTest.
 */
class MeTestTest extends ZimbraTestCase
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
<result index="$index" negative="true" header="$header" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, MeTest::class, 'xml'));
    }
}
