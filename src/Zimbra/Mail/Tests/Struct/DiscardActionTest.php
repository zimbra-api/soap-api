<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\DiscardAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for DiscardAction.
 */
class DiscardActionTest extends ZimbraStructTestCase
{
    public function testDiscardAction()
    {
        $index = mt_rand(1, 99);
        $action = new DiscardAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<actionDiscard index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, DiscardAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, DiscardAction::class, 'json'));
    }
}
