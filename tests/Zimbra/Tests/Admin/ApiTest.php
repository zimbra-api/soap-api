<?php

namespace Zimbra\Tests\Admin;

use Zimbra\Admin\AdminFactory;
use Zimbra\Admin\Base as AdminBase;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\AclType;
use Zimbra\Enum\AttrMethod;
use Zimbra\Enum\AuthScheme;
use Zimbra\Enum\AutoProvPrincipalBy as PrincipalBy;
use Zimbra\Enum\AutoProvTaskAction as TaskAction;
use Zimbra\Enum\DataSourceBy;
use Zimbra\Enum\CacheEntryBy;
use Zimbra\Enum\CalendarResourceBy as CalResBy;
use Zimbra\Enum\CertType;
use Zimbra\Enum\CompactIndexAction as IndexAction;
use Zimbra\Enum\ConditionOperator as CondOp;
use Zimbra\Enum\CountObjectsType as ObjType;
use Zimbra\Enum\CosBy;
use Zimbra\Enum\CSRType;
use Zimbra\Enum\CSRKeySize;
use Zimbra\Enum\DataSourceType;
use Zimbra\Enum\DedupAction;
use Zimbra\Enum\DeployZimletAction as DeployAction;
use Zimbra\Enum\DirectorySearchType as DirSearchType;
use Zimbra\Enum\DistributionListBy as DLBy;
use Zimbra\Enum\DomainBy;
use Zimbra\Enum\EntryType;
use Zimbra\Enum\GalMode;
use Zimbra\Enum\GalConfigAction;
use Zimbra\Enum\GalSearchType;
use Zimbra\Enum\GranteeType;
use Zimbra\Enum\GranteeBy;
use Zimbra\Enum\GetSessionsSortBy as SessionsSortBy;
use Zimbra\Enum\InterestType;
use Zimbra\Enum\LoggingLevel;
use Zimbra\Enum\IpType;
use Zimbra\Enum\QueueAction;
use Zimbra\Enum\QueueActionBy;
use Zimbra\Enum\QuotaSortBy;
use Zimbra\Enum\ReIndexAction;
use Zimbra\Enum\RightClass;
use Zimbra\Enum\ServerBy;
use Zimbra\Enum\SessionType;
use Zimbra\Enum\TargetType;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\Type;
use Zimbra\Enum\UcServiceBy;
use Zimbra\Enum\XmppComponentBy as XmppBy;
use Zimbra\Enum\VolumeType;
use Zimbra\Enum\VersionCheckAction;
use Zimbra\Enum\ZimletStatus;
use Zimbra\Enum\ZimletExcludeType as ExcludeType;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Tests\Soap\LocalClientWsdl;
use Zimbra\Tests\Soap\LocalClientHttp;

/**
 * Api test case class for admin request.
 */
class ApiTest extends ZimbraTestCase
{
    public function testAdminFactory()
    {
        $httpApi = AdminFactory::instance();
        $this->assertInstanceOf('\Zimbra\Admin\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Admin\Http', $httpApi);

        $httpApi = AdminFactory::instance(__DIR__.'/../TestData/ZimbraAdminService.wsdl', 'wsdl');
        $this->assertInstanceOf('\Zimbra\Admin\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Admin\Wsdl', $httpApi);
    }

