<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ApplyFilterRules;
use Zimbra\Mail\Struct\IdsAttr;
use Zimbra\Mail\Struct\NamedFilterRules;
use Zimbra\Struct\NamedElement;

/**
 * Testcase class for ApplyFilterRules.
 */
class ApplyFilterRulesTest extends ZimbraMailApiTestCase
{
    public function testApplyFilterRulesRequest()
    {
        $ids = $this->faker->word;
        $name = $this->faker->word;
        $query = $this->faker->word;
        $filterRule = new NamedElement($name);
        $filterRules = new NamedFilterRules(array($filterRule));
        $m = new IdsAttr($ids);

        $req = new ApplyFilterRules(
            $filterRules, $m, $query
        );
        $this->assertSame($filterRules, $req->getFilterRules());
        $this->assertSame($m, $req->getMsgIds());
        $this->assertSame($query, $req->getQuery());

        $req = new ApplyFilterRules(
            new NamedFilterRules()
        );
        $req->setQuery($query)
            ->setMsgIds($m)
            ->setFilterRules($filterRules);
        $this->assertSame($filterRules, $req->getFilterRules());
        $this->assertSame($m, $req->getMsgIds());
        $this->assertSame($query, $req->getQuery());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ApplyFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="' . $name . '" />'
                .'</filterRules>'
                .'<query>' . $query . '</query>'
                .'<m ids="' . $ids . '" />'
            .'</ApplyFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ApplyFilterRulesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'filterRules' => array(
                    'filterRule' => array(
                        array('name' => $name),
                    ),
                ),
                'm' => array(
                    'ids' => $ids,
                ),
                'query' => $query,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testApplyFilterRulesApi()
    {
        $ids = $this->faker->word;
        $name = $this->faker->word;
        $query = $this->faker->word;
        $filterRule = new NamedElement($name);
        $filterRules = new NamedFilterRules(array($filterRule));
        $m = new IdsAttr($ids);

        $this->api->applyFilterRules(
            $filterRules, $m, $query
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ApplyFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="' . $name . '" />'
                        .'</urn1:filterRules>'
                        .'<urn1:m ids="' . $ids . '" />'
                        .'<urn1:query>' . $query . '</urn1:query>'
                    .'</urn1:ApplyFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
