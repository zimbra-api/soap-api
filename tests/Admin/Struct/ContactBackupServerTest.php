<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ContactBackupServer;
use Zimbra\Enum\ContactBackupStatus;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactBackupServer.
 */
class ContactBackupServerTest extends ZimbraTestCase
{
    public function testContactBackupServer()
    {
        $name = $this->faker->word;

        $server = new ContactBackupServer($name, ContactBackupStatus::STARTED());
        $this->assertSame($name, $server->getName());
        $this->assertEquals(ContactBackupStatus::STARTED(), $server->getStatus());

        $server = new ContactBackupServer('', ContactBackupStatus::STOPPED());
        $server->setName($name)
               ->setStatus(ContactBackupStatus::STOPPED());
        $this->assertSame($name, $server->getName());
        $this->assertEquals(ContactBackupStatus::STOPPED(), $server->getStatus());

        $status = ContactBackupStatus::STOPPED()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<server name="$name" status="$status"/>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($server, 'xml'));
        $this->assertEquals($server, $this->serializer->deserialize($xml, ContactBackupServer::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'status' => $status,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($server, 'json'));
        $this->assertEquals($server, $this->serializer->deserialize($json, ContactBackupServer::class, 'json'));
    }
}
