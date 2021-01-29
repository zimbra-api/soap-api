<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\RFCCompliantNotifyAction;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for RFCCompliantNotifyAction.
 */
class RFCCompliantNotifyActionTest extends ZimbraStructTestCase
{
    public function testRFCCompliantNotifyAction()
    {
        $index = mt_rand(1, 99);
        $from = $this->faker->word;
        $importance = $this->faker->word;
        $options = $this->faker->word;
        $message = $this->faker->word;
        $method = $this->faker->word;

        $action = new RFCCompliantNotifyAction($index, $from, $importance, $options, $message, $method);
        $this->assertSame($from, $action->getFrom());
        $this->assertSame($importance, $action->getImportance());
        $this->assertSame($options, $action->getOptions());
        $this->assertSame($message, $action->getMessage());
        $this->assertSame($method, $action->getMethod());

        $action = new RFCCompliantNotifyAction($index);
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
<actionRFCCompliantNotify index="$index" from="$from" importance="$importance" options="$options" message="$message">
    <method>$method</method>
</actionRFCCompliantNotify>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, RFCCompliantNotifyAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'from' => $from,
            'importance' => $importance,
            'options' => $options,
            'message' => $message,
            'method' => [
                '_content' => $method,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, RFCCompliantNotifyAction::class, 'json'));
    }
}
