<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Message;

use Zimbra\Admin\Message\ContactBackupRequest;
use Zimbra\Admin\Struct\ServerSelector;
use Zimbra\Enum\ContactBackupOp;
use Zimbra\Enum\ServerBy;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactBackupRequest.
 */
class ContactBackupRequestTest extends ZimbraStructTestCase
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
}
