<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDistributionListMembership;
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;

/**
 * Testcase class for GetDistributionListMembership.
 */
class GetDistributionListMembershipTest extends ZimbraAdminApiTestCase
{
    public function testGetDistributionListMembershipRequest()
    {
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $req = new GetDistributionListMembership($dl, $limit, $offset);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setDl($dl)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListMembershipRequest limit="' . $limit . '" offset="' . $offset . '">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
            . '</GetDistributionListMembershipRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListMembershipRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionListMembershipApi()
    {
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $this->api->getDistributionListMembership(
            $dl, $limit, $offset
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListMembershipRequest limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:GetDistributionListMembershipRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
