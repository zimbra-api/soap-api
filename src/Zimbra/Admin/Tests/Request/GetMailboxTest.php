<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetMailbox;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for GetMailbox.
 */
class GetMailboxTest extends ZimbraAdminApiTestCase
{
    public function testGetMailboxRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new GetMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailboxRequest>'
                . '<mbox id="' . $id . '" />'
            . '</GetMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailboxRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->getMailbox(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailboxRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:GetMailboxRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
