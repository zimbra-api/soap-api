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
    public function testContactBackupRequest()
    {
        $value = $this->faker->word;
        $server = new ServerSelector(ServerBy::NAME(), $value);

        $req = new ContactBackupRequest([$server], ContactBackupOp::START());
        $this->assertEquals([$server], $req->getServers());
        $this->assertEquals(ContactBackupOp::START(), $req->getOp());

        $req = new ContactBackupRequest([], ContactBackupOp::STOP());
        $req->setServers([$server])
            ->addServer($server)
            ->setOp(ContactBackupOp::START());
        $this->assertEquals([$server, $server], $req->getServers());
        $this->assertEquals(ContactBackupOp::START(), $req->getOp());

        $req = new ContactBackupRequest([$server], ContactBackupOp::START());
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ContactBackupRequest op="' . ContactBackupOp::START() . '">'
                .'<servers>'
                    . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                .'</servers>'
            . '</ContactBackupRequest>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($req, 'xml'));
        $this->assertEquals($req, $this->serializer->deserialize($xml, ContactBackupRequest::class, 'xml'));

        $json = json_encode([
            'servers' => [
                'server' => [
                    [
                        'by' => (string) ServerBy::NAME(),
                        '_content' => $value,
                    ],
                ]
            ],
            'op' => (string) ContactBackupOp::START(),
        ]);
        $this->assertSame($json, $this->serializer->serialize($req, 'json'));
        $this->assertEquals($req, $this->serializer->deserialize($json, ContactBackupRequest::class, 'json'));
    }

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

    public function testContactBackupBody()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $request = new ContactBackupRequest([new ServerSelector(ServerBy::NAME(), $value)], ContactBackupOp::START());
        $response = new ContactBackupResponse([new ContactBackupServer($name, ContactBackupStatus::STOPPED())]);

        $body = new ContactBackupBody($request, $response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $body = new ContactBackupBody();
        $body->setRequest($request)
             ->setResponse($response);
        $this->assertSame($request, $body->getRequest());
        $this->assertSame($response, $body->getResponse());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<Body xmlns:urn="urn:zimbraAdmin">'
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
            . '</Body>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($body, 'xml'));
        $this->assertEquals($body, $this->serializer->deserialize($xml, ContactBackupBody::class, 'xml'));

        $json = json_encode([
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
        ]);
        $this->assertSame($json, $this->serializer->serialize($body, 'json'));
        $this->assertEquals($body, $this->serializer->deserialize($json, ContactBackupBody::class, 'json'));
    }

    public function testContactBackupEnvelope()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $request = new ContactBackupRequest([new ServerSelector(ServerBy::NAME(), $value)], ContactBackupOp::START());
        $response = new ContactBackupResponse([new ContactBackupServer($name, ContactBackupStatus::STOPPED())]);
        $body = new ContactBackupBody($request, $response);

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
