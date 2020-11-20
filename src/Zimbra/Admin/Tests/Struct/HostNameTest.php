<?php declare(strict_types=1);

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
        $this->assertEquals($host, $this->serializer->deserialize($xml, HostName::class, 'xml'));

        $json = json_encode([
            'hn' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($host, 'json'));
        $this->assertEquals($host, $this->serializer->deserialize($json, HostName::class, 'json'));
    }
}
