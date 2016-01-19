<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\EnableSharedReminder;
use Zimbra\Mail\Struct\SharedReminderMount;

/**
 * Testcase class for EnableSharedReminder.
 */
class EnableSharedReminderTest extends ZimbraMailApiTestCase
{
    public function testEnableSharedReminderRequest()
    {
        $id = $this->faker->uuid;
        $link = new SharedReminderMount(
            $id, true
        );
        $req = new EnableSharedReminder(
            $link
        );
        $this->assertSame($link, $req->getMount());
        $req->setMount($link);
        $this->assertSame($link, $req->getMount());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EnableSharedReminderRequest>'
                .'<link id="' . $id . '" reminder="true" />'
            .'</EnableSharedReminderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EnableSharedReminderRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'link' => array(
                    'id' => $id,
                    'reminder' => true,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEnableSharedReminderApi()
    {
        $id = $this->faker->uuid;
        $link = new SharedReminderMount(
            $id, true
        );

        $this->api->enableSharedReminder(
           $link
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:EnableSharedReminderRequest>'
                        .'<urn1:link id="' . $id . '" reminder="true" />'
                    .'</urn1:EnableSharedReminderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
