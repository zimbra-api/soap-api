<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetIndexStats;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for GetIndexStats.
 */
class GetIndexStatsTest extends ZimbraAdminApiTestCase
{
    public function testGetIndexStatsRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new GetIndexStats($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetIndexStatsRequest>'
                . '<mbox id="' . $id . '" />'
            . '</GetIndexStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetIndexStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetIndexStatsApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->getIndexStats(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetIndexStatsRequest>'
                        . '<urn1:mbox id="' . $id  .'" />'
                    . '</urn1:GetIndexStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
