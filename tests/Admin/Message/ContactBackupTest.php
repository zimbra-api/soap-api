<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Message;

use Zimbra\Admin\Message\ContactBackupBody;
use Zimbra\Admin\Message\ContactBackupEnvelope;
use Zimbra\Admin\Message\ContactBackupRequest;
use Zimbra\Admin\Message\ContactBackupResponse;
use Zimbra\Admin\Struct\{ContactBackupServer, ServerSelector};
use Zimbra\Common\Enum\ContactBackupStatus;
use Zimbra\Common\Enum\ContactBackupOp;
use Zimbra\Common\Enum\ServerBy;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactBackup.
 */
class ContactBackupTest extends ZimbraTestCase
{
    public function testContactBackup()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;

        $server = new ServerSelector(ServerBy::NAME, $value);
        $request = new ContactBackupRequest([$server], ContactBackupOp::START);
        $this->assertSame([$server], $request->getServers());
        $this->assertEquals(ContactBackupOp::START, $request->getOp());
        $request = new ContactBackupRequest([], ContactBackupOp::STOP());
        $request->setServers([$server])
            ->addServer($server)
            ->setOp(ContactBackupOp::START);
        $this->assertSame([$server, $server], $request->getServers());
        $this->assertEquals(ContactBackupOp::START, $request->getOp());
        $request->setServers([$server]);

        $server = new ContactBackupServer($name, ContactBackupStatus::STOPPED);
        $response = new ContactBackupResponse([$server]);
        $this->assertSame([$server], $response->getServers());
        $response = new ContactBackupResponse();
        $response->setServers([$server]);
        $this->assertSame([$server], $response->getServers());

        $body = new ContactBackupBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ContactBackupBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $envelope = new ContactBackupEnvelope($body);
        $this->assertSame($body, $envelope->getBody());

        $envelope = new ContactBackupEnvelope();
        $envelope->setBody($body);
        $this->assertSame($body, $envelope->getBody());

        $xml = <<<EOT
<?xml version="1.0"?>
<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbraAdmin">
    <soap:Body>
        <urn:ContactBackupRequest op="start">
            <urn:servers>
                <urn:server by="name">$value</urn:server>
            </urn:servers>
        </urn:ContactBackupRequest>
        <urn:ContactBackupResponse>
            <urn:servers>
                <urn:server name="$name" status="stopped" />
            </urn:servers>
        </urn:ContactBackupResponse>
    </soap:Body>
</soap:Envelope>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($envelope, 'xml'));
        $this->assertEquals($envelope, $this->serializer->deserialize($xml, ContactBackupEnvelope::class, 'xml'));
    }
}
