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
    public function testMailFactory()
    {
        $httpApi = MailFactory::instance();
        $this->assertInstanceOf('\Zimbra\Mail\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Mail\Http', $httpApi);

        $httpApi = MailFactory::instance(__DIR__.'/../TestData/ZimbraUserService.wsdl', 'wsdl');
        $this->assertInstanceOf('\Zimbra\Mail\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Mail\Wsdl', $httpApi);
    }

    public function testAddAppointmentInvite()
    {
        $m = $this->getMsg();

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->addAppointmentInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AddAppointmentInviteRequest ptst="NE">'
                        .'<ns1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<ns1:content>content</ns1:content>'
                            .'<ns1:header name="name">value</ns1:header>'
                            .'<ns1:mp ct="ct" content="content" ci="ci">'
                                .'<ns1:mp ct="ct" content="content" ci="ci" />'
                                .'<ns1:attach aid="aid">'
                                    .'<ns1:mp optional="true" mid="mid" part="part" />'
                                    .'<ns1:m optional="false" id="id" />'
                                    .'<ns1:cn optional="false" id="id" />'
                                    .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</ns1:attach>'
                            .'</ns1:mp>'
                            .'<ns1:attach aid="aid">'
                                .'<ns1:mp optional="true" mid="mid" part="part" />'
                                .'<ns1:m optional="false" id="id" />'
                                .'<ns1:cn optional="false" id="id" />'
                                .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</ns1:attach>'
                            .'<ns1:inv method="method" compNum="10" rsvp="true" />'
                            .'<ns1:e a="a" t="t" p="p" />'
                            .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</ns1:tz>'
                            .'<ns1:fr>fr</ns1:fr>'
                        .'</ns1:m>'
                    .'</ns1:AddAppointmentInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->addAppointmentInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->addComment(
            $comment
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AddCommentRequest>'
                        .'<ns1:comment parentId="parentId" text="text" />'
                    .'</ns1:AddCommentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->addComment(
            $comment
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->addMsg(
            $m, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AddMsgRequest filterSent="true">'
                        .'<ns1:m f="f" t="t" tn="tn" l="l" noICal="true" d="d" aid="aid">'
                            .'<ns1:content>content</ns1:content>'
                        .'</ns1:m>'
                    .'</ns1:AddMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->addMsg(
            $m, true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->addTaskInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AddTaskInviteRequest ptst="NE">'
                        .'<ns1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<ns1:content>content</ns1:content>'
                            .'<ns1:header name="name">value</ns1:header>'
                            .'<ns1:mp ct="ct" content="content" ci="ci">'
                                .'<ns1:mp ct="ct" content="content" ci="ci" />'
                                .'<ns1:attach aid="aid">'
                                    .'<ns1:mp optional="true" mid="mid" part="part" />'
                                    .'<ns1:m optional="false" id="id" />'
                                    .'<ns1:cn optional="false" id="id" />'
                                    .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</ns1:attach>'
                            .'</ns1:mp>'
                            .'<ns1:attach aid="aid">'
                                .'<ns1:mp optional="true" mid="mid" part="part" />'
                                .'<ns1:m optional="false" id="id" />'
                                .'<ns1:cn optional="false" id="id" />'
                                .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</ns1:attach>'
                            .'<ns1:inv method="method" compNum="10" rsvp="true" />'
                            .'<ns1:e a="a" t="t" p="p" />'
                            .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</ns1:tz>'
                            .'<ns1:fr>fr</ns1:fr>'
                        .'</ns1:m>'
                    .'</ns1:AddTaskInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->addTaskInvite(
            $m, ParticipationStatus::NE()
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->announceOrganizerChange(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AnnounceOrganizerChangeRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->announceOrganizerChange(
           'id'
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->applyFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ApplyFilterRulesRequest>'
                        .'<ns1:filterRules>'
                            .'<ns1:filterRule name="name" />'
                        .'</ns1:filterRules>'
                        .'<ns1:m ids="ids" />'
                        .'<ns1:query>query</ns1:query>'
                    .'</ns1:ApplyFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->applyFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->applyOutgoingFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ApplyOutgoingFilterRulesRequest>'
                        .'<ns1:filterRules>'
                            .'<ns1:filterRule name="name" />'
                        .'</ns1:filterRules>'
                        .'<ns1:m ids="ids" />'
                        .'<ns1:query>query</ns1:query>'
                    .'</ns1:ApplyOutgoingFilterRulesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->applyOutgoingFilterRules(
            $filterRules, $m, 'query'
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->autoComplete(
            'name', GalSearchType::ALL(), true, 'folders', true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:AutoCompleteRequest name="name" t="all" needExp="true" folders="folders" includeGal="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->autoComplete(
           'name', GalSearchType::ALL(), true, 'folders', true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->bounceMsg(
            $m
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:BounceMsgRequest>'
                        .'<ns1:m id="id">'
                            .'<ns1:e a="a" t="t" p="p" />'
                        .'</ns1:m>'
                    .'</ns1:BounceMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->bounceMsg(
           $m
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->browse(
            BrowseBy::DOMAINS(), 'regex', 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:BrowseRequest browseBy="domains" regex="regex" maxToReturn="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->browse(
           BrowseBy::DOMAINS(), 'regex', 10
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->cancelAppointment(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CancelAppointmentRequest id="id" comp="10" ms="10" rev="10">'
                        .'<ns1:inst range="range" d="20130315T18302305Z" tz="tz" />'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
                        .'<ns1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<ns1:content>content</ns1:content>'
                            .'<ns1:header name="name">value</ns1:header>'
                            .'<ns1:mp ct="ct" content="content" ci="ci">'
                                .'<ns1:mp ct="ct" content="content" ci="ci" />'
                                .'<ns1:attach aid="aid">'
                                    .'<ns1:mp optional="true" mid="mid" part="part" />'
                                    .'<ns1:m optional="false" id="id" />'
                                    .'<ns1:cn optional="false" id="id" />'
                                    .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</ns1:attach>'
                            .'</ns1:mp>'
                            .'<ns1:attach aid="aid">'
                                .'<ns1:mp optional="true" mid="mid" part="part" />'
                                .'<ns1:m optional="false" id="id" />'
                                .'<ns1:cn optional="false" id="id" />'
                                .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</ns1:attach>'
                            .'<ns1:inv method="method" compNum="10" rsvp="true" />'
                            .'<ns1:e a="a" t="t" p="p" />'
                            .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</ns1:tz>'
                            .'<ns1:fr>fr</ns1:fr>'
                        .'</ns1:m>'
                    .'</ns1:CancelAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->cancelAppointment(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->cancelTask(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CancelTaskRequest id="id" comp="10" ms="10" rev="10">'
                        .'<ns1:inst range="range" d="20130315T18302305Z" tz="tz" />'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
                        .'<ns1:m aid="aid" origid="origid" rt="rt" idnt="idnt" su="su" irt="irt" l="l" f="f">'
                            .'<ns1:content>content</ns1:content>'
                            .'<ns1:header name="name">value</ns1:header>'
                            .'<ns1:mp ct="ct" content="content" ci="ci">'
                                .'<ns1:mp ct="ct" content="content" ci="ci" />'
                                .'<ns1:attach aid="aid">'
                                    .'<ns1:mp optional="true" mid="mid" part="part" />'
                                    .'<ns1:m optional="false" id="id" />'
                                    .'<ns1:cn optional="false" id="id" />'
                                    .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                                .'</ns1:attach>'
                            .'</ns1:mp>'
                            .'<ns1:attach aid="aid">'
                                .'<ns1:mp optional="true" mid="mid" part="part" />'
                                .'<ns1:m optional="false" id="id" />'
                                .'<ns1:cn optional="false" id="id" />'
                                .'<ns1:doc optional="true" path="path" id="id" ver="10" />'
                            .'</ns1:attach>'
                            .'<ns1:inv method="method" compNum="10" rsvp="true" />'
                            .'<ns1:e a="a" t="t" p="p" />'
                            .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                                .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                            .'</ns1:tz>'
                            .'<ns1:fr>fr</ns1:fr>'
                        .'</ns1:m>'
                    .'</ns1:CancelTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->cancelTask(
            $inst, $tz, $m, 'id', 10, 10, 10
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->checkDeviceStatus(
            $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CheckDeviceStatusRequest>'
                        .'<ns1:device id="id" />'
                    .'</ns1:CheckDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->checkDeviceStatus(
           $device
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->checkPermission(
            $target, array('right')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CheckPermissionRequest>'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:right>right</ns1:right>'
                    .'</ns1:CheckPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->checkPermission(
           $target, array('right')
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->checkRecurConflicts(
            array($tz), $cancel, $comp, $except, array($usr), 10, 10, true, 'excludeUid'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CheckRecurConflictsRequest s="10" e="10" all="true" excludeUid="excludeUid">'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
                        .'<ns1:cancel s="10" e="10">'
                            .'<ns1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<ns1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<ns1:recur />'
                        .'</ns1:cancel>'
                        .'<ns1:comp s="10" e="10">'
                            .'<ns1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<ns1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<ns1:recur />'
                        .'</ns1:comp>'
                        .'<ns1:except s="10" e="10">'
                            .'<ns1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<ns1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<ns1:recur />'
                        .'</ns1:except>'
                        .'<ns1:usr l="10" id="id" name="name" />'
                    .'</ns1:CheckRecurConflictsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->checkRecurConflicts(
           array($tz), $cancel, $comp, $except, array($usr), 10, 10, true, 'excludeUid'
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->checkSpelling(
            'value', 'dictionary', 'ignore'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CheckSpellingRequest dictionary="dictionary" ignore="ignore">value</ns1:CheckSpellingRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->checkSpelling(
           'value', 'dictionary', 'ignore'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CheckSpellingRequest dictionary="dictionary" ignore="ignore">value</urn1:CheckSpellingRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}


class LocalMailWsdl extends MailBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientWsdl($this->_location);
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
