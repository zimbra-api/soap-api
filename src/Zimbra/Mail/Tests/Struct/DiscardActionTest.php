<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\DiscardAction;

/**
 * Testcase class for DiscardAction.
 */
class DiscardActionTest extends ZimbraMailTestCase
{
    public function testDiscardAction()
    {
        $index = mt_rand(1, 10);
        $actionDiscard = new DiscardAction(
            $index
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionDiscard);

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionDiscard index="' . $index . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionDiscard);

        $array = array(
            'actionDiscard' => array(
                'index' => $index,
            ),
        );
        $this->assertEquals($array, $actionDiscard->toArray());
    }
}
