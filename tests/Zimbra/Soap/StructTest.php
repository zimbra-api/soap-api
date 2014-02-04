<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Utils\SimpleXML;

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\AceRightType;
use Zimbra\Soap\Enum\AclType;
use Zimbra\Soap\Enum\AlarmAction;
use Zimbra\Soap\Enum\AuthScheme;
use Zimbra\Soap\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Soap\Enum\CacheEntryBy;
use Zimbra\Soap\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Soap\Enum\ContactActionOp;
use Zimbra\Soap\Enum\ConvActionOp;
use Zimbra\Soap\Enum\ContentType;
use Zimbra\Soap\Enum\CosBy;
use Zimbra\Soap\Enum\DataSourceBy;
use Zimbra\Soap\Enum\DataSourceType;
use Zimbra\Soap\Enum\DistributionListBy as DLBy;
use Zimbra\Soap\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Soap\Enum\DistributionListSubscribeOp as DLSubscribeOp;
use Zimbra\Soap\Enum\DocumentActionOp;
use Zimbra\Soap\Enum\DocumentGrantType;
use Zimbra\Soap\Enum\DocumentPermission;
use Zimbra\Soap\Enum\DomainBy;
use Zimbra\Soap\Enum\FilterCondition;
use Zimbra\Soap\Enum\FreeBusyStatus;
use Zimbra\Soap\Enum\Frequency;
use Zimbra\Soap\Enum\FolderActionOp;
use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\GranteeBy;
use Zimbra\Soap\Enum\Importance;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Soap\Enum\InviteChange;
use Zimbra\Soap\Enum\InviteClass;
use Zimbra\Soap\Enum\InviteStatus;
use Zimbra\Soap\Enum\ItemActionOp;
use Zimbra\Soap\Enum\LoggingLevel;
use Zimbra\Soap\Enum\MdsConnectionType;
use Zimbra\Soap\Enum\MsgActionOp;
use Zimbra\Soap\Enum\Operation;
use Zimbra\Soap\Enum\ParticipationStatus as ParticipationStatus;
use Zimbra\Soap\Enum\QueueAction;
use Zimbra\Soap\Enum\QueueActionBy;
use Zimbra\Soap\Enum\RankingActionOp;
use Zimbra\Soap\Enum\SearchType;
use Zimbra\Soap\Enum\ServerBy;
use Zimbra\Soap\Enum\TagActionOp;
use Zimbra\Soap\Enum\TargetType;
use Zimbra\Soap\Enum\TargetBy;
use Zimbra\Soap\Enum\Transparency;
use Zimbra\Soap\Enum\Type;
use Zimbra\Soap\Enum\UcServiceBy;
use Zimbra\Soap\Enum\WeekDay;
use Zimbra\Soap\Enum\XmppComponentBy as XmppBy;
use Zimbra\Soap\Enum\ZimletStatus;

/**
 * Testcase class for soap struct.
 */
class StructTest extends ZimbraTestCase
{
    public function testAttrsImpl()
    {
        $stub = $this->getMockForAbstractClass('Zimbra\Soap\Struct\AttrsImpl');

        $attr1 = new \Zimbra\Soap\Struct\KeyValuePair('key1', 'value1');
        $attr2 = new \Zimbra\Soap\Struct\KeyValuePair('key2', 'value2');
        $attr3 = new \Zimbra\Soap\Struct\KeyValuePair('key3', 'value3');
        $stub->addAttr($attr1)->attr()->addAll(array($attr2, $attr3));
        foreach ($stub->attr() as $attr)
        {
            $this->assertInstanceOf('\Zimbra\Soap\Struct\KeyValuePair', $attr);
        }

        $arr = array('a' => array(
            array('n' => 'key1', '_' => 'value1'),
            array('n' => 'key2', '_' => 'value2'),
            array('n' => 'key3', '_' => 'value3'),
        ));
        $this->assertEquals($arr, $stub->toArray());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<attrs>'
                .'<a n="key1">value1</a>'
                .'<a n="key2">value2</a>'
                .'<a n="key3">value3</a>'
            .'</attrs>';
        $this->assertXmlStringEqualsXmlString($xml, $stub->appendAttrs(new SimpleXML('<attrs />'))->asXml());
    }

