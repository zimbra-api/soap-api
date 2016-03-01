<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\PurgeMessages;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for PurgeMessages.
 */
class PurgeMessagesTest extends ZimbraAdminApiTestCase
{
    public function testPurgeMessagesRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new PurgeMessages($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $req->setMailbox($mbox);
        $this->assertEquals($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeMessagesRequest>'
                . '<mbox id="' . $id . '" />'
            . '</PurgeMessagesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeMessagesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeMessagesApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->purgeMessages(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeMessagesRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:PurgeMessagesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