    public function testAddAccountAlias()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->addAccountAlias(
            'id', 'alias'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AddAccountAliasRequest '
                        .'id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->addAccountAlias(
            'id', 'alias'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AddAccountAliasRequest '
                        .'id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddAccountLogger()
    {
        $logger = new \Zimbra\Admin\Struct\LoggerInfo('category', LoggingLevel::ERROR());
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->addAccountLogger(
            $logger, $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AddAccountLoggerRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:logger category="category" level="error" />'
                    .'</ns1:AddAccountLoggerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->addAccountLogger(
            $logger, $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AddAccountLoggerRequest>'
                        .'<urn1:logger category="category" level="error" />'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:AddAccountLoggerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddDistributionListAlias()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->addDistributionListAlias(
            'id', 'alias'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AddDistributionListAliasRequest '
                        .'id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->addDistributionListAlias(
            'id', 'alias'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AddDistributionListAliasRequest '
                        .'id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddDistributionListMember()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->addDistributionListMember(
            'id', array('member1', 'member2')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AddDistributionListMemberRequest id="id">'
                        .'<ns1:dlm>member1</ns1:dlm>'
                        .'<ns1:dlm>member2</ns1:dlm>'
                    .'</ns1:AddDistributionListMemberRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->addDistributionListMember(
            'id', array('member1', 'member2')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AddDistributionListMemberRequest id="id">'
                        .'<urn1:dlm>member1</urn1:dlm>'
                        .'<urn1:dlm>member2</urn1:dlm>'
                    .'</urn1:AddDistributionListMemberRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddGalSyncDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->addGalSyncDataSource(
            $account, 'name', 'domain', GalMode::BOTH(), 'folder', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AddGalSyncDataSourceRequest name="name" domain="domain" type="both" folder="folder">'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:AddGalSyncDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->addGalSyncDataSource(
            $account, 'name', 'domain', GalMode::BOTH(), 'folder', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AddGalSyncDataSourceRequest name="name" domain="domain" type="both" folder="folder">'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:AddGalSyncDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminCreateWaitSet()
    {
        $a = new \Zimbra\Admin\Struct\WaitSetAddSpec(
            'name', 'id', 'token', array(InterestType::MESSAGES(), InterestType::CONTACTS())
        );
        $add = new \Zimbra\Admin\Struct\WaitSetSpec(array($a));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->adminCreateWaitSet(
            $add, array(InterestType::FOLDERS(), InterestType::MESSAGES()), true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                        .'<ns1:add>'
                            .'<ns1:a name="name" id="id" token="token" types="m,c" />'
                        .'</ns1:add>'
                    .'</ns1:AdminCreateWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->adminCreateWaitSet(
            $add, array(InterestType::FOLDERS(), InterestType::MESSAGES()), true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                        .'<urn1:add>'
                            .'<urn1:a name="name" id="id" token="token" types="m,c" />'
                        .'</urn1:add>'
                    .'</urn1:AdminCreateWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminDestroyWaitSet()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->adminDestroyWaitSet(
            'waitSet'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AdminDestroyWaitSetRequest '
                        .'waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->adminDestroyWaitSet(
            'waitSet'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AdminDestroyWaitSetRequest '
                        .'waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminWaitSet()
    {
        $a = new \Zimbra\Admin\Struct\WaitSetAddSpec(
            'name', 'id', 'token', array(InterestType::FOLDERS(), InterestType::MESSAGES(), InterestType::CONTACTS())
        );
        $add = new \Zimbra\Admin\Struct\WaitSetSpec(array($a));
        $update = new \Zimbra\Admin\Struct\WaitSetSpec(array($a));
        $a = new \Zimbra\Struct\Id('id');
        $remove = new \Zimbra\Admin\Struct\WaitSetId(array($a));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->adminWaitSet(
            'waitSet', 'seq', $add, $update, $remove, true, array(InterestType::FOLDERS(), InterestType::MESSAGES()), 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AdminWaitSetRequest waitSet="waitSet" seq="seq" block="true" defTypes="f,m" timeout="1000" >'
                        .'<ns1:add>'
                            .'<ns1:a name="name" id="id" token="token" types="f,m,c" />'
                        .'</ns1:add>'
                        .'<ns1:update>'
                            .'<ns1:a name="name" id="id" token="token" types="f,m,c" />'
                        .'</ns1:update>'
                        .'<ns1:remove>'
                            .'<ns1:a id="id" />'
                        .'</ns1:remove>'
                    .'</ns1:AdminWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->adminWaitSet(
            'waitSet', 'seq', $add, $update, $remove, true, array(InterestType::FOLDERS(), InterestType::MESSAGES()), 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AdminWaitSetRequest waitSet="waitSet" seq="seq" block="true" defTypes="f,m" timeout="1000" >'
                        .'<urn1:add>'
                            .'<urn1:a name="name" id="id" token="token" types="f,m,c" />'
                        .'</urn1:add>'
                        .'<urn1:update>'
                            .'<urn1:a name="name" id="id" token="token" types="f,m,c" />'
                        .'</urn1:update>'
                        .'<urn1:remove>'
                            .'<urn1:a id="id" />'
                        .'</urn1:remove>'
                    .'</urn1:AdminWaitSetRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuth()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->auth(
            'name', 'password', 'authToken', $account, 'virtualHost', true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AuthRequest name="name" password="password" persistAuthTokenCookie="true">'
                        .'<ns1:authToken>authToken</ns1:authToken>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->auth(
            'name', 'password', 'authToken', $account, 'virtualHost', true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AuthRequest name="name" password="password" persistAuthTokenCookie="true">'
                        .'<urn1:authToken>authToken</urn1:authToken>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByName()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->authByName(
            'name', 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AuthRequest name="name" password="password" persistAuthTokenCookie="true">'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->authByName(
            'name', 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AuthRequest name="name" password="password" persistAuthTokenCookie="true">'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAccount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->authByAccount(
            $account, 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AuthRequest password="password" persistAuthTokenCookie="true">'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:virtualHost>virtualHost</ns1:virtualHost>'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->authByAccount(
            $account, 'password', 'virtualHost'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AuthRequest password="password" persistAuthTokenCookie="true">'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:virtualHost>virtualHost</urn1:virtualHost>'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->authByToken(
            'authToken'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AuthRequest persistAuthTokenCookie="true">'
                        .'<ns1:authToken>authToken</ns1:authToken>'
                    .'</ns1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->authByToken(
            'authToken'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AuthRequest persistAuthTokenCookie="true">'
                        .'<urn1:authToken>authToken</urn1:authToken>'
                    .'</urn1:AuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoCompleteGal()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->autoCompleteGal(
            'domain', 'name', GalSearchType::ACCOUNT(), 'galAcctId', 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AutoCompleteGalRequest '
                        .'domain="domain" name="name" type="account" galAcctId="galAcctId" limit="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->autoCompleteGal(
            'domain', 'name', GalSearchType::ACCOUNT(), 'galAcctId', 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AutoCompleteGalRequest '
                        .'domain="domain" name="name" type="account" galAcctId="galAcctId" limit="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoProvAccount()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $principal = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), 'principal');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->autoProvAccount(
            $domain, $principal, 'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AutoProvAccountRequest>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                        .'<ns1:principal by="dn">principal</ns1:principal>'
                        .'<ns1:password>password</ns1:password>'
                    .'</ns1:AutoProvAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->autoProvAccount(
            $domain, $principal, 'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AutoProvAccountRequest>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                        .'<urn1:principal by="dn">principal</urn1:principal>'
                        .'<urn1:password>password</urn1:password>'
                    .'</urn1:AutoProvAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoProvTaskControl()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->autoProvTaskControl(
            TaskAction::STATUS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:AutoProvTaskControlRequest '
                        .'action="status" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->autoProvTaskControl(
            TaskAction::STATUS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:AutoProvTaskControlRequest '
                        .'action="status" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckAuthConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkAuthConfig(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckAuthConfigRequest name="name" password="password">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CheckAuthConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkAuthConfig(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckAuthConfigRequest name="name" password="password">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CheckAuthConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckBlobConsistency()
    {
        $volume = new \Zimbra\Admin\Struct\IntIdAttr(10);
        $mbox = new \Zimbra\Admin\Struct\IntIdAttr(10);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkBlobConsistency(
            array($volume), array($mbox), true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="false">'
                        .'<ns1:volume id="10" />'
                        .'<ns1:mbox id="10" />'
                    .'</ns1:CheckBlobConsistencyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkBlobConsistency(
            array($volume), array($mbox), true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="false">'
                        .'<urn1:volume id="10" />'
                        .'<urn1:mbox id="10" />'
                    .'</urn1:CheckBlobConsistencyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckDirectory()
    {
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector('path', true);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkDirectory(
            array($dir)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckDirectoryRequest>'
                        .'<ns1:directory path="path" create="true" />'
                    .'</ns1:CheckDirectoryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkDirectory(
            array($dir)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckDirectoryRequest>'
                        .'<urn1:directory path="path" create="true" />'
                    .'</urn1:CheckDirectoryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckDomainMXRecord()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkDomainMXRecord(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckDomainMXRecordRequest>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:CheckDomainMXRecordRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkDomainMXRecord(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckDomainMXRecordRequest>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:CheckDomainMXRecordRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckExchangeAuth()
    {
        $auth = new \Zimbra\Admin\Struct\ExchangeAuthSpec(
            'url', 'user', 'pass', AuthScheme::FORM(), 'type'
        );

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkExchangeAuth(
            $auth
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckExchangeAuthRequest>'
                        .'<ns1:auth url="url" user="user" pass="pass" scheme="form" type="type" />'
                    .'</ns1:CheckExchangeAuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkExchangeAuth(
            $auth
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckExchangeAuthRequest>'
                        .'<urn1:auth url="url" user="user" pass="pass" scheme="form" type="type" />'
                    .'</urn1:CheckExchangeAuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckGalConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $query = new \Zimbra\Admin\Struct\LimitedQuery(100, 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkGalConfig(
            $query, GalConfigAction::SEARCH(), array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckGalConfigRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:query limit="100">value</ns1:query>'
                        .'<ns1:action>search</ns1:action>'
                    .'</ns1:CheckGalConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkGalConfig(
            $query, GalConfigAction::SEARCH(), array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckGalConfigRequest>'
                        .'<urn1:query limit="100">value</urn1:query>'
                        .'<urn1:action>search</urn1:action>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CheckGalConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckHealth()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkHealth();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckHealthRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkHealth();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckHealthRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckHostnameResolve()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkHostnameResolve(
            'hostname'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckHostnameResolveRequest '
                        .'hostname="hostname" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkHostnameResolve(
            'hostname'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckHostnameResolveRequest '
                        .'hostname="hostname" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckPasswordStrength()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkPasswordStrength(
            'id', 'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckPasswordStrengthRequest '
                        .'id="id" password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkPasswordStrength(
            'id', 'password'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckPasswordStrengthRequest '
                        .'id="id" password="password" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckRight()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->checkRight(
            $target, $grantee, 'right', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CheckRightRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                        .'<ns1:right>right</ns1:right>'
                    .'</ns1:CheckRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->checkRight(
            $target, $grantee, 'right', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CheckRightRequest>'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                        .'<urn1:right>right</urn1:right>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CheckRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testClearCookie()
    {
        $cookie = new \Zimbra\Admin\Struct\CookieSpec('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->clearCookie(
            array($cookie)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ClearCookieRequest>'
                        .'<ns1:cookie name="name" />'
                    .'</ns1:ClearCookieRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->clearCookie(
            array($cookie)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ClearCookieRequest>'
                        .'<urn1:cookie name="name" />'
                    .'</urn1:ClearCookieRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCompactIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->compactIndex(
            $mbox, IndexAction::STATUS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CompactIndexRequest action="status">'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:CompactIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->compactIndex(
            $mbox, IndexAction::STATUS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CompactIndexRequest action="status">'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:CompactIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testComputeAggregateQuotaUsage()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->computeAggregateQuotaUsage();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ComputeAggregateQuotaUsageRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->computeAggregateQuotaUsage();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ComputeAggregateQuotaUsageRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testConfigureZimlet()
    {
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib('aid');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->configureZimlet(
            $content
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ConfigureZimletRequest>'
                        .'<ns1:content aid="aid" />'
                    .'</ns1:ConfigureZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->configureZimlet(
            $content
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ConfigureZimletRequest>'
                        .'<urn1:content aid="aid" />'
                    .'</urn1:ConfigureZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCopyCos()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->copyCos(
            'name', $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CopyCosRequest>'
                        .'<ns1:name>name</ns1:name>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                    .'</ns1:CopyCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->copyCos(
            'name', $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CopyCosRequest>'
                        .'<urn1:name>name</urn1:name>'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:CopyCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCountAccount()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->countAccount(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CountAccountRequest>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:CountAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->countAccount(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CountAccountRequest>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:CountAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCountObjects()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->countObjects(
            ObjType::ACCOUNT(), $domain, $ucservice
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CountObjectsRequest type="account">'
                        .'<ns1:domain by="name">value</ns1:domain>'
                        .'<ns1:ucservice by="name">value</ns1:ucservice>'
                    .'</ns1:CountObjectsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->countObjects(
            ObjType::ACCOUNT(), $domain, $ucservice
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CountObjectsRequest type="account">'
                        .'<urn1:domain by="name">value</urn1:domain>'
                        .'<urn1:ucservice by="name">value</urn1:ucservice>'
                    .'</urn1:CountObjectsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createAccount(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateAccountRequest name="name" password="password">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createAccount(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateAccountRequest name="name" password="password">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateCalendarResource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createCalendarResource(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateCalendarResourceRequest name="name" password="password">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createCalendarResource(
            'name', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateCalendarResourceRequest name="name" password="password">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateCos()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createCos(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateCosRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:name>name</ns1:name>'
                    .'</ns1:CreateCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createCos(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateCosRequest>'
                        .'<urn1:name>name</urn1:name>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::POP3(), 'name', array($attr));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createDataSource(
            'id', $dataSource
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateDataSourceRequest id="id">'
                        .'<ns1:dataSource type="pop3" name="name">'
                            .'<ns1:a n="key">value</ns1:a>'
                        .'</ns1:dataSource>'
                    .'</ns1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createDataSource(
            'id', $dataSource
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateDataSourceRequest id="id">'
                        .'<urn1:dataSource type="pop3" name="name">'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:dataSource>'
                    .'</urn1:CreateDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createDistributionList(
            'name', true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateDistributionListRequest name="name" dynamic="true">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createDistributionList(
            'name', true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateDistributionListRequest name="name" dynamic="true">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDomain()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createDomain(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateDomainRequest name="name">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createDomain(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateDomainRequest name="name">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateGalSyncAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createGalSyncAccount(
            $account, 'name', 'domain', GalMode::LDAP(), 'server', 'password', 'folder', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateGalSyncAccountRequest name="name" domain="domain" type="ldap" server="server" password="password" folder="folder">'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:CreateGalSyncAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createGalSyncAccount(
            $account, 'name', 'domain', GalMode::LDAP(), 'server', 'password', 'folder', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateGalSyncAccountRequest name="name" domain="domain" type="ldap" server="server" password="password" folder="folder">'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateGalSyncAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateLDAPEntry()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createLDAPEntry(
            'dn', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateLDAPEntryRequest dn="dn">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateLDAPEntryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createLDAPEntry(
            'dn', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateLDAPEntryRequest dn="dn">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateLDAPEntryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateServer()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createServer(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateServerRequest name="name">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createServer(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateServerRequest name="name">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');

        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $policy = new \Zimbra\Admin\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createSystemRetentionPolicy(
            $cos, $keep, $purge
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin" xmlns:ns2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:CreateSystemRetentionPolicyRequest>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                        .'<ns1:keep>'
                            .'<ns2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                        .'</ns1:keep>'
                        .'<ns1:purge>'
                            .'<ns2:policy type="user" id="id" name="name" lifetime="lifetime" />'
                        .'</ns1:purge>'
                    .'</ns1:CreateSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createSystemRetentionPolicy(
            $cos, $keep, $purge
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateSystemRetentionPolicyRequest>'
                        .'<urn1:cos by="name">value</urn1:cos>'
                        .'<urn1:keep>'
                            .'<policy xmlns="urn:zimbraMail" type="system" id="id" name="name" lifetime="lifetime" />'
                        .'</urn1:keep>'
                        .'<urn1:purge>'
                            .'<policy xmlns="urn:zimbraMail" type="user" id="id" name="name" lifetime="lifetime" />'
                        .'</urn1:purge>'
                    .'</urn1:CreateSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateUCService()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createUCService(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateUCServiceRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:name>name</ns1:name>'
                    .'</ns1:CreateUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createUCService(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateUCServiceRequest>'
                        .'<urn1:name>name</urn1:name>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateVolume()
    {
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(10, 2, 3, 4, 5, 6, 7, 'name', 'rootpath', false, true);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createVolume(
            $volume
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateVolumeRequest>'
                        .'<ns1:volume '
                            .'id="10" '
                            .'type="2" '
                            .'compressionThreshold="3" '
                            .'mgbits="4" '
                            .'mbits="5" '
                            .'fgbits="6" '
                            .'fbits="7" '
                            .'name="name" '
                            .'rootpath="rootpath" '
                            .'compressBlobs="false" '
                            .'isCurrent="true" />'
                    .'</ns1:CreateVolumeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createVolume(
            $volume
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateVolumeRequest>'
                        .'<urn1:volume '
                            .'id="10" '
                            .'type="2" '
                            .'compressionThreshold="3" '
                            .'mgbits="4" '
                            .'mbits="5" '
                            .'fgbits="6" '
                            .'fbits="7" '
                            .'name="name" '
                            .'rootpath="rootpath" '
                            .'compressBlobs="false" '
                            .'isCurrent="true" />'
                    .'</urn1:CreateVolumeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateXMPPComponent()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'domain');
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec('name', $domain, $server, array($attr));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createXMPPComponent(
            $xmpp
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateXMPPComponentRequest>'
                        .'<ns1:xmppcomponent name="name">'
                            .'<ns1:a n="key">value</ns1:a>'
                            .'<ns1:domain by="name">domain</ns1:domain>'
                            .'<ns1:server by="name">server</ns1:server>'
                        .'</ns1:xmppcomponent>'
                    .'</ns1:CreateXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createXMPPComponent(
            $xmpp
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateXMPPComponentRequest>'
                        .'<urn1:xmppcomponent name="name">'
                            .'<urn1:domain by="name">domain</urn1:domain>'
                            .'<urn1:server by="name">server</urn1:server>'
                            .'<urn1:a n="key">value</urn1:a>'
                        .'</urn1:xmppcomponent>'
                    .'</urn1:CreateXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateZimlet()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->createZimlet(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:CreateZimletRequest name="name">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:CreateZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->createZimlet(
            'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:CreateZimletRequest name="name">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:CreateZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }
}

class LocalAdminWsdl extends AdminBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientWsdl($this->_location);
    }
}

class LocalAdminHttp extends AdminBase
{
    public function __construct($location)
    {
        parent::__construct($location);
        $this->_client = new LocalClientHttp($this->_location);
    }
}
