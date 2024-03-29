<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\StopAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for StopAction.
 */
class StopActionTest extends ZimbraTestCase
{
    public function testStopAction()
    {
        $index = $this->faker->numberBetween(1, 99);
        $action = new StopAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, StopAction::class, 'xml'));
    }
}