    public function testTZFixupRuleMatchDate()
    {
        $date = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(100, 100);
        $this->assertSame(1, $date->mon());
        $this->assertSame(1, $date->mday());

        $date->mon(1)
             ->mday(1);
        $this->assertSame(1, $date->mon());
        $this->assertSame(1, $date->mday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<date mon="1" mday="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $date);

        $array = array(
            'date' => array(
                'mon' => 1,
                'mday' => 1,
            ),
        );
        $this->assertEquals($array, $date->toArray());
    }

    public function testTZFixupRuleMatchDates()
    {
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);

        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(10, 10, $standard, $daylight);
        $this->assertSame(10, $dates->stdoff());
        $this->assertSame(10, $dates->dayoff());
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());

        $dates->stdoff(1)
              ->dayoff(1)
              ->standard($standard)
              ->daylight($daylight);
        $this->assertSame(1, $dates->stdoff());
        $this->assertSame(1, $dates->dayoff());
        $this->assertSame($standard, $dates->standard());
        $this->assertSame($daylight, $dates->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<dates stdoff="1" dayoff="1">'
                .'<standard mon="1" mday="1" />'
                .'<daylight mon="2" mday="2" />'
            .'</dates>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $dates);

        $array = array(
            'dates' => array(
                'stdoff' => 1,
                'dayoff' => 1,
                'standard' => array(
                    'mon' => 1,
                    'mday' => 1,
                ),
                'daylight' => array(
                    'mon' => 2,
                    'mday' => 2,
                ),
            ),
        );
        $this->assertEquals($array, $dates->toArray());
    }

    public function testTZFixupRuleMatchRule()
    {
        $rule = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(100, 100, 100);
        $this->assertSame(1, $rule->mon());
        $this->assertSame(-1, $rule->week());
        $this->assertSame(1, $rule->wkday());

        $rule->mon(1)
             ->week(1)
             ->wkday(10);
        $this->assertSame(1, $rule->mon());
        $this->assertSame(1, $rule->week());
        $this->assertSame(1, $rule->wkday());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rule mon="1" week="1" wkday="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rule);

        $array = array(
            'rule' => array(
                'mon' => 1,
                'week' => 1,
                'wkday' => 1,
            ),
        );
        $this->assertEquals($array, $rule->toArray());
    }

