<?php

namespace Zimbra\Tests\API;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\BrowseBy;
use Zimbra\Soap\Enum\ContactAction;
use Zimbra\Soap\Enum\ConvAction;
use Zimbra\Soap\Enum\GalSearchType;
use Zimbra\Soap\Enum\GranteeType;
use Zimbra\Soap\Enum\InterestType;
use Zimbra\Soap\Enum\MdsConnectionType;
use Zimbra\Soap\Enum\ParticipationStatus;
use Zimbra\Soap\Enum\SearchType;
use Zimbra\Soap\Enum\TargetType;

/**
 * Testcase class for account api soap request.
 */
class MailRequestTest extends ZimbraTestCase
{
    public function testAddAppointmentInvite()
    {
        $mp = new \Zimbra\Soap\Struct\MimePartAttachSpec('mid', 'part', true);
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
        $m = new \Zimbra\Soap\Struct\MsgAttachSpec('id', false);
        $cn = new \Zimbra\Soap\Struct\ContactAttachSpec('id', false);
        $doc = new \Zimbra\Soap\Struct\DocAttachSpec('path', 'id', 1, true);
        $info = new \Zimbra\Soap\Struct\MimePartInfo(array(), null, 'ct', 'content', 'ci');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);

        $header = new \Zimbra\Soap\Struct\Header('name', 'value');
        $attach = new \Zimbra\Soap\Struct\AttachmentsInfo($mp, $m, $cn, $doc, 'aid');
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
}
