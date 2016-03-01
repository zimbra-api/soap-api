<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\GetCalendarItemSummaries;

/**
 * Testcase class for GetCalendarItemSummaries.
 */
class GetCalendarItemSummariesTest extends ZimbraMailApiTestCase
{
    public function testGetCalendarItemSummariesRequest()
    {
        $start = mt_rand(1, 100);
        $end = mt_rand(1, 100);
        $folder = $this->faker->word;
        $req = new GetCalendarItemSummaries(
            $start, $end, $folder
        );
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertSame($folder, $req->getFolderId());

        $req = new GetCalendarItemSummaries(
            0, 0
        );
        $req->setStartTime($start)
            ->setEndTime($end)
            ->setFolderId($folder);
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertSame($folder, $req->getFolderId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCalendarItemSummariesRequest s="' . $start . '" e="' . $end . '" l="' . $folder .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCalendarItemSummariesRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $start,
                'e' => $end,
                'l' => $folder,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarItemSummariesApi()
    {
        $start = mt_rand(1, 100);
        $end = mt_rand(1, 100);
        $folder = $this->faker->word;
        $this->api->getCalendarItemSummaries($start, $end, $folder);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCalendarItemSummariesRequest s="' . $start . '" e="' . $end . '" l="' . $folder .'" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
