<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\KeepAction;

/**
 * Testcase class for KeepAction.
 */
class KeepActionTest extends ZimbraMailTestCase
{
    public function testKeepAction()
    {
        $index = mt_rand(1, 10);
        $actionKeep = new \Zimbra\Mail\Struct\KeepAction(
            $index
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionKeep);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionKeep index="' . $index . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionKeep);

        $array = array(
            'actionKeep' => array(
                'index' => $index,
            ),
        );
        $this->assertEquals($array, $actionKeep->toArray());
    }
}
