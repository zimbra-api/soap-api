<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\SocialcastTest;

/**
 * Testcase class for SocialcastTest.
 */
class SocialcastTestTest extends ZimbraMailTestCase
{
    public function testSocialcastTest()
    {
        $index = mt_rand(1, 10);
        $socialcastTest = new SocialcastTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $socialcastTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<socialcastTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $socialcastTest);

        $array = array(
            'socialcastTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $socialcastTest->toArray());
    }
}
