<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\KeepAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for KeepAction.
 */
class KeepActionTest extends ZimbraTestCase
{
    public function testKeepAction()
    {
        $index = mt_rand(1, 99);
        $action = new KeepAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" />
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
