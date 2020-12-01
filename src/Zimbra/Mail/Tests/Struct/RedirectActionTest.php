<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\RedirectAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RedirectAction.
 */
class RedirectActionTest extends ZimbraStructTestCase
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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<actionRedirect index="' . $index . '" a="' . $address . '" copy="true" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RedirectAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'a' => $address,
            'copy' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, RedirectAction::class, 'json'));
    }
}
