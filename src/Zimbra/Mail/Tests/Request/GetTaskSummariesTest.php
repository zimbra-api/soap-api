<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetTaskSummaries;

/**
 * Testcase class for GetTaskSummaries.
 */
class GetTaskSummariesTest extends ZimbraMailApiTestCase
{
    public function testGetTaskSummariesRequest()
    {
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $l = $this->faker->uuid;
        $req = new GetTaskSummaries(
            $s, $e, $l
        );
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($l, $req->getFolderId());

        $req = new GetTaskSummaries(
            0, 0
        );
        $req->setStartTime($s)
            ->setEndTime($e)
            ->setFolderId($l);
        $this->assertSame($s, $req->getStartTime());
        $this->assertSame($e, $req->getEndTime());
        $this->assertSame($l, $req->getFolderId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTaskSummariesRequest s="' . $s . '" e="' . $e . '" l="' . $l . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTaskSummariesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $s,
                'e' => $e,
                'l' => $l,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTaskSummariesApi()
    {
        $s = mt_rand(1, 10);
        $e = mt_rand(1, 10);
        $l = $this->faker->uuid;
        $this->api->getTaskSummaries($s, $e, $l);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetTaskSummariesRequest s="' . $s . '" e="' . $e . '" l="' . $l . '"  />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
