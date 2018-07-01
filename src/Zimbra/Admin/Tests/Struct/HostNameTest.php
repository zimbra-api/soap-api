<?php

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\HostName;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for HostName.
 */
class HostNameTest extends ZimbraStructTestCase
{
    public function testHostName()
    {
        $name = $this->faker->word;
        $host = new HostName($name);
        $this->assertSame($name, $host->getHostName());

        $host = new HostName('');
        $host->setHostName($name);
        $this->assertSame($name, $host->getHostName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<hostname hn="' . $name . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($host, 'xml'));

        $host = $this->serializer->deserialize($xml, 'Zimbra\Admin\Struct\HostName', 'xml');
        $this->assertSame($name, $host->getHostName());
    }
}
