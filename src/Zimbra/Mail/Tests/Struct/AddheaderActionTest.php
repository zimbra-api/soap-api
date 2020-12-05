<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\AddheaderAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for AddheaderAction.
 */
class AddheaderActionTest extends ZimbraStructTestCase
{
    public function testAddheaderAction()
    {
        $index = mt_rand(1, 99);
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;

        $action = new AddheaderAction($index, $headerName, $headerValue, FALSE);
        $this->assertSame($headerName, $action->getHeaderName());
        $this->assertSame($headerValue, $action->getHeaderValue());
        $this->assertFalse($action->getLast());

        $action = new AddheaderAction($index);
        $action->setHeaderName($headerName)
            ->setHeaderValue($headerValue)
            ->setLast(TRUE);
        $this->assertSame($headerName, $action->getHeaderName());
        $this->assertSame($headerValue, $action->getHeaderValue());
        $this->assertTrue($action->getLast());

        $xml = <<<EOT
<?xml version="1.0"?>
<actionAddheader index="$index" last="true">
    <headerName>$headerName</headerName>
    <headerValue>$headerValue</headerValue>
</actionAddheader>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, AddheaderAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'headerName' => [
                '_content' => $headerName,
            ],
            'headerValue' => [
                '_content' => $headerValue,
            ],
            'last' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, AddheaderAction::class, 'json'));
    }
}
