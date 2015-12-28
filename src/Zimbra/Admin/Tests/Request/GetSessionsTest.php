<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetSessions;
use Zimbra\Enum\GetSessionsSortBy as SessionsSortBy;
use Zimbra\Enum\SessionType;

/**
 * Testcase class for GetSessions.
 */
class GetSessionsTest extends ZimbraAdminApiTestCase
{
    public function testGetSessionsRequest()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $req = new GetSessions(
            SessionType::SOAP(), SessionsSortBy::NAME_ASC(), $limit, $offset, false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('soap', $req->getType()->value());
        $this->assertSame('nameAsc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertFalse($req->getRefresh());

        $req->setType(SessionType::ADMIN())
            ->setSortBy(SessionsSortBy::NAME_DESC())
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(true);
        $this->assertSame('admin', $req->getType()->value());
        $this->assertSame('nameDesc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertTrue($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetSessionsRequest '
                . 'type="' . SessionType::ADMIN() . '" '
                . 'sortBy="' . SessionsSortBy::NAME_DESC() . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'refresh="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetSessionsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => SessionType::ADMIN()->value(),
                'sortBy' => SessionsSortBy::NAME_DESC()->value(),
                'limit' => $limit,
                'offset' => $offset,
                'refresh' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSessionsApi()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->api->getSessions(
            SessionType::ADMIN(), SessionsSortBy::NAME_DESC(), $limit, $offset, true
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetSessionsRequest '
                        . 'type="' . SessionType::ADMIN() . '" '
                        . 'sortBy="' . SessionsSortBy::NAME_DESC() . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'refresh="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
