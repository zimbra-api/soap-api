<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\RFCCompliantNotifyAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RFCCompliantNotifyAction.
 */
class RFCCompliantNotifyActionTest extends ZimbraTestCase
{
    public function testRFCCompliantNotifyAction()
    {
        $index = mt_rand(1, 99);
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $method = $this->faker->word;

        $action = new StubRFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $this->assertSame($from, $action->getFrom());
        $this->assertSame($importance, $action->getImportance());
        $this->assertSame($options, $action->getOptions());
        $this->assertSame($message, $action->getMessage());
        $this->assertSame($method, $action->getMethod());

        $action = new StubRFCCompliantNotifyAction($index);
        $action->setFrom($from)
            ->setImportance($importance)
            ->setOptions($options)
            ->setMessage($message)
            ->setMethod($method);
        $this->assertSame($from, $action->getFrom());
        $this->assertSame($importance, $action->getImportance());
        $this->assertSame($options, $action->getOptions());
        $this->assertSame($message, $action->getMessage());
        $this->assertSame($method, $action->getMethod());

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" from="$from" importance="$importance" options="$options" message="$message" xmlns:urn="urn:zimbraMail">
    <urn:method>$method</urn:method>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StubRFCCompliantNotifyAction::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
class StubRFCCompliantNotifyAction extends RFCCompliantNotifyAction
{
}
