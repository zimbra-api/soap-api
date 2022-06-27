<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RedirectAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RedirectAction.
 */
class RedirectActionTest extends ZimbraTestCase
{
    public function testRedirectAction()
    {
        $index = mt_rand(1, 99);
        $address = $this->faker->word;

        $action = new RedirectAction($index, $address, FALSE);
        $this->assertSame($address, $action->getAddress());
        $this->assertFalse($action->isCopy());

        $action = new RedirectAction($index);
        $action->setAddress($address)
            ->setCopy(TRUE);
        $this->assertSame($address, $action->getAddress());
        $this->assertTrue($action->isCopy());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" a="$address" copy="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RedirectAction::class, 'xml'));
    }
}