    public function testTZFixupRuleMatchRules()
    {
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);

        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(10, 10, $standard, $daylight);
        $this->assertSame(10, $rules->stdoff());
        $this->assertSame(10, $rules->dayoff());
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());

        $rules->stdoff(1)
              ->dayoff(1)
              ->standard($standard)
              ->daylight($daylight);
        $this->assertSame(1, $rules->stdoff());
        $this->assertSame(1, $rules->dayoff());
        $this->assertSame($standard, $rules->standard());
        $this->assertSame($daylight, $rules->daylight());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<rules stdoff="1" dayoff="1">'
                .'<standard mon="1" week="2" wkday="3" />'
                .'<daylight mon="3" week="2" wkday="1" />'
            .'</rules>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $rules);

        $array = array(
            'rules' => array(
                'stdoff' => 1,
                'dayoff' => 1,
                'standard' => array(
                    'mon' => 1,
                    'week' => 2,
                    'wkday' => 3,
                ),
                'daylight' => array(
                    'mon' => 3,
                    'week' => 2,
                    'wkday' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $rules->toArray());
    }

    public function testTZFixupRuleMatch()
    {
        $any = new \Zimbra\Soap\Struct\SimpleElement;
        $tzid = new \Zimbra\Soap\Struct\Id('id');
        $nonDst = new \Zimbra\Soap\Struct\Offset(100);

        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);
        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(1, 1, $standard, $daylight);

        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);
        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(1, 1, $standard, $daylight);

        $match = new \Zimbra\Soap\Struct\TZFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);
        $this->assertSame($any, $match->any());
        $this->assertSame($tzid, $match->tzid());
        $this->assertSame($nonDst, $match->nonDst());
        $this->assertSame($rules, $match->rules());
        $this->assertSame($dates, $match->dates());

        $match->any($any)
              ->tzid($tzid)
              ->nonDst($nonDst)
              ->rules($rules)
              ->dates($dates);
        $this->assertSame($any, $match->any());
        $this->assertSame($tzid, $match->tzid());
        $this->assertSame($nonDst, $match->nonDst());
        $this->assertSame($rules, $match->rules());
        $this->assertSame($dates, $match->dates());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<match>'
                .'<any />'
                .'<tzid id="id" />'
                .'<nonDst offset="100" />'
                .'<rules stdoff="1" dayoff="1">'
                    .'<standard mon="1" week="2" wkday="3" />'
                    .'<daylight mon="3" week="2" wkday="1" />'
                .'</rules>'
                .'<dates stdoff="1" dayoff="1">'
                    .'<standard mon="1" mday="1" />'
                    .'<daylight mon="2" mday="2" />'
                .'</dates>'
            .'</match>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $match);

        $array = array(
            'match' => array(
                'any' => array(),
                'tzid' => array('id' => 'id'),
                'nonDst' => array('offset' => 100),
                'rules' => array(
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'standard' => array(
                        'mon' => 1,
                        'week' => 2,
                        'wkday' => 3,
                    ),
                    'daylight' => array(
                        'mon' => 3,
                        'week' => 2,
                        'wkday' => 1,
                    ),
                ),
                'dates' => array(
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'standard' => array(
                        'mon' => 1,
                        'mday' => 1,
                    ),
                    'daylight' => array(
                        'mon' => 2,
                        'mday' => 2,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $match->toArray());
    }

    public function testTZReplaceInfo()
    {
        $wellKnownTz = new \Zimbra\Soap\Struct\Id('id');

        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $replace = new \Zimbra\Soap\Struct\TZReplaceInfo($wellKnownTz, $tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $replace->wellKnownTz($wellKnownTz)
                ->tz($tz);
        $this->assertSame($wellKnownTz, $replace->wellKnownTz());
        $this->assertSame($tz, $replace->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<replace>'
                .'<wellKnownTz id="id" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
            .'</replace>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $replace);

        $array = array(
            'replace' => array(
                'wellKnownTz' => array('id' => 'id'),
                'tz' => array(
                    'id' => 'id',
                    'stdoff' => 1,
                    'dayoff' => 1,
                    'stdname' => 'stdname',
                    'dayname' => 'dayname',
                    'standard' => array(
                        'mon' => 1,
                        'hour' => 2,
                        'min' => 3,
                        'sec' => 4,
                    ),
                    'daylight' => array(
                        'mon' => 4,
                        'hour' => 3,
                        'min' => 2,
                        'sec' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $replace->toArray());
    }

    public function testXmppComponentSelector()
    {
        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSelector(XmppBy::ID(), 'xmpp');
        $this->assertSame('id', $xmpp->by()->value());
        $this->assertSame('xmpp', $xmpp->value());

        $xmpp->by(XmppBy::NAME())
             ->value('value');
        $this->assertSame('name', $xmpp->by()->value());
        $this->assertSame('value', $xmpp->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<xmppcomponent by="name">value</xmppcomponent>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $xmpp);

        $array = array(
            'xmppcomponent' => array(
                'by' => 'name',
                '_' => 'value',
            ),
        );
        $this->assertEquals($array, $xmpp->toArray());
    }

    public function testStorePrincipalSpec()
    {
        $storeprincipal = new \Zimbra\Soap\Struct\StorePrincipalSpec(
            'id', 'name', 'accountNumber'
        );
        $this->assertSame('id', $storeprincipal->id());
        $this->assertSame('name', $storeprincipal->name());
        $this->assertSame('accountNumber', $storeprincipal->accountNumber());

        $storeprincipal->id('id')
                       ->name('name')
                       ->accountNumber('accountNumber');
        $this->assertSame('id', $storeprincipal->id());
        $this->assertSame('name', $storeprincipal->name());
        $this->assertSame('accountNumber', $storeprincipal->accountNumber());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<storeprincipal id="id" name="name" accountNumber="accountNumber" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $storeprincipal);

        $array = array(
            'storeprincipal' => array(
                'id' => 'id',
                'name' => 'name',
                'accountNumber' => 'accountNumber',
            ),
        );
        $this->assertEquals($array, $storeprincipal->toArray());
    }

    public function testVoiceMailPrefName()
    {
        $pref = new \Zimbra\Soap\Struct\VoiceMailPrefName('name');
        $this->assertSame('name', $pref->name());

        $pref->name('name');
        $this->assertSame('name', $pref->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<pref name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $pref);

        $array = array(
            'pref' => array(
                'name' => 'name',
            ),
        );
        $this->assertEquals($array, $pref->toArray());
    }

    public function testVoiceMailPrefsReq()
    {
        $pref = new \Zimbra\Soap\Struct\VoiceMailPrefName('name');

        $voicemailprefs = new \Zimbra\Soap\Struct\VoiceMailPrefsReq(array($pref));
        $this->assertSame(array($pref), $voicemailprefs->pref()->all());

        $voicemailprefs->addPref($pref);
        $this->assertSame(array($pref, $pref), $voicemailprefs->pref()->all());
        $voicemailprefs->pref()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<voicemailprefs>'
                .'<pref name="name" />'
            .'</voicemailprefs>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $voicemailprefs);

        $array = array(
            'voicemailprefs' => array(
                'pref' => array(
                    array('name' => 'name',),
                ),
            ),
        );
        $this->assertEquals($array, $voicemailprefs->toArray());
    }

    public function testAnonCallRejectionReq()
    {
        $anoncallrejection = new \Zimbra\Soap\Struct\AnonCallRejectionReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<anoncallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $anoncallrejection);

        $array = array(
            'anoncallrejection' => array(),
        );
        $this->assertEquals($array, $anoncallrejection->toArray());
    }

    public function testCallerIdBlockingReq()
    {
        $calleridblocking = new \Zimbra\Soap\Struct\CallerIdBlockingReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<calleridblocking />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $calleridblocking);

        $array = array(
            'calleridblocking' => array(),
        );
        $this->assertEquals($array, $calleridblocking->toArray());
    }

    public function testCallForwardReq()
    {
        $callforward = new \Zimbra\Soap\Struct\CallForwardReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforward);

        $array = array(
            'callforward' => array(),
        );
        $this->assertEquals($array, $callforward->toArray());
    }

    public function testCallForwardBusyLineReq()
    {
        $callforwardbusyline = new \Zimbra\Soap\Struct\CallForwardBusyLineReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardbusyline />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardbusyline);

        $array = array(
            'callforwardbusyline' => array(),
        );
        $this->assertEquals($array, $callforwardbusyline->toArray());
    }

    public function testCallForwardNoAnswerReq()
    {
        $callforwardnoanswer = new \Zimbra\Soap\Struct\CallForwardNoAnswerReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callforwardnoanswer />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callforwardnoanswer);

        $array = array(
            'callforwardnoanswer' => array(),
        );
        $this->assertEquals($array, $callforwardnoanswer->toArray());
    }

    public function testCallWaitingReq()
    {
        $callwaiting = new \Zimbra\Soap\Struct\CallWaitingReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<callwaiting />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $callwaiting);

        $array = array(
            'callwaiting' => array(),
        );
        $this->assertEquals($array, $callwaiting->toArray());
    }

    public function testSelectiveCallForwardReq()
    {
        $selectivecallforward = new \Zimbra\Soap\Struct\SelectiveCallForwardReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallforward />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallforward);

        $array = array(
            'selectivecallforward' => array(),
        );
        $this->assertEquals($array, $selectivecallforward->toArray());
    }

    public function testSelectiveCallAcceptanceReq()
    {
        $selectivecallacceptance = new \Zimbra\Soap\Struct\SelectiveCallAcceptanceReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallacceptance />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallacceptance);

        $array = array(
            'selectivecallacceptance' => array(),
        );
        $this->assertEquals($array, $selectivecallacceptance->toArray());
    }

    public function testSelectiveCallRejectionReq()
    {
        $selectivecallrejection = new \Zimbra\Soap\Struct\SelectiveCallRejectionReq();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<selectivecallrejection />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $selectivecallrejection);

        $array = array(
            'selectivecallrejection' => array(),
        );
        $this->assertEquals($array, $selectivecallrejection->toArray());
    }

    public function testPhoneVoiceFeaturesSpec()
    {
        $pref = new \Zimbra\Soap\Struct\VoiceMailPrefName('name');
        $voicemailprefs = new \Zimbra\Soap\Struct\VoiceMailPrefsReq(array($pref));
        $anoncallrejection = new \Zimbra\Soap\Struct\AnonCallRejectionReq();
        $calleridblocking = new \Zimbra\Soap\Struct\CallerIdBlockingReq();
        $callforward = new \Zimbra\Soap\Struct\CallForwardReq();
        $callforwardbusyline = new \Zimbra\Soap\Struct\CallForwardBusyLineReq();
        $callforwardnoanswer = new \Zimbra\Soap\Struct\CallForwardNoAnswerReq();
        $callwaiting = new \Zimbra\Soap\Struct\CallWaitingReq();
        $selectivecallforward = new \Zimbra\Soap\Struct\SelectiveCallForwardReq();
        $selectivecallacceptance = new \Zimbra\Soap\Struct\SelectiveCallAcceptanceReq();
        $selectivecallrejection = new \Zimbra\Soap\Struct\SelectiveCallRejectionReq();

        $phone = new \Zimbra\Soap\Struct\PhoneVoiceFeaturesSpec(
            'name',
            $voicemailprefs,
            $anoncallrejection,
            $calleridblocking,
            $callforward,
            $callforwardbusyline,
            $callforwardnoanswer,
            $callwaiting,
            $selectivecallforward,
            $selectivecallacceptance,
            $selectivecallrejection
        );
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $phone->name('name')
              ->voicemailprefs($voicemailprefs)
              ->anoncallrejection($anoncallrejection)
              ->calleridblocking($calleridblocking)
              ->callforward($callforward)
              ->callforwardbusyline($callforwardbusyline)
              ->callforwardnoanswer($callforwardnoanswer)
              ->callwaiting($callwaiting)
              ->selectivecallforward($selectivecallforward)
              ->selectivecallacceptance($selectivecallacceptance)
              ->selectivecallrejection($selectivecallrejection);
        $this->assertSame('name', $phone->name());
        $this->assertSame($voicemailprefs, $phone->voicemailprefs());
        $this->assertSame($anoncallrejection, $phone->anoncallrejection());
        $this->assertSame($calleridblocking, $phone->calleridblocking());
        $this->assertSame($callforward, $phone->callforward());
        $this->assertSame($callforwardbusyline, $phone->callforwardbusyline());
        $this->assertSame($callforwardnoanswer, $phone->callforwardnoanswer());
        $this->assertSame($callwaiting, $phone->callwaiting());
        $this->assertSame($selectivecallforward, $phone->selectivecallforward());
        $this->assertSame($selectivecallacceptance, $phone->selectivecallacceptance());
        $this->assertSame($selectivecallrejection, $phone->selectivecallrejection());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<phone name="name">'
                .'<voicemailprefs>'
                    .'<pref name="name" />'
                .'</voicemailprefs>'
                .'<anoncallrejection />'
                .'<calleridblocking />'
                .'<callforward />'
                .'<callforwardbusyline />'
                .'<callforwardnoanswer />'
                .'<callwaiting />'
                .'<selectivecallforward />'
                .'<selectivecallacceptance />'
                .'<selectivecallrejection />'
            .'</phone>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $phone);

        $array = array(
            'phone' => array(
                'name' => 'name',
                'voicemailprefs' => array(
                    'pref' => array(
                        array('name' => 'name',),
                    ),
                ),
                'anoncallrejection' => array(),
                'calleridblocking' => array(),
                'callforward' => array(),
                'callforwardbusyline' => array(),
                'callforwardnoanswer' => array(),
                'callwaiting' => array(),
                'selectivecallforward' => array(),
                'selectivecallacceptance' => array(),
                'selectivecallrejection' => array(),
            ),
        );
        $this->assertEquals($array, $phone->toArray());
    }
}
