<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ServiceStatus;
use Zimbra\Common\Enum\ZeroOrOne;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ServiceStatus.
 */
class ServiceStatusTest extends ZimbraTestCase
{
    public function testServiceStatus()
    {
        $server = $this->faker->word;
        $service = $this->faker->word;
        $time = time();

        $status = new ServiceStatus($server, $service, $time, ZeroOrOne::ZERO());
        $this->assertSame($server, $status->getServer());
        $this->assertSame($service, $status->getService());
        $this->assertSame($time, $status->getTime());
        $this->assertEquals(ZeroOrOne::ZERO(), $status->getStatus());

        $status = new ServiceStatus('', '', 0, ZeroOrOne::ZERO());
        $status->setServer($server)
           ->setService($service)
           ->setTime($time)
           ->setStatus(ZeroOrOne::ONE());
        $this->assertSame($server, $status->getServer());
        $this->assertSame($service, $status->getService());
        $this->assertSame($time, $status->getTime());
        $this->assertEquals(ZeroOrOne::ONE(), $status->getStatus());

        $xml = <<<EOT
<?xml version="1.0"?>
<result server="$server" service="$service" t="$time">1</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($status, 'xml'));
        $this->assertEquals($status, $this->serializer->deserialize($xml, ServiceStatus::class, 'xml'));
    }
}
