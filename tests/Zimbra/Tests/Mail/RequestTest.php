<?php

namespace Zimbra\Tests\Mail;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\AceRightType;
use Zimbra\Enum\Action;
use Zimbra\Enum\BrowseBy;
use Zimbra\Enum\ContactActionOp;
use Zimbra\Enum\ConvActionOp;
use Zimbra\Enum\DocumentActionOp;
use Zimbra\Enum\DocumentGrantType;
use Zimbra\Enum\DocumentPermission;
use Zimbra\Enum\FilterCondition;
use Zimbra\Enum\FolderActionOp;
use Zimbra\Enum\GalSearchType;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\Importance;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\ItemActionOp;
use Zimbra\Enum\MdsConnectionType;
use Zimbra\Enum\MsgActionOp;
use Zimbra\Enum\ParticipationStatus;
use Zimbra\Enum\RankingActionOp;
use Zimbra\Enum\SearchType;
use Zimbra\Enum\SortBy;
use Zimbra\Enum\TagActionOp;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\Type;

/**
 * Testcase class for mail request.
 */
class RequestTest extends ZimbraTestCase
{
    public function testAddAppointmentInvite()
    {
        $m = $this->getMsg();
        $req = new \Zimbra\Mail\Request\AddAppointmentInvite(
            $m, ParticipationStatus::NE()
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->ptst()->is('NE'));

        $req->m($m)
            ->ptst(ParticipationStatus::NE());
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->ptst()->is('NE'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddAppointmentInviteRequest ptst="NE">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
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
            .'</AddAppointmentInviteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddAppointmentInviteRequest' => array(
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddComment()
    {
        $comment = new \Zimbra\Mail\Struct\AddedComment('parentId', 'text');
        $req = new \Zimbra\Mail\Request\AddComment(
            $comment
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($comment, $req->comment());

        $req->comment($comment);
        $this->assertSame($comment, $req->comment());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddCommentRequest>'
                .'<comment parentId="parentId" text="text" />'
            .'</AddCommentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddCommentRequest' => array(
                'comment' => array(
                    'parentId' => 'parentId',
                    'text' => 'text',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddMsg()
    {
        $m = new \Zimbra\Mail\Struct\AddMsgSpec(
            'content', 'f', 't', 'tn', 'l', true, 'd', 'aid'
        );
        $req = new \Zimbra\Mail\Request\AddMsg(
            $m, false
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $this->assertFalse($req->filterSent());

        $req->m($m)
            ->filterSent(true);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->filterSent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddMsgRequest filterSent="true">'
                .'<m f="f" t="t" tn="tn" l="l" noICal="true" d="d" aid="aid">'
                    .'<content>content</content>'
                .'</m>'
            .'</AddMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddMsgRequest' => array(
                'filterSent' => true,
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddTaskInvite()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\AddTaskInvite(
            $m, ParticipationStatus::NE()
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\AddAppointmentInvite', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddTaskInviteRequest ptst="NE">'
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
            .'</AddTaskInviteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddTaskInviteRequest' => array(
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testAnnounceOrganizerChange()
    {
        $req = new \Zimbra\Mail\Request\AnnounceOrganizerChange(
            'id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AnnounceOrganizerChangeRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AnnounceOrganizerChangeRequest' => array(
                'id' => 'id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testApplyFilterRules()
    {
        $filterRule = new \Zimbra\Struct\NamedElement('name');
        $filterRules = new \Zimbra\Mail\Struct\NamedFilterRules(array($filterRule));
        $m = new \Zimbra\Mail\Struct\IdsAttr('ids');

        $req = new \Zimbra\Mail\Request\ApplyFilterRules(
            $filterRules, $m, 'query'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($filterRules, $req->filterRules());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $req->query('query')
            ->m($m)
            ->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ApplyFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" />'
                .'</filterRules>'
                .'<m ids="ids" />'
                .'<query>query</query>'
            .'</ApplyFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ApplyFilterRulesRequest' => array(
                'filterRules' => array(
                    'filterRule' => array(
                        array('name' => 'name'),
                    ),
                ),
                'm' => array(
                    'ids' => 'ids',
                ),
                'query' => 'query',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testApplyOutgoingFilterRules()
    {
        $filterRule = new \Zimbra\Struct\NamedElement('name');
        $filterRules = new \Zimbra\Mail\Struct\NamedFilterRules(array($filterRule));
        $m = new \Zimbra\Mail\Struct\IdsAttr('ids');

        $req = new \Zimbra\Mail\Request\ApplyOutgoingFilterRules(
            $filterRules, $m, 'query'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($filterRules, $req->filterRules());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $req->query('query')
            ->m($m)
            ->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ApplyOutgoingFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" />'
                .'</filterRules>'
                .'<m ids="ids" />'
                .'<query>query</query>'
            .'</ApplyOutgoingFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ApplyOutgoingFilterRulesRequest' => array(
                'filterRules' => array(
                    'filterRule' => array(
                        array('name' => 'name'),
                    ),
                ),
                'm' => array(
                    'ids' => 'ids',
                ),
                'query' => 'query',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoComplete()
    {
        $req = new \Zimbra\Mail\Request\AutoComplete(
            'name', GalSearchType::ALL(), true, 'folders', true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('name', $req->name());
        $this->assertTrue($req->t()->is('all'));
        $this->assertTrue($req->needExp());
        $this->assertSame('folders', $req->folders());
        $this->assertTrue($req->includeGal());

        $req->name('name')
            ->t(GalSearchType::ALL())
            ->needExp(true)
            ->folders('folders')
            ->includeGal(true);
        $this->assertSame('name', $req->name());
        $this->assertTrue($req->t()->is('all'));
        $this->assertTrue($req->needExp());
        $this->assertSame('folders', $req->folders());
        $this->assertTrue($req->includeGal());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoCompleteRequest name="name" t="all" needExp="true" folders="folders" includeGal="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoCompleteRequest' => array(
                'name' => 'name',
                't' => 'all',
                'needExp' => true,
                'folders' => 'folders',
                'includeGal' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Mail\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraMail', $req->requestNamespace());
    }

    public function testBounceMsg()
    {
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $m = new \Zimbra\Mail\Struct\BounceMsgSpec('id', array($e));
        $req = new \Zimbra\Mail\Request\BounceMsg(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $this->assertSame($m, $req->m());
        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<BounceMsgRequest>'
                .'<m id="id">'
                    .'<e a="a" t="t" p="p" />'
                .'</m>'
            .'</BounceMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'BounceMsgRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBrowse()
    {
        $req = new \Zimbra\Mail\Request\Browse(
            BrowseBy::DOMAINS(), 'regex', 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertTrue($req->browseBy()->is('domains'));
        $this->assertSame('regex', $req->regex());
        $this->assertSame(10, $req->maxToReturn());

        $req->browseBy(BrowseBy::DOMAINS())
            ->regex('regex')
            ->maxToReturn(10);
        $this->assertTrue($req->browseBy()->is('domains'));
        $this->assertSame('regex', $req->regex());
        $this->assertSame(10, $req->maxToReturn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<BrowseRequest browseBy="domains" regex="regex" maxToReturn="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'BrowseRequest' => array(
                'browseBy' => 'domains',
                'regex' => 'regex',
                'maxToReturn' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCancelAppointment()
    {
        $tz = $this->getTz();
        $inst = new \Zimbra\Mail\Struct\InstanceRecurIdInfo('range', '20130315T18302305Z', 'tz');
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\CancelAppointment(
            $inst, $tz, $m, 'id', 10, 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($inst, $req->inst());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $req->inst($inst)
            ->tz($tz)
            ->m($m)
            ->id('id')
            ->comp(10)
            ->ms(10)
            ->rev(10);
        $this->assertSame($inst, $req->inst());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CancelAppointmentRequest id="id" comp="10" ms="10" rev="10">'
                .'<inst range="range" d="20130315T18302305Z" tz="tz" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
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
            .'</CancelAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CancelAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
                'inst' => array(
                    'range' => 'range',
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCancelTask()
    {
        $req = new \Zimbra\Mail\Request\CancelTask;
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CancelAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CancelTaskRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CancelTaskRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDeviceStatus()
    {
        $device = new \Zimbra\Struct\Id('id');
        $req = new \Zimbra\Mail\Request\CheckDeviceStatus($device);
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($device, $req->device());
        $req->device($device);
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckDeviceStatusRequest>'
                .'<device id="id" />'
            .'</CheckDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckDeviceStatusRequest' => array(
                'device' => array(
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckPermission()
    {
        $target = new \Zimbra\Mail\Struct\TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), 'value'
        );
        $req = new \Zimbra\Mail\Request\CheckPermission($target, array('right1'));
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame(array('right1'), $req->right()->all());

        $req->target($target)
            ->addRight('right2');
        $this->assertSame($target, $req->target());
        $this->assertSame(array('right1', 'right2'), $req->right()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckPermissionRequest>'
                .'<target type="account" by="name">value</target>'
                .'<right>right1</right>'
                .'<right>right2</right>'
            .'</CheckPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckPermissionRequest' => array(
                'target' => array(
                    'type' => 'account',
                    'by' => 'name',
                    '_' => 'value',
                ),
                'right' => array('right1', 'right2')
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckRecurConflicts()
    {
        $exceptId = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo;

        $tz = $this->getTz();
        $cancel = new \Zimbra\Mail\Struct\ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, 10, 10
        );
        $comp = new \Zimbra\Mail\Struct\ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur, 10, 10
        );
        $except = new \Zimbra\Mail\Struct\ExpandedRecurrenceException(
            $exceptId, $dur, $recur, 10, 10
        );
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            10, 'id', 'name'
        );

        $req = new \Zimbra\Mail\Request\CheckRecurConflicts(
            array($tz), $cancel, $comp, $except, array($usr), 10, 10, true, 'excludeUid'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(array($tz), $req->tz()->all());
        $this->assertSame($cancel, $req->cancel());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame(array($usr), $req->usr()->all());
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertTrue($req->all());
        $this->assertSame('excludeUid', $req->excludeUid());

        $req->addTz($tz)
            ->cancel($cancel)
            ->comp($comp)
            ->except($except)
            ->addUsr($usr)
            ->s(10)
            ->e(10)
            ->all(true)
            ->excludeUid('excludeUid');
        $this->assertSame(array($tz, $tz), $req->tz()->all());
        $this->assertSame($cancel, $req->cancel());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame(array($usr, $usr), $req->usr()->all());
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertTrue($req->all());
        $this->assertSame('excludeUid', $req->excludeUid());

        $req = new \Zimbra\Mail\Request\CheckRecurConflicts(
            array($tz), $cancel, $comp, $except, array($usr), 10, 10, true, 'excludeUid'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckRecurConflictsRequest s="10" e="10" all="true" excludeUid="excludeUid">'
                .'<cancel s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</cancel>'
                .'<comp s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</comp>'
                .'<except s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</except>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<usr l="10" id="id" name="name" />'
            .'</CheckRecurConflictsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckRecurConflictsRequest' => array(
                's' => 10,
                'e' => 10,
                'all' => true,
                'excludeUid' => 'excludeUid',
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
                'usr' => array(
                    array(
                        'l' => 10,
                        'id' => 'id',
                        'name' => 'name',
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckSpelling()
    {
        $req = new \Zimbra\Mail\Request\CheckSpelling(
            'value', 'dictionary', 'ignore'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('value', $req->value());
        $this->assertSame('dictionary', $req->dictionary());
        $this->assertSame('ignore', $req->ignore());

        $req->value('value')
            ->dictionary('dictionary')
            ->ignore('ignore');
        $this->assertSame('value', $req->value());
        $this->assertSame('dictionary', $req->dictionary());
        $this->assertSame('ignore', $req->ignore());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckSpellingRequest dictionary="dictionary" ignore="ignore">value</CheckSpellingRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckSpellingRequest' => array(
                '_' => 'value',
                'dictionary' => 'dictionary',
                'ignore' => 'ignore',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompleteTaskInstance()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();

        $req = new \Zimbra\Mail\Request\CompleteTaskInstance(
            'id', $exceptId, $tz
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());

        $req->id('id')
            ->exceptId($exceptId)
            ->tz($tz);
        $this->assertSame('id', $req->id());
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CompleteTaskInstanceRequest id="id">'
                .'<exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</CompleteTaskInstanceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CompleteTaskInstanceRequest' => array(
                'id' => 'id',
                'exceptId' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testContactAction()
    {
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 'id', 'part'
        );
        $action = new \Zimbra\Mail\Struct\ContactActionSelector(
            ContactActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', array($a)
        );
        $req = new \Zimbra\Mail\Request\ContactAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ContactActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                    .'<a n="n" aid="aid" id="id" part="part">value</a>'
                .'</action>'
            .'</ContactActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ContactActionRequest' => array(
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
                            'id' => 'id',
                            'part' => 'part',
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testConvAction()
    {
        $action = new \Zimbra\Mail\Struct\ConvActionSelector(
            ConvActionOp::DELETE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\Mail\Request\ConvAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ConvActionRequest>'
                .'<action op="delete" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
            .'</ConvActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ConvActionRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCounterAppointment()
    {
        $m = $this->getMsg();
        $req = new \Zimbra\Mail\Request\CounterAppointment(
            $m, 'id', 10, 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(10)
            ->ms(10)
            ->rev(10);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CounterAppointmentRequest id="id" comp="10" ms="10" rev="10">'
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
            .'</CounterAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CounterAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testCalItemRequestBase()
    {
        $m = $this->getMsg();
        $req = $this->getMockForAbstractClass('\Zimbra\Mail\Request\CalItemRequestBase');
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $req->m($m)
            ->echo_(true)
            ->max(10)
            ->html(true)
            ->neuter(true)
            ->forcesend(true);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->echo_());
        $this->assertSame(10, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->forcesend());
    }

    public function testCreateAppointment()
    {
        $m = $this->getMsg();
        $req = new \Zimbra\Mail\Request\CreateAppointment(
            $m, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->echo_());
        $this->assertSame(10, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->forcesend());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateAppointmentRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
            .'</CreateAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateAppointmentRequest' => array(
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAppointmentException()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\CreateAppointmentException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(10)
            ->ms(10)
            ->rev(10);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateAppointmentExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
            .'</CreateAppointmentExceptionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateAppointmentExceptionRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateContact()
    {
        $vcard = new \Zimbra\Mail\Struct\VCardInfo(
            'value', 'mid', 'part', 'aid'
        );
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 'id', 'part'
        );
        $m = new \Zimbra\Mail\Struct\NewContactGroupMember(
            'type', 'value'
        );
        $cn = new \Zimbra\Mail\Struct\ContactSpec(
            $vcard, array($a), array($m), 10, 'l', 't', 'tn'
        );

        $req = new \Zimbra\Mail\Request\CreateContact(
            $cn, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->verbose());

        $req->cn($cn)
            ->verbose(true);
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->verbose());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateContactRequest verbose="true">'
                .'<cn id="10" l="l" t="t" tn="tn">'
                    .'<vcard mid="mid" part="part" aid="aid">value</vcard>'
                    .'<a n="n" aid="aid" id="id" part="part">value</a>'
                    .'<m type="type" value="value" />'
                .'</cn>'
            .'</CreateContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateContactRequest' => array(
                'verbose' => true,
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
                            'id' => 'id',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDataSource()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource(
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
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $req = new \Zimbra\Mail\Request\CreateDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $req->imap($imap)
            ->pop3($pop3)
            ->caldav($caldav)
            ->yab($yab)
            ->rss($rss)
            ->gal($gal)
            ->cal($cal)
            ->unknown($unknown);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDataSourceRequest>'
                .'<imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                    .'<lastError>lastError</lastError>'
                    .'<a>a</a>'
                    .'<a>b</a>'
                .'</imap>'
                .'<pop3 leaveOnServer="true" />'
                .'<caldav />'
                .'<yab />'
                .'<rss />'
                .'<gal />'
                .'<cal />'
                .'<unknown />'
            .'</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDataSourceRequest' => array(
                'imap' => array(
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
                    'a' => array('a', 'b'),
                ),
                'pop3' => array(
                    'leaveOnServer' => true,
                ),
                'caldav' => array(),
                'yab' => array(),
                'rss' => array(),
                'gal' => array(),
                'cal' => array(),
                'unknown' => array(),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateFolder()
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
        $req = new \Zimbra\Mail\Request\CreateFolder(
            $folder
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($folder, $req->folder());

        $req->folder($folder);
        $this->assertSame($folder, $req->folder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateFolderRequest>'
                .'<folder name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" sync="true">'
                    .'<acl>'
                        .'<grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                    .'</acl>'
                .'</folder>'
            .'</CreateFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateFolderRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateMountpoint()
    {
        $link = new \Zimbra\Mail\Struct\NewMountpointSpec(
            'name', SearchType::TASK(), 'f', 10, '#aabbcc', 'url', 'l', true, true, 'zid', 'owner', 10, 'path'
        );
         $req = new \Zimbra\Mail\Request\CreateMountpoint(
            $link
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($link, $req->link());

        $req->link($link);
        $this->assertSame($link, $req->link());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateMountpointRequest>'
                .'<link name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" reminder="true" zid="zid" owner="owner" rid="10" path="path" />'
            .'</CreateMountpointRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateMountpointRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateNote()
    {
        $note = new \Zimbra\Mail\Struct\NewNoteSpec(
            'l', 'content', 10, 'pos'
        );
         $req = new \Zimbra\Mail\Request\CreateNote(
            $note
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($note, $req->note());

        $req->note($note);
        $this->assertSame($note, $req->note());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateNoteRequest>'
                .'<note l="l" content="content" color="10" pos="pos" />'
            .'</CreateNoteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateNoteRequest' => array(
                'note' => array(
                    'l' => 'l',
                    'content' => 'content',
                    'color' => 10,
                    'pos' => 'pos',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSearchFolder()
    {
        $search = new \Zimbra\Mail\Struct\NewSearchFolderSpec(
            'name', 'query', 'types', 'sortBy', 'f', 10, 'l'
        );
        $req = new \Zimbra\Mail\Request\CreateSearchFolder(
            $search
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($search, $req->search());

        $req->search($search);
        $this->assertSame($search, $req->search());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateSearchFolderRequest>'
                .'<search name="name" query="query" types="types" sortBy="sortBy" f="f" color="10" l="l" />'
            .'</CreateSearchFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateSearchFolderRequest' => array(
                'search' => array(
                    'name' => 'name',
                    'query' => 'query',
                    'types' => 'types',
                    'sortBy' => 'sortBy',
                    'f' => 'f',
                    'color' => 10,
                    'l' => 'l',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTag()
    {
        $tag = new \Zimbra\Mail\Struct\TagSpec(
            'name', '#aabbcc', 10
        );
        $req = new \Zimbra\Mail\Request\CreateTag(
            $tag
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($tag, $req->tag());

        $req->tag($tag);
        $this->assertSame($tag, $req->tag());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTagRequest>'
                .'<tag name="name" rgb="#aabbcc" color="10" />'
            .'</CreateTagRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTagRequest' => array(
                'tag' => array(
                    'name' => 'name',
                    'rgb' => '#aabbcc',
                    'color' => 10,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTask()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\CreateTask(
            $m, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CreateAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTaskRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
            .'</CreateTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTaskRequest' => array(
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTaskException()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\CreateTaskException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CreateAppointmentException', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTaskExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
            .'</CreateTaskExceptionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTaskExceptionRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateWaitSet()
    {
        $a = new \Zimbra\Mail\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $add = new \Zimbra\Mail\Struct\WaitSetSpec(array($a));

        $req = new \Zimbra\Mail\Request\CreateWaitSet(
            $add, array(InterestType::FOLDERS()), true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($add, $req->add());
        $this->assertSame('f', $req->defTypes());
        $this->assertTrue($req->allAccounts());

        $req->add($add)
            ->addDefTypes(InterestType::MESSAGES())
            ->allAccounts(true);
        $this->assertSame($add, $req->add());
        $this->assertSame('f,m', $req->defTypes());
        $this->assertTrue($req->allAccounts());

        $req = new \Zimbra\Mail\Request\CreateWaitSet(
            $add, array(InterestType::FOLDERS()), true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateWaitSetRequest defTypes="f" allAccounts="true">'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f" />'
                .'</add>'
            .'</CreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateWaitSetRequest' => array(
                'defTypes' => 'f',
                'allAccounts' => true,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f',
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeclineCounterAppointment()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\DeclineCounterAppointment(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeclineCounterAppointmentRequest>'
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
            .'</DeclineCounterAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeclineCounterAppointmentRequest' => array(
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDataSource()
    {
        $imap = new \Zimbra\Mail\Struct\ImapDataSourceNameOrId('name', 'id');
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId('name', 'id');
        $caldav = new \Zimbra\Mail\Struct\CaldavDataSourceNameOrId('name', 'id');
        $yab = new \Zimbra\Mail\Struct\YabDataSourceNameOrId('name', 'id');
        $rss = new \Zimbra\Mail\Struct\RssDataSourceNameOrId('name', 'id');
        $gal = new \Zimbra\Mail\Struct\GalDataSourceNameOrId('name', 'id');
        $cal = new \Zimbra\Mail\Struct\CalDataSourceNameOrId('name', 'id');
        $unknown = new \Zimbra\Mail\Struct\UnknownDataSourceNameOrId('name', 'id');

        $req = new \Zimbra\Mail\Request\DeleteDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $req->imap($imap)
            ->pop3($pop3)
            ->caldav($caldav)
            ->yab($yab)
            ->rss($rss)
            ->gal($gal)
            ->cal($cal)
            ->unknown($unknown);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDataSourceRequest>'
                .'<imap name="name" id="id" />'
                .'<pop3 name="name" id="id" />'
                .'<caldav name="name" id="id" />'
                .'<yab name="name" id="id" />'
                .'<rss name="name" id="id" />'
                .'<gal name="name" id="id" />'
                .'<cal name="name" id="id" />'
                .'<unknown name="name" id="id" />'
            .'</DeleteDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDataSourceRequest' => array(
                'imap' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'pop3' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'caldav' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'yab' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'rss' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'gal' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'cal' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'unknown' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDevice()
    {
        $device = new \Zimbra\Struct\Id('id');
        $req = new \Zimbra\Mail\Request\DeleteDevice(
            $device
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($device, $req->device());

        $req->device($device);
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDeviceRequest>'
                .'<device id="id" />'
            .'</DeleteDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDeviceRequest' => array(
                'device' => array(
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDestroyWaitSet()
    {
        $req = new \Zimbra\Mail\Request\DestroyWaitSet(
            'waitSet'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('waitSet', $req->waitSet());

        $req->waitSet('waitSet');
        $this->assertSame('waitSet', $req->waitSet());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DestroyWaitSetRequest waitSet="waitSet" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DestroyWaitSetRequest' => array(
                'waitSet' =>'waitSet',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDiffDocument()
    {
        $doc = new \Zimbra\Mail\Struct\DiffDocumentVersionSpec('id', 3, 2);
        $req = new \Zimbra\Mail\Request\DiffDocument(
            $doc
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DiffDocumentRequest>'
                .'<doc id="id" v1="3" v2="2" />'
            .'</DiffDocumentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DiffDocumentRequest' => array(
                'doc' => array(
                    'id' => 'id',
                    'v1' => 3,
                    'v2' => 2,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDismissCalendarItemAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\DismissAppointmentAlarm('id', 10);
        $task = new \Zimbra\Mail\Struct\DismissTaskAlarm('id', 10);
        $req = new \Zimbra\Mail\Request\DismissCalendarItemAlarm(
            $appt, $task
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $req->appt($appt)
            ->task($task);
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DismissCalendarItemAlarmRequest>'
                .'<appt id="id" dismissedAt="10" />'
                .'<task id="id" dismissedAt="10" />'
            .'</DismissCalendarItemAlarmRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DismissCalendarItemAlarmRequest' => array(
                'appt' => array(
                    'id' => 'id',
                    'dismissedAt' => 10,
                ),
                'task' => array(
                    'id' => 'id',
                    'dismissedAt' => 10,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDocumentAction()
    {
        $grant = new \Zimbra\Mail\Struct\DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), 10
        );
        $action = new \Zimbra\Mail\Struct\DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, 'zid', 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\Mail\Request\DocumentAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DocumentActionRequest>'
                .'<action op="watch" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" zid="zid">'
                    .'<grant perm="r" gt="all" expiry="10" />'
                .'</action>'
            .'</DocumentActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DocumentActionRequest' => array(
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
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEmptyDumpster()
    {
        $req = new \Zimbra\Mail\Request\EmptyDumpster();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EmptyDumpsterRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EmptyDumpsterRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEnableSharedReminder()
    {
        $link = new \Zimbra\Mail\Struct\SharedReminderMount(
            'id', true
        );
        $req = new \Zimbra\Mail\Request\EnableSharedReminder(
            $link
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($link, $req->link());

        $req->link($link);
        $this->assertSame($link, $req->link());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EnableSharedReminderRequest>'
                .'<link id="id" reminder="true" />'
            .'</EnableSharedReminderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EnableSharedReminderRequest' => array(
                'link' => array(
                    'id' => 'id',
                    'reminder' => true,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExpandRecur()
    {
        $exceptId = new \Zimbra\Mail\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Mail\Struct\DurationInfo(true, 7, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Mail\Struct\RecurrenceInfo;

        $tz = $this->getTz();
        $cancel = new \Zimbra\Mail\Struct\ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, 10, 10
        );
        $comp = new \Zimbra\Mail\Struct\ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur, 10, 10
        );
        $except = new \Zimbra\Mail\Struct\ExpandedRecurrenceException(
            $exceptId, $dur, $recur, 10, 10
        );
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            10, 'id', 'name'
        );

        $req = new \Zimbra\Mail\Request\ExpandRecur(
            10, 10, array($tz), $comp, $except, $cancel
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame(array($tz), $req->tz()->all());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame($cancel, $req->cancel());

        $req->s(10)
            ->e(10)
            ->addTz($tz)
            ->comp($comp)
            ->except($except)
            ->cancel($cancel);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame(array($tz, $tz), $req->tz()->all());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame($cancel, $req->cancel());

        $req = new \Zimbra\Mail\Request\ExpandRecur(
            10, 10, array($tz), $comp, $except, $cancel
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExpandRecurRequest s="10" e="10">'
                .'<comp s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</comp>'
                .'<except s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</except>'
                .'<cancel s="10" e="10">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</cancel>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
            .'</ExpandRecurRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExpandRecurRequest' => array(
                's' => 10,
                'e' => 10,
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExportContacts()
    {
        $req = new \Zimbra\Mail\Request\ExportContacts(
            'ct', 'l', 'csvfmt', 'csvlocale', 'csvsep'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());
        $this->assertSame('csvfmt', $req->csvfmt());
        $this->assertSame('csvlocale', $req->csvlocale());
        $this->assertSame('csvsep', $req->csvsep());

        $req->ct('ct')
            ->l('l')
            ->csvfmt('csvfmt')
            ->csvlocale('csvlocale')
            ->csvsep('csvsep');
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());
        $this->assertSame('csvfmt', $req->csvfmt());
        $this->assertSame('csvlocale', $req->csvlocale());
        $this->assertSame('csvsep', $req->csvsep());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExportContactsRequest ct="ct" l="l" csvfmt="csvfmt" csvlocale="csvlocale" csvsep="csvsep" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExportContactsRequest' => array(
                'ct' => 'ct',
                'l' => 'l',
                'csvfmt' => 'csvfmt',
                'csvlocale' => 'csvlocale',
                'csvsep' => 'csvsep',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFolderAction()
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
        $req = new \Zimbra\Mail\Request\FolderAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FolderActionRequest>'
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
                .'</action>'
            .'</FolderActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FolderActionRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testForwardAppointment()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\ForwardAppointment(
            $exceptId, $tz, $m, 'id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());

        $req->exceptId($exceptId)
            ->tz($tz)
            ->m($m)
            ->id('id');
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ForwardAppointmentRequest id="id">'
                .'<exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</ForwardAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ForwardAppointmentRequest' => array(
                'id' => 'id',
                'exceptId' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testForwardAppointmentInvite()
    {
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\ForwardAppointmentInvite(
            $m, 'id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());

        $req->m($m)
            ->id('id');
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ForwardAppointmentInviteRequest id="id">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</ForwardAppointmentInviteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ForwardAppointmentInviteRequest' => array(
                'id' => 'id',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGenerateUUID()
    {
        $req = new \Zimbra\Mail\Request\GenerateUUID();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GenerateUUIDRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GenerateUUIDRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetActivityStream()
    {
        $filter = new \Zimbra\Mail\Struct\ActivityFilter(
            'account', 'op', 'session'
        );
        $req = new \Zimbra\Mail\Request\GetActivityStream(
            'id', $filter, 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($filter, $req->filter());
        $this->assertSame(10, $req->offset());
        $this->assertSame(10, $req->limit());

        $req->id('id')
            ->filter($filter)
            ->offset(10)
            ->limit(10);
        $this->assertSame($filter, $req->filter());
        $this->assertSame('id', $req->id());
        $this->assertSame($filter, $req->filter());
        $this->assertSame(10, $req->offset());
        $this->assertSame(10, $req->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetActivityStreamRequest id="id" offset="10" limit="10">'
                .'<filter account="account" op="op" session="session" />'
            .'</GetActivityStreamRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetActivityStreamRequest' => array(
                'id' => 'id',
                'offset' => 10,
                'limit' => 10,
                'filter' => array(
                    'account' => 'account',
                    'op' => 'op',
                    'session' => 'session',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDevices()
    {
        $req = new \Zimbra\Mail\Request\GetAllDevices();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllDevicesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllDevicesRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAppointment()
    {
        $req = new \Zimbra\Mail\Request\GetAppointment(
            true, true, 'icalendar-uid', 'appointment-id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertTrue($req->sync());
        $this->assertTrue($req->includeContent());
        $this->assertSame('icalendar-uid', $req->uid());
        $this->assertSame('appointment-id', $req->id());

        $req->sync(true)
            ->includeContent(true)
            ->uid('icalendar-uid')
            ->id('appointment-id');
        $this->assertTrue($req->sync());
        $this->assertTrue($req->includeContent());
        $this->assertSame('icalendar-uid', $req->uid());
        $this->assertSame('appointment-id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAppointmentRequest sync="true" includeContent="true" uid="icalendar-uid" id="appointment-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAppointmentRequest' => array(
                'sync' => true,
                'includeContent' => true,
                'uid' => 'icalendar-uid',
                'id' => 'appointment-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetApptSummaries()
    {
        $req = new \Zimbra\Mail\Request\GetApptSummaries(
            10, 10, 'folder-id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('folder-id', $req->l());

        $req->s(10)
            ->e(10)
            ->l('folder-id');
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('folder-id', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetApptSummariesRequest s="10" e="10" l="folder-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetApptSummariesRequest' => array(
                's' => 10,
                'e' => 10,
                'l' => 'folder-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarItemSummaries()
    {
        $req = new \Zimbra\Mail\Request\GetCalendarItemSummaries(
            10, 10, 'folder-id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('folder-id', $req->l());

        $req->s(10)
            ->e(10)
            ->l('folder-id');
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('folder-id', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCalendarItemSummariesRequest s="10" e="10" l="folder-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCalendarItemSummariesRequest' => array(
                's' => 10,
                'e' => 10,
                'l' => 'folder-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetComments()
    {
        $comment = new \Zimbra\Mail\Struct\ParentId(
            'item-id-of-parent'
        );
        $req = new \Zimbra\Mail\Request\GetComments(
            $comment
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($comment, $req->comment());

        $req->comment($comment);
        $this->assertSame($comment, $req->comment());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCommentsRequest>'
                .'<comment parentId="item-id-of-parent" />'
            .'</GetCommentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCommentsRequest' => array(
                'comment' => array(
                    'parentId' => 'item-id-of-parent',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetContacts()
    {
        $a = new \Zimbra\Struct\AttributeName('attribute-name');
        $ma = new \Zimbra\Struct\AttributeName('attribute-name');
        $cn = new \Zimbra\Struct\Id('id');

        $req = new \Zimbra\Mail\Request\GetContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(array($a), $req->a()->all());
        $this->assertSame(array($ma), $req->ma()->all());
        $this->assertSame(array($cn), $req->cn()->all());
        $this->assertTrue($req->sync());
        $this->assertSame('folder-id', $req->l());
        $this->assertSame('sort-by', $req->sortBy());
        $this->assertTrue($req->derefGroupMember());
        $this->assertTrue($req->returnHiddenAttrs());
        $this->assertSame(10, $req->maxMembers());

        $req->addA($a)
            ->addMa($ma)
            ->addCn($cn)
            ->sync(true)
            ->l('folder-id')
            ->sortBy('sort-by')
            ->derefGroupMember(true)
            ->returnHiddenAttrs(true)
            ->maxMembers(10);
        $this->assertSame(array($a, $a), $req->a()->all());
        $this->assertSame(array($ma, $ma), $req->ma()->all());
        $this->assertSame(array($cn, $cn), $req->cn()->all());
        $this->assertTrue($req->sync());
        $this->assertSame('folder-id', $req->l());
        $this->assertSame('sort-by', $req->sortBy());
        $this->assertTrue($req->derefGroupMember());
        $this->assertTrue($req->returnHiddenAttrs());
        $this->assertSame(10, $req->maxMembers());

        $req = new \Zimbra\Mail\Request\GetContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetContactsRequest sync="true" l="folder-id" sortBy="sort-by" derefGroupMember="true" returnHiddenAttrs="true" maxMembers="10">'
                .'<a n="attribute-name" />'
                .'<ma n="attribute-name" />'
                .'<cn id="id" />'
            .'</GetContactsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetContactsRequest' => array(
                'sync' => true,
                'l' => 'folder-id',
                'sortBy' => 'sort-by',
                'derefGroupMember' => true,
                'returnHiddenAttrs' => true,
                'maxMembers' => 10,
                'a' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
                'ma' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
                'cn' => array(
                    array(
                        'id' => 'id',
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetConv()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $c = new \Zimbra\Mail\Struct\ConversationSpec(
            'id', array($header), 'fetch', true, 10
        );
        $req = new \Zimbra\Mail\Request\GetConv(
            $c
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($c, $req->c());

        $req->c($c);
        $this->assertSame($c, $req->c());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetConvRequest>'
                .'<c id="id" fetch="fetch" html="true" max="10">'
                    .'<header n="attribute-name" />'
                .'</c>'
            .'</GetConvRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetConvRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCustomMetadata()
    {
        $meta = new \Zimbra\Mail\Struct\SectionAttr('section');
        $req = new \Zimbra\Mail\Request\GetCustomMetadata(
            'id', $meta
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($meta, $req->meta());

        $req->id('id')
            ->meta($meta);
        $this->assertSame($meta, $req->meta());
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCustomMetadataRequest id="id">'
                .'<meta section="section" />'
            .'</GetCustomMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCustomMetadataRequest' => array(
                'id' => 'id',
                'meta' => array(
                    'section' => 'section',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDataSources()
    {
        $req = new \Zimbra\Mail\Request\GetDataSources();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDataSourcesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDataSourcesRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDocumentShareURL()
    {
        $item = new \Zimbra\Mail\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );
        $req = new \Zimbra\Mail\Request\GetDocumentShareURL(
            $item
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($item, $req->item());

        $req->item($item);
        $this->assertSame($item, $req->item());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDocumentShareURLRequest>'
                .'<item id="id" l="l" name="name" path="path" />'
            .'</GetDocumentShareURLRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDocumentShareURLRequest' => array(
                'item' => array(
                    'id' => 'id',
                    'l' => 'l',
                    'name' => 'name',
                    'path' => 'path',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetEffectiveFolderPerms()
    {
        $folder = new \Zimbra\Mail\Struct\FolderSpec(
            'l'
        );
        $req = new \Zimbra\Mail\Request\GetEffectiveFolderPerms(
            $folder
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($folder, $req->folder());

        $req->folder($folder);
        $this->assertSame($folder, $req->folder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetEffectiveFolderPermsRequest>'
                .'<folder l="l" />'
            .'</GetEffectiveFolderPermsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetEffectiveFolderPermsRequest' => array(
                'folder' => array(
                    'l' => 'l',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFilterRules()
    {
        $req = new \Zimbra\Mail\Request\GetFilterRules();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFilterRulesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFilterRulesRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFolder()
    {
        $folder = new \Zimbra\Mail\Struct\GetFolderSpec(
            'uuid', 'l', 'path'
        );
        $req = new \Zimbra\Mail\Request\GetFolder(
            $folder, true, true, 'view', 10, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($folder, $req->folder());
        $this->assertTrue($req->visible());
        $this->assertTrue($req->needGranteeName());
        $this->assertSame('view', $req->view());
        $this->assertSame(10, $req->depth());
        $this->assertTrue($req->tr());

        $req->folder($folder)
            ->visible(true)
            ->needGranteeName(true)
            ->view('view')
            ->depth(10)
            ->tr(true);
        $this->assertSame($folder, $req->folder());
        $this->assertTrue($req->visible());
        $this->assertTrue($req->needGranteeName());
        $this->assertSame('view', $req->view());
        $this->assertSame(10, $req->depth());
        $this->assertTrue($req->tr());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFolderRequest visible="true" needGranteeName="true" view="view" depth="10" tr="true">'
                .'<folder uuid="uuid" l="l" path="path" />'
            .'</GetFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFolderRequest' => array(
                'visible' => true,
                'needGranteeName' => true,
                'view' => 'view',
                'depth' => 10,
                'tr' => true,
                'folder' => array(
                    'uuid' => 'uuid',
                    'l' => 'l',
                    'path' => 'path',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFreeBusy()
    {
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            10, 'id', 'name'
        );
        $req = new \Zimbra\Mail\Request\GetFreeBusy(
            10, 10, 'uid', 'id', 'name', 'excludeUid', array($usr)
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame('excludeUid', $req->excludeUid());
        $this->assertSame(array($usr), $req->usr()->all());
        $req->s(10)
            ->e(10)
            ->uid('uid')
            ->id('id')
            ->name('name')
            ->excludeUid('excludeUid')
            ->addUsr($usr);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame('excludeUid', $req->excludeUid());
        $this->assertSame(array($usr, $usr), $req->usr()->all());

        $req->usr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFreeBusyRequest s="10" e="10" uid="uid" id="id" name="name" excludeUid="excludeUid">'
                .'<usr l="10" id="id" name="name" />'
            .'</GetFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFreeBusyRequest' => array(
                's' => 10,
                'e' => 10,
                'uid' => 'uid',
                'id' => 'id',
                'name' => 'name',
                'excludeUid' => 'excludeUid',
                'usr' => array(
                    array(
                        'l' => 10,
                        'id' => 'id',
                        'name' => 'name',
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetICal()
    {
        $req = new \Zimbra\Mail\Request\GetICal(
            'id', 10, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $req->s(10)
            ->e(10)
            ->id('id');
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetICalRequest id="id" s="10" e="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetICalRequest' => array(
                'id' => 'id',
                's' => 10,
                'e' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetImportStatus()
    {
        $req = new \Zimbra\Mail\Request\GetImportStatus();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetImportStatusRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetImportStatusRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetItem()
    {
        $item = new \Zimbra\Mail\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );
        $req = new \Zimbra\Mail\Request\GetItem(
            $item
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($item, $req->item());

        $req->item($item);
        $this->assertSame($item, $req->item());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetItemRequest>'
                .'<item id="id" l="l" name="name" path="path" />'
            .'</GetItemRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetItemRequest' => array(
                'item' => array(
                    'id' => 'id',
                    'l' => 'l',
                    'name' => 'name',
                    'path' => 'path',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxMetadata()
    {
        $meta = new \Zimbra\Mail\Struct\SectionAttr('section');
        $req = new \Zimbra\Mail\Request\GetMailboxMetadata(
            $meta
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($meta, $req->meta());

        $req->meta($meta);
        $this->assertSame($meta, $req->meta());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailboxMetadataRequest>'
                .'<meta section="section" />'
            .'</GetMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailboxMetadataRequest' => array(
                'meta' => array(
                    'section' => 'section',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMiniCal()
    {
        $tz = $this->getTz();
        $folder = new \Zimbra\Struct\Id('id');

        $req = new \Zimbra\Mail\Request\GetMiniCal(
            10, 10, array($folder), $tz
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame(array($folder), $req->folder()->all());
        $this->assertSame($tz, $req->tz());

        $req->s(10)
            ->e(10)
            ->addFolder($folder)
            ->tz($tz);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame(array($folder, $folder), $req->folder()->all());
        $this->assertSame($tz, $req->tz());
        $req->folder()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMiniCalRequest s="10" e="10">'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<folder id="id" />'
            .'</GetMiniCalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMiniCalRequest' => array(
                's' => 10,
                'e' => 10,
                'folder' => array(
                    array(
                        'id' => 'id',
                    ),
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMsg()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $m = new \Zimbra\Mail\Struct\MsgSpec(
            'id', array($header), 'part', true, true, 10, true, true, 'ridZ', true
        );
        $req = new \Zimbra\Mail\Request\GetMsg(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMsgRequest>'
                .'<m id="id" part="part" raw="true" read="true" max="10" html="true" neuter="true" ridZ="ridZ" needExp="true">'
                    .'<header n="attribute-name" />'
                .'</m>'
            .'</GetMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMsgRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMsgMetadata()
    {
        $m = new \Zimbra\Mail\Struct\IdsAttr(
            'ids'
        );
        $req = new \Zimbra\Mail\Request\GetMsgMetadata(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMsgMetadataRequest>'
                .'<m ids="ids" />'
            .'</GetMsgMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMsgMetadataRequest' => array(
                'm' => array(
                    'ids' => 'ids',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetNote()
    {
        $note = new \Zimbra\Struct\Id('id');
        $req = new \Zimbra\Mail\Request\GetNote(
            $note
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($note, $req->note());

        $req->note($note);
        $this->assertSame($note, $req->note());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetNoteRequest>'
                .'<note id="id" />'
            .'</GetNoteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetNoteRequest' => array(
                'note' => array(
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetNotifications()
    {
        $req = new \Zimbra\Mail\Request\GetNotifications(
            true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertTrue($req->markSeen());

        $req->markSeen(true);
        $this->assertTrue($req->markSeen());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetNotificationsRequest markSeen="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetNotificationsRequest' => array(
                'markSeen' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetOutgoingFilterRules()
    {
        $req = new \Zimbra\Mail\Request\GetOutgoingFilterRules();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetOutgoingFilterRulesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetOutgoingFilterRulesRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetPermission()
    {
        $ace = new \Zimbra\Mail\Struct\Right('right');
        $req = new \Zimbra\Mail\Request\GetPermission(
            array($ace)
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(array($ace), $req->ace()->all());

        $req->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->ace()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetPermissionRequest>'
                .'<ace right="right" />'
                .'<ace right="right" />'
            .'</GetPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetPermissionRequest' => array(
                'ace' => array(
                    array(
                        'right' => 'right',
                    ),
                    array(
                        'right' => 'right',
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRecur()
    {
        $req = new \Zimbra\Mail\Request\GetRecur(
            'id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetRecurRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetRecurRequest' => array(
                'id' => 'id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSearchFolder()
    {
        $req = new \Zimbra\Mail\Request\GetSearchFolder();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSearchFolderRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSearchFolderRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareDetails()
    {
        $item = new \Zimbra\Struct\Id('id');
        $req = new \Zimbra\Mail\Request\GetShareDetails(
            $item
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($item, $req->item());

        $req->item($item);
        $this->assertSame($item, $req->item());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetShareDetailsRequest>'
                .'<item id="id" />'
            .'</GetShareDetailsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetShareDetailsRequest' => array(
                'item' => array(
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareNotifications()
    {
        $req = new \Zimbra\Mail\Request\GetShareNotifications();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetShareNotificationsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetShareNotificationsRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSpellDictionaries()
    {
        $req = new \Zimbra\Mail\Request\GetSpellDictionaries();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSpellDictionariesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSpellDictionariesRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSystemRetentionPolicy()
    {
        $req = new \Zimbra\Mail\Request\GetSystemRetentionPolicy();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSystemRetentionPolicyRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSystemRetentionPolicyRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTag()
    {
        $req = new \Zimbra\Mail\Request\GetTag();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTagRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTagRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTask()
    {
        $req = new \Zimbra\Mail\Request\GetTask(
            true, true, 'uid', 'id'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertTrue($req->sync());
        $this->assertTrue($req->includeContent());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());

        $req->sync(true)
            ->includeContent(true)
            ->uid('uid')
            ->id('id');
        $this->assertTrue($req->sync());
        $this->assertTrue($req->includeContent());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTaskRequest sync="true" includeContent="true" uid="uid" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTaskRequest' => array(
                'sync' => true,
                'includeContent' => true,
                'uid' => 'uid',
                'id' => 'id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTaskSummaries()
    {
        $req = new \Zimbra\Mail\Request\GetTaskSummaries(
            10, 10, 'l'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('l', $req->l());
        $req->s(10)
            ->e(10)
            ->l('l');
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('l', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTaskSummariesRequest s="10" e="10" l="l" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTaskSummariesRequest' => array(
                's' => 10,
                'e' => 10,
                'l' => 'l',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWatchers()
    {
        $req = new \Zimbra\Mail\Request\GetWatchers();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWatchersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWatchersRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWatchingItems()
    {
        $req = new \Zimbra\Mail\Request\GetWatchingItems();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWatchingItemsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWatchingItemsRequest' => array()
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWorkingHours()
    {
        $req = new \Zimbra\Mail\Request\GetWorkingHours(
            10, 10, 'id', 'name'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $req->s(10)
            ->e(10)
            ->id('id')
            ->name('name');

        $this->assertSame(10, $req->s());
        $this->assertSame(10, $req->e());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWorkingHoursRequest s="10" e="10" id="id" name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWorkingHoursRequest' => array(
                's' => 10,
                'e' => 10,
                'id' => 'id',
                'name' => 'name',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetYahooAuthToken()
    {
        $req = new \Zimbra\Mail\Request\GetYahooAuthToken(
            'user', 'password'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('user', $req->user());
        $this->assertSame('password', $req->password());
        $req->user('user')
            ->password('password');

        $this->assertSame('user', $req->user());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetYahooAuthTokenRequest user="user" password="password" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetYahooAuthTokenRequest' => array(
                'user' => 'user',
                'password' => 'password',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetYahooCookie()
    {
        $req = new \Zimbra\Mail\Request\GetYahooCookie(
            'user'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('user', $req->user());
        $req->user('user');
        $this->assertSame('user', $req->user());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetYahooCookieRequest user="user" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetYahooCookieRequest' => array(
                'user' => 'user',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGrantPermission()
    {
        $ace = new \Zimbra\Mail\Struct\AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false
        );
        $req = new \Zimbra\Mail\Request\GrantPermission(
            array($ace)
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(array($ace), $req->ace()->all());
        $req->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->ace()->all());

        $req->ace()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GrantPermissionRequest>'
                .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="false" />'
            .'</GrantPermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GrantPermissionRequest' => array(
                'ace' => array(
                    array(
                        'gt' => 'usr',
                        'right' => 'invite',
                        'zid' => 'zid',
                        'd' => 'd',
                        'key' => 'key',
                        'pw' => 'pw',
                        'deny' => false,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testICalReply()
    {
        $req = new \Zimbra\Mail\Request\ICalReply(
            'ical'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('ical', $req->ical());
        $req->ical('ical');
        $this->assertSame('ical', $req->ical());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ICalReplyRequest>'
                .'<ical>ical</ical>'
            .'</ICalReplyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ICalReplyRequest' => array(
                'ical' => 'ical',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportAppointments()
    {
        $content = new \Zimbra\Mail\Struct\ContentSpec(
            'value', 'aid', 'mid', 'part'
        );
        $req = new \Zimbra\Mail\Request\ImportAppointments(
            $content, 'ct', 'l'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($content, $req->content());
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());

        $req->content($content)
            ->ct('ct')
            ->l('l');
        $this->assertSame($content, $req->content());
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportAppointmentsRequest ct="ct" l="l">'
                .'<content aid="aid" mid="mid" part="part">value</content>'
            .'</ImportAppointmentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportAppointmentsRequest' => array(
                'ct' => 'ct',
                'l' => 'l',
                'content' => array(
                    '_' => 'value',
                    'aid' => 'aid',
                    'mid' => 'mid',
                    'part' => 'part',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportContacts()
    {
        $content = new \Zimbra\Mail\Struct\Content(
            'value', 'aid'
        );
        $req = new \Zimbra\Mail\Request\ImportContacts(
            $content, 'ct', 'l', 'csvfmt', 'csvlocale'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($content, $req->content());
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());
        $this->assertSame('csvfmt', $req->csvfmt());
        $this->assertSame('csvlocale', $req->csvlocale());

        $req->content($content)
            ->ct('ct')
            ->l('l')
            ->csvfmt('csvfmt')
            ->csvlocale('csvlocale');
        $this->assertSame($content, $req->content());
        $this->assertSame('ct', $req->ct());
        $this->assertSame('l', $req->l());
        $this->assertSame('csvfmt', $req->csvfmt());
        $this->assertSame('csvlocale', $req->csvlocale());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportContactsRequest ct="ct" l="l" csvfmt="csvfmt" csvlocale="csvlocale">'
                .'<content aid="aid">value</content>'
            .'</ImportContactsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportContactsRequest' => array(
                'ct' => 'ct',
                'l' => 'l',
                'csvfmt' => 'csvfmt',
                'csvlocale' => 'csvlocale',
                'content' => array(
                    '_' => 'value',
                    'aid' => 'aid',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testImportData()
    {
        $imap = new \Zimbra\Mail\Struct\ImapDataSourceNameOrId('name', 'id');
        $pop3 = new \Zimbra\Mail\Struct\Pop3DataSourceNameOrId('name', 'id');
        $caldav = new \Zimbra\Mail\Struct\CaldavDataSourceNameOrId('name', 'id');
        $yab = new \Zimbra\Mail\Struct\YabDataSourceNameOrId('name', 'id');
        $rss = new \Zimbra\Mail\Struct\RssDataSourceNameOrId('name', 'id');
        $gal = new \Zimbra\Mail\Struct\GalDataSourceNameOrId('name', 'id');
        $cal = new \Zimbra\Mail\Struct\CalDataSourceNameOrId('name', 'id');
        $unknown = new \Zimbra\Mail\Struct\UnknownDataSourceNameOrId('name', 'id');

        $req = new \Zimbra\Mail\Request\ImportData(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $req->imap($imap)
            ->pop3($pop3)
            ->caldav($caldav)
            ->yab($yab)
            ->rss($rss)
            ->gal($gal)
            ->cal($cal)
            ->unknown($unknown);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ImportDataRequest>'
                .'<imap name="name" id="id" />'
                .'<pop3 name="name" id="id" />'
                .'<caldav name="name" id="id" />'
                .'<yab name="name" id="id" />'
                .'<rss name="name" id="id" />'
                .'<gal name="name" id="id" />'
                .'<cal name="name" id="id" />'
                .'<unknown name="name" id="id" />'
            .'</ImportDataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ImportDataRequest' => array(
                'imap' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'pop3' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'caldav' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'yab' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'rss' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'gal' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'cal' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
                'unknown' => array(
                    'name' => 'name',
                    'id' => 'id',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testInvalidateReminderDevice()
    {
        $req = new \Zimbra\Mail\Request\InvalidateReminderDevice(
            'device-email-address'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('device-email-address', $req->a());
        $req->a('a');
        $this->assertSame('a', $req->a());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<InvalidateReminderDeviceRequest a="a" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'InvalidateReminderDeviceRequest' => array(
                'a' => 'a',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testItemActionOp()
    {
        $action = new \Zimbra\Mail\Struct\ItemActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\Mail\Request\ItemAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ItemActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
            .'</ItemActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ItemActionRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testListDocumentRevisions()
    {
        $doc = new \Zimbra\Mail\Struct\ListDocumentRevisionsSpec(
            'id', 10, 10
        );
        $req = new \Zimbra\Mail\Request\ListDocumentRevisions(
            $doc
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ListDocumentRevisionsRequest>'
                .'<doc id="id" ver="10" count="10" />'
            .'</ListDocumentRevisionsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ListDocumentRevisionsRequest' => array(
                'doc' => array(
                    'id' => 'id',
                    'ver' => 10,
                    'count' => 10,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailSearchParams()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $tz = $this->getTz();
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\Mail\Request\MailSearchParams(
            'query',
            array($header),
            $tz,
            'locale',
            $cursor,
            true,
            true,
            'allowableTaskStatus',
            10,
            10,
            true,
            'types',
            'groupBy',
            true,
            SortBy::DATE_DESC(),
            'fetch',
            true,
            10,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            10,
            10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('query', $req->query());
        $this->assertSame(array($header), $req->header()->all());
        $this->assertSame($tz, $req->tz());
        $this->assertSame('locale', $req->locale());
        $this->assertSame($cursor, $req->cursor());
        $this->assertTrue($req->includeTagDeleted());
        $this->assertTrue($req->includeTagMuted());
        $this->assertSame('allowableTaskStatus', $req->allowableTaskStatus());
        $this->assertSame(10, $req->calExpandInstStart());
        $this->assertSame(10, $req->calExpandInstEnd());
        $this->assertTrue($req->inDumpster());
        $this->assertSame('types', $req->types());
        $this->assertSame('groupBy', $req->groupBy());
        $this->assertTrue($req->quick());
        $this->assertTrue($req->sortBy()->is('dateDesc'));
        $this->assertSame('fetch', $req->fetch());
        $this->assertTrue($req->read());
        $this->assertSame(10, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->needExp());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->recip());
        $this->assertTrue($req->prefetch());
        $this->assertSame('resultMode', $req->resultMode());
        $this->assertSame('field', $req->field());
        $this->assertSame(10, $req->limit());
        $this->assertSame(10, $req->offset());

        $req->query('query')
            ->addHeader($header)
            ->tz($tz)
            ->locale('locale')
            ->cursor($cursor)
            ->includeTagDeleted(true)
            ->includeTagMuted(true)
            ->allowableTaskStatus('allowableTaskStatus')
            ->calExpandInstStart(10)
            ->calExpandInstEnd(10)
            ->inDumpster(true)
            ->types('types')
            ->groupBy('groupBy')
            ->quick(true)
            ->sortBy(SortBy::DATE_DESC())
            ->fetch('fetch')
            ->read(true)
            ->max(10)
            ->html(true)
            ->needExp(true)
            ->neuter(true)
            ->recip(true)
            ->prefetch(true)
            ->resultMode('resultMode')
            ->field('field')
            ->limit(10)
            ->offset(10);
        $this->assertSame('query', $req->query());
        $this->assertSame(array($header, $header), $req->header()->all());
        $this->assertSame($tz, $req->tz());
        $this->assertSame('locale', $req->locale());
        $this->assertSame($cursor, $req->cursor());
        $this->assertTrue($req->includeTagDeleted());
        $this->assertTrue($req->includeTagMuted());
        $this->assertSame('allowableTaskStatus', $req->allowableTaskStatus());
        $this->assertSame(10, $req->calExpandInstStart());
        $this->assertSame(10, $req->calExpandInstEnd());
        $this->assertTrue($req->inDumpster());
        $this->assertSame('types', $req->types());
        $this->assertSame('groupBy', $req->groupBy());
        $this->assertTrue($req->quick());
        $this->assertTrue($req->sortBy()->is('dateDesc'));
        $this->assertSame('fetch', $req->fetch());
        $this->assertTrue($req->read());
        $this->assertSame(10, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->needExp());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->recip());
        $this->assertTrue($req->prefetch());
        $this->assertSame('resultMode', $req->resultMode());
        $this->assertSame('field', $req->field());
        $this->assertSame(10, $req->limit());
        $this->assertSame(10, $req->offset());

        $req->header()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<MailSearchParamsRequest includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="10" calExpandInstEnd="10" inDumpster="true" types="types" groupBy="groupBy" quick="true" sortBy="dateDesc" fetch="fetch" read="true" max="10" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="resultMode" field="field" limit="10" offset="10">'
                .'<query>query</query>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                .'<header n="attribute-name" />'
            .'</MailSearchParamsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MailSearchParamsRequest' => array(
                'query' => 'query',
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => true,
                ),
                'includeTagDeleted' => true,
                'includeTagMuted' => true,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 10,
                'calExpandInstEnd' => 10,
                'inDumpster' => true,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => true,
                'sortBy' => 'dateDesc',
                'fetch' => 'fetch',
                'read' => true,
                'max' => 10,
                'html' => true,
                'needExp' => true,
                'neuter' => true,
                'recip' => true,
                'prefetch' => true,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 10,
                'offset' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAppointment()
    {
        $m = $this->getMsg();
        $req = new \Zimbra\Mail\Request\ModifyAppointment(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(10)
            ->ms(10)
            ->rev(10);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->comp());
        $this->assertSame(10, $req->ms());
        $this->assertSame(10, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyAppointmentRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</ModifyAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyContact()
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

        $req = new \Zimbra\Mail\Request\ModifyContact(
            $cn, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->replace());
        $this->assertTrue($req->verbose());

        $req->cn($cn)
            ->replace(true)
            ->verbose(true);
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->replace());
        $this->assertTrue($req->verbose());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyContactRequest replace="true" verbose="true">'
                .'<cn id="10" tn="tn">'
                    .'<a n="n" aid="aid" id="10" part="part" op="op">value</a>'
                    .'<m type="C" value="value" op="reset" />'
                .'</cn>'
            .'</ModifyContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyContactRequest' => array(
                'replace' => true,
                'verbose' => true,
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDataSource()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource(
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
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $req = new \Zimbra\Mail\Request\ModifyDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $req->imap($imap)
            ->pop3($pop3)
            ->caldav($caldav)
            ->yab($yab)
            ->rss($rss)
            ->gal($gal)
            ->cal($cal)
            ->unknown($unknown);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDataSourceRequest>'
                .'<imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                    .'<lastError>lastError</lastError>'
                    .'<a>a</a>'
                    .'<a>b</a>'
                .'</imap>'
                .'<pop3 leaveOnServer="true" />'
                .'<caldav />'
                .'<yab />'
                .'<rss />'
                .'<gal />'
                .'<cal />'
                .'<unknown />'
            .'</ModifyDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDataSourceRequest' => array(
                'imap' => array(
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
                    'a' => array('a', 'b'),
                ),
                'pop3' => array(
                    'leaveOnServer' => true,
                ),
                'caldav' => array(),
                'yab' => array(),
                'rss' => array(),
                'gal' => array(),
                'cal' => array(),
                'unknown' => array(),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyFilterRules()
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

        $req = new \Zimbra\Mail\Request\ModifyFilterRules(
            $filterRules
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($filterRules, $req->filterRules());

        $req->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyFilterRulesRequest>'
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
                .'</filterRules>'
            .'</ModifyFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyFilterRulesRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyMailboxMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));
        $req = new \Zimbra\Mail\Request\ModifyMailboxMetadata(
            $meta
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($meta, $req->meta());

        $req->meta($meta);
        $this->assertSame($meta, $req->meta());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyMailboxMetadataRequest>'
                .'<meta section="section">'
                    .'<a n="key">value</a>'
                .'</meta>'
            .'</ModifyMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyMailboxMetadataRequest' => array(
                'meta' => array(
                    'a' => array(
                        array('n' => 'key', '_' => 'value')
                    ),
                    'section' => 'section',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyOutgoingFilterRules()
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

        $req = new \Zimbra\Mail\Request\ModifyOutgoingFilterRules(
            $filterRules
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($filterRules, $req->filterRules());

        $req->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyOutgoingFilterRulesRequest>'
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
                .'</filterRules>'
            .'</ModifyOutgoingFilterRulesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyOutgoingFilterRulesRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySearchFolder()
    {
        $search = new \Zimbra\Mail\Struct\ModifySearchFolderSpec(
            'id', 'query', 'types', 'sortBy'
        );
        $req = new \Zimbra\Mail\Request\ModifySearchFolder(
            $search
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($search, $req->search());

        $req->search($search);
        $this->assertSame($search, $req->search());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifySearchFolderRequest>'
                .'<search id="id" query="query" types="types" sortBy="sortBy" />'
            .'</ModifySearchFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifySearchFolderRequest' => array(
                'search' => array(
                    'id' => 'id',
                    'query' => 'query',
                    'types' => 'types',
                    'sortBy' => 'sortBy',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyTask()
    {
        $m = $this->getMsg();
        $req = new \Zimbra\Mail\Request\ModifyTask(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\ModifyAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyTaskRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</ModifyTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyTaskRequest' => array(
                'id' => 'id',
                'comp' => 10,
                'ms' => 10,
                'rev' => 10,
                'echo' => true,
                'max' => 10,
                'html' => true,
                'neuter' => true,
                'forcesend' => true,
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
        $this->assertEquals($array, $req->toArray());
    }

    public function testMsgAction()
    {
        $action = new \Zimbra\Mail\Struct\MsgActionSelector(
            MsgActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\Mail\Request\MsgAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MsgActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
            .'</MsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MsgActionRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoOp()
    {
        $req = new \Zimbra\Mail\Request\NoOp(
            true, true, true, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertTrue($req->wait());
        $this->assertTrue($req->delegate());
        $this->assertTrue($req->limitToOneBlocked());
        $this->assertSame(10, $req->timeout());

        $req->wait(true)
            ->delegate(true)
            ->limitToOneBlocked(true)
            ->timeout(10);
        $this->assertTrue($req->wait());
        $this->assertTrue($req->delegate());
        $this->assertTrue($req->limitToOneBlocked());
        $this->assertSame(10, $req->timeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoOpRequest wait="true" delegate="true" limitToOneBlocked="true" timeout="10" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoOpRequest' => array(
                'wait' => true,
                'delegate' => true,
                'limitToOneBlocked' => true,
                'timeout' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoteAction()
    {
        $action = new \Zimbra\Mail\Struct\NoteActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', 'content', 'pos'
        );
        $req = new \Zimbra\Mail\Request\NoteAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoteActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" content="content" pos="pos" />'
            .'</NoteActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoteActionRequest' => array(
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeRevision()
    {
        $revision = new \Zimbra\Mail\Struct\PurgeRevisionSpec(
            'id', 10, true
        );
        $req = new \Zimbra\Mail\Request\PurgeRevision(
            $revision
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($revision, $req->revision());

        $req->revision($revision);
        $this->assertSame($revision, $req->revision());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeRevisionRequest>'
                .'<revision id="id" ver="10" includeOlderRevisions="true" />'
            .'</PurgeRevisionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeRevisionRequest' => array(
                'revision' => array(
                    'id' => 'id',
                    'ver' => 10,
                    'includeOlderRevisions' => true,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRankingAction()
    {
        $action = new \Zimbra\Mail\Struct\RankingActionSpec(
            RankingActionOp::RESET(), 'email'
        );
        $req = new \Zimbra\Mail\Request\RankingAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RankingActionRequest>'
                .'<action op="reset" email="email" />'
            .'</RankingActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RankingActionRequest' => array(
                'action' => array(
                    'op' => 'reset',
                    'email' => 'email',
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRegisterDevice()
    {
        $device = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Mail\Request\RegisterDevice(
            $device
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($device, $req->device());

        $req->device($device);
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RegisterDeviceRequest>'
                .'<device name="name" />'
            .'</RegisterDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RegisterDeviceRequest' => array(
                'device' => array(
                    'name' => 'name',
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAttachments()
    {
        $m = new \Zimbra\Mail\Struct\MsgPartIds(
            'id', 'part'
        );
        $req = new \Zimbra\Mail\Request\RemoveAttachments(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveAttachmentsRequest>'
                .'<m id="id" part="part" />'
            .'</RemoveAttachmentsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveAttachmentsRequest' => array(
                'm' => array(
                    'id' => 'id',
                    'part' => 'part',
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRevokePermission()
    {
        $ace = new \Zimbra\Mail\Struct\AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false
        );
        $req = new \Zimbra\Mail\Request\RevokePermission(
            array($ace)
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame(array($ace), $req->ace()->all());
        $req->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->ace()->all());

        $req->ace()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<RevokePermissionRequest>'
                .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="false" />'
            .'</RevokePermissionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RevokePermissionRequest' => array(
                'ace' => array(
                    array(
                        'gt' => 'usr',
                        'right' => 'invite',
                        'zid' => 'zid',
                        'd' => 'd',
                        'key' => 'key',
                        'pw' => 'pw',
                        'deny' => false,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDocument()
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

        $req = new \Zimbra\Mail\Request\SaveDocument(
            $doc
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDocumentRequest>'
                .'<doc name="name" ct="ct" desc="desc" l="l" id="id" ver="10" content="content" descEnabled="true" f="f">'
                    .'<upload id="id" />'
                    .'<m id="id" part="part" />'
                    .'<doc id="id" ver="10" />'
                .'</doc>'
            .'</SaveDocumentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SaveDocumentRequest' => array(
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
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDraft()
    {
        $m = new \Zimbra\Mail\Struct\SaveDraftMsg(
        );
        $req = new \Zimbra\Mail\Request\SaveDraft(
            $m
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDraftRequest>'
                .'<m />'
            .'</SaveDraftRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SaveDraftRequest' => array(
                'm' => array(),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearch()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $tz = $this->getTz();
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\Mail\Request\Search(
            true,
            'query',
            array($header),
            $tz,
            'locale',
            $cursor,
            true,
            true,
            'allowableTaskStatus',
            10,
            10,
            true,
            'types',
            'groupBy',
            true,
            SortBy::DATE_DESC(),
            'fetch',
            true,
            10,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            10,
            10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\MailSearchParams', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $this->assertTrue($req->warmup());
        $req->warmup(true);
        $this->assertTrue($req->warmup());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchRequest warmup="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="10" calExpandInstEnd="10" inDumpster="true" types="types" groupBy="groupBy" quick="true" sortBy="dateDesc" fetch="fetch" read="true" max="10" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="resultMode" field="field" limit="10" offset="10">'
                .'<query>query</query>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                .'<header n="attribute-name" />'
            .'</SearchRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchRequest' => array(
                'query' => 'query',
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => true,
                ),
                'warmup' => true,
                'includeTagDeleted' => true,
                'includeTagMuted' => true,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 10,
                'calExpandInstEnd' => 10,
                'inDumpster' => true,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => true,
                'sortBy' => 'dateDesc',
                'fetch' => 'fetch',
                'read' => true,
                'max' => 10,
                'html' => true,
                'needExp' => true,
                'neuter' => true,
                'recip' => true,
                'prefetch' => true,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 10,
                'offset' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchConv()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $tz = $this->getTz();
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\Mail\Request\SearchConv(
            'cid',
            true,
            'query',
            array($header),
            $tz,
            'locale',
            $cursor,
            true,
            true,
            'allowableTaskStatus',
            10,
            10,
            true,
            'types',
            'groupBy',
            true,
            SortBy::DATE_ASC(),
            'fetch',
            true,
            10,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            10,
            10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\MailSearchParams', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);

        $this->assertSame('cid', $req->cid());
        $this->assertTrue($req->nest());
        $req->cid('cid')
            ->nest(true);
        $this->assertSame('cid', $req->cid());
        $this->assertTrue($req->nest());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchConvRequest includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="10" calExpandInstEnd="10" inDumpster="true" types="types" groupBy="groupBy" quick="true" sortBy="dateAsc" fetch="fetch" read="true" max="10" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="resultMode" field="field" limit="10" offset="10" cid="cid" nest="true">'
                .'<query>query</query>'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                .'<header n="attribute-name" />'
            .'</SearchConvRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchConvRequest' => array(
                'query' => 'query',
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => true,
                ),
                'cid' => 'cid',
                'nest' => true,
                'includeTagDeleted' => true,
                'includeTagMuted' => true,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 10,
                'calExpandInstEnd' => 10,
                'inDumpster' => true,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => true,
                'sortBy' => 'dateAsc',
                'fetch' => 'fetch',
                'read' => true,
                'max' => 10,
                'html' => true,
                'needExp' => true,
                'neuter' => true,
                'recip' => true,
                'prefetch' => true,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 10,
                'offset' => 10,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendDeliveryReport()
    {
        $req = new \Zimbra\Mail\Request\SendDeliveryReport(
            'mid'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('mid', $req->mid());

        $req->mid('mid');
        $this->assertSame('mid', $req->mid());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendDeliveryReportRequest mid="mid" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendDeliveryReportRequest' => array(
                'mid' => 'mid',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendInviteReply()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();
        $m = $this->getMsg();

        $req = new \Zimbra\Mail\Request\SendInviteReply(
            'id', 10, 'verb', $exceptId, $tz, $m, true, 'idnt'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->compNum());
        $this->assertSame('verb', $req->verb());
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->updateOrganizer());
        $this->assertSame('idnt', $req->idnt());

        $req->id('id')
            ->compNum(10)
            ->verb('verb')
            ->exceptId($exceptId)
            ->tz($tz)
            ->m($m)
            ->updateOrganizer(true)
            ->idnt('idnt');
        $this->assertSame('id', $req->id());
        $this->assertSame(10, $req->compNum());
        $this->assertSame('verb', $req->verb());
        $this->assertSame($exceptId, $req->exceptId());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->updateOrganizer());
        $this->assertSame('idnt', $req->idnt());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendInviteReplyRequest id="id" compNum="10" verb="verb" updateOrganizer="true" idnt="idnt">'
                .'<exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                .'<tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                    .'<standard mon="12" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="10" />'
                .'</tz>'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</SendInviteReplyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendInviteReplyRequest' => array(
                'id' => 'id',
                'compNum' => 10,
                'verb' => 'verb',
                'updateOrganizer' => true,
                'idnt' => 'idnt',
                'exceptId' => array(
                    'd' => '20120315T18302305Z',
                    'tz' => 'tz',
                    'u' => 1000,
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendMsg()
    {
        $mp = new \Zimbra\Mail\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Mail\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Mail\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Mail\Struct\DocAttachSpec('path', 'id', 10, true);
        $info = new \Zimbra\Mail\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');

        $header = new \Zimbra\Mail\Struct\Header('name', 'value');
        $attach = new \Zimbra\Mail\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
        $mp = new \Zimbra\Mail\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Mail\Struct\InvitationInfo('method', 10, true);
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = $this->getTz();
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
        $req = new \Zimbra\Mail\Request\SendMsg(
            $m, true, true, true, 'suid'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->needCalendarSentByFixup());
        $this->assertTrue($req->isCalendarForward());
        $this->assertTrue($req->noSave());
        $this->assertSame('suid', $req->suid());

        $req->m($m)
            ->needCalendarSentByFixup(true)
            ->isCalendarForward(true)
            ->noSave(true)
            ->suid('suid');
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->needCalendarSentByFixup());
        $this->assertTrue($req->isCalendarForward());
        $this->assertTrue($req->noSave());
        $this->assertSame('suid', $req->suid());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendMsgRequest needCalendarSentByFixup="true" isCalendarForward="true" noSave="true" suid="suid">'
                .'<m did="did" sfd="true" aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<attach aid="aid">'
                            .'<mp optional="true" mid="mid" part="part" />'
                            .'<m optional="false" id="id" />'
                            .'<cn id="id" optional="false" />'
                            .'<doc optional="true" path="path" id="id" ver="10" />'
                        .'</attach>'
                        .'<mp ct="ct" content="content" ci="ci" />'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp optional="true" mid="mid" part="part" />'
                        .'<m optional="false" id="id" />'
                        .'<cn id="id" optional="false" />'
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
            .'</SendMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendMsgRequest' => array(
                'needCalendarSentByFixup' => true,
                'isCalendarForward' => true,
                'noSave' => true,
                'suid' => 'suid',
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendShareNotification()
    {
        $item = new \Zimbra\Struct\Id('id');
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');

        $req = new \Zimbra\Mail\Request\SendShareNotification(
            $item, array($e), 'notes', Action::EDIT()
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($item, $req->item());
        $this->assertSame(array($e), $req->e()->all());
        $this->assertSame('notes', $req->notes());
        $this->assertTrue($req->action()->is('edit'));

        $req->item($item)
            ->addE($e)
            ->notes('notes')
            ->action(Action::EDIT());
        $this->assertSame($item, $req->item());
        $this->assertSame(array($e, $e), $req->e()->all());
        $this->assertSame('notes', $req->notes());
        $this->assertTrue($req->action()->is('edit'));

        $req->e()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendShareNotificationRequest action="edit">'
                .'<item id="id" />'
                .'<notes>notes</notes>'
                .'<e a="a" t="t" p="p" />'
            .'</SendShareNotificationRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendShareNotificationRequest' => array(
                'notes' => 'notes',
                'action' => 'edit',
                'item' => array('id' => 'id'),
                'e' => array(
                    array(
                        'a' => 'a',
                        't' => 't',
                        'p' => 'p',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendVerificationCode()
    {
        $req = new \Zimbra\Mail\Request\SendVerificationCode(
            'a'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('a', $req->a());

        $req->a('a');
        $this->assertSame('a', $req->a());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SendVerificationCodeRequest a="a" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SendVerificationCodeRequest' => array(
                'a' => 'a',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetAppointment()
    {
        $m = $this->getMsg();
        $default = new \Zimbra\Mail\Struct\SetCalendarItemInfo(
            $m, ParticipationStatus::NE()
        );
        $except = new \Zimbra\Mail\Struct\SetCalendarItemInfo();
        $cancel = new \Zimbra\Mail\Struct\SetCalendarItemInfo();

        $reply = new \Zimbra\Mail\Struct\CalReply(
            'at', 10, 10, 10, '991231', 'sentBy', ParticipationStatus::NE(), 'tz', '991231000000'
        );
        $replies = new \Zimbra\Mail\Struct\Replies(
            array($reply)
        );

        $req = new \Zimbra\Mail\Request\SetAppointment(
            $default, array($except), array($cancel), $replies, 'f', 't', 'tn', 'l', true, 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($default, $req->default_());
        $this->assertSame(array($except), $req->except()->all());
        $this->assertSame(array($cancel), $req->cancel()->all());
        $this->assertSame($replies, $req->replies());
        $this->assertSame('f', $req->f());
        $this->assertSame('t', $req->t());
        $this->assertSame('tn', $req->tn());
        $this->assertSame('l', $req->l());
        $this->assertTrue($req->noNextAlarm());
        $this->assertSame(10, $req->nextAlarm());

        $req->default_($default)
            ->addExcept($except)
            ->addCancel($cancel)
            ->replies($replies)
            ->f('f')
            ->t('t')
            ->tn('tn')
            ->l('l')
            ->noNextAlarm(true)
            ->nextAlarm(10);
        $this->assertSame($default, $req->default_());
        $this->assertSame(array($except, $except), $req->except()->all());
        $this->assertSame(array($cancel, $cancel), $req->cancel()->all());
        $this->assertSame($replies, $req->replies());
        $this->assertSame('f', $req->f());
        $this->assertSame('t', $req->t());
        $this->assertSame('tn', $req->tn());
        $this->assertSame('l', $req->l());
        $this->assertTrue($req->noNextAlarm());
        $this->assertSame(10, $req->nextAlarm());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetAppointmentRequest f="f" t="t" tn="tn" l="l" noNextAlarm="true" nextAlarm="10">'
                .'<default ptst="NE">'
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
                .'</default>'
                .'<replies>'
                    .'<reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                .'</replies>'
                .'<except /><except />'
                .'<cancel /><cancel />'
            .'</SetAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetAppointmentRequest' => array(
                'f' => 'f',
                't' => 't',
                'tn' => 'tn',
                'l' => 'l',
                'noNextAlarm' => true,
                'nextAlarm' => 10,
                'default' => array(
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
                'except' => array(
                    array(),
                    array(),
                ),
                'cancel' => array(
                    array(),
                    array(),
                ),
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
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetCustomMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));
        $req = new \Zimbra\Mail\Request\SetCustomMetadata(
            'id', $meta
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($meta, $req->meta());

        $req->id('id')
            ->meta($meta);
        $this->assertSame('id', $req->id());
        $this->assertSame($meta, $req->meta());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetCustomMetadataRequest id="id">'
                .'<meta section="section">'
                    .'<a n="key">value</a>'
                .'</meta>'
            .'</SetCustomMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetCustomMetadataRequest' => array(
                'id' => 'id',
                'meta' => array(
                    'a' => array(
                        array('n' => 'key', '_' => 'value')
                    ),
                    'section' => 'section',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetMailboxMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));
        $req = new \Zimbra\Mail\Request\SetMailboxMetadata(
            $meta
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($meta, $req->meta());

        $req->meta($meta);
        $this->assertSame($meta, $req->meta());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetMailboxMetadataRequest>'
                .'<meta section="section">'
                    .'<a n="key">value</a>'
                .'</meta>'
            .'</SetMailboxMetadataRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetMailboxMetadataRequest' => array(
                'meta' => array(
                    'a' => array(
                        array('n' => 'key', '_' => 'value')
                    ),
                    'section' => 'section',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetTask()
    {
        $req = new \Zimbra\Mail\Request\SetTask();
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertInstanceOf('Zimbra\Mail\Request\SetAppointment', $req);
    }

    public function testSnoozeCalendarItemAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\SnoozeAppointmentAlarm('id', 10);
        $task = new \Zimbra\Mail\Struct\SnoozeTaskAlarm('id', 10);
        $req = new \Zimbra\Mail\Request\SnoozeCalendarItemAlarm(
            $appt, $task
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $req->appt($appt)
            ->task($task);
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SnoozeCalendarItemAlarmRequest>'
                .'<appt id="id" until="10" />'
                .'<task id="id" until="10" />'
            .'</SnoozeCalendarItemAlarmRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SnoozeCalendarItemAlarmRequest' => array(
                'appt' => array(
                    'id' => 'id',
                    'until' => 10,
                ),
                'task' => array(
                    'id' => 'id',
                    'until' => 10,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSync()
    {
        $req = new \Zimbra\Mail\Request\Sync(
            'token', 10, 'l', true
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('token', $req->token());
        $this->assertSame(10, $req->calCutoff());
        $this->assertSame('l', $req->l());
        $this->assertTrue($req->typed());

        $req->token('token')
            ->calCutoff(10)
            ->l('l')
            ->typed(true);
        $this->assertSame('token', $req->token());
        $this->assertSame(10, $req->calCutoff());
        $this->assertSame('l', $req->l());
        $this->assertTrue($req->typed());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SyncRequest token="token" calCutoff="10" l="l" typed="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SyncRequest' => array(
                'token' => 'token',
                'calCutoff' => 10,
                'l' => 'l',
                'typed' => true,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testTagAction()
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
        $req = new \Zimbra\Mail\Request\TagAction(
            $action
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<TagActionRequest>'
                .'<action op="read" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                    .'<retentionPolicy>'
                        .'<keep>'
                            .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
                        .'</keep>'
                        .'<purge>'
                            .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
                        .'</purge>'
                    .'</retentionPolicy>'
                .'</action>'
            .'</TagActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'TagActionRequest' => array(
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
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testTestDataSource()
    {
        $imap = new \Zimbra\Mail\Struct\MailImapDataSource(
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
        $pop3 = new \Zimbra\Mail\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Mail\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Mail\Struct\MailYabDataSource();
        $rss = new \Zimbra\Mail\Struct\MailRssDataSource();
        $gal = new \Zimbra\Mail\Struct\MailGalDataSource();
        $cal = new \Zimbra\Mail\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Mail\Struct\MailUnknownDataSource();

        $req = new \Zimbra\Mail\Request\TestDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $req->imap($imap)
            ->pop3($pop3)
            ->caldav($caldav)
            ->yab($yab)
            ->rss($rss)
            ->gal($gal)
            ->cal($cal)
            ->unknown($unknown);
        $this->assertSame($imap, $req->imap());
        $this->assertSame($pop3, $req->pop3());
        $this->assertSame($caldav, $req->caldav());
        $this->assertSame($yab, $req->yab());
        $this->assertSame($rss, $req->rss());
        $this->assertSame($gal, $req->gal());
        $this->assertSame($cal, $req->cal());
        $this->assertSame($unknown, $req->unknown());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<TestDataSourceRequest>'
                .'<imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                    .'<lastError>lastError</lastError>'
                    .'<a>a</a>'
                    .'<a>b</a>'
                .'</imap>'
                .'<pop3 leaveOnServer="true" />'
                .'<caldav />'
                .'<yab />'
                .'<rss />'
                .'<gal />'
                .'<cal />'
                .'<unknown />'
            .'</TestDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'TestDataSourceRequest' => array(
                'imap' => array(
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
                    'a' => array('a', 'b'),
                ),
                'pop3' => array(
                    'leaveOnServer' => true,
                ),
                'caldav' => array(),
                'yab' => array(),
                'rss' => array(),
                'gal' => array(),
                'cal' => array(),
                'unknown' => array(),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdateDeviceStatus()
    {
        $device = new \Zimbra\Mail\Struct\IdStatus('id', 'status');
        $req = new \Zimbra\Mail\Request\UpdateDeviceStatus(
            $device
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame($device, $req->device());

        $req->device($device);
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UpdateDeviceStatusRequest>'
                .'<device id="id" status="status" />'
            .'</UpdateDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UpdateDeviceStatusRequest' => array(
                'device' => array(
                    'id' => 'id',
                    'status' => 'status',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyCode()
    {
        $req = new \Zimbra\Mail\Request\VerifyCode(
            'a', 'code'
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('a', $req->a());
        $this->assertSame('code', $req->code());

        $req->a('a')
            ->code('code');
        $this->assertSame('a', $req->a());
        $this->assertSame('code', $req->code());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VerifyCodeRequest a="a" code="code" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VerifyCodeRequest' => array(
                'a' => 'a',
                'code' => 'code',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testWaitSet()
    {
        $id = new \Zimbra\Struct\Id('id');
        $waitSet = new \Zimbra\Mail\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $add = new \Zimbra\Mail\Struct\WaitSetSpec(array($waitSet));
        $update = new \Zimbra\Mail\Struct\WaitSetSpec(array($waitSet));
        $remove = new \Zimbra\Mail\Struct\WaitSetId(array($id));

        $req = new \Zimbra\Mail\Request\WaitSet(
            'waitSet', 'seq', $add, $update, $remove, true, array(InterestType::FOLDERS()), 10
        );
        $this->assertInstanceOf('Zimbra\Mail\Request\Base', $req);
        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertSame($add, $req->add());
        $this->assertSame($update, $req->update());
        $this->assertSame($remove, $req->remove());
        $this->assertTrue($req->block());
        $this->assertSame('f', $req->defTypes());
        $this->assertSame(10, $req->timeout());

        $req->waitSet('waitSet')
            ->seq('seq')
            ->add($add)
            ->update($update)
            ->remove($remove)
            ->block(true)
            ->addDefTypes(InterestType::MESSAGES())
            ->timeout(10);
        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertSame($add, $req->add());
        $this->assertSame($update, $req->update());
        $this->assertSame($remove, $req->remove());
        $this->assertTrue($req->block());
        $this->assertSame('f,m', $req->defTypes());
        $this->assertSame(10, $req->timeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<WaitSetRequest waitSet="waitSet" seq="seq" block="true" defTypes="f,m" timeout="10">'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f" />'
                .'</add>'
                .'<update>'
                    .'<a name="name" id="id" token="token" types="f" />'
                .'</update>'
                .'<remove>'
                    .'<a id="id" />'
                .'</remove>'
            .'</WaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'WaitSetRequest' => array(
                'waitSet' => 'waitSet',
                'seq' => 'seq',
                'block' => true,
                'defTypes' => 'f,m',
                'timeout' => 10,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f',
                        ),
                    ),
                ),
                'update' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f',
                        ),
                    ),
                ),
                'remove' => array(
                    'a' => array(
                        array(
                            'id' => 'id',
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }
}
