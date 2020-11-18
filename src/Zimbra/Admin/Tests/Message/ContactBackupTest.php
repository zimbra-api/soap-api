<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ContactBackupBody;
use Zimbra\Admin\Message\ContactBackupEnvelope;
use Zimbra\Admin\Message\ContactBackupRequest;
use Zimbra\Admin\Message\ContactBackupResponse;
use Zimbra\Admin\Struct\{ContactBackupServer, ServerSelector};
use Zimbra\Enum\ContactBackupStatus;
use Zimbra\Enum\ContactBackupOp;
use Zimbra\Enum\ServerBy;
use Zimbra\Soap\Header;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactBackup.
 */
class ContactBackupTest extends ZimbraStructTestCase
{
    public function testContactBackup()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME(), $value);
        $request = new ContactBackupRequest([$server], ContactBackupOp::START());
        $this->assertEquals([$server], $request->getServers());
        $this->assertEquals(ContactBackupOp::START(), $request->getOp());
        $request = new ContactBackupRequest([], ContactBackupOp::STOP());
        $request->setServers([$server])
            ->addServer($server)
            ->setOp(ContactBackupOp::START());
        $this->assertEquals([$server, $server], $request->getServers());
        $this->assertEquals(ContactBackupOp::START(), $request->getOp());
        $request->setServers([$server]);

        $backupServer = new ContactBackupServer($name, ContactBackupStatus::STOPPED());
        $response = new ContactBackupResponse([$backupServer]);
        $this->assertEquals([$backupServer], $response->getServers());
        $response = new ContactBackupResponse([]);
        $response->setServers([$backupServer])
            ->addServer($backupServer);
        $this->assertEquals([$backupServer, $backupServer], $response->getServers());
        $response->setServers([$backupServer]);

        $body = new ContactBackupBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ContactBackupBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ContactBackupEnvelope(new Header(), $body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ContactBackupEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">'
                . '<soap:Body>'
                    . '<urn:ContactBackupRequest op="' . ContactBackupOp::START() . '">'
                        .'<servers>'
                            . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                        .'</servers>'
                    . '</urn:ContactBackupRequest>'
                    . '<urn:ContactBackupResponse>'
                        .'<servers>'
                            . '<server name="' . $name . '" status="' . ContactBackupStatus::STOPPED() . '" />'
                        .'</servers>'
                    . '</urn:ContactBackupResponse>'
                . '</soap:Body>'
            . '</soap:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ContactBackupEnvelope::class, 'xml'));

        $json = json_encode([
            'Body' => [
                'ContactBackupRequest' => [
                    'servers' => [
                        'server' => [
                            [
                                'by' => (string) ServerBy::NAME(),
                                '_content' => $value,
                            ],
                        ]
                    ],
                    'op' => (string) ContactBackupOp::START(),
                    '_jsns' => 'urn:zimbraAdmin',
                ],
                'ContactBackupResponse' => [
                    'servers' => [
                        'server' => [
                            [
                                'name' => $name,
                                'status' => (string) ContactBackupStatus::STOPPED(),
                            ],
                        ]
                    ],
                    '_jsns' => 'urn:zimbraAdmin',
                ],
            ],
        ]);
        $this->assertSame($json, $this->serializer->serialize($envelope, 'json'));
        $this->assertEquals($envelope, $this->serializer->deserialize($json, ContactBackupEnvelope::class, 'json'));
    }
}
