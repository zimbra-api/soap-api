<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\StopAction;

/**
 * Testcase class for StopAction.
 */
class StopActionTest extends ZimbraMailTestCase
{
    public function testStopAction()
    {
        $index = mt_rand(1, 10);
        $actionStop = new StopAction(
            $index
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionStop);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionStop index="' . $index . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionStop);

        $array = array(
            'actionStop' => array(
                'index' => $index,
            ),
        );
        $this->assertEquals($array, $actionStop->toArray());
    }
}
