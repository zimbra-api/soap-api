<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\FlagAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FlagAction.
 */
class FlagActionTest extends ZimbraTestCase
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
<result index="$index" flagName="$flag" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, FlagAction::class, 'xml'));
    }
}
