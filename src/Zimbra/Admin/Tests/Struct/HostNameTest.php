<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Tests\ZimbraAdminTestCase;
use Zimbra\Admin\Struct\HostName;

/**
 * Testcase class for HostName.
 */
class HostNameTest extends ZimbraAdminTestCase
{
    public function testHostName()
    {
        $name = $this->faker->word;
        $host = new HostName($name);
        $this->assertSame($name, $host->getHostName());

        $host->setHostName($name);
        $this->assertSame($name, $host->getHostName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<hostname hn="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $host);

        $array = [
            'hostname' => [
                'hn' => $name,
            ],
        ];
        $this->assertEquals($array, $host->toArray());
    }
}
