<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\FreeBusyProviderInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusyProviderInfo.
 */
class FreeBusyProviderInfoTest extends ZimbraTestCase
{
    public function testFreeBusyProviderInfo()
    {
        $name = $this->faker->word;
        $start = mt_rand(1, 100);
        $end = mt_rand(1, 100);
        $queue = $this->faker->word;
        $prefix = $this->faker->word;

        $provider = new FreeBusyProviderInfo($name, FALSE, $start, $end, $queue, $prefix);
        $this->assertSame($name, $provider->getName());
        $this->assertFalse($provider->getPropagate());
        $this->assertSame($start, $provider->getStart());
        $this->assertSame($end, $provider->getEnd());
        $this->assertSame($queue, $provider->getQueue());
        $this->assertSame($prefix, $provider->getPrefix());

        $provider = new FreeBusyProviderInfo('', FALSE, 0, 0, '', '');
        $provider->setName($name)
            ->setPropagate(TRUE)
            ->setStart($start)
            ->setEnd($end)
            ->setQueue($queue)
            ->setPrefix($prefix);
        $this->assertSame($name, $provider->getName());
        $this->assertTrue($provider->getPropagate());
        $this->assertSame($start, $provider->getStart());
        $this->assertSame($end, $provider->getEnd());
        $this->assertSame($queue, $provider->getQueue());
        $this->assertSame($prefix, $provider->getPrefix());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" propagate="true" start="$start" end="$end" queue="$queue" prefix="$prefix" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($provider, 'xml'));
        $this->assertEquals($provider, $this->serializer->deserialize($xml, FreeBusyProviderInfo::class, 'xml'));
    }
}
