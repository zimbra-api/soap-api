<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\IdAndAction;

/**
 * Testcase class for IdAndAction.
 */
class IdAndActionTest extends ZimbraAdminTestCase
{
    public function testIdAndAction()
    {
        $id = $this->faker->word;
        $action = $this->faker->randomElement(['bug72174', 'wiki', 'contactGroup']);

        $ia = new IdAndAction($id, $action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $ia->setId($id)
           ->setAction($action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ia id="' . $id . '" action="' . $action . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ia);

        $array = [
            'ia' => [
                'id' => $id,
                'action' => $action,
            ],
        ];
        $this->assertEquals($array, $ia->toArray());
    }
}
