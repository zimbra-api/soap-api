<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FacebookTest;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

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

        $xml = <<<EOT
<?xml version="1.0"?>
<facebookTest index="$index" negative="true" />
EOT;
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
