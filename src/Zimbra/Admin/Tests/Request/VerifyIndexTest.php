<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\VerifyIndex;
use Zimbra\Admin\Struct\MailboxByAccountIdSelector;

/**
 * Testcase class for VerifyIndex.
 */
class VerifyIndexTest extends ZimbraAdminApiTestCase
{
    public function testVerifyIndexRequest()
    {
        $id = $this->faker->word;

        $mbox = new MailboxByAccountIdSelector($id);
        $req = new VerifyIndex($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyIndexRequest>'
                . '<mbox id="' . $id . '" />'
            . '</VerifyIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyIndexApi()
    {
        $id = $this->faker->word;
        $mbox = new MailboxByAccountIdSelector($id);

        $this->api->verifyIndex(
            $mbox
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyIndexRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:VerifyIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
