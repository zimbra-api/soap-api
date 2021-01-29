<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ContactRankingTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactRankingTest.
 */
class ContactRankingTestTest extends ZimbraTestCase
{
    public function testContactRankingTest()
    {
        $index = mt_rand(1, 99);
        $header = $this->faker->word;

        $test = new ContactRankingTest(
            $index, TRUE, $header
        );
        $this->assertSame($header, $test->getHeader());

        $test = new ContactRankingTest($index, TRUE);
        $test->setHeader($header);
        $this->assertSame($header, $test->getHeader());

        $xml = <<<EOT
<?xml version="1.0"?>
<contactRankingTest index="$index" negative="true" header="$header" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ContactRankingTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
            'header' => $header,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, ContactRankingTest::class, 'json'));
    }
}
