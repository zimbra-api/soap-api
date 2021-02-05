<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ListTest;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ListTest.
 */
class ListTestTest extends ZimbraTestCase
{
    public function testListTest()
    {
        $index = mt_rand(1, 99);

        $test = new ListTest(
            $index, TRUE
        );

        $xml = <<<EOT
<?xml version="1.0"?>
<listTest index="$index" negative="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, ListTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, ListTest::class, 'json'));
    }
}