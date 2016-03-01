<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\FlagAction;

/**
 * Testcase class for FlagAction.
 */
class FlagActionTest extends ZimbraMailTestCase
{
    public function testFlagAction()
    {
        $index = mt_rand(1, 10);
        $flag = $this->faker->word;
        $actionFlag = new FlagAction(
            $index, $flag
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionFlag);
        $this->assertSame($flag, $actionFlag->getFlag());
        $actionFlag->setFlag($flag);
        $this->assertSame($flag, $actionFlag->getFlag());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionFlag index="' . $index . '" flagName="' . $flag . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFlag);

        $array = array(
            'actionFlag' => array(
                'index' => $index,
                'flagName' => $flag,
            ),
        );
        $this->assertEquals($array, $actionFlag->toArray());
    }
}
