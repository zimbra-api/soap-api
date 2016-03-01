<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Mail\Request\ExpandRecur;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;

/**
 * Testcase class for ExpandRecur.
 */
class ExpandRecurTest extends ZimbraMailApiTestCase
{
    public function testExpandRecurRequest()
    {
        $exceptId = new InstanceRecurIdInfo();
        $dur = new DurationInfo();
        $recur = new RecurrenceInfo();

        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);

        $cancel = new ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur
        );
        $comp = new ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur
        );
        $except = new ExpandedRecurrenceException(
            $exceptId, $dur, $recur
        );

        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);

        $req = new ExpandRecur(
            $start, $end, [$tz], [$cancel, $comp]
        );
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertSame([$tz], $req->getTimezones()->all());
        $this->assertSame([$cancel, $comp], $req->getComponents()->all());

        $req->setStartTime($start)
            ->setEndTime($end)
            ->addTimezone($tz)
            ->addComponent($except);
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertSame([$tz, $tz], $req->getTimezones()->all());
        $this->assertSame([$cancel, $comp, $except], $req->getComponents()->all());

        $req = new \Zimbra\Mail\Request\ExpandRecur(
           $start, $end, [$tz], [$cancel, $comp, $except]
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExpandRecurRequest s="' . $start . '" e="' . $end . '">'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                .'<cancel>'
                    .'<exceptId />'
                    .'<dur />'
                    .'<recur />'
                .'</cancel>'
                .'<comp>'
                    .'<exceptId />'
                    .'<dur />'
                    .'<recur />'
                .'</comp>'
                .'<except>'
                    .'<exceptId />'
                    .'<dur />'
                    .'<recur />'
                .'</except>'
            .'</ExpandRecurRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExpandRecurRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $start,
                'e' => $end,
                'tz' => array(
                    array(
                        'id' => $id,
                        'stdoff' => $stdoff,
                        'dayoff' => $dayoff,
                    ),
                ),
                'cancel' => array(
                    'exceptId' => array(),
                    'dur' => array(),
                    'recur' => array(),
                ),
                'comp' => array(
                    'exceptId' => array(),
                    'dur' => array(),
                    'recur' => array(),
                ),
                'except' => array(
                    'exceptId' => array(),
                    'dur' => array(),
                    'recur' => array(),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExpandRecurApi()
    {
        $exceptId = new InstanceRecurIdInfo();
        $dur = new DurationInfo();
        $recur = new RecurrenceInfo();

        $id = $this->faker->uuid;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $tz = new CalTZInfo($id, $stdoff, $dayoff);

        $cancel = new ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur
        );
        $comp = new ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur
        );
        $except = new ExpandedRecurrenceException(
            $exceptId, $dur, $recur
        );

        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);

        $this->api->expandRecur(
           $start, $end, [$tz], [$cancel, $comp, $except]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ExpandRecurRequest s="' . $start . '" e="' . $end . '">'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:cancel>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur />'
                            .'<urn1:recur />'
                        .'</urn1:cancel>'
                        .'<urn1:comp>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur />'
                            .'<urn1:recur />'
                        .'</urn1:comp>'
                        .'<urn1:except>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur />'
                            .'<urn1:recur />'
                        .'</urn1:except>'
                    .'</urn1:ExpandRecurRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
