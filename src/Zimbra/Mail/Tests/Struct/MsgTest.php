<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Enum\AddressType;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Struct\Msg;

/**
 * Testcase class for Msg.
 */
class MsgTest extends ZimbraMailTestCase
{
    public function testMsg()
    {
        $mid = $this->faker->uuid;
        $part = $this->faker->word;
        $id = $this->faker->uuid;
        $path = $this->faker->word;
        $ct = $this->faker->word;
        $content = $this->faker->word;
        $ci = $this->faker->uuid;
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $method = $this->faker->word;
        $address = $this->faker->word;
        $personal = $this->faker->word;
        $stdname = $this->faker->word;
        $dayname = $this->faker->word;

        $fr = $this->faker->word;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;

        $compNum = mt_rand(1, 100);
        $ver = mt_rand(1, 100);
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);

        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec($mid, $part, true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec($id, false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec($id, false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec($path, $id, $ver, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(null, $ct, $content, $ci);
        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);

        $header = new \Zimbra\Mail\Struct\Header($name, $value);
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($aid, [$mp, $m, $cn, $doc]);
        $mp = new \Zimbra\Mail\Struct\MimePartInfo($attach, $ct, $content, $ci, [$info]);
        $inv = new \Zimbra\Mail\Struct\InvitationInfo($method, $compNum, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo($address, AddressType::FROM(), $personal);
        $tz = new \Zimbra\Mail\Struct\CalTZInfo(
            $id, $stdoff, $dayoff, $standard, $daylight, $stdname, $dayname
        );
        $any = $this->getMockForAbstractClass('Zimbra\Struct\Base');

        $m = new Msg(
            $content,
            $mp,
            $attach,
            $inv,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f,
            [$header],
            [$e],
            [$tz],
            [$any]
        );

        $this->assertSame($content, $m->getContent());
        $this->assertSame($mp, $m->getMimePart());
        $this->assertSame($attach, $m->getAttachments());
        $this->assertSame($inv, $m->getInvite());
        $this->assertSame($fr, $m->getFragment());
        $this->assertSame($aid, $m->getAttachmentId());
        $this->assertSame($origid, $m->getOrigId());
        $this->assertSame('r', $m->getReplyType()->value());
        $this->assertSame($idnt, $m->getIdentityId());
        $this->assertSame($su, $m->getSubject());
        $this->assertSame($irt, $m->getInReplyTo());
        $this->assertSame($l, $m->getFolderId());
        $this->assertSame($f, $m->getFlags());
        $this->assertSame([$header], $m->getHeaders()->all());
        $this->assertSame([$e], $m->getEmails()->all());
        $this->assertSame([$tz], $m->getTimezones()->all());
        $this->assertSame([$any], $m->getExtras()->all());

        $m->setContent($content)
          ->setMimePart($mp)
          ->setAttachments($attach)
          ->setInvite($inv)
          ->setFragment($fr)
          ->setAttachmentId($aid)
          ->setOrigId($origid)
          ->setReplyType(ReplyType::REPLIED())
          ->setIdentityId($idnt)
          ->setSubject($su)
          ->setInReplyTo($irt)
          ->setFolderId($l)
          ->setFlags($f)
          ->addHeader($header)
          ->addEmail($e)
          ->addTimezone($tz)
          ->addExtra($any);
        $this->assertSame($content, $m->getContent());
        $this->assertSame($mp, $m->getMimePart());
        $this->assertSame($attach, $m->getAttachments());
        $this->assertSame($inv, $m->getInvite());
        $this->assertSame($fr, $m->getFragment());
        $this->assertSame($aid, $m->getAttachmentId());
        $this->assertSame($origid, $m->getOrigId());
        $this->assertSame('r', $m->getReplyType()->value());
        $this->assertSame($idnt, $m->getIdentityId());
        $this->assertSame($su, $m->getSubject());
        $this->assertSame($irt, $m->getInReplyTo());
        $this->assertSame($l, $m->getFolderId());
        $this->assertSame($f, $m->getFlags());
        $this->assertSame([$header, $header], $m->getHeaders()->all());
        $this->assertSame([$e, $e], $m->getEmails()->all());
        $this->assertSame([$tz, $tz], $m->getTimezones()->all());
        $this->assertSame([$any, $any], $m->getExtras()->all());

        $m = new \Zimbra\Mail\Struct\Msg(
            $content,
            $mp,
            $attach,
            $inv,
            $fr,
            $aid,
            $origid,
            ReplyType::REPLIED(),
            $idnt,
            $su,
            $irt,
            $l,
            $f,
            [$header],
            [$e],
            [$tz],
            [$any]
        );

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<m aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                .'<content>' . $content . '</content>'
                .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '">'
                    .'<attach aid="' . $aid . '">'
                        .'<mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                        .'<m optional="false" id="' . $id . '" />'
                        .'<cn optional="false" id="' . $id . '" />'
                        .'<doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                    .'</attach>'
                    .'<mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '" />'
                .'</mp>'
                .'<attach aid="' . $aid . '">'
                    .'<mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                    .'<m optional="false" id="' . $id . '" />'
                    .'<cn optional="false" id="' . $id . '" />'
                    .'<doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                .'</attach>'
                .'<inv method="' . $method . '" compNum="' . $compNum . '" rsvp="true" />'
                .'<fr>' . $fr . '</fr>'
                .'<header name="' . $name . '">' . $value . '</header>'
                .'<e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
                .'<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                    .'<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                    .'<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                .'</tz>'
                .'<any />'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'aid' => $aid,
                'origid' => $origid,
                'rt' => ReplyType::REPLIED()->value(),
                'idnt' => $idnt,
                'su' => $su,
                'irt' => $irt,
                'l' => $l,
                'f' => $f,
                'content' => $content,
                'fr' => $fr,
                'header' => array(
                    array(
                        'name' => $name,
                        '_content' => $value,
                    ),
                ),
                'mp' => array(
                    'ct' => $ct,
                    'content' => $content,
                    'ci' => $ci,
                    'mp' => array(
                        array(
                            'ct' => $ct,
                            'content' => $content,
                            'ci' => $ci,
                        ),
                    ),
                    'attach' => array(
                        'aid' => $aid,
                        'mp' => array(
                            'mid' => $mid,
                            'part' => $part,
                            'optional' => true,
                        ),
                        'm' => array(
                            'id' => $id,
                            'optional' => false,
                        ),
                        'cn' => array(
                            'id' => $id,
                            'optional' => false,
                        ),
                        'doc' => array(
                            'path' => $path,
                            'id' => $id,
                            'ver' => $ver,
                            'optional' => true,
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => $aid,
                    'mp' => array(
                        'mid' => $mid,
                        'part' => $part,
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => $id,
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => $id,
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => $path,
                        'id' => $id,
                        'ver' => $ver,
                        'optional' => true,
                    ),
                ),
                'inv' => array(
                    'method' => $method,
                    'compNum' => $compNum,
                    'rsvp' => true,
                ),
                'e' => array(
                    array(
                        'a' => $address,
                        't' => AddressType::FROM()->value(),
                        'p' => $personal,
                    ),
                ),
                'tz' => array(
                    array(
                        'id' => $id,
                        'stdoff' => $stdoff,
                        'dayoff' => $dayoff,
                        'stdname' => $stdname,
                        'dayname' => $dayname,
                        'standard' => array(
                            'mon' => $mon,
                            'hour' => $hour,
                            'min' => $min,
                            'sec' => $sec,
                        ),
                        'daylight' => array(
                            'mon' => $mon,
                            'hour' => $hour,
                            'min' => $min,
                            'sec' => $sec,
                        ),
                    ),
                ),
                'any' => [
                  []
                ],
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }
}
