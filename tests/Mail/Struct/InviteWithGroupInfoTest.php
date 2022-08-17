<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\InviteType;

use Zimbra\Mail\Struct\CalendarReply;
use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\InviteComponentWithGroupInfo;
use Zimbra\Mail\Struct\InviteWithGroupInfo;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for InviteWithGroupInfo.
 */
class InviteWithGroupInfoTest extends ZimbraTestCase
{
    public function testInviteWithGroupInfo()
    {
        $calItemType = InviteType::TASK();
        $id = $this->faker->word;
        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $method = $this->faker->word;
        $componentNum = $this->faker->randomNumber;

        $seq = $this->faker->randomNumber;
        $date = $this->faker->unixTime;
        $attendee = $this->faker->email;
        $rangeType = $this->faker->numberBetween(1, 3);
        $recurId = $this->faker->uuid;

        $timezone = new CalTZInfo($id, $tzStdOffset, $tzDayOffset);
        $inviteComponent = new InviteComponentWithGroupInfo($method, $componentNum, TRUE);
        $calendarReply = new CalendarReply($rangeType, $recurId, $seq, $date, $attendee);

        $inv = new StubInviteWithGroupInfo(
            $calItemType, [$timezone], [$inviteComponent], [$calendarReply]
        );
        $this->assertSame($calItemType, $inv->getCalItemType());
        $this->assertSame([$timezone], $inv->getTimezones());
        $this->assertSame([$inviteComponent], $inv->getInviteComponents());
        $this->assertSame([$calendarReply], $inv->getCalendarReplies());

        $inv = new StubInviteWithGroupInfo();
        $inv->setCalItemType($calItemType)
            ->setTimezones([$timezone])
            ->addTimezone($timezone)
            ->setInviteComponents([$inviteComponent])
            ->addInviteComponent($inviteComponent)
            ->setCalendarReplies([$calendarReply])
            ->addCalendarReply($calendarReply);
        $this->assertSame($calItemType, $inv->getCalItemType());
        $this->assertSame([$timezone, $timezone], $inv->getTimezones());
        $this->assertSame([$inviteComponent, $inviteComponent], $inv->getInviteComponents());
        $this->assertSame([$calendarReply, $calendarReply], $inv->getCalendarReplies());
        $inv->setTimezones([$timezone])
            ->setInviteComponents([$inviteComponent])
            ->setCalendarReplies([$calendarReply]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="task" xmlns:urn="urn:zimbraMail">
    <urn:tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" />
    <urn:comp method="$method" compNum="$componentNum" rsvp="true" />
    <urn:replies>
        <urn:reply rangeType="$rangeType" recurId="$recurId" seq="$seq" d="$date" at="$attendee" />
    </urn:replies>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($inv, 'xml'));
        $this->assertEquals($inv, $this->serializer->deserialize($xml, StubInviteWithGroupInfo::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraMail', prefix: 'urn')]
class StubInviteWithGroupInfo extends InviteWithGroupInfo
{
}
