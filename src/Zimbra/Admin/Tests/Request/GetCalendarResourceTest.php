<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Admin\Tests\ZimbraAdminApiTestCase;
use Zimbra\Admin\Request\GetCalendarResource;
use Zimbra\Admin\Struct\CalendarResourceSelector;
use Zimbra\Enum\CalendarResourceBy as CalResBy;

/**
 * Testcase class for GetCalendarResource.
 */
class GetCalendarResourceTest extends ZimbraAdminApiTestCase
{
    public function testGetCalendarResourceRequest()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $calResource = new CalendarResourceSelector(CalResBy::NAME(), $value);
        $req = new GetCalendarResource($calResource, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($calResource, $req->getCalResource());
        $this->assertFalse($req->getApplyCos());

        $req->setCalResource($calResource)
            ->setApplyCos(true);
        $this->assertSame($calResource, $req->getCalResource());
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCalendarResourceRequest applyCos="true" attrs="' . $attrs . '">'
                . '<calresource by="' . CalResBy::NAME() . '">' . $value . '</calresource>'
            . '</GetCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true,
                'attrs' => $attrs,
                'calresource' => [
                    'by' => CalResBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarResourceApi()
    {
        $value = $this->faker->word;
        $attrs = $this->faker->word;

        $calResource = new CalendarResourceSelector(CalResBy::NAME(), $value);

        $this->api->getCalendarResource($calResource, true, [$attrs]);

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCalendarResourceRequest applyCos="true" attrs="' . $attrs . '">'
                        . '<urn1:calresource by="' . CalResBy::NAME() . '">' . $value . '</urn1:calresource>'
                    . '</urn1:GetCalendarResourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
