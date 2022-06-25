<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\DiscardAction;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DiscardAction.
 */
class DiscardActionTest extends ZimbraTestCase
{
    public function testDiscardAction()
    {
        $index = mt_rand(1, 99);
        $action = new DiscardAction($index);

        $xml = <<<EOT
<?xml version="1.0"?>
<result index="$index" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($action, 'xml'));
        $this->assertEquals($action, $this->serializer->deserialize($xml, DiscardAction::class, 'xml'));
    }
}
