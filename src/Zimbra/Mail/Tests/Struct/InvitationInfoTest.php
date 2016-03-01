<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;

/**
 * Testcase class for InvitationInfo.
 */
class InvitationInfoTest extends ZimbraMailTestCase
{
    public function testInvitationInfo()
    {
        $id = $this->faker->word;
        $mid = $this->faker->word;
        $part = $this->faker->word;
        $path = $this->faker->word;
        $ct = $this->faker->word;
        $content = $this->faker->word;
        $ci = $this->faker->word;
        $uid = $this->faker->word;
        $value = $this->faker->word;
        $summary = $this->faker->word;
        $stdname = $this->faker->word;
        $dayname = $this->faker->word;
        $aid = $this->faker->word;
        $method = $this->faker->word;
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $compNum = mt_rand(1, 10);
        $ver = mt_rand(1, 10);

        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec($mid, $part, true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec($id, false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec($id, false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec($path, $id, $ver, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(null, $ct, $content, $ci);

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $mday = mt_rand(1, 31);
        $week = mt_rand(1, 4);
        $wkday = mt_rand(1, 7);

        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec, $mday, $week, $wkday);

        $raw_content = new \Zimbra\Mail\Struct\RawInvite($uid, $value, $summary);
        $tz = new \Zimbra\Mail\Struct\CalTZInfo($id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname);
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($aid, [$mp, $m, $cn, $doc]);
        $mp = new \Zimbra\Mail\Struct\MimePartInfo($attach, $ct, $content, $ci, [$info]);
        $comp = new \Zimbra\Mail\Struct\InviteComponent($method, $compNum, true);

        $inv = new \Zimbra\Mail\Struct\InvitationInfo(
            $method,
            $compNum,
            true
        );

        $inv->setContent($raw_content)
            ->setInviteComponent($comp)
            ->addTimezone($tz)
            ->addMimePart($mp)
            ->setAttachments($attach)
            ->setId($id)
            ->setContentType($ct)
            ->setContentId($ci);

        $this->assertSame($raw_content, $inv->getContent());
        $this->assertSame($comp, $inv->getInviteComponent());
        $this->assertSame([$tz], $inv->getTimezones()->all());
        $this->assertSame([$mp], $inv->getMimeParts()->all());
        $this->assertSame($attach, $inv->getAttachments());
        $this->assertSame($id, $inv->getId());
        $this->assertSame($ct, $inv->getContentType());
        $this->assertSame($ci, $inv->getContentId());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<inv method="' . $method . '" compNum="' . $compNum . '" rsvp="true" id="' . $id . '" ct="' . $ct . '" ci="' . $ci . '">'
                .'<content uid="' . $uid . '" summary="' . $summary . '">' . $value . '</content>'
                .'<comp method="' . $method . '" compNum="' . $compNum . '" rsvp="true" />'
                .'<attach aid="' . $aid . '">'
                    .'<mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                    .'<m optional="false" id="' . $id . '" />'
                    .'<cn optional="false" id="' . $id . '" />'
                    .'<doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                .'</attach>'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                    . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" mday="' . $mday . '" week="' . $week . '" wkday="' . $wkday . '" />'
                    . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" mday="' . $mday . '" week="' . $week . '" wkday="' . $wkday . '" />'
                .'</tz>'
                .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '">'
                    .'<attach aid="' . $aid . '">'
                        .'<mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                        .'<m optional="false" id="' . $id . '" />'
                        .'<cn optional="false" id="' . $id . '" />'
                        .'<doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                    .'</attach>'
                    .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '" />'
                .'</mp>'
            .'</inv>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inv);

        $array = [
            'inv' => [
                'method' => $method,
                'compNum' => $compNum,
                'rsvp' => true,
                'id' => $id,
                'ct' => $ct,
                'ci' => $ci,
                'content' => [
                    '_content' => $value,
                    'uid' => $uid,
                    'summary' => $summary,
                ],
                'comp' => [
                    'method' => $method,
                    'compNum' => $compNum,
                    'rsvp' => true,
                ],
                'tz' => [
                    [
                        'id' => $id,
                        'stdoff' => $stdoff,
                        'dayoff' => $dayoff,
                        'stdname' => $stdname,
                        'dayname' => $dayname,
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
                'mp' => [
                    [
                        'ct' => $ct,
                        'content' => $content,
                        'ci' => $ci,
                        'mp' => [
                            [
                                'ct' => $ct,
                                'content' => $content,
                                'ci' => $ci,
                            ],
                        ],
                        'attach' => [
                            'aid' => $aid,
                            'mp' => [
                                'mid' => $mid,
                                'part' => $part,
                                'optional' => true,
                            ],
                            'm' => [
                                'id' => $id,
                                'optional' => false,
                            ],
                            'cn' => [
                                'id' => $id,
                                'optional' => false,
                            ],
                            'doc' => [
                                'path' => $path,
                                'id' => $id,
                                'ver' => $ver,
                                'optional' => true,
                            ],
                        ],
                    ],
                ],
                'attach' => [
                    'aid' => $aid,
                    'mp' => [
                        'mid' => $mid,
                        'part' => $part,
                        'optional' => true,
                    ],
                    'm' => [
                        'id' => $id,
                        'optional' => false,
                    ],
                    'cn' => [
                        'id' => $id,
                        'optional' => false,
                    ],
                    'doc' => [
                        'path' => $path,
                        'id' => $id,
                        'ver' => $ver,
                        'optional' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $inv->toArray());
    }
}
