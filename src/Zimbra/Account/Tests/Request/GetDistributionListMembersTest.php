<?php

namespace Zimbra\Account\Tests\Request;

use Zimbra\Account\Tests\ZimbraAccountApiTestCase;
use Zimbra\Account\Request\GetDistributionListMembers;

/**
 * Testcase class for GetDistributionListMembers.
 */
class GetDistributionListMembersTest extends ZimbraAccountApiTestCase
{
    public function testGetDistributionListMembersRequest()
    {
        $name = $this->faker->word;
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);

        $req = new GetDistributionListMembers($name, $limit, $offset);
        $this->assertInstanceOf('Zimbra\Account\Request\Base', $req);
        $this->assertSame($name, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setDl($name)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($name, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListMembersRequest limit="' . $limit . '" offset="' . $offset . '">'
                . '<dl>' . $name . '</dl>'
            . '</GetDistributionListMembersRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListMembersRequest' => [
                '_jsns' => 'urn:zimbraAccount',
                'dl' => $name,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionListMembersApi()
    {
        $limit = mt_rand(1, 100);
        $offset = mt_rand(0, 100);
        $name = $this->faker->word;
        $this->api->getDistributionListMembers($name, $limit, $offset);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAccount">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListMembersRequest limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:dl>' . $name . '</urn1:dl>'
                    . '</urn1:GetDistributionListMembersRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
