<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FilterAction;

/**
 * Testcase class for FilterAction.
 */
class FilterActionTest extends ZimbraMailTestCase
{
    public function testFilterAction()
    {
        $index = mt_rand(1, 10);
        $actionFilter = new FilterAction(
            $index
        );
        $this->assertSame($index, $actionFilter->getIndex());
        $actionFilter->setIndex($index);
        $this->assertSame($index, $actionFilter->getIndex());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionFilter index="' . $index . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFilter);

        $array = array(
            'actionFilter' => array(
                'index' => $index,
            ),
        );
        $this->assertEquals($array, $actionFilter->toArray());
    }
}
