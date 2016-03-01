<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\TwitterTest;

/**
 * Testcase class for TwitterTest.
 */
class TwitterTestTest extends ZimbraMailTestCase
{
    public function testTwitterTest()
    {
        $index = mt_rand(1, 10);
        $twitterTest = new TwitterTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $twitterTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<twitterTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $twitterTest);

        $array = array(
            'twitterTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $twitterTest->toArray());
    }
}
