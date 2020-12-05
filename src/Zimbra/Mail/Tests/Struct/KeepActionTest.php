<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\KeepAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for KeepAction.
 */
class KeepActionTest extends ZimbraStructTestCase
{
    public function testKeepAction()
    {
        $index = mt_rand(1, 99);
        $action = new KeepAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<actionKeep index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, KeepAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, KeepAction::class, 'json'));
    }
}
