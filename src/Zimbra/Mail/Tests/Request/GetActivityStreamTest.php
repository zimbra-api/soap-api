<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\GetActivityStream;
use Zimbra\Mail\Struct\ActivityFilter;

/**
 * Testcase class for GetActivityStream.
 */
class GetActivityStreamTest extends ZimbraMailApiTestCase
{
    public function testGetActivityStreamRequest()
    {
        $id = $this->faker->uuid;
        $account = $this->faker->word;
        $ops = $this->faker->word;
        $sessionId = $this->faker->uuid;
        $offset = mt_rand(1, 10);
        $limit = mt_rand(1, 10);
        $filter = new ActivityFilter(
            $account, $ops, $sessionId
        );

        $req = new GetActivityStream(
            $id, $offset, $limit, $filter
        );
        $this->assertSame($id, $req->getId());
        $this->assertSame($offset, $req->getQueryOffset());
        $this->assertSame($limit, $req->getQueryLimit());
        $this->assertSame($filter, $req->getFilter());

        $req = new GetActivityStream('');
        $req->setId($id)
            ->setQueryOffset($offset)
            ->setQueryLimit($limit)
            ->setFilter($filter);
        $this->assertSame($id, $req->getId());
        $this->assertSame($offset, $req->getQueryOffset());
        $this->assertSame($limit, $req->getQueryLimit());
        $this->assertSame($filter, $req->getFilter());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetActivityStreamRequest id="' . $id . '" offset="' . $offset . '" limit="' . $limit . '">'
                .'<filter account="' . $account . '" op="' . $ops . '" session="' . $sessionId . '" />'
            .'</GetActivityStreamRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetActivityStreamRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'id' => $id,
                'offset' => $offset,
                'limit' => $limit,
                'filter' => array(
                    'account' => $account,
                    'op' => $ops,
                    'session' => $sessionId,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetActivityStreamApi()
    {
        $id = $this->faker->uuid;
        $account = $this->faker->word;
        $ops = $this->faker->word;
        $sessionId = $this->faker->uuid;
        $offset = mt_rand(1, 10);
        $limit = mt_rand(1, 10);
        $filter = new ActivityFilter(
            $account, $ops, $sessionId
        );

        $this->api->getActivityStream($id, $offset, $limit, $filter);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetActivityStreamRequest id="' . $id . '" offset="' . $offset . '" limit="' . $limit . '">'
                        .'<urn1:filter account="' . $account . '" op="' . $ops . '" session="' . $sessionId . '" />'
                    .'</urn1:GetActivityStreamRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
