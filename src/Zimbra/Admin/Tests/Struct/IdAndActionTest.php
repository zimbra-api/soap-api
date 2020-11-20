<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\IdAndAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for IdAndAction.
 */
class IdAndActionTest extends ZimbraStructTestCase
{
    public function testIdAndAction()
    {
        $id = $this->faker->word;
        $action = $this->faker->randomElement(['bug72174', 'wiki', 'contactGroup']);

        $ia = new IdAndAction($id, $action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $ia = new IdAndAction('', '');
        $ia->setId($id)
           ->setAction($action);
        $this->assertSame($id, $ia->getId());
        $this->assertSame($action, $ia->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ia id="' . $id . '" action="' . $action . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ia, 'xml'));
        $this->assertEquals($ia, $this->serializer->deserialize($xml, IdAndAction::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'action' => $action,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($ia, 'json'));
        $this->assertEquals($ia, $this->serializer->deserialize($json, IdAndAction::class, 'json'));
    }
}
