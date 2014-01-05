<?php

namespace Zimbra\Tests\API;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\AceRightType;
use Zimbra\Soap\Enum\BrowseBy;
use Zimbra\Soap\Enum\ContactAction;
use Zimbra\Soap\Enum\ConvAction;
use Zimbra\Soap\Enum\DocumentAction;
use Zimbra\Soap\Enum\DocumentGrantType;
use Zimbra\Soap\Enum\DocumentPermission;
use Zimbra\Soap\Enum\FilterCondition;
use Zimbra\Soap\Enum\FolderAction;
use Zimbra\Soap\Enum\GalSearchType;
use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\Importance;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Soap\Enum\ItemAction;
use Zimbra\Soap\Enum\MdsConnectionType;
use Zimbra\Soap\Enum\MsgAction;
use Zimbra\Soap\Enum\ParticipationStatus;
use Zimbra\Soap\Enum\RankingActionOp;
use Zimbra\Soap\Enum\SearchType;
use Zimbra\Soap\Enum\TargetType;
use Zimbra\Soap\Enum\Type;

/**
 * Testcase class for account api soap request.
 */
class MailRequestTest extends ZimbraTestCase
{
    public function testAddAppointmentInvite()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\AddAppointmentInvite(
            ParticipationStatus::NE(), $m
        );
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $req->ptst(ParticipationStatus::NE())
            ->m($m);
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddAppointmentInviteRequest ptst="NE">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddComment()
    {
        $comment = new \Zimbra\Soap\Struct\AddedComment('parentId', 'text');
        $req = new \Zimbra\API\Mail\Request\AddComment(
            $comment
        );
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
        $m = new \Zimbra\Soap\Struct\AddMsgSpec(
            'content', 'f', 't', 'tn', 'l', true, 'd', 'aid'
        );
        $req = new \Zimbra\API\Mail\Request\AddMsg(
            $m, true
        );
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->filterSent());

