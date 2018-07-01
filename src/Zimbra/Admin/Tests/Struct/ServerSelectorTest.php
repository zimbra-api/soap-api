<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ServerSelector.
 */
class ServerSelectorTest extends ZimbraStructTestCase
{
    public function testServerSelector()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::ID()->value(), $value);
        $this->assertSame(ServerBy::ID()->value(), $server->getBy());
        $this->assertSame($value, $server->getValue());

        $server = new ServerSelector('');
        $server->setBy(ServerBy::NAME()->value())
               ->setValue($value);
        $this->assertSame(ServerBy::NAME()->value(), $server->getBy());
        $this->assertSame($value, $server->getValue());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));

        $server = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\ServerSelector', 'xml');
        $this->assertSame(ServerBy::NAME()->value(), $server->getBy());
        $this->assertSame($value, $server->getValue());
    }
}
