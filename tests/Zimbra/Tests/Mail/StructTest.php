<?php

namespace Zimbra\Tests\Mail;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\AlarmAction;
use Zimbra\Enum\ContactActionOp;
use Zimbra\Enum\ConvActionOp;
use Zimbra\Enum\DocumentActionOp;
use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;
use Zimbra\Enum\FilterCondition;
use Zimbra\Enum\FolderActionOp;
use Zimbra\Enum\FreeBusyStatus;
use Zimbra\Enum\Frequency;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Importance;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\InviteChange;
use Zimbra\Enum\InviteClass;
use Zimbra\Enum\InviteStatus;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Enum\MdsConnectionType;
use Zimbra\Enum\MsgActionOp;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\RankingActionOp;
use Zimbra\Enum\SearchType;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TagActionOp;
use Zimbra\Enum\Transparency;
use Zimbra\Enum\Type;
use Zimbra\Enum\WeekDay;

/**
 * Testcase class for mail struct.
 */
class StructTest extends ZimbraTestCase
{
	public function testAccountACEinfo()
	{
        $ace = new \Zimbra\Mail\Struct\AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false
        );
        $this->assertTrue($ace->gt()->is('usr'));
        $this->assertTrue($ace->right()->is('invite'));
        $this->assertSame('zid', $ace->zid());
        $this->assertSame('d', $ace->d());
        $this->assertSame('key', $ace->key());
        $this->assertSame('pw', $ace->pw());
        $this->assertFalse($ace->deny());

        $ace->gt(GranteeType::USR())
            ->right(AceRightType::INVITE())
            ->zid('zid')
            ->d('d')
            ->key('key')
            ->pw('pw')
            ->deny(true);

