<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\StopAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for StopAction.
 */
class StopActionTest extends ZimbraStructTestCase
{
    public function testStopAction()
    {
        $index = mt_rand(1, 99);
        $action = new StopAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<actionStop index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StopAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, StopAction::class, 'json'));
    }
}
