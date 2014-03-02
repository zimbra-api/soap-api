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

    public function testCompleteTaskInstance()
    {
        $exceptId = new \Zimbra\Mail\Struct\DtTimeInfo(
            '20120315T18302305Z', 'tz', 1000
        );
        $tz = $this->getTz();

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->completeTaskInstance(
            'id', $exceptId, $tz
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CompleteTaskInstanceRequest id="id">'
                        .'<ns1:exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
                    .'</ns1:CompleteTaskInstanceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->completeTaskInstance(
           'id', $exceptId, $tz
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->contactAction(
            $action
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ContactActionRequest>'
                        .'<ns1:action id="id" op="move" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn">'
                            .'<ns1:a n="n" aid="aid" id="10" part="part">value</ns1:a>'
                        .'</ns1:action>'
                    .'</ns1:ContactActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->contactAction(
           $action
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->convAction(
            $action
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ConvActionRequest>'
                        .'<ns1:action op="delete" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" />'
                    .'</ns1:ConvActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->convAction(
           $action
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->counterAppointment(
            $m, 'id', 10, 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CounterAppointmentRequest id="id" comp="10" ms="10" rev="10">'
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
                    .'</ns1:CounterAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->counterAppointment(
            $m, 'id', 10, 10, 10
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createAppointment(
            $m, true, 10, true, true, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateAppointmentRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
                    .'</ns1:CreateAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createAppointment(
            $m, true, 10, true, true, true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createAppointmentException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateAppointmentExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
                    .'</ns1:CreateAppointmentExceptionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createAppointmentException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createContact(
           $cn, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateContactRequest verbose="true">'
                        .'<ns1:cn id="10" l="l" t="t" tn="tn">'
                            .'<ns1:vcard mid="mid" part="part" aid="aid">value</ns1:vcard>'
                            .'<ns1:a n="n" aid="aid" id="10" part="part">value</ns1:a>'
                            .'<ns1:m type="type" value="value" />'
                        .'</ns1:cn>'
                    .'</ns1:CreateContactRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createContact(
           $cn, true
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');

        $api->createImapDataSource(
           $imap
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:imap id="id" name="name" l="l" isEnabled="true" importOnly="true" host="host" port="10" '
                        .'connectionType="ssl" username="username" password="password" pollingInterval="pollingInterval" '
                        .'emailAddress="emailAddress" useAddressForForwardReply="true" defaultSignature="defaultSignature" '
                        .'forwardReplySignature="forwardReplySignature" fromDisplay="fromDisplay" replyToAddress="replyToAddress" '
                        .'replyToDisplay="replyToDisplay" importClass="importClass" failingSince="10">'
                            .'<ns1:lastError>lastError</ns1:lastError>'
                            .'<ns1:a>a</ns1:a>'
                            .'<ns1:a>b</ns1:a>'
                        .'</ns1:imap>'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createPop3DataSource(
           $pop3
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:pop3 leaveOnServer="true" />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createCaldavDataSource(
           $caldav
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:caldav />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createYabDataSource(
           $yab
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:yab />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createRssDataSource(
           $rss
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:rss />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createGalDataSource(
           $gal
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:gal />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createCalDataSource(
           $cal
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:cal />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api->createUnknownDataSource(
           $unknown
        );
        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest>'
                        .'<ns1:unknown />'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createImapDataSource(
           $imap
        );
        $client = $api->client();
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

        $api->createPop3DataSource(
           $pop3
        );
        $client = $api->client();
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

        $api->createCaldavDataSource(
           $caldav
        );
        $client = $api->client();
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

        $api->createYabDataSource(
           $yab
        );
        $client = $api->client();
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

        $api->createRssDataSource(
           $rss
        );
        $client = $api->client();
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

        $api->createGalDataSource(
           $gal
        );
        $client = $api->client();
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

        $api->createCalDataSource(
           $cal
        );
        $client = $api->client();
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

        $api->createUnknownDataSource(
           $unknown
        );
        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createFolder(
           $folder
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateFolderRequest>'
                        .'<ns1:folder name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" sync="true">'
                            .'<ns1:acl>'
                                .'<ns1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'</ns1:acl>'
                        .'</ns1:folder>'
                    .'</ns1:CreateFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createFolder(
           $folder
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createMountpoint(
           $link
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateMountpointRequest>'
                        .'<ns1:link name="name" view="task" f="f" color="10" rgb="#aabbcc" url="url" l="l" fie="true" reminder="true" zid="zid" owner="owner" rid="10" path="path" />'
                    .'</ns1:CreateMountpointRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createMountpoint(
           $link
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createNote(
           $note
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateNoteRequest>'
                        .'<ns1:note l="l" content="content" color="10" pos="pos" />'
                    .'</ns1:CreateNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createNote(
           $note
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createSearchFolder(
           $search
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateSearchFolderRequest>'
                        .'<ns1:search name="name" query="query" types="types" sortBy="sortBy" f="f" color="10" l="l" />'
                    .'</ns1:CreateSearchFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createSearchFolder(
           $search
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createTag(
           $tag
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateTagRequest>'
                        .'<ns1:tag name="name" rgb="#aabbcc" color="10" />'
                    .'</ns1:CreateTagRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createTag(
           $tag
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createTask(
            $m, true, 10, true, true, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateTaskRequest echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
                    .'</ns1:CreateTaskRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createTask(
            $m, true, 10, true, true, true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createTaskException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateTaskExceptionRequest id="id" comp="10" ms="10" rev="10" echo="true" max="10" html="true" neuter="true" forcesend="true">'
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
                    .'</ns1:CreateTaskExceptionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createTaskException(
            $m, 'id', 10, 10, 10, true, 10, true, true, true
        );

        $client = $api->client();
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
        $a = new \Zimbra\Mail\Struct\WaitSetAddSpec('name', 'id', 'token', array(InterestType::FOLDERS()));
        $add = new \Zimbra\Mail\Struct\WaitSetSpec(array($a));

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->createWaitSet(
            $add, array(InterestType::FOLDERS()), true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateWaitSetRequest defTypes="f" allAccounts="true">'
                        .'<ns1:add>'
                            .'<ns1:a name="name" id="id" token="token" types="f" />'
                        .'</ns1:add>'
                    .'</ns1:CreateWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->createWaitSet(
            $add, array(InterestType::FOLDERS()), true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->declineCounterAppointment(
            $m
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DeclineCounterAppointmentRequest>'
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
                    .'</ns1:DeclineCounterAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->declineCounterAppointment(
            $m
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->deleteDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DeleteDataSourceRequest>'
                        .'<ns1:imap name="name" id="id" />'
                        .'<ns1:pop3 name="name" id="id" />'
                        .'<ns1:caldav name="name" id="id" />'
                        .'<ns1:yab name="name" id="id" />'
                        .'<ns1:rss name="name" id="id" />'
                        .'<ns1:gal name="name" id="id" />'
                        .'<ns1:cal name="name" id="id" />'
                        .'<ns1:unknown name="name" id="id" />'
                    .'</ns1:DeleteDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->deleteDataSource(
            $imap, $pop3, $caldav, $yab, $rss, $gal, $cal, $unknown
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->deleteDevice(
            $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DeleteDeviceRequest>'
                        .'<ns1:device id="id" />'
                    .'</ns1:DeleteDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->deleteDevice(
            $device
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->destroyWaitSet(
            'waitSet'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DestroyWaitSetRequest waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->destroyWaitSet(
            'waitSet'
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->diffDocument(
            $doc
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DiffDocumentRequest>'
                        .'<ns1:doc id="id" v1="3" v2="2" />'
                    .'</ns1:DiffDocumentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->diffDocument(
            $doc
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->dismissCalendarItemAlarm(
            $appt, $task
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DismissCalendarItemAlarmRequest>'
                        .'<ns1:appt id="id" dismissedAt="10" />'
                        .'<ns1:task id="id" dismissedAt="10" />'
                    .'</ns1:DismissCalendarItemAlarmRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->dismissCalendarItemAlarm(
            $appt, $task
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->documentAction(
            $action
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DocumentActionRequest>'
                        .'<ns1:action op="watch" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" zid="zid">'
                            .'<ns1:grant perm="r" gt="all" expiry="10" />'
                        .'</ns1:action>'
                    .'</ns1:DocumentActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->documentAction(
            $action
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->emptyDumpster();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:EmptyDumpsterRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->emptyDumpster();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->enableSharedReminder(
           $link
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:EnableSharedReminderRequest>'
                        .'<ns1:link id="id" reminder="true" />'
                    .'</ns1:EnableSharedReminderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->enableSharedReminder(
           $link
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->expandRecur(
           10, 10, array($tz), $comp, $except, $cancel
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ExpandRecurRequest s="10" e="10">'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
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
                        .'<ns1:cancel s="10" e="10">'
                            .'<ns1:exceptId range="range" d="20130315T18302305Z" tz="tz" />'
                            .'<ns1:dur neg="true" w="7" d="2" h="3" m="4" s="5" related="START" count="6" />'
                            .'<ns1:recur />'
                        .'</ns1:cancel>'
                    .'</ns1:ExpandRecurRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->expandRecur(
           10, 10, array($tz), $comp, $except, $cancel
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->exportContacts(
            'ct', 'l', 'csvfmt', 'csvlocale', 'csvsep'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ExportContactsRequest ct="ct" l="l" csvfmt="csvfmt" csvlocale="csvlocale" csvsep="csvsep" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->exportContacts(
            'ct', 'l', 'csvfmt', 'csvlocale', 'csvsep'
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->folderAction(
            $action
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:FolderActionRequest>'
                        .'<ns1:action op="read" id="id" tcon="tcon" tag="10" l="l" rgb="#aabbcc" color="10" name="name" f="f" t="t" tn="tn" recursive="true" url="url" excludeFreeBusy="true" zid="zid" gt="gt" view="view">'
                            .'<ns1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'<ns1:acl>'
                                .'<ns1:grant perm="perm" gt="usr" zid="zid" d="d" args="args" pw="pw" key="key" />'
                            .'</ns1:acl>'
                            .'<ns1:retentionPolicy>'
                                .'<ns1:keep>'
                                    .'<ns1:policy type="system" id="id" name="name" lifetime="lifetime" />'
                                .'</ns1:keep>'
                                .'<ns1:purge>'
                                    .'<ns1:policy type="user" id="id" name="name" lifetime="lifetime" />'
                                .'</ns1:purge>'
                            .'</ns1:retentionPolicy>'
                        .'</ns1:action>'
                    .'</ns1:FolderActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->folderAction(
            $action
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->forwardAppointment(
            $exceptId, $tz, $m, 'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ForwardAppointmentRequest id="id">'
                        .'<ns1:exceptId d="20120315T18302305Z" tz="tz" u="1000" />'
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
                    .'</ns1:ForwardAppointmentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->forwardAppointment(
            $exceptId, $tz, $m, 'id'
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->forwardAppointmentInvite(
            $m, 'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ForwardAppointmentInviteRequest id="id">'
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
                    .'</ns1:ForwardAppointmentInviteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->forwardAppointmentInvite(
            $m, 'id'
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->generateUUID();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GenerateUUIDRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->generateUUID();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getActivityStream('id', $filter, 10, 10);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetActivityStreamRequest id="id" offset="10" limit="10">'
                        .'<ns1:filter account="account" op="op" session="session" />'
                    .'</ns1:GetActivityStreamRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getActivityStream('id', $filter, 10, 10);

        $client = $api->client('id', $filter, 10, 10);
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAllDevices();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetAllDevicesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getAllDevices();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getAppointment(true, true, 'uid', 'id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetAppointmentRequest sync="true" includeContent="true" uid="uid" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getAppointment(true, true, 'uid', 'id');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getApptSummaries(10, 10, 'folder-id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetApptSummariesRequest s="10" e="10" l="folder-id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getApptSummaries(10, 10, 'folder-id');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getCalendarItemSummaries(10, 10, 'folder-id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetCalendarItemSummariesRequest s="10" e="10" l="folder-id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getCalendarItemSummaries(10, 10, 'folder-id');

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getComments(
            $comment
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetCommentsRequest>'
                        .'<ns1:comment parentId="parentId" />'
                    .'</ns1:GetCommentsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getComments(
            $comment
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetContactsRequest sync="true" l="folder-id" sortBy="sort-by" derefGroupMember="true" returnHiddenAttrs="true" maxMembers="10">'
                        .'<ns1:a n="attribute-name" />'
                        .'<ns1:ma n="attribute-name" />'
                        .'<ns1:cn id="id" />'
                    .'</ns1:GetContactsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getContacts(
            array($a), array($ma), array($cn), true, 'folder-id', 'sort-by', true, true, 10
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getConv(
            $c
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetConvRequest>'
                        .'<ns1:c id="id" fetch="fetch" html="true" max="10">'
                            .'<ns1:header n="attribute-name" />'
                        .'</ns1:c>'
                    .'</ns1:GetConvRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getConv(
            $c
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getCustomMetadata(
            'id', $meta
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetCustomMetadataRequest id="id">'
                        .'<ns1:meta section="section" />'
                    .'</ns1:GetCustomMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getCustomMetadata(
            'id', $meta
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getDataSources();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetDataSourcesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getDataSources();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getDocumentShareURL(
            $item
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetDocumentShareURLRequest>'
                        .'<ns1:item id="id" l="l" name="name" path="path" />'
                    .'</ns1:GetDocumentShareURLRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getDocumentShareURL(
            $item
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getEffectiveFolderPerms(
            $folder
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetEffectiveFolderPermsRequest>'
                        .'<ns1:folder l="l" />'
                    .'</ns1:GetEffectiveFolderPermsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getEffectiveFolderPerms(
            $folder
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getFilterRules();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetFilterRulesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getFilterRules();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getFolder(
            $folder, true, true, 'view', 10, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetFolderRequest visible="true" needGranteeName="true" view="view" depth="10" tr="true">'
                        .'<ns1:folder uuid="uuid" l="l" path="path" />'
                    .'</ns1:GetFolderRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getFolder(
            $folder, true, true, 'view', 10, true
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getFreeBusy(
            10, 10, 'uid', 'id', 'name', 'excludeUid', array($usr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetFreeBusyRequest s="10" e="10" uid="uid" id="id" name="name" excludeUid="excludeUid">'
                        .'<ns1:usr l="10" id="id" name="name" />'
                    .'</ns1:GetFreeBusyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getFreeBusy(
            10, 10, 'uid', 'id', 'name', 'excludeUid', array($usr)
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getICal(
            'id', 10, 10
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetICalRequest id="id" s="10" e="10" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getICal(
            'id', 10, 10
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getImportStatus();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetImportStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getImportStatus();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getItem(
            $item
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetItemRequest>'
                        .'<ns1:item id="id" l="l" name="name" path="path" />'
                    .'</ns1:GetItemRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getItem(
            $item
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getMailboxMetadata(
            $meta
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetMailboxMetadataRequest>'
                        .'<ns1:meta section="section" />'
                    .'</ns1:GetMailboxMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getMailboxMetadata(
            $meta
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getMiniCal(
            10, 10, array($folder), $tz
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetMiniCalRequest s="10" e="10">'
                        .'<ns1:folder id="id" />'
                        .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                            .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                            .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                        .'</ns1:tz>'
                    .'</ns1:GetMiniCalRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getMiniCal(
            10, 10, array($folder), $tz
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getMsg(
            $m
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetMsgRequest>'
                        .'<ns1:m id="id" part="part" raw="true" read="true" max="10" html="true" neuter="true" ridZ="ridZ" needExp="true">'
                            .'<ns1:header n="attribute-name" />'
                        .'</ns1:m>'
                    .'</ns1:GetMsgRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getMsg(
            $m
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getMsgMetadata(
            $m
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetMsgMetadataRequest>'
                        .'<ns1:m ids="ids" />'
                    .'</ns1:GetMsgMetadataRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getMsgMetadata(
            $m
        );

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getNote(
            $note
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetNoteRequest>'
                        .'<ns1:note id="id" />'
                    .'</ns1:GetNoteRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getNote(
            $note
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getNotifications(
            true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetNotificationsRequest markSeen="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getNotifications(
            true
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getOutgoingFilterRules();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetOutgoingFilterRulesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getOutgoingFilterRules();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getPermission(
            array($ace)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetPermissionRequest>'
                        .'<ns1:ace right="right" />'
                    .'</ns1:GetPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getPermission(
            array($ace)
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getRecur(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetRecurRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getRecur(
            'id'
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getSearchFolder();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetSearchFolderRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getSearchFolder();

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getShareDetails(
            $item
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetShareDetailsRequest>'
                        .'<ns1:item id="id" />'
                    .'</ns1:GetShareDetailsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getShareDetails(
            $item
        );

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getShareNotifications();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetShareNotificationsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getShareNotifications();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getSpellDictionaries();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetSpellDictionariesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getSpellDictionaries();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getSystemRetentionPolicy();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetSystemRetentionPolicyRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getSystemRetentionPolicy();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getTag();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetTagRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getTag();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getTask(true, true, 'uid', 'id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetTaskRequest sync="true" includeContent="true" uid="uid" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getTask(true, true, 'uid', 'id');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getTaskSummaries(10, 10, 'l');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetTaskSummariesRequest s="10" e="10" l="l" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getTaskSummaries(10, 10, 'l');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getWatchers();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetWatchersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getWatchers();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getWatchingItems();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetWatchingItemsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getWatchingItems();

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getWorkingHours(10, 10, 'id', 'name');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetWorkingHoursRequest s="10" e="10" id="id" name="name" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getWorkingHours(10, 10, 'id', 'name');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getYahooAuthToken('user', 'password');

        $client = $api->client();
        $req = $client->lastRequest('user', 'password');
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetYahooAuthTokenRequest user="user" password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getYahooAuthToken('user', 'password');

        $client = $api->client();
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
        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->getYahooCookie('user');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GetYahooCookieRequest user="user" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->getYahooCookie('user');

        $client = $api->client();
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

        $api = new LocalMailWsdl(__DIR__.'/../TestData/ZimbraUserService.wsdl');
        $api->grantPermission(array($ace));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:GrantPermissionRequest>'
                        .'<ns1:ace gt="usr" right="invite" zid="zid" d="d" key="key" pw="pw" deny="false" />'
                    .'</ns1:GrantPermissionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalMailHttp(null);
        $api->grantPermission(array($ace));

        $client = $api->client();
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