        $this->assertTrue($ace->gt()->is('usr'));
        $this->assertTrue($ace->right()->is('invite'));
        $this->assertSame('zid', $ace->zid());
        $this->assertSame('d', $ace->d());
        $this->assertSame('key', $ace->key());
        $this->assertSame('pw', $ace->pw());
        $this->assertTrue($ace->deny());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'gt' => 'usr',
                'right' => 'invite',
                'zid' => 'zid',
                'd' => 'd',
                'key' => 'key',
                'pw' => 'pw',
                'deny' => true,
            ),
        );
        $this->assertEquals($array, $ace->toArray());
	}

    public function testActionGrantSelector()
    {
        $grant = new \Zimbra\Mail\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $this->assertSame('perm', $grant->perm());
        $this->assertTrue($grant->gt()->is('usr'));
        $this->assertSame('zid', $grant->zid());
        $this->assertSame('d', $grant->d());
        $this->assertSame('args', $grant->args());
        $this->assertSame('pw', $grant->pw());
        $this->assertSame('key', $grant->key());

        $grant->perm('perm')
              ->gt(GranteeType::USR())
              ->zid('zid')
              ->d('d')
              ->args('args')
              ->pw('pw')
              ->key('key');
        $this->assertSame('perm', $grant->perm());
        $this->assertTrue($grant->gt()->is('usr'));
        $this->assertSame('zid', $grant->zid());
        $this->assertSame('d', $grant->d());
        $this->assertSame('args', $grant->args());
        $this->assertSame('pw', $grant->pw());
        $this->assertSame('key', $grant->key());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grant);

        $array = array(
            'grant' => array(
                'perm' => 'perm',
                'gt' => 'usr',
                'zid' => 'zid',
                'd' => 'd',
                'args' => 'args',
                'pw' => 'pw',
                'key' => 'key',
            ),
        );
        $this->assertEquals($array, $grant->toArray());
    }

    public function testActionSelector()
    {
        $action = new \Zimbra\Mail\Struct\ActionSelector(
            ContactActionOp::MOVE(), 'id', 'tcon', 100, 'l', '#aabbcc', 100, 'name', 'f', 't', 'tn'
        );
        $this->assertSame('id', $action->id());
        $this->assertSame('tcon', $action->tcon());
        $this->assertSame(100, $action->tag());
        $this->assertSame('l', $action->l());
        $this->assertSame('#aabbcc', $action->rgb());
        $this->assertSame(100, $action->color());
        $this->assertSame('name', $action->name());
        $this->assertSame('f', $action->f());
        $this->assertSame('t', $action->t());
        $this->assertSame('tn', $action->tn());

        $action->id('id')
               ->tcon('tcon')
               ->tag(10)
               ->l('l')
               ->rgb('#aabbcc')
               ->color(10)
               ->name('name')
               ->f('f')
               ->t('t')
               ->tn('tn');
        $this->assertSame('id', $action->id());
        $this->assertSame('tcon', $action->tcon());
        $this->assertSame(10, $action->tag());
        $this->assertSame('l', $action->l());
        $this->assertSame('#aabbcc', $action->rgb());
        $this->assertSame(10, $action->color());
        $this->assertSame('name', $action->name());
        $this->assertSame('f', $action->f());
        $this->assertSame('t', $action->t());
        $this->assertSame('tn', $action->tn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testActivityFilter()
    {
        $filter = new \Zimbra\Mail\Struct\ActivityFilter(
            'account', 'op', 'session'
        );
        $this->assertSame('account', $filter->account());
        $this->assertSame('op', $filter->op());
        $this->assertSame('session', $filter->session());

        $filter->account('account')
               ->op('op')
               ->session('session');
        $this->assertSame('account', $filter->account());
        $this->assertSame('op', $filter->op());
        $this->assertSame('session', $filter->session());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filter account="account" op="op" session="session" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filter);

        $array = array(
            'filter' => array(
                'account' => 'account',
                'op' => 'op',
                'session' => 'session',
            ),
        );
        $this->assertEquals($array, $filter->toArray());
    }

    public function testAddedComment()
    {
        $comment = new \Zimbra\Mail\Struct\AddedComment('parentId', 'text');
        $this->assertSame('parentId', $comment->parentId());
        $this->assertSame('text', $comment->text());

        $comment->parentId('parentId')
                ->text('text');
        $this->assertSame('parentId', $comment->parentId());
        $this->assertSame('text', $comment->text());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comment parentId="parentId" text="text" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comment);

        $array = array(
            'comment' => array(
                'parentId' => 'parentId',
                'text' => 'text',
            ),
        );
        $this->assertEquals($array, $comment->toArray());
    }

    public function testAddMsgSpec()
    {
        $m = new \Zimbra\Mail\Struct\AddMsgSpec(
            'content', 'f', 't', 'tn', 'l', true, 'd', 'aid'
        );
        $this->assertSame('content', $m->content());
        $this->assertSame('f', $m->f());
        $this->assertSame('t', $m->t());
        $this->assertSame('tn', $m->tn());
        $this->assertSame('l', $m->l());
        $this->assertTrue($m->noICal());
        $this->assertSame('d', $m->d());
        $this->assertSame('aid', $m->aid());

        $m->content('content')
          ->f('f')
          ->t('t')
          ->tn('tn')
          ->l('l')
          ->noICal(true)
          ->d('d')
          ->aid('aid');
        $this->assertSame('content', $m->content());
        $this->assertSame('f', $m->f());
        $this->assertSame('t', $m->t());
        $this->assertSame('tn', $m->tn());
        $this->assertSame('l', $m->l());
        $this->assertTrue($m->noICal());
        $this->assertSame('d', $m->d());
        $this->assertSame('aid', $m->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m f="f" t="t" tn="tn" l="l" noICal="true" d="d" aid="aid">'
                .'<content>content</content>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'content' => 'content',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'l' => 'l',
                'noICal' => true,
                'd' => 'd',
                'aid' => 'aid',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testAddRecurrenceInfo()
    {
        $add = new \Zimbra\Mail\Struct\AddRecurrenceInfo();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurrenceInfo', $add);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = array(
            'add' => array(),
        );
        $this->assertEquals($array, $add->toArray());
    }

    public function testAddressBookTest()
    {
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            10, 'header', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $addressBookTest);
        $this->assertSame('header', $addressBookTest->header());
        $addressBookTest->header('header');
        $this->assertSame('header', $addressBookTest->header());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<addressBookTest index="10" negative="true" header="header" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $addressBookTest);

        $array = array(
            'addressBookTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
            ),
        );
        $this->assertEquals($array, $addressBookTest->toArray());
    }

    public function testAddressTest()
    {
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            10, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $addressTest);
        $this->assertSame('header', $addressTest->header());
        $this->assertSame('part', $addressTest->part());
        $this->assertSame('stringComparison', $addressTest->stringComparison());
        $this->assertSame('value', $addressTest->value());
        $this->assertTrue($addressTest->caseSensitive());

        $addressTest->header('header')
                    ->part('part')
                    ->stringComparison('stringComparison')
                    ->value('value')
                    ->caseSensitive(true);
        $this->assertSame('header', $addressTest->header());
        $this->assertSame('part', $addressTest->part());
        $this->assertSame('stringComparison', $addressTest->stringComparison());
        $this->assertSame('value', $addressTest->value());
        $this->assertTrue($addressTest->caseSensitive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $addressTest);

        $array = array(
            'addressTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
                'part' => 'part',
                'stringComparison' => 'stringComparison',
                'value' => 'value',
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $addressTest->toArray());
    }

    function testAlarmInfo()
    {
        $abs = new \Zimbra\Mail\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo($abs, $rel);

        $repeat = new \Zimbra\Mail\Struct\DurationInfo(false, 7, 2, 3, 4, 5, 'END', 6);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach('uri', 'ct', 'value');

        $xparam1 = new \Zimbra\Mail\Struct\XParam('name1', 'value1');
        $at = new \Zimbra\Mail\Struct\CalendarAttendee(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', ParticipationStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $xparam2 = new \Zimbra\Mail\Struct\XParam('name2', 'value2');
        $xprop = new \Zimbra\Mail\Struct\XProp('name', 'value', array($xparam2));

        $alarm = new \Zimbra\Mail\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, 'desc', $attach, 'summary', array($at), array($xprop)
        );

        $this->assertSame('DISPLAY', (string) $alarm->action());
        $this->assertSame($trigger, $alarm->trigger());
        $this->assertSame($repeat, $alarm->repeat());
        $this->assertSame('desc', $alarm->desc());
        $this->assertSame($attach, $alarm->attach());
        $this->assertSame('summary', $alarm->summary());
        $this->assertSame(array($at), $alarm->at()->all());
        $this->assertSame(array($xprop), $alarm->xprop()->all());

        $alarm->at()->add($at);
        $alarm->xprop()->add($xprop);
        $this->assertSame(array($at, $at), $alarm->at()->all());
        $this->assertSame(array($xprop, $xprop), $alarm->xprop()->all());
        $alarm->action(AlarmAction::DISPLAY())
              ->trigger($trigger)
              ->repeat($repeat)
              ->desc('desc')
              ->attach($attach)
              ->summary('summary');
        $this->assertSame('DISPLAY', (string) $alarm->action());
        $this->assertSame($trigger, $alarm->trigger());
        $this->assertSame($repeat, $alarm->repeat());
        $this->assertSame('desc', $alarm->desc());
        $this->assertSame($attach, $alarm->attach());
        $this->assertSame('summary', $alarm->summary());

        $alarm->at()->remove(1);
        $alarm->xprop()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<alarm action="DISPLAY">'
                .'<trigger>'
                    .'<abs d="20120315T18302305Z" />'
                    .'<rel neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</trigger>'
                .'<repeat neg="false" w="7" d="2" h="3" m="4" s="5" related="END" count="6" />'
                .'<desc>desc</desc>'
                .'<attach uri="uri" ct="ct">value</attach>'
                .'<summary>summary</summary>'
                .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="true" member="member" delTo="delTo" delFrom="delFrom">'
                    .'<xparam name="name1" value="value1" />'
                .'</at>'
                .'<xprop name="name" value="value">'
                    .'<xparam name="name2" value="value2" />'
                .'</xprop>'
            .'</alarm>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'action' => 'DISPLAY',
                'trigger' => array(
                    'abs' => array(
                        'd' => '20120315T18302305Z',
                    ),
                    'rel' => array(
                        'neg' => true,
                        'w' => 7,
                        'd' => 2,
                        'h' => 3,
                        'm' => 4,
                        's' => 5,
                        'related' => 'START',
                        'count' => 6,
                    ),
                ),
                'repeat' => array(
                    'neg' => false,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'END',
                    'count' => 6,
                ),
                'desc' => 'desc',
                'attach' => array(
                    'uri' => 'uri',
                    'ct' => 'ct',
                    '_' => 'value',
                ),
                'summary' => 'summary',
                'at' => array(
                    array(
                        'a' => 'a',
                        'url' => 'url',
                        'd' => 'd',
                        'sentBy' => 'sentBy',
                        'dir' => 'dir',
                        'lang' => 'lang',
                        'cutype' => 'cutype',
                        'role' => 'role',
                        'ptst' => 'NE',
                        'rsvp' => true,
                        'member' => 'member',
                        'delTo' => 'delTo',
                        'delFrom' => 'delFrom',
                        'xparam' => array(
                            array(
                                'name' => 'name1',
                                'value' => 'value1',
                            ),
                        ),
                    ),
                ),
                'xprop' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                        'xparam' => array(
                            array(
                                'name' => 'name2',
                                'value' => 'value2',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }

    public function testAlarmTriggerInfo()
    {
        $abs = new \Zimbra\Mail\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo($abs, $rel);

        $this->assertSame($abs, $trigger->abs());
        $this->assertSame($rel, $trigger->rel());
        $trigger->abs($abs)
                ->rel($rel);
        $this->assertSame($abs, $trigger->abs());
        $this->assertSame($rel, $trigger->rel());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<trigger>'
                .'<abs d="20120315T18302305Z" />'
                .'<rel neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
            .'</trigger>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $trigger);

        $array = array(
            'trigger' => array(
                'abs' => array(
                    'd' => '20120315T18302305Z',
                ),
                'rel' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $trigger->toArray());
    }

    public function testAttachmentsInfo()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);

        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo;
        $attach->mp($mp)
            ->m($m)
            ->cn($cn)
            ->doc($doc)
            ->aid('aid');
        $this->assertSame($mp, $attach->mp());
        $this->assertSame($m, $attach->m());
        $this->assertSame($cn, $attach->cn());
        $this->assertSame($doc, $attach->doc());
        $this->assertSame('aid', $attach->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attach aid="aid">'
                .'<mp mid="mid" part="part" optional="true" />'
                .'<m id="id" optional="false" />'
                .'<cn id="id" optional="false" />'
                .'<doc path="path" id="id" ver="10" optional="true" />'
            .'</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attach);

        $array = array(
            'attach' => array(
                'aid' => 'aid',
                'mp' => array(
                    'mid' => 'mid',
                    'part' => 'part',
                    'optional' => true,
                ),
                'm' => array(
                    'id' => 'id',
                    'optional' => false,
                ),
                'cn' => array(
                    'id' => 'id',
                    'optional' => false,
                ),
                'doc' => array(
                    'path' => 'path',
                    'id' => 'id',
                    'ver' => 10,
                    'optional' => true,
                ),
            ),
        );
        $this->assertEquals($array, $attach->toArray());
    }

    public function testAttachmentTest()
    {
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $attachmentTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attachmentTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $attachmentTest);

        $array = array(
            'attachmentTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $attachmentTest->toArray());
    }

    public function testAttachSpec()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Mail\Struct\AttachSpec');
        $stub->optional(true);
        $this->assertTrue($stub->optional());
    }

    public function testBodyTest()
    {
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            10, 'value', true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $bodyTest);
        $this->assertSame('value', $bodyTest->value());
        $this->assertTrue($bodyTest->caseSensitive());

        $bodyTest->value('value')
                 ->caseSensitive(true);
        $this->assertSame('value', $bodyTest->value());
        $this->assertTrue($bodyTest->caseSensitive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bodyTest index="10" negative="true" value="value" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bodyTest);

        $array = array(
            'bodyTest' => array(
                'index' => 10,
                'negative' => true,
                'value' => 'value',
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $bodyTest->toArray());
    }

    public function testBounceMsgSpec()
    {
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $m = new \Zimbra\Mail\Struct\BounceMsgSpec('id', array($e));

        $this->assertSame('id', $m->id());
        $this->assertSame(array($e), $m->e()->all());

        $m->id('id')
          ->addE($e);
        $this->assertSame('id', $m->id());
        $this->assertSame(array($e, $e), $m->e()->all());
        $m->e()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id">'
                .'<e a="a" t="t" p="p" />'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testBulkTest()
    {
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $bulkTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bulkTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bulkTest);

        $array = array(
            'bulkTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $bulkTest->toArray());
    }

    public function testByDayRule()
    {
        $wkday1 = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), 10);
        $wkday2 = new \Zimbra\Mail\Struct\WkDay(WeekDay::MO(), 10);

        $byday = new \Zimbra\Mail\Struct\ByDayRule(array($wkday1));
        $this->assertSame(array($wkday1), $byday->wkday()->all());
        $byday->addWkDay($wkday2);
        $this->assertSame(array($wkday1, $wkday2), $byday->wkday()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byday>'
                .'<wkday day="SU" ordwk="10" />'
                .'<wkday day="MO" ordwk="10" />'
            .'</byday>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byday);

        $array = array(
            'byday' => array(
                'wkday' => array(
                    array(
                        'day' => 'SU',
                        'ordwk' => 10,
                    ),
                    array(
                        'day' => 'MO',
                        'ordwk' => 10,
                    ),
                )
            ),
        );
        $this->assertEquals($array, $byday->toArray());
    }

    public function testByHourRule()
    {
        $byhour = new \Zimbra\Mail\Struct\ByHourRule('5,a,10,b,15');
        $this->assertSame('5,10,15', $byhour->hrlist());
        $byhour->hrlist('5,a,10,b,15');
        $this->assertSame('5,10,15', $byhour->hrlist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byhour hrlist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byhour);

        $array = array(
            'byhour' => array(
                'hrlist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byhour->toArray());
    }

    public function testByMinuteRule()
    {
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule('10,a,20,b,30');
        $this->assertSame('10,20,30', $byminute->minlist());
        $byminute->minlist('10,a,20,b,30');
        $this->assertSame('10,20,30', $byminute->minlist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byminute minlist="10,20,30" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byminute);

        $array = array(
            'byminute' => array(
                'minlist' => '10,20,30',
            ),
        );
        $this->assertEquals($array, $byminute->toArray());
    }

    public function testByMonthDayRule()
    {
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $this->assertSame('5,10,15', $bymonthday->modaylist());
        $bymonthday->modaylist('5,a,10,b,15,-32');
        $this->assertSame('5,10,15', $bymonthday->modaylist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bymonthday modaylist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonthday);

        $array = array(
            'bymonthday' => array(
                'modaylist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $bymonthday->toArray());
    }

    public function testByMonthRule()
    {
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule('5,a,10,b,15');
        $this->assertSame('5,10', $bymonth->molist());
        $bymonth->molist('5,a,10,b,15');
        $this->assertSame('5,10', $bymonth->molist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bymonth molist="5,10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bymonth);

        $array = array(
            'bymonth' => array(
                'molist' => '5,10',
            ),
        );
        $this->assertEquals($array, $bymonth->toArray());
    }

    public function testBySecondRule()
    {
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule('10,a,20,b,30');
        $this->assertSame('10,20,30', $bysecond->seclist());
        $bysecond->seclist('10,a,20,b,30');
        $this->assertSame('10,20,30', $bysecond->seclist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bysecond seclist="10,20,30" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysecond);

        $array = array(
            'bysecond' => array(
                'seclist' => '10,20,30',
            ),
        );
        $this->assertEquals($array, $bysecond->toArray());
    }

    public function testBySetPosRule()
    {
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule('5,a,10,b,15,367');
        $this->assertSame('5,10,15', $bysetpos->poslist());
        $bysetpos->poslist('5,a,10,b,15,-368');
        $this->assertSame('5,10,15', $bysetpos->poslist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<bysetpos poslist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $bysetpos);

        $array = array(
            'bysetpos' => array(
                'poslist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $bysetpos->toArray());
    }

    public function testByWeekNoRule()
    {
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $this->assertSame('5,10,15', $byweekno->wklist());
        $byweekno->wklist('5,a,10,b,15,-54');
        $this->assertSame('5,10,15', $byweekno->wklist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byweekno wklist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byweekno);

        $array = array(
            'byweekno' => array(
                'wklist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byweekno->toArray());
    }

    public function testByYearDayRule()
    {
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule('5,a,10,b,15,367');
        $this->assertSame('5,10,15', $byyearday->yrdaylist());
        $byyearday->yrdaylist('5,a,10,b,15,-368');
        $this->assertSame('5,10,15', $byyearday->yrdaylist());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<byyearday yrdaylist="5,10,15" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $byyearday);

        $array = array(
            'byyearday' => array(
                'yrdaylist' => '5,10,15',
            ),
        );
        $this->assertEquals($array, $byyearday->toArray());
    }

    public function testCalDataSourceNameOrId()
    {
        $cal = new \Zimbra\Mail\Struct\CalDataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $cal);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cal name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'cal' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }

    public function testCaldavDataSourceNameOrId()
    {
        $caldav = new \Zimbra\Mail\Struct\CaldavDataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $caldav);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<caldav name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $caldav);

        $array = array(
            'caldav' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $caldav->toArray());
    }

    public function testCalendarAttach()
    {
        $ca = new \Zimbra\Mail\Struct\CalendarAttach('uri', 'ct', 'value');
        $this->assertSame('uri', $ca->uri());
        $this->assertSame('ct', $ca->ct());
        $this->assertSame('value', $ca->value());

        $ca->uri('uri')
           ->ct('ct')
           ->value('value');
        $this->assertSame('uri', $ca->uri());
        $this->assertSame('ct', $ca->ct());
        $this->assertSame('value', $ca->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attach uri="uri" ct="ct">value</attach>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ca);

        $array = array(
            'attach' => array(
                'uri' => 'uri',
                'ct' => 'ct',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $ca->toArray());
    }

    public function testCalendarAttendee()
    {
        $xparam1 = new \Zimbra\Mail\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Mail\Struct\XParam('name2', 'value2');
        $cal = new \Zimbra\Mail\Struct\CalendarAttendee(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', ParticipationStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $this->assertSame(array($xparam1), $cal->xparam()->all());
        $this->assertSame('a', $cal->a());
        $this->assertSame('url', $cal->url());
        $this->assertSame('d', $cal->d());
        $this->assertSame('sentBy', $cal->sentBy());
        $this->assertSame('dir', $cal->dir());
        $this->assertSame('lang', $cal->lang());
        $this->assertSame('cutype', $cal->cutype());
        $this->assertSame('role', $cal->role());
        $this->assertTrue($cal->ptst()->is('NE'));
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $cal->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $cal->xparam()->all());
        $cal->a('a')
            ->url('url')
            ->d('d')
            ->sentBy('sentBy')
            ->dir('dir')
            ->lang('lang')
            ->cutype('cutype')
            ->role('role')
            ->ptst(ParticipationStatus::AC())
            ->rsvp(true)
            ->member('member')
            ->delTo('delTo')
            ->delFrom('delFrom');
        $this->assertSame('a', $cal->a());
        $this->assertSame('url', $cal->url());
        $this->assertSame('d', $cal->d());
        $this->assertSame('sentBy', $cal->sentBy());
        $this->assertSame('dir', $cal->dir());
        $this->assertSame('lang', $cal->lang());
        $this->assertSame('cutype', $cal->cutype());
        $this->assertSame('role', $cal->role());
        $this->assertTrue($cal->ptst()->is('AC'));
        $this->assertTrue($cal->rsvp());
        $this->assertSame('member', $cal->member());
        $this->assertSame('delTo', $cal->delTo());
        $this->assertSame('delFrom', $cal->delFrom());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="AC" rsvp="true" member="member" delTo="delTo" delFrom="delFrom">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</at>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'at' => array(
                'a' => 'a',
                'url' => 'url',
                'd' => 'd',
                'sentBy' => 'sentBy',
                'dir' => 'dir',
                'lang' => 'lang',
                'cutype' => 'cutype',
                'role' => 'role',
                'ptst' => 'AC',
                'rsvp' => true,
                'member' => 'member',
                'delTo' => 'delTo',
                'delFrom' => 'delFrom',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cal->toArray());
    }

    public function testCalOrganizer()
    {
        $xparam1 = new \Zimbra\Mail\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Mail\Struct\XParam('name2', 'value2');
        $or = new \Zimbra\Mail\Struct\CalOrganizer(array($xparam1)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang'
        );
        $this->assertSame(array($xparam1), $or->xparam()->all());
        $this->assertSame('a', $or->a());
        $this->assertSame('url', $or->url());
        $this->assertSame('d', $or->d());
        $this->assertSame('sentBy', $or->sentBy());
        $this->assertSame('dir', $or->dir());
        $this->assertSame('lang', $or->lang());

        $or->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $or->xparam()->all());
        $or->a('a')
           ->url('url')
           ->d('d')
           ->sentBy('sentBy')
           ->dir('dir')
           ->lang('lang');
        $this->assertSame('a', $or->a());
        $this->assertSame('url', $or->url());
        $this->assertSame('d', $or->d());
        $this->assertSame('sentBy', $or->sentBy());
        $this->assertSame('dir', $or->dir());
        $this->assertSame('lang', $or->lang());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<or a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</or>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $or);

        $array = array(
            'or' => array(
                'a' => 'a',
                'url' => 'url',
                'd' => 'd',
                'sentBy' => 'sentBy',
                'dir' => 'dir',
                'lang' => 'lang',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $or->toArray());
    }

    public function testCalReply()
    {
        $reply = new \Zimbra\Mail\Struct\CalReply(
            'at', 10, 10, 10, '991231', 'sentBy', ParticipationStatus::NE(), 'tz', '991231000000'
        );
        $this->assertSame('at', $reply->at());
        $this->assertSame(10, $reply->seq());
        $this->assertSame(10, $reply->d());
        $this->assertSame('sentBy', $reply->sentBy());
        $this->assertTrue($reply->ptst()->is('NE'));

        $reply->at('at')
              ->seq(10)
              ->d(10)
              ->sentBy('sentBy')
              ->ptst(ParticipationStatus::NE());
        $this->assertSame('at', $reply->at());
        $this->assertSame(10, $reply->seq());
        $this->assertSame(10, $reply->d());
        $this->assertSame('sentBy', $reply->sentBy());
        $this->assertTrue($reply->ptst()->is('NE'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $reply);

        $array = array(
            'reply' => array(
                'at' => 'at',
                'seq' => 10,
                'd' => 10,
                'sentBy' => 'sentBy',
                'ptst' => 'NE',
                'rangeType' => 10,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
            ),
        );
        $this->assertEquals($array, $reply->toArray());
    }

    public function testCalTZInfo()
    {
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $tzi = new \Zimbra\Mail\Struct\CalTZInfo('id', 2, 3, $daylight, $standard, 'std', 'day');
        $this->assertSame('id', $tzi->id());
        $this->assertSame(2, $tzi->stdoff());
        $this->assertSame(3, $tzi->dayoff());
        $this->assertSame($daylight, $tzi->standard());
        $this->assertSame($standard, $tzi->daylight());
        $this->assertSame('std', $tzi->stdname());
        $this->assertSame('day', $tzi->dayname());

        $tzi->id('id')
            ->stdoff(10)
            ->dayoff(10)
            ->standard($standard)
            ->daylight($daylight)
            ->stdname('stdname')
            ->dayname('dayname');
        $this->assertSame('id', $tzi->id());
        $this->assertSame(10, $tzi->stdoff());
        $this->assertSame(10, $tzi->dayoff());
        $this->assertSame($standard, $tzi->standard());
        $this->assertSame($daylight, $tzi->daylight());
        $this->assertSame('stdname', $tzi->stdname());
        $this->assertSame('dayname', $tzi->dayname());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                .'<standard mon="12" hour="2" min="3" sec="4" />'
                .'<daylight mon="4" hour="3" min="2" sec="10" />'
            .'</tz>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tzi);

        $array = array(
            'tz' => array(
                'id' => 'id',
                'stdoff' => 10,
                'dayoff' => 10,
                'stdname' => 'stdname',
                'dayname' => 'dayname',
                'standard' => array(
                    'mon' => 12,
                    'hour' => 2,
                    'min' => 3,
                    'sec' => 4,
                ),
                'daylight' => array(
                    'mon' => 4,
                    'hour' => 3,
                    'min' => 2,
                    'sec' => 10,
                ),
            ),
        );
        $this->assertEquals($array, $tzi->toArray());
    }

    public function testCancelRuleInfo()
    {
        $cancel = new \Zimbra\Mail\Struct\CancelRuleInfo(
            10, '991231', 'tz', '991231000000'
        );
        $this->assertSame(10, $cancel->rangeType());
        $this->assertSame('991231', $cancel->recurId());
        $this->assertSame('tz', $cancel->tz());
        $this->assertSame('991231000000', $cancel->ridZ());

        $cancel->rangeType(10)
               ->recurId('991231')
               ->tz('tz')
               ->ridZ('991231000000');
        $this->assertSame(10, $cancel->rangeType());
        $this->assertSame('991231', $cancel->recurId());
        $this->assertSame('tz', $cancel->tz());
        $this->assertSame('991231000000', $cancel->ridZ());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cancel);

        $array = array(
            'cancel' => array(
                'rangeType' => 10,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
            ),
        );
        $this->assertEquals($array, $cancel->toArray());
    }

    public function testContactActionSelector()
    {
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 10, 'part'
        );
        $action = new \Zimbra\Mail\Struct\ContactActionSelector(
            ContactActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', array($a)
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame(array($a), $action->a()->all());

        $action->op(ContactActionOp::MOVE())
               ->addA($a);
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame(array($a, $a), $action->a()->all());
        $action->a()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                .'<a n="n" aid="aid" id="10" part="part">value</a>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'a' => array(
                    array(
                        'n' => 'n',
                        '_' => 'value',
                        'aid' => 'aid',
                        'id' => 10,
                        'part' => 'part',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testContactAttachSpec()
    {
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\AttachSpec', $cn);
        $this->assertSame('id', $cn->id());

        $cn->id('id')
           ->optional(true);
        $this->assertSame('id', $cn->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cn id="id" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => 'id',
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }

    public function testContactRankingTest()
    {
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            10, 'header', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $contactRankingTest);
        $this->assertSame('header', $contactRankingTest->header());
        $contactRankingTest->header('header');
        $this->assertSame('header', $contactRankingTest->header());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<contactRankingTest index="10" negative="true" header="header" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $contactRankingTest);

        $array = array(
            'contactRankingTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
            ),
        );
        $this->assertEquals($array, $contactRankingTest->toArray());
    }

    public function testContactSpec()
    {
        $vcard = new \Zimbra\Mail\Struct\VCardInfo(
            'value', 'mid', 'part', 'aid'
        );
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 10, 'part'
        );
        $m = new \Zimbra\Mail\Struct\NewContactGroupMember(
            'type', 'value'
        );

        $cn = new \Zimbra\Mail\Struct\ContactSpec(
            $vcard, array($a), array($m), 10, 'l', 't', 'tn'
        );
        $this->assertSame($vcard, $cn->vcard());
        $this->assertSame(array($a), $cn->a()->all());
        $this->assertSame(array($m), $cn->m()->all());
        $this->assertSame(10, $cn->id());
        $this->assertSame('l', $cn->l());
        $this->assertSame('t', $cn->t());
        $this->assertSame('tn', $cn->tn());

        $cn->vcard($vcard)
           ->addA($a)
           ->addM($m)
           ->id(10)
           ->l('l')
           ->t('t')
           ->tn('tn');
        $this->assertSame($vcard, $cn->vcard());
        $this->assertSame(array($a, $a), $cn->a()->all());
        $this->assertSame(array($m, $m), $cn->m()->all());
        $this->assertSame(10, $cn->id());
        $this->assertSame('l', $cn->l());
        $this->assertSame('t', $cn->t());
        $this->assertSame('tn', $cn->tn());

        $cn = new \Zimbra\Mail\Struct\ContactSpec(
            $vcard, array($a), array($m), 10, 'l', 't', 'tn'
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cn id="10" l="l" t="t" tn="tn">'
                .'<vcard mid="mid" part="part" aid="aid">value</vcard>'
                .'<a n="n" aid="aid" id="10" part="part">value</a>'
                .'<m type="type" value="value" />'
            .'</cn>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => 10,
                'l' => 'l',
                't' => 't',
                'tn' => 'tn',
                'vcard' => array(
                    '_' => 'value',
                    'mid' => 'mid',
                    'part' => 'part',
                    'aid' => 'aid',
                ),
                'a' => array(
                    array(
                        'n' => 'n',
                        '_' => 'value',
                        'aid' => 'aid',
                        'id' => 10,
                        'part' => 'part',
                    ),
                ),
                'm' => array(
                    array(
                        'type' => 'type',
                        'value' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }

    public function testContent()
    {
        $content = new \Zimbra\Mail\Struct\Content(
            'value', 'aid'
        );
        $this->assertSame('value', $content->value());
        $this->assertSame('aid', $content->aid());

        $content->value('value')
                ->aid('aid');
        $this->assertSame('value', $content->value());
        $this->assertSame('aid', $content->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content aid="aid">value</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_' => 'value',
                'aid' => 'aid',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testContentSpec()
    {
        $content = new \Zimbra\Mail\Struct\ContentSpec(
            'value', 'aid', 'mid', 'part'
        );
        $this->assertSame('value', $content->value());
        $this->assertSame('aid', $content->aid());
        $this->assertSame('mid', $content->mid());
        $this->assertSame('part', $content->part());

        $content->value('value')
                ->aid('aid')
                ->mid('mid')
                ->part('part');
        $this->assertSame('value', $content->value());
        $this->assertSame('aid', $content->aid());
        $this->assertSame('mid', $content->mid());
        $this->assertSame('part', $content->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content aid="aid" mid="mid" part="part">value</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_' => 'value',
                'aid' => 'aid',
                'mid' => 'mid',
                'part' => 'part',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testConvActionSelector()
    {
        $action = new \Zimbra\Mail\Struct\ConvActionSelector(
            ConvActionOp::DELETE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->op()->is('delete'));
        $action->op(ConvActionOp::DELETE());
        $this->assertTrue($action->op()->is('delete'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="delete" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'delete',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testConversationSpec()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $c = new \Zimbra\Mail\Struct\ConversationSpec(
            'id', array($header), 'fetch', true, 10
        );
        $this->assertSame('id', $c->id());
        $this->assertSame('fetch', $c->fetch());
        $this->assertTrue($c->html());
        $this->assertSame(10, $c->max());
        $this->assertSame(array($header), $c->header()->all());

        $c->id('id')
          ->fetch('fetch')
          ->html(true)
          ->max(10)
          ->addHeader($header);
        $this->assertSame('id', $c->id());
        $this->assertSame('fetch', $c->fetch());
        $this->assertTrue($c->html());
        $this->assertSame(10, $c->max());
        $this->assertSame(array($header, $header), $c->header()->all());

        $c->header()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<c id="id" fetch="fetch" html="true" max="10">'
                .'<header n="attribute-name" />'
            .'</c>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $c);

        $array = array(
            'c' => array(
                'id' => 'id',
                'fetch' => 'fetch',
                'html' => true,
                'max' => 10,
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $c->toArray());
    }

    public function testConversationTest()
    {
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            10, 'where', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $conversationTest);
        $this->assertSame('where', $conversationTest->where());
        $conversationTest->where('where');
        $this->assertSame('where', $conversationTest->where());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<conversationTest index="10" negative="true" where="where" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $conversationTest);

        $array = array(
            'conversationTest' => array(
                'index' => 10,
                'negative' => true,
                'where' => 'where',
            ),
        );
        $this->assertEquals($array, $conversationTest->toArray());
    }

    public function testCurrentDayOfWeekTest()
    {
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            10, 'value', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $currentDayOfWeekTest);
        $this->assertSame('value', $currentDayOfWeekTest->value());
        $currentDayOfWeekTest->value('value');
        $this->assertSame('value', $currentDayOfWeekTest->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<currentDayOfWeekTest index="10" negative="true" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $currentDayOfWeekTest);

        $array = array(
            'currentDayOfWeekTest' => array(
                'index' => 10,
                'negative' => true,
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $currentDayOfWeekTest->toArray());
    }

    public function testCurrentTimeTest()
    {
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            10, 'dateComparison', 'time', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $currentTimeTest);
        $this->assertSame('dateComparison', $currentTimeTest->dateComparison());
        $this->assertSame('time', $currentTimeTest->time());

        $currentTimeTest->dateComparison('dateComparison')
                        ->time('time');

        $xml = '<?xml version="1.0"?>'."\n"
            .'<currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $currentTimeTest);

        $array = array(
            'currentTimeTest' => array(
                'index' => 10,
                'negative' => true,
                'dateComparison' => 'dateComparison',
                'time' => 'time',
            ),
        );
        $this->assertEquals($array, $currentTimeTest->toArray());
    }

    public function testDataSourceNameOrId()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Mail\Struct\DataSourceNameOrId');
        $this->assertInstanceOf('Zimbra\Mail\Struct\NameOrId', $stub);
    }

    public function testDateAttr()
    {
        $abs = new \Zimbra\Mail\Struct\DateAttr('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $abs->d());
        $abs->d('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $abs->d());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<abs d="20120315T18302305Z" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $abs);

        $array = array(
            'abs' => array(
                'd' => '20120315T18302305Z',
            ),
        );
        $this->assertEquals($array, $abs->toArray());
    }

    public function testDateTest()
    {
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            10, 'dateComparison', 10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $dateTest);
        $this->assertSame('dateComparison', $dateTest->dateComparison());
        $this->assertSame(10, $dateTest->d());

        $dateTest->dateComparison('dateComparison')
                 ->d(10);
        $this->assertSame('dateComparison', $dateTest->dateComparison());
        $this->assertSame(10, $dateTest->d());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dateTest);

        $array = array(
            'dateTest' => array(
                'index' => 10,
                'negative' => true,
                'dateComparison' => 'dateComparison',
                'd' => 10,
            ),
        );
        $this->assertEquals($array, $dateTest->toArray());
    }

    public function testDateTimeStringAttr()
    {
        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $until->d());
        $until->d('20120315T18302305Z');
        $this->assertSame('20120315T18302305Z', $until->d());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<until d="20120315T18302305Z" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $until);

        $array = array(
            'until' => array(
                'd' => '20120315T18302305Z',
            ),
        );
        $this->assertEquals($array, $until->toArray());
    }

    public function testDiffDocumentVersionSpec()
    {
        $doc = new \Zimbra\Mail\Struct\DiffDocumentVersionSpec('id', 10, 2);
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->v1());
        $this->assertSame(2, $doc->v2());

        $doc->id('id')
            ->v1(10)
            ->v2(2);
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->v1());
        $this->assertSame(2, $doc->v2());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc id="id" v1="10" v2="2" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => 'id',
                'v1' => 10,
                'v2' => 2,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testDiscardAction()
    {
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction(
            10
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionDiscard);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionDiscard index="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionDiscard);

        $array = array(
            'actionDiscard' => array(
                'index' => 10,
            ),
        );
        $this->assertEquals($array, $actionDiscard->toArray());
    }

    public function testDismissAlarm()
    {
        $alarm = new \Zimbra\Mail\Struct\DismissAlarm('id', 10);
        $this->assertSame('id', $alarm->id());
        $this->assertSame(10, $alarm->dismissedAt());

        $alarm->id('id')
              ->dismissedAt(10);
        $this->assertSame('id', $alarm->id());
        $this->assertSame(10, $alarm->dismissedAt());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<alarm id="id" dismissedAt="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'id' => 'id',
                'dismissedAt' => 10,
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }

    public function testDismissAppointmentAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\DismissAppointmentAlarm('id', 10);
        $this->assertInstanceOf('Zimbra\Mail\Struct\DismissAlarm', $appt);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<appt id="id" dismissedAt="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $appt);

        $array = array(
            'appt' => array(
                'id' => 'id',
                'dismissedAt' => 10,
            ),
        );
        $this->assertEquals($array, $appt->toArray());
    }

    public function testDismissTaskAlarm()
    {
        $task = new \Zimbra\Mail\Struct\DismissTaskAlarm('id', 10);
        $this->assertInstanceOf('Zimbra\Mail\Struct\DismissAlarm', $task);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<task id="id" dismissedAt="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $task);

        $array = array(
            'task' => array(
                'id' => 'id',
                'dismissedAt' => 10,
            ),
        );
        $this->assertEquals($array, $task->toArray());
    }

    public function testDocAttachSpec()
    {
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('p', 'i', 10);
        $this->assertInstanceOf('Zimbra\Mail\Struct\AttachSpec', $doc);
        $this->assertSame('p', $doc->path());
        $this->assertSame('i', $doc->id());
        $this->assertSame(10, $doc->ver());

        $doc->path('path')
            ->id('id')
            ->ver(100)
            ->optional(true);
        $this->assertSame('path', $doc->path());
        $this->assertSame('id', $doc->id());
        $this->assertSame(100, $doc->ver());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc path="path" id="id" ver="100" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'path' => 'path',
                'id' => 'id',
                'ver' => 100,
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testDocumentActionGrant()
    {
        $grant = new \Zimbra\Mail\Struct\DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), 100
        );
        $this->assertTrue($grant->perm()->is('r'));
        $this->assertTrue($grant->gt()->is('all'));
        $this->assertSame(100, $grant->expiry());

        $grant->perm(DocumentPermission::READ())
              ->gt(DocumentGrantType::ALL())
              ->expiry(10);
        $this->assertTrue($grant->perm()->is('r'));
        $this->assertTrue($grant->gt()->is('all'));
        $this->assertSame(10, $grant->expiry());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<grant perm="r" gt="all" expiry="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $grant);

        $array = array(
            'grant' => array(
                'perm' => 'r',
                'gt' => 'all',
                'expiry' => 10,
            ),
        );
        $this->assertEquals($array, $grant->toArray());
    }

    public function testDocumentActionSelector()
    {
        $grant = new \Zimbra\Mail\Struct\DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), 10
        );
        $action = new \Zimbra\Mail\Struct\DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, 'zid', 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $this->assertTrue($action->op()->is('watch'));
        $this->assertSame($grant, $action->grant());
        $this->assertSame('zid', $action->zid());

        $action->op(DocumentActionOp::WATCH())
               ->grant($grant)
               ->zid('zid');
        $this->assertTrue($action->op()->is('watch'));
        $this->assertSame($grant, $action->grant());
        $this->assertSame('zid', $action->zid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="watch" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" zid="zid">'
                .'<grant perm="r" gt="all" expiry="10" />'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'watch',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'zid' => 'zid',
                'grant' => array(
                    'perm' => 'r',
                    'gt' => 'all',
                    'expiry' => 10,
                ),
            )
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testDocumentSpec()
    {
        $upload = new \Zimbra\Struct\Id('id');
        $m = new \Zimbra\Mail\Struct\MessagePartSpec(
            'id', 'part'
        );
        $docVer = new \Zimbra\Mail\Struct\IdVersion(
            'id', 10
        );

        $doc = new \Zimbra\Mail\Struct\DocumentSpec(
            $upload, $m, $docVer, 'name', 'ct', 'desc', 'l', 'id', 10, 'content', true, 'f'
        );
        $this->assertSame($upload, $doc->upload());
        $this->assertSame($m, $doc->m());
        $this->assertSame($docVer, $doc->doc());
        $this->assertSame('name', $doc->name());
        $this->assertSame('ct', $doc->ct());
        $this->assertSame('desc', $doc->desc());
        $this->assertSame('l', $doc->l());
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());
        $this->assertSame('content', $doc->content());
        $this->assertTrue($doc->descEnabled());
        $this->assertSame('f', $doc->f());

        $doc->upload($upload)
            ->m($m)
            ->doc($docVer)
            ->name('name')
            ->ct('ct')
            ->desc('desc')
            ->l('l')
            ->id('id')
            ->ver(10)
            ->content('content')
            ->descEnabled(true)
            ->f('f');
        $this->assertSame($upload, $doc->upload());
        $this->assertSame($m, $doc->m());
        $this->assertSame($docVer, $doc->doc());
        $this->assertSame('name', $doc->name());
        $this->assertSame('ct', $doc->ct());
        $this->assertSame('desc', $doc->desc());
        $this->assertSame('l', $doc->l());
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());
        $this->assertSame('content', $doc->content());
        $this->assertTrue($doc->descEnabled());
        $this->assertSame('f', $doc->f());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc name="name" ct="ct" desc="desc" l="l" id="id" ver="10" content="content" descEnabled="true" f="f">'
                .'<upload id="id" />'
                .'<m id="id" part="part" />'
                .'<doc id="id" ver="10" />'
            .'</doc>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'name' => 'name',
                'ct' => 'ct',
                'desc' => 'desc',
                'l' => 'l',
                'id' => 'id',
                'ver' => 10,
                'content' => 'content',
                'descEnabled' => true,
                'f' => 'f',
                'upload' => array(
                    'id' => 'id',
                ),
                'm' => array(
                    'id' => 'id',
                    'part' => 'part',
                ),
                'doc' => array(
                    'id' => 'id',
                    'ver' => 10,
                ),
            )
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testDtTimeInfo()
    {
        $dt = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $this->assertSame('20120315T18302305Z', $dt->d());
        $this->assertSame('tz', $dt->tz());
        $this->assertSame(1000, $dt->u());

        $dt->d('20120315T18302305Z')
           ->tz('tz')
           ->u(1000);
        $this->assertSame('20120315T18302305Z', $dt->d());
        $this->assertSame('tz', $dt->tz());
        $this->assertSame(1000, $dt->u());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dt d="20120315T18302305Z" tz="tz" u="1000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dt);

        $array = array(
            'dt' => array(
                'd' => '20120315T18302305Z',
                'tz' => 'tz',
                'u' => 1000,
            ),
        );
        $this->assertEquals($array, $dt->toArray());
    }

    public function testDtVal()
    {
        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);

        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);
        $this->assertSame($s, $dtval->s());
        $this->assertSame($e, $dtval->e());
        $this->assertSame($dur, $dtval->dur());

        $dtval->s($s)
              ->e($e)
              ->dur($dur);
        $this->assertSame($s, $dtval->s());
        $this->assertSame($e, $dtval->e());
        $this->assertSame($dur, $dtval->dur());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dtval>'
                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
            .'</dtval>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dtval);

        $array = array(
            'dtval' => array(
                's' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
                'e' => array(
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                    'u' => 2000,
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $dtval->toArray());
    }

    public function testDurationInfo()
    {
        $rel = new \Zimbra\Mail\Struct\DurationInfo(false, 7, 2, 3, 4, 5, 'END', 6);
        $this->assertFalse($rel->neg());
        $this->assertSame(7, $rel->w());
        $this->assertSame(2, $rel->d());
        $this->assertSame(3, $rel->h());
        $this->assertSame(4, $rel->m());
        $this->assertSame(5, $rel->s());
        $this->assertSame('END', $rel->related());
        $this->assertSame(6, $rel->count());

        $rel->neg(true)
            ->w(7)
            ->d(2)
            ->h(3)
            ->m(4)
            ->s(5)
            ->related('START')
            ->count(6);
        $this->assertTrue($rel->neg());
        $this->assertSame(7, $rel->w());
        $this->assertSame(2, $rel->d());
        $this->assertSame(3, $rel->h());
        $this->assertSame(4, $rel->m());
        $this->assertSame(5, $rel->s());
        $this->assertSame('START', $rel->related());
        $this->assertSame(6, $rel->count());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rel neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rel);

        $array = array(
            'rel' => array(
                'neg' => true,
                'w' => 7,
                'd' => 2,
                'h' => 3,
                'm' => 4,
                's' => 5,
                'related' => 'START',
                'count' => 6,
            ),
        );
        $this->assertEquals($array, $rel->toArray());
    }

    public function testEmailAddrInfo()
    {
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $this->assertSame('a', $e->a());
        $this->assertSame('t', $e->t());
        $this->assertSame('p', $e->p());

        $e->a('a')
          ->t('t')
          ->p('p');
        $this->assertSame('a', $e->a());
        $this->assertSame('t', $e->t());
        $this->assertSame('p', $e->p());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<e a="a" t="t" p="p" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $e);

        $array = array(
            'e' => array(
                'a' => 'a',
                't' => 't',
                'p' => 'p',
            ),
        );
        $this->assertEquals($array, $e->toArray());
    }

    public function testExceptionRecurIdInfo()
    {
        $exceptId = new \Zimbra\Mail\Struct\ExceptionRecurIdInfo(
            '20120315T18302305Z', 'tz', -1
        );
        $this->assertSame('20120315T18302305Z', $exceptId->d());
        $this->assertSame('tz', $exceptId->tz());
        $this->assertSame(-1, $exceptId->rangeType());

        $exceptId->d('20120315T18302305Z')
                 ->tz('tz')
                 ->rangeType(3);
        $this->assertSame('20120315T18302305Z', $exceptId->d());
        $this->assertSame('tz', $exceptId->tz());
        $this->assertSame(3, $exceptId->rangeType());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<exceptId d="20120315T18302305Z" tz="tz" rangeType="3" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exceptId);

        $array = array(
            'exceptId' => array(
                'd' => '20120315T18302305Z',
                'tz' => 'tz',
                'rangeType' => 3,
            ),
        );
        $this->assertEquals($array, $exceptId->toArray());
    }

    public function testExceptionRuleInfo()
    {
        $add = new \Zimbra\Mail\Struct\RecurrenceInfo();
        $exclude = new \Zimbra\Mail\Struct\RecurrenceInfo();
        $except = new \Zimbra\Mail\Struct\ExceptionRuleInfo(
        	10, '991231', $add, $exclude, 'tz', '991231000000'
    	);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurIdInfo', $except);
        $this->assertSame($add, $except->add());
        $this->assertSame($exclude, $except->exclude());

        $except->add($add)
        	   ->exclude($exclude);
        $this->assertSame($add, $except->add());
        $this->assertSame($exclude, $except->exclude());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000">'
            	.'<add />'
            	.'<exclude />'
            .'</except>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $except);

        $array = array(
            'except' => array(
                'rangeType' => 10,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
                'add' => array(),
                'exclude' => array(),
            ),
        );
        $this->assertEquals($array, $except->toArray());
    }

    public function testExcludeRecurrenceInfo()
    {
        $exclude = new \Zimbra\Mail\Struct\ExcludeRecurrenceInfo();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\RecurrenceInfo', $exclude);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<exclude />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $exclude);

        $array = array(
            'exclude' => array(),
        );
        $this->assertEquals($array, $exclude->toArray());
    }

    public function testExpandedRecurrenceCancel()
    {
        $exceptId = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo;

        $cancel = new \Zimbra\Mail\Struct\ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $cancel);


        $xml = '<?xml version="1.0"?>'."\n"
            .'<cancel s="10" e="10">'
                .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'<recur />'
            .'</cancel>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cancel);

        $array = array(
            'cancel' => array(
                's' => 10,
                'e' => 10,
                'exceptId' => array(
                    'range' => 'range',
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
                'recur' => array(),
            ),
        );
        $this->assertEquals($array, $cancel->toArray());
    }

    public function testExpandedRecurrenceComponent()
    {
        $exceptId = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo;

        $comp = new \Zimbra\Mail\Struct\ExpandedRecurrenceComponent(
            $exceptId, $dur, $recur, 10, 10
        );
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($dur, $comp->dur());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame(10, $comp->s());
        $this->assertSame(10, $comp->e());

        $comp->exceptId($exceptId)
             ->dur($dur)
             ->recur($recur)
             ->s(10)
             ->e(10);
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($dur, $comp->dur());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame(10, $comp->s());
        $this->assertSame(10, $comp->e());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comp s="10" e="10">'
                .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'<recur />'
            .'</comp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                's' => 10,
                'e' => 10,
                'exceptId' => array(
                    'range' => 'range',
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
                'recur' => array(),
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }

    public function testExpandedRecurrenceException()
    {
        $exceptId = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo;

        $except = new \Zimbra\Mail\Struct\ExpandedRecurrenceException(
            $exceptId, $dur, $recur, 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $except);


        $xml = '<?xml version="1.0"?>'."\n"
            .'<except s="10" e="10">'
                .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'<recur />'
            .'</except>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $except);

        $array = array(
            'except' => array(
                's' => 10,
                'e' => 10,
                'exceptId' => array(
                    'range' => 'range',
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
                'recur' => array(),
            ),
        );
        $this->assertEquals($array, $except->toArray());
    }

    public function testExpandedRecurrenceInvite()
    {
        $comp = new \Zimbra\Mail\Struct\ExpandedRecurrenceInvite();
        $this->assertInstanceOf('Zimbra\Mail\Struct\ExpandedRecurrenceComponent', $comp);
    }

    public function testFacebookTest()
    {
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $facebookTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<facebookTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $facebookTest);

        $array = array(
            'facebookTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $facebookTest->toArray());
    }

    public function testFileIntoAction()
    {
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction(
            10, 'folderPath'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionFileInto);
        $this->assertSame('folderPath', $actionFileInto->folderPath());
        $actionFileInto->folderPath('folderPath');
        $this->assertSame('folderPath', $actionFileInto->folderPath());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionFileInto index="10" folderPath="folderPath" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFileInto);

        $array = array(
            'actionFileInto' => array(
                'index' => 10,
                'folderPath' => 'folderPath',
            ),
        );
        $this->assertEquals($array, $actionFileInto->toArray());
    }

    public function testFilterAction()
    {
        $actionFilter = new \Zimbra\Mail\Struct\FilterAction(
            10
        );
        $this->assertSame(10, $actionFilter->index());
        $actionFilter->index(10);
        $this->assertSame(10, $actionFilter->index());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionFilter index="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFilter);

        $array = array(
            'actionFilter' => array(
                'index' => 10,
            ),
        );
        $this->assertEquals($array, $actionFilter->toArray());
    }

    public function testFilterActions()
    {
        $actionKeep = new \Zimbra\Mail\Struct\KeepAction(
            10
        );
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction(
            10
        );
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction(
            10, 'folderPath'
        );
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction(
            10, 'flagName'
        );
        $actionTag = new \Zimbra\Mail\Struct\TagAction(
            10, 'tagName'
        );
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction(
            10, 'a'
        );
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction(
            10, 'content'
        );
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            10, 'content', 'a', 'su', 10, 'origHeaders'
        );
        $actionStop = new \Zimbra\Mail\Struct\StopAction(
            10
        );

        $filterActions = new \Zimbra\Mail\Struct\FilterActions(
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionStop
        );
        $this->assertSame($actionKeep, $filterActions->actionKeep());
        $this->assertSame($actionDiscard, $filterActions->actionDiscard());
        $this->assertSame($actionFileInto, $filterActions->actionFileInto());
        $this->assertSame($actionFlag, $filterActions->actionFlag());
        $this->assertSame($actionTag, $filterActions->actionTag());
        $this->assertSame($actionRedirect, $filterActions->actionRedirect());
        $this->assertSame($actionReply, $filterActions->actionReply());
        $this->assertSame($actionNotify, $filterActions->actionNotify());
        $this->assertSame($actionStop, $filterActions->actionStop());

        $filterActions->actionKeep($actionKeep)
                      ->actionDiscard($actionDiscard)
                      ->actionFileInto($actionFileInto)
                      ->actionFlag($actionFlag)
                      ->actionTag($actionTag)
                      ->actionRedirect($actionRedirect)
                      ->actionReply($actionReply)
                      ->actionNotify($actionNotify)
                      ->actionStop($actionStop);
        $this->assertSame($actionKeep, $filterActions->actionKeep());
        $this->assertSame($actionDiscard, $filterActions->actionDiscard());
        $this->assertSame($actionFileInto, $filterActions->actionFileInto());
        $this->assertSame($actionFlag, $filterActions->actionFlag());
        $this->assertSame($actionTag, $filterActions->actionTag());
        $this->assertSame($actionRedirect, $filterActions->actionRedirect());
        $this->assertSame($actionReply, $filterActions->actionReply());
        $this->assertSame($actionNotify, $filterActions->actionNotify());
        $this->assertSame($actionStop, $filterActions->actionStop());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterActions>'
                .'<actionKeep index="10" />'
                .'<actionDiscard index="10" />'
                .'<actionFileInto index="10" folderPath="folderPath" />'
                .'<actionFlag index="10" flagName="flagName" />'
                .'<actionTag index="10" tagName="tagName" />'
                .'<actionRedirect index="10" a="a" />'
                .'<actionReply index="10">'
                    .'<content>content</content>'
                .'</actionReply>'
                .'<actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                    .'<content>content</content>'
                .'</actionNotify>'
                .'<actionStop index="10" />'
            .'</filterActions>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterActions);

        $array = array(
            'filterActions' => array(
                'actionKeep' => array(
                    'index' => 10,
                ),
                'actionDiscard' => array(
                    'index' => 10,
                ),
                'actionFileInto' => array(
                    'index' => 10,
                    'folderPath' => 'folderPath',
                ),
                'actionFlag' => array(
                    'index' => 10,
                    'flagName' => 'flagName',
                ),
                'actionTag' => array(
                    'index' => 10,
                    'tagName' => 'tagName',
                ),
                'actionRedirect' => array(
                    'index' => 10,
                    'a' => 'a',
                ),
                'actionReply' => array(
                    'index' => 10,
                    'content' => 'content',
                ),
                'actionNotify' => array(
                    'index' => 10,
                    'content' => 'content',
                    'a' => 'a',
                    'su' => 'su',
                    'maxBodySize' => 10,
                    'origHeaders' => 'origHeaders',
                ),
                'actionStop' => array(
                    'index' => 10,
                ),
            ),
        );
        $this->assertEquals($array, $filterActions->toArray());
    }

    public function testFilterRule()
    {
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            10, 'header', true
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            10, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            10, true
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            10, 'value', true, true
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            10, true
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            10, 'header', true
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            10, 'where', true
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            10, 'value', true
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            10, 'dateComparison', 'time', true
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            10, 'dateComparison', 10, true
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            10, true
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            10, 'flagName', true
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            10, 'header', true
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            10, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            10, array('method'), true
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            10, true
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            10, true
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            10, 'header', true
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            10, 'numberComparison', 's', true
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            10, true
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            10, true
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            10, true
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            FilterCondition::ALL_OF(),
            $addressBookTest,
            $addressTest,
            $attachmentTest,
            $bodyTest,
            $bulkTest,
            $contactRankingTest,
            $conversationTest,
            $currentDayOfWeekTest,
            $currentTimeTest,
            $dateTest,
            $facebookTest,
            $flaggedTest,
            $headerExistsTest,
            $headerTest,
            $importanceTest,
            $inviteTest,
            $linkedinTest,
            $listTest,
            $meTest,
            $mimeHeaderTest,
            $sizeTest,
            $socialcastTest,
            $trueTest,
            $twitterTest
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction(
            10
        );
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction(
            10
        );
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction(
            10, 'folderPath'
        );
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction(
            10, 'flagName'
        );
        $actionTag = new \Zimbra\Mail\Struct\TagAction(
            10, 'tagName'
        );
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction(
            10, 'a'
        );
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction(
            10, 'content'
        );
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            10, 'content', 'a', 'su', 10, 'origHeaders'
        );
        $actionStop = new \Zimbra\Mail\Struct\StopAction(
            10
        );
        $filterActions = new \Zimbra\Mail\Struct\FilterActions(
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionStop
        );

        $filterRule = new \Zimbra\Mail\Struct\FilterRule(
            'name', true, $filterTests, $filterActions
        );
        $this->assertSame('name', $filterRule->name());
        $this->assertTrue($filterRule->active());
        $this->assertSame($filterTests, $filterRule->filterTests());
        $this->assertSame($filterActions, $filterRule->filterActions());

        $filterRule->name('name')
                   ->active(true)
                   ->filterTests($filterTests)
                   ->filterActions($filterActions);
        $this->assertSame('name', $filterRule->name());
        $this->assertTrue($filterRule->active());
        $this->assertSame($filterTests, $filterRule->filterTests());
        $this->assertSame($filterActions, $filterRule->filterActions());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterRule name="name" active="true">'
                .'<filterTests condition="allof">'
                    .'<addressBookTest index="10" negative="true" header="header" />'
                    .'<addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                    .'<attachmentTest index="10" negative="true" />'
                    .'<bodyTest index="10" negative="true" value="value" caseSensitive="true" />'
                    .'<bulkTest index="10" negative="true" />'
                    .'<contactRankingTest index="10" negative="true" header="header" />'
                    .'<conversationTest index="10" negative="true" where="where" />'
                    .'<currentDayOfWeekTest index="10" negative="true" value="value" />'
                    .'<currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />'
                    .'<dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />'
                    .'<facebookTest index="10" negative="true" />'
                    .'<flaggedTest index="10" negative="true" flagName="flagName" />'
                    .'<headerExistsTest index="10" negative="true" header="header" />'
                    .'<headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                    .'<importanceTest index="10" negative="true" imp="high" />'
                    .'<inviteTest index="10" negative="true">'
                        .'<method>method</method>'
                    .'</inviteTest>'
                    .'<linkedinTest index="10" negative="true" />'
                    .'<listTest index="10" negative="true" />'
                    .'<meTest index="10" negative="true" header="header" />'
                    .'<mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                    .'<sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />'
                    .'<socialcastTest index="10" negative="true" />'
                    .'<trueTest index="10" negative="true" />'
                    .'<twitterTest index="10" negative="true" />'
                .'</filterTests>'
                .'<filterActions>'
                    .'<actionKeep index="10" />'
                    .'<actionDiscard index="10" />'
                    .'<actionFileInto index="10" folderPath="folderPath" />'
                    .'<actionFlag index="10" flagName="flagName" />'
                    .'<actionTag index="10" tagName="tagName" />'
                    .'<actionRedirect index="10" a="a" />'
                    .'<actionReply index="10">'
                        .'<content>content</content>'
                    .'</actionReply>'
                    .'<actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                        .'<content>content</content>'
                    .'</actionNotify>'
                    .'<actionStop index="10" />'
                .'</filterActions>'
            .'</filterRule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterRule);

        $array = array(
            'filterRule' => array(
                'name' => 'name',
                'active' => true,
                'filterTests' => array(
                    'condition' => 'allof',
                    'addressBookTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                    ),
                    'addressTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                        'part' => 'part',
                        'stringComparison' => 'stringComparison',
                        'value' => 'value',
                        'caseSensitive' => true,
                    ),
                    'attachmentTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'bodyTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'value' => 'value',
                        'caseSensitive' => true,
                    ),
                    'bulkTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'contactRankingTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                    ),
                    'conversationTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'where' => 'where',
                    ),
                    'currentDayOfWeekTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'value' => 'value',
                    ),
                    'currentTimeTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'dateComparison' => 'dateComparison',
                        'time' => 'time',
                    ),
                    'dateTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'dateComparison' => 'dateComparison',
                        'd' => 10,
                    ),
                    'facebookTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'flaggedTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'flagName' => 'flagName',
                    ),
                    'headerExistsTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                    ),
                    'headerTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                        'stringComparison' => 'stringComparison',
                        'value' => 'value',
                        'caseSensitive' => true,
                    ),
                    'importanceTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'imp' => 'high',
                    ),
                    'inviteTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'method' => array(
                            'method',
                        ),
                    ),
                    'linkedinTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'listTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'meTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                    ),
                    'mimeHeaderTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'header' => 'header',
                        'stringComparison' => 'stringComparison',
                        'value' => 'value',
                        'caseSensitive' => true,
                    ),
                    'sizeTest' => array(
                        'index' => 10,
                        'negative' => true,
                        'numberComparison' => 'numberComparison',
                        's' => 's',
                    ),
                    'socialcastTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'trueTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                    'twitterTest' => array(
                        'index' => 10,
                        'negative' => true,
                    ),
                ),
                'filterActions' => array(
                    'actionKeep' => array(
                        'index' => 10,
                    ),
                    'actionDiscard' => array(
                        'index' => 10,
                    ),
                    'actionFileInto' => array(
                        'index' => 10,
                        'folderPath' => 'folderPath',
                    ),
                    'actionFlag' => array(
                        'index' => 10,
                        'flagName' => 'flagName',
                    ),
                    'actionTag' => array(
                        'index' => 10,
                        'tagName' => 'tagName',
                    ),
                    'actionRedirect' => array(
                        'index' => 10,
                        'a' => 'a',
                    ),
                    'actionReply' => array(
                        'index' => 10,
                        'content' => 'content',
                    ),
                    'actionNotify' => array(
                        'index' => 10,
                        'content' => 'content',
                        'a' => 'a',
                        'su' => 'su',
                        'maxBodySize' => 10,
                        'origHeaders' => 'origHeaders',
                    ),
                    'actionStop' => array(
                        'index' => 10,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $filterRule->toArray());
    }

    public function testFilterRules()
    {
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            10, 'header', true
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            10, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            10, true
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            10, 'value', true, true
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            10, true
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            10, 'header', true
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            10, 'where', true
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            10, 'value', true
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            10, 'dateComparison', 'time', true
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            10, 'dateComparison', 10, true
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            10, true
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            10, 'flagName', true
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            10, 'header', true
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            10, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            10, array('method'), true
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            10, true
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            10, true
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            10, 'header', true
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            10, 'numberComparison', 's', true
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            10, true
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            10, true
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            10, true
        );
        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            FilterCondition::ALL_OF(),
            $addressBookTest,
            $addressTest,
            $attachmentTest,
            $bodyTest,
            $bulkTest,
            $contactRankingTest,
            $conversationTest,
            $currentDayOfWeekTest,
            $currentTimeTest,
            $dateTest,
            $facebookTest,
            $flaggedTest,
            $headerExistsTest,
            $headerTest,
            $importanceTest,
            $inviteTest,
            $linkedinTest,
            $listTest,
            $meTest,
            $mimeHeaderTest,
            $sizeTest,
            $socialcastTest,
            $trueTest,
            $twitterTest
        );

        $actionKeep = new \Zimbra\Mail\Struct\KeepAction(
            10
        );
        $actionDiscard = new \Zimbra\Mail\Struct\DiscardAction(
            10
        );
        $actionFileInto = new \Zimbra\Mail\Struct\FileIntoAction(
            10, 'folderPath'
        );
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction(
            10, 'flagName'
        );
        $actionTag = new \Zimbra\Mail\Struct\TagAction(
            10, 'tagName'
        );
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction(
            10, 'a'
        );
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction(
            10, 'content'
        );
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            10, 'content', 'a', 'su', 10, 'origHeaders'
        );
        $actionStop = new \Zimbra\Mail\Struct\StopAction(
            10
        );
        $filterActions = new \Zimbra\Mail\Struct\FilterActions(
            $actionKeep,
            $actionDiscard,
            $actionFileInto,
            $actionFlag,
            $actionTag,
            $actionRedirect,
            $actionReply,
            $actionNotify,
            $actionStop
        );

        $filterRule = new \Zimbra\Mail\Struct\FilterRule(
            'name', true, $filterTests, $filterActions
        );

        $filterRules = new \Zimbra\Mail\Struct\FilterRules(
            array($filterRule)
        );
        $this->assertSame(array($filterRule), $filterRules->filterRule()->all());

        $filterRules->addFilterRule($filterRule);
        $this->assertSame(array($filterRule, $filterRule), $filterRules->filterRule()->all());
        $filterRules->filterRule()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterRules>'
                .'<filterRule name="name" active="true">'
                    .'<filterTests condition="allof">'
                        .'<addressBookTest index="10" negative="true" header="header" />'
                        .'<addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                        .'<attachmentTest index="10" negative="true" />'
                        .'<bodyTest index="10" negative="true" value="value" caseSensitive="true" />'
                        .'<bulkTest index="10" negative="true" />'
                        .'<contactRankingTest index="10" negative="true" header="header" />'
                        .'<conversationTest index="10" negative="true" where="where" />'
                        .'<currentDayOfWeekTest index="10" negative="true" value="value" />'
                        .'<currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />'
                        .'<dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />'
                        .'<facebookTest index="10" negative="true" />'
                        .'<flaggedTest index="10" negative="true" flagName="flagName" />'
                        .'<headerExistsTest index="10" negative="true" header="header" />'
                        .'<headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                        .'<importanceTest index="10" negative="true" imp="high" />'
                        .'<inviteTest index="10" negative="true">'
                            .'<method>method</method>'
                        .'</inviteTest>'
                        .'<linkedinTest index="10" negative="true" />'
                        .'<listTest index="10" negative="true" />'
                        .'<meTest index="10" negative="true" header="header" />'
                        .'<mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                        .'<sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />'
                        .'<socialcastTest index="10" negative="true" />'
                        .'<trueTest index="10" negative="true" />'
                        .'<twitterTest index="10" negative="true" />'
                    .'</filterTests>'
                    .'<filterActions>'
                        .'<actionKeep index="10" />'
                        .'<actionDiscard index="10" />'
                        .'<actionFileInto index="10" folderPath="folderPath" />'
                        .'<actionFlag index="10" flagName="flagName" />'
                        .'<actionTag index="10" tagName="tagName" />'
                        .'<actionRedirect index="10" a="a" />'
                        .'<actionReply index="10">'
                            .'<content>content</content>'
                        .'</actionReply>'
                        .'<actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                            .'<content>content</content>'
                        .'</actionNotify>'
                        .'<actionStop index="10" />'
                    .'</filterActions>'
                .'</filterRule>'
            .'</filterRules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterRules);

        $array = array(
            'filterRules' => array(
                'filterRule' => array(
                    array(
                        'name' => 'name',
                        'active' => true,
                        'filterTests' => array(
                            'condition' => 'allof',
                            'addressBookTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                            ),
                            'addressTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                                'part' => 'part',
                                'stringComparison' => 'stringComparison',
                                'value' => 'value',
                                'caseSensitive' => true,
                            ),
                            'attachmentTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'bodyTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'value' => 'value',
                                'caseSensitive' => true,
                            ),
                            'bulkTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'contactRankingTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                            ),
                            'conversationTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'where' => 'where',
                            ),
                            'currentDayOfWeekTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'value' => 'value',
                            ),
                            'currentTimeTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'dateComparison' => 'dateComparison',
                                'time' => 'time',
                            ),
                            'dateTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'dateComparison' => 'dateComparison',
                                'd' => 10,
                            ),
                            'facebookTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'flaggedTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'flagName' => 'flagName',
                            ),
                            'headerExistsTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                            ),
                            'headerTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                                'stringComparison' => 'stringComparison',
                                'value' => 'value',
                                'caseSensitive' => true,
                            ),
                            'importanceTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'imp' => 'high',
                            ),
                            'inviteTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'method' => array(
                                    'method',
                                ),
                            ),
                            'linkedinTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'listTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'meTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                            ),
                            'mimeHeaderTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'header' => 'header',
                                'stringComparison' => 'stringComparison',
                                'value' => 'value',
                                'caseSensitive' => true,
                            ),
                            'sizeTest' => array(
                                'index' => 10,
                                'negative' => true,
                                'numberComparison' => 'numberComparison',
                                's' => 's',
                            ),
                            'socialcastTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'trueTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                            'twitterTest' => array(
                                'index' => 10,
                                'negative' => true,
                            ),
                        ),
                        'filterActions' => array(
                            'actionKeep' => array(
                                'index' => 10,
                            ),
                            'actionDiscard' => array(
                                'index' => 10,
                            ),
                            'actionFileInto' => array(
                                'index' => 10,
                                'folderPath' => 'folderPath',
                            ),
                            'actionFlag' => array(
                                'index' => 10,
                                'flagName' => 'flagName',
                            ),
                            'actionTag' => array(
                                'index' => 10,
                                'tagName' => 'tagName',
                            ),
                            'actionRedirect' => array(
                                'index' => 10,
                                'a' => 'a',
                            ),
                            'actionReply' => array(
                                'index' => 10,
                                'content' => 'content',
                            ),
                            'actionNotify' => array(
                                'index' => 10,
                                'content' => 'content',
                                'a' => 'a',
                                'su' => 'su',
                                'maxBodySize' => 10,
                                'origHeaders' => 'origHeaders',
                            ),
                            'actionStop' => array(
                                'index' => 10,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $filterRules->toArray());
    }

    public function testFilterTest()
    {
        $filterTest = new \Zimbra\Mail\Struct\FilterTest(
            10, true
        );
        $this->assertSame(10, $filterTest->index());
        $this->assertTrue($filterTest->negative());

        $filterTest->index(10)
                   ->negative(true);
        $this->assertSame(10, $filterTest->index());
        $this->assertTrue($filterTest->negative());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterTest);

        $array = array(
            'filterTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $filterTest->toArray());
    }

    public function testFilterTests()
    {
        $addressBookTest = new \Zimbra\Mail\Struct\AddressBookTest(
            10, 'header', true
        );
        $addressTest = new \Zimbra\Mail\Struct\AddressTest(
            10, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $attachmentTest = new \Zimbra\Mail\Struct\AttachmentTest(
            10, true
        );
        $bodyTest = new \Zimbra\Mail\Struct\BodyTest(
            10, 'value', true, true
        );
        $bulkTest = new \Zimbra\Mail\Struct\BulkTest(
            10, true
        );
        $contactRankingTest = new \Zimbra\Mail\Struct\ContactRankingTest(
            10, 'header', true
        );
        $conversationTest = new \Zimbra\Mail\Struct\ConversationTest(
            10, 'where', true
        );
        $currentDayOfWeekTest = new \Zimbra\Mail\Struct\CurrentDayOfWeekTest(
            10, 'value', true
        );
        $currentTimeTest = new \Zimbra\Mail\Struct\CurrentTimeTest(
            10, 'dateComparison', 'time', true
        );
        $dateTest = new \Zimbra\Mail\Struct\DateTest(
            10, 'dateComparison', 10, true
        );
        $facebookTest = new \Zimbra\Mail\Struct\FacebookTest(
            10, true
        );
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            10, 'flagName', true
        );
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            10, 'header', true
        );
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            10, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            10, array('method'), true
        );
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            10, true
        );
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            10, true
        );
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            10, 'header', true
        );
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            10, 'numberComparison', 's', true
        );
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            10, true
        );
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            10, true
        );
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            10, true
        );

        $filterTests = new \Zimbra\Mail\Struct\FilterTests(
            FilterCondition::ALL_OF(),
            $addressBookTest,
            $addressTest,
            $attachmentTest,
            $bodyTest,
            $bulkTest,
            $contactRankingTest,
            $conversationTest,
            $currentDayOfWeekTest,
            $currentTimeTest,
            $dateTest,
            $facebookTest,
            $flaggedTest,
            $headerExistsTest,
            $headerTest,
            $importanceTest,
            $inviteTest,
            $linkedinTest,
            $listTest,
            $meTest,
            $mimeHeaderTest,
            $sizeTest,
            $socialcastTest,
            $trueTest,
            $twitterTest
        );
        $this->assertTrue($filterTests->condition()->is('allof'));
        $this->assertSame($addressBookTest, $filterTests->addressBookTest());
        $this->assertSame($addressTest, $filterTests->addressTest());
        $this->assertSame($attachmentTest, $filterTests->attachmentTest());
        $this->assertSame($bodyTest, $filterTests->bodyTest());
        $this->assertSame($bulkTest, $filterTests->bulkTest());
        $this->assertSame($contactRankingTest, $filterTests->contactRankingTest());
        $this->assertSame($conversationTest, $filterTests->conversationTest());
        $this->assertSame($currentDayOfWeekTest, $filterTests->currentDayOfWeekTest());
        $this->assertSame($currentTimeTest, $filterTests->currentTimeTest());
        $this->assertSame($dateTest, $filterTests->dateTest());
        $this->assertSame($facebookTest, $filterTests->facebookTest());
        $this->assertSame($flaggedTest, $filterTests->flaggedTest());
        $this->assertSame($headerExistsTest, $filterTests->headerExistsTest());
        $this->assertSame($headerTest, $filterTests->headerTest());
        $this->assertSame($importanceTest, $filterTests->importanceTest());
        $this->assertSame($inviteTest, $filterTests->inviteTest());
        $this->assertSame($linkedinTest, $filterTests->linkedinTest());
        $this->assertSame($listTest, $filterTests->listTest());
        $this->assertSame($meTest, $filterTests->meTest());
        $this->assertSame($mimeHeaderTest, $filterTests->mimeHeaderTest());
        $this->assertSame($sizeTest, $filterTests->sizeTest());
        $this->assertSame($socialcastTest, $filterTests->socialcastTest());
        $this->assertSame($trueTest, $filterTests->trueTest());
        $this->assertSame($twitterTest, $filterTests->twitterTest());

        $filterTests->condition(FilterCondition::ALL_OF())
                    ->addressBookTest($addressBookTest)
                    ->addressTest($addressTest)
                    ->attachmentTest($attachmentTest)
                    ->bodyTest($bodyTest)
                    ->bulkTest($bulkTest)
                    ->contactRankingTest($contactRankingTest)
                    ->conversationTest($conversationTest)
                    ->currentDayOfWeekTest($currentDayOfWeekTest)
                    ->currentTimeTest($currentTimeTest)
                    ->dateTest($dateTest)
                    ->facebookTest($facebookTest)
                    ->flaggedTest($flaggedTest)
                    ->headerExistsTest($headerExistsTest)
                    ->headerTest($headerTest)
                    ->importanceTest($importanceTest)
                    ->inviteTest($inviteTest)
                    ->linkedinTest($linkedinTest)
                    ->listTest($listTest)
                    ->meTest($meTest)
                    ->mimeHeaderTest($mimeHeaderTest)
                    ->sizeTest($sizeTest)
                    ->socialcastTest($socialcastTest)
                    ->trueTest($trueTest)
                    ->twitterTest($twitterTest);
        $this->assertTrue($filterTests->condition()->is('allof'));
        $this->assertSame($addressBookTest, $filterTests->addressBookTest());
        $this->assertSame($addressTest, $filterTests->addressTest());
        $this->assertSame($attachmentTest, $filterTests->attachmentTest());
        $this->assertSame($bodyTest, $filterTests->bodyTest());
        $this->assertSame($bulkTest, $filterTests->bulkTest());
        $this->assertSame($contactRankingTest, $filterTests->contactRankingTest());
        $this->assertSame($conversationTest, $filterTests->conversationTest());
        $this->assertSame($currentDayOfWeekTest, $filterTests->currentDayOfWeekTest());
        $this->assertSame($currentTimeTest, $filterTests->currentTimeTest());
        $this->assertSame($dateTest, $filterTests->dateTest());
        $this->assertSame($facebookTest, $filterTests->facebookTest());
        $this->assertSame($flaggedTest, $filterTests->flaggedTest());
        $this->assertSame($headerExistsTest, $filterTests->headerExistsTest());
        $this->assertSame($headerTest, $filterTests->headerTest());
        $this->assertSame($importanceTest, $filterTests->importanceTest());
        $this->assertSame($inviteTest, $filterTests->inviteTest());
        $this->assertSame($linkedinTest, $filterTests->linkedinTest());
        $this->assertSame($listTest, $filterTests->listTest());
        $this->assertSame($meTest, $filterTests->meTest());
        $this->assertSame($mimeHeaderTest, $filterTests->mimeHeaderTest());
        $this->assertSame($sizeTest, $filterTests->sizeTest());
        $this->assertSame($socialcastTest, $filterTests->socialcastTest());
        $this->assertSame($trueTest, $filterTests->trueTest());
        $this->assertSame($twitterTest, $filterTests->twitterTest());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterTests condition="allof">'
                .'<addressBookTest index="10" negative="true" header="header" />'
                .'<addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                .'<attachmentTest index="10" negative="true" />'
                .'<bodyTest index="10" negative="true" value="value" caseSensitive="true" />'
                .'<bulkTest index="10" negative="true" />'
                .'<contactRankingTest index="10" negative="true" header="header" />'
                .'<conversationTest index="10" negative="true" where="where" />'
                .'<currentDayOfWeekTest index="10" negative="true" value="value" />'
                .'<currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />'
                .'<dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />'
                .'<facebookTest index="10" negative="true" />'
                .'<flaggedTest index="10" negative="true" flagName="flagName" />'
                .'<headerExistsTest index="10" negative="true" header="header" />'
                .'<headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                .'<importanceTest index="10" negative="true" imp="high" />'
                .'<inviteTest index="10" negative="true">'
                    .'<method>method</method>'
                .'</inviteTest>'
                .'<linkedinTest index="10" negative="true" />'
                .'<listTest index="10" negative="true" />'
                .'<meTest index="10" negative="true" header="header" />'
                .'<mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                .'<sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />'
                .'<socialcastTest index="10" negative="true" />'
                .'<trueTest index="10" negative="true" />'
                .'<twitterTest index="10" negative="true" />'
            .'</filterTests>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterTests);

        $array = array(
            'filterTests' => array(
                'condition' => 'allof',
                'addressBookTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                ),
                'addressTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                    'part' => 'part',
                    'stringComparison' => 'stringComparison',
                    'value' => 'value',
                    'caseSensitive' => true,
                ),
                'attachmentTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'bodyTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'value' => 'value',
                    'caseSensitive' => true,
                ),
                'bulkTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'contactRankingTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                ),
                'conversationTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'where' => 'where',
                ),
                'currentDayOfWeekTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'value' => 'value',
                ),
                'currentTimeTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'dateComparison' => 'dateComparison',
                    'time' => 'time',
                ),
                'dateTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'dateComparison' => 'dateComparison',
                    'd' => 10,
                ),
                'facebookTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'flaggedTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'flagName' => 'flagName',
                ),
                'headerExistsTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                ),
                'headerTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                    'stringComparison' => 'stringComparison',
                    'value' => 'value',
                    'caseSensitive' => true,
                ),
                'importanceTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'imp' => 'high',
                ),
                'inviteTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'method' => array(
                        'method',
                    ),
                ),
                'linkedinTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'listTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'meTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                ),
                'mimeHeaderTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'header' => 'header',
                    'stringComparison' => 'stringComparison',
                    'value' => 'value',
                    'caseSensitive' => true,
                ),
                'sizeTest' => array(
                    'index' => 10,
                    'negative' => true,
                    'numberComparison' => 'numberComparison',
                    's' => 's',
                ),
                'socialcastTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'trueTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
                'twitterTest' => array(
                    'index' => 10,
                    'negative' => true,
                ),
            ),
        );
        $this->assertEquals($array, $filterTests->toArray());
    }

    public function testFlagAction()
    {
        $actionFlag = new \Zimbra\Mail\Struct\FlagAction(
            10, 'flagName'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionFlag);
        $this->assertSame('flagName', $actionFlag->flagName());
        $actionFlag->flagName('flagName');
        $this->assertSame('flagName', $actionFlag->flagName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionFlag index="10" flagName="flagName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionFlag);

        $array = array(
            'actionFlag' => array(
                'index' => 10,
                'flagName' => 'flagName',
            ),
        );
        $this->assertEquals($array, $actionFlag->toArray());
    }

    public function testFlaggedTest()
    {
        $flaggedTest = new \Zimbra\Mail\Struct\FlaggedTest(
            10, 'flagName', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $flaggedTest);
        $this->assertSame('flagName', $flaggedTest->flagName());
        $flaggedTest->flagName('flagName');
        $this->assertSame('flagName', $flaggedTest->flagName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<flaggedTest index="10" negative="true" flagName="flagName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $flaggedTest);

        $array = array(
            'flaggedTest' => array(
                'index' => 10,
                'negative' => true,
                'flagName' => 'flagName',
            ),
        );
        $this->assertEquals($array, $flaggedTest->toArray());
    }

    public function testFolderActionSelector()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Mail\Struct\RetentionPolicyKeep(
            array($policy)
        );
        $policy = new \Zimbra\Mail\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Mail\Struct\RetentionPolicyPurge(
            array($policy)
        );
        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            $keep, $purge
        );
        $grant = new \Zimbra\Mail\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $acl = new \Zimbra\Mail\Struct\FolderActionSelectorAcl(
            array($grant)
        );

        $action = new \Zimbra\Mail\Struct\FolderActionSelector(
            FolderActionOp::READ(),
            'id',
            'tcon',
            10,
            'l',
            '#aabbcc',
            10,
            'name',
            'f',
            't',
            'tn',
            $grant,
            $acl,
            $retentionPolicy,
            true,
            'url',
            true,
            'zid',
            'gt',
            'view'
        );
        $this->assertTrue($action->op()->is('read'));
        $this->assertSame($grant, $action->grant());
        $this->assertSame($acl, $action->acl());
        $this->assertSame($retentionPolicy, $action->retentionPolicy());
        $this->assertTrue($action->recursive());
        $this->assertSame('url', $action->url());
        $this->assertTrue($action->excludeFreeBusy());
        $this->assertSame('zid', $action->zid());
        $this->assertSame('gt', $action->gt());
        $this->assertSame('view', $action->view());

        $action->op(FolderActionOp::READ())
               ->grant($grant)
               ->acl($acl)
               ->retentionPolicy($retentionPolicy)
               ->recursive(true)
               ->url('url')
               ->excludeFreeBusy(true)
               ->zid('zid')
               ->gt('gt')
               ->view('view');
        $this->assertTrue($action->op()->is('read'));
        $this->assertSame($grant, $action->grant());
        $this->assertSame($acl, $action->acl());
        $this->assertSame($retentionPolicy, $action->retentionPolicy());
        $this->assertTrue($action->recursive());
        $this->assertSame('url', $action->url());
        $this->assertTrue($action->excludeFreeBusy());
        $this->assertSame('zid', $action->zid());
        $this->assertSame('gt', $action->gt());
        $this->assertSame('view', $action->view());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="read" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" recursive="true" url="url" excludeFreeBusy="true" zid="zid" gt="gt" view="view">'
                .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                .'<acl>'
                    .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                .'</acl>'
                .'<retentionPolicy>'
                    .'<keep>'
                        .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
                    .'</keep>'
                    .'<purge>'
                        .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
                    .'</purge>'
                .'</retentionPolicy>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'read',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'recursive' => true,
                'url' => 'url',
                'excludeFreeBusy' => true,
                'zid' => 'zid',
                'gt' => 'gt',
                'view' => 'view',
                'grant' => array(
                    'perm' => 'perm',
                    'gt' => 'usr',
                    'zid' => 'zid',
                    'd' => 'd',
                    'args' => 'args',
                    'pw' => 'pw',
                    'key' => 'key',
                ),
                'acl' => array(
                    'grant' => array(
                        array(
                            'perm' => 'perm',
                            'gt' => 'usr',
                            'zid' => 'zid',
                            'd' => 'd',
                            'args' => 'args',
                            'pw' => 'pw',
                            'key' => 'key',
                        ),
                    ),
                ),
                'retentionPolicy' => array(
                    'keep' => array(
                        'policy' => array(
                            array(
                                'type' => 'system',
                                'id' => 'id',
                                'name' => 'name',
                                'lifetime' => 'lifetime',
                            ),
                        ),
                    ),
                    'purge' => array(
                        'policy' => array(
                            array(
                                'type' => 'user',
                                'id' => 'id',
                                'name' => 'name',
                                'lifetime' => 'lifetime',
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testFolderActionSelectorAcl()
    {
        $grant = new \Zimbra\Mail\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $acl = new \Zimbra\Mail\Struct\FolderActionSelectorAcl(
            array($grant)
        );
        $this->assertSame(array($grant), $acl->grant()->all());
        $acl->addGrant($grant);
        $this->assertSame(array($grant, $grant), $acl->grant()->all());
        $acl->grant()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<acl>'
                .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
            .'</acl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = array(
            'acl' => array(
                'grant' => array(
                    array(
                        'perm' => 'perm',
                        'gt' => 'usr',
                        'zid' => 'zid',
                        'd' => 'd',
                        'args' => 'args',
                        'pw' => 'pw',
                        'key' => 'key',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $acl->toArray());
    }

    public function testFolderSpec()
    {
        $folder = new \Zimbra\Mail\Struct\FolderSpec(
            'l'
        );
        $this->assertSame('l', $folder->l());

        $folder->l('l');
        $this->assertSame('l', $folder->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<folder l="l" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $folder);

        $array = array(
            'folder' => array(
                'l' => 'l',
            ),
        );
        $this->assertEquals($array, $folder->toArray());
    }

    public function testFreeBusyUserSpec()
    {
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            10, 'id', 'name'
        );
        $this->assertSame(10, $usr->l());
        $this->assertSame('id', $usr->id());
        $this->assertSame('name', $usr->name());

        $usr->l(10)
            ->id('id')
            ->name('name');
        $this->assertSame(10, $usr->l());
        $this->assertSame('id', $usr->id());
        $this->assertSame('name', $usr->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<usr l="10" id="id" name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $usr);

        $array = array(
            'usr' => array(
                'l' => 10,
                'id' => 'id',
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $usr->toArray());
    }

    public function testGalDataSourceNameOrId()
    {
        $gal = new \Zimbra\Mail\Struct\GalDataSourceNameOrId('name', 'id');

        $xml = '<?xml version="1.0"?>'."\n"
            .'<gal name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $gal);

        $array = array(
            'gal' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $gal->toArray());
    }

    public function testGeoInfo()
    {
        $geo = new \Zimbra\Mail\Struct\GeoInfo(123.456, 654.321);
        $this->assertSame(123.456, $geo->lat());
        $this->assertSame(654.321, $geo->lon());

        $geo->lat(654.321)
            ->lon(123.456);
        $this->assertSame(654.321, $geo->lat());
        $this->assertSame(123.456, $geo->lon());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<geo lat="654.321" lon="123.456" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $geo);

        $array = array(
            'geo' => array(
                'lat' => 654.321,
                'lon' => 123.456,
            ),
        );
        $this->assertEquals($array, $geo->toArray());
    }

    public function testGetFolderSpec()
    {
        $folder = new \Zimbra\Mail\Struct\GetFolderSpec(
            'uuid', 'l', 'path'
        );
        $this->assertSame('uuid', $folder->uuid());
        $this->assertSame('l', $folder->l());
        $this->assertSame('path', $folder->path());

        $folder->uuid('uuid')
               ->l('l')
               ->path('path');
        $this->assertSame('uuid', $folder->uuid());
        $this->assertSame('l', $folder->l());
        $this->assertSame('path', $folder->path());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<folder uuid="uuid" l="l" path="path" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $folder);

        $array = array(
            'folder' => array(
                'uuid' => 'uuid',
                'l' => 'l',
                'path' => 'path',
            ),
        );
        $this->assertEquals($array, $folder->toArray());
    }

    public function testHeader()
    {
        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $this->assertSame('name', $header->name());
        $this->assertSame('value', $header->value());

        $header->name('name')
               ->value('value');
        $this->assertSame('name', $header->name());
        $this->assertSame('value', $header->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<header name="name">value</header>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $header);

        $array = array(
            'header' => array(
                'name' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $header->toArray());
    }

    public function testHeaderExistsTest()
    {
        $headerExistsTest = new \Zimbra\Mail\Struct\HeaderExistsTest(
            10, 'header', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $headerExistsTest);
        $this->assertSame('header', $headerExistsTest->header());
        $headerExistsTest->header('header');
        $this->assertSame('header', $headerExistsTest->header());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<headerExistsTest index="10" negative="true" header="header" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $headerExistsTest);

        $array = array(
            'headerExistsTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
            ),
        );
        $this->assertEquals($array, $headerExistsTest->toArray());
    }

    public function testHeaderTest()
    {
        $headerTest = new \Zimbra\Mail\Struct\HeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $headerTest);
        $this->assertSame('header', $headerTest->header());
        $this->assertSame('stringComparison', $headerTest->stringComparison());
        $this->assertSame('value', $headerTest->value());
        $this->assertTrue($headerTest->caseSensitive());

        $headerTest->header('header')
                   ->stringComparison('stringComparison')
                   ->value('value')
                   ->caseSensitive(true);
        $this->assertSame('header', $headerTest->header());
        $this->assertSame('stringComparison', $headerTest->stringComparison());
        $this->assertSame('value', $headerTest->value());
        $this->assertTrue($headerTest->caseSensitive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $headerTest);

        $array = array(
            'headerTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
                'stringComparison' => 'stringComparison',
                'value' => 'value',
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $headerTest->toArray());
    }

    public function testIdsAttr()
    {
        $m = new \Zimbra\Mail\Struct\IdsAttr(
            'ids'
        );
        $this->assertSame('ids', $m->ids());

        $m->ids('ids');
        $this->assertSame('ids', $m->ids());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m ids="ids" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'ids' => 'ids',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testIdStatus()
    {
        $device = new \Zimbra\Mail\Struct\IdStatus(
            'id', 'status'
        );
        $this->assertSame('id', $device->id());
        $this->assertSame('status', $device->status());

        $device->id('id')
        	   ->status('status');
        $this->assertSame('id', $device->id());
        $this->assertSame('status', $device->status());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<device id="id" status="status" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $device);

        $array = array(
            'device' => array(
                'id' => 'id',
                'status' => 'status',
            ),
        );
        $this->assertEquals($array, $device->toArray());
    }

    public function testIdVersion()
    {
        $doc = new \Zimbra\Mail\Struct\IdVersion(
            'id', 10
        );
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());

        $doc->id('id')
            ->ver(10);
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc id="id" ver="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => 'id',
                'ver' => 10,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testImapDataSourceNameOrId()
    {
        $imap = new \Zimbra\Mail\Struct\ImapDataSourceNameOrId('name', 'id');

        $xml = '<?xml version="1.0"?>'."\n"
            .'<imap name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $imap);

        $array = array(
            'imap' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $imap->toArray());
    }

    public function testImportanceTest()
    {
        $importanceTest = new \Zimbra\Mail\Struct\ImportanceTest(
            10, Importance::HIGH(), true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $importanceTest);
        $this->assertTrue($importanceTest->imp()->is('high'));
        $importanceTest->imp(Importance::HIGH());
        $this->assertTrue($importanceTest->imp()->is('high'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<importanceTest index="10" negative="true" imp="high" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $importanceTest);

        $array = array(
            'importanceTest' => array(
                'index' => 10,
                'negative' => true,
                'imp' => 'high',
            ),
        );
        $this->assertEquals($array, $importanceTest->toArray());
    }

    public function testInstanceRecurIdInfo()
    {
        $inst = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $this->assertSame('range', $inst->range());
        $this->assertSame('20130315T18302305Z', $inst->d());
        $this->assertSame('tz', $inst->tz());

        $inst->range('range')
          ->d('20130315T18302305Z')
          ->tz('tz');
        $this->assertSame('range', $inst->range());
        $this->assertSame('20130315T18302305Z', $inst->d());
        $this->assertSame('tz', $inst->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<inst range="range" d="20130315T18302305Z" tz="tz" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inst);

        $array = array(
            'inst' => array(
                'range' => 'range',
                'd' => '20130315T18302305Z',
                'tz' => 'tz',
            ),
        );
        $this->assertEquals($array, $inst->toArray());
    }

    public function testIntervalRule()
    {
        $interval = new \Zimbra\Mail\Struct\IntervalRule(20120315);
        $this->assertSame(20120315, $interval->ival());
        $interval->ival(20120315);
        $this->assertSame(20120315, $interval->ival());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<interval ival="20120315" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $interval);

        $array = array(
            'interval' => array(
                'ival' => 20120315,
            ),
        );
        $this->assertEquals($array, $interval->toArray());
    }

    public function testInvitationInfo()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $content = new \Zimbra\Mail\Struct\RawInvite('uid', 'value', 'summary');
        $tz = new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $comp = new \Zimbra\Mail\Struct\InviteComponent('method', 10, true);

        $inv = new \Zimbra\Mail\Struct\InvitationInfo(
            'method',
            10,
            true
        );

        $inv->content($content)
            ->comp($comp)
            ->addTz($tz)
            ->addMp($mp)
            ->attach($attach)
            ->id('id')
            ->ct('ct')
            ->ci('ci');

        $this->assertSame($content, $inv->content());
        $this->assertSame($comp, $inv->comp());
        $this->assertSame(array($tz), $inv->tz()->all());
        $this->assertSame(array($mp), $inv->mp()->all());
        $this->assertSame($attach, $inv->attach());
        $this->assertSame('id', $inv->id());
        $this->assertSame('ct', $inv->ct());
        $this->assertSame('ci', $inv->ci());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<inv method="method" compNum="10" rsvp="true" id="id" ct="ct" ci="ci">'
                .'<content uid="uid" summary="summary">value</content>'
                .'<comp method="method" compNum="10" rsvp="true" />'
                .'<attach aid="aid">'
                    .'<mp optional="true" mid="mid" part="part" />'
                    .'<m optional="false" id="id" />'
                    .'<cn optional="false" id="id" />'
                    .'<doc optional="true" path="path" id="id" ver="10" />'
                .'</attach>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn optional="false" id="id" />'
                        .'<doc optional="true" path="path" id="id" ver="10" />'
                    .'</attach>'
                    .'<mp ct="ct" content="content" ci="ci" />'
                .'</mp>'
            .'</inv>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inv);

        $array = array(
            'inv' => array(
                'method' => 'method',
                'compNum' => 10,
                'rsvp' => true,
                'id' => 'id',
                'ct' => 'ct',
                'ci' => 'ci',
                'content' => array(
                    '_' => 'value',
                    'uid' => 'uid',
                    'summary' => 'summary',
                ),
                'comp' => array(
                    'method' => 'method',
                    'compNum' => 10,
                    'rsvp' => true,
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 12,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 10,
                        ),
                    ),
                ),
                'mp' => array(
                    array(
                        'ct' => 'ct',
                        'content' => 'content',
                        'ci' => 'ci',
                        'mp' => array(
                            array(
                                'ct' => 'ct',
                                'content' => 'content',
                                'ci' => 'ci',
                            ),
                        ),
                        'attach' => array(
                            'aid' => 'aid',
                            'mp' => array(
                                'mid' => 'mid',
                                'part' => 'part',
                                'optional' => true,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => false,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => false,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 10,
                                'optional' => true,
                            ),
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 10,
                        'optional' => true,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $inv->toArray());
    }

    public function testInviteComponent()
    {
        $xparam = new \Zimbra\Mail\Struct\XParam('name', 'value');
        $at = new \Zimbra\Mail\Struct\CalendarAttendee(array($xparam)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang', 'cutype', 'role', ParticipationStatus::NE(), true, 'member', 'delTo', 'delFrom'
        );
        $abs = new \Zimbra\Mail\Struct\DateAttr('20120315T18302305Z');
        $rel = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $trigger = new \Zimbra\Mail\Struct\AlarmTriggerInfo($abs, $rel);
        $repeat = new \Zimbra\Mail\Struct\DurationInfo(false, 7, 2, 3, 4, 5, 'START', 6);
        $attach = new \Zimbra\Mail\Struct\CalendarAttach('uri', 'ct', 'value');
        $except = new \Zimbra\Mail\Struct\ExceptionRuleInfo(
            10, '991231', null, null, 'tz', '991231000000'
        );
        $cancel = new \Zimbra\Mail\Struct\CancelRuleInfo(
            10, '991231', 'tz', '991231000000'
        );
        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Mail\Struct\SingleDates(array($dtval), 'tz');
        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), 10);
        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Mail\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Mail\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Mail\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Mail\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Mail\Struct\XNameRule('name', 'value');
        $rule = new \Zimbra\Mail\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );
        $add = new \Zimbra\Mail\Struct\AddRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $exclude = new \Zimbra\Mail\Struct\ExcludeRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);

        $geo = new \Zimbra\Mail\Struct\GeoInfo(123.456, 654.321);
        $xprop = new \Zimbra\Mail\Struct\XProp('name', 'value', array($xparam));
        $alarm = new \Zimbra\Mail\Struct\AlarmInfo(
            AlarmAction::DISPLAY(), $trigger, $repeat, 'desc', $attach, 'summary', array($at), array($xprop)
        );
        $org = new \Zimbra\Mail\Struct\CalOrganizer(array($xparam)
            , 'a', 'url', 'd', 'sentBy', 'dir', 'lang'
        );
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo($add, $exclude, $except, $cancel, $dates, $rule);
        $exceptId = new \Zimbra\Mail\Struct\ExceptionRecurIdInfo(
            '20120315T18302305Z', 'tz', -1
        );

        $comp = new \Zimbra\Mail\Struct\InviteComponent(
            'method',
            10,
            true,
            10,
            'name',
            'loc',
            10,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            10,
            10,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array(InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()),
            array('category1'),
            array('comment1'),
            array('contact1'),
            $geo,
            array($at),
            array($alarm),
            array($xprop),
            'fr',
            'desc',
            'descHtml',
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $this->assertSame(array('category1'), $comp->category()->all());
        $this->assertSame(array('comment1'), $comp->comment()->all());
        $this->assertSame(array('contact1'), $comp->contact()->all());
        $this->assertSame($geo, $comp->geo());
        $this->assertSame(array($at), $comp->at()->all());
        $this->assertSame(array($alarm), $comp->alarm()->all());
        $this->assertSame(array($xprop), $comp->xprop()->all());
        $this->assertSame('fr', $comp->fr());
        $this->assertSame('desc', $comp->desc());
        $this->assertSame('descHtml', $comp->descHtml());
        $this->assertSame($org, $comp->org());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($s, $comp->s());
        $this->assertSame($e, $comp->e());
        $this->assertSame($dur, $comp->dur());

        $comp->addCategory('category2')
             ->addComment('comment2')
             ->addContact('contact2')
             ->geo($geo)
             ->addAt($at)
             ->addAlarm($alarm)
             ->addXProp($xprop)
             ->fr('fr')
             ->desc('desc')
             ->descHtml('descHtml')
             ->org($org)
             ->recur($recur)
             ->exceptId($exceptId)
             ->s($s)
             ->e($e)
             ->dur($dur);
        $this->assertSame(array('category1', 'category2'), $comp->category()->all());
        $this->assertSame(array('comment1', 'comment2'), $comp->comment()->all());
        $this->assertSame(array('contact1', 'contact2'), $comp->contact()->all());
        $this->assertSame($geo, $comp->geo());
        $this->assertSame(array($at, $at), $comp->at()->all());
        $this->assertSame(array($alarm, $alarm), $comp->alarm()->all());
        $this->assertSame(array($xprop, $xprop), $comp->xprop()->all());
        $this->assertSame('fr', $comp->fr());
        $this->assertSame('desc', $comp->desc());
        $this->assertSame('descHtml', $comp->descHtml());
        $this->assertSame($org, $comp->org());
        $this->assertSame($recur, $comp->recur());
        $this->assertSame($exceptId, $comp->exceptId());
        $this->assertSame($s, $comp->s());
        $this->assertSame($e, $comp->e());
        $this->assertSame($dur, $comp->dur());

        $comp = new \Zimbra\Mail\Struct\InviteComponent(
            'method',
            10,
            true,
            10,
            'name',
            'loc',
            10,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            10,
            10,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array(InviteChange::SUBJECT(), InviteChange::LOCATION(), InviteChange::TIME()),
            array('category1', 'category2'),
            array('comment1', 'comment2'),
            array('contact1', 'contact2'),
            $geo,
            array($at),
            array($alarm),
            array($xprop),
            'fr',
            'desc',
            'descHtml',
            $org,
            $recur,
            $exceptId,
            $s,
            $e,
            $dur
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comp'
                .' method="method"'
                .' compNum="10"'
                .' rsvp="true"'
                .' priority="10"'
                .' name="name"'
                .' loc="loc"'
                .' percentComplete="10"'
                .' completed="20120315T18302305Z"'
                .' noBlob="true"'
                .' fba="F"'
                .' fb="F"'
                .' transp="O"'
                .' isOrg="true"'
                .' x_uid="x_uid"'
                .' uid="uid"'
                .' seq="10"'
                .' d="10"'
                .' calItemId="calItemId"'
                .' apptId="apptId"'
                .' ciFolder="ciFolder"'
                .' status="COMP"'
                .' class="PUB"'
                .' url="url"'
                .' ex="true"'
                .' ridZ="ridZ"'
                .' allDay="true"'
                .' draft="true"'
                .' neverSent="true"'
                .' changes="subject,location,time">'
                .'<geo lat="123.456" lon="654.321" />'
                .'<fr>fr</fr>'
                .'<desc>desc</desc>'
                .'<descHtml>descHtml</descHtml>'
                .'<or a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang">'
                    .'<xparam name="name" value="value" />'
                .'</or>'
                .'<recur>'
                    .'<add>'
                        .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<dates tz="tz">'
                            .'<dtval>'
                                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'</dtval>'
                        .'</dates>'
                        .'<rule freq="SEC">'
                            .'<until d="20120315T18302305Z" />'
                            .'<count num="20120315" />'
                            .'<interval ival="20120315" />'
                            .'<bysecond seclist="10,20,30" />'
                            .'<byminute minlist="10,20,30" />'
                            .'<byhour hrlist="5,10,15" />'
                            .'<byday>'
                                .'<wkday day="SU" ordwk="10" />'
                            .'</byday>'
                            .'<bymonthday modaylist="5,10,15" />'
                            .'<byyearday yrdaylist="5,10,15" />'
                            .'<byweekno wklist="5,10,15" />'
                            .'<bymonth molist="5,10" />'
                            .'<bysetpos poslist="5,10,15" />'
                            .'<wkst day="SU" />'
                            .'<rule-x-name name="name" value="value" />'
                        .'</rule>'
                    .'</add>'
                    .'<exclude>'
                        .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'<dates tz="tz">'
                            .'<dtval>'
                                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'</dtval>'
                        .'</dates>'
                        .'<rule freq="SEC">'
                            .'<until d="20120315T18302305Z" />'
                            .'<count num="20120315" />'
                            .'<interval ival="20120315" />'
                            .'<bysecond seclist="10,20,30" />'
                            .'<byminute minlist="10,20,30" />'
                            .'<byhour hrlist="5,10,15" />'
                            .'<byday>'
                                .'<wkday day="SU" ordwk="10" />'
                            .'</byday>'
                            .'<bymonthday modaylist="5,10,15" />'
                            .'<byyearday yrdaylist="5,10,15" />'
                            .'<byweekno wklist="5,10,15" />'
                            .'<bymonth molist="5,10" />'
                            .'<bysetpos poslist="5,10,15" />'
                            .'<wkst day="SU" />'
                            .'<rule-x-name name="name" value="value" />'
                        .'</rule>'
                    .'</exclude>'
                    .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="10" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</recur>'
                .'<exceptId d="20120315T18302305Z" tz="tz" rangeType="-1" />'
                .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'<category>category1</category>'
                .'<category>category2</category>'
                .'<comment>comment1</comment>'
                .'<comment>comment2</comment>'
                .'<contact>contact1</contact>'
                .'<contact>contact2</contact>'
                .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="true" member="member" delTo="delTo" delFrom="delFrom">'
                    .'<xparam name="name" value="value" />'
                .'</at>'
                .'<alarm action="DISPLAY">'
                    .'<trigger>'
                        .'<abs d="20120315T18302305Z" />'
                        .'<rel neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'</trigger>'
                    .'<repeat neg="false" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<desc>desc</desc>'
                    .'<attach uri="uri" ct="ct">value</attach>'
                    .'<summary>summary</summary>'
                    .'<at a="a" url="url" d="d" sentBy="sentBy" dir="dir" lang="lang" cutype="cutype" role="role" ptst="NE" rsvp="true" member="member" delTo="delTo" delFrom="delFrom">'
                        .'<xparam name="name" value="value" />'
                    .'</at>'
                    .'<xprop name="name" value="value">'
                        .'<xparam name="name" value="value" />'
                    .'</xprop>'
                .'</alarm>'
                .'<xprop name="name" value="value">'
                    .'<xparam name="name" value="value" />'
                .'</xprop>'
            .'</comp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => 'method',
                'compNum' => 10,
                'rsvp' => true,
                'priority' => 10,
                'name' => 'name',
                'loc' => 'loc',
                'percentComplete' => 10,
                'completed' => '20120315T18302305Z',
                'noBlob' => true,
                'fba' => 'F',
                'fb' => 'F',
                'transp' => 'O',
                'isOrg' => true,
                'x_uid' => 'x_uid',
                'uid' => 'uid',
                'seq' => 10,
                'd' => 10,
                'calItemId' => 'calItemId',
                'apptId' => 'apptId',
                'ciFolder' => 'ciFolder',
                'status' => 'COMP',
                'class' => 'PUB',
                'url' => 'url',
                'ex' => true,
                'ridZ' => 'ridZ',
                'allDay' => true,
                'draft' => true,
                'neverSent' => true,
                'changes' => 'subject,location,time',
                'category' => array(
                    'category1',
                    'category2',
                ),
                'comment' => array(
                    'comment1',
                    'comment2',
                ),
                'contact' => array(
                    'contact1',
                    'contact2',
                ),
                'geo' => array(
                    'lat' => 123.456,
                    'lon' => 654.321,
                ),
                'at' => array(
                    array(
                        'a' => 'a',
                        'url' => 'url',
                        'd' => 'd',
                        'sentBy' => 'sentBy',
                        'dir' => 'dir',
                        'lang' => 'lang',
                        'cutype' => 'cutype',
                        'role' => 'role',
                        'ptst' => 'NE',
                        'rsvp' => true,
                        'member' => 'member',
                        'delTo' => 'delTo',
                        'delFrom' => 'delFrom',
                        'xparam' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'alarm' => array(
                    array(
                        'action' => 'DISPLAY',
                        'trigger' => array(
                            'abs' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'rel' => array(
                                'neg' => true,
                                'w' => 7,
                                'd' => 2,
                                'h' => 3,
                                'm' => 4,
                                's' => 5,
                                'related' => 'START',
                                'count' => 6,
                            ),
                        ),
                        'repeat' => array(
                            'neg' => false,
                            'w' => 7,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'START',
                            'count' => 6,
                        ),
                        'desc' => 'desc',
                        'attach' => array(
                            'uri' => 'uri',
                            'ct' => 'ct',
                            '_' => 'value',
                        ),
                        'summary' => 'summary',
                        'at' => array(
                            array(
                                'a' => 'a',
                                'url' => 'url',
                                'd' => 'd',
                                'sentBy' => 'sentBy',
                                'dir' => 'dir',
                                'lang' => 'lang',
                                'cutype' => 'cutype',
                                'role' => 'role',
                                'ptst' => 'NE',
                                'rsvp' => true,
                                'member' => 'member',
                                'delTo' => 'delTo',
                                'delFrom' => 'delFrom',
                                'xparam' => array(
                                    array(
                                        'name' => 'name',
                                        'value' => 'value',
                                    ),
                                ),
                            ),
                        ),
                        'xprop' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                                'xparam' => array(
                                    array(
                                        'name' => 'name',
                                        'value' => 'value',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'xprop' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                        'xparam' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'fr' => 'fr',
                'desc' => 'desc',
                'descHtml' => 'descHtml',
                'or' => array(
                    'a' => 'a',
                    'url' => 'url',
                    'd' => 'd',
                    'sentBy' => 'sentBy',
                    'dir' => 'dir',
                    'lang' => 'lang',
                    'xparam' => array(
                        array(
                            'name' => 'name',
                            'value' => 'value',
                        ),
                    ),
                ),
                'recur' => array(
                    'add' => array(
                        'except' => array(
                            'rangeType' => 10,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'cancel' => array(
                            'rangeType' => 10,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'dates' => array(
                            'tz' => 'tz',
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => '20120315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 1000,
                                    ),
                                    'e' => array(
                                        'd' => '20130315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 2000,
                                    ),
                                    'dur' => array(
                                        'neg' => true,
                                        'w' => 7,
                                        'd' => 2,
                                        'h' => 3,
                                        'm' => 4,
                                        's' => 5,
                                        'related' => 'START',
                                        'count' => 6,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => 'SEC',
                            'until' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'count' => array(
                                'num' => 20120315,
                            ),
                            'interval' => array(
                                'ival' => 20120315,
                            ),
                            'bysecond' => array(
                                'seclist' => '10,20,30',
                            ),
                            'byminute' => array(
                                'minlist' => '10,20,30',
                            ),
                            'byhour' => array(
                                'hrlist' => '5,10,15',
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => 'SU',
                                        'ordwk' => 10,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => '5,10,15',
                            ),
                            'byyearday' => array(
                                'yrdaylist' => '5,10,15',
                            ),
                            'byweekno' => array(
                                'wklist' => '5,10,15',
                            ),
                            'bymonth' => array(
                                'molist' => '5,10',
                            ),
                            'bysetpos' => array(
                                'poslist' => '5,10,15',
                            ),
                            'wkst' => array(
                                'day' => 'SU',
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => 'name',
                                    'value' => 'value',
                                ),
                            ),
                        ),
                    ),
                    'exclude' => array(
                        'except' => array(
                            'rangeType' => 10,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'cancel' => array(
                            'rangeType' => 10,
                            'recurId' => '991231',
                            'tz' => 'tz',
                            'ridZ' => '991231000000',
                        ),
                        'dates' => array(
                            'tz' => 'tz',
                            'dtval' => array(
                                array(
                                    's' => array(
                                        'd' => '20120315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 1000,
                                    ),
                                    'e' => array(
                                        'd' => '20130315T18302305Z',
                                        'tz' => 'tz',
                                        'u' => 2000,
                                    ),
                                    'dur' => array(
                                        'neg' => true,
                                        'w' => 7,
                                        'd' => 2,
                                        'h' => 3,
                                        'm' => 4,
                                        's' => 5,
                                        'related' => 'START',
                                        'count' => 6,
                                    ),
                                ),
                            ),
                        ),
                        'rule' => array(
                            'freq' => 'SEC',
                            'until' => array(
                                'd' => '20120315T18302305Z',
                            ),
                            'count' => array(
                                'num' => 20120315,
                            ),
                            'interval' => array(
                                'ival' => 20120315,
                            ),
                            'bysecond' => array(
                                'seclist' => '10,20,30',
                            ),
                            'byminute' => array(
                                'minlist' => '10,20,30',
                            ),
                            'byhour' => array(
                                'hrlist' => '5,10,15',
                            ),
                            'byday' => array(
                                'wkday' => array(
                                    array(
                                        'day' => 'SU',
                                        'ordwk' => 10,
                                    ),
                                )
                            ),
                            'bymonthday' => array(
                                'modaylist' => '5,10,15',
                            ),
                            'byyearday' => array(
                                'yrdaylist' => '5,10,15',
                            ),
                            'byweekno' => array(
                                'wklist' => '5,10,15',
                            ),
                            'bymonth' => array(
                                'molist' => '5,10',
                            ),
                            'bysetpos' => array(
                                'poslist' => '5,10,15',
                            ),
                            'wkst' => array(
                                'day' => 'SU',
                            ),
                            'rule-x-name' => array(
                                array(
                                    'name' => 'name',
                                    'value' => 'value',
                                ),
                            ),
                        ),
                    ),
                    'except' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => 7,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 10,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'exceptId' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'rangeType' => -1,
                ),
                's' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
                'e' => array(
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                    'u' => 2000,
                ),
                'dur' => array(
                    'neg' => true,
                    'w' => 7,
                    'd' => 2,
                    'h' => 3,
                    'm' => 4,
                    's' => 5,
                    'related' => 'START',
                    'count' => 6,
                ),
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }

    public function testInviteComponentCommon()
    {
        $subject = InviteChange::SUBJECT();
        $location = InviteChange::LOCATION();
        $time = InviteChange::TIME();
        $comp = new \Zimbra\Mail\Struct\InviteComponentCommon(
            'method',
            10,
            true,
            10,
            'name',
            'loc',
            10,
            '20120315T18302305Z',
            true,
            FreeBusyStatus::F(),
            FreeBusyStatus::F(),
            Transparency::O(),
            true,
            'x_uid',
            'uid',
            10,
            10,
            'calItemId',
            'apptId',
            'ciFolder',
            InviteStatus::COMP(),
            InviteClass::PUB(),
            'url',
            true,
            'ridZ',
            true,
            true,
            true,
            array($subject, $location)
        );

        $this->assertSame('method', $comp->method());
        $this->assertSame(10, $comp->compNum());
        $this->assertTrue($comp->rsvp());
        $this->assertSame(10, $comp->priority());
        $this->assertSame('name', $comp->name());
        $this->assertSame('loc', $comp->loc());
        $this->assertSame(10, $comp->percentComplete());
        $this->assertSame('20120315T18302305Z', $comp->completed());
        $this->assertTrue($comp->noBlob());
        $this->assertTrue($comp->fba()->is('F'));
        $this->assertTrue($comp->fb()->is('F'));
        $this->assertTrue($comp->transp()->is('O'));
        $this->assertTrue($comp->isOrg());
        $this->assertSame('x_uid', $comp->x_uid());
        $this->assertSame('uid', $comp->uid());
        $this->assertSame(10, $comp->seq());
        $this->assertSame(10, $comp->d());
        $this->assertSame('calItemId', $comp->calItemId());
        $this->assertSame('apptId', $comp->apptId());
        $this->assertSame('ciFolder', $comp->ciFolder());
        $this->assertTrue($comp->status()->is('COMP'));
        $this->assertTrue($comp->class_()->is('PUB'));
        $this->assertSame('url', $comp->url());
        $this->assertTrue($comp->ex());
        $this->assertSame('ridZ', $comp->ridZ());
        $this->assertTrue($comp->allDay());
        $this->assertTrue($comp->draft());
        $this->assertTrue($comp->neverSent());
        $this->assertSame('subject,location', $comp->changes());

        $comp->method('method')
             ->compNum(10)
             ->rsvp(true)
             ->priority(10)
             ->name('name')
             ->loc('loc')
             ->percentComplete(10)
             ->completed('20120315T18302305Z')
             ->noBlob(true)
             ->fba(FreeBusyStatus::F())
             ->fb(FreeBusyStatus::F())
             ->transp(Transparency::O())
             ->isOrg(true)
             ->x_uid('x_uid')
             ->uid('uid')
             ->seq(10)
             ->d(10)
             ->calItemId('calItemId')
             ->apptId('apptId')
             ->ciFolder('ciFolder')
             ->status(InviteStatus::COMP())
             ->class_(InviteClass::PUB())
             ->url('url')
             ->ex(true)
             ->ridZ('ridZ')
             ->allDay(true)
             ->draft(true)
             ->neverSent(true)
             ->addChange($time);
        $this->assertSame('method', $comp->method());
        $this->assertSame(10, $comp->compNum());
        $this->assertTrue($comp->rsvp());
        $this->assertSame(10, $comp->priority());
        $this->assertSame('name', $comp->name());
        $this->assertSame('loc', $comp->loc());
        $this->assertSame(10, $comp->percentComplete());
        $this->assertSame('20120315T18302305Z', $comp->completed());
        $this->assertTrue($comp->noBlob());
        $this->assertTrue($comp->fba()->is('F'));
        $this->assertTrue($comp->fb()->is('F'));
        $this->assertTrue($comp->transp()->is('O'));
        $this->assertTrue($comp->isOrg());
        $this->assertSame('x_uid', $comp->x_uid());
        $this->assertSame('uid', $comp->uid());
        $this->assertSame(10, $comp->seq());
        $this->assertSame(10, $comp->d());
        $this->assertSame('calItemId', $comp->calItemId());
        $this->assertSame('apptId', $comp->apptId());
        $this->assertSame('ciFolder', $comp->ciFolder());
        $this->assertTrue($comp->status()->is('COMP'));
        $this->assertTrue($comp->class_()->is('PUB'));
        $this->assertSame('url', $comp->url());
        $this->assertTrue($comp->ex());
        $this->assertSame('ridZ', $comp->ridZ());
        $this->assertTrue($comp->allDay());
        $this->assertTrue($comp->draft());
        $this->assertTrue($comp->neverSent());
        $this->assertSame('subject,location,time', $comp->changes());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comp'
                .' method="method"'
                .' compNum="10"'
                .' rsvp="true"'
                .' priority="10"'
                .' name="name"'
                .' loc="loc"'
                .' percentComplete="10"'
                .' completed="20120315T18302305Z"'
                .' noBlob="true"'
                .' fba="F"'
                .' fb="F"'
                .' transp="O"'
                .' isOrg="true"'
                .' x_uid="x_uid"'
                .' uid="uid"'
                .' seq="10"'
                .' d="10"'
                .' calItemId="calItemId"'
                .' apptId="apptId"'
                .' ciFolder="ciFolder"'
                .' status="COMP"'
                .' class="PUB"'
                .' url="url"'
                .' ex="true"'
                .' ridZ="ridZ"'
                .' allDay="true"'
                .' draft="true"'
                .' neverSent="true"'
                .' changes="subject,location,time"'
            .' />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comp);

        $array = array(
            'comp' => array(
                'method' => 'method',
                'compNum' => 10,
                'rsvp' => true,
                'priority' => 10,
                'name' => 'name',
                'loc' => 'loc',
                'percentComplete' => 10,
                'completed' => '20120315T18302305Z',
                'noBlob' => true,
                'fba' => 'F',
                'fb' => 'F',
                'transp' => 'O',
                'isOrg' => true,
                'x_uid' => 'x_uid',
                'uid' => 'uid',
                'seq' => 10,
                'd' => 10,
                'calItemId' => 'calItemId',
                'apptId' => 'apptId',
                'ciFolder' => 'ciFolder',
                'status' => 'COMP',
                'class' => 'PUB',
                'url' => 'url',
                'ex' => true,
                'ridZ' => 'ridZ',
                'allDay' => true,
                'draft' => true,
                'neverSent' => true,
                'changes' => 'subject,location,time',
            ),
        );
        $this->assertEquals($array, $comp->toArray());
    }

    public function testInviteTest()
    {
        $inviteTest = new \Zimbra\Mail\Struct\InviteTest(
            10, array('method1'), true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $inviteTest);
        $this->assertSame(array('method1'), $inviteTest->method()->all());
        $inviteTest->addMethod('method2');
        $this->assertSame(array('method1', 'method2'), $inviteTest->method()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<inviteTest index="10" negative="true">'
                .'<method>method1</method>'
                .'<method>method2</method>'
            .'</inviteTest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $inviteTest);

        $array = array(
            'inviteTest' => array(
                'index' => 10,
                'negative' => true,
                'method' => array(
                    'method1',
                    'method2',
                ),
            ),
        );
        $this->assertEquals($array, $inviteTest->toArray());
    }

    public function testItemActionSelector()
    {
        $action = new \Zimbra\Mail\Struct\ItemActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('id', $action->id());
        $this->assertSame('tcon', $action->tcon());
        $this->assertSame(10, $action->tag());
        $this->assertSame('l', $action->l());
        $this->assertSame('#aabbcc', $action->rgb());
        $this->assertSame(10, $action->color());
        $this->assertSame('name', $action->name());
        $this->assertSame('f', $action->f());
        $this->assertSame('t', $action->t());
        $this->assertSame('tn', $action->tn());

        $action->op(ItemActionOp::MOVE())
               ->id('id')
               ->tcon('tcon')
               ->tag(10)
               ->l('l')
               ->rgb('#aabbcc')
               ->color(10)
               ->name('name')
               ->f('f')
               ->t('t')
               ->tn('tn');
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('id', $action->id());
        $this->assertSame('tcon', $action->tcon());
        $this->assertSame(10, $action->tag());
        $this->assertSame('l', $action->l());
        $this->assertSame('#aabbcc', $action->rgb());
        $this->assertSame(10, $action->color());
        $this->assertSame('name', $action->name());
        $this->assertSame('f', $action->f());
        $this->assertSame('t', $action->t());
        $this->assertSame('tn', $action->tn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testItemSpec()
    {
        $item = new \Zimbra\Mail\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );
        $this->assertSame('id', $item->id());
        $this->assertSame('l', $item->l());
        $this->assertSame('name', $item->name());
        $this->assertSame('path', $item->path());

        $item->id('id')
             ->l('l')
             ->name('name')
             ->path('path');
        $this->assertSame('id', $item->id());
        $this->assertSame('l', $item->l());
        $this->assertSame('name', $item->name());
        $this->assertSame('path', $item->path());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<item id="id" l="l" name="name" path="path" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'id' => 'id',
                'l' => 'l',
                'name' => 'name',
                'path' => 'path',
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }

    public function testKeepAction()
    {
        $actionKeep = new \Zimbra\Mail\Struct\KeepAction(
            10
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionKeep);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionKeep index="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionKeep);

        $array = array(
            'actionKeep' => array(
                'index' => 10,
            ),
        );
        $this->assertEquals($array, $actionKeep->toArray());
    }

    public function testLinkedInTest()
    {
        $linkedinTest = new \Zimbra\Mail\Struct\LinkedInTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $linkedinTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<linkedinTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $linkedinTest);

        $array = array(
            'linkedinTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $linkedinTest->toArray());
    }

    public function testListDocumentRevisionsSpec()
    {
        $doc = new \Zimbra\Mail\Struct\ListDocumentRevisionsSpec(
            'id', 10, 10
        );
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());
        $this->assertSame(10, $doc->count());

        $doc->id('id')
            ->ver(10)
            ->count(10);
        $this->assertSame('id', $doc->id());
        $this->assertSame(10, $doc->ver());
        $this->assertSame(10, $doc->count());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<doc id="id" ver="10" count="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $doc);

        $array = array(
            'doc' => array(
                'id' => 'id',
                'ver' => 10,
                'count' => 10,
            ),
        );
        $this->assertEquals($array, $doc->toArray());
    }

    public function testListTest()
    {
        $listTest = new \Zimbra\Mail\Struct\ListTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $listTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<listTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $listTest);

        $array = array(
            'listTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $listTest->toArray());
    }

    public function testMailCalDataSource()
    {
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $cal);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cal />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cal);

        $array = array(
            'cal' => array(),
        );
        $this->assertEquals($array, $cal->toArray());
    }

    public function testMailCaldavDataSource()
    {
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $caldav);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<caldav />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $caldav);

        $array = array(
            'caldav' => array(),
        );
        $this->assertEquals($array, $caldav->toArray());
    }

    public function testMailCustomMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailKeyValuePairs', $meta);
        $this->assertSame('section', $meta->section());
        $meta->section('section');
        $this->assertSame('section', $meta->section());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<meta section="section">'
                .'<a n="key">value</a>'
            .'</meta>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $meta);

        $array = array(
            'meta' => array(
                'a' => array(
                    array('n' => 'key', '_' => 'value')
                ),
                'section' => 'section',
            ),
        );
        $this->assertEquals($array, $meta->toArray());
    }

    public function testMailDataSource()
    {
        $mail = new \Zimbra\Mail\Struct\MailDataSource(
            'id',
            'name',
            'l',
            true,
            true,
            'host',
            10,
            MdsConnectionType::SSL(),
            'username',
            'password',
            'pollingInterval',
            'emailAddress',
            true,
            'defaultSignature',
            'forwardReplySignature',
            'fromDisplay',
            'replyToAddress',
            'replyToDisplay',
            'importClass',
            10,
            'lastError',
            array('a', 'b')
        );
        $this->assertSame('id', $mail->id());
        $this->assertSame('name', $mail->name());
        $this->assertSame('l', $mail->l());
        $this->assertTrue($mail->isEnabled());
        $this->assertTrue($mail->importOnly());
        $this->assertSame('host', $mail->host());
        $this->assertSame(10, $mail->port());
        $this->assertTrue($mail->connectionType()->is('ssl'));
        $this->assertSame('username', $mail->username());
        $this->assertSame('password', $mail->password());
        $this->assertSame('pollingInterval', $mail->pollingInterval());
        $this->assertSame('emailAddress', $mail->emailAddress());
        $this->assertTrue($mail->useAddressForForwardReply());
        $this->assertSame('defaultSignature', $mail->defaultSignature());
        $this->assertSame('forwardReplySignature', $mail->forwardReplySignature());
        $this->assertSame('fromDisplay', $mail->fromDisplay());
        $this->assertSame('replyToAddress', $mail->replyToAddress());
        $this->assertSame('replyToDisplay', $mail->replyToDisplay());
        $this->assertSame('importClass', $mail->importClass());
        $this->assertSame(10, $mail->failingSince());
        $this->assertSame('lastError', $mail->lastError());
        $this->assertSame(array('a', 'b'), $mail->a()->all());

        $mail->id('id')
             ->name('name')
             ->l('l')
             ->isEnabled(true)
             ->importOnly(true)
             ->host('host')
             ->port(10)
             ->connectionType(MdsConnectionType::SSL())
             ->username('username')
             ->password('password')
             ->pollingInterval('pollingInterval')
             ->emailAddress('emailAddress')
             ->useAddressForForwardReply(true)
             ->defaultSignature('defaultSignature')
             ->forwardReplySignature('forwardReplySignature')
             ->fromDisplay('fromDisplay')
             ->replyToAddress('replyToAddress')
             ->replyToDisplay('replyToDisplay')
             ->importClass('importClass')
             ->failingSince(10)
             ->lastError('lastError')
             ->addA('c');
        $this->assertSame('id', $mail->id());
        $this->assertSame('name', $mail->name());
        $this->assertSame('l', $mail->l());
        $this->assertTrue($mail->isEnabled());
        $this->assertTrue($mail->importOnly());
        $this->assertSame('host', $mail->host());
        $this->assertSame(10, $mail->port());
        $this->assertTrue($mail->connectionType()->is('ssl'));
        $this->assertSame('username', $mail->username());
        $this->assertSame('password', $mail->password());
        $this->assertSame('pollingInterval', $mail->pollingInterval());
        $this->assertSame('emailAddress', $mail->emailAddress());
        $this->assertTrue($mail->useAddressForForwardReply());
        $this->assertSame('defaultSignature', $mail->defaultSignature());
        $this->assertSame('forwardReplySignature', $mail->forwardReplySignature());
        $this->assertSame('fromDisplay', $mail->fromDisplay());
        $this->assertSame('replyToAddress', $mail->replyToAddress());
        $this->assertSame('replyToDisplay', $mail->replyToDisplay());
        $this->assertSame('importClass', $mail->importClass());
        $this->assertSame(10, $mail->failingSince());
        $this->assertSame('lastError', $mail->lastError());
        $this->assertSame(array('a', 'b', 'c'), $mail->a()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mail id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
            .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
            .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
            .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
            .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                .'<lastError>lastError</lastError>'
                .'<a>a</a>'
                .'<a>b</a>'
                .'<a>c</a>'
            .'</mail>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mail);

        $array = array(
            'mail' => array(
                'id' => 'id',
                'name' => 'name',
                'l' => 'l',
                'isEnabled' => true,
                'importOnly' => true,
                'host' => 'host',
                'port' => 10,
                'connectionType' => 'ssl',
                'username' => 'username',
                'password' => 'password',
                'pollingInterval' => 'pollingInterval',
                'emailAddress' => 'emailAddress',
                'useAddressForForwardReply' => true,
                'defaultSignature' => 'defaultSignature',
                'forwardReplySignature' => 'forwardReplySignature',
                'fromDisplay' => 'fromDisplay',
                'replyToAddress' => 'replyToAddress',
                'replyToDisplay' => 'replyToDisplay',
                'importClass' => 'importClass',
                'failingSince' => 10,
                'lastError' => 'lastError',
                'a' => array('a', 'b', 'c'),
            ),
        );
        $this->assertEquals($array, $mail->toArray());
    }

    public function testMailGalDataSource()
    {
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $gal);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<gal />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $gal);

        $array = array(
            'gal' => array(),
        );
        $this->assertEquals($array, $gal->toArray());
    }

    public function testMailImapDataSource()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $imap);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<imap />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $imap);

        $array = array(
            'imap' => array(),
        );
        $this->assertEquals($array, $imap->toArray());
    }

    public function testMailKeyValuePairs()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $kpv = new \Zimbra\Mail\Struct\MailKeyValuePairs(array($a));
        $this->assertSame(array($a), $kpv->a()->all());

        $kpv->addA($a);
        $this->assertSame(array($a, $a), $kpv->a()->all());
        $kpv->a()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<kpv>'
                .'<a n="key">value</a>'
            .'</kpv>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $kpv);

        $array = array(
            'kpv' => array(
                'a' => array(
                    array('n' => 'key', '_' => 'value')
                ),
            ),
        );
        $this->assertEquals($array, $kpv->toArray());
    }

    public function testMailPop3DataSource()
    {
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $pop3);
        $this->assertTrue($pop3->leaveOnServer());
        $pop3->leaveOnServer(true);
        $this->assertTrue($pop3->leaveOnServer());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pop3 leaveOnServer="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pop3);

        $array = array(
            'pop3' => array(
                'leaveOnServer' => true,
            ),
        );
        $this->assertEquals($array, $pop3->toArray());
    }

    public function testMailRssDataSource()
    {
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $rss);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rss />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rss);

        $array = array(
            'rss' => array(),
        );
        $this->assertEquals($array, $rss->toArray());
    }

    public function testMailUnknownDataSource()
    {
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $unknown);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<unknown />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $unknown);

        $array = array(
            'unknown' => array(),
        );
        $this->assertEquals($array, $unknown->toArray());
    }

    public function testMailYabDataSource()
    {
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $this->assertInstanceOf('\Zimbra\Mail\Struct\MailDataSource', $yab);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<yab />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $yab);

        $array = array(
            'yab' => array(),
        );
        $this->assertEquals($array, $yab->toArray());
    }

    public function testMessagePartSpec()
    {
        $m = new \Zimbra\Mail\Struct\MessagePartSpec(
            'id', 'part'
        );
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());

        $m->id('id')
          ->part('part');
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id" part="part" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'part' => 'part',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMeTest()
    {
        $meTest = new \Zimbra\Mail\Struct\MeTest(
            10, 'header', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $meTest);
        $this->assertSame('header', $meTest->header());
        $meTest->header('header');
        $this->assertSame('header', $meTest->header());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<meTest index="10" negative="true" header="header" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $meTest);

        $array = array(
            'meTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
            ),
        );
        $this->assertEquals($array, $meTest->toArray());
    }

    public function testMimeHeaderTest()
    {
        $mimeHeaderTest = new \Zimbra\Mail\Struct\MimeHeaderTest(
            10, 'header', 'stringComparison', 'value', true, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $mimeHeaderTest);
        $this->assertSame('header', $mimeHeaderTest->header());
        $this->assertSame('stringComparison', $mimeHeaderTest->stringComparison());
        $this->assertSame('value', $mimeHeaderTest->value());
        $this->assertTrue($mimeHeaderTest->caseSensitive());

        $mimeHeaderTest->header('header')
                       ->stringComparison('stringComparison')
                       ->value('value')
                       ->caseSensitive(true);
        $this->assertSame('header', $mimeHeaderTest->header());
        $this->assertSame('stringComparison', $mimeHeaderTest->stringComparison());
        $this->assertSame('value', $mimeHeaderTest->value());
        $this->assertTrue($mimeHeaderTest->caseSensitive());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mimeHeaderTest);

        $array = array(
            'mimeHeaderTest' => array(
                'index' => 10,
                'negative' => true,
                'header' => 'header',
                'stringComparison' => 'stringComparison',
                'value' => 'value',
                'caseSensitive' => true,
            ),
        );
        $this->assertEquals($array, $mimeHeaderTest->toArray());
    }

    public function testMimePartAttachSpec()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('id', 'p');
        $this->assertSame('id', $mp->mid());
        $this->assertSame('p', $mp->part());

        $mp->mid('mid')
           ->part('part')
           ->optional(true);
        $this->assertSame('mid', $mp->mid());
        $this->assertSame('part', $mp->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<mp mid="mid" part="part" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mp);

        $array = array(
            'mp' => array(
                'mid' => 'mid',
                'part' => 'part',
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $mp->toArray());
    }

    public function testMimePartInfo()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');

        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $mpi = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $this->assertSame(array($info), $mpi->mp()->all());
        $this->assertSame($attach, $mpi->attach());
        $this->assertSame('ct', $mpi->ct());
        $this->assertSame('content', $mpi->content());
        $this->assertSame('ci', $mpi->ci());

        $mpi->addMp($info)
            ->attach($attach)
            ->ct('ct')
            ->content('content')
            ->ci('ci');
        $this->assertSame(array($info, $info), $mpi->mp()->all());
        $this->assertSame($attach, $mpi->attach());
        $this->assertSame('ct', $mpi->ct());
        $this->assertSame('content', $mpi->content());
        $this->assertSame('ci', $mpi->ci());

        $mpi = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $xml = '<?xml version="1.0"?>'."\n"
            .'<mp ct="ct" content="content" ci="ci">'
                .'<attach aid="aid">'
                    .'<mp optional="true" mid="mid" part="part" />'
                    .'<m optional="false" id="id" />'
                    .'<cn optional="false" id="id" />'
                    .'<doc optional="true" path="path" id="id" ver="10" />'
                .'</attach>'
                .'<mp ct="ct" content="content" ci="ci" />'
            .'</mp>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $mpi);

        $array = array(
            'mp' => array(
                'ct' => 'ct',
                'content' => 'content',
                'ci' => 'ci',
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 10,
                        'optional' => true,
                    ),
                ),
                'mp' => array(
                    array(
                        'ct' => 'ct',
                        'content' => 'content',
                        'ci' => 'ci',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $mpi->toArray());
    }

    public function testModifyContactAttr()
    {
        $a = new \Zimbra\Mail\Struct\ModifyContactAttr(
            'n', 'value', 'aid', 10, 'part', 'op'
        );
        $this->assertSame('n', $a->n());
        $this->assertSame('value', $a->value());
        $this->assertSame('aid', $a->aid());
        $this->assertSame(10, $a->id());
        $this->assertSame('part', $a->part());
        $this->assertSame('op', $a->op());

        $a->n('n')
          ->value('value')
          ->aid('aid')
          ->id(10)
          ->part('part')
          ->op('op');
        $this->assertSame('n', $a->n());
        $this->assertSame('value', $a->value());
        $this->assertSame('aid', $a->aid());
        $this->assertSame(10, $a->id());
        $this->assertSame('part', $a->part());
        $this->assertSame('op', $a->op());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="n" aid="aid" id="10" part="part" op="op">value</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => 'n',
                '_' => 'value',
                'aid' => 'aid',
                'id' => 10,
                'part' => 'part',
                'op' => 'op',
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }

    public function testModifyContactGroupMember()
    {
        $m = new \Zimbra\Mail\Struct\ModifyContactGroupMember(
            'C', 'value', 'reset'
        );
        $this->assertSame('C', $m->type());
        $this->assertSame('value', $m->value());
        $this->assertSame('reset', $m->op());

        $m->type('C')
          ->value('value')
          ->op('reset');
        $this->assertSame('C', $m->type());
        $this->assertSame('value', $m->value());
        $this->assertSame('reset', $m->op());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m type="C" value="value" op="reset" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'type' => 'C',
                'value' => 'value',
                'op' => 'reset',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testModifyContactSpec()
    {
        $a = new \Zimbra\Mail\Struct\ModifyContactAttr(
            'n', 'value', 'aid', 10, 'part', 'op'
        );
        $m = new \Zimbra\Mail\Struct\ModifyContactGroupMember(
            'C', 'value', 'reset'
        );

        $cn = new \Zimbra\Mail\Struct\ModifyContactSpec(
            array($a), array($m), 10, 'tn'
        );
        $this->assertSame(array($a), $cn->a()->all());
        $this->assertSame(array($m), $cn->m()->all());
        $this->assertSame(10, $cn->id());
        $this->assertSame('tn', $cn->tn());

        $cn->addA($a)
           ->addM($m)
           ->id(10)
           ->tn('tn');
        $this->assertSame(array($a, $a), $cn->a()->all());
        $this->assertSame(array($m, $m), $cn->m()->all());
        $this->assertSame(10, $cn->id());
        $this->assertSame('tn', $cn->tn());

        $cn->a()->remove(1);
        $cn->m()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<cn id="10" tn="tn">'
                .'<a n="n" aid="aid" id="10" part="part" op="op">value</a>'
                .'<m type="C" value="value" op="reset" />'
            .'</cn>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $cn);

        $array = array(
            'cn' => array(
                'id' => 10,
                'tn' => 'tn',
                'a' => array(
                    array(
                        'n' => 'n',
                        '_' => 'value',
                        'aid' => 'aid',
                        'id' => 10,
                        'part' => 'part',
                        'op' => 'op',
                    ),
                ),
                'm' => array(
                    array(
                        'type' => 'C',
                        'value' => 'value',
                        'op' => 'reset',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $cn->toArray());
    }

    public function testModifySearchFolderSpec()
    {
        $search = new \Zimbra\Mail\Struct\ModifySearchFolderSpec(
            'id', 'query', 'types', 'sortBy'
        );
        $this->assertSame('id', $search->id());
        $this->assertSame('query', $search->query());
        $this->assertSame('types', $search->types());
        $this->assertSame('sortBy', $search->sortBy());

        $search->id('id')
               ->query('query')
               ->types('types')
               ->sortBy('sortBy');
        $this->assertSame('id', $search->id());
        $this->assertSame('query', $search->query());
        $this->assertSame('types', $search->types());
        $this->assertSame('sortBy', $search->sortBy());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<search id="id" query="query" types="types" sortBy="sortBy" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $search);

        $array = array(
            'search' => array(
                'id' => 'id',
                'query' => 'query',
                'types' => 'types',
                'sortBy' => 'sortBy',
            ),
        );
        $this->assertEquals($array, $search->toArray());
    }

    public function testMsg()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');

        $m = new \Zimbra\Mail\Struct\Msg(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );

        $this->assertSame('aid', $m->aid());
        $this->assertSame('origid', $m->origid());
        $this->assertSame('rt', $m->rt());
        $this->assertSame('idnt', $m->idnt());
        $this->assertSame('su', $m->su());
        $this->assertSame('irt', $m->irt());
        $this->assertSame('l', $m->l());
        $this->assertSame('f', $m->f());
        $this->assertSame('content', $m->content());
        $this->assertSame(array($header), $m->header()->all());
        $this->assertSame($mp, $m->mp());
        $this->assertSame($attach, $m->attach());
        $this->assertSame($inv, $m->inv());
        $this->assertSame(array($e), $m->e()->all());
        $this->assertSame(array($tz), $m->tz()->all());
        $this->assertSame('fr', $m->fr());

        $m->aid('aid')
          ->origid('origid')
          ->rt('rt')
          ->idnt('idnt')
          ->su('su')
          ->irt('irt')
          ->l('l')
          ->f('f')
          ->content('content')
          ->addHeader($header)
          ->mp($mp)
          ->attach($attach)
          ->inv($inv)
          ->addE($e)
          ->addTz($tz)
          ->fr('fr');
        $this->assertSame('aid', $m->aid());
        $this->assertSame('origid', $m->origid());
        $this->assertSame('rt', $m->rt());
        $this->assertSame('idnt', $m->idnt());
        $this->assertSame('su', $m->su());
        $this->assertSame('irt', $m->irt());
        $this->assertSame('l', $m->l());
        $this->assertSame('f', $m->f());
        $this->assertSame('content', $m->content());
        $this->assertSame(array($header, $header), $m->header()->all());
        $this->assertSame($mp, $m->mp());
        $this->assertSame($attach, $m->attach());
        $this->assertSame($inv, $m->inv());
        $this->assertSame(array($e, $e), $m->e()->all());
        $this->assertSame(array($tz, $tz), $m->tz()->all());
        $this->assertSame('fr', $m->fr());

        $m = new \Zimbra\Mail\Struct\Msg(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                .'<content>content</content>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn optional="false" id="id" />'
                        .'<doc optional="true" path="path" id="id" ver="10" />'
                    .'</attach>'
                    .'<mp ct="ct" content="content" ci="ci" />'
                .'</mp>'
                .'<attach aid="aid">'
                    .'<mp optional="true" mid="mid" part="part" />'
                    .'<m optional="false" id="id" />'
                    .'<cn optional="false" id="id" />'
                    .'<doc optional="true" path="path" id="id" ver="10" />'
                .'</attach>'
                .'<inv method="method" compNum="10" rsvp="true" />'
                .'<fr>fr</fr>'
                .'<header name="name">value</header>'
                .'<e a="a" t="t" p="p" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'aid' => 'aid',
                'origid' => 'origid',
                'rt' => 'rt',
                'idnt' => 'idnt',
                'su' => 'su',
                'irt' => 'irt',
                'l' => 'l',
                'f' => 'f',
                'content' => 'content',
                'header' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
                'mp' => array(
                    'ct' => 'ct',
                    'content' => 'content',
                    'ci' => 'ci',
                    'mp' => array(
                        array(
                            'ct' => 'ct',
                            'content' => 'content',
                            'ci' => 'ci',
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => true,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 10,
                            'optional' => true,
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 10,
                        'optional' => true,
                    ),
                ),
                'inv' => array(
                    'method' => 'method',
                    'compNum' => 10,
                    'rsvp' => true,
                ),
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 12,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 10,
                        ),
                    ),
                ),
                'fr' => 'fr',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMsgActionSelector()
    {
        $action = new \Zimbra\Mail\Struct\MsgActionSelector(
            MsgActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $this->assertTrue($action->op()->is('move'));

        $action->op(MsgActionOp::MOVE());
        $this->assertTrue($action->op()->is('move'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
            ),
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testMsgAttachSpec()
    {
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('i');
        $this->assertSame('i', $m->id());

        $m->id('id')
          ->optional(true);
        $this->assertSame('id', $m->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id" optional="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'optional' => true,
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMsgPartIds()
    {
        $m = new \Zimbra\Mail\Struct\MsgPartIds(
            'id', 'part'
        );
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());

        $m->id('id')
          ->part('part');
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id" part="part" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'part' => 'part',
            )
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMsgSpec()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $m = new \Zimbra\Mail\Struct\MsgSpec(
            'id', array($header), 'part', true, true, 10, true, true, 'ridZ', true
        );
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());
        $this->assertTrue($m->raw());
        $this->assertTrue($m->read());
        $this->assertSame(10, $m->max());
        $this->assertTrue($m->html());
        $this->assertTrue($m->neuter());
        $this->assertSame('ridZ', $m->ridZ());
        $this->assertTrue($m->needExp());
        $this->assertSame(array($header), $m->header()->all());

        $m->id('id')
          ->part('part')
          ->raw(true)
          ->read(true)
          ->max(10)
          ->html(true)
          ->neuter(true)
          ->ridZ('ridZ')
          ->needExp(true)
          ->addHeader($header);
        $this->assertSame('id', $m->id());
        $this->assertSame('part', $m->part());
        $this->assertTrue($m->raw());
        $this->assertTrue($m->read());
        $this->assertSame(10, $m->max());
        $this->assertTrue($m->html());
        $this->assertTrue($m->neuter());
        $this->assertSame('ridZ', $m->ridZ());
        $this->assertTrue($m->needExp());
        $this->assertSame(array($header, $header), $m->header()->all());

        $m->header()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="id" part="part" raw="true" read="true" max="10" html="true" neuter="true" ridZ="ridZ" needExp="true">'
                .'<header n="attribute-name" />'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 'id',
                'part' => 'part',
                'raw' => true,
                'read' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'ridZ' => 'ridZ',
                'needExp' => true,
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testMsgToSend()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');

        $m = new \Zimbra\Mail\Struct\MsgToSend(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            'did',
            true,
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );
        $this->assertInstanceOf('Zimbra\Mail\Struct\Msg', $m);

        $this->assertSame('did', $m->did());
        $this->assertTrue($m->sfd());

        $m->did('did')
          ->sfd(true);
        $this->assertSame('did', $m->did());
        $this->assertTrue($m->sfd());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<m did="did" sfd="true" aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                .'<content>content</content>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn optional="false" id="id" />'
                        .'<doc optional="true" path="path" id="id" ver="10" />'
                    .'</attach>'
                    .'<mp ct="ct" content="content" ci="ci" />'
                .'</mp>'
                .'<attach aid="aid">'
                    .'<mp optional="true" mid="mid" part="part" />'
                    .'<m optional="false" id="id" />'
                    .'<cn optional="false" id="id" />'
                    .'<doc optional="true" path="path" id="id" ver="10" />'
                .'</attach>'
                .'<inv method="method" compNum="10" rsvp="true" />'
                .'<fr>fr</fr>'
                .'<header name="name">value</header>'
                .'<e a="a" t="t" p="p" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'did' => 'did',
                'sfd' => true,
                'aid' => 'aid',
                'origid' => 'origid',
                'rt' => 'rt',
                'idnt' => 'idnt',
                'su' => 'su',
                'irt' => 'irt',
                'l' => 'l',
                'f' => 'f',
                'content' => 'content',
                'header' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
                'mp' => array(
                    'ct' => 'ct',
                    'content' => 'content',
                    'ci' => 'ci',
                    'mp' => array(
                        array(
                            'ct' => 'ct',
                            'content' => 'content',
                            'ci' => 'ci',
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => true,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 10,
                            'optional' => true,
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 10,
                        'optional' => true,
                    ),
                ),
                'inv' => array(
                    'method' => 'method',
                    'compNum' => 10,
                    'rsvp' => true,
                ),
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 12,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 10,
                        ),
                    ),
                ),
                'fr' => 'fr',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testNamedFilterRules()
    {
        $filterRule = new \Zimbra\Struct\NamedElement('name');
        $filterRules = new \Zimbra\Mail\Struct\NamedFilterRules(array($filterRule));

        $this->assertSame(array($filterRule), $filterRules->filterRule()->all());
        $filterRules->addFilterRule($filterRule);
        $this->assertSame(array($filterRule, $filterRule), $filterRules->filterRule()->all());
        $filterRules->filterRule()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<filterRules>'
                .'<filterRule name="name" />'
            .'</filterRules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $filterRules);

        $array = array(
            'filterRules' => array(
                'filterRule' => array(
                    array('name' => 'name'),
                ),
            ),
        );
        $this->assertEquals($array, $filterRules->toArray());
    }

    public function testNameOrId()
    {
        $nameId = new \Zimbra\Mail\Struct\NameOrId('name', 'id');
        $this->assertSame('name', $nameId->name());
        $this->assertSame('id', $nameId->id());

        $nameId->name('name')
               ->id('id');
        $this->assertSame('name', $nameId->name());
        $this->assertSame('id', $nameId->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<name name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $nameId);

        $array = array(
            'name' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $nameId->toArray());
    }

    public function testNewContactAttr()
    {
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 10, 'part'
        );
        $this->assertSame('n', $a->n());
        $this->assertSame('value', $a->value());
        $this->assertSame('aid', $a->aid());
        $this->assertSame(10, $a->id());
        $this->assertSame('part', $a->part());

        $a->n('n')
          ->value('value')
          ->aid('aid')
          ->id(10)
          ->part('part');
        $this->assertSame('n', $a->n());
        $this->assertSame('value', $a->value());
        $this->assertSame('aid', $a->aid());
        $this->assertSame(10, $a->id());
        $this->assertSame('part', $a->part());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a n="n" aid="aid" id="10" part="part">value</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => 'n',
                '_' => 'value',
                'aid' => 'aid',
                'id' => 10,
                'part' => 'part',
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }

    public function testNewContactGroupMember()
    {
        $m = new \Zimbra\Mail\Struct\NewContactGroupMember(
            'type', 'value'
        );
        $this->assertSame('type', $m->type());
        $this->assertSame('value', $m->value());

        $m->type('type')
          ->value('value');
        $this->assertSame('type', $m->type());
        $this->assertSame('value', $m->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m type="type" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'type' => 'type',
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testNewFolderSpec()
    {
        $grant = new \Zimbra\Mail\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $acl = new \Zimbra\Mail\Struct\NewFolderSpecAcl(
            array($grant)
        );
        $folder = new \Zimbra\Mail\Struct\NewFolderSpec(
            'name', $acl, SearchType::TASK(), 'f', 10, '#aabbcc', 'url', 'l', true, true
        );
        $this->assertSame('name', $folder->name());
        $this->assertSame($acl, $folder->acl());
        $this->assertTrue($folder->view()->is('task'));
        $this->assertSame('f', $folder->f());
        $this->assertSame(10, $folder->color());
        $this->assertSame('#aabbcc', $folder->rgb());
        $this->assertSame('url', $folder->url());
        $this->assertSame('l', $folder->l());
        $this->assertTrue($folder->fie());
        $this->assertTrue($folder->sync());

        $folder->name('name')
               ->acl($acl)
               ->view(SearchType::TASK())
               ->f('f')
               ->color(10)
               ->rgb('#aabbcc')
               ->url('url')
               ->l('l')
               ->fie(true)
               ->sync(true);
        $this->assertSame('name', $folder->name());
        $this->assertSame($acl, $folder->acl());
        $this->assertTrue($folder->view()->is('task'));
        $this->assertSame('f', $folder->f());
        $this->assertSame(10, $folder->color());
        $this->assertSame('#aabbcc', $folder->rgb());
        $this->assertSame('url', $folder->url());
        $this->assertSame('l', $folder->l());
        $this->assertTrue($folder->fie());
        $this->assertTrue($folder->sync());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<folder name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" sync="true">'
                .'<acl>'
                    .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                .'</acl>'
            .'</folder>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $folder);

        $array = array(
            'folder' => array(
                'name' => 'name',
                'view' => 'task',
                'f' => 'f',
                'color' => 10,
                'rgb' => '#aabbcc',
                'url' => 'url',
                'l' => 'l',
                'fie' => true,
                'sync' => true,
                'acl' => array(
                    'grant' => array(
                        array(
                            'perm' => 'perm',
                            'gt' => 'usr',
                            'zid' => 'zid',
                            'd' => 'd',
                            'args' => 'args',
                            'pw' => 'pw',
                            'key' => 'key',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $folder->toArray());
    }

    public function testNewFolderSpecAcl()
    {
        $grant = new \Zimbra\Mail\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $acl = new \Zimbra\Mail\Struct\NewFolderSpecAcl(
            array($grant)
        );
        $this->assertSame(array($grant), $acl->grant()->all());
        $acl->addGrant($grant);
        $this->assertSame(array($grant, $grant), $acl->grant()->all());
        $acl->grant()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<acl>'
                .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
            .'</acl>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $acl);

        $array = array(
            'acl' => array(
                'grant' => array(
                    array(
                        'perm' => 'perm',
                        'gt' => 'usr',
                        'zid' => 'zid',
                        'd' => 'd',
                        'args' => 'args',
                        'pw' => 'pw',
                        'key' => 'key',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $acl->toArray());
    }

    public function testNewMountpointSpec()
    {
        $link = new \Zimbra\Mail\Struct\NewMountpointSpec(
            'name', SearchType::TASK(), 'f', 10, '#aabbcc', 'url', 'l', true, true, 'zid', 'owner', 10, 'path'
        );
        $this->assertSame('name', $link->name());
        $this->assertTrue($link->view()->is('task'));
        $this->assertSame('f', $link->f());
        $this->assertSame(10, $link->color());
        $this->assertSame('#aabbcc', $link->rgb());
        $this->assertSame('url', $link->url());
        $this->assertSame('l', $link->l());
        $this->assertTrue($link->fie());
        $this->assertTrue($link->reminder());
        $this->assertSame('zid', $link->zid());
        $this->assertSame('owner', $link->owner());
        $this->assertSame(10, $link->rid());
        $this->assertSame('path', $link->path());

        $link->name('name')
             ->view(SearchType::TASK())
             ->f('f')
             ->color(10)
             ->rgb('#aabbcc')
             ->url('url')
             ->l('l')
             ->fie(true)
             ->reminder(true)
             ->zid('zid')
             ->owner('owner')
             ->rid(10)
             ->path('path');
        $this->assertSame('name', $link->name());
        $this->assertTrue($link->view()->is('task'));
        $this->assertSame('f', $link->f());
        $this->assertSame(10, $link->color());
        $this->assertSame('#aabbcc', $link->rgb());
        $this->assertSame('url', $link->url());
        $this->assertSame('l', $link->l());
        $this->assertTrue($link->fie());
        $this->assertTrue($link->reminder());
        $this->assertSame('zid', $link->zid());
        $this->assertSame('owner', $link->owner());
        $this->assertSame(10, $link->rid());
        $this->assertSame('path', $link->path());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<link name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" reminder="true" zid="zid" owner="owner" rid="10" path="path" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $link);

        $array = array(
            'link' => array(
                'name' => 'name',
                'view' => 'task',
                'f' => 'f',
                'color' => 10,
                'rgb' => '#aabbcc',
                'url' => 'url',
                'l' => 'l',
                'fie' => true,
                'reminder' => true,
                'zid' => 'zid',
                'owner' => 'owner',
                'rid' => 10,
                'path' => 'path',
            ),
        );
        $this->assertEquals($array, $link->toArray());
    }

    public function testNewNoteSpec()
    {
        $note = new \Zimbra\Mail\Struct\NewNoteSpec(
            'l', 'content', 10, 'pos'
        );
        $this->assertSame('l', $note->l());
        $this->assertSame('content', $note->content());
        $this->assertSame(10, $note->color());
        $this->assertSame('pos', $note->pos());

        $note->l('l')
             ->content('content')
             ->color(10)
             ->pos('pos');
        $this->assertSame('l', $note->l());
        $this->assertSame('content', $note->content());
        $this->assertSame(10, $note->color());
        $this->assertSame('pos', $note->pos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<note l="l" content="content" color="10" pos="pos" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $note);

        $array = array(
            'note' => array(
                'l' => 'l',
                'content' => 'content',
                'color' => 10,
                'pos' => 'pos',
            ),
        );
        $this->assertEquals($array, $note->toArray());
    }

    public function testNewSearchFolderSpec()
    {
        $search = new \Zimbra\Mail\Struct\NewSearchFolderSpec(
            'name', 'query', 'types', 'sortBy', 'f', 10, 'l'
        );
        $this->assertSame('name', $search->name());
        $this->assertSame('query', $search->query());
        $this->assertSame('types', $search->types());
        $this->assertSame('sortBy', $search->sortBy());
        $this->assertSame('f', $search->f());
        $this->assertSame(10, $search->color());
        $this->assertSame('l', $search->l());

        $search->name('name')
               ->query('query')
               ->types('types')
               ->sortBy('sortBy')
               ->f('f')
               ->color(10)
               ->l('l');
        $this->assertSame('name', $search->name());
        $this->assertSame('query', $search->query());
        $this->assertSame('types', $search->types());
        $this->assertSame('sortBy', $search->sortBy());
        $this->assertSame('f', $search->f());
        $this->assertSame(10, $search->color());
        $this->assertSame('l', $search->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<search name="name" query="query" types="types" sortBy="sortBy" f="f" color="10" l="l" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $search);

        $array = array(
            'search' => array(
                'name' => 'name',
                'query' => 'query',
                'types' => 'types',
                'sortBy' => 'sortBy',
                'f' => 'f',
                'color' => 10,
                'l' => 'l',
            ),
        );
        $this->assertEquals($array, $search->toArray());
    }

    public function testNoteActionSelector()
    {
        $action = new \Zimbra\Mail\Struct\NoteActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', 'content', 'pos'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\ActionSelector', $action);
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('content', $action->content());
        $this->assertSame('pos', $action->pos());

        $action->op(ItemActionOp::MOVE())
               ->content('content')
               ->pos('pos');
        $this->assertTrue($action->op()->is('move'));
        $this->assertSame('content', $action->content());
        $this->assertSame('pos', $action->pos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="move" id="id" tcon="tcon" l="l" rgb="#aabbcc" tag="10" color="10" name="name" f="f" t="t" tn="tn" content="content" pos="pos" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'move',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'content' => 'content',
                'pos' => 'pos',
            )
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testNotifyAction()
    {
        $actionNotify = new \Zimbra\Mail\Struct\NotifyAction(
            10, 'content', 'a', 'su', 10, 'origHeaders'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionNotify);
        $this->assertSame('content', $actionNotify->content());
        $this->assertSame('a', $actionNotify->a());
        $this->assertSame('su', $actionNotify->su());
        $this->assertSame(10, $actionNotify->maxBodySize());
        $this->assertSame('origHeaders', $actionNotify->origHeaders());

        $actionNotify->content('content')
                     ->a('a')
                     ->su('su')
                     ->maxBodySize(10)
                     ->origHeaders('origHeaders');
        $this->assertSame('content', $actionNotify->content());
        $this->assertSame('a', $actionNotify->a());
        $this->assertSame('su', $actionNotify->su());
        $this->assertSame(10, $actionNotify->maxBodySize());
        $this->assertSame('origHeaders', $actionNotify->origHeaders());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                .'<content>content</content>'
            .'</actionNotify>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionNotify);

        $array = array(
            'actionNotify' => array(
                'index' => 10,
                'content' => 'content',
                'a' => 'a',
                'su' => 'su',
                'maxBodySize' => 10,
                'origHeaders' => 'origHeaders',
            ),
        );
        $this->assertEquals($array, $actionNotify->toArray());
    }

    public function testNumAttr()
    {
        $count = new \Zimbra\Mail\Struct\NumAttr(20120315);
        $this->assertSame(20120315, $count->num());
        $count->num(20120315);
        $this->assertSame(20120315, $count->num());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<count num="20120315" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $count);

        $array = array(
            'count' => array(
                'num' => 20120315,
            ),
        );
        $this->assertEquals($array, $count->toArray());
    }

    public function testParentId()
    {
        $comment = new \Zimbra\Mail\Struct\ParentId(
            'item-id-of-parent'
        );
        $this->assertSame('item-id-of-parent', $comment->parentId());

        $comment->parentId('item-id-of-parent');
        $this->assertSame('item-id-of-parent', $comment->parentId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<comment parentId="item-id-of-parent" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $comment);

        $array = array(
            'comment' => array(
                'parentId' => 'item-id-of-parent',
            ),
        );
        $this->assertEquals($array, $comment->toArray());
    }

    public function testPolicy()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $this->assertSame('system', $policy->type()->value());
        $this->assertSame('id', $policy->id());
        $this->assertSame('name', $policy->name());
        $this->assertSame('lifetime', $policy->lifetime());

        $policy->type(Type::USER())
               ->id('id')
               ->name('name')
               ->lifetime('lifetime');
        $this->assertSame('user', $policy->type()->value());
        $this->assertSame('id', $policy->id());
        $this->assertSame('name', $policy->name());
        $this->assertSame('lifetime', $policy->lifetime());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<policy type="user" id="id" name="name" lifetime="lifetime" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $policy);

        $array = array(
            'policy' => array(
                'type' => 'user',
                'id' => 'id',
                'name' => 'name',
                'lifetime' => 'lifetime',
            ),
        );
        $this->assertEquals($array, $policy->toArray());
    }

    public function testPop3DataSourceNameOrId()
    {
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $pop3);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pop3 name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pop3);

        $array = array(
            'pop3' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $pop3->toArray());
    }

    public function testPurgeRevisionSpec()
    {
        $revision = new \Zimbra\Mail\Struct\PurgeRevisionSpec(
            'id', 10, true
        );
        $this->assertSame('id', $revision->id());
        $this->assertSame(10, $revision->ver());
        $this->assertTrue($revision->includeOlderRevisions());

        $revision->id('id')
                 ->ver(10)
                 ->includeOlderRevisions(true);
        $this->assertSame('id', $revision->id());
        $this->assertSame(10, $revision->ver());
        $this->assertTrue($revision->includeOlderRevisions());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<revision id="id" ver="10" includeOlderRevisions="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $revision);

        $array = array(
            'revision' => array(
                'id' => 'id',
                'ver' => 10,
                'includeOlderRevisions' => true,
            )
        );
        $this->assertEquals($array, $revision->toArray());
    }

    public function testRankingActionSpec()
    {
        $action = new \Zimbra\Mail\Struct\RankingActionSpec(
            RankingActionOp::RESET(), 'email'
        );
        $this->assertTrue($action->op()->is('reset'));
        $this->assertSame('email', $action->email());

        $action->op(RankingActionOp::RESET())
               ->email('email');
        $this->assertTrue($action->op()->is('reset'));
        $this->assertSame('email', $action->email());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="reset" email="email" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'reset',
                'email' => 'email',
            )
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testRawInvite()
    {
        $content = new \Zimbra\Mail\Struct\RawInvite('uid', 'value', 'summary');
        $this->assertSame('uid', $content->uid());
        $this->assertSame('value', $content->value());
        $this->assertSame('summary', $content->summary());

        $content->uid('uid')
                ->summary('summary')
                ->value('value');
        $this->assertSame('uid', $content->uid());
        $this->assertSame('summary', $content->summary());
        $this->assertSame('value', $content->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<content uid="uid" summary="summary">value</content>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $content);

        $array = array(
            'content' => array(
                '_' => 'value',
                'uid' => 'uid',
                'summary' => 'summary',
            ),
        );
        $this->assertEquals($array, $content->toArray());
    }

    public function testRecurIdInfo()
    {
        $recur = new \Zimbra\Mail\Struct\RecurIdInfo(
            10, '991231', 'tz', '991231000000'
        );
        $this->assertSame(10, $recur->rangeType());
        $this->assertSame('991231', $recur->recurId());
        $this->assertSame('tz', $recur->tz());
        $this->assertSame('991231000000', $recur->ridZ());

        $recur->rangeType(10)
              ->recurId('991231')
              ->tz('tz')
              ->ridZ('991231000000');
        $this->assertSame(10, $recur->rangeType());
        $this->assertSame('991231', $recur->recurId());
        $this->assertSame('tz', $recur->tz());
        $this->assertSame('991231000000', $recur->ridZ());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<recur rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'rangeType' => 10,
                'recurId' => '991231',
                'tz' => 'tz',
                'ridZ' => '991231000000',
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }

    public function testRecurrenceInfo()
    {
        $except = new \Zimbra\Mail\Struct\ExceptionRuleInfo(
            10, '991231', null, null, 'tz', '991231000000'
        );
        $cancel = new \Zimbra\Mail\Struct\CancelRuleInfo(
            10, '991231', 'tz', '991231000000'
        );

        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(
            true, 7, 2, 3, 4, 5, 'START', 6
        );
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);
        $dates = new \Zimbra\Mail\Struct\SingleDates(array($dtval), 'tz');

        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), 10);
        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Mail\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Mail\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Mail\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Mail\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Mail\Struct\XNameRule('name', 'value');
        $rule = new \Zimbra\Mail\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );

        $add = new \Zimbra\Mail\Struct\AddRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $exclude = new \Zimbra\Mail\Struct\ExcludeRecurrenceInfo(null, null, $except, $cancel, $dates, $rule);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo($add, $exclude, $except, $cancel, $dates, $rule);

        $this->assertSame($add, $recur->add());
        $this->assertSame($exclude, $recur->exclude());
        $this->assertSame($except, $recur->except());
        $this->assertSame($cancel, $recur->cancel());
        $this->assertSame($dates, $recur->dates());
        $this->assertSame($rule, $recur->rule());

        $recur->add($add)
              ->exclude($exclude)
              ->except($except)
              ->cancel($cancel)
              ->dates($dates)
              ->rule($rule);
        $this->assertSame($add, $recur->add());
        $this->assertSame($exclude, $recur->exclude());
        $this->assertSame($except, $recur->except());
        $this->assertSame($cancel, $recur->cancel());
        $this->assertSame($dates, $recur->dates());
        $this->assertSame($rule, $recur->rule());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<recur>'
                .'<add>'
                    .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="10" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</add>'
                .'<exclude>'
                    .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                    .'<dates tz="tz">'
                        .'<dtval>'
                            .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                            .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                            .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                        .'</dtval>'
                    .'</dates>'
                    .'<rule freq="SEC">'
                        .'<until d="20120315T18302305Z" />'
                        .'<count num="20120315" />'
                        .'<interval ival="20120315" />'
                        .'<bysecond seclist="10,20,30" />'
                        .'<byminute minlist="10,20,30" />'
                        .'<byhour hrlist="5,10,15" />'
                        .'<byday>'
                            .'<wkday day="SU" ordwk="10" />'
                        .'</byday>'
                        .'<bymonthday modaylist="5,10,15" />'
                        .'<byyearday yrdaylist="5,10,15" />'
                        .'<byweekno wklist="5,10,15" />'
                        .'<bymonth molist="5,10" />'
                        .'<bysetpos poslist="5,10,15" />'
                        .'<wkst day="SU" />'
                        .'<rule-x-name name="name" value="value" />'
                    .'</rule>'
                .'</exclude>'
                .'<except rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'<cancel rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'<dates tz="tz">'
                    .'<dtval>'
                        .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                        .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'</dtval>'
                .'</dates>'
                .'<rule freq="SEC">'
                    .'<until d="20120315T18302305Z" />'
                    .'<count num="20120315" />'
                    .'<interval ival="20120315" />'
                    .'<bysecond seclist="10,20,30" />'
                    .'<byminute minlist="10,20,30" />'
                    .'<byhour hrlist="5,10,15" />'
                    .'<byday>'
                        .'<wkday day="SU" ordwk="10" />'
                    .'</byday>'
                    .'<bymonthday modaylist="5,10,15" />'
                    .'<byyearday yrdaylist="5,10,15" />'
                    .'<byweekno wklist="5,10,15" />'
                    .'<bymonth molist="5,10" />'
                    .'<bysetpos poslist="5,10,15" />'
                    .'<wkst day="SU" />'
                    .'<rule-x-name name="name" value="value" />'
                .'</rule>'
            .'</recur>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $recur);

        $array = array(
            'recur' => array(
                'add' => array(
                    'except' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => 7,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 10,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'exclude' => array(
                    'except' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'cancel' => array(
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    'dates' => array(
                        'tz' => 'tz',
                        'dtval' => array(
                            array(
                                's' => array(
                                    'd' => '20120315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 1000,
                                ),
                                'e' => array(
                                    'd' => '20130315T18302305Z',
                                    'tz' => 'tz',
                                    'u' => 2000,
                                ),
                                'dur' => array(
                                    'neg' => true,
                                    'w' => 7,
                                    'd' => 2,
                                    'h' => 3,
                                    'm' => 4,
                                    's' => 5,
                                    'related' => 'START',
                                    'count' => 6,
                                ),
                            ),
                        ),
                    ),
                    'rule' => array(
                        'freq' => 'SEC',
                        'until' => array(
                            'd' => '20120315T18302305Z',
                        ),
                        'count' => array(
                            'num' => 20120315,
                        ),
                        'interval' => array(
                            'ival' => 20120315,
                        ),
                        'bysecond' => array(
                            'seclist' => '10,20,30',
                        ),
                        'byminute' => array(
                            'minlist' => '10,20,30',
                        ),
                        'byhour' => array(
                            'hrlist' => '5,10,15',
                        ),
                        'byday' => array(
                            'wkday' => array(
                                array(
                                    'day' => 'SU',
                                    'ordwk' => 10,
                                ),
                            )
                        ),
                        'bymonthday' => array(
                            'modaylist' => '5,10,15',
                        ),
                        'byyearday' => array(
                            'yrdaylist' => '5,10,15',
                        ),
                        'byweekno' => array(
                            'wklist' => '5,10,15',
                        ),
                        'bymonth' => array(
                            'molist' => '5,10',
                        ),
                        'bysetpos' => array(
                            'poslist' => '5,10,15',
                        ),
                        'wkst' => array(
                            'day' => 'SU',
                        ),
                        'rule-x-name' => array(
                            array(
                                'name' => 'name',
                                'value' => 'value',
                            ),
                        ),
                    ),
                ),
                'except' => array(
                    'rangeType' => 10,
                    'recurId' => '991231',
                    'tz' => 'tz',
                    'ridZ' => '991231000000',
                ),
                'cancel' => array(
                    'rangeType' => 10,
                    'recurId' => '991231',
                    'tz' => 'tz',
                    'ridZ' => '991231000000',
                ),
                'dates' => array(
                    'tz' => 'tz',
                    'dtval' => array(
                        array(
                            's' => array(
                                'd' => '20120315T18302305Z',
                                'tz' => 'tz',
                                'u' => 1000,
                            ),
                            'e' => array(
                                'd' => '20130315T18302305Z',
                                'tz' => 'tz',
                                'u' => 2000,
                            ),
                            'dur' => array(
                                'neg' => true,
                                'w' => 7,
                                'd' => 2,
                                'h' => 3,
                                'm' => 4,
                                's' => 5,
                                'related' => 'START',
                                'count' => 6,
                            ),
                        ),
                    ),
                ),
                'rule' => array(
                    'freq' => 'SEC',
                    'until' => array(
                        'd' => '20120315T18302305Z',
                    ),
                    'count' => array(
                        'num' => 20120315,
                    ),
                    'interval' => array(
                        'ival' => 20120315,
                    ),
                    'bysecond' => array(
                        'seclist' => '10,20,30',
                    ),
                    'byminute' => array(
                        'minlist' => '10,20,30',
                    ),
                    'byhour' => array(
                        'hrlist' => '5,10,15',
                    ),
                    'byday' => array(
                        'wkday' => array(
                            array(
                                'day' => 'SU',
                                'ordwk' => 10,
                            ),
                        )
                    ),
                    'bymonthday' => array(
                        'modaylist' => '5,10,15',
                    ),
                    'byyearday' => array(
                        'yrdaylist' => '5,10,15',
                    ),
                    'byweekno' => array(
                        'wklist' => '5,10,15',
                    ),
                    'bymonth' => array(
                        'molist' => '5,10',
                    ),
                    'bysetpos' => array(
                        'poslist' => '5,10,15',
                    ),
                    'wkst' => array(
                        'day' => 'SU',
                    ),
                    'rule-x-name' => array(
                        array(
                            'name' => 'name',
                            'value' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $recur->toArray());
    }

    public function testRedirectAction()
    {
        $actionRedirect = new \Zimbra\Mail\Struct\RedirectAction(
            10, 'a'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionRedirect);
        $this->assertSame('a', $actionRedirect->a());
        $actionRedirect->a('a');
        $this->assertSame('a', $actionRedirect->a());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionRedirect index="10" a="a" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionRedirect);

        $array = array(
            'actionRedirect' => array(
                'index' => 10,
                'a' => 'a',
            ),
        );
        $this->assertEquals($array, $actionRedirect->toArray());
    }

    public function testReplies()
    {
        $reply = new \Zimbra\Mail\Struct\CalReply(
            'at', 10, 10, 10, '991231', 'sentBy', ParticipationStatus::NE(), 'tz', '991231000000'
        );
        $replies = new \Zimbra\Mail\Struct\Replies(
            array($reply)
        );
        $this->assertSame(array($reply), $replies->reply()->all());
        $replies->addReply($reply);
        $this->assertSame(array($reply, $reply), $replies->reply()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<replies>'
                .'<reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'<reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
            .'</replies>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replies);

        $array = array(
            'replies' => array(
                'reply' => array(
                    array(
                        'at' => 'at',
                        'seq' => 10,
                        'd' => 10,
                        'sentBy' => 'sentBy',
                        'ptst' => 'NE',
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                    array(
                        'at' => 'at',
                        'seq' => 10,
                        'd' => 10,
                        'sentBy' => 'sentBy',
                        'ptst' => 'NE',
                        'rangeType' => 10,
                        'recurId' => '991231',
                        'tz' => 'tz',
                        'ridZ' => '991231000000',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $replies->toArray());
    }

    public function testReplyAction()
    {
        $actionReply = new \Zimbra\Mail\Struct\ReplyAction(
            10, 'content'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionReply);
        $this->assertSame('content', $actionReply->content());
        $actionReply->content('content');
        $this->assertSame('content', $actionReply->content());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionReply index="10">'
                .'<content>content</content>'
            .'</actionReply>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionReply);

        $array = array(
            'actionReply' => array(
                'index' => 10,
                'content' => 'content',
            ),
        );
        $this->assertEquals($array, $actionReply->toArray());
    }

    public function testRetentionPolicy()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Mail\Struct\RetentionPolicyKeep(array($policy));
        $policy = new \Zimbra\Mail\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Mail\Struct\RetentionPolicyPurge(array($policy));

        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            $keep, $purge
        );
        $this->assertSame($keep, $retentionPolicy->keep());
        $this->assertSame($purge, $retentionPolicy->purge());

        $retentionPolicy->keep($keep)
                        ->purge($purge);
        $this->assertSame($keep, $retentionPolicy->keep());
        $this->assertSame($purge, $retentionPolicy->purge());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<retentionPolicy>'
                .'<keep>'
                    .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
                .'</keep>'
                .'<purge>'
                    .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
                .'</purge>'
            .'</retentionPolicy>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $retentionPolicy);

        $array = array(
            'retentionPolicy' => array(
                'keep' => array(
                    'policy' => array(
                        array(
                            'type' => 'system',
                            'id' => 'id',
                            'name' => 'name',
                            'lifetime' => 'lifetime',
                        ),
                    ),
                ),
                'purge' => array(
                    'policy' => array(
                        array(
                            'type' => 'user',
                            'id' => 'id',
                            'name' => 'name',
                            'lifetime' => 'lifetime',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $retentionPolicy->toArray());
    }

    public function testRetentionPolicyKeep()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Mail\Struct\RetentionPolicyKeep(array($policy));
        $this->assertSame(array($policy), $keep->policy()->all());
        $keep->addPolicy($policy);
        $this->assertSame(array($policy, $policy), $keep->policy()->all());
        $keep->policy()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<keep>'
                .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
            .'</keep>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $keep);

        $array = array(
            'keep' => array(
                'policy' => array(
                    array(
                        'type' => 'system',
                        'id' => 'id',
                        'name' => 'name',
                        'lifetime' => 'lifetime',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $keep->toArray());
    }

    public function testRetentionPolicyPurge()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Mail\Struct\RetentionPolicyPurge(array($policy));
        $this->assertSame(array($policy), $purge->policy()->all());
        $purge->addPolicy($policy);
        $this->assertSame(array($policy, $policy), $purge->policy()->all());
        $purge->policy()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<purge>'
                .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
            .'</purge>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $purge);

        $array = array(
            'purge' => array(
                'policy' => array(
                    array(
                        'type' => 'user',
                        'id' => 'id',
                        'name' => 'name',
                        'lifetime' => 'lifetime',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $purge->toArray());
    }

    public function testRight()
    {
        $ace = new \Zimbra\Mail\Struct\Right('right');
        $this->assertSame('right', $ace->right());
        $ace->right('right');
        $this->assertSame('right', $ace->right());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ace right="right" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $ace);

        $array = array(
            'ace' => array(
                'right' => 'right',
            ),
        );
        $this->assertEquals($array, $ace->toArray());
    }

    public function testRssDataSourceNameOrId()
    {
        $rss = new \Zimbra\Mail\Struct\RssDataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $rss);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rss name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rss);

        $array = array(
            'rss' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $rss->toArray());
    }

    public function testSaveDraftMsg()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');

        $m = new \Zimbra\Mail\Struct\SaveDraftMsg(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            10, 'forAcct', 't', 'tn', '#aabbcc', 10, 10,
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );
        $this->assertInstanceOf('Zimbra\Mail\Struct\Msg', $m);
        $this->assertSame(10, $m->id());
        $this->assertSame('forAcct', $m->forAcct());
        $this->assertSame('t', $m->t());
        $this->assertSame('tn', $m->tn());
        $this->assertSame('#aabbcc', $m->rgb());
        $this->assertSame(10, $m->color());
        $this->assertSame(10, $m->autoSendTime());

        $m->id(10)
          ->forAcct('forAcct')
          ->t('t')
          ->tn('tn')
          ->rgb('#aabbcc')
          ->color(10)
          ->autoSendTime(10);
        $this->assertSame(10, $m->id());
        $this->assertSame('forAcct', $m->forAcct());
        $this->assertSame('t', $m->t());
        $this->assertSame('tn', $m->tn());
        $this->assertSame('#aabbcc', $m->rgb());
        $this->assertSame(10, $m->color());
        $this->assertSame(10, $m->autoSendTime());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<m id="10" forAcct="forAcct" t="t" tn="tn" rgb="#aabbcc" color="10" autoSendTime="10" aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                .'<content>content</content>'
                .'<mp ct="ct" content="content" ci="ci">'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn optional="false" id="id" />'
                        .'<doc optional="true" path="path" id="id" ver="10" />'
                    .'</attach>'
                    .'<mp ct="ct" content="content" ci="ci" />'
                .'</mp>'
                .'<attach aid="aid">'
                    .'<mp optional="true" mid="mid" part="part" />'
                    .'<m optional="false" id="id" />'
                    .'<cn optional="false" id="id" />'
                    .'<doc optional="true" path="path" id="id" ver="10" />'
                .'</attach>'
                .'<inv method="method" compNum="10" rsvp="true" />'
                .'<fr>fr</fr>'
                .'<header name="name">value</header>'
                .'<e a="a" t="t" p="p" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</m>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $m);

        $array = array(
            'm' => array(
                'id' => 10,
                'forAcct' => 'forAcct',
                't' => 't',
                'tn' => 'tn',
                'rgb' => '#aabbcc',
                'color' => 10,
                'autoSendTime' => 10,
                'aid' => 'aid',
                'origid' => 'origid',
                'rt' => 'rt',
                'idnt' => 'idnt',
                'su' => 'su',
                'irt' => 'irt',
                'l' => 'l',
                'f' => 'f',
                'content' => 'content',
                'header' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
                'mp' => array(
                    'ct' => 'ct',
                    'content' => 'content',
                    'ci' => 'ci',
                    'mp' => array(
                        array(
                            'ct' => 'ct',
                            'content' => 'content',
                            'ci' => 'ci',
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => true,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 10,
                            'optional' => true,
                        ),
                    ),
                ),
                'attach' => array(
                    'aid' => 'aid',
                    'mp' => array(
                        'mid' => 'mid',
                        'part' => 'part',
                        'optional' => true,
                    ),
                    'm' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'cn' => array(
                        'id' => 'id',
                        'optional' => false,
                    ),
                    'doc' => array(
                        'path' => 'path',
                        'id' => 'id',
                        'ver' => 10,
                        'optional' => true,
                    ),
                ),
                'inv' => array(
                    'method' => 'method',
                    'compNum' => 10,
                    'rsvp' => true,
                ),
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
                'tz' => array(
                    array(
                        'id' => 'id',
                        'stdoff' => 10,
                        'dayoff' => 10,
                        'stdname' => 'stdname',
                        'dayname' => 'dayname',
                        'standard' => array(
                            'mon' => 12,
                            'hour' => 2,
                            'min' => 3,
                            'sec' => 4,
                        ),
                        'daylight' => array(
                            'mon' => 4,
                            'hour' => 3,
                            'min' => 2,
                            'sec' => 10,
                        ),
                    ),
                ),
                'fr' => 'fr',
            ),
        );
        $this->assertEquals($array, $m->toArray());
    }

    public function testSectionAttr()
    {
        $meta = new \Zimbra\Mail\Struct\SectionAttr('section');
        $this->assertSame('section', $meta->section());

        $meta->section('section');
        $this->assertSame('section', $meta->section());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<meta section="section" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $meta);

        $array = array(
            'meta' => array(
                'section' => 'section',
            ),
        );
        $this->assertEquals($array, $meta->toArray());
    }

    public function testSetCalendarItemInfo()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Mail\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');

        $m = new \Zimbra\Mail\Struct\Msg(
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr',
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f'
        );

        $item = new \Zimbra\Mail\Struct\SetCalendarItemInfo(
            $m, ParticipationStatus::NE()
        );
        $this->assertSame($m, $item->m());
        $this->assertTrue($item->ptst()->is('NE'));

        $item->m($m)
             ->ptst(ParticipationStatus::NE());
        $this->assertSame($m, $item->m());
        $this->assertTrue($item->ptst()->is('NE'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<item ptst="NE">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn optional="false" id="id" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn optional="false" id="id" />'
                        .'<doc optional="true" path="path" id="id" ver="10" />'
                    .'</attach>'
                    .'<inv method="method" compNum="10" rsvp="true" />'
                    .'<fr>fr</fr>'
                    .'<header name="name">value</header>'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                        .'<standard mon="12" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="10" />'
                    .'</tz>'
                .'</m>'
            .'</item>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $item);

        $array = array(
            'item' => array(
                'ptst' => 'NE',
                'm' => array(
                    'aid' => 'aid',
                    'origid' => 'origid',
                    'rt' => 'rt',
                    'idnt' => 'idnt',
                    'su' => 'su',
                    'irt' => 'irt',
                    'l' => 'l',
                    'f' => 'f',
                    'content' => 'content',
                    'header' => array(
                        array(
                            'name' => 'name',
                            '_' => 'value',
                        ),
                    ),
                    'mp' => array(
                        'ct' => 'ct',
                        'content' => 'content',
                        'ci' => 'ci',
                        'mp' => array(
                            array(
                                'ct' => 'ct',
                                'content' => 'content',
                                'ci' => 'ci',
                            ),
                        ),
                        'attach' => array(
                            'aid' => 'aid',
                            'mp' => array(
                                'mid' => 'mid',
                                'part' => 'part',
                                'optional' => true,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => false,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => false,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 10,
                                'optional' => true,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => true,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => false,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 10,
                            'optional' => true,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 10,
                        'rsvp' => true,
                    ),
                    'e' => array(
                        array(
                            'a' => 'a',
                            't' => 't',
                            'p' => 'p',
                        ),
                    ),
                    'tz' => array(
                        array(
                            'id' => 'id',
                            'stdoff' => 10,
                            'dayoff' => 10,
                            'stdname' => 'stdname',
                            'dayname' => 'dayname',
                            'standard' => array(
                                'mon' => 12,
                                'hour' => 2,
                                'min' => 3,
                                'sec' => 4,
                            ),
                            'daylight' => array(
                                'mon' => 4,
                                'hour' => 3,
                                'min' => 2,
                                'sec' => 10,
                            ),
                        ),
                    ),
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $item->toArray());
    }

    public function testSharedReminderMount()
    {
        $link = new \Zimbra\Mail\Struct\SharedReminderMount(
            'id', true
        );
        $this->assertSame('id', $link->id());
        $this->assertTrue($link->reminder());

        $link->id('id')
             ->reminder(true);
        $this->assertSame('id', $link->id());
        $this->assertTrue($link->reminder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<link id="id" reminder="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $link);

        $array = array(
            'link' => array(
                'id' => 'id',
                'reminder' => true,
            ),
        );
        $this->assertEquals($array, $link->toArray());
    }

    public function testSimpleRepeatingRule()
    {
        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), 10);

        $until = new \Zimbra\Mail\Struct\DateTimeStringAttr('20120315T18302305Z');
        $count = new \Zimbra\Mail\Struct\NumAttr(20120315);
        $interval = new \Zimbra\Mail\Struct\IntervalRule(20120315);
        $bysecond = new \Zimbra\Mail\Struct\BySecondRule('10,a,20,b,30');
        $byminute = new \Zimbra\Mail\Struct\ByMinuteRule('10,a,20,b,30');
        $byhour = new \Zimbra\Mail\Struct\ByHourRule('5,a,10,b,15');
        $byday = new \Zimbra\Mail\Struct\ByDayRule(array($wkday));
        $bymonthday = new \Zimbra\Mail\Struct\ByMonthDayRule('5,a,10,b,15,32');
        $byyearday = new \Zimbra\Mail\Struct\ByYearDayRule('5,a,10,b,15,367');
        $byweekno = new \Zimbra\Mail\Struct\ByWeekNoRule('5,a,10,b,15,54');
        $bymonth = new \Zimbra\Mail\Struct\ByMonthRule('5,a,10,b,15');
        $bysetpos = new \Zimbra\Mail\Struct\BySetPosRule('5,a,10,b,15,367');
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $xname = new \Zimbra\Mail\Struct\XNameRule('name', 'value');

        $rule = new \Zimbra\Mail\Struct\SimpleRepeatingRule(
            Frequency::SEC(),
            $until,
            $count,
            $interval,
            $bysecond,
            $byminute,
            $byhour,
            $byday,
            $bymonthday,
            $byyearday,
            $byweekno,
            $bymonth,
            $bysetpos,
            $wkst,
            array($xname)
        );
        $this->assertSame('SEC', (string) $rule->freq());
        $this->assertSame($until, $rule->until());
        $this->assertSame($count, $rule->count());
        $this->assertSame($interval, $rule->interval());
        $this->assertSame($bysecond, $rule->bysecond());
        $this->assertSame($byminute, $rule->byminute());
        $this->assertSame($byhour, $rule->byhour());
        $this->assertSame($byday, $rule->byday());
        $this->assertSame($bymonthday, $rule->bymonthday());
        $this->assertSame($byyearday, $rule->byyearday());
        $this->assertSame($byweekno, $rule->byweekno());
        $this->assertSame($bymonth, $rule->bymonth());
        $this->assertSame($bysetpos, $rule->bysetpos());
        $this->assertSame($wkst, $rule->wkst());
        $this->assertSame(array($xname), $rule->ruleXName()->all());

        $rule->freq(Frequency::SEC())
             ->until($until)
             ->count($count)
             ->interval($interval)
             ->bysecond($bysecond)
             ->byminute($byminute)
             ->byhour($byhour)
             ->byday($byday)
             ->bymonthday($bymonthday)
             ->byyearday($byyearday)
             ->byweekno($byweekno)
             ->bymonth($bymonth)
             ->bysetpos($bysetpos)
             ->wkst($wkst)
             ->addXNameRule($xname);
        $this->assertSame('SEC', (string) $rule->freq());
        $this->assertSame($until, $rule->until());
        $this->assertSame($count, $rule->count());
        $this->assertSame($interval, $rule->interval());
        $this->assertSame($bysecond, $rule->bysecond());
        $this->assertSame($byminute, $rule->byminute());
        $this->assertSame($byhour, $rule->byhour());
        $this->assertSame($byday, $rule->byday());
        $this->assertSame($bymonthday, $rule->bymonthday());
        $this->assertSame($byyearday, $rule->byyearday());
        $this->assertSame($byweekno, $rule->byweekno());
        $this->assertSame($bymonth, $rule->bymonth());
        $this->assertSame($bysetpos, $rule->bysetpos());
        $this->assertSame($wkst, $rule->wkst());
        $this->assertSame(array($xname, $xname), $rule->ruleXName()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule freq="SEC">'
                .'<until d="20120315T18302305Z" />'
                .'<count num="20120315" />'
                .'<interval ival="20120315" />'
                .'<bysecond seclist="10,20,30" />'
                .'<byminute minlist="10,20,30" />'
                .'<byhour hrlist="5,10,15" />'
                .'<byday>'
                    .'<wkday day="SU" ordwk="10" />'
                .'</byday>'
                .'<bymonthday modaylist="5,10,15" />'
                .'<byyearday yrdaylist="5,10,15" />'
                .'<byweekno wklist="5,10,15" />'
                .'<bymonth molist="5,10" />'
                .'<bysetpos poslist="5,10,15" />'
                .'<wkst day="SU" />'
                .'<rule-x-name name="name" value="value" />'
                .'<rule-x-name name="name" value="value" />'
            .'</rule>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'freq' => 'SEC',
                'until' => array(
                    'd' => '20120315T18302305Z',
                ),
                'count' => array(
                    'num' => 20120315,
                ),
                'interval' => array(
                    'ival' => 20120315,
                ),
                'bysecond' => array(
                    'seclist' => '10,20,30',
                ),
                'byminute' => array(
                    'minlist' => '10,20,30',
                ),
                'byhour' => array(
                    'hrlist' => '5,10,15',
                ),
                'byday' => array(
                    'wkday' => array(
                        array(
                            'day' => 'SU',
                            'ordwk' => 10,
                        ),
                    )
                ),
                'bymonthday' => array(
                    'modaylist' => '5,10,15',
                ),
                'byyearday' => array(
                    'yrdaylist' => '5,10,15',
                ),
                'byweekno' => array(
                    'wklist' => '5,10,15',
                ),
                'bymonth' => array(
                    'molist' => '5,10',
                ),
                'bysetpos' => array(
                    'poslist' => '5,10,15',
                ),
                'wkst' => array(
                    'day' => 'SU',
                ),
                'rule-x-name' => array(
                    array(
                        'name' => 'name',
                        'value' => 'value',
                    ),
                    array(
                        'name' => 'name',
                        'value' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }

    public function testSingleDates()
    {
        $s = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $e = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20130315T18302305Z', 'tz', 2000
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(
            true, 7, 2, 3, 4, 5, 'START', 6
        );
        $dtval = new \Zimbra\Mail\Struct\DtVal($s, $e, $dur);

        $dates = new \Zimbra\Mail\Struct\SingleDates(array($dtval), 'tz');
        $this->assertSame('tz', $dates->tz());
        $this->assertSame(array($dtval), $dates->dtval()->all());

        $dates->tz('tz')
              ->addDtVal($dtval);
        $this->assertSame('tz', $dates->tz());
        $this->assertSame(array($dtval, $dtval), $dates->dtval()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dates tz="tz">'
                .'<dtval>'
                    .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                    .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</dtval>'
                .'<dtval>'
                    .'<s d="20120315T18302305Z" tz="tz" u="1000" />'
                    .'<e d="20130315T18302305Z" tz="tz" u="2000" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                .'</dtval>'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
            'dates' => array(
                'tz' => 'tz',
                'dtval' => array(
                    array(
                        's' => array(
                            'd' => '20120315T18302305Z',
                            'tz' => 'tz',
                            'u' => 1000,
                        ),
                        'e' => array(
                            'd' => '20130315T18302305Z',
                            'tz' => 'tz',
                            'u' => 2000,
                        ),
                        'dur' => array(
                            'neg' => true,
                            'w' => 7,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'START',
                            'count' => 6,
                        ),
                    ),
                    array(
                        's' => array(
                            'd' => '20120315T18302305Z',
                            'tz' => 'tz',
                            'u' => 1000,
                        ),
                        'e' => array(
                            'd' => '20130315T18302305Z',
                            'tz' => 'tz',
                            'u' => 2000,
                        ),
                        'dur' => array(
                            'neg' => true,
                            'w' => 7,
                            'd' => 2,
                            'h' => 3,
                            'm' => 4,
                            's' => 5,
                            'related' => 'START',
                            'count' => 6,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }

    public function testSizeTest()
    {
        $sizeTest = new \Zimbra\Mail\Struct\SizeTest(
            10, 'numberComparison', 's', true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $sizeTest);
        $this->assertSame('numberComparison', $sizeTest->numberComparison());
        $this->assertSame('s', $sizeTest->s());

        $sizeTest->numberComparison('numberComparison')
                 ->s('s');
        $this->assertSame('numberComparison', $sizeTest->numberComparison());
        $this->assertSame('s', $sizeTest->s());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $sizeTest);

        $array = array(
            'sizeTest' => array(
                'index' => 10,
                'negative' => true,
                'numberComparison' => 'numberComparison',
                's' => 's',
            ),
        );
        $this->assertEquals($array, $sizeTest->toArray());
    }

    public function testSnoozeAlarm()
    {
        $alarm = new \Zimbra\Mail\Struct\SnoozeAlarm('id', 10);
        $this->assertSame('id', $alarm->id());
        $this->assertSame(10, $alarm->until());

        $alarm->id('id')
              ->until(10);
        $this->assertSame('id', $alarm->id());
        $this->assertSame(10, $alarm->until());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<alarm id="id" until="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $alarm);

        $array = array(
            'alarm' => array(
                'id' => 'id',
                'until' => 10,
            ),
        );
        $this->assertEquals($array, $alarm->toArray());
    }

    public function testSnoozeAppointmentAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\SnoozeAppointmentAlarm('id', 10);
        $this->assertInstanceOf('Zimbra\Mail\Struct\SnoozeAlarm', $appt);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<appt id="id" until="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $appt);

        $array = array(
            'appt' => array(
                'id' => 'id',
                'until' => 10,
            ),
        );
        $this->assertEquals($array, $appt->toArray());
    }

    public function testSnoozeTaskAlarm()
    {
        $task = new \Zimbra\Mail\Struct\SnoozeTaskAlarm('id', 10);
        $this->assertInstanceOf('Zimbra\Mail\Struct\SnoozeAlarm', $task);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<task id="id" until="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $task);

        $array = array(
            'task' => array(
                'id' => 'id',
                'until' => 10,
            ),
        );
        $this->assertEquals($array, $task->toArray());
    }

    public function testSocialcastTest()
    {
        $socialcastTest = new \Zimbra\Mail\Struct\SocialcastTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $socialcastTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<socialcastTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $socialcastTest);

        $array = array(
            'socialcastTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $socialcastTest->toArray());
    }

    public function testStopAction()
    {
        $actionStop = new \Zimbra\Mail\Struct\StopAction(
            10
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionStop);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionStop index="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionStop);

        $array = array(
            'actionStop' => array(
                'index' => 10,
            ),
        );
        $this->assertEquals($array, $actionStop->toArray());
    }

    public function testTagAction()
    {
        $actionTag = new \Zimbra\Mail\Struct\TagAction(
            10, 'tagName'
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterAction', $actionTag);
        $this->assertSame('tagName', $actionTag->tagName());
        $actionTag->tagName('tagName');
        $this->assertSame('tagName', $actionTag->tagName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<actionTag index="10" tagName="tagName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $actionTag);

        $array = array(
            'actionTag' => array(
                'index' => 10,
                'tagName' => 'tagName',
            ),
        );
        $this->assertEquals($array, $actionTag->toArray());
    }

    public function testTagActionSelector()
    {
        $policy = new \Zimbra\Mail\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Mail\Struct\RetentionPolicyKeep(
            array($policy)
        );
        $policy = new \Zimbra\Mail\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Mail\Struct\RetentionPolicyPurge(
            array($policy)
        );
        $retentionPolicy = new \Zimbra\Mail\Struct\RetentionPolicy(
            $keep, $purge
        );
        $action = new \Zimbra\Mail\Struct\TagActionSelector(
            $retentionPolicy, TagActionOp::READ(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $this->assertTrue($action->op()->is('read'));
        $this->assertSame($retentionPolicy, $action->retentionPolicy());

        $action->op(TagActionOp::READ())
               ->retentionPolicy($retentionPolicy);
        $this->assertTrue($action->op()->is('read'));
        $this->assertSame($retentionPolicy, $action->retentionPolicy());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<action op="read" id="id" tcon="tcon" l="l" rgb="#aabbcc" tag="10" color="10" name="name" f="f" t="t" tn="tn">'
                .'<retentionPolicy>'
                    .'<keep>'
                        .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
                    .'</keep>'
                    .'<purge>'
                        .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
                    .'</purge>'
                .'</retentionPolicy>'
            .'</action>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $action);

        $array = array(
            'action' => array(
                'op' => 'read',
                'id' => 'id',
                'tcon' => 'tcon',
                'tag' => 10,
                'l' => 'l',
                'rgb' => '#aabbcc',
                'color' => 10,
                'name' => 'name',
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'retentionPolicy' => array(
                    'keep' => array(
                        'policy' => array(
                            array(
                                'type' => 'system',
                                'id' => 'id',
                                'name' => 'name',
                                'lifetime' => 'lifetime',
                            ),
                        ),
                    ),
                    'purge' => array(
                        'policy' => array(
                            array(
                                'type' => 'user',
                                'id' => 'id',
                                'name' => 'name',
                                'lifetime' => 'lifetime',
                            ),
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $action->toArray());
    }

    public function testTagSpec()
    {
        $tag = new \Zimbra\Mail\Struct\TagSpec(
            'name', '#aabbcc', 10
        );
        $this->assertSame('name', $tag->name());
        $this->assertSame('#aabbcc', $tag->rgb());
        $this->assertSame(10, $tag->color());

        $tag->name('name')
            ->rgb('#aabbcc')
            ->color(10);
        $this->assertSame('name', $tag->name());
        $this->assertSame('#aabbcc', $tag->rgb());
        $this->assertSame(10, $tag->color());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<tag name="name" rgb="#aabbcc" color="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $tag);

        $array = array(
            'tag' => array(
                'name' => 'name',
                'rgb' => '#aabbcc',
                'color' => 10,
            ),
        );
        $this->assertEquals($array, $tag->toArray());
    }

    public function testTargetSpec()
    {
        $target = new \Zimbra\Mail\Struct\TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), 'value'
        );
        $this->assertTrue($target->type()->is('account'));
        $this->assertTrue($target->by()->is('name'));
        $this->assertSame('value', $target->value());

        $target->type(TargetType::ACCOUNT())
               ->by(AccountBy::NAME())
               ->value('value');
        $this->assertTrue($target->type()->is('account'));
        $this->assertTrue($target->by()->is('name'));
        $this->assertSame('value', $target->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<target type="account" by="name">value</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = array(
            'target' => array(
                'type' => 'account',
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $target->toArray());
    }

    public function testTrueTest()
    {
        $trueTest = new \Zimbra\Mail\Struct\TrueTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $trueTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<trueTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $trueTest);

        $array = array(
            'trueTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $trueTest->toArray());
    }

    public function testTwitterTest()
    {
        $twitterTest = new \Zimbra\Mail\Struct\TwitterTest(
            10, true
        );
        $this->assertInstanceOf('\Zimbra\Mail\Struct\FilterTest', $twitterTest);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<twitterTest index="10" negative="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $twitterTest);

        $array = array(
            'twitterTest' => array(
                'index' => 10,
                'negative' => true,
            ),
        );
        $this->assertEquals($array, $twitterTest->toArray());
    }

    public function testUnknownDataSourceNameOrId()
    {
        $unknown = new \Zimbra\Mail\Struct\UnknownDataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $unknown);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<unknown name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $unknown);

        $array = array(
            'unknown' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $unknown->toArray());
    }

    public function testVCardInfo()
    {
        $vcard = new \Zimbra\Mail\Struct\VCardInfo(
            'value', 'mid', 'part', 'aid'
        );
        $this->assertSame('value', $vcard->value());
        $this->assertSame('mid', $vcard->mid());
        $this->assertSame('part', $vcard->part());
        $this->assertSame('aid', $vcard->aid());

        $vcard->value('value')
              ->mid('mid')
              ->part('part')
              ->aid('aid');
        $this->assertSame('value', $vcard->value());
        $this->assertSame('mid', $vcard->mid());
        $this->assertSame('part', $vcard->part());
        $this->assertSame('aid', $vcard->aid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<vcard mid="mid" part="part" aid="aid">value</vcard>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $vcard);

        $array = array(
            'vcard' => array(
                '_' => 'value',
                'mid' => 'mid',
                'part' => 'part',
                'aid' => 'aid',
            ),
        );
        $this->assertEquals($array, $vcard->toArray());
    }

    public function testWaitSetAddSpec()
    {
        $waitSet = new \Zimbra\Mail\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $this->assertSame('name', $waitSet->name());
        $this->assertSame('id', $waitSet->id());
        $this->assertSame('token', $waitSet->token());
        $this->assertSame('f', $waitSet->types());

        $waitSet->name('name')
                ->id('id')
                ->token('token')
                ->addType(InterestType::MESSAGES())
                ->addType(InterestType::CONTACTS());
        $this->assertSame('name', $waitSet->name());
        $this->assertSame('id', $waitSet->id());
        $this->assertSame('token', $waitSet->token());
        $this->assertSame('f,m,c', $waitSet->types());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<a name="name" id="id" token="token" types="f,m,c" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $waitSet);

        $array = array(
            'a' => array(
                'name' => 'name',
                'id' => 'id',
                'token' => 'token',
                'types' => 'f,m,c',
            ),
        );
        $this->assertEquals($array, $waitSet->toArray());
    }

    public function testWaitSetSpec()
    {
        $a = new \Zimbra\Mail\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS(), InterestType::MESSAGES()));
        $add = new \Zimbra\Mail\Struct\WaitSetSpec(array($a));
        $this->assertSame(array($a), $add->a()->all());
        $add->addWaitSet($a);
        $this->assertSame(array($a, $a), $add->a()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<add>'
                .'<a name="name" id="id" token="token" types="f,m" />'
                .'<a name="name" id="id" token="token" types="f,m" />'
            .'</add>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $add);

        $array = array(
            'add' => array(
                'a' => array(
                    array(
                        'name' => 'name',
                        'id' => 'id',
                        'token' => 'token',
                        'types' => 'f,m',
                    ),
                    array(
                        'name' => 'name',
                        'id' => 'id',
                        'token' => 'token',
                        'types' => 'f,m',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $add->toArray());
    }

    public function testWaitSetId()
    {
        $a = new \Zimbra\Struct\Id('id');
        $remove = new \Zimbra\Mail\Struct\WaitSetId(array($a));
        $this->assertSame(array($a), $remove->a()->all());
        $remove->addId($a);
        $this->assertSame(array($a, $a), $remove->a()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<remove>'
                .'<a id="id" />'
                .'<a id="id" />'
            .'</remove>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $remove);

        $array = array(
            'remove' => array(
                'a' => array(
                    array(
                        'id' => 'id',
                    ),
                    array(
                        'id' => 'id',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $remove->toArray());
    }

    public function testWkDay()
    {
        $wkday = new \Zimbra\Mail\Struct\WkDay(WeekDay::SU(), 10);
        $this->assertSame('SU', (string) $wkday->day());
        $this->assertSame(10, $wkday->ordwk());

        $wkday->day(WeekDay::SU())
              ->ordwk(10);
        $this->assertSame('SU', (string) $wkday->day());
        $this->assertSame(10, $wkday->ordwk());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<wkday day="SU" ordwk="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkday);

        $array = array(
            'wkday' => array(
                'day' => 'SU',
                'ordwk' => 10,
            ),
        );
        $this->assertEquals($array, $wkday->toArray());
    }

    public function testWkstRule()
    {
        $wkst = new \Zimbra\Mail\Struct\WkstRule(WeekDay::SU());
        $this->assertSame('SU', (string) $wkst->day());

        $wkst->day(WeekDay::SU());
        $this->assertSame('SU', (string) $wkst->day());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<wkst day="SU" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $wkst);

        $array = array(
            'wkst' => array(
                'day' => 'SU',
            ),
        );
        $this->assertEquals($array, $wkst->toArray());
    }

    public function testXNameRule()
    {
        $xname = new \Zimbra\Mail\Struct\XNameRule('n', 'v');
        $this->assertSame('n', $xname->name());
        $this->assertSame('v', $xname->value());

        $xname->name('name')
              ->value('value');
        $this->assertSame('name', $xname->name());
        $this->assertSame('value', $xname->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule-x-name name="name" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xname);

        $array = array(
            'rule-x-name' => array(
                'name' => 'name',
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $xname->toArray());
    }

    public function testXParam()
    {
        $xparam = new \Zimbra\Mail\Struct\XParam('name', 'value');
        $this->assertSame('name', $xparam->name());
        $this->assertSame('value', $xparam->value());

        $xparam->name('name')
               ->value('value');
        $this->assertSame('name', $xparam->name());
        $this->assertSame('value', $xparam->value());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<xparam name="name" value="value" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xparam);

        $array = array(
            'xparam' => array(
                'name' => 'name',
                'value' => 'value',
            ),
        );
        $this->assertEquals($array, $xparam->toArray());
    }

    public function testXProp()
    {
        $xparam1 = new \Zimbra\Mail\Struct\XParam('name1', 'value1');
        $xparam2 = new \Zimbra\Mail\Struct\XParam('name2', 'value2');
        $xprop = new \Zimbra\Mail\Struct\XProp('name', 'value', array($xparam1));

        $this->assertSame(array($xparam1), $xprop->xparam()->all());
        $this->assertSame('name', $xprop->name());
        $this->assertSame('value', $xprop->value());

        $xprop->addXParam($xparam2);
        $this->assertSame(array($xparam1, $xparam2), $xprop->xparam()->all());
        $xprop->name('name')
              ->value('value');
        $this->assertSame('name', $xprop->name());
        $this->assertSame('value', $xprop->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<xprop name="name" value="value">'
                .'<xparam name="name1" value="value1" />'
                .'<xparam name="name2" value="value2" />'
            .'</xprop>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xprop);

        $array = array(
            'xprop' => array(
                'name' => 'name',
                'value' => 'value',
                'xparam' => array(
                    array(
                        'name' => 'name1',
                        'value' => 'value1',
                    ),
                    array(
                        'name' => 'name2',
                        'value' => 'value2',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $xprop->toArray());
    }

    public function testYabDataSourceNameOrId()
    {
        $yab = new \Zimbra\Mail\Struct\YabDataSourceNameOrId('name', 'id');
        $this->assertInstanceOf('\Zimbra\Mail\Struct\DataSourceNameOrId', $yab);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<yab name="name" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $yab);

        $array = array(
            'yab' => array(
                'name' => 'name',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $yab->toArray());
    }
}
