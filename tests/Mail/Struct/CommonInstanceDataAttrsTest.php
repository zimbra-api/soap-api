<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Enum\{FreeBusyStatus, InviteClass, InviteStatus, ParticipationStatus, Transparency};
use Zimbra\Mail\Struct\CommonInstanceDataAttrs;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CommonInstanceDataAttrs.
 */
class CommonInstanceDataAttrsTest extends ZimbraTestCase
{
    public function testCommonInstanceDataAttrs()
    {
        $partStat = ParticipationStatus::ACCEPT();
        $recurIdZ = $this->faker->uuid;
        $tzOffset = $this->faker->randomNumber;
        $freeBusyActual = FreeBusyStatus::FREE();
        $taskPercentComplete = $this->faker->word;
        $priority = $this->faker->word;
        $freeBusyIntended = FreeBusyStatus::BUSY();
        $transparency = Transparency::TRANSPARENT();
        $name = $this->faker->word;
        $location = $this->faker->word;
        $invId = $this->faker->uuid;
        $recurIdZ = $this->faker->uuid;
        $componentNum = $this->faker->randomNumber;
        $status = InviteStatus::CONFIRMED();
        $calClass = InviteClass::PUB();
        $taskDueDate = $this->faker->randomNumber;
        $taskTzOffsetDue = $this->faker->randomNumber;
 
        $data = new CommonInstanceDataAttrs(
            $partStat, $recurIdZ, $tzOffset, $freeBusyActual, $taskPercentComplete, FALSE, FALSE, $priority,
            $freeBusyIntended, $transparency, $name, $location, FALSE, FALSE, FALSE, $invId, $componentNum,
            $status, $calClass, FALSE, FALSE, FALSE, $taskDueDate, $taskTzOffsetDue
        );
        $this->assertSame($partStat, $data->getPartStat());
        $this->assertSame($recurIdZ, $data->getRecurIdZ());
        $this->assertSame($tzOffset, $data->getTzOffset());
        $this->assertSame($freeBusyActual, $data->getFreeBusyActual());
        $this->assertSame($taskPercentComplete, $data->getTaskPercentComplete());
        $this->assertFalse($data->getIsRecurring());
        $this->assertFalse($data->getHasExceptions());
        $this->assertSame($priority, $data->getPriority());
        $this->assertSame($freeBusyIntended, $data->getFreeBusyIntended());
        $this->assertSame($transparency, $data->getTransparency());
        $this->assertSame($name, $data->getName());
        $this->assertSame($location, $data->getLocation());
        $this->assertFalse($data->getHasOtherAttendees());
        $this->assertFalse($data->getHasAlarm());
        $this->assertFalse($data->getIsOrganizer());
        $this->assertSame($invId, $data->getInvId());
        $this->assertSame($componentNum, $data->getComponentNum());
        $this->assertSame($status, $data->getStatus());
        $this->assertSame($calClass, $data->getCalClass());
        $this->assertFalse($data->getAllDay());
        $this->assertFalse($data->getDraft());
        $this->assertFalse($data->getNeverSent());
        $this->assertSame($taskDueDate, $data->getTaskDueDate());
        $this->assertSame($taskTzOffsetDue, $data->getTaskTzOffsetDue());

        $data = new CommonInstanceDataAttrs();
        $data->setPartStat($partStat)
             ->setRecurIdZ($recurIdZ)
             ->setTzOffset($tzOffset)
             ->setFreeBusyActual($freeBusyActual)
             ->setTaskPercentComplete($taskPercentComplete)
             ->setIsRecurring(TRUE)
             ->setHasExceptions(TRUE)
             ->setPriority($priority)
             ->setFreeBusyIntended($freeBusyIntended)
             ->setTransparency($transparency)
             ->setName($name)
             ->setLocation($location)
             ->setHasOtherAttendees(TRUE)
             ->setHasAlarm(TRUE)
             ->setIsOrganizer(TRUE)
             ->setInvId($invId)
             ->setComponentNum($componentNum)
             ->setStatus($status)
             ->setCalClass($calClass)
             ->setAllDay(TRUE)
             ->setDraft(TRUE)
             ->setNeverSent(TRUE)
             ->setTaskDueDate($taskDueDate)
             ->setTaskTzOffsetDue($taskTzOffsetDue);
        $this->assertSame($partStat, $data->getPartStat());
        $this->assertSame($recurIdZ, $data->getRecurIdZ());
        $this->assertSame($tzOffset, $data->getTzOffset());
        $this->assertSame($freeBusyActual, $data->getFreeBusyActual());
        $this->assertSame($taskPercentComplete, $data->getTaskPercentComplete());
        $this->assertTrue($data->getIsRecurring());
        $this->assertTrue($data->getHasExceptions());
        $this->assertSame($priority, $data->getPriority());
        $this->assertSame($freeBusyIntended, $data->getFreeBusyIntended());
        $this->assertSame($transparency, $data->getTransparency());
        $this->assertSame($name, $data->getName());
        $this->assertSame($location, $data->getLocation());
        $this->assertTrue($data->getHasOtherAttendees());
        $this->assertTrue($data->getHasAlarm());
        $this->assertTrue($data->getIsOrganizer());
        $this->assertSame($invId, $data->getInvId());
        $this->assertSame($componentNum, $data->getComponentNum());
        $this->assertSame($status, $data->getStatus());
        $this->assertSame($calClass, $data->getCalClass());
        $this->assertTrue($data->getAllDay());
        $this->assertTrue($data->getDraft());
        $this->assertTrue($data->getNeverSent());
        $this->assertSame($taskDueDate, $data->getTaskDueDate());
        $this->assertSame($taskTzOffsetDue, $data->getTaskTzOffsetDue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result ptst="AC" ridZ="$recurIdZ" tzo="$tzOffset" fba="F" percentComplete="$taskPercentComplete" recur="true" hasEx="true" priority="$priority" fb="B" transp="T" name="$name" loc="$location" otherAtt="true" alarm="true" isOrg="true" invId="$invId" compNum="$componentNum" status="CONF" class="PUB" allDay="true" draft="true" neverSent="true" dueDate="$taskDueDate" tzoDue="$taskTzOffsetDue" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($data, 'xml'));
        $this->assertEquals($data, $this->serializer->deserialize($xml, CommonInstanceDataAttrs::class, 'xml'));
    }
}
