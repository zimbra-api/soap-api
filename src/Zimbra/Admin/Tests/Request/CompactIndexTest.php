<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\CompactIndex;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;
use Zimbra\Enum\CompactIndexAction as IndexAction;

/**
 * Testcase class for CompactIndex.
 */
class CompactIndexTest extends ZimbraAdminApiTestCase
{
    public function testCompactIndexRequest()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);
        $req = new CompactIndex($mbox, IndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame('start', $req->getAction()->value());

        $req->setMailbox($mbox)
            ->setAction(IndexAction::STATUS());
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame('status', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexRequest action="' . IndexAction::STATUS() . '">'
                . '<mbox id="' . $id . '" />'
            . '</CompactIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CompactIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => IndexAction::STATUS()->value(),
                'mbox' => [
                    'id' => $id
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompactIndexApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->compactIndex(
            $mbox, IndexAction::STATUS()
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CompactIndexRequest action="status">'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:CompactIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