        $req->m($m)
            ->filterSent(true);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->filterSent());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddMsgRequest filterSent="1">'
                .'<m f="f" t="t" tn="tn" l="l" noICal="1" d="d" aid="aid">'
                    .'<content>content</content>'
                .'</m>'
            .'</AddMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddMsgRequest' => array(
                'filterSent' => 1,
                'm' => array(
                    'content' => 'content',
                    'f' => 'f',
                    't' => 't',
                    'tn' => 'tn',
                    'l' => 'l',
                    'noICal' => 1,
                    'd' => 'd',
                    'aid' => 'aid',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddTaskInvite()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\AddTaskInvite(
            ParticipationStatus::NE(), $m
        );
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $req->ptst(ParticipationStatus::NE())
            ->m($m);
        $this->assertTrue($req->ptst()->is('NE'));
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddTaskInviteRequest ptst="NE">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAnnounceOrganizerChange()
    {
        $req = new \Zimbra\API\Mail\Request\AnnounceOrganizerChange(
            'id'
        );
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
        $filterRule = new \Zimbra\Soap\Struct\NamedElement('name');
        $m = new \Zimbra\Soap\Struct\IdsAttr('ids');
        $req = new \Zimbra\API\Mail\Request\ApplyFilterRules(
            array($filterRule), $m, 'query'
        );
        $this->assertSame(array($filterRule), $req->filterRule()->all());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $req->query('query')
            ->m($m)
            ->addFilterRule($filterRule);
        $this->assertSame(array($filterRule, $filterRule), $req->filterRule()->all());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ApplyFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" />'
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
        $filterRule = new \Zimbra\Soap\Struct\NamedElement('name');
        $m = new \Zimbra\Soap\Struct\IdsAttr('ids');
        $req = new \Zimbra\API\Mail\Request\ApplyOutgoingFilterRules(
            array($filterRule), $m, 'query'
        );
        $this->assertSame(array($filterRule), $req->filterRule()->all());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $req->query('query')
            ->m($m)
            ->addFilterRule($filterRule);
        $this->assertSame(array($filterRule, $filterRule), $req->filterRule()->all());
        $this->assertSame($m, $req->m());
        $this->assertSame('query', $req->query());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ApplyOutgoingFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" />'
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
        $req = new \Zimbra\API\Mail\Request\AutoComplete(
            'name', GalSearchType::ALL(), true, 'folders', true
        );
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
            .'<AutoCompleteRequest name="name" t="all" needExp="1" folders="folders" includeGal="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoCompleteRequest' => array(
                'name' => 'name',
                't' => 'all',
                'needExp' => 1,
                'folders' => 'folders',
                'includeGal' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBounceMsg()
    {
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $m = new \Zimbra\Soap\Struct\BounceMsgSpec('id', array($e));
        $req = new \Zimbra\API\Mail\Request\BounceMsg(
            $m
        );

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
        $req = new \Zimbra\API\Mail\Request\Browse(
            BrowseBy::DOMAINS(), 'regex', 1
        );
        $this->assertTrue($req->browseBy()->is('domains'));
        $this->assertSame('regex', $req->regex());
        $this->assertSame(1, $req->maxToReturn());

        $req->browseBy(BrowseBy::DOMAINS())
            ->regex('regex')
            ->maxToReturn(1);
        $this->assertTrue($req->browseBy()->is('domains'));
        $this->assertSame('regex', $req->regex());
        $this->assertSame(1, $req->maxToReturn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<BrowseRequest browseBy="domains" regex="regex" maxToReturn="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'BrowseRequest' => array(
                'browseBy' => 'domains',
                'regex' => 'regex',
                'maxToReturn' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCancelAppointment()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');

        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $inst = new \Zimbra\Soap\Struct\InstanceRecurIdInfo('range', '20130315T18302305Z', 'tz');
        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CancelAppointment(
            $inst, $tz, $m, 'id', 1, 1, 1
        );
        $this->assertSame($inst, $req->inst());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $req->inst($inst)
            ->tz($tz)
            ->m($m)
            ->id('id')
            ->comp(1)
            ->ms(1)
            ->rev(1);
        $this->assertSame($inst, $req->inst());
        $this->assertSame($tz, $req->tz());
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CancelAppointmentRequest id="id" comp="1" ms="1" rev="1">'
                .'<inst range="range" d="20130315T18302305Z" tz="tz" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CancelAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CancelAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
                'inst' => array(
                    'range' => 'range',
                    'd' => '20130315T18302305Z',
                    'tz' => 'tz',
                ),
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCancelTask()
    {
        $req = new \Zimbra\API\Mail\Request\CancelTask;
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CancelAppointment', $req);

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
        $device = new \Zimbra\Soap\Struct\Id('id');
        $req = new \Zimbra\API\Mail\Request\CheckDeviceStatus($device);
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
        $target = new \Zimbra\Soap\Struct\TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), 'value'
        );
        $req = new \Zimbra\API\Mail\Request\CheckPermission($target, array('right1', 'right2'));
        $this->assertSame($target, $req->target());
        $this->assertSame(array('right1', 'right2'), $req->right());

        $req->target($target)
            ->right(array('right1', 'right2'));

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
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $exceptId = new \Zimbra\Soap\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(true, 1, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Soap\Struct\RecurrenceInfo;

        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $cancel = new \Zimbra\Soap\Struct\ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, 1, 1
        );
        $comp = new \Zimbra\Soap\Struct\ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur, 1, 1
        );
        $except = new \Zimbra\Soap\Struct\ExpandedRecurrenceException(
            $exceptId, $dur, $recur, 1, 1
        );
        $usr = new \Zimbra\Soap\Struct\FreeBusyUserSpec(
            1, 'id', 'name'
        );

        $req = new \Zimbra\API\Mail\Request\CheckRecurConflicts(
            array($tz), $cancel, $comp, $except, array($usr), 1, 1, true, 'excludeUid'
        );
        $this->assertSame(array($tz), $req->tz()->all());
        $this->assertSame($cancel, $req->cancel());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame(array($usr), $req->usr()->all());
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertTrue($req->all());
        $this->assertSame('excludeUid', $req->excludeUid());

        $req->addTz($tz)
            ->cancel($cancel)
            ->comp($comp)
            ->except($except)
            ->addUsr($usr)
            ->s(1)
            ->e(1)
            ->all(true)
            ->excludeUid('excludeUid');
        $this->assertSame(array($tz, $tz), $req->tz()->all());
        $this->assertSame($cancel, $req->cancel());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame(array($usr, $usr), $req->usr()->all());
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertTrue($req->all());
        $this->assertSame('excludeUid', $req->excludeUid());

        $req = new \Zimbra\API\Mail\Request\CheckRecurConflicts(
            array($tz), $cancel, $comp, $except, array($usr), 1, 1, true, 'excludeUid'
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckRecurConflictsRequest s="1" e="1" all="1" excludeUid="excludeUid">'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<cancel s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</cancel>'
                .'<comp s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</comp>'
                .'<except s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</except>'
                .'<usr l="1" id="id" name="name" />'
            .'</CheckRecurConflictsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckRecurConflictsRequest' => array(
                's' => 1,
                'e' => 1,
                'all' => 1,
                'excludeUid' => 'excludeUid',
                'tz' => array(
                    array(
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
                'cancel' => array(
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
                        'l' => 1,
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
        $req = new \Zimbra\API\Mail\Request\CheckSpelling(
            'value', 'dictionary', 'ignore'
        );
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
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $exceptId = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $req = new \Zimbra\API\Mail\Request\CompleteTaskInstance(
            'id', $exceptId, $tz
        );
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
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testContactAction()
    {
        $a = new \Zimbra\Soap\Struct\NewContactAttr(
            'n', 'value', 'aid', 'id', 'part'
        );
        $action = new \Zimbra\Soap\Struct\ContactActionSelector(
            ContactAction::MOVE(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn', array($a)
        );
        $req = new \Zimbra\API\Mail\Request\ContactAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ContactActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn">'
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
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
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
        $action = new \Zimbra\Soap\Struct\ConvActionSelector(
            ConvAction::DELETE(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\API\Mail\Request\ConvAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ConvActionRequest>'
                .'<action op="delete" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" />'
            .'</ConvActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ConvActionRequest' => array(
                'action' => array(
                    'op' => 'delete',
                    'id' => 'id',
                    'tcon' => 'tcon',
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
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
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CounterAppointment(
            $m, 'id', 1, 1, 1
        );
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(1)
            ->ms(1)
            ->rev(1);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CounterAppointmentRequest id="id" comp="1" ms="1" rev="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CounterAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CounterAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCalItemRequestBase()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );
        $req = $this->getMockForAbstractClass('\Zimbra\API\Mail\Request\CalItemRequestBase');

        $req->m($m)
            ->echo_(true)
            ->max(1)
            ->html(true)
            ->neuter(true)
            ->forcesend(true);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->echo_());
        $this->assertSame(1, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->forcesend());
    }

    public function testCreateAppointment()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CreateAppointment(
            $m, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertTrue($req->echo_());
        $this->assertSame(1, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->forcesend());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateAppointmentRequest echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CreateAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateAppointmentRequest' => array(
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAppointmentException()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CreateAppointmentException(
            $m, 'id', 1, 1, 1, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(1)
            ->ms(1)
            ->rev(1);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateAppointmentExceptionRequest id="id" comp="1" ms="1" rev="1" echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CreateAppointmentExceptionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateAppointmentExceptionRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateContact()
    {
        $vcard = new \Zimbra\Soap\Struct\VCardInfo(
            'value', 'mid', 'part', 'aid'
        );
        $a = new \Zimbra\Soap\Struct\NewContactAttr(
            'n', 'value', 'aid', 'id', 'part'
        );
        $m = new \Zimbra\Soap\Struct\NewContactGroupMember(
            'type', 'value'
        );
        $cn = new \Zimbra\Soap\Struct\ContactSpec(
            $vcard, array($a), array($m), 1, 'l', 't', 'tn'
        );

        $req = new \Zimbra\API\Mail\Request\CreateContact(
            $cn, true
        );
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->verbose());

        $req->cn($cn)
            ->verbose(true);
        $this->assertSame($cn, $req->cn());
        $this->assertTrue($req->verbose());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateContactRequest verbose="1">'
                .'<cn id="1" l="l" t="t" tn="tn">'
                    .'<vcard mid="mid" part="part" aid="aid">value</vcard>'
                    .'<a n="n" aid="aid" id="id" part="part">value</a>'
                    .'<m type="type" value="value" />'
                .'</cn>'
            .'</CreateContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateContactRequest' => array(
                'verbose' => 1,
                'cn' => array(
                    'id' => 1,
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
        $imap = new \Zimbra\Soap\Struct\MailImapDataSource(
            'id',
            'name',
            'l',
            true,
            true,
            'host',
            1,
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
            1,
            'lastError',
            array('a', 'b')
        );
        $pop3 = new \Zimbra\Soap\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Soap\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Soap\Struct\MailYabDataSource();
        $rss = new \Zimbra\Soap\Struct\MailRssDataSource();
        $gal = new \Zimbra\Soap\Struct\MailGalDataSource();
        $cal = new \Zimbra\Soap\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Soap\Struct\MailUnknownDataSource();

        $req = new \Zimbra\API\Mail\Request\CreateDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
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
                .'<imap id="id" name="name" l="l" isEnabled="1" importOnly="1" host="host" port="1" '
                .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                .'emailAddress="emailAddress" useAddressForForwardReply="1" defaultSignature="defaultSignature" '
                .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="1">'
                    .'<lastError>lastError</lastError>'
                    .'<a>a</a>'
                    .'<a>b</a>'
                .'</imap>'
                .'<pop3 leaveOnServer="1" />'
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
                    'isEnabled' => 1,
                    'importOnly' => 1,
                    'host' => 'host',
                    'port' => 1,
                    'connectionType' => 'ssl',
                    'username' => 'username',
                    'password' => 'password',
                    'pollingInterval' => 'pollingInterval',
                    'emailAddress' => 'emailAddress',
                    'useAddressForForwardReply' => 1,
                    'defaultSignature' => 'defaultSignature',
                    'forwardReplySignature' => 'forwardReplySignature',
                    'fromDisplay' => 'fromDisplay',
                    'replyToAddress' => 'replyToAddress',
                    'replyToDisplay' => 'replyToDisplay',
                    'importClass' => 'importClass',
                    'failingSince' => 1,
                    'lastError' => 'lastError',
                    'a' => array('a', 'b'),
                ),
                'pop3' => array(
                    'leaveOnServer' => 1,
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
        $grant = new \Zimbra\Soap\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $folder = new \Zimbra\Soap\Struct\NewFolderSpec(
            'name', SearchType::TASK(), 'f', 1, '#aabbcc', 'url', 'l', true, true, array($grant)
        );
        $req = new \Zimbra\API\Mail\Request\CreateFolder(
            $folder
        );
        $this->assertSame($folder, $req->folder());

        $req->folder($folder);
        $this->assertSame($folder, $req->folder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateFolderRequest>'
                .'<folder name="name" view="task" f="f" color="1" rgb="#aabbcc" url="url" l="l" fie="1" sync="1">'
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
                    'color' => 1,
                    'rgb' => '#aabbcc',
                    'url' => 'url',
                    'l' => 'l',
                    'fie' => 1,
                    'sync' => 1,
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
        $link = new \Zimbra\Soap\Struct\NewMountpointSpec(
            'name', SearchType::TASK(), 'f', 1, '#aabbcc', 'url', 'l', true, true, 'zid', 'owner', 1, 'path'
        );
         $req = new \Zimbra\API\Mail\Request\CreateMountpoint(
            $link
        );
        $this->assertSame($link, $req->link());

        $req->link($link);
        $this->assertSame($link, $req->link());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateMountpointRequest>'
                .'<link name="name" view="task" f="f" color="1" rgb="#aabbcc" url="url" l="l" fie="1" reminder="1" zid="zid" owner="owner" rid="1" path="path" />'
            .'</CreateMountpointRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateMountpointRequest' => array(
                'link' => array(
                    'name' => 'name',
                    'view' => 'task',
                    'f' => 'f',
                    'color' => 1,
                    'rgb' => '#aabbcc',
                    'url' => 'url',
                    'l' => 'l',
                    'fie' => 1,
                    'reminder' => 1,
                    'zid' => 'zid',
                    'owner' => 'owner',
                    'rid' => 1,
                    'path' => 'path',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateNote()
    {
        $note = new \Zimbra\Soap\Struct\NewNoteSpec(
            'l', 'content', 1, 'pos'
        );
         $req = new \Zimbra\API\Mail\Request\CreateNote(
            $note
        );
        $this->assertSame($note, $req->note());

        $req->note($note);
        $this->assertSame($note, $req->note());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateNoteRequest>'
                .'<note l="l" content="content" color="1" pos="pos" />'
            .'</CreateNoteRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateNoteRequest' => array(
                'note' => array(
                    'l' => 'l',
                    'content' => 'content',
                    'color' => 1,
                    'pos' => 'pos',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSearchFolder()
    {
        $search = new \Zimbra\Soap\Struct\NewSearchFolderSpec(
            'name', 'query', 'types', 'sortBy', 'f', 1, 'l'
        );
        $req = new \Zimbra\API\Mail\Request\CreateSearchFolder(
            $search
        );
        $this->assertSame($search, $req->search());

        $req->search($search);
        $this->assertSame($search, $req->search());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateSearchFolderRequest>'
                .'<search name="name" query="query" types="types" sortBy="sortBy" f="f" color="1" l="l" />'
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
                    'color' => 1,
                    'l' => 'l',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTag()
    {
        $tag = new \Zimbra\Soap\Struct\TagSpec(
            'name', '#aabbcc', 1
        );
        $req = new \Zimbra\API\Mail\Request\CreateTag(
            $tag
        );
        $this->assertSame($tag, $req->tag());

        $req->tag($tag);
        $this->assertSame($tag, $req->tag());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTagRequest>'
                .'<tag name="name" rgb="#aabbcc" color="1" />'
            .'</CreateTagRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTagRequest' => array(
                'tag' => array(
                    'name' => 'name',
                    'rgb' => '#aabbcc',
                    'color' => 1,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }
    public function testCreateTask()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CreateTask(
            $m, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CreateAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTaskRequest echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CreateTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTaskRequest' => array(
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateTaskException()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\CreateTaskException(
            $m, 'id', 1, 1, 1, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CreateAppointmentException', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateTaskExceptionRequest id="id" comp="1" ms="1" rev="1" echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</CreateTaskExceptionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateTaskExceptionRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateWaitSet()
    {
        $a = new \Zimbra\Soap\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $req = new \Zimbra\API\Mail\Request\CreateWaitSet(
            array($a), array(InterestType::FOLDERS()), true
        );
        $this->assertSame(array($a), $req->add()->all());
        $this->assertSame('f', $req->defTypes());
        $this->assertTrue($req->allAccounts());

        $req->addWaitSet($a)
            ->addDefTypes(InterestType::MESSAGES())
            ->allAccounts(true);
        $this->assertSame(array($a, $a), $req->add()->all());
        $this->assertSame('f,m', $req->defTypes());
        $this->assertTrue($req->allAccounts());

        $req = new \Zimbra\API\Mail\Request\CreateWaitSet(
            array($a), array(InterestType::FOLDERS()), true
        );
        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateWaitSetRequest defTypes="f" allAccounts="1">'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f" />'
                .'</add>'
            .'</CreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateWaitSetRequest' => array(
                'defTypes' => 'f',
                'allAccounts' => 1,
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
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\DeclineCounterAppointment(
            $m
        );
        $this->assertSame($m, $req->m());
        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeclineCounterAppointmentRequest>'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDataSource()
    {
        $imap = new \Zimbra\Soap\Struct\ImapDataSourceNameOrId('name', 'id');
        $pop3 = new \Zimbra\Soap\Struct\Pop3DataSourceNameOrId('name', 'id');
        $caldav = new \Zimbra\Soap\Struct\CaldavDataSourceNameOrId('name', 'id');
        $yab = new \Zimbra\Soap\Struct\YabDataSourceNameOrId('name', 'id');
        $rss = new \Zimbra\Soap\Struct\RssDataSourceNameOrId('name', 'id');
        $gal = new \Zimbra\Soap\Struct\GalDataSourceNameOrId('name', 'id');
        $cal = new \Zimbra\Soap\Struct\CalDataSourceNameOrId('name', 'id');
        $unknown = new \Zimbra\Soap\Struct\UnknownDataSourceNameOrId('name', 'id');

        $req = new \Zimbra\API\Mail\Request\DeleteDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
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
        $device = new \Zimbra\Soap\Struct\Id('id');
        $req = new \Zimbra\API\Mail\Request\DeleteDevice(
            $device
        );
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
        $req = new \Zimbra\API\Mail\Request\DestroyWaitSet(
            'waitSet'
        );
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
        $doc = new \Zimbra\Soap\Struct\DiffDocumentVersionSpec('id', 1, 2);
        $req = new \Zimbra\API\Mail\Request\DiffDocument(
            $doc
        );
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DiffDocumentRequest>'
                .'<doc id="id" v1="1" v2="2" />'
            .'</DiffDocumentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DiffDocumentRequest' => array(
                'doc' => array(
                    'id' => 'id',
                    'v1' => 1,
                    'v2' => 2,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDismissCalendarItemAlarm()
    {
        $appt = new \Zimbra\Soap\Struct\DismissAppointmentAlarm('id', 1);
        $task = new \Zimbra\Soap\Struct\DismissTaskAlarm('id', 1);
        $req = new \Zimbra\API\Mail\Request\DismissCalendarItemAlarm(
            $appt, $task
        );
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $req->appt($appt)
            ->task($task);
        $this->assertSame($appt, $req->appt());
        $this->assertSame($task, $req->task());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DismissCalendarItemAlarmRequest>'
                .'<appt id="id" dismissedAt="1" />'
                .'<task id="id" dismissedAt="1" />'
            .'</DismissCalendarItemAlarmRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DismissCalendarItemAlarmRequest' => array(
                'appt' => array(
                    'id' => 'id',
                    'dismissedAt' => 1,
                ),
                'task' => array(
                    'id' => 'id',
                    'dismissedAt' => 1,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDocumentAction()
    {
        $grant = new \Zimbra\Soap\Struct\DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), 1
        );
        $action = new \Zimbra\Soap\Struct\DocumentActionSelector(
            DocumentAction::WATCH(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn', $grant, 'zid'
        );
        $req = new \Zimbra\API\Mail\Request\DocumentAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DocumentActionRequest>'
                .'<action op="watch" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" zid="zid">'
                    .'<grant perm="r" gt="all" expiry="1" />'
                .'</action>'
            .'</DocumentActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DocumentActionRequest' => array(
                'action' => array(
                    'op' => 'watch',
                    'id' => 'id',
                    'tcon' => 'tcon',
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
                    'name' => 'name',
                    'f' => 'f',
                    't' => 't',
                    'tn' => 'tn',
                    'zid' => 'zid',
                    'grant' => array(
                        'perm' => 'r',
                        'gt' => 'all',
                        'expiry' => 1,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testEmptyDumpster()
    {
        $req = new \Zimbra\API\Mail\Request\EmptyDumpster();

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
        $link = new \Zimbra\Soap\Struct\SharedReminderMount(
            'id', true
        );
        $req = new \Zimbra\API\Mail\Request\EnableSharedReminder(
            $link
        );
        $this->assertSame($link, $req->link());

        $req->link($link);
        $this->assertSame($link, $req->link());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<EnableSharedReminderRequest>'
                .'<link id="id" reminder="1" />'
            .'</EnableSharedReminderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'EnableSharedReminderRequest' => array(
                'link' => array(
                    'id' => 'id',
                    'reminder' => 1,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExpandRecur()
    {
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $exceptId = new \Zimbra\Soap\Struct\InstanceRecurIdInfo(
            'range', '20130315T18302305Z', 'tz'
        );
        $dur = new \Zimbra\Soap\Struct\DurationInfo(true, 1, 2, 3, 4, 5, 'START', 6);
        $recur = new \Zimbra\Soap\Struct\RecurrenceInfo;

        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $cancel = new \Zimbra\Soap\Struct\ExpandedRecurrenceCancel(
            $exceptId, $dur, $recur, 1, 1
        );
        $comp = new \Zimbra\Soap\Struct\ExpandedRecurrenceInvite(
            $exceptId, $dur, $recur, 1, 1
        );
        $except = new \Zimbra\Soap\Struct\ExpandedRecurrenceException(
            $exceptId, $dur, $recur, 1, 1
        );
        $usr = new \Zimbra\Soap\Struct\FreeBusyUserSpec(
            1, 'id', 'name'
        );

        $req = new \Zimbra\API\Mail\Request\ExpandRecur(
            1, 1, array($tz), $comp, $except, $cancel
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame(array($tz), $req->tz()->all());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame($cancel, $req->cancel());

        $req->s(1)
            ->e(1)
            ->addTz($tz)
            ->comp($comp)
            ->except($except)
            ->cancel($cancel);
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame(array($tz, $tz), $req->tz()->all());
        $this->assertSame($comp, $req->comp());
        $this->assertSame($except, $req->except());
        $this->assertSame($cancel, $req->cancel());

        $req = new \Zimbra\API\Mail\Request\ExpandRecur(
            1, 1, array($tz), $comp, $except, $cancel
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExpandRecurRequest s="1" e="1">'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<comp s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</comp>'
                .'<except s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</except>'
                .'<cancel s="1" e="1">'
                    .'<exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                    .'<dur neg="1" w="1" d="2" h="3" m="4" s="5" related="START" count="6" />'
                    .'<recur />'
                .'</cancel>'
            .'</ExpandRecurRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExpandRecurRequest' => array(
                's' => 1,
                'e' => 1,
                'tz' => array(
                    array(
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
                'comp' => array(
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
                    's' => 1,
                    'e' => 1,
                    'exceptId' => array(
                        'range' => 'range',
                        'd' => '20130315T18302305Z',
                        'tz' => 'tz',
                    ),
                    'dur' => array(
                        'neg' => 1,
                        'w' => 1,
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
        $req = new \Zimbra\API\Mail\Request\ExportContacts(
            'ct', 'l', 'csvfmt', 'csvlocale', 'csvsep'
        );
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
        $keep = new \Zimbra\Soap\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Soap\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $retentionPolicy = new \Zimbra\Soap\Struct\RetentionPolicy(
            array($keep), array($purge)
        );
        $grant = new \Zimbra\Soap\Struct\ActionGrantSelector(
            'perm', GranteeType::USR(), 'zid', 'd', 'args', 'pw', 'key'
        );
        $action = new \Zimbra\Soap\Struct\FolderActionSelector(
            FolderAction::READ(),
            'id',
            'tcon',
            1,
            'l',
            '#aabbcc',
            1,
            'name',
            'f',
            't',
            'tn',
            $grant,
            array($grant),
            $retentionPolicy,
            true,
            'url',
            true,
            'zid',
            'gt',
            'view'
        );
        $req = new \Zimbra\API\Mail\Request\FolderAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FolderActionRequest>'
                .'<action op="read" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" recursive="1" url="url" excludeFreeBusy="1" zid="zid" gt="gt" view="view">'
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
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
                    'name' => 'name',
                    'f' => 'f',
                    't' => 't',
                    'tn' => 'tn',
                    'recursive' => 1,
                    'url' => 'url',
                    'excludeFreeBusy' => 1,
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
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');

        $exceptId = new \Zimbra\Soap\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\ForwardAppointment(
            $exceptId, $tz, $m, 'id'
        );
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
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testForwardAppointmentInvite()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\ForwardAppointmentInvite(
            $m, 'id'
        );
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
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGenerateUUID()
    {
        $req = new \Zimbra\API\Mail\Request\GenerateUUID();

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
        $filter = new \Zimbra\Soap\Struct\ActivityFilter(
            'account', 'op', 'session'
        );
        $req = new \Zimbra\API\Mail\Request\GetActivityStream(
            'id', $filter, 1, 1
        );
        $this->assertSame('id', $req->id());
        $this->assertSame($filter, $req->filter());
        $this->assertSame(1, $req->offset());
        $this->assertSame(1, $req->limit());

        $req->id('id')
            ->filter($filter)
            ->offset(1)
            ->limit(1);
        $this->assertSame($filter, $req->filter());
        $this->assertSame('id', $req->id());
        $this->assertSame($filter, $req->filter());
        $this->assertSame(1, $req->offset());
        $this->assertSame(1, $req->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetActivityStreamRequest id="id" offset="1" limit="1">'
                .'<filter account="account" op="op" session="session" />'
            .'</GetActivityStreamRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetActivityStreamRequest' => array(
                'id' => 'id',
                'offset' => 1,
                'limit' => 1,
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
        $req = new \Zimbra\API\Mail\Request\GetAllDevices();

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
        $req = new \Zimbra\API\Mail\Request\GetAppointment(
            true, true, 'icalendar-uid', 'appointment-id'
        );
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
            .'<GetAppointmentRequest sync="1" includeContent="1" uid="icalendar-uid" id="appointment-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAppointmentRequest' => array(
                'sync' => 1,
                'includeContent' => 1,
                'uid' => 'icalendar-uid',
                'id' => 'appointment-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetApptSummaries()
    {
        $req = new \Zimbra\API\Mail\Request\GetApptSummaries(
            1, 1, 'folder-id'
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('folder-id', $req->l());

        $req->s(1)
            ->e(1)
            ->l('folder-id');
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('folder-id', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetApptSummariesRequest s="1" e="1" l="folder-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetApptSummariesRequest' => array(
                's' => 1,
                'e' => 1,
                'l' => 'folder-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarItemSummaries()
    {
        $req = new \Zimbra\API\Mail\Request\GetCalendarItemSummaries(
            1, 1, 'folder-id'
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('folder-id', $req->l());

        $req->s(1)
            ->e(1)
            ->l('folder-id');
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('folder-id', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCalendarItemSummariesRequest s="1" e="1" l="folder-id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCalendarItemSummariesRequest' => array(
                's' => 1,
                'e' => 1,
                'l' => 'folder-id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetComments()
    {
        $comment = new \Zimbra\Soap\Struct\ParentId(
            'item-id-of-parent'
        );
        $req = new \Zimbra\API\Mail\Request\GetComments(
            $comment
        );
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
        $a = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $ma = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $cn = new \Zimbra\Soap\Struct\Id('id');

        $req = new \Zimbra\API\Mail\Request\GetContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 1
        );
        $this->assertSame(array($a), $req->a()->all());
        $this->assertSame(array($ma), $req->ma()->all());
        $this->assertSame(array($cn), $req->cn()->all());
        $this->assertTrue($req->sync());
        $this->assertSame('folder-id', $req->l());
        $this->assertSame('sort-by', $req->sortBy());
        $this->assertTrue($req->derefGroupMember());
        $this->assertTrue($req->returnHiddenAttrs());
        $this->assertSame(1, $req->maxMembers());

        $req->addA($a)
            ->addMa($ma)
            ->addCn($cn)
            ->sync(true)
            ->l('folder-id')
            ->sortBy('sort-by')
            ->derefGroupMember(true)
            ->returnHiddenAttrs(true)
            ->maxMembers(1);
        $this->assertSame(array($a, $a), $req->a()->all());
        $this->assertSame(array($ma, $ma), $req->ma()->all());
        $this->assertSame(array($cn, $cn), $req->cn()->all());
        $this->assertTrue($req->sync());
        $this->assertSame('folder-id', $req->l());
        $this->assertSame('sort-by', $req->sortBy());
        $this->assertTrue($req->derefGroupMember());
        $this->assertTrue($req->returnHiddenAttrs());
        $this->assertSame(1, $req->maxMembers());

        $req = new \Zimbra\API\Mail\Request\GetContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 1
        );

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetContactsRequest sync="1" l="folder-id" sortBy="sort-by" derefGroupMember="1" returnHiddenAttrs="1" maxMembers="1">'
                .'<a n="attribute-name" />'
                .'<ma n="attribute-name" />'
                .'<cn id="id" />'
            .'</GetContactsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetContactsRequest' => array(
                'sync' => 1,
                'l' => 'folder-id',
                'sortBy' => 'sort-by',
                'derefGroupMember' => 1,
                'returnHiddenAttrs' => 1,
                'maxMembers' => 1,
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
        $header = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $c = new \Zimbra\Soap\Struct\ConversationSpec(
            'id', array($header), 'fetch', true, 1
        );
        $req = new \Zimbra\API\Mail\Request\GetConv(
            $c
        );
        $this->assertSame($c, $req->c());

        $req->c($c);
        $this->assertSame($c, $req->c());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetConvRequest>'
                .'<c id="id" fetch="fetch" html="1" max="1">'
                    .'<header n="attribute-name" />'
                .'</c>'
            .'</GetConvRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetConvRequest' => array(
                'c' => array(
                    'id' => 'id',
                    'fetch' => 'fetch',
                    'html' => 1,
                    'max' => 1,
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
        $meta = new \Zimbra\Soap\Struct\SectionAttr('section');
        $req = new \Zimbra\API\Mail\Request\GetCustomMetadata(
            'id', $meta
        );
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
        $req = new \Zimbra\API\Mail\Request\GetDataSources();

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
        $item = new \Zimbra\Soap\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );
        $req = new \Zimbra\API\Mail\Request\GetDocumentShareURL(
            $item
        );
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
        $folder = new \Zimbra\Soap\Struct\FolderSpec(
            'l'
        );
        $req = new \Zimbra\API\Mail\Request\GetEffectiveFolderPerms(
            $folder
        );
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
        $req = new \Zimbra\API\Mail\Request\GetFilterRules();

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
        $folder = new \Zimbra\Soap\Struct\GetFolderSpec(
            'uuid', 'l', 'path'
        );
        $req = new \Zimbra\API\Mail\Request\GetFolder(
            $folder, true, true, 'view', 1, true
        );
        $this->assertSame($folder, $req->folder());
        $this->assertTrue($req->visible());
        $this->assertTrue($req->needGranteeName());
        $this->assertSame('view', $req->view());
        $this->assertSame(1, $req->depth());
        $this->assertTrue($req->tr());

        $req->folder($folder)
            ->visible(true)
            ->needGranteeName(true)
            ->view('view')
            ->depth(1)
            ->tr(true);
        $this->assertSame($folder, $req->folder());
        $this->assertTrue($req->visible());
        $this->assertTrue($req->needGranteeName());
        $this->assertSame('view', $req->view());
        $this->assertSame(1, $req->depth());
        $this->assertTrue($req->tr());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFolderRequest visible="1" needGranteeName="1" view="view" depth="1" tr="1">'
                .'<folder uuid="uuid" l="l" path="path" />'
            .'</GetFolderRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFolderRequest' => array(
                'visible' => 1,
                'needGranteeName' => 1,
                'view' => 'view',
                'depth' => 1,
                'tr' => 1,
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
        $usr = new \Zimbra\Soap\Struct\FreeBusyUserSpec(
            1, 'id', 'name'
        );
        $req = new \Zimbra\API\Mail\Request\GetFreeBusy(
            1, 1, 'uid', 'id', 'name', 'excludeUid', array($usr)
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame('excludeUid', $req->excludeUid());
        $this->assertSame(array($usr), $req->usr()->all());
        $req->s(1)
            ->e(1)
            ->uid('uid')
            ->id('id')
            ->name('name')
            ->excludeUid('excludeUid')
            ->addUsr($usr);
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('uid', $req->uid());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame('excludeUid', $req->excludeUid());
        $this->assertSame(array($usr, $usr), $req->usr()->all());

        $req->usr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFreeBusyRequest s="1" e="1" uid="uid" id="id" name="name" excludeUid="excludeUid">'
                .'<usr l="1" id="id" name="name" />'
            .'</GetFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFreeBusyRequest' => array(
                's' => 1,
                'e' => 1,
                'uid' => 'uid',
                'id' => 'id',
                'name' => 'name',
                'excludeUid' => 'excludeUid',
                'usr' => array(
                    array(
                        'l' => 1,
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
        $req = new \Zimbra\API\Mail\Request\GetICal(
            'id', 1, 1
        );
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $req->s(1)
            ->e(1)
            ->id('id');
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetICalRequest id="id" s="1" e="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetICalRequest' => array(
                'id' => 'id',
                's' => 1,
                'e' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetImportStatus()
    {
        $req = new \Zimbra\API\Mail\Request\GetImportStatus();

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
        $item = new \Zimbra\Soap\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );
        $req = new \Zimbra\API\Mail\Request\GetItem(
            $item
        );
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
        $meta = new \Zimbra\Soap\Struct\SectionAttr('section');
        $req = new \Zimbra\API\Mail\Request\GetMailboxMetadata(
            $meta
        );
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
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $folder = new \Zimbra\Soap\Struct\Id('id');

        $req = new \Zimbra\API\Mail\Request\GetMiniCal(
            1, 1, array($folder), $tz
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame(array($folder), $req->folder()->all());
        $this->assertSame($tz, $req->tz());

        $req->s(1)
            ->e(1)
            ->addFolder($folder)
            ->tz($tz);
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame(array($folder, $folder), $req->folder()->all());
        $this->assertSame($tz, $req->tz());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMiniCalRequest s="1" e="1">'
                .'<folder id="id" />'
                .'<folder id="id" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
            .'</GetMiniCalRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMiniCalRequest' => array(
                's' => 1,
                'e' => 1,
                'folder' => array(
                    array(
                        'id' => 'id',
                    ),
                    array(
                        'id' => 'id',
                    ),
                ),
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
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMsg()
    {
        $header = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $m = new \Zimbra\Soap\Struct\MsgSpec(
            'id', array($header), 'part', true, true, 1, true, true, 'ridZ', true
        );
        $req = new \Zimbra\API\Mail\Request\GetMsg(
            $m
        );
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMsgRequest>'
                .'<m id="id" part="part" raw="1" read="1" max="1" html="1" neuter="1" ridZ="ridZ" needExp="1">'
                    .'<header n="attribute-name" />'
                .'</m>'
            .'</GetMsgRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMsgRequest' => array(
                'm' => array(
                    'id' => 'id',
                    'part' => 'part',
                    'raw' => 1,
                    'read' => 1,
                    'max' => 1,
                    'html' => 1,
                    'neuter' => 1,
                    'ridZ' => 'ridZ',
                    'needExp' => 1,
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
        $m = new \Zimbra\Soap\Struct\IdsAttr(
            'ids'
        );
        $req = new \Zimbra\API\Mail\Request\GetMsgMetadata(
            $m
        );
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
        $note = new \Zimbra\Soap\Struct\Id('id');
        $req = new \Zimbra\API\Mail\Request\GetNote(
            $note
        );
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
        $req = new \Zimbra\API\Mail\Request\GetNotifications(
            true
        );
        $this->assertTrue($req->markSeen());

        $req->markSeen(true);
        $this->assertTrue($req->markSeen());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetNotificationsRequest markSeen="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetNotificationsRequest' => array(
                'markSeen' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetOutgoingFilterRules()
    {
        $req = new \Zimbra\API\Mail\Request\GetOutgoingFilterRules();

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
        $ace = new \Zimbra\Soap\Struct\Right('right');
        $req = new \Zimbra\API\Mail\Request\GetPermission(
            array($ace)
        );
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
        $req = new \Zimbra\API\Mail\Request\GetRecur(
            'id'
        );
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
        $req = new \Zimbra\API\Mail\Request\GetSearchFolder();

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
        $item = new \Zimbra\Soap\Struct\Id('id');
        $req = new \Zimbra\API\Mail\Request\GetShareDetails(
            $item
        );
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
        $req = new \Zimbra\API\Mail\Request\GetShareNotifications();

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
        $req = new \Zimbra\API\Mail\Request\GetSpellDictionaries();

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
        $req = new \Zimbra\API\Mail\Request\GetSystemRetentionPolicy();

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
        $req = new \Zimbra\API\Mail\Request\GetTag();

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
        $req = new \Zimbra\API\Mail\Request\GetTask(
            true, true, 'uid', 'id'
        );
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
            .'<GetTaskRequest sync="1" includeContent="1" uid="uid" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTaskRequest' => array(
                'sync' => 1,
                'includeContent' => 1,
                'uid' => 'uid',
                'id' => 'id',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetTaskSummaries()
    {
        $req = new \Zimbra\API\Mail\Request\GetTaskSummaries(
            1, 1, 'l'
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('l', $req->l());
        $req->s(1)
            ->e(1)
            ->l('l');
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('l', $req->l());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetTaskSummariesRequest s="1" e="1" l="l" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetTaskSummariesRequest' => array(
                's' => 1,
                'e' => 1,
                'l' => 'l',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetWatchers()
    {
        $req = new \Zimbra\API\Mail\Request\GetWatchers();

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
        $req = new \Zimbra\API\Mail\Request\GetWatchingItems();

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
        $req = new \Zimbra\API\Mail\Request\GetWorkingHours(
            1, 1, 'id', 'name'
        );
        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $req->s(1)
            ->e(1)
            ->id('id')
            ->name('name');

        $this->assertSame(1, $req->s());
        $this->assertSame(1, $req->e());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetWorkingHoursRequest s="1" e="1" id="id" name="name" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetWorkingHoursRequest' => array(
                's' => 1,
                'e' => 1,
                'id' => 'id',
                'name' => 'name',
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetYahooAuthToken()
    {
        $req = new \Zimbra\API\Mail\Request\GetYahooAuthToken(
            'user', 'password'
        );
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
        $req = new \Zimbra\API\Mail\Request\GetYahooCookie(
            'user'
        );
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
        $ace = new \Zimbra\Soap\Struct\AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false, true
        );
        $req = new \Zimbra\API\Mail\Request\GrantPermission(
            array($ace)
        );
        $this->assertSame(array($ace), $req->ace()->all());
        $req->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->ace()->all());

        $req->ace()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GrantPermissionRequest>'
                .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="0" chkgt="1" />'
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
                        'deny' => 0,
                        'chkgt' => 1,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testICalReply()
    {
        $req = new \Zimbra\API\Mail\Request\ICalReply(
            'ical'
        );
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
        $content = new \Zimbra\Soap\Struct\ContentSpec(
            'value', 'aid', 'mid', 'part'
        );
        $req = new \Zimbra\API\Mail\Request\ImportAppointments(
            $content, 'ct', 'l'
        );
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
        $content = new \Zimbra\Soap\Struct\Content(
            'value', 'aid'
        );
        $req = new \Zimbra\API\Mail\Request\ImportContacts(
            $content, 'ct', 'l', 'csvfmt', 'csvlocale'
        );
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
        $imap = new \Zimbra\Soap\Struct\ImapDataSourceNameOrId('name', 'id');
        $pop3 = new \Zimbra\Soap\Struct\Pop3DataSourceNameOrId('name', 'id');
        $caldav = new \Zimbra\Soap\Struct\CaldavDataSourceNameOrId('name', 'id');
        $yab = new \Zimbra\Soap\Struct\YabDataSourceNameOrId('name', 'id');
        $rss = new \Zimbra\Soap\Struct\RssDataSourceNameOrId('name', 'id');
        $gal = new \Zimbra\Soap\Struct\GalDataSourceNameOrId('name', 'id');
        $cal = new \Zimbra\Soap\Struct\CalDataSourceNameOrId('name', 'id');
        $unknown = new \Zimbra\Soap\Struct\UnknownDataSourceNameOrId('name', 'id');

        $req = new \Zimbra\API\Mail\Request\ImportData(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
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
        $req = new \Zimbra\API\Mail\Request\InvalidateReminderDevice(
            'device-email-address'
        );
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

    public function testItemAction()
    {
        $action = new \Zimbra\Soap\Struct\ItemActionSelector(
            ItemAction::MOVE(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\API\Mail\Request\ItemAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ItemActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" />'
            .'</ItemActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ItemActionRequest' => array(
                'action' => array(
                    'op' => 'move',
                    'id' => 'id',
                    'tcon' => 'tcon',
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
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
        $doc = new \Zimbra\Soap\Struct\ListDocumentRevisionsSpec(
            'id', 1, 1
        );
        $req = new \Zimbra\API\Mail\Request\ListDocumentRevisions(
            $doc
        );
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ListDocumentRevisionsRequest>'
                .'<doc id="id" ver="1" count="1" />'
            .'</ListDocumentRevisionsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ListDocumentRevisionsRequest' => array(
                'doc' => array(
                    'id' => 'id',
                    'ver' => 1,
                    'count' => 1,
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAppointment()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\ModifyAppointment(
            $m, 'id', 1, 1, 1, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\CalItemRequestBase', $req);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $req->m($m)
            ->id('id')
            ->comp(1)
            ->ms(1)
            ->rev(1);
        $this->assertSame($m, $req->m());
        $this->assertSame('id', $req->id());
        $this->assertSame(1, $req->comp());
        $this->assertSame(1, $req->ms());
        $this->assertSame(1, $req->rev());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyAppointmentRequest id="id" comp="1" ms="1" rev="1" echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</ModifyAppointmentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyAppointmentRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyContact()
    {
        $a = new \Zimbra\Soap\Struct\ModifyContactAttr(
            'n', 'value', 'aid', 1, 'part', 'op'
        );
        $m = new \Zimbra\Soap\Struct\ModifyContactGroupMember(
            'C', 'value', 'reset'
        );
        $cn = new \Zimbra\Soap\Struct\ModifyContactSpec(
            array($a), array($m), 1, 'tn'
        );

        $req = new \Zimbra\API\Mail\Request\ModifyContact(
            $cn, true, true
        );
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
            .'<ModifyContactRequest replace="1" verbose="1">'
                .'<cn id="1" tn="tn">'
                    .'<a n="n" aid="aid" id="1" part="part" op="op">value</a>'
                    .'<m type="C" value="value" op="reset" />'
                .'</cn>'
            .'</ModifyContactRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyContactRequest' => array(
                'replace' => 1,
                'verbose' => 1,
                'cn' => array(
                    'id' => 1,
                    'tn' => 'tn',
                    'a' => array(
                        array(
                            'n' => 'n',
                            '_' => 'value',
                            'aid' => 'aid',
                            'id' => 1,
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
        $imap = new \Zimbra\Soap\Struct\MailImapDataSource(
            'id',
            'name',
            'l',
            true,
            true,
            'host',
            1,
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
            1,
            'lastError',
            array('a', 'b')
        );
        $pop3 = new \Zimbra\Soap\Struct\MailPop3DataSource(true);
        $caldav = new \Zimbra\Soap\Struct\MailCaldavDataSource();
        $yab = new \Zimbra\Soap\Struct\MailYabDataSource();
        $rss = new \Zimbra\Soap\Struct\MailRssDataSource();
        $gal = new \Zimbra\Soap\Struct\MailGalDataSource();
        $cal = new \Zimbra\Soap\Struct\MailCalDataSource();
        $unknown = new \Zimbra\Soap\Struct\MailUnknownDataSource();

        $req = new \Zimbra\API\Mail\Request\ModifyDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );
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
                .'<imap id="id" name="name" l="l" isEnabled="1" importOnly="1" host="host" port="1" '
                .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                .'emailAddress="emailAddress" useAddressForForwardReply="1" defaultSignature="defaultSignature" '
                .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="1">'
                    .'<lastError>lastError</lastError>'
                    .'<a>a</a>'
                    .'<a>b</a>'
                .'</imap>'
                .'<pop3 leaveOnServer="1" />'
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
                    'isEnabled' => 1,
                    'importOnly' => 1,
                    'host' => 'host',
                    'port' => 1,
                    'connectionType' => 'ssl',
                    'username' => 'username',
                    'password' => 'password',
                    'pollingInterval' => 'pollingInterval',
                    'emailAddress' => 'emailAddress',
                    'useAddressForForwardReply' => 1,
                    'defaultSignature' => 'defaultSignature',
                    'forwardReplySignature' => 'forwardReplySignature',
                    'fromDisplay' => 'fromDisplay',
                    'replyToAddress' => 'replyToAddress',
                    'replyToDisplay' => 'replyToDisplay',
                    'importClass' => 'importClass',
                    'failingSince' => 1,
                    'lastError' => 'lastError',
                    'a' => array('a', 'b'),
                ),
                'pop3' => array(
                    'leaveOnServer' => 1,
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
        $addressBookTest = new \Zimbra\Soap\Struct\AddressBookTest(
            1, 'header', true
        );
        $addressTest = new \Zimbra\Soap\Struct\AddressTest(
            1, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $attachmentTest = new \Zimbra\Soap\Struct\AttachmentTest(
            1, true
        );
        $bodyTest = new \Zimbra\Soap\Struct\BodyTest(
            1, 'value', true, true
        );
        $bulkTest = new \Zimbra\Soap\Struct\BulkTest(
            1, true
        );
        $contactRankingTest = new \Zimbra\Soap\Struct\ContactRankingTest(
            1, 'header', true
        );
        $conversationTest = new \Zimbra\Soap\Struct\ConversationTest(
            1, 'where', true
        );
        $currentDayOfWeekTest = new \Zimbra\Soap\Struct\CurrentDayOfWeekTest(
            1, 'value', true
        );
        $currentTimeTest = new \Zimbra\Soap\Struct\CurrentTimeTest(
            1, 'dateComparison', 'time', true
        );
        $dateTest = new \Zimbra\Soap\Struct\DateTest(
            1, 'dateComparison', 1, true
        );
        $facebookTest = new \Zimbra\Soap\Struct\FacebookTest(
            1, true
        );
        $flaggedTest = new \Zimbra\Soap\Struct\FlaggedTest(
            1, 'flagName', true
        );
        $headerExistsTest = new \Zimbra\Soap\Struct\HeaderExistsTest(
            1, 'header', true
        );
        $headerTest = new \Zimbra\Soap\Struct\HeaderTest(
            1, 'header', 'stringComparison', 'value', true, true
        );
        $importanceTest = new \Zimbra\Soap\Struct\ImportanceTest(
            1, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Soap\Struct\InviteTest(
            1, array('method'), true
        );
        $linkedinTest = new \Zimbra\Soap\Struct\LinkedInTest(
            1, true
        );
        $listTest = new \Zimbra\Soap\Struct\ListTest(
            1, true
        );
        $meTest = new \Zimbra\Soap\Struct\MeTest(
            1, 'header', true
        );
        $mimeHeaderTest = new \Zimbra\Soap\Struct\MimeHeaderTest(
            1, 'header', 'stringComparison', 'value', true, true
        );
        $sizeTest = new \Zimbra\Soap\Struct\SizeTest(
            1, 'numberComparison', 's', true
        );
        $socialcastTest = new \Zimbra\Soap\Struct\SocialcastTest(
            1, true
        );
        $trueTest = new \Zimbra\Soap\Struct\TrueTest(
            1, true
        );
        $twitterTest = new \Zimbra\Soap\Struct\TwitterTest(
            1, true
        );
        $filterTests = new \Zimbra\Soap\Struct\FilterTests(
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
        $actionKeep = new \Zimbra\Soap\Struct\KeepAction(
            1
        );
        $actionDiscard = new \Zimbra\Soap\Struct\DiscardAction(
            1
        );
        $actionFileInto = new \Zimbra\Soap\Struct\FileIntoAction(
            1, 'folderPath'
        );
        $actionFlag = new \Zimbra\Soap\Struct\FlagAction(
            1, 'flagName'
        );
        $actionTag = new \Zimbra\Soap\Struct\TagAction(
            1, 'tagName'
        );
        $actionRedirect = new \Zimbra\Soap\Struct\RedirectAction(
            1, 'a'
        );
        $actionReply = new \Zimbra\Soap\Struct\ReplyAction(
            1, 'content'
        );
        $actionNotify = new \Zimbra\Soap\Struct\NotifyAction(
            1, 'content', 'a', 'su', 1, 'origHeaders'
        );
        $actionStop = new \Zimbra\Soap\Struct\StopAction(
            1
        );
        $filterActions = new \Zimbra\Soap\Struct\FilterActions(
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
        $filterRule = new \Zimbra\Soap\Struct\FilterRule(
            'name', true, $filterTests, $filterActions
        );
        $filterRules = new \Zimbra\Soap\Struct\FilterRules(
            array($filterRule)
        );

        $req = new \Zimbra\API\Mail\Request\ModifyFilterRules(
            $filterRules
        );
        $this->assertSame($filterRules, $req->filterRules());

        $req->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" active="1">'
                        .'<filterTests condition="allof">'
                            .'<addressBookTest index="1" negative="1" header="header" />'
                            .'<addressTest index="1" negative="1" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<attachmentTest index="1" negative="1" />'
                            .'<bodyTest index="1" negative="1" value="value" caseSensitive="1" />'
                            .'<bulkTest index="1" negative="1" />'
                            .'<contactRankingTest index="1" negative="1" header="header" />'
                            .'<conversationTest index="1" negative="1" where="where" />'
                            .'<currentDayOfWeekTest index="1" negative="1" value="value" />'
                            .'<currentTimeTest index="1" negative="1" dateComparison="dateComparison" time="time" />'
                            .'<dateTest index="1" negative="1" dateComparison="dateComparison" d="1" />'
                            .'<facebookTest index="1" negative="1" />'
                            .'<flaggedTest index="1" negative="1" flagName="flagName" />'
                            .'<headerExistsTest index="1" negative="1" header="header" />'
                            .'<headerTest index="1" negative="1" header="header" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<importanceTest index="1" negative="1" imp="high" />'
                            .'<inviteTest index="1" negative="1">'
                                .'<method>method</method>'
                            .'</inviteTest>'
                            .'<linkedinTest index="1" negative="1" />'
                            .'<listTest index="1" negative="1" />'
                            .'<meTest index="1" negative="1" header="header" />'
                            .'<mimeHeaderTest index="1" negative="1" header="header" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<sizeTest index="1" negative="1" numberComparison="numberComparison" s="s" />'
                            .'<socialcastTest index="1" negative="1" />'
                            .'<trueTest index="1" negative="1" />'
                            .'<twitterTest index="1" negative="1" />'
                        .'</filterTests>'
                        .'<filterActions>'
                            .'<actionKeep index="1" />'
                            .'<actionDiscard index="1" />'
                            .'<actionFileInto index="1" folderPath="folderPath" />'
                            .'<actionFlag index="1" flagName="flagName" />'
                            .'<actionTag index="1" tagName="tagName" />'
                            .'<actionRedirect index="1" a="a" />'
                            .'<actionReply index="1">'
                                .'<content>content</content>'
                            .'</actionReply>'
                            .'<actionNotify index="1" a="a" su="su" maxBodySize="1" origHeaders="origHeaders">'
                                .'<content>content</content>'
                            .'</actionNotify>'
                            .'<actionStop index="1" />'
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
                            'active' => 1,
                            'filterTests' => array(
                                'condition' => 'allof',
                                'addressBookTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'addressTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'part' => 'part',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'attachmentTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'bodyTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'bulkTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'contactRankingTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'conversationTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'where' => 'where',
                                ),
                                'currentDayOfWeekTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'value' => 'value',
                                ),
                                'currentTimeTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'dateComparison' => 'dateComparison',
                                    'time' => 'time',
                                ),
                                'dateTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'dateComparison' => 'dateComparison',
                                    'd' => 1,
                                ),
                                'facebookTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'flaggedTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'flagName' => 'flagName',
                                ),
                                'headerExistsTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'headerTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'importanceTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'imp' => 'high',
                                ),
                                'inviteTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'method' => array(
                                        'method',
                                    ),
                                ),
                                'linkedinTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'listTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'meTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'mimeHeaderTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'sizeTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'numberComparison' => 'numberComparison',
                                    's' => 's',
                                ),
                                'socialcastTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'trueTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'twitterTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                            ),
                            'filterActions' => array(
                                'actionKeep' => array(
                                    'index' => 1,
                                ),
                                'actionDiscard' => array(
                                    'index' => 1,
                                ),
                                'actionFileInto' => array(
                                    'index' => 1,
                                    'folderPath' => 'folderPath',
                                ),
                                'actionFlag' => array(
                                    'index' => 1,
                                    'flagName' => 'flagName',
                                ),
                                'actionTag' => array(
                                    'index' => 1,
                                    'tagName' => 'tagName',
                                ),
                                'actionRedirect' => array(
                                    'index' => 1,
                                    'a' => 'a',
                                ),
                                'actionReply' => array(
                                    'index' => 1,
                                    'content' => 'content',
                                ),
                                'actionNotify' => array(
                                    'index' => 1,
                                    'content' => 'content',
                                    'a' => 'a',
                                    'su' => 'su',
                                    'maxBodySize' => 1,
                                    'origHeaders' => 'origHeaders',
                                ),
                                'actionStop' => array(
                                    'index' => 1,
                                ),
                            ),
                        ),
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyMailboxMetadataRequest()
    {
        $a = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Soap\Struct\MailCustomMetadata('section', array($a));
        $req = new \Zimbra\API\Mail\Request\ModifyMailboxMetadata(
            $meta
        );
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
        $addressBookTest = new \Zimbra\Soap\Struct\AddressBookTest(
            1, 'header', true
        );
        $addressTest = new \Zimbra\Soap\Struct\AddressTest(
            1, 'header', 'part', 'stringComparison', 'value', true, true
        );
        $attachmentTest = new \Zimbra\Soap\Struct\AttachmentTest(
            1, true
        );
        $bodyTest = new \Zimbra\Soap\Struct\BodyTest(
            1, 'value', true, true
        );
        $bulkTest = new \Zimbra\Soap\Struct\BulkTest(
            1, true
        );
        $contactRankingTest = new \Zimbra\Soap\Struct\ContactRankingTest(
            1, 'header', true
        );
        $conversationTest = new \Zimbra\Soap\Struct\ConversationTest(
            1, 'where', true
        );
        $currentDayOfWeekTest = new \Zimbra\Soap\Struct\CurrentDayOfWeekTest(
            1, 'value', true
        );
        $currentTimeTest = new \Zimbra\Soap\Struct\CurrentTimeTest(
            1, 'dateComparison', 'time', true
        );
        $dateTest = new \Zimbra\Soap\Struct\DateTest(
            1, 'dateComparison', 1, true
        );
        $facebookTest = new \Zimbra\Soap\Struct\FacebookTest(
            1, true
        );
        $flaggedTest = new \Zimbra\Soap\Struct\FlaggedTest(
            1, 'flagName', true
        );
        $headerExistsTest = new \Zimbra\Soap\Struct\HeaderExistsTest(
            1, 'header', true
        );
        $headerTest = new \Zimbra\Soap\Struct\HeaderTest(
            1, 'header', 'stringComparison', 'value', true, true
        );
        $importanceTest = new \Zimbra\Soap\Struct\ImportanceTest(
            1, Importance::HIGH(), true
        );
        $inviteTest = new \Zimbra\Soap\Struct\InviteTest(
            1, array('method'), true
        );
        $linkedinTest = new \Zimbra\Soap\Struct\LinkedInTest(
            1, true
        );
        $listTest = new \Zimbra\Soap\Struct\ListTest(
            1, true
        );
        $meTest = new \Zimbra\Soap\Struct\MeTest(
            1, 'header', true
        );
        $mimeHeaderTest = new \Zimbra\Soap\Struct\MimeHeaderTest(
            1, 'header', 'stringComparison', 'value', true, true
        );
        $sizeTest = new \Zimbra\Soap\Struct\SizeTest(
            1, 'numberComparison', 's', true
        );
        $socialcastTest = new \Zimbra\Soap\Struct\SocialcastTest(
            1, true
        );
        $trueTest = new \Zimbra\Soap\Struct\TrueTest(
            1, true
        );
        $twitterTest = new \Zimbra\Soap\Struct\TwitterTest(
            1, true
        );
        $filterTests = new \Zimbra\Soap\Struct\FilterTests(
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
        $actionKeep = new \Zimbra\Soap\Struct\KeepAction(
            1
        );
        $actionDiscard = new \Zimbra\Soap\Struct\DiscardAction(
            1
        );
        $actionFileInto = new \Zimbra\Soap\Struct\FileIntoAction(
            1, 'folderPath'
        );
        $actionFlag = new \Zimbra\Soap\Struct\FlagAction(
            1, 'flagName'
        );
        $actionTag = new \Zimbra\Soap\Struct\TagAction(
            1, 'tagName'
        );
        $actionRedirect = new \Zimbra\Soap\Struct\RedirectAction(
            1, 'a'
        );
        $actionReply = new \Zimbra\Soap\Struct\ReplyAction(
            1, 'content'
        );
        $actionNotify = new \Zimbra\Soap\Struct\NotifyAction(
            1, 'content', 'a', 'su', 1, 'origHeaders'
        );
        $actionStop = new \Zimbra\Soap\Struct\StopAction(
            1
        );
        $filterActions = new \Zimbra\Soap\Struct\FilterActions(
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
        $filterRule = new \Zimbra\Soap\Struct\FilterRule(
            'name', true, $filterTests, $filterActions
        );
        $filterRules = new \Zimbra\Soap\Struct\FilterRules(
            array($filterRule)
        );

        $req = new \Zimbra\API\Mail\Request\ModifyOutgoingFilterRules(
            $filterRules
        );
        $this->assertSame($filterRules, $req->filterRules());

        $req->filterRules($filterRules);
        $this->assertSame($filterRules, $req->filterRules());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyOutgoingFilterRulesRequest>'
                .'<filterRules>'
                    .'<filterRule name="name" active="1">'
                        .'<filterTests condition="allof">'
                            .'<addressBookTest index="1" negative="1" header="header" />'
                            .'<addressTest index="1" negative="1" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<attachmentTest index="1" negative="1" />'
                            .'<bodyTest index="1" negative="1" value="value" caseSensitive="1" />'
                            .'<bulkTest index="1" negative="1" />'
                            .'<contactRankingTest index="1" negative="1" header="header" />'
                            .'<conversationTest index="1" negative="1" where="where" />'
                            .'<currentDayOfWeekTest index="1" negative="1" value="value" />'
                            .'<currentTimeTest index="1" negative="1" dateComparison="dateComparison" time="time" />'
                            .'<dateTest index="1" negative="1" dateComparison="dateComparison" d="1" />'
                            .'<facebookTest index="1" negative="1" />'
                            .'<flaggedTest index="1" negative="1" flagName="flagName" />'
                            .'<headerExistsTest index="1" negative="1" header="header" />'
                            .'<headerTest index="1" negative="1" header="header" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<importanceTest index="1" negative="1" imp="high" />'
                            .'<inviteTest index="1" negative="1">'
                                .'<method>method</method>'
                            .'</inviteTest>'
                            .'<linkedinTest index="1" negative="1" />'
                            .'<listTest index="1" negative="1" />'
                            .'<meTest index="1" negative="1" header="header" />'
                            .'<mimeHeaderTest index="1" negative="1" header="header" stringComparison="stringComparison" value="value" caseSensitive="1" />'
                            .'<sizeTest index="1" negative="1" numberComparison="numberComparison" s="s" />'
                            .'<socialcastTest index="1" negative="1" />'
                            .'<trueTest index="1" negative="1" />'
                            .'<twitterTest index="1" negative="1" />'
                        .'</filterTests>'
                        .'<filterActions>'
                            .'<actionKeep index="1" />'
                            .'<actionDiscard index="1" />'
                            .'<actionFileInto index="1" folderPath="folderPath" />'
                            .'<actionFlag index="1" flagName="flagName" />'
                            .'<actionTag index="1" tagName="tagName" />'
                            .'<actionRedirect index="1" a="a" />'
                            .'<actionReply index="1">'
                                .'<content>content</content>'
                            .'</actionReply>'
                            .'<actionNotify index="1" a="a" su="su" maxBodySize="1" origHeaders="origHeaders">'
                                .'<content>content</content>'
                            .'</actionNotify>'
                            .'<actionStop index="1" />'
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
                            'active' => 1,
                            'filterTests' => array(
                                'condition' => 'allof',
                                'addressBookTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'addressTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'part' => 'part',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'attachmentTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'bodyTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'bulkTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'contactRankingTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'conversationTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'where' => 'where',
                                ),
                                'currentDayOfWeekTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'value' => 'value',
                                ),
                                'currentTimeTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'dateComparison' => 'dateComparison',
                                    'time' => 'time',
                                ),
                                'dateTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'dateComparison' => 'dateComparison',
                                    'd' => 1,
                                ),
                                'facebookTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'flaggedTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'flagName' => 'flagName',
                                ),
                                'headerExistsTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'headerTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'importanceTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'imp' => 'high',
                                ),
                                'inviteTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'method' => array(
                                        'method',
                                    ),
                                ),
                                'linkedinTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'listTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'meTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                ),
                                'mimeHeaderTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'header' => 'header',
                                    'stringComparison' => 'stringComparison',
                                    'value' => 'value',
                                    'caseSensitive' => 1,
                                ),
                                'sizeTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                    'numberComparison' => 'numberComparison',
                                    's' => 's',
                                ),
                                'socialcastTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'trueTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                                'twitterTest' => array(
                                    'index' => 1,
                                    'negative' => 1,
                                ),
                            ),
                            'filterActions' => array(
                                'actionKeep' => array(
                                    'index' => 1,
                                ),
                                'actionDiscard' => array(
                                    'index' => 1,
                                ),
                                'actionFileInto' => array(
                                    'index' => 1,
                                    'folderPath' => 'folderPath',
                                ),
                                'actionFlag' => array(
                                    'index' => 1,
                                    'flagName' => 'flagName',
                                ),
                                'actionTag' => array(
                                    'index' => 1,
                                    'tagName' => 'tagName',
                                ),
                                'actionRedirect' => array(
                                    'index' => 1,
                                    'a' => 'a',
                                ),
                                'actionReply' => array(
                                    'index' => 1,
                                    'content' => 'content',
                                ),
                                'actionNotify' => array(
                                    'index' => 1,
                                    'content' => 'content',
                                    'a' => 'a',
                                    'su' => 'su',
                                    'maxBodySize' => 1,
                                    'origHeaders' => 'origHeaders',
                                ),
                                'actionStop' => array(
                                    'index' => 1,
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
        $search = new \Zimbra\Soap\Struct\ModifySearchFolderSpec(
            'id', 'query', 'types', 'sortBy'
        );
        $req = new \Zimbra\API\Mail\Request\ModifySearchFolder(
            $search
        );
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
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $msg = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $msg, $cn, $doc, 'aid');
        $mp = new \Zimbra\Soap\Struct\MimePartInfo(array($info), $attach, 'ct', 'content', 'ci');
        $inv = new \Zimbra\Soap\Struct\InvitationInfo('method', 1, true);
        $e = new \Zimbra\Soap\Struct\EmailAddrInfo('a', 't', 'p');
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);

        $m = new \Zimbra\Soap\Struct\Msg(
            'aid',
            'origid',
            'rt',
            'idnt',
            'su',
            'irt',
            'l',
            'f',
            'content',
            array($header),
            $mp,
            $attach,
            $inv,
            array($e),
            array($tz),
            'fr'
        );

        $req = new \Zimbra\API\Mail\Request\ModifyTask(
            $m, 'id', 1, 1, 1, true, 1, true, true, true
        );
        $this->assertInstanceOf('Zimbra\API\Mail\Request\ModifyAppointment', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyTaskRequest id="id" comp="1" ms="1" rev="1" echo="1" max="1" html="1" neuter="1" forcesend="1">'
                .'<m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                    .'<content>content</content>'
                    .'<header name="name">value</header>'
                    .'<mp ct="ct" content="content" ci="ci">'
                        .'<mp ct="ct" content="content" ci="ci" />'
                        .'<attach aid="aid">'
                            .'<mp mid="mid" part="part" optional="1" />'
                            .'<m id="id" optional="0" />'
                            .'<cn id="id" optional="0" />'
                            .'<doc path="path" id="id" ver="1" optional="1" />'
                        .'</attach>'
                    .'</mp>'
                    .'<attach aid="aid">'
                        .'<mp mid="mid" part="part" optional="1" />'
                        .'<m id="id" optional="0" />'
                        .'<cn id="id" optional="0" />'
                        .'<doc path="path" id="id" ver="1" optional="1" />'
                    .'</attach>'
                    .'<inv method="method" compNum="1" rsvp="1" />'
                    .'<e a="a" t="t" p="p" />'
                    .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                        .'<standard mon="1" hour="2" min="3" sec="4" />'
                        .'<daylight mon="4" hour="3" min="2" sec="1" />'
                    .'</tz>'
                    .'<fr>fr</fr>'
                .'</m>'
            .'</ModifyTaskRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyTaskRequest' => array(
                'id' => 'id',
                'comp' => 1,
                'ms' => 1,
                'rev' => 1,
                'echo' => 1,
                'max' => 1,
                'html' => 1,
                'neuter' => 1,
                'forcesend' => 1,
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
                                'optional' => 1,
                            ),
                            'm' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'cn' => array(
                                'id' => 'id',
                                'optional' => 0,
                            ),
                            'doc' => array(
                                'path' => 'path',
                                'id' => 'id',
                                'ver' => 1,
                                'optional' => 1,
                            ),
                        ),
                    ),
                    'attach' => array(
                        'aid' => 'aid',
                        'mp' => array(
                            'mid' => 'mid',
                            'part' => 'part',
                            'optional' => 1,
                        ),
                        'm' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'cn' => array(
                            'id' => 'id',
                            'optional' => 0,
                        ),
                        'doc' => array(
                            'path' => 'path',
                            'id' => 'id',
                            'ver' => 1,
                            'optional' => 1,
                        ),
                    ),
                    'inv' => array(
                        'method' => 'method',
                        'compNum' => 1,
                        'rsvp' => 1,
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
                    'fr' => 'fr',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMsgAction()
    {
        $action = new \Zimbra\Soap\Struct\MsgActionSelector(
            MsgAction::MOVE(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn'
        );
        $req = new \Zimbra\API\Mail\Request\MsgAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MsgActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" />'
            .'</MsgActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MsgActionRequest' => array(
                'action' => array(
                    'op' => 'move',
                    'id' => 'id',
                    'tcon' => 'tcon',
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
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
        $req = new \Zimbra\API\Mail\Request\NoOp(
            true, true, true, 1
        );
        $this->assertTrue($req->wait());
        $this->assertTrue($req->delegate());
        $this->assertTrue($req->limitToOneBlocked());
        $this->assertSame(1, $req->timeout());

        $req->wait(true)
            ->delegate(true)
            ->limitToOneBlocked(true)
            ->timeout(1);
        $this->assertTrue($req->wait());
        $this->assertTrue($req->delegate());
        $this->assertTrue($req->limitToOneBlocked());
        $this->assertSame(1, $req->timeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoOpRequest wait="1" delegate="1" limitToOneBlocked="1" timeout="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoOpRequest' => array(
                'wait' => 1,
                'delegate' => 1,
                'limitToOneBlocked' => 1,
                'timeout' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoteAction()
    {
        $action = new \Zimbra\Soap\Struct\NoteActionSelector(
            ItemAction::MOVE(), 'id', 'tcon', 1, 'l', '#aabbcc', 1, 'name', 'f', 't', 'tn', 'content', 'pos'
        );
        $req = new \Zimbra\API\Mail\Request\NoteAction(
            $action
        );
        $this->assertSame($action, $req->action());

        $req->action($action);
        $this->assertSame($action, $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoteActionRequest>'
                .'<action op="move" id="id" tcon="tcon" tag="1" l="l" rgb="#aabbcc" color="1" name="name" f="f" t="t" tn="tn" content="content" pos="pos" />'
            .'</NoteActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoteActionRequest' => array(
                'action' => array(
                    'op' => 'move',
                    'id' => 'id',
                    'tcon' => 'tcon',
                    'tag' => 1,
                    'l' => 'l',
                    'rgb' => '#aabbcc',
                    'color' => 1,
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
        $revision = new \Zimbra\Soap\Struct\PurgeRevisionSpec(
            'id', 1, true
        );
        $req = new \Zimbra\API\Mail\Request\PurgeRevision(
            $revision
        );
        $this->assertSame($revision, $req->revision());

        $req->revision($revision);
        $this->assertSame($revision, $req->revision());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeRevisionRequest>'
                .'<revision id="id" ver="1" includeOlderRevisions="1" />'
            .'</PurgeRevisionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeRevisionRequest' => array(
                'revision' => array(
                    'id' => 'id',
                    'ver' => 1,
                    'includeOlderRevisions' => 1,
                )
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRankingAction()
    {
        $action = new \Zimbra\Soap\Struct\RankingActionSpec(
            RankingActionOp::RESET(), 'email'
        );
        $req = new \Zimbra\API\Mail\Request\RankingAction(
            $action
        );
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
        $device = new \Zimbra\Soap\Struct\NamedElement('name');
        $req = new \Zimbra\API\Mail\Request\RegisterDevice(
            $device
        );
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
        $m = new \Zimbra\Soap\Struct\MsgPartIds(
            'id', 'part'
        );
        $req = new \Zimbra\API\Mail\Request\RemoveAttachments(
            $m
        );
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
        $ace = new \Zimbra\Soap\Struct\AccountACEInfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false, true
        );
        $req = new \Zimbra\API\Mail\Request\RevokePermission(
            array($ace)
        );
        $this->assertSame(array($ace), $req->ace()->all());
        $req->addAce($ace);
        $this->assertSame(array($ace, $ace), $req->ace()->all());

        $req->ace()->remove(1);
        $xml = '<?xml version="1.0"?>'."\n"
            .'<RevokePermissionRequest>'
                .'<ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="0" chkgt="1" />'
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
                        'deny' => 0,
                        'chkgt' => 1,
                    ),
                ),
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDocument()
    {
        $upload = new \Zimbra\Soap\Struct\Id('id');
        $m = new \Zimbra\Soap\Struct\MessagePartSpec(
            'id', 'part'
        );
        $docVer = new \Zimbra\Soap\Struct\IdVersion(
            'id', 1
        );
        $doc = new \Zimbra\Soap\Struct\DocumentSpec(
            $upload, $m, $docVer, 'name', 'ct', 'desc', 'l', 'id', 1, 'content', true, 'f'
        );

        $req = new \Zimbra\API\Mail\Request\SaveDocument(
            $doc
        );
        $this->assertSame($doc, $req->doc());

        $req->doc($doc);
        $this->assertSame($doc, $req->doc());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDocumentRequest>'
                .'<doc name="name" ct="ct" desc="desc" l="l" id="id" ver="1" content="content" descEnabled="1" f="f">'
                    .'<upload id="id" />'
                    .'<m id="id" part="part" />'
                    .'<doc id="id" ver="1" />'
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
                    'ver' => 1,
                    'content' => 'content',
                    'descEnabled' => 1,
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
                        'ver' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSaveDraft()
    {
        $m = new \Zimbra\Soap\Struct\SaveDraftMsg(
            1, 'forAcct', 't', 'tn', '#aabbcc', 1, 1
        );
        $req = new \Zimbra\API\Mail\Request\SaveDraft(
            $m
        );
        $this->assertSame($m, $req->m());

        $req->m($m);
        $this->assertSame($m, $req->m());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SaveDraftRequest>'
                .'<m id="1" forAcct="forAcct" t="t" tn="tn" rgb="#aabbcc" color="1" autoSendTime="1" />'
            .'</SaveDraftRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SaveDraftRequest' => array(
                'm' => array(
                    'id' => 1,
                    'forAcct' => 'forAcct',
                    't' => 't',
                    'tn' => 'tn',
                    'rgb' => '#aabbcc',
                    'color' => 1,
                    'autoSendTime' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailSearchParams()
    {
        $header = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\API\Mail\Request\MailSearchParams(
            'query',
            array($header),
            $tz,
            'locale',
            $cursor,
            true,
            true,
            'allowableTaskStatus',
            1,
            1,
            true,
            'types',
            'groupBy',
            true,
            'sortBy',
            'fetch',
            true,
            1,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            1,
            1
        );
        $this->assertSame('query', $req->query());
        $this->assertSame(array($header), $req->header()->all());
        $this->assertSame($tz, $req->tz());
        $this->assertSame('locale', $req->locale());
        $this->assertSame($cursor, $req->cursor());
        $this->assertTrue($req->includeTagDeleted());
        $this->assertTrue($req->includeTagMuted());
        $this->assertSame('allowableTaskStatus', $req->allowableTaskStatus());
        $this->assertSame(1, $req->calExpandInstStart());
        $this->assertSame(1, $req->calExpandInstEnd());
        $this->assertTrue($req->inDumpster());
        $this->assertSame('types', $req->types());
        $this->assertSame('groupBy', $req->groupBy());
        $this->assertTrue($req->quick());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertSame('fetch', $req->fetch());
        $this->assertTrue($req->read());
        $this->assertSame(1, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->needExp());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->recip());
        $this->assertTrue($req->prefetch());
        $this->assertSame('resultMode', $req->resultMode());
        $this->assertSame('field', $req->field());
        $this->assertSame(1, $req->limit());
        $this->assertSame(1, $req->offset());

        $req->query('query')
            ->addHeader($header)
            ->tz($tz)
            ->locale('locale')
            ->cursor($cursor)
            ->includeTagDeleted(true)
            ->includeTagMuted(true)
            ->allowableTaskStatus('allowableTaskStatus')
            ->calExpandInstStart(1)
            ->calExpandInstEnd(1)
            ->inDumpster(true)
            ->types('types')
            ->groupBy('groupBy')
            ->quick(true)
            ->sortBy('sortBy')
            ->fetch('fetch')
            ->read(true)
            ->max(1)
            ->html(true)
            ->needExp(true)
            ->neuter(true)
            ->recip(true)
            ->prefetch(true)
            ->resultMode('resultMode')
            ->field('field')
            ->limit(1)
            ->offset(1);
        $this->assertSame('query', $req->query());
        $this->assertSame(array($header, $header), $req->header()->all());
        $this->assertSame($tz, $req->tz());
        $this->assertSame('locale', $req->locale());
        $this->assertSame($cursor, $req->cursor());
        $this->assertTrue($req->includeTagDeleted());
        $this->assertTrue($req->includeTagMuted());
        $this->assertSame('allowableTaskStatus', $req->allowableTaskStatus());
        $this->assertSame(1, $req->calExpandInstStart());
        $this->assertSame(1, $req->calExpandInstEnd());
        $this->assertTrue($req->inDumpster());
        $this->assertSame('types', $req->types());
        $this->assertSame('groupBy', $req->groupBy());
        $this->assertTrue($req->quick());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertSame('fetch', $req->fetch());
        $this->assertTrue($req->read());
        $this->assertSame(1, $req->max());
        $this->assertTrue($req->html());
        $this->assertTrue($req->needExp());
        $this->assertTrue($req->neuter());
        $this->assertTrue($req->recip());
        $this->assertTrue($req->prefetch());
        $this->assertSame('resultMode', $req->resultMode());
        $this->assertSame('field', $req->field());
        $this->assertSame(1, $req->limit());
        $this->assertSame(1, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MailSearchParamsRequest includeTagDeleted="1" includeTagMuted="1" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="1" calExpandInstEnd="1" inDumpster="1" types="types" groupBy="groupBy" quick="1" sortBy="sortBy" fetch="fetch" read="1" max="1" html="1" needExp="1" neuter="1" recip="1" prefetch="1" resultMode="resultMode" field="field" limit="1" offset="1">'
                .'<query>query</query>'
                .'<header n="attribute-name" />'
                .'<header n="attribute-name" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />'
            .'</MailSearchParamsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MailSearchParamsRequest' => array(
                'query' => 'query',
                'header' => array(
                    array(
                        'n' => 'attribute-name',
                    ),
                    array(
                        'n' => 'attribute-name',
                    ),
                ),
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => 1,
                ),
                'includeTagDeleted' => 1,
                'includeTagMuted' => 1,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 1,
                'calExpandInstEnd' => 1,
                'inDumpster' => 1,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => 1,
                'sortBy' => 'sortBy',
                'fetch' => 'fetch',
                'read' => 1,
                'max' => 1,
                'html' => 1,
                'needExp' => 1,
                'neuter' => 1,
                'recip' => 1,
                'prefetch' => 1,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 1,
                'offset' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearch()
    {
        $header = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\API\Mail\Request\Search(
            true,
            'query',
            array($header),
            $tz,
            'locale',
            $cursor,
            true,
            true,
            'allowableTaskStatus',
            1,
            1,
            true,
            'types',
            'groupBy',
            true,
            'sortBy',
            'fetch',
            true,
            1,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            1,
            1
        );
        $this->assertTrue($req->warmup());
        $req->warmup(true);
        $this->assertTrue($req->warmup());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchRequest warmup="1" includeTagDeleted="1" includeTagMuted="1" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="1" calExpandInstEnd="1" inDumpster="1" types="types" groupBy="groupBy" quick="1" sortBy="sortBy" fetch="fetch" read="1" max="1" html="1" needExp="1" neuter="1" recip="1" prefetch="1" resultMode="resultMode" field="field" limit="1" offset="1">'
                .'<query>query</query>'
                .'<header n="attribute-name" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />'
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => 1,
                ),
                'warmup' => 1,
                'includeTagDeleted' => 1,
                'includeTagMuted' => 1,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 1,
                'calExpandInstEnd' => 1,
                'inDumpster' => 1,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => 1,
                'sortBy' => 'sortBy',
                'fetch' => 'fetch',
                'read' => 1,
                'max' => 1,
                'html' => 1,
                'needExp' => 1,
                'neuter' => 1,
                'recip' => 1,
                'prefetch' => 1,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 1,
                'offset' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchConv()
    {
        $header = new \Zimbra\Soap\Struct\AttributeName('attribute-name');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $cursor = new \Zimbra\Soap\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $req = new \Zimbra\API\Mail\Request\SearchConv(
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
            1,
            1,
            true,
            'types',
            'groupBy',
            true,
            'sortBy',
            'fetch',
            true,
            1,
            true,
            true,
            true,
            true,
            true,
            'resultMode',
            'field',
            1,
            1
        );
        $this->assertSame('cid', $req->cid());
        $this->assertTrue($req->nest());
        $req->cid('cid')
            ->nest(true);
        $this->assertSame('cid', $req->cid());
        $this->assertTrue($req->nest());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchConvRequest cid="cid" nest="1" includeTagDeleted="1" includeTagMuted="1" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="1" calExpandInstEnd="1" inDumpster="1" types="types" groupBy="groupBy" quick="1" sortBy="sortBy" fetch="fetch" read="1" max="1" html="1" needExp="1" neuter="1" recip="1" prefetch="1" resultMode="resultMode" field="field" limit="1" offset="1">'
                .'<query>query</query>'
                .'<header n="attribute-name" />'
                .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                    .'<standard mon="1" hour="2" min="3" sec="4" />'
                    .'<daylight mon="4" hour="3" min="2" sec="1" />'
                .'</tz>'
                .'<locale>locale</locale>'
                .'<cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="1" />'
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
                'locale' => 'locale',
                'cursor' => array(
                    'id' => 'id',
                    'sortVal' => 'sortVal',
                    'endSortVal' => 'endSortVal',
                    'includeOffset' => 1,
                ),
                'cid' => 'cid',
                'nest' => 1,
                'includeTagDeleted' => 1,
                'includeTagMuted' => 1,
                'allowableTaskStatus' => 'allowableTaskStatus',
                'calExpandInstStart' => 1,
                'calExpandInstEnd' => 1,
                'inDumpster' => 1,
                'types' => 'types',
                'groupBy' => 'groupBy',
                'quick' => 1,
                'sortBy' => 'sortBy',
                'fetch' => 'fetch',
                'read' => 1,
                'max' => 1,
                'html' => 1,
                'needExp' => 1,
                'neuter' => 1,
                'recip' => 1,
                'prefetch' => 1,
                'resultMode' => 'resultMode',
                'field' => 'field',
                'limit' => 1,
                'offset' => 1,
            )
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSendDeliveryReport()
    {
        $req = new \Zimbra\API\Mail\Request\SendDeliveryReport(
            'mid'
        );
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
}
