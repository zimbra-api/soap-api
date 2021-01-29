<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\HostName;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for HostName.
 */
class HostNameTest extends ZimbraTestCase
{
    public function testHostName()
    {
        $name = $this->faker->word;
        $host = new HostName($name);
        $this->assertSame($name, $host->getHostName());

        $host = new HostName('');
        $host->setHostName($name);
        $this->assertSame($name, $host->getHostName());

        $xml = <<<EOT
<?xml version="1.0"?>
<hostname hn="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($host, 'xml'));
        $this->assertEquals($host, $this->serializer->deserialize($xml, HostName::class, 'xml'));

        $json = json_encode([
            'hn' => $name,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($host, 'json'));
        $this->assertEquals($host, $this->serializer->deserialize($json, HostName::class, 'json'));
    }
}
