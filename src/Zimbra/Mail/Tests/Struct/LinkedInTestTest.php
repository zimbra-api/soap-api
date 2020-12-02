<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\LinkedInTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for LinkedInTest.
 */
class LinkedInTestTest extends ZimbraStructTestCase
{
    public function testLinkedInTest()
    {
        $index = mt_rand(1, 99);

        $test = new LinkedInTest(
            $index, TRUE
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<linkedInTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, LinkedInTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, LinkedInTest::class, 'json'));
    }
}
