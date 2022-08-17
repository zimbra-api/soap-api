<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\AddheaderAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for AddheaderAction.
 */
class AddheaderActionTest extends ZimbraTestCase
{
    public function testAddheaderAction()
    {
        $index = mt_rand(1, 99);
        $headerName = $this->faker->word;
        $headerValue = $this->faker->word;

        $action = new StubAddheaderAction($index, $headerName, $headerValue, FALSE);
        $this->assertSame($headerName, $action->getHeaderName());
        $this->assertSame($headerValue, $action->getHeaderValue());
        $this->assertFalse($action->getLast());

        $action = new StubAddheaderAction($index);
        $action->setHeaderName($headerName)
            ->setHeaderValue($headerValue)
            ->setLast(TRUE);
        $this->assertSame($headerName, $action->getHeaderName());
        $this->assertSame($headerValue, $action->getHeaderValue());
        $this->assertTrue($action->getLast());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" last="true" xmlns:urn="urn:zimbraMail">
    <urn:headerName>$headerName</urn:headerName>
    <urn:headerValue>$headerValue</urn:headerValue>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubAddheaderAction::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubAddheaderAction extends AddheaderAction
{
}
