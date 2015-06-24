<?php

namespace Zimbra\Tests\Mail;

use Zimbra\Tests\ZimbraTestCase;

use Zimbra\Mail\MailFactory;

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

use Zimbra\Tests\Soap\LocalClientWsdl;
use Zimbra\Tests\Soap\LocalClientHttp;
use Zimbra\Mail\Base as MailBase;

/**
 * Api test case class for mail request.
 */
class ApiTest extends ZimbraTestCase
{
    private $_api;

    public function __construct()
    {
        parent::__construct();
        $this->_api = new LocalMailHttp(null);
    }

    public function testMailFactory()
    {
        $httpApi = MailFactory::instance();
        $this->assertInstanceOf('\Zimbra\Mail\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Mail\Http', $httpApi);
    }

    public function testAddAppointmentInvite()
    {
        $m = $this->getMsg();

        $this->_api->addAppointmentInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddAppointmentInviteRequest ptst="NE">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:AddAppointmentInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddComment()
    {
        $comment = new \Zimbra\Mail\Struct\AddedComment('parentId', 'text');

        $this->_api->addComment(
            $comment
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddCommentRequest>'
                        .'<urn1:comment parentId="parentId" text="text" />'
                    .'</urn1:AddCommentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddMsg()
    {
        $m = new \Zimbra\Mail\Struct\AddMsgSpec(
            'content', 'f', 't', 'tn', 'l', true, 'd', 'aid'
        );

        $this->_api->addMsg(
            $m, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddMsgRequest filterSent="true">'
                        .'<urn1:m f="f" t="t" tn="tn" l="l" noICal="true" d="d" aid="aid">'
                            .'<urn1:content>content</urn1:content>'
                        .'</urn1:m>'
                    .'</urn1:AddMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddTaskInvite()
    {
        $m = $this->getMsg();

        $this->_api->addTaskInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AddTaskInviteRequest ptst="NE">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:AddTaskInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAnnounceOrganizerChange()
    {
        $this->_api->announceOrganizerChange(
           'id'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AnnounceOrganizerChangeRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testApplyFilterRules()
    {
        $filterRule = new \Zimbra\Struct\NamedElement('name');
        $filterRules = new \Zimbra\Mail\Struct\NamedFilterRules(array($filterRule));
        $m = new \Zimbra\Mail\Struct\IdsAttr('ids');

        $this->_api->applyFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ApplyFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="name" />'
                        .'</urn1:filterRules>'
                        .'<urn1:m ids="ids" />'
                        .'<urn1:query>query</urn1:query>'
                    .'</urn1:ApplyFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testApplyOutgoingFilterRules()
    {
        $filterRule = new \Zimbra\Struct\NamedElement('name');
        $filterRules = new \Zimbra\Mail\Struct\NamedFilterRules(array($filterRule));
        $m = new \Zimbra\Mail\Struct\IdsAttr('ids');

        $this->_api->applyOutgoingFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ApplyOutgoingFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="name" />'
                        .'</urn1:filterRules>'
                        .'<urn1:m ids="ids" />'
                        .'<urn1:query>query</urn1:query>'
                    .'</urn1:ApplyOutgoingFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoComplete()
    {
        $this->_api->autoComplete(
           'name', GalSearchType::ALL(), true, 'folders', true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:AutoCompleteRequest name="name" t="all" needExp="true" folders="folders" includeGal="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testBounceMsg()
    {
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');
        $m = new \Zimbra\Mail\Struct\BounceMsgSpec('id', array($e));

        $this->_api->bounceMsg(
           $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:BounceMsgRequest>'
                        .'<urn1:m id="id">'
                            .'<urn1:e a="a" t="t" p="p" />'
                        .'</urn1:m>'
                    .'</urn1:BounceMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testBrowse()
    {
        $this->_api->browse(
           BrowseBy::DOMAINS(), 'regex', 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:BrowseRequest browseBy="domains" regex="regex" maxToReturn="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCancelAppointment()
    {
        $tz = $this->getTz();
        $inst = new \Zimbra\Mail\Struct\InstanceRecurIdInfo('range', '20130315T18302305Z', 'tz');
        $m = $this->getMsg();

        $this->_api->cancelAppointment(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CancelAppointmentRequest id="id" comp="10" ms="10" rev="10">'
                        .'<urn1:inst range="range" d="20130315T18302305Z" tz="tz" />'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CancelAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCancelTask()
    {
        $tz = $this->getTz();
        $inst = new \Zimbra\Mail\Struct\InstanceRecurIdInfo('range', '20130315T18302305Z', 'tz');
        $m = $this->getMsg();

        $this->_api->cancelTask(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CancelTaskRequest id="id" comp="10" ms="10" rev="10">'
                        .'<urn1:inst range="range" d="20130315T18302305Z" tz="tz" />'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CancelTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckDeviceStatus()
    {
        $device = new \Zimbra\Struct\Id('id');

        $this->_api->checkDeviceStatus(
           $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckDeviceStatusRequest>'
                        .'<urn1:device id="id" />'
                    .'</urn1:CheckDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckPermission()
    {
        $target = new \Zimbra\Mail\Struct\TargetSpec(
            TargetType::ACCOUNT(), AccountBy::NAME(), 'value'
        );

        $this->_api->checkPermission(
           $target, array('right')
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckPermissionRequest>'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:right>right</urn1:right>'
                    .'</urn1:CheckPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->checkRecurConflicts(
           array($tz), $cancel, $comp, $except, array($usr), 10, 10, true, 'excludeUid'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckRecurConflictsRequest s="10" e="10" all="true" excludeUid="excludeUid">'
                        .'<urn1:cancel s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:cancel>'
                        .'<urn1:comp s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:comp>'
                        .'<urn1:except s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:except>'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:usr l="10" id="id" name="name" />'
                    .'</urn1:CheckRecurConflictsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckSpelling()
    {
        $this->_api->checkSpelling(
           'value', 'dictionary', 'ignore'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckSpellingRequest dictionary="dictionary" ignore="ignore">value</urn1:CheckSpellingRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCompleteTaskInstance()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();

        $this->_api->completeTaskInstance(
           'id', $exceptId, $tz
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CompleteTaskInstanceRequest id="id">'
                        .'<urn1:exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                    .'</urn1:CompleteTaskInstanceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testContactAction()
    {
        $a = new \Zimbra\Mail\Struct\NewContactAttr(
            'n', 'value', 'aid', 10, 'part'
        );
        $action = new \Zimbra\Mail\Struct\ContactActionSelector(
            ContactActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', array($a)
        );

        $this->_api->contactAction(
           $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ContactActionRequest>'
                        .'<urn1:action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                            .'<urn1:a n="n" aid="aid" id="10" part="part">value</urn1:a>'
                        .'</urn1:action>'
                    .'</urn1:ContactActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testConvAction()
    {
        $action = new \Zimbra\Mail\Struct\ConvActionSelector(
            ConvActionOp::DELETE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );

        $this->_api->convAction(
           $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ConvActionRequest>'
                        .'<urn1:action op="delete" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
                    .'</urn1:ConvActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCounterAppointment()
    {
        $m = $this->getMsg();

        $this->_api->counterAppointment(
            $m, 'id', 10, 10, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CounterAppointmentRequest id="id" comp="10" ms="10" rev="10">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CounterAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateAppointment()
    {
        $m = $this->getMsg();

        $this->_api->createAppointment(
            $m, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateAppointmentRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CreateAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateAppointmentException()
    {
        $m = $this->getMsg();

        $this->_api->createAppointmentException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateAppointmentExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CreateAppointmentExceptionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateContact()
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

        $this->_api->createContact(
           $cn, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateContactRequest verbose="true">'
                        .'<urn1:cn id="10" l="l" t="t" tn="tn">'
                            .'<urn1:vcard mid="mid" part="part" aid="aid">value</urn1:vcard>'
                            .'<urn1:a n="n" aid="aid" id="10" part="part">value</urn1:a>'
                            .'<urn1:m type="type" value="value" />'
                        .'</urn1:cn>'
                    .'</urn1:CreateContactRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->createImapDataSource(
           $imap
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                        .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                        .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                        .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                        .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                            .'<urn1:lastError>lastError</urn1:lastError>'
                            .'<urn1:a>a</urn1:a>'
                            .'<urn1:a>b</urn1:a>'
                        .'</urn1:imap>'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createPop3DataSource(
           $pop3
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createCaldavDataSource(
           $caldav
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createYabDataSource(
           $yab
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createRssDataSource(
           $rss
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createGalDataSource(
           $gal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createCalDataSource(
           $cal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->createUnknownDataSource(
           $unknown
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->createFolder(
           $folder
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateFolderRequest>'
                        .'<urn1:folder name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" sync="true">'
                            .'<urn1:acl>'
                                .'<urn1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'</urn1:acl>'
                        .'</urn1:folder>'
                    .'</urn1:CreateFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateMountpoint()
    {
        $link = new \Zimbra\Mail\Struct\NewMountpointSpec(
            'name', SearchType::TASK(), 'f', 10, '#aabbcc', 'url', 'l', true, true, 'zid', 'owner', 10, 'path'
        );

        $this->_api->createMountpoint(
           $link
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateMountpointRequest>'
                        .'<urn1:link name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" reminder="true" zid="zid" owner="owner" rid="10" path="path" />'
                    .'</urn1:CreateMountpointRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateNote()
    {
        $note = new \Zimbra\Mail\Struct\NewNoteSpec(
            'l', 'content', 10, 'pos'
        );

        $this->_api->createNote(
           $note
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateNoteRequest>'
                        .'<urn1:note l="l" content="content" color="10" pos="pos" />'
                    .'</urn1:CreateNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateSearchFolder()
    {
        $search = new \Zimbra\Mail\Struct\NewSearchFolderSpec(
            'name', 'query', 'types', 'sortBy', 'f', 10, 'l'
        );

        $this->_api->createSearchFolder(
           $search
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateSearchFolderRequest>'
                        .'<urn1:search name="name" query="query" types="types" sortBy="sortBy" f="f" color="10" l="l" />'
                    .'</urn1:CreateSearchFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateTag()
    {
        $tag = new \Zimbra\Mail\Struct\TagSpec(
            'name', '#aabbcc', 10
        );

        $this->_api->createTag(
           $tag
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateTagRequest>'
                        .'<urn1:tag name="name" rgb="#aabbcc" color="10" />'
                    .'</urn1:CreateTagRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateTask()
    {
        $m = $this->getMsg();

        $this->_api->createTask(
            $m, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateTaskRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CreateTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateTaskException()
    {
        $m = $this->getMsg();

        $this->_api->createTaskException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateTaskExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:CreateTaskExceptionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateWaitSet()
    {
        $a = new \Zimbra\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $add = new \Zimbra\Struct\WaitSetSpec(array($a));

        $this->_api->createWaitSet(
            $add, array(InterestType::FOLDERS()), true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateWaitSetRequest defTypes="f" allAccounts="true">'
                        .'<urn1:add>'
                            .'<urn1:a name="name" id="id" token="token" types="f" />'
                        .'</urn1:add>'
                    .'</urn1:CreateWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeclineCounterAppointment()
    {
        $m = $this->getMsg();

        $this->_api->declineCounterAppointment(
            $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeclineCounterAppointmentRequest>'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:DeclineCounterAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->deleteDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeleteDataSourceRequest>'
                        .'<urn1:imap name="name" id="id" />'
                        .'<urn1:pop3 name="name" id="id" />'
                        .'<urn1:caldav name="name" id="id" />'
                        .'<urn1:yab name="name" id="id" />'
                        .'<urn1:rss name="name" id="id" />'
                        .'<urn1:gal name="name" id="id" />'
                        .'<urn1:cal name="name" id="id" />'
                        .'<urn1:unknown name="name" id="id" />'
                    .'</urn1:DeleteDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDevice()
    {
        $device = new \Zimbra\Struct\Id('id');

        $this->_api->deleteDevice(
            $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeleteDeviceRequest>'
                        .'<urn1:device id="id" />'
                    .'</urn1:DeleteDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDestroyWaitSet()
    {
        $this->_api->destroyWaitSet(
            'waitSet'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DestroyWaitSetRequest waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDiffDocument()
    {
        $doc = new \Zimbra\Mail\Struct\DiffDocumentVersionSpec('id', 3, 2);

        $this->_api->diffDocument(
            $doc
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DiffDocumentRequest>'
                        .'<urn1:doc id="id" v1="3" v2="2" />'
                    .'</urn1:DiffDocumentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDismissCalendarItemAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\DismissAppointmentAlarm('id', 10);
        $task = new \Zimbra\Mail\Struct\DismissTaskAlarm('id', 10);

        $this->_api->dismissCalendarItemAlarm(
            $appt, $task
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DismissCalendarItemAlarmRequest>'
                        .'<urn1:appt id="id" dismissedAt="10" />'
                        .'<urn1:task id="id" dismissedAt="10" />'
                    .'</urn1:DismissCalendarItemAlarmRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDocumentAction()
    {
        $grant = new \Zimbra\Mail\Struct\DocumentActionGrant(
            DocumentPermission::READ(), DocumentGrantType::ALL(), 10
        );
        $action = new \Zimbra\Mail\Struct\DocumentActionSelector(
            DocumentActionOp::WATCH(), $grant, 'zid', 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );

        $this->_api->documentAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DocumentActionRequest>'
                        .'<urn1:action op="watch" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" zid="zid">'
                            .'<urn1:grant perm="r" gt="all" expiry="10" />'
                        .'</urn1:action>'
                    .'</urn1:DocumentActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testEmptyDumpster()
    {
        $this->_api->emptyDumpster();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:EmptyDumpsterRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testEnableSharedReminder()
    {
        $link = new \Zimbra\Mail\Struct\SharedReminderMount(
            'id', true
        );

        $this->_api->enableSharedReminder(
           $link
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:EnableSharedReminderRequest>'
                        .'<urn1:link id="id" reminder="true" />'
                    .'</urn1:EnableSharedReminderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->expandRecur(
           10, 10, array($tz), $comp, $except, $cancel
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ExpandRecurRequest s="10" e="10">'
                        .'<urn1:comp s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:comp>'
                        .'<urn1:except s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:except>'
                        .'<urn1:cancel s="10" e="10">'
                            .'<urn1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<urn1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<urn1:recur />'
                        .'</urn1:cancel>'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                    .'</urn1:ExpandRecurRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testExportContacts()
    {
        $this->_api->exportContacts(
            'ct', 'l', 'csvfmt', 'csvlocale', 'csvsep'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ExportContactsRequest ct="ct" l="l" csvfmt="csvfmt" csvlocale="csvlocale" csvsep="csvsep" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->folderAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:FolderActionRequest>'
                        .'<urn1:action op="read" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" recursive="true" url="url" excludeFreeBusy="true" zid="zid" gt="gt" view="view">'
                            .'<urn1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'<urn1:acl>'
                                .'<urn1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'</urn1:acl>'
                            .'<urn1:retentionPolicy>'
                                .'<urn1:keep>'
                                    .'<urn1:policy type="system" id="id" name="name" lifetime="lifetime" />'
                                .'</urn1:keep>'
                                .'<urn1:purge>'
                                    .'<urn1:policy type="user" id="id" name="name" lifetime="lifetime" />'
                                .'</urn1:purge>'
                            .'</urn1:retentionPolicy>'
                        .'</urn1:action>'
                    .'</urn1:FolderActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testForwardAppointment()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();
        $m = $this->getMsg();

        $this->_api->forwardAppointment(
            $exceptId, $tz, $m, 'id'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ForwardAppointmentRequest id="id">'
                        .'<urn1:exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:ForwardAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testForwardAppointmentInvite()
    {
        $m = $this->getMsg();

        $this->_api->forwardAppointmentInvite(
            $m, 'id'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ForwardAppointmentInviteRequest id="id">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:ForwardAppointmentInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGenerateUUID()
    {
        $this->_api->generateUUID();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GenerateUUIDRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetActivityStream()
    {
        $filter = new \Zimbra\Mail\Struct\ActivityFilter(
            'account', 'op', 'session'
        );

        $this->_api->getActivityStream('id', $filter, 10, 10);

        $client = $this->_api->client('id', $filter, 10, 10);
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetActivityStreamRequest id="id" offset="10" limit="10">'
                        .'<urn1:filter account="account" op="op" session="session" />'
                    .'</urn1:GetActivityStreamRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllDevices()
    {
        $this->_api->getAllDevices();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetAllDevicesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAppointment()
    {
        $this->_api->getAppointment(true, true, 'uid', 'id');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetAppointmentRequest sync="true" includeContent="true" uid="uid" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetApptSummaries()
    {
        $this->_api->getApptSummaries(10, 10, 'folder-id');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetApptSummariesRequest s="10" e="10" l="folder-id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCalendarItemSummaries()
    {
        $this->_api->getCalendarItemSummaries(10, 10, 'folder-id');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCalendarItemSummariesRequest s="10" e="10" l="folder-id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetComments()
    {
        $comment = new \Zimbra\Mail\Struct\ParentId(
            'parentId'
        );

        $this->_api->getComments(
            $comment
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCommentsRequest>'
                        .'<urn1:comment parentId="parentId" />'
                    .'</urn1:GetCommentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetContacts()
    {
        $a = new \Zimbra\Struct\AttributeName('attribute-name');
        $ma = new \Zimbra\Struct\AttributeName('attribute-name');
        $cn = new \Zimbra\Struct\Id('id');

        $this->_api->getContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetContactsRequest sync="true" l="folder-id" sortBy="sort-by" derefGroupMember="true" returnHiddenAttrs="true" maxMembers="10">'
                        .'<urn1:a n="attribute-name" />'
                        .'<urn1:ma n="attribute-name" />'
                        .'<urn1:cn id="id" />'
                    .'</urn1:GetContactsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetConv()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $c = new \Zimbra\Mail\Struct\ConversationSpec(
            'id', array($header), 'fetch', true, 10
        );

        $this->_api->getConv(
            $c
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetConvRequest>'
                        .'<urn1:c id="id" fetch="fetch" html="true" max="10">'
                            .'<urn1:header n="attribute-name" />'
                        .'</urn1:c>'
                    .'</urn1:GetConvRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCustomMetadata()
    {
        $meta = new \Zimbra\Mail\Struct\SectionAttr('section');

        $this->_api->getCustomMetadata(
            'id', $meta
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetCustomMetadataRequest id="id">'
                        .'<urn1:meta section="section" />'
                    .'</urn1:GetCustomMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDataSources()
    {
        $this->_api->getDataSources();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetDataSourcesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDocumentShareURL()
    {
        $item = new \Zimbra\Mail\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );

        $this->_api->getDocumentShareURL(
            $item
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetDocumentShareURLRequest>'
                        .'<urn1:item id="id" l="l" name="name" path="path" />'
                    .'</urn1:GetDocumentShareURLRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetEffectiveFolderPerms()
    {
        $folder = new \Zimbra\Mail\Struct\FolderSpec(
            'l'
        );

        $this->_api->getEffectiveFolderPerms(
            $folder
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetEffectiveFolderPermsRequest>'
                        .'<urn1:folder l="l" />'
                    .'</urn1:GetEffectiveFolderPermsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetFilterRules()
    {
        $this->_api->getFilterRules();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetFilterRulesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetFolder()
    {
        $folder = new \Zimbra\Mail\Struct\GetFolderSpec(
            'uuid', 'l', 'path'
        );

        $this->_api->getFolder(
            $folder, true, true, 'view', 10, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetFolderRequest visible="true" needGranteeName="true" view="view" depth="10" tr="true">'
                        .'<urn1:folder uuid="uuid" l="l" path="path" />'
                    .'</urn1:GetFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetFreeBusy()
    {
        $usr = new \Zimbra\Mail\Struct\FreeBusyUserSpec(
            10, 'id', 'name'
        );

        $this->_api->getFreeBusy(
            10, 10, 'uid', 'id', 'name', 'excludeUid', array($usr)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetFreeBusyRequest s="10" e="10" uid="uid" id="id" name="name" excludeUid="excludeUid">'
                        .'<urn1:usr l="10" id="id" name="name" />'
                    .'</urn1:GetFreeBusyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetICal()
    {
        $this->_api->getICal(
            'id', 10, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetICalRequest id="id" s="10" e="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetImportStatus()
    {
        $this->_api->getImportStatus();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetImportStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetItem()
    {
        $item = new \Zimbra\Mail\Struct\ItemSpec(
            'id', 'l', 'name', 'path'
        );

        $this->_api->getItem(
            $item
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetItemRequest>'
                        .'<urn1:item id="id" l="l" name="name" path="path" />'
                    .'</urn1:GetItemRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailboxMetadata()
    {
        $meta = new \Zimbra\Mail\Struct\SectionAttr('section');

        $this->_api->getMailboxMetadata(
            $meta
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMailboxMetadataRequest>'
                        .'<urn1:meta section="section" />'
                    .'</urn1:GetMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMiniCal()
    {
        $tz = $this->getTz();
        $folder = new \Zimbra\Struct\Id('id');

        $this->_api->getMiniCal(
            10, 10, array($folder), $tz
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMiniCalRequest s="10" e="10">'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:folder id="id" />'
                    .'</urn1:GetMiniCalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMsg()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $m = new \Zimbra\Mail\Struct\MsgSpec(
            'id', array($header), 'part', true, true, 10, true, true, 'ridZ', true
        );

        $this->_api->getMsg(
            $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMsgRequest>'
                        .'<urn1:m id="id" part="part" raw="true" read="true" max="10" html="true" neuter="true" ridZ="ridZ" needExp="true">'
                            .'<urn1:header n="attribute-name" />'
                        .'</urn1:m>'
                    .'</urn1:GetMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMsgMetadata()
    {
        $m = new \Zimbra\Mail\Struct\IdsAttr(
            'ids'
        );

        $this->_api->getMsgMetadata(
            $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetMsgMetadataRequest>'
                        .'<urn1:m ids="ids" />'
                    .'</urn1:GetMsgMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetNote()
    {
        $note = new \Zimbra\Struct\Id('id');

        $this->_api->getNote(
            $note
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetNoteRequest>'
                        .'<urn1:note id="id" />'
                    .'</urn1:GetNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetNotifications()
    {
        $this->_api->getNotifications(
            true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetNotificationsRequest markSeen="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetOutgoingFilterRules()
    {
        $this->_api->getOutgoingFilterRules();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetOutgoingFilterRulesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetPermission()
    {
        $ace = new \Zimbra\Mail\Struct\Right('right');

        $this->_api->getPermission(
            array($ace)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetPermissionRequest>'
                        .'<urn1:ace right="right" />'
                    .'</urn1:GetPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRecur()
    {
        $this->_api->getRecur(
            'id'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetRecurRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSearchFolder()
    {
        $this->_api->getSearchFolder();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetSearchFolderRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareDetails()
    {
        $item = new \Zimbra\Struct\Id('id');

        $this->_api->getShareDetails(
            $item
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetShareDetailsRequest>'
                        .'<urn1:item id="id" />'
                    .'</urn1:GetShareDetailsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareNotifications()
    {
        $this->_api->getShareNotifications();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetShareNotificationsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSpellDictionaries()
    {
        $this->_api->getSpellDictionaries();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetSpellDictionariesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSystemRetentionPolicy()
    {
        $this->_api->getSystemRetentionPolicy();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetSystemRetentionPolicyRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetTag()
    {
        $this->_api->getTag();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetTagRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetTask()
    {
        $this->_api->getTask(true, true, 'uid', 'id');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetTaskRequest sync="true" includeContent="true" uid="uid" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetTaskSummaries()
    {
        $this->_api->getTaskSummaries(10, 10, 'l');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetTaskSummariesRequest s="10" e="10" l="l" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetWatchers()
    {
        $this->_api->getWatchers();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWatchersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetWatchingItems()
    {
        $this->_api->getWatchingItems();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWatchingItemsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetWorkingHours()
    {
        $this->_api->getWorkingHours(10, 10, 'id', 'name');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetWorkingHoursRequest s="10" e="10" id="id" name="name" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetYahooAuthToken()
    {
        $this->_api->getYahooAuthToken('user', 'password');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetYahooAuthTokenRequest user="user" password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetYahooCookie()
    {
        $this->_api->getYahooCookie('user');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GetYahooCookieRequest user="user" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGrantPermission()
    {
        $ace = new \Zimbra\Mail\Struct\AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false
        );

        $this->_api->grantPermission(array($ace));

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:GrantPermissionRequest>'
                        .'<urn1:ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="false" />'
                    .'</urn1:GrantPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testICalReply()
    {
        $this->_api->iCalReply('ical');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ICalReplyRequest>'
                        .'<urn1:ical>ical</urn1:ical>'
                    .'</urn1:ICalReplyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testImportAppointments()
    {
        $content = new \Zimbra\Mail\Struct\ContentSpec(
            'value', 'aid', 'mid', 'part'
        );

        $this->_api->importAppointments($content, 'ct', 'l');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportAppointmentsRequest ct="ct" l="l">'
                        .'<urn1:content aid="aid" mid="mid" part="part">value</urn1:content>'
                    .'</urn1:ImportAppointmentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testImportContacts()
    {
        $content = new \Zimbra\Mail\Struct\Content(
            'value', 'aid'
        );

        $this->_api->importContacts(
            $content, 'ct', 'l', 'csvfmt', 'csvlocale'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportContactsRequest ct="ct" l="l" csvfmt="csvfmt" csvlocale="csvlocale">'
                        .'<urn1:content aid="aid">value</urn1:content>'
                    .'</urn1:ImportContactsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->importData(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ImportDataRequest>'
                        .'<urn1:imap name="name" id="id" />'
                        .'<urn1:pop3 name="name" id="id" />'
                        .'<urn1:caldav name="name" id="id" />'
                        .'<urn1:yab name="name" id="id" />'
                        .'<urn1:rss name="name" id="id" />'
                        .'<urn1:gal name="name" id="id" />'
                        .'<urn1:cal name="name" id="id" />'
                        .'<urn1:unknown name="name" id="id" />'
                    .'</urn1:ImportDataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testInvalidateReminderDevice()
    {
        $this->_api->invalidateReminderDevice('email');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:InvalidateReminderDeviceRequest a="email" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testItemActionOp()
    {
        $action = new \Zimbra\Mail\Struct\ItemActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );


        $this->_api->itemAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ItemActionRequest>'
                        .'<urn1:action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
                    .'</urn1:ItemActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testListDocumentRevisions()
    {
        $doc = new \Zimbra\Mail\Struct\ListDocumentRevisionsSpec(
            'id', 10, 10
        );

        $this->_api->listDocumentRevisions(
            $doc
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ListDocumentRevisionsRequest>'
                        .'<urn1:doc id="id" ver="10" count="10" />'
                    .'</urn1:ListDocumentRevisionsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyAppointment()
    {
        $m = $this->getMsg();

        $this->_api->modifyAppointment(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyAppointmentRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:ModifyAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyContact(
            $cn, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyContactRequest replace="true" verbose="true">'
                        .'<urn1:cn id="10" tn="tn">'
                            .'<urn1:a n="n" aid="aid" id="10" part="part" op="op">value</urn1:a>'
                            .'<urn1:m type="C" value="value" op="reset" />'
                        .'</urn1:cn>'
                    .'</urn1:ModifyContactRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyImapDataSource(
           $imap
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                        .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                        .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                        .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                        .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                            .'<urn1:lastError>lastError</urn1:lastError>'
                            .'<urn1:a>a</urn1:a>'
                            .'<urn1:a>b</urn1:a>'
                        .'</urn1:imap>'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyPop3DataSource(
           $pop3
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyCaldavDataSource(
           $caldav
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyYabDataSource(
           $yab
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyRssDataSource(
           $rss
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyGalDataSource(
           $gal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyCalDataSource(
           $cal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->modifyUnknownDataSource(
           $unknown
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyFilterRules(
            $filterRules
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="name" active="true">'
                                .'<urn1:filterTests condition="allof">'
                                    .'<urn1:addressBookTest index="10" negative="true" header="header" />'
                                    .'<urn1:addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:attachmentTest index="10" negative="true" />'
                                    .'<urn1:bodyTest index="10" negative="true" value="value" caseSensitive="true" />'
                                    .'<urn1:bulkTest index="10" negative="true" />'
                                    .'<urn1:contactRankingTest index="10" negative="true" header="header" />'
                                    .'<urn1:conversationTest index="10" negative="true" where="where" />'
                                    .'<urn1:currentDayOfWeekTest index="10" negative="true" value="value" />'
                                    .'<urn1:currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />'
                                    .'<urn1:dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />'
                                    .'<urn1:facebookTest index="10" negative="true" />'
                                    .'<urn1:flaggedTest index="10" negative="true" flagName="flagName" />'
                                    .'<urn1:headerExistsTest index="10" negative="true" header="header" />'
                                    .'<urn1:headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:importanceTest index="10" negative="true" imp="high" />'
                                    .'<urn1:inviteTest index="10" negative="true">'
                                        .'<urn1:method>method</urn1:method>'
                                    .'</urn1:inviteTest>'
                                    .'<urn1:linkedinTest index="10" negative="true" />'
                                    .'<urn1:listTest index="10" negative="true" />'
                                    .'<urn1:meTest index="10" negative="true" header="header" />'
                                    .'<urn1:mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />'
                                    .'<urn1:socialcastTest index="10" negative="true" />'
                                    .'<urn1:trueTest index="10" negative="true" />'
                                    .'<urn1:twitterTest index="10" negative="true" />'
                                .'</urn1:filterTests>'
                                .'<urn1:filterActions>'
                                    .'<urn1:actionKeep index="10" />'
                                    .'<urn1:actionDiscard index="10" />'
                                    .'<urn1:actionFileInto index="10" folderPath="folderPath" />'
                                    .'<urn1:actionFlag index="10" flagName="flagName" />'
                                    .'<urn1:actionTag index="10" tagName="tagName" />'
                                    .'<urn1:actionRedirect index="10" a="a" />'
                                    .'<urn1:actionReply index="10">'
                                        .'<urn1:content>content</urn1:content>'
                                    .'</urn1:actionReply>'
                                    .'<urn1:actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                                        .'<urn1:content>content</urn1:content>'
                                    .'</urn1:actionNotify>'
                                    .'<urn1:actionStop index="10" />'
                                .'</urn1:filterActions>'
                            .'</urn1:filterRule>'
                        .'</urn1:filterRules>'
                    .'</urn1:ModifyFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyMailboxMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));

        $this->_api->modifyMailboxMetadata(
            $meta
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyMailboxMetadataRequest>'
                        .'<urn1:meta section="section">'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:ModifyMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->modifyOutgoingFilterRules(
            $filterRules
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyOutgoingFilterRulesRequest>'
                        .'<urn1:filterRules>'
                            .'<urn1:filterRule name="name" active="true">'
                                .'<urn1:filterTests condition="allof">'
                                    .'<urn1:addressBookTest index="10" negative="true" header="header" />'
                                    .'<urn1:addressTest index="10" negative="true" header="header" part="part" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:attachmentTest index="10" negative="true" />'
                                    .'<urn1:bodyTest index="10" negative="true" value="value" caseSensitive="true" />'
                                    .'<urn1:bulkTest index="10" negative="true" />'
                                    .'<urn1:contactRankingTest index="10" negative="true" header="header" />'
                                    .'<urn1:conversationTest index="10" negative="true" where="where" />'
                                    .'<urn1:currentDayOfWeekTest index="10" negative="true" value="value" />'
                                    .'<urn1:currentTimeTest index="10" negative="true" dateComparison="dateComparison" time="time" />'
                                    .'<urn1:dateTest index="10" negative="true" dateComparison="dateComparison" d="10" />'
                                    .'<urn1:facebookTest index="10" negative="true" />'
                                    .'<urn1:flaggedTest index="10" negative="true" flagName="flagName" />'
                                    .'<urn1:headerExistsTest index="10" negative="true" header="header" />'
                                    .'<urn1:headerTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:importanceTest index="10" negative="true" imp="high" />'
                                    .'<urn1:inviteTest index="10" negative="true">'
                                        .'<urn1:method>method</urn1:method>'
                                    .'</urn1:inviteTest>'
                                    .'<urn1:linkedinTest index="10" negative="true" />'
                                    .'<urn1:listTest index="10" negative="true" />'
                                    .'<urn1:meTest index="10" negative="true" header="header" />'
                                    .'<urn1:mimeHeaderTest index="10" negative="true" header="header" stringComparison="stringComparison" value="value" caseSensitive="true" />'
                                    .'<urn1:sizeTest index="10" negative="true" numberComparison="numberComparison" s="s" />'
                                    .'<urn1:socialcastTest index="10" negative="true" />'
                                    .'<urn1:trueTest index="10" negative="true" />'
                                    .'<urn1:twitterTest index="10" negative="true" />'
                                .'</urn1:filterTests>'
                                .'<urn1:filterActions>'
                                    .'<urn1:actionKeep index="10" />'
                                    .'<urn1:actionDiscard index="10" />'
                                    .'<urn1:actionFileInto index="10" folderPath="folderPath" />'
                                    .'<urn1:actionFlag index="10" flagName="flagName" />'
                                    .'<urn1:actionTag index="10" tagName="tagName" />'
                                    .'<urn1:actionRedirect index="10" a="a" />'
                                    .'<urn1:actionReply index="10">'
                                        .'<urn1:content>content</urn1:content>'
                                    .'</urn1:actionReply>'
                                    .'<urn1:actionNotify index="10" a="a" su="su" maxBodySize="10" origHeaders="origHeaders">'
                                        .'<urn1:content>content</urn1:content>'
                                    .'</urn1:actionNotify>'
                                    .'<urn1:actionStop index="10" />'
                                .'</urn1:filterActions>'
                            .'</urn1:filterRule>'
                        .'</urn1:filterRules>'
                    .'</urn1:ModifyOutgoingFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifySearchFolder()
    {
        $search = new \Zimbra\Mail\Struct\ModifySearchFolderSpec(
            'id', 'query', 'types', 'sortBy'
        );

        $this->_api->modifySearchFolder(
            $search
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifySearchFolderRequest>'
                        .'<urn1:search id="id" query="query" types="types" sortBy="sortBy" />'
                    .'</urn1:ModifySearchFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyTask()
    {
        $m = $this->getMsg();

        $this->_api->modifyTask(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifyTaskRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:ModifyTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testMsgAction()
    {
        $action = new \Zimbra\Mail\Struct\MsgActionSelector(
            MsgActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn'
        );

        $this->_api->msgAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:MsgActionRequest>'
                        .'<urn1:action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
                    .'</urn1:MsgActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function noOp()
    {
        $this->_api->noOp(
            true, true, true, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:NoOpRequest wait="true" delegate="true" limitToOneBlocked="true" timeout="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testNoteAction()
    {
        $action = new \Zimbra\Mail\Struct\NoteActionSelector(
            ItemActionOp::MOVE(), 'id', 'tcon', 10, 'l', '#aabbcc', 10, 'name', 'f', 't', 'tn', 'content', 'pos'
        );

        $this->_api->noteAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:NoteActionRequest>'
                        .'<urn1:action op="move" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" content="content" pos="pos" />'
                    .'</urn1:NoteActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeRevision()
    {
        $revision = new \Zimbra\Mail\Struct\PurgeRevisionSpec(
            'id', 10, true
        );

        $this->_api->purgeRevision(
            $revision
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:PurgeRevisionRequest>'
                        .'<urn1:revision id="id" ver="10" includeOlderRevisions="true" />'
                    .'</urn1:PurgeRevisionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRankingAction()
    {
        $action = new \Zimbra\Mail\Struct\RankingActionSpec(
            RankingActionOp::RESET(), 'email'
        );

        $this->_api->rankingAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RankingActionRequest>'
                        .'<urn1:action op="reset" email="email" />'
                    .'</urn1:RankingActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRegisterDevice()
    {
        $device = new \Zimbra\Struct\NamedElement('name');

        $this->_api->registerDevice(
            $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RegisterDeviceRequest>'
                        .'<urn1:device name="name" />'
                    .'</urn1:RegisterDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveAttachments()
    {
        $m = new \Zimbra\Mail\Struct\MsgPartIds(
            'id', 'part'
        );

        $this->_api->removeAttachments(
            $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RemoveAttachmentsRequest>'
                        .'<urn1:m id="id" part="part" />'
                    .'</urn1:RemoveAttachmentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRevokePermission()
    {
        $ace = new \Zimbra\Mail\Struct\AccountACEinfo(
            GranteeType::USR(), AceRightType::INVITE(), 'zid', 'd', 'key', 'pw', false
        );

        $this->_api->revokePermission(
            array($ace)
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:RevokePermissionRequest>'
                        .'<urn1:ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="false" />'
                    .'</urn1:RevokePermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->saveDocument(
            $doc
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SaveDocumentRequest>'
                        .'<urn1:doc name="name" ct="ct" desc="desc" l="l" id="id" ver="10" content="content" descEnabled="true" f="f">'
                            .'<urn1:upload id="id" />'
                            .'<urn1:m id="id" part="part" />'
                            .'<urn1:doc id="id" ver="10" />'
                        .'</urn1:doc>'
                    .'</urn1:SaveDocumentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSaveDraft()
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

        $this->_api->saveDraft(
            $m
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SaveDraftRequest>'
                        .'<urn1:m id="10" forAcct="forAcct" t="t" tn="tn" rgb="#aabbcc" color="10" autoSendTime="10" aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn optional="false" id="id" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:SaveDraftRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearch()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $tz = $this->getTz();
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $this->_api->search(
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

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SearchRequest warmup="true" includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="10" calExpandInstEnd="10" inDumpster="true" types="types" groupBy="groupBy" quick="true" sortBy="dateDesc" fetch="fetch" read="true" max="10" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="resultMode" field="field" limit="10" offset="10">'
                        .'<urn1:query>query</urn1:query>'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:locale>locale</urn1:locale>'
                        .'<urn1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<urn1:header n="attribute-name" />'
                    .'</urn1:SearchRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchConv()
    {
        $header = new \Zimbra\Struct\AttributeName('attribute-name');
        $tz = $this->getTz();
        $cursor = new \Zimbra\Struct\CursorInfo('id','sortVal', 'endSortVal', true);

        $this->_api->searchConv(
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

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SearchConvRequest includeTagDeleted="true" includeTagMuted="true" allowableTaskStatus="allowableTaskStatus" calExpandInstStart="10" calExpandInstEnd="10" inDumpster="true" types="types" groupBy="groupBy" quick="true" sortBy="dateAsc" fetch="fetch" read="true" max="10" html="true" needExp="true" neuter="true" recip="true" prefetch="true" resultMode="resultMode" field="field" limit="10" offset="10" cid="cid" nest="true">'
                        .'<urn1:query>query</urn1:query>'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:locale>locale</urn1:locale>'
                        .'<urn1:cursor id="id" sortVal="sortVal" endSortVal="endSortVal" includeOffset="true" />'
                        .'<urn1:header n="attribute-name" />'
                    .'</urn1:SearchConvRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSendDeliveryReport()
    {
        $this->_api->sendDeliveryReport('mid');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendDeliveryReportRequest mid="mid" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSendInviteReply()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();
        $m = $this->getMsg();

        $this->_api->sendInviteReply(
            'id', 10, 'verb', $exceptId, $tz, $m, true, 'idnt'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendInviteReplyRequest id="id" compNum="10" verb="verb" updateOrganizer="true" idnt="idnt">'
                        .'<urn1:exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</urn1:tz>'
                        .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn optional="false" id="id" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:SendInviteReplyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->sendMsg(
            $m, true, true, true, 'suid'
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendMsgRequest needCalendarSentByFixup="true" isCalendarForward="true" noSave="true" suid="suid">'
                        .'<urn1:m did="did" sfd="true" aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<urn1:content>content</urn1:content>'
                            .'<urn1:mp ct="ct" content="content" ci="ci">'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn id="id" optional="false" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:mp ct="ct" content="content" ci="ci" />'
                            .'</urn1:mp>'
                            .'<urn1:attach aid="aid">'
                                .'<urn1:mp optional="true" mid="mid" part="part" />'
                                .'<urn1:m optional="false" id="id" />'
                                .'<urn1:cn id="id" optional="false" />'
                                .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</urn1:attach>'
                            .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                            .'<urn1:fr>fr</urn1:fr>'
                            .'<urn1:header name="name">value</urn1:header>'
                            .'<urn1:e a="a" t="t" p="p" />'
                            .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</urn1:tz>'
                        .'</urn1:m>'
                    .'</urn1:SendMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSendShareNotification()
    {
        $item = new \Zimbra\Struct\Id('id');
        $e = new \Zimbra\Mail\Struct\EmailAddrInfo('a', 't', 'p');

        $this->_api->sendShareNotification(
            $item, array($e), 'notes', Action::EDIT()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendShareNotificationRequest action="edit">'
                        .'<urn1:item id="id" />'
                        .'<urn1:notes>notes</urn1:notes>'
                        .'<urn1:e a="a" t="t" p="p" />'
                    .'</urn1:SendShareNotificationRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSendVerificationCode()
    {
        $this->_api->sendVerificationCode('email');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SendVerificationCodeRequest a="email" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->setAppointment(
            $default, array($except), array($cancel), $replies, 'f', 't', 'tn', 'l', true, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetAppointmentRequest f="f" t="t" tn="tn" l="l" noNextAlarm="true" nextAlarm="10">'
                        .'<urn1:default ptst="NE">'
                            .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                                .'<urn1:content>content</urn1:content>'
                                .'<urn1:mp ct="ct" content="content" ci="ci">'
                                    .'<urn1:attach aid="aid">'
                                        .'<urn1:mp optional="true" mid="mid" part="part" />'
                                        .'<urn1:m optional="false" id="id" />'
                                        .'<urn1:cn optional="false" id="id" />'
                                        .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                    .'</urn1:attach>'
                                    .'<urn1:mp ct="ct" content="content" ci="ci" />'
                                .'</urn1:mp>'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn optional="false" id="id" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                                .'<urn1:fr>fr</urn1:fr>'
                                .'<urn1:header name="name">value</urn1:header>'
                                .'<urn1:e a="a" t="t" p="p" />'
                                .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                    .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                    .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                                .'</urn1:tz>'
                            .'</urn1:m>'
                        .'</urn1:default>'
                        .'<urn1:replies>'
                            .'<urn1:reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'</urn1:replies>'
                        .'<urn1:except />'
                        .'<urn1:cancel />'
                    .'</urn1:SetAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetCustomMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));

        $this->_api->setCustomMetadata(
            'id', $meta
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetCustomMetadataRequest id="id">'
                        .'<urn1:meta section="section">'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:SetCustomMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetMailboxMetadata()
    {
        $a = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $meta = new \Zimbra\Mail\Struct\MailCustomMetadata('section', array($a));

        $this->_api->setMailboxMetadata(
            $meta
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetMailboxMetadataRequest>'
                        .'<urn1:meta section="section">'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:meta>'
                    .'</urn1:SetMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetTask()
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

        $this->_api->setTask(
            $default, array($except), array($cancel), $replies, 'f', 't', 'tn', 'l', true, 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SetTaskRequest f="f" t="t" tn="tn" l="l" noNextAlarm="true" nextAlarm="10">'
                        .'<urn1:default ptst="NE">'
                            .'<urn1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                                .'<urn1:content>content</urn1:content>'
                                .'<urn1:mp ct="ct" content="content" ci="ci">'
                                    .'<urn1:attach aid="aid">'
                                        .'<urn1:mp optional="true" mid="mid" part="part" />'
                                        .'<urn1:m optional="false" id="id" />'
                                        .'<urn1:cn optional="false" id="id" />'
                                        .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                    .'</urn1:attach>'
                                    .'<urn1:mp ct="ct" content="content" ci="ci" />'
                                .'</urn1:mp>'
                                .'<urn1:attach aid="aid">'
                                    .'<urn1:mp optional="true" mid="mid" part="part" />'
                                    .'<urn1:m optional="false" id="id" />'
                                    .'<urn1:cn optional="false" id="id" />'
                                    .'<urn1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</urn1:attach>'
                                .'<urn1:inv method="method" compNum="10" rsvp="true" />'
                                .'<urn1:fr>fr</urn1:fr>'
                                .'<urn1:header name="name">value</urn1:header>'
                                .'<urn1:e a="a" t="t" p="p" />'
                                .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                    .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                    .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                                .'</urn1:tz>'
                            .'</urn1:m>'
                        .'</urn1:default>'
                        .'<urn1:replies>'
                            .'<urn1:reply at="at" seq="10" d="10" sentBy="sentBy" ptst="NE" rangeType="10" recurId="991231" tz="tz" ridZ="991231000000" />'
                        .'</urn1:replies>'
                        .'<urn1:except />'
                        .'<urn1:cancel />'
                    .'</urn1:SetTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSnoozeCalendarItemAlarm()
    {
        $appt = new \Zimbra\Mail\Struct\SnoozeAppointmentAlarm('id', 10);
        $task = new \Zimbra\Mail\Struct\SnoozeTaskAlarm('id', 10);

        $this->_api->snoozeCalendarItemAlarm(
            $appt, $task
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SnoozeCalendarItemAlarmRequest>'
                        .'<urn1:appt id="id" until="10" />'
                        .'<urn1:task id="id" until="10" />'
                    .'</urn1:SnoozeCalendarItemAlarmRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSync()
    {
        $this->_api->sync('token', 10, 'l', true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:SyncRequest token="token" calCutoff="10" l="l" typed="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->tagAction(
            $action
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TagActionRequest>'
                        .'<urn1:action op="read" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                            .'<urn1:retentionPolicy>'
                                .'<urn1:keep>'
                                    .'<urn1:policy type="system" id="id" name="name" lifetime="lifetime" />'
                                .'</urn1:keep>'
                                .'<urn1:purge>'
                                    .'<urn1:policy type="user" id="id" name="name" lifetime="lifetime" />'
                                .'</urn1:purge>'
                            .'</urn1:retentionPolicy>'
                        .'</urn1:action>'
                    .'</urn1:TagActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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

        $this->_api->testImapDataSource(
           $imap
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                        .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                        .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                        .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                        .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                            .'<urn1:lastError>lastError</urn1:lastError>'
                            .'<urn1:a>a</urn1:a>'
                            .'<urn1:a>b</urn1:a>'
                        .'</urn1:imap>'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testPop3DataSource(
           $pop3
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:pop3 leaveOnServer="true" />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testCaldavDataSource(
           $caldav
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:caldav />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testYabDataSource(
           $yab
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:yab />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testRssDataSource(
           $rss
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:rss />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testGalDataSource(
           $gal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:gal />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testCalDataSource(
           $cal
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:cal />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $this->_api->testUnknownDataSource(
           $unknown
        );
        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:TestDataSourceRequest>'
                        .'<urn1:unknown />'
                    .'</urn1:TestDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUpdateDeviceStatus()
    {
        $device = new \Zimbra\Mail\Struct\IdStatus('id', 'status');

        $this->_api->updateDeviceStatus(
            $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:UpdateDeviceStatusRequest>'
                        .'<urn1:device id="id" status="status" />'
                    .'</urn1:UpdateDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyCode()
    {
        $this->_api->verifyCode('email', 'code');

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:VerifyCodeRequest a="email" code="code" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testWaitSet()
    {
        $id = new \Zimbra\Struct\Id('id');
        $waitSet = new \Zimbra\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $add = new \Zimbra\Struct\WaitSetSpec(array($waitSet));
        $update = new \Zimbra\Struct\WaitSetSpec(array($waitSet));
        $remove = new \Zimbra\Struct\WaitSetId(array($id));

        $this->_api->waitSet(
            'waitSet', 'seq', $add, $update, $remove, true, array(InterestType::FOLDERS()), 10
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:WaitSetRequest waitSet="waitSet" seq="seq" block="true" defTypes="f" timeout="10" >'
                        .'<urn1:add>'
                            .'<urn1:a name="name" id="id" token="token" types="f" />'
                        .'</urn1:add>'
                        .'<urn1:update>'
                            .'<urn1:a name="name" id="id" token="token" types="f" />'
                        .'</urn1:update>'
                        .'<urn1:remove>'
                            .'<urn1:a id="id" />'
                        .'</urn1:remove>'
                    .'</urn1:WaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}

class LocalMailHttp extends MailBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientHttp($this->_location);
    }
}
