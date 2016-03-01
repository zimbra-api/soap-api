<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\FreeBusyStatus;
use Zimbra\Enum\Transparency;
use Zimbra\Enum\InviteStatus;
use Zimbra\Enum\InviteClass;
use Zimbra\Enum\InviteChange;
use Zimbra\Mail\Struct\InviteComponentCommon;

/**
 * Testcase class for InviteComponentCommon.
 */
class InviteComponentCommonTest extends ZimbraMailTestCase
{
    public function testInviteComponentCommon()
    {
        $name = $this->faker->word;
        $method = $this->faker->word;
        $loc = $this->faker->word;
        $completed = $this->faker->iso8601;
        $x_uid = $this->faker->uuid;
        $uid = $this->faker->uuid;

        $compNum = mt_rand(1, 10);
        $priority = mt_rand(1, 10);
        $percent = mt_rand(1, 100);
        $seq = mt_rand(1, 10);
        $date = mt_rand(1, 10);

        $calItemId = $this->faker->word;
        $apptId = $this->faker->word;
        $ciFolder = $this->faker->word;
        $url = $this->faker->word;
        $ridZ = $this->faker->iso8601;

        $subject = InviteChange::SUBJECT();
        $location = InviteChange::LOCATION();
        $time = InviteChange::TIME();

        $comp = new InviteComponentCommon(
            $method,
            $compNum,
            true,
            $priority,
            $name,
            $loc,
            $percent,
            $completed,
            true,
            FreeBusyStatus::FREE(),
            FreeBusyStatus::FREE(),
            Transparency::OPAQUE(),
            true,
            $x_uid,
            $uid,
            $seq,
            $date,
            $calItemId,
            $apptId,
            $ciFolder,
            InviteStatus::COMPLETED(),
            InviteClass::PUB(),
            $url,
            true,
            $ridZ,
            true,
            true,
            true,
            array($subject, $location)
        );

        $this->assertSame($method, $comp->getMethod());
        $this->assertSame($compNum, $comp->getComponentNum());
        $this->assertTrue($comp->getRsvp());
        $this->assertSame($priority, $comp->getPriority());
        $this->assertSame($name, $comp->getName());
        $this->assertSame($loc, $comp->getLocation());
        $this->assertSame($percent, $comp->getPercentComplete());
        $this->assertSame($completed, $comp->getCompleted());
        $this->assertTrue($comp->getNoBlob());
        $this->assertTrue($comp->getFreeBusyActual()->is('F'));
        $this->assertTrue($comp->getFreeBusy()->is('F'));
        $this->assertTrue($comp->getTransparency()->is('O'));
        $this->assertTrue($comp->getIsOrganizer());
        $this->assertSame($x_uid, $comp->getXUid());
        $this->assertSame($uid, $comp->getUid());
        $this->assertSame($seq, $comp->getSequence());
        $this->assertSame($date, $comp->getDateTime());
        $this->assertSame($calItemId, $comp->getCalItemId());
        $this->assertSame($apptId, $comp->getApptId());
        $this->assertSame($ciFolder, $comp->getCalItemFolder());
        $this->assertTrue($comp->getStatus()->is('COMP'));
        $this->assertTrue($comp->getCalClass()->is('PUB'));
        $this->assertSame($url, $comp->getUrl());
        $this->assertTrue($comp->getIsException());
        $this->assertSame($ridZ, $comp->getRecurIdZ());
        $this->assertTrue($comp->getIsAllDay());
        $this->assertTrue($comp->getIsDraft());
        $this->assertTrue($comp->getNeverSent());
        $this->assertSame($subject . ',' . $location, $comp->getChanges());

        $comp->setMethod($method)
             ->setComponentNum($compNum)
             ->setRsvp(true)
             ->setPriority($priority)
             ->setName($name)
             ->setLocation($loc)
             ->setPercentComplete($percent)
             ->setCompleted($completed)
             ->setNoBlob(true)
             ->setFreeBusyActual(FreeBusyStatus::FREE())
             ->setFreeBusy(FreeBusyStatus::FREE())
             ->setTransparency(Transparency::OPAQUE())
             ->setIsOrganizer(true)
             ->setXUid($x_uid)
             ->setUid($uid)
             ->setSequence($seq)
             ->setDateTime($date)
             ->setCalItemId($calItemId)
             ->setApptId($apptId)
             ->setCalItemFolder($ciFolder)
             ->setStatus(InviteStatus::COMPLETED())
             ->setCalClass(InviteClass::PUB())
             ->setUrl($url)
             ->setIsException(true)
             ->setRecurIdZ($ridZ)
             ->setIsAllDay(true)
             ->setIsDraft(true)
             ->setNeverSent(true)
             ->addChange($time);
        $this->assertSame($method, $comp->getMethod());
        $this->assertSame($compNum, $comp->getComponentNum());
        $this->assertTrue($comp->getRsvp());
        $this->assertSame($priority, $comp->getPriority());
        $this->assertSame($name, $comp->getName());
        $this->assertSame($loc, $comp->getLocation());
        $this->assertSame($percent, $comp->getPercentComplete());
        $this->assertSame($completed, $comp->getCompleted());
        $this->assertTrue($comp->getNoBlob());
        $this->assertTrue($comp->getFreeBusyActual()->is('F'));
        $this->assertTrue($comp->getFreeBusy()->is('F'));
        $this->assertTrue($comp->getTransparency()->is('O'));
        $this->assertTrue($comp->getIsOrganizer());
        $this->assertSame($x_uid, $comp->getXUid());
        $this->assertSame($uid, $comp->getUid());
        $this->assertSame($seq, $comp->getSequence());
        $this->assertSame($date, $comp->getDateTime());
        $this->assertSame($calItemId, $comp->getCalItemId());
        $this->assertSame($apptId, $comp->getApptId());
        $this->assertSame($ciFolder, $comp->getCalItemFolder());
        $this->assertTrue($comp->getStatus()->is('COMP'));
        $this->assertTrue($comp->getCalClass()->is('PUB'));
        $this->assertSame($url, $comp->getUrl());
        $this->assertTrue($comp->getIsException());
        $this->assertSame($ridZ, $comp->getRecurIdZ());
        $this->assertTrue($comp->getIsAllDay());
        $this->assertTrue($comp->getIsDraft());
        $this->assertTrue($comp->getNeverSent());
        $this->assertSame($subject . ',' . $location . ',' . $time, $comp->getChanges());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<comp'
                .' method="' . $method .'"'
                .' compNum="' . $compNum . '"'
                .' rsvp="true"'
                .' priority="' . $priority . '"'
                .' name="' . $name . '"'
                .' loc="' . $loc . '"'
                .' percentComplete="' . $percent . '"'
                .' completed="' . $completed . '"'
                .' noBlob="true"'
                .' fba="' . FreeBusyStatus::FREE() . '"'
                .' fb="' . FreeBusyStatus::FREE() . '"'
                .' transp="' . Transparency::OPAQUE() . '"'
                .' isOrg="true"'
                .' x_uid="' . $x_uid . '"'
                .' uid="' . $uid . '"'
                .' seq="' . $seq . '"'
                .' d="' . $date . '"'
                .' calItemId="' . $calItemId . '"'
                .' apptId="' . $apptId . '"'
                .' ciFolder="' . $ciFolder . '"'
                .' status="' . InviteStatus::COMPLETED() . '"'
                .' class="' . InviteClass::PUB() . '"'
                .' url="' . $url . '"'
                .' ex="true"'
                .' ridZ="' . $ridZ .'"'
                .' allDay="true"'
                .' draft="true"'
                .' neverSent="true"'
                .' changes="' . $subject . ',' . $location . ',' . $time . '"'
            .' />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => $method,
                'compNum' => $compNum,
                'rsvp' => true,
                'priority' => $priority,
                'name' => $name,
                'loc' => $loc,
                'percentComplete' => $percent,
                'completed' => $completed,
                'noBlob' => true,
                'fba' => FreeBusyStatus::FREE()->value(),
                'fb' => FreeBusyStatus::FREE()->value(),
                'transp' => Transparency::OPAQUE()->value(),
                'isOrg' => true,
                'x_uid' => $x_uid,
                'uid' => $uid,
                'seq' => $seq,
                'd' => $date,
                'calItemId' => $calItemId,
                'apptId' => $apptId,
                'ciFolder' => $ciFolder,
                'status' => InviteStatus::COMPLETED()->value(),
                'class' => InviteClass::PUB()->value(),
                'url' => $url,
                'ex' => true,
                'ridZ' => $ridZ,
                'allDay' => true,
                'draft' => true,
                'neverSent' => true,
                'changes' => $subject . ',' . $location . ',' . $time,
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }
}
