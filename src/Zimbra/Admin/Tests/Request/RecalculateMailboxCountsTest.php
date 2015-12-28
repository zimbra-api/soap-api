<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\RecalculateMailboxCounts;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for RecalculateMailboxCounts.
 */
class RecalculateMailboxCountsTest extends ZimbraAdminApiTestCase
{
    public function testRecalculateMailboxCountsRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new RecalculateMailboxCounts($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $req->setMailbox($mbox);
        $this->assertEquals($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RecalculateMailboxCountsRequest>'
                . '<mbox id="' . $id . '" />'
            . '</RecalculateMailboxCountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RecalculateMailboxCountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRecalculateMailboxCountsApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->recalculateMailboxCounts(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RecalculateMailboxCountsRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:RecalculateMailboxCountsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
