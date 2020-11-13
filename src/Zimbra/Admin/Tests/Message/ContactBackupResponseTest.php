<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ContactBackupResponse;
use Zimbra\Admin\Struct\ContactBackupServer;
use Zimbra\Enum\ContactBackupStatus;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactBackupResponse.
 */
class ContactBackupResponseTest extends ZimbraStructTestCase
{
    public function testContactBackupResponse()
    {
        $name = $this->faker->word;
        $server = new ContactBackupServer($name, ContactBackupStatus::STOPPED());

        $res = new ContactBackupResponse([$server]);
        $this->assertEquals([$server], $res->getServers());

        $res = new ContactBackupResponse([]);
        $res->setServers([$server])
            ->addServer($server);
        $this->assertEquals([$server, $server], $res->getServers());

        $res = new ContactBackupResponse([$server]);
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ContactBackupResponse>'
                .'<servers>'
                    . '<server name="' . $name . '" status="' . ContactBackupStatus::STOPPED() . '" />'
                .'</servers>'
            . '</ContactBackupResponse>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($res, 'xml'));
        $this->assertEquals($res, $this->serializer->deserialize($xml, ContactBackupResponse::class, 'xml'));

        $json = json_encode([
            'servers' => [
                'server' => [
                    [
                        'name' => $name,
                        'status' => (string) ContactBackupStatus::STOPPED(),
                    ],
                ]
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($res, 'json'));
        $this->assertEquals($res, $this->serializer->deserialize($json, ContactBackupResponse::class, 'json'));
    }
}
