<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\FreeBusyStatus;
use Zimbra\Common\Enum\InviteChange;
use Zimbra\Common\Enum\InviteClass;
use Zimbra\Common\Enum\InviteStatus;
use Zimbra\Common\Enum\Transparency;
use Zimbra\Mail\Struct\InviteComponentCommon;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteComponentCommon.
 */
class InviteComponentCommonTest extends ZimbraTestCase
{
    public function testInviteComponentCommon()
    {
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;
        $priority = (string) mt_rand(0, 9);
        $name = $this->faker->word;
        $location = $this->faker->word;
        $percentComplete = $this->faker->word;
        $completed = $this->faker->word;
        $freeBusyActual = FreeBusyStatus::FREE;
        $freeBusy = FreeBusyStatus::BUSY;
        $transparency = Transparency::OPAQUE;
        $xUid = $this->faker->uuid;
        $uid = $this->faker->uuid;
        $sequence = $this->faker->randomNumber;
        $dateTime = $this->faker->unixTime;
        $calItemId = $this->faker->uuid;
        $deprecatedApptId = $this->faker->uuid;
        $calItemFolder = $this->faker->word;
        $status = InviteStatus::CONFIRMED;
        $calClass = InviteClass::PUB;
        $url = $this->faker->url;
        $recurIdZ = $this->faker->word;
        $changes = implode(',', array_map(fn ($change) => $change->value, $this->faker->randomElements(InviteChange::cases(), 2)));

        $inv = new InviteComponentCommon(
            $method,
            $componentNum,
            FALSE,
            $priority,
            $name,
            $location,
            $percentComplete,
            $completed,
            FALSE,
            $freeBusyActual,
            $freeBusy,
            $transparency,
            FALSE,
            $xUid,
            $uid,
            $sequence,
            $dateTime,
            $calItemId,
            $deprecatedApptId,
            $calItemFolder,
            $status,
            $calClass,
            $url,
            FALSE,
            $recurIdZ,
            FALSE,
            FALSE,
            FALSE,
            $changes
        );
        $this->assertSame($method, $inv->getMethod());
        $this->assertSame($componentNum, $inv->getComponentNum());
        $this->assertFalse($inv->getRsvp());
        $this->assertSame($priority, $inv->getPriority());
        $this->assertSame($name, $inv->getName());
        $this->assertSame($location, $inv->getLocation());
        $this->assertSame($percentComplete, $inv->getPercentComplete());
        $this->assertSame($completed, $inv->getCompleted());
        $this->assertFalse($inv->getNoBlob());
        $this->assertSame($freeBusyActual, $inv->getFreeBusyActual());
        $this->assertSame($freeBusy, $inv->getFreeBusy());
        $this->assertSame($transparency, $inv->getTransparency());
        $this->assertFalse($inv->getIsOrganizer());
        $this->assertSame($xUid, $inv->getXUid());
        $this->assertSame($uid, $inv->getUid());
        $this->assertSame($sequence, $inv->getSequence());
        $this->assertSame($dateTime, $inv->getDateTime());
        $this->assertSame($calItemId, $inv->getCalItemId());
        $this->assertSame($deprecatedApptId, $inv->getDeprecatedApptId());
        $this->assertSame($calItemFolder, $inv->getCalItemFolder());
        $this->assertSame($status, $inv->getStatus());
        $this->assertSame($calClass, $inv->getCalClass());
        $this->assertSame($url, $inv->getUrl());
        $this->assertFalse($inv->getIsException());
        $this->assertSame($recurIdZ, $inv->getRecurIdZ());
        $this->assertFalse($inv->getIsAllDay());
        $this->assertFalse($inv->getIsDraft());
        $this->assertFalse($inv->getNeverSent());
        $this->assertSame($changes, $inv->getChanges());

        $inv = new InviteComponentCommon();
        $inv->setMethod($method)
            ->setComponentNum($componentNum)
            ->setRsvp(TRUE)
            ->setPriority($priority)
            ->setName($name)
            ->setLocation($location)
            ->setPercentComplete($percentComplete)
            ->setCompleted($completed)
            ->setNoBlob(TRUE)
            ->setFreeBusyActual($freeBusyActual)
            ->setFreeBusy($freeBusy)
            ->setTransparency($transparency)
            ->setIsOrganizer(TRUE)
            ->setXUid($xUid)
            ->setUid($uid)
            ->setSequence($sequence)
            ->setDateTime($dateTime)
            ->setCalItemId($calItemId)
            ->setDeprecatedApptId($deprecatedApptId)
            ->setCalItemFolder($calItemFolder)
            ->setStatus($status)
            ->setCalClass($calClass)
            ->setUrl($url)
            ->setIsException(TRUE)
            ->setRecurIdZ($recurIdZ)
            ->setIsAllDay(TRUE)
            ->setIsDraft(TRUE)
            ->setNeverSent(TRUE)
            ->setChanges($changes);
        $this->assertSame($method, $inv->getMethod());
        $this->assertSame($componentNum, $inv->getComponentNum());
        $this->assertTrue($inv->getRsvp());
        $this->assertSame($priority, $inv->getPriority());
        $this->assertSame($name, $inv->getName());
        $this->assertSame($location, $inv->getLocation());
        $this->assertSame($percentComplete, $inv->getPercentComplete());
        $this->assertSame($completed, $inv->getCompleted());
        $this->assertTrue($inv->getNoBlob());
        $this->assertSame($freeBusyActual, $inv->getFreeBusyActual());
        $this->assertSame($freeBusy, $inv->getFreeBusy());
        $this->assertSame($transparency, $inv->getTransparency());
        $this->assertTrue($inv->getIsOrganizer());
        $this->assertSame($xUid, $inv->getXUid());
        $this->assertSame($uid, $inv->getUid());
        $this->assertSame($sequence, $inv->getSequence());
        $this->assertSame($dateTime, $inv->getDateTime());
        $this->assertSame($calItemId, $inv->getCalItemId());
        $this->assertSame($deprecatedApptId, $inv->getDeprecatedApptId());
        $this->assertSame($calItemFolder, $inv->getCalItemFolder());
        $this->assertSame($status, $inv->getStatus());
        $this->assertSame($calClass, $inv->getCalClass());
        $this->assertSame($url, $inv->getUrl());
        $this->assertTrue($inv->getIsException());
        $this->assertSame($recurIdZ, $inv->getRecurIdZ());
        $this->assertTrue($inv->getIsAllDay());
        $this->assertTrue($inv->getIsDraft());
        $this->assertTrue($inv->getNeverSent());
        $this->assertSame($changes, $inv->getChanges());

        $xml = <<<EOT
<?xml version="1.0"?>
<result method="$method" compNum="$componentNum" rsvp="true" priority="$priority" name="$name" loc="$location" percentComplete="$percentComplete" completed="$completed" noBlob="true" fba="F" fb="B" transp="O" isOrg="true" x_uid="$xUid" uid="$uid" seq="$sequence" d="$dateTime" calItemId="$calItemId" apptId="$deprecatedApptId" ciFolder="$calItemFolder" status="CONF" class="PUB" url="$url" ex="true" ridZ="$recurIdZ" allDay="true" draft="true" neverSent="true" changes="$changes" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, InviteComponentCommon::class, 'xml'));
    }
}
