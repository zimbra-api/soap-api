<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ServerBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServerSelector.
 */
class ServerSelectorTest extends ZimbraTestCase
{
    public function testServerSelector()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::ID(), $value);
        $this->assertEquals(ServerBy::ID(), $server->getBy());
        $this->assertSame($value, $server->getValue());

        $server = new ServerSelector(ServerBy::ID());
        $server->setBy(ServerBy::NAME())
               ->setValue($value);
        $this->assertEquals(ServerBy::NAME(), $server->getBy());
        $this->assertSame($value, $server->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result by="name">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ServerSelector::class, 'xml'));

        $json = json_encode([
            'by' => 'name',
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ServerSelector::class, 'json'));
    }
}
