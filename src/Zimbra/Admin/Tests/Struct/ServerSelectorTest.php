<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ServerBy;

/**
 * Testcase class for ServerSelector.
 */
class ServerSelectorTest extends ZimbraAdminTestCase
{
    public function testServerSelector()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::ID(), $value);
        $this->assertSame('id', $server->getBy()->value());
        $this->assertSame($value, $server->getValue());

        $server->setBy(ServerBy::NAME());
        $this->assertSame('name', $server->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'server' => [
                'by' => ServerBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }
}
