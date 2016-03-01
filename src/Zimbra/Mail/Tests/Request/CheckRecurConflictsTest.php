<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\CheckRecurConflicts;
use Zimbra\Mail\Struct\InstanceRecurIdInfo;
use Zimbra\Mail\Struct\DurationInfo;
use Zimbra\Mail\Struct\RecurrenceInfo;
use Zimbra\Mail\Struct\ExpandedRecurrenceCancel;
use Zimbra\Mail\Struct\ExpandedRecurrenceInvite;
use Zimbra\Mail\Struct\ExpandedRecurrenceException;
use Zimbra\Mail\Struct\FreeBusyUserSpec;
use Zimbra\Mail\Struct\CalTZInfo;

/**
 * Testcase class for CheckRecurConflicts.
 */
class CheckRecurConflictsTest extends ZimbraMailApiTestCase
{
    public function testCheckRecurConflictsRequest()
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
        $usr = new FreeBusyUserSpec();

        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);
        $uid = $this->faker->uuid;
        $req = new CheckRecurConflicts(
        	$start, $end, true, $uid, [$tz], [$cancel, $comp], [$usr]
    	);
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertTrue($req->getAllInstances());
        $this->assertSame($uid, $req->getExcludeUid());
        $this->assertSame([$tz], $req->getTimezones()->all());
        $this->assertSame([$cancel, $comp], $req->getComponents()->all());
        $this->assertSame([$usr], $req->getFreebusyUsers()->all());

        $req->addTimezone($tz)
            ->addComponent($except)
            ->addFreebusyUser($usr)
            ->setStartTime($start)
            ->setEndTime($end)
            ->setAllInstances(true)
            ->setExcludeUid($uid);
        $this->assertSame($start, $req->getStartTime());
        $this->assertSame($end, $req->getEndTime());
        $this->assertTrue($req->getAllInstances());
        $this->assertSame($uid, $req->getExcludeUid());
        $this->assertSame([$tz, $tz], $req->getTimezones()->all());
        $this->assertSame([$cancel, $comp, $except], $req->getComponents()->all());
        $this->assertSame([$usr, $usr], $req->getFreebusyUsers()->all());

        $req = new \Zimbra\Mail\Request\CheckRecurConflicts(
            $start, $end, true, $uid, [$tz], [$cancel, $comp, $except], [$usr]
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckRecurConflictsRequest s="' . $start . '" e="' . $end . '" all="true" excludeUid="' . $uid . '">'
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
                .'<usr />'
            .'</CheckRecurConflictsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckRecurConflictsRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                's' => $start,
                'e' => $end,
                'all' => true,
                'excludeUid' => $uid,
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
                'usr' => array(
                    array(
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRecurConflictsApi()
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
        $usr = new FreeBusyUserSpec();

        $start = mt_rand(1, 10);
        $end = mt_rand(1, 10);
        $uid = $this->faker->uuid;

        $this->api->checkRecurConflicts(
            $start, $end, true, $uid, [$tz], [$cancel, $comp, $except], [$usr]
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckRecurConflictsRequest s="' . $start . '" e="' . $end . '" all="true" excludeUid="' . $uid . '">'
                        .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" />'
                        .'<urn1:cancel>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur  />'
                            .'<urn1:recur />'
                        .'</urn1:cancel>'
                        .'<urn1:comp>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur  />'
                            .'<urn1:recur />'
                        .'</urn1:comp>'
                        .'<urn1:except>'
                            .'<urn1:exceptId />'
                            .'<urn1:dur  />'
                            .'<urn1:recur />'
                        .'</urn1:except>'
                        .'<urn1:usr />'
                    .'</urn1:CheckRecurConflictsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
