<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FacebookTest;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FacebookTest.
 */
class FacebookTestTest extends ZimbraStructTestCase
{
    public function testFacebookTest()
    {
        $index = mt_rand(1, 99);

        $test = new FacebookTest(
            $index, TRUE
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<facebookTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($test, 'xml'));
        $this->assertEquals($test, $this->serializer->deserialize($xml, FacebookTest::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'negative' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($test, 'json'));
        $this->assertEquals($test, $this->serializer->deserialize($json, FacebookTest::class, 'json'));
    }
}
