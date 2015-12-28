<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\DeleteMailbox;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for DeleteMailbox.
 */
class DeleteMailboxTest extends ZimbraAdminApiTestCase
{
    public function testDeleteMailboxRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new DeleteMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteMailboxRequest>'
                . '<mbox id="' . $id . '" />'
            . '</DeleteMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteMailboxRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteMailboxApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->deleteMailbox(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteMailboxRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:DeleteMailboxRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
