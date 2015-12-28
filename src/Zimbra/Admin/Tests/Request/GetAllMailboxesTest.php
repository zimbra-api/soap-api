<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetAllMailboxes;

/**
 * Testcase class for GetAllMailboxes.
 */
class GetAllMailboxesTest extends ZimbraAdminApiTestCase
{
    public function testGetAllMailboxesRequest()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $req = new GetAllMailboxes($limit, $offset);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllMailboxesRequest limit="' . $limit . '" offset="' . $offset . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllMailboxesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllMailboxesApi()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->api->getAllMailboxes($limit, $offset);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllMailboxesRequest limit="' . $limit . '" offset="' . $offset . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
