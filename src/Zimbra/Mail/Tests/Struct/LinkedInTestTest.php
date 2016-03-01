<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\LinkedInTest;

/**
 * Testcase class for LinkedInTest.
 */
class LinkedInTestTest extends ZimbraMailTestCase
{
    public function testLinkedInTest()
    {
        $index = mt_rand(1, 10);
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $linkedinTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<linkedinTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $linkedinTest);

        $array = array(
            'linkedinTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $linkedinTest->toArray());
    }
}
