<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\FlagAction;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FlagAction.
 */
class FlagActionTest extends ZimbraStructTestCase
{
    public function testFlagAction()
    {
        $index = mt_rand(1, 99);
        $flag = $this->faker->word;

        $action = new FlagAction($index, $flag);
        $this->assertSame($flag, $action->getFlag());

        $action = new FlagAction($index);
        $action->setFlag($flag);
        $this->assertSame($flag, $action->getFlag());

        $xml = <<<EOT
<?xml version="1.0"?>
<actionFlag index="$index" flagName="$flag" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FlagAction::class, 'xml'));

        $json = json_encode([
            'index' => $index,
            'flagName' => $flag,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($action, 'json'));
        $this->assertEquals($action, $this->serializer->deserialize($json, FlagAction::class, 'json'));
    }
}
