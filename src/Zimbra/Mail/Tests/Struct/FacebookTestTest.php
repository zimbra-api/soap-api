<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FacebookTest;

/**
 * Testcase class for FacebookTest.
 */
class FacebookTestTest extends ZimbraMailTestCase
{
    public function testFacebookTest()
    {
        $index = mt_rand(1, 10);
        $facebookTest = new FacebookTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $facebookTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<facebookTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $facebookTest);

        $array = array(
            'facebookTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $facebookTest->toArray());
    }
}
