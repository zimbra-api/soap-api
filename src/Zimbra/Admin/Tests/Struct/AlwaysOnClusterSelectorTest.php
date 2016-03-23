<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\AlwaysOnClusterSelector;
use Zimbra\Enum\AlwaysOnClusterBy;

/**
 * Testcase class for AlwaysOnClusterSelector.
 */
class AlwaysOnClusterSelectorTest extends ZimbraAdminTestCase
{
    public function testAlwaysOnClusterSelector()
    {
        $value = $this->faker->word;
        $server = new AlwaysOnClusterSelector(AlwaysOnClusterBy::ID(), $value);
        $this->assertSame('id', $server->getBy()->value());
        $this->assertSame($value, $server->getValue());

        $server->setBy(AlwaysOnClusterBy::NAME());
        $this->assertSame('name', $server->getBy()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<alwaysOnCluster by="' . AlwaysOnClusterBy::NAME() . '">' . $value . '</alwaysOnCluster>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $server);

        $array = [
            'alwaysOnCluster' => [
                'by' => AlwaysOnClusterBy::NAME()->value(),
                '_content' => $value,
            ],
        ];
        $this->assertEquals($array, $server->toArray());
    }
}
