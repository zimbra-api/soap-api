<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetDistributionList;
use Zimbra\Admin\Struct\DistributionListSelector;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Struct\KeyValuePair;

/**
 * Testcase class for GetDistributionList.
 */
class GetDistributionListTest extends ZimbraAdminApiTestCase
{
    public function testGetDistributionListRequest()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new KeyValuePair($key, $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);
        $req = new GetDistributionList($dl, $limit, $offset, false, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertFalse($req->getSortAscending());

        $req->setDl($dl)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortAscending(true);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertTrue($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListRequest limit="' . $limit . '" offset="' . $offset . '" sortAscending="true">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'sortAscending' => true,
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionListApi()
    {
        $key = $this->faker->word;
        $value = $this->faker->word;
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $attr = new KeyValuePair($key, $value);
        $dl = new DistributionListSelector(DLBy::NAME(), $value);

        $this->api->getDistributionList(
            $dl, $limit, $offset, true, [$attr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListRequest limit="' . $limit . '" offset="' . $offset . '" sortAscending="true">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
     }
}
