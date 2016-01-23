<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\SnoozeCalendarItemAlarm;
use Zimbra\Mail\Struct\SnoozeAppointmentAlarm;
use Zimbra\Mail\Struct\SnoozeTaskAlarm;

/**
 * Testcase class for SnoozeCalendarItemAlarm.
 */
class SnoozeCalendarItemAlarmTest extends ZimbraMailApiTestCase
{
    public function testSnoozeCalendarItemAlarmRequest()
    {
        $id = $this->faker->uuid;
        $until = mt_rand(1, 10);
        $appt = new SnoozeAppointmentAlarm($id, $until);
        $task = new SnoozeTaskAlarm($id, $until);

        $req = new SnoozeCalendarItemAlarm(
            [$appt]
        );
        $this->assertSame([$appt], $req->getAlarms()->all());

        $req = new SnoozeCalendarItemAlarm();
        $req->setAlarms([$appt])
        	->addAlarm($task);
        $this->assertSame([$appt, $task], $req->getAlarms()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SnoozeCalendarItemAlarmRequest>'
                .'<appt id="' . $id . '" until="' . $until . '" />'
                .'<task id="' . $id . '" until="' . $until . '" />'
            .'</SnoozeCalendarItemAlarmRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SnoozeCalendarItemAlarmRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'appt' => array(
                    'id' => $id,
                    'until' => $until,
                ),
                'task' => array(
                    'id' => $id,
                    'until' => $until,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSnoozeCalendarItemAlarmApi()
    {
        $id = $this->faker->uuid;
        $until = mt_rand(1, 10);
        $appt = new SnoozeAppointmentAlarm($id, $until);
        $task = new SnoozeTaskAlarm($id, $until);
        $this->api->snoozeCalendarItemAlarm(
            [$appt, $task]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SnoozeCalendarItemAlarmRequest>'
                        .'<urn1:appt id="' . $id . '" until="' . $until . '" />'
                        .'<urn1:task id="' . $id . '" until="' . $until . '" />'
                    .'</urn1:SnoozeCalendarItemAlarmRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
