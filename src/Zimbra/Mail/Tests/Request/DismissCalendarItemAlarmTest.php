<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\DismissCalendarItemAlarm;
use Zimbra\Mail\Struct\DismissAppointmentAlarm;
use Zimbra\Mail\Struct\DismissTaskAlarm;

/**
 * Testcase class for DismissCalendarItemAlarm.
 */
class DismissCalendarItemAlarmTest extends ZimbraMailApiTestCase
{
    public function testDismissCalendarItemAlarmRequest()
    {
        $id = $this->faker->uuid;
        $at = mt_rand(1, 100);
        $appt = new DismissAppointmentAlarm($id, $at);
        $task = new DismissTaskAlarm($id, $at);

        $req = new DismissCalendarItemAlarm(
            [$appt]
        );
        $this->assertSame([$appt], $req->getAlarms()->all());
        $req->addAlarm($task);
        $this->assertSame([$appt, $task], $req->getAlarms()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DismissCalendarItemAlarmRequest>'
                .'<appt id="' . $id . '" dismissedAt="' . $at . '" />'
                .'<task id="' . $id . '" dismissedAt="' . $at . '" />'
            .'</DismissCalendarItemAlarmRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DismissCalendarItemAlarmRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'appt' => array(
                    'id' => $id,
                    'dismissedAt' => $at,
                ),
                'task' => array(
                    'id' => $id,
                    'dismissedAt' => $at,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDismissCalendarItemAlarmApi()
    {
        $id = $this->faker->uuid;
        $at = mt_rand(1, 100);
        $appt = new DismissAppointmentAlarm($id, $at);
        $task = new DismissTaskAlarm($id, $at);
        $this->api->dismissCalendarItemAlarm(
            [$appt, $task]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DismissCalendarItemAlarmRequest>'
                        .'<urn1:appt id="' . $id . '" dismissedAt="' . $at . '" />'
                        .'<urn1:task id="' . $id . '" dismissedAt="' . $at . '" />'
                    .'</urn1:DismissCalendarItemAlarmRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
