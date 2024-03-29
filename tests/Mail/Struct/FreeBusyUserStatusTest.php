<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\FreeBusyStatus;
use Zimbra\Mail\Struct\FreeBusyUserStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FreeBusyUserStatus.
 */
class FreeBusyUserStatusTest extends ZimbraTestCase
{
    public function testFreeBusyUserStatus()
    {
        $name = $this->faker->email;
        $freebusyStatus = FreeBusyStatus::FREE;

        $usr = new FreeBusyUserStatus($name, $freebusyStatus);
        $this->assertSame($name, $usr->getName());
        $this->assertSame($freebusyStatus, $usr->getFreebusyStatus());

        $usr = new FreeBusyUserStatus($this->faker->email, FreeBusyStatus::BUSY);
        $usr->setName($name)
            ->setFreebusyStatus($freebusyStatus);
        $this->assertSame($name, $usr->getName());
        $this->assertSame($freebusyStatus, $usr->getFreebusyStatus());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" fb="F" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($usr, 'xml'));
        $this->assertEquals($usr, $this->serializer->deserialize($xml, FreeBusyUserStatus::class, 'xml'));
    }
}
