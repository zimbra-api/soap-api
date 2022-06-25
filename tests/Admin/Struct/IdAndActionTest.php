<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\IdAndAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for IdAndAction.
 */
class IdAndActionTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" action="$action" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($ia, 'xml'));
        $this->assertEquals($ia, $this->serializer->deserialize($xml, IdAndAction::class, 'xml'));
    }
}
