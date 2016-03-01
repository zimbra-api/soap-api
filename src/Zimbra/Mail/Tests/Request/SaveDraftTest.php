<?php

namespace Zimbra\Admin\Tests\Request;

use Zimbra\Mail\Tests\ZimbraMailApiTestCase;
use Zimbra\Enum\AddressType;
use Zimbra\Enum\ReplyType;
use Zimbra\Mail\Request\SaveDraft;
use Zimbra\Mail\Struct\SaveDraftMsg;

/**
 * Testcase class for SaveDraft.
 */
class SaveDraftTest extends ZimbraMailApiTestCase
{
    public function testSaveDraftRequest()
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
        $did = $this->faker->word;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $t = $this->faker->word;
        $tn = $this->faker->word;
        $forAcct = $this->faker->word;
        $rgb = $this->faker->hexcolor;

        $msg_id = mt_rand(1, 10);
        $compNum = mt_rand(1, 100);
        $ver = mt_rand(1, 100);
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $color = mt_rand(1, 128);
        $autoSendTime = mt_rand(1, 100);

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

        $m = new SaveDraftMsg(
          $content,
          $mp,
          $attach,
          $inv,
          $fr,
          $msg_id,
          $forAcct,
          $t,
          $tn,
          $rgb,
          $color,
          $autoSendTime,
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

        $req = new SaveDraft(
            $m
        );
        $this->assertSame($m, $req->getMsg());

        $req = new SaveDraft(
            new SaveDraftMsg()
        );
        $req->setMsg($m);
        $this->assertSame($m, $req->getMsg());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDraftRequest>'
                .'<m id="' . $msg_id . '" forAcct="' . $forAcct . '" t="' . $t . '" tn="' . $tn . '" rgb="' . $rgb . '" color="' . $color . '" autoSendTime="'. $autoSendTime . '" aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
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
                .'</m>'
            .'</SaveDraftRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SaveDraftRequest' => array(
                '_jsns' => 'urn:zimbraMail',
                'm' => array(
                    'id' => $msg_id,
                    'forAcct' => $forAcct,
                    't' => $t,
                    'tn' => $tn,
                    'rgb' => $rgb,
                    'color' => $color,
                    'autoSendTime' => $autoSendTime,
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
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDraftApi()
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
        $did = $this->faker->word;
        $origid = $this->faker->uuid;
        $idnt = $this->faker->word;
        $su = $this->faker->word;
        $irt = $this->faker->word;
        $l = $this->faker->word;
        $f = $this->faker->word;
        $t = $this->faker->word;
        $tn = $this->faker->word;
        $forAcct = $this->faker->word;
        $rgb = $this->faker->hexcolor;

        $msg_id = mt_rand(1, 10);
        $compNum = mt_rand(1, 100);
        $ver = mt_rand(1, 100);
        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $stdoff = mt_rand(1, 10);
        $dayoff = mt_rand(1, 10);
        $color = mt_rand(1, 128);
        $autoSendTime = mt_rand(1, 100);

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

        $m = new SaveDraftMsg(
          $content,
          $mp,
          $attach,
          $inv,
          $fr,
          $msg_id,
          $forAcct,
          $t,
          $tn,
          $rgb,
          $color,
          $autoSendTime,
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
        $this->api->saveDraft(
            $m
        );

        $client = $this->api->getClient();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SaveDraftRequest>'
                        .'<urn1:m id="' . $msg_id . '" forAcct="' . $forAcct . '" t="' . $t . '" tn="' . $tn . '" rgb="' . $rgb . '" color="' . $color . '" autoSendTime="'. $autoSendTime . '" aid="' . $aid . '" origid="' . $origid . '" rt="' . ReplyType::REPLIED() . '" idnt="' . $idnt . '" su="' . $su . '" irt="' . $irt . '" l="' . $l . '" f="' . $f . '">'
                            .'<urn1:content>' . $content . '</urn1:content>'
                            .'<urn1:mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '">'
                                .'<urn1:attach aid="' . $aid . '">'
                                    .'<urn1:mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                                    .'<urn1:m optional="false" id="' . $id . '" />'
                                    .'<urn1:cn optional="false" id="' . $id . '" />'
                                    .'<urn1:doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="' . $ct . '" content="' . $content . '" ci="' . $ci . '" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="' . $aid . '">'
                                .'<urn1:mp optional="true" mid="' . $mid . '" part="' . $part . '" />'
                                .'<urn1:m optional="false" id="' . $id . '" />'
                                .'<urn1:cn optional="false" id="' . $id . '" />'
                                .'<urn1:doc optional="true" path="' . $path . '" id="' . $id . '" ver="' . $ver . '" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="' . $method . '" compNum="' . $compNum . '" rsvp="true" />'
                            .'<urn1:fr>' . $fr . '</urn1:fr>'
                            .'<urn1:header name="' . $name . '">' . $value . '</urn1:header>'
                            .'<urn1:e a="' . $address . '" t="' . AddressType::FROM() . '" p="' . $personal . '" />'
                            .'<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                                .'<urn1:standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                .'<urn1:daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                            .'</urn1:tz>'
                            .'<urn1:any />'
                        .'</urn1:m>'
                    .'</urn1:SaveDraftRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}
