<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\RedirectAction;

/**
 * Testcase class for RedirectAction.
 */
class RedirectActionTest extends ZimbraMailTestCase
{
    public function testRedirectAction()
    {
        $index = mt_rand(1, 10);
        $a = $this->faker->word;

        $actionRedirect = new RedirectAction(
            $index, $a
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionRedirect);
        $this->assertSame($a, $actionRedirect->getAddress());

        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction(
            $index
        );
        $actionRedirect->setAddress($a);
        $this->assertSame($a, $actionRedirect->getAddress());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<actionRedirect index="' . $index . '" a="' . $a . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionRedirect);

        $array = array(
            'actionRedirect' => array(
                'index' => $index,
                'a' => $a,
            ),
        );
        $this->assertEquals($array, $actionRedirect->toArray());
    }
}
