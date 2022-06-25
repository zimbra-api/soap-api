<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Common\Struct\TzOnsetInfo;

use Zimbra\Mail\Struct\CalTZInfo;
use Zimbra\Mail\Struct\Invitation;
use Zimbra\Mail\Struct\PartInfo;
use Zimbra\Mail\Struct\ShareNotification;
use Zimbra\Mail\Struct\DLSubscriptionNotification;
use Zimbra\Mail\Struct\InviteComponent;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Invitation.
 */
class InvitationTest extends ZimbraTestCase
{
    public function testInvitation()
    {
        $calItemType = $this->faker->word;
        $sequence = $this->faker->randomNumber;
        $id = $this->faker->uuid;
        $intId = $this->faker->randomNumber;
        $componentNum = $this->faker->randomNumber;
        $recurrenceId = $this->faker->uuid;

        $tzStdOffset = $this->faker->randomNumber;
        $tzDayOffset = $this->faker->randomNumber;
        $standardTZName = $this->faker->word;
        $daylightTZName = $this->faker->word;

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $method = $this->faker->word;
        $part = $this->faker->word;
        $contentType = $this->faker->mimeType;
        $size = $this->faker->randomNumber;
        $contentDisposition = $this->faker->word;
        $contentFilename = $this->faker->word;
        $contentId = $this->faker->word;
        $location = $this->faker->word;
        $content = $this->faker->text;

        $standardTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylightTzOnset = new TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $tz = new CalTZInfo(
            $id, $tzStdOffset, $tzDayOffset, $standardTzOnset, $daylightTzOnset, $standardTZName, $daylightTZName
        );
        $comp = new InviteComponent($method, $componentNum, TRUE);

        $mimePart = new PartInfo($part, $contentType);
        $mp = new PartInfo(
            $part, $contentType, $size, $contentDisposition, $contentFilename, $contentId, $location, TRUE, TRUE, $content, [$mimePart]
        );
        $shr = new ShareNotification(TRUE, $content);
        $dlSubs = new DLSubscriptionNotification(TRUE, $content);

        $invite = new Invitation(
            $calItemType, $sequence, $intId, $componentNum, $recurrenceId, [$tz], $comp, [$mp], [$shr], [$dlSubs]
        );
        $this->assertSame($calItemType, $invite->getCalItemType());
        $this->assertSame($sequence, $invite->getSequence());
        $this->assertSame($intId, $invite->getId());
        $this->assertSame($componentNum, $invite->getComponentNum());
        $this->assertSame($recurrenceId, $invite->getRecurrenceId());
        $this->assertSame([$tz], $invite->getTimezones());
        $this->assertSame($comp, $invite->getInviteComponent());
        $this->assertSame([$mp], $invite->getPartInfos());
        $this->assertSame([$shr], $invite->getShareNotifications());
        $this->assertSame([$dlSubs], $invite->getDlSubs());

        $invite = new Invitation('', 0, 0, 0);
        $invite->setCalItemType($calItemType)
            ->setSequence($sequence)
            ->setId($intId)
            ->setComponentNum($componentNum)
            ->setRecurrenceId($recurrenceId)
            ->setTimezones([$tz])
            ->addTimezone($tz)
            ->setInviteComponent($comp)
            ->setPartInfos([$mp])
            ->addPartInfo($mp)
            ->setShareNotifications([$shr])
            ->addShareNotification($shr)
            ->setDlSubs([$dlSubs])
            ->addDlSub($dlSubs);
        $this->assertSame($calItemType, $invite->getCalItemType());
        $this->assertSame($sequence, $invite->getSequence());
        $this->assertSame($intId, $invite->getId());
        $this->assertSame($componentNum, $invite->getComponentNum());
        $this->assertSame($recurrenceId, $invite->getRecurrenceId());
        $this->assertSame([$tz, $tz], $invite->getTimezones());
        $this->assertSame($comp, $invite->getInviteComponent());
        $this->assertSame([$mp, $mp], $invite->getPartInfos());
        $this->assertSame([$shr, $shr], $invite->getShareNotifications());
        $this->assertSame([$dlSubs, $dlSubs], $invite->getDlSubs());
        $invite->setTimezones([$tz])
            ->setPartInfos([$mp])
            ->setShareNotifications([$shr])
            ->setDlSubs([$dlSubs]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$calItemType" seq="$sequence" id="$intId" compNum="$componentNum" recurId="$recurrenceId">
    <tz id="$id" stdoff="$tzStdOffset" dayoff="$tzDayOffset" stdname="$standardTZName" dayname="$daylightTZName">
        <standard mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
        <daylight mon="$mon" hour="$hour" min="$min" sec="$sec" mday="$mday" week="$week" wkday="$wkday" />
    </tz>
    <comp method="$method" compNum="$componentNum" rsvp="true" />
    <mp part="$part" ct="$contentType" s="$size" cd="$contentDisposition" filename="$contentFilename" ci="$contentId" cl="$location" body="true" truncated="true">
        <content>$content</content>
        <mp part="$part" ct="$contentType" />
    </mp>
    <shr truncated="true">
        <content>$content</content>
    </shr>
    <dlSubs truncated="true">
        <content>$content</content>
    </dlSubs>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($invite, 'xml'));
        $this->assertEquals($invite, $this->serializer->deserialize($xml, Invitation::class, 'xml'));

        $json = json_encode([
            'type' => $calItemType,
            'seq' => $sequence,
            'id' => $intId,
            'compNum' => $componentNum,
            'recurId' => $recurrenceId,
            'tz' => [
                [
                    'id' => $id,
                    'stdoff' => $tzStdOffset,
                    'dayoff' => $tzDayOffset,
                    'stdname' => $standardTZName,
                    'dayname' => $daylightTZName,
                    'standard' => [
                        'mon' => $mon,
                        'hour' => $hour,
                        'min' => $min,
                        'sec' => $sec,
                        'mday' => $mday,
                        'week' => $week,
                        'wkday' => $wkday,
                    ],
                    'daylight' => [
                        'mon' => $mon,
                        'hour' => $hour,
                        'min' => $min,
                        'sec' => $sec,
                        'mday' => $mday,
                        'week' => $week,
                        'wkday' => $wkday,
                    ],
                ],
            ],
            'comp' => [
                'method' => $method,
                'compNum' => $componentNum,
                'rsvp' => TRUE,
            ],
            'mp' => [
                [
                    'part' => $part,
                    'ct' => $contentType,
                    's' => $size,
                    'cd' => $contentDisposition,
                    'filename' => $contentFilename,
                    'ci' => $contentId,
                    'cl' => $location,
                    'body' => TRUE,
                    'truncated' => TRUE,
                    'content' => [
                        '_content' => $content,
                    ],
                    'mp' => [
                        [
                            'part' => $part,
                            'ct' => $contentType,
                        ],
                    ],
                ],
            ],
            'shr' => [
                [
                    'truncated' => TRUE,
                    'content' => [
                        '_content' => $content,
                    ],
                ],
            ],
            'dlSubs' => [
                [
                    'truncated' => TRUE,
                    'content' => [
                        '_content' => $content,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($invite, 'json'));
        $this->assertEquals($invite, $this->serializer->deserialize($json, Invitation::class, 'json'));
    }
}
