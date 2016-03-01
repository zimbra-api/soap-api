<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\AttachmentTest;

/**
 * Testcase class for AttachmentTest.
 */
class AttachmentTestTest extends ZimbraMailTestCase
{
    public function testAttachmentTest()
    {
        $index = mt_rand(0, 10);
        $attachmentTest = new AttachmentTest(
            $index, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $attachmentTest);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<attachmentTest index="' . $index . '" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attachmentTest);

        $array = array(
            'attachmentTest' => array(
                'index' => $index,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $attachmentTest->toArray());
    }
}
