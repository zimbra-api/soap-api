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
 * Api test case class for admin api.
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
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:CreateSystemRetentionPolicyRequest>'
                        .'<urn1:cos by="name">value</urn1:cos>'
                        .'<urn1:keep>'
                            .'<urn2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                        .'</urn1:keep>'
                        .'<urn1:purge>'
                            .'<urn2:policy type="user" id="id" name="name" lifetime="lifetime" />'
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

    public function testDedupeBlobs()
    {
        $volume = new \Zimbra\Admin\Struct\IntIdAttr(10);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->dedupeBlobs(
            DedupAction::STATUS(), array($volume)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DedupeBlobsRequest action="status">'
                        .'<ns1:volume id="10" />'
                    .'</ns1:DedupeBlobsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->dedupeBlobs(
            DedupAction::STATUS(), array($volume)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DedupeBlobsRequest action="status">'
                        .'<urn1:volume id="10" />'
                    .'</urn1:DedupeBlobsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDelegateAuth()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->delegateAuth(
            $account, 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DelegateAuthRequest duration="1000">'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:DelegateAuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->delegateAuth(
            $account, 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DelegateAuthRequest duration="1000">'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:DelegateAuthRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteAccount()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteAccount(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteAccountRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteAccount(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteAccountRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteCalendarResource()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteCalendarResource(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteCalendarResourceRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteCalendarResource(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteCalendarResourceRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteCos()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteCos(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteCosRequest>'
                        .'<ns1:id>id</ns1:id>'
                    .'</ns1:DeleteCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteCos(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteCosRequest>'
                        .'<urn1:id>id</urn1:id>'
                    .'</urn1:DeleteCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Struct\Id('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteDataSource(
            'id', $dataSource, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteDataSourceRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:dataSource id="id" />'
                    .'</ns1:DeleteDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteDataSource(
            'id', $dataSource, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteDataSourceRequest id="id">'
                        .'<urn1:dataSource id="id" />'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:DeleteDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDistributionList()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteDistributionList(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteDistributionListRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteDistributionList(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteDistributionListRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDomain()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteDomain(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteDomainRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteDomain(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteDomainRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteGalSyncAccount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteGalSyncAccount(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteGalSyncAccountRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:DeleteGalSyncAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteGalSyncAccount(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteGalSyncAccountRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:DeleteGalSyncAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteLDAPEntry()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteLDAPEntry(
            'dn'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteLDAPEntryRequest dn="dn" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteLDAPEntry(
            'dn'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteLDAPEntryRequest dn="dn" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteMailbox()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteMailbox(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteMailboxRequest>'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:DeleteMailboxRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteMailbox(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteMailboxRequest>'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:DeleteMailboxRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteServer()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteServer(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteServerRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteServer(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteServerRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteSystemRetentionPolicy(
            $policy, $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin" xmlns:ns2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:DeleteSystemRetentionPolicyRequest>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                        .'<ns2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                    .'</ns1:DeleteSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteSystemRetentionPolicy(
            $policy, $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:DeleteSystemRetentionPolicyRequest>'
                        .'<urn2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:DeleteSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteUCService()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteUCService(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteUCServiceRequest>'
                        .'<ns1:id>id</ns1:id>'
                    .'</ns1:DeleteUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteUCService(
            'id'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteUCServiceRequest>'
                        .'<urn1:id>id</urn1:id>'
                    .'</urn1:DeleteUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteVolume()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteVolume(
            100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteVolumeRequest id="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteVolume(
            100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteVolumeRequest id="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteXMPPComponent()
    {
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteXMPPComponent(
            $xmpp
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteXMPPComponentRequest>'
                        .'<ns1:xmppcomponent by="name">value</ns1:xmppcomponent>'
                    .'</ns1:DeleteXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteXMPPComponent(
            $xmpp
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteXMPPComponentRequest>'
                        .'<urn1:xmppcomponent by="name">value</urn1:xmppcomponent>'
                    .'</urn1:DeleteXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteZimlet()
    {
        $zimlet = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deleteZimlet(
            $zimlet
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeleteZimletRequest>'
                        .'<ns1:zimlet name="name" />'
                    .'</ns1:DeleteZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deleteZimlet(
            $zimlet
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeleteZimletRequest>'
                        .'<urn1:zimlet name="name" />'
                    .'</urn1:DeleteZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeployZimlet()
    {
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib('aid');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->deployZimlet(
            DeployAction::DEPLOY_LOCAL(), $content, true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DeployZimletRequest action="deployLocal" flush="true" synchronous="false">'
                        .'<ns1:content aid="aid" />'
                    .'</ns1:DeployZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->deployZimlet(
            DeployAction::DEPLOY_LOCAL(), $content, true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DeployZimletRequest action="deployLocal" flush="true" synchronous="false">'
                        .'<urn1:content aid="aid" />'
                    .'</urn1:DeployZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDumpSessions()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->dumpSessions(
            true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:DumpSessionsRequest listSessions="true" groupByAccount="false" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->dumpSessions(
            true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:DumpSessionsRequest listSessions="true" groupByAccount="false" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testExportAndDeleteItems()
    {
        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec(2, 3);
        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec(10, array($item));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->exportAndDeleteItems(
            $mbox, 'exportDir', 'exportFilenamePrefix'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ExportAndDeleteItemsRequest exportDir="exportDir" exportFilenamePrefix="exportFilenamePrefix">'
                        .'<ns1:mbox id="10">'
                            .'<ns1:item id="2" version="3" />'
                        .'</ns1:mbox>'
                    .'</ns1:ExportAndDeleteItemsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->exportAndDeleteItems(
            $mbox, 'exportDir', 'exportFilenamePrefix'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ExportAndDeleteItemsRequest exportDir="exportDir" exportFilenamePrefix="exportFilenamePrefix">'
                        .'<urn1:mbox id="10">'
                            .'<urn1:item id="2" version="3" />'
                        .'</urn1:mbox>'
                    .'</urn1:ExportAndDeleteItemsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarEndTime()
    {
        $account = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->fixCalendarEndTime(
            true, array($account)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:FixCalendarEndTimeRequest sync="true">'
                        .'<ns1:account name="name" />'
                    .'</ns1:FixCalendarEndTimeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->fixCalendarEndTime(
            true, array($account)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:FixCalendarEndTimeRequest sync="true">'
                        .'<urn1:account name="name" />'
                    .'</urn1:FixCalendarEndTimeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarPriority()
    {
        $account = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->fixCalendarPriority(
            true, array($account)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:FixCalendarPriorityRequest sync="true">'
                        .'<ns1:account name="name" />'
                    .'</ns1:FixCalendarPriorityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->fixCalendarPriority(
            true, array($account)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:FixCalendarPriorityRequest sync="true">'
                        .'<urn1:account name="name" />'
                    .'</urn1:FixCalendarPriorityRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarTZ()
    {
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id('id');
        $nonDst = new \Zimbra\Admin\Struct\Offset(100);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(10, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 4);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 10, 10);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(10, 10);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(12, 20);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 10, 10);
        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Struct\Id('id');
        $standard = new \Zimbra\Struct\TzOnsetInfo(12, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 10);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo('id', 10, 10, $standard, $daylight, 'stdname', 'dayname');
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);

        $tzfixup = new \Zimbra\Admin\Struct\TzFixup(array($fixupRule));
        $account = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->fixCalendarTZ(
            array($account), $tzfixup, true, 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:FixCalendarTZRequest sync="true" after="1000">'
                        .'<ns1:account name="name" />'
                        .'<ns1:tzfixup>'
                            .'<ns1:fixupRule>'
                                .'<ns1:match>'
                                    .'<ns1:any />'
                                    .'<ns1:tzid id="id" />'
                                    .'<ns1:nonDst offset="100" />'
                                    .'<ns1:rules stdoff="10" dayoff="10">'
                                        .'<ns1:standard mon="10" week="2" wkday="3" />'
                                        .'<ns1:daylight mon="3" week="2" wkday="4" />'
                                    .'</ns1:rules>'
                                    .'<ns1:dates stdoff="10" dayoff="10">'
                                        .'<ns1:standard mon="10" mday="10" />'
                                        .'<ns1:daylight mon="12" mday="20" />'
                                    .'</ns1:dates>'
                                .'</ns1:match>'
                                .'<ns1:touch />'
                                .'<ns1:replace>'
                                    .'<ns1:wellKnownTz id="id" />'
                                    .'<ns1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                        .'<ns1:standard mon="12" hour="2" min="3" sec="4" />'
                                        .'<ns1:daylight mon="4" hour="3" min="2" sec="10" />'
                                    .'</ns1:tz>'
                                .'</ns1:replace>'
                            .'</ns1:fixupRule>'
                        .'</ns1:tzfixup>'
                    .'</ns1:FixCalendarTZRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->fixCalendarTZ(
            array($account), $tzfixup, true, 1000
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:FixCalendarTZRequest sync="true" after="1000">'
                        .'<urn1:tzfixup>'
                            .'<urn1:fixupRule>'
                                .'<urn1:match>'
                                    .'<urn1:any />'
                                    .'<urn1:tzid id="id" />'
                                    .'<urn1:nonDst offset="100" />'
                                    .'<urn1:rules stdoff="10" dayoff="10">'
                                        .'<urn1:standard mon="10" week="2" wkday="3" />'
                                        .'<urn1:daylight mon="3" week="2" wkday="4" />'
                                    .'</urn1:rules>'
                                    .'<urn1:dates stdoff="10" dayoff="10">'
                                        .'<urn1:standard mon="10" mday="10" />'
                                        .'<urn1:daylight mon="12" mday="20" />'
                                    .'</urn1:dates>'
                                .'</urn1:match>'
                                .'<urn1:touch />'
                                .'<urn1:replace>'
                                    .'<urn1:wellKnownTz id="id" />'
                                    .'<urn1:tz id="id" stdoff="10" dayoff="10" stdname="stdname" dayname="dayname">'
                                        .'<urn1:standard mon="12" hour="2" min="3" sec="4" />'
                                        .'<urn1:daylight mon="4" hour="3" min="2" sec="10" />'
                                    .'</urn1:tz>'
                                .'</urn1:replace>'
                            .'</urn1:fixupRule>'
                        .'</urn1:tzfixup>'
                        .'<urn1:account name="name" />'
                    .'</urn1:FixCalendarTZRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFlushCache()
    {
        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'value');
        $cache = new \Zimbra\Admin\Struct\CacheSelector('skin,account', true, array($entry));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->flushCache(
            $cache
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:FlushCacheRequest>'
                        .'<ns1:cache type="skin,account" allServers="true">'
                            .'<ns1:entry by="name">value</ns1:entry>'
                        .'</ns1:cache>'
                    .'</ns1:FlushCacheRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->flushCache(
            $cache
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:FlushCacheRequest>'
                        .'<urn1:cache type="skin,account" allServers="true">'
                            .'<urn1:entry by="name">value</urn1:entry>'
                        .'</urn1:cache>'
                    .'</urn1:FlushCacheRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGenCSR()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->genCSR(
            'server', true, CSRType::COMM(), CSRKeySize::SIZE_2048(), 'c', 'st', 'l', 'o', 'ou', 'cn', array('subject')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GenCSRRequest server="server" new="1" type="comm" keysize="2048">'
                        .'<ns1:C>c</ns1:C>'
                        .'<ns1:ST>st</ns1:ST>'
                        .'<ns1:L>l</ns1:L>'
                        .'<ns1:O>o</ns1:O>'
                        .'<ns1:OU>ou</ns1:OU>'
                        .'<ns1:CN>cn</ns1:CN>'
                        .'<ns1:SubjectAltName>subject</ns1:SubjectAltName>'
                    .'</ns1:GenCSRRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->genCSR(
            'server', true, CSRType::COMM(), CSRKeySize::SIZE_2048(), 'c', 'st', 'l', 'o', 'ou', 'cn', array('subject')
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GenCSRRequest server="server" new="true" type="comm" keysize="2048">'
                        .'<urn1:C>c</urn1:C>'
                        .'<urn1:ST>st</urn1:ST>'
                        .'<urn1:L>l</urn1:L>'
                        .'<urn1:O>o</urn1:O>'
                        .'<urn1:OU>ou</urn1:OU>'
                        .'<urn1:CN>cn</urn1:CN>'
                        .'<urn1:SubjectAltName>subject</urn1:SubjectAltName>'
                    .'</urn1:GenCSRRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAccount(
            $account, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAccountRequest applyCos="true" attrs="attrs">'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAccount(
            $account, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAccountRequest applyCos="true" attrs="attrs">'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountInfo()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAccountInfo(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAccountInfoRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetAccountInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAccountInfo(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAccountInfoRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetAccountInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountLoggers()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAccountLoggers(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAccountLoggersRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetAccountLoggersRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAccountLoggers(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAccountLoggersRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetAccountLoggersRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountMembership()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAccountMembership(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAccountMembershipRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetAccountMembershipRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAccountMembership(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAccountMembershipRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetAccountMembershipRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminConsoleUIComp()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAdminConsoleUIComp(
            $account, $dl
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAdminConsoleUICompRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:dl by="name">value</ns1:dl>'
                    .'</ns1:GetAdminConsoleUICompRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAdminConsoleUIComp(
            $account, $dl
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAdminConsoleUICompRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:dl by="name">value</urn1:dl>'
                    .'</urn1:GetAdminConsoleUICompRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminExtensionZimlets()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAdminExtensionZimlets();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAdminExtensionZimletsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAdminExtensionZimlets();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAdminExtensionZimletsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminSavedSearches()
    {
        $search = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAdminSavedSearches(
            $search
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAdminSavedSearchesRequest>'
                        .'<ns1:search name="name" />'
                    .'</ns1:GetAdminSavedSearchesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAdminSavedSearches(
            $search
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAdminSavedSearchesRequest>'
                        .'<urn1:search name="name" />'
                    .'</urn1:GetAdminSavedSearchesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAggregateQuotaUsageOnServer()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAggregateQuotaUsageOnServer();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAggregateQuotaUsageOnServerRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAggregateQuotaUsageOnServer();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAggregateQuotaUsageOnServerRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAccountLoggers()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllAccountLoggers();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllAccountLoggersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllAccountLoggers();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllAccountLoggersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAccounts()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllAccounts(
            $server, $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllAccountsRequest>'
                        .'<ns1:server by="name">value</ns1:server>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:GetAllAccountsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllAccounts(
            $server, $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllAccountsRequest>'
                        .'<urn1:server by="name">value</urn1:server>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:GetAllAccountsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAdminAccounts()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllAdminAccounts(true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllAdminAccountsRequest applyCos="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllAdminAccounts(true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllAdminAccountsRequest applyCos="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllCalendarResources()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllCalendarResources(
            $server, $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllCalendarResourcesRequest>'
                        .'<ns1:server by="name">value</ns1:server>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:GetAllCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllCalendarResources(
            $server, $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllCalendarResourcesRequest>'
                        .'<urn1:server by="name">value</urn1:server>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:GetAllCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllConfig()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllCos()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllCos();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllCosRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllCos();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllCosRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllDistributionLists()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllDistributionLists(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllDistributionListsRequest>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:GetAllDistributionListsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllDistributionLists(
            $domain
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllDistributionListsRequest>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:GetAllDistributionListsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllDomains()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllDomains(true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllDomainsRequest applyConfig="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllDomains(true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllDomainsRequest applyConfig="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllEffectiveRights()
    {
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllEffectiveRights(
            $grantee, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllEffectiveRightsRequest expandAllAttrs="1">'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                    .'</ns1:GetAllEffectiveRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllEffectiveRights(
            $grantee, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllEffectiveRightsRequest expandAllAttrs="true">'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                    .'</urn1:GetAllEffectiveRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllFreeBusyProviders()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllFreeBusyProviders();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllFreeBusyProvidersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllFreeBusyProviders();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllFreeBusyProvidersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllLocales()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllLocales();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllLocalesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllMailboxes()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllMailboxes(100, 100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllMailboxesRequest limit="100" offset="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllMailboxes(100, 100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllMailboxesRequest limit="100" offset="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllRights()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllRights('targetType', true, RightClass::ALL());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllRightsRequest targetType="targetType" expandAllAttrs="true" rightClass="ALL" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllRights('targetType', true, RightClass::ALL());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllRightsRequest targetType="targetType" expandAllAttrs="true" rightClass="ALL" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllServers()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllServers('service', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllServersRequest service="service" applyConfig="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllServers('service', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllServersRequest service="service" applyConfig="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllSkins()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllSkins();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllSkinsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllSkins();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllSkinsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllUCProviders()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllUCProviders();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllUCProvidersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllUCProviders();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllUCProvidersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllUCServices()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllUCServices();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllUCServicesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllUCServices();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllUCServicesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllVolumes()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllVolumes();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllVolumesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllVolumes();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllVolumesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllXMPPComponents()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllXMPPComponents();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllXMPPComponentsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllXMPPComponents();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllXMPPComponentsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllZimlets()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAllZimlets(ExcludeType::MAIL());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAllZimletsRequest exclude="mail" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAllZimlets(ExcludeType::MAIL());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAllZimletsRequest exclude="mail" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAttributeInfo()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getAttributeInfo('attrs', array(EntryType::ACCOUNT(), EntryType::ACL_TARGET()));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetAttributeInfoRequest attrs="attrs" entryTypes="account,aclTarget" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getAttributeInfo('attrs', array(EntryType::ACCOUNT(), EntryType::ACL_TARGET()));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetAttributeInfoRequest attrs="attrs" entryTypes="account,aclTarget" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCalendarResource()
    {
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCalendarResource($calResource, true, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCalendarResourceRequest applyCos="true" attrs="attrs">'
                        .'<ns1:calresource by="name">value</ns1:calresource>'
                    .'</ns1:GetCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCalendarResource($calResource, true, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCalendarResourceRequest applyCos="true" attrs="attrs">'
                        .'<urn1:calresource by="name">value</urn1:calresource>'
                    .'</urn1:GetCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCert()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCert('server', CertType::MTA(), CSRType::COMM());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCertRequest server="server" type="mta" option="comm" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCert('server', CertType::MTA(), CSRType::COMM());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCertRequest server="server" type="mta" option="comm" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getConfig($attr);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetConfigRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:GetConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getConfig($attr);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetConfigRequest>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:GetConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCos()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCos($cos, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCosRequest attrs="attrs">'
                        .'<ns1:cos by="name">value</ns1:cos>'
                    .'</ns1:GetCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCos($cos, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCosRequest attrs="attrs">'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:GetCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCreateObjectAttrs()
    {
        $target = new \Zimbra\Admin\Struct\TargetWithType('type', 'value');
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCreateObjectAttrs($target, $domain, $cos);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCreateObjectAttrsRequest>'
                        .'<ns1:target type="type">value</ns1:target>'
                        .'<ns1:domain by="name">value</ns1:domain>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                    .'</ns1:GetCreateObjectAttrsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCreateObjectAttrs($target, $domain, $cos);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCreateObjectAttrsRequest>'
                        .'<urn1:target type="type">value</urn1:target>'
                        .'<urn1:domain by="name">value</urn1:domain>'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:GetCreateObjectAttrsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCSR()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCSR('server', CSRType::COMM());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCSRRequest server="server" type="comm" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCSR('server', CSRType::COMM());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCSRRequest server="server" type="comm" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCurrentVolumes()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getCurrentVolumes();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetCurrentVolumesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getCurrentVolumes();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetCurrentVolumesRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDataSources()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDataSources('id', array($attr));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDataSourcesRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:GetDataSourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDataSources('id', array($attr));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDataSourcesRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:GetDataSourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDelegatedAdminConstraints()
    {
        $attr = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDelegatedAdminConstraints(
            TargetType::DOMAIN(), 'id', 'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDelegatedAdminConstraintsRequest type="domain" id="id" name="name">'
                        .'<ns1:a name="name" />'
                    .'</ns1:GetDelegatedAdminConstraintsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDelegatedAdminConstraints(
            TargetType::DOMAIN(), 'id', 'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDelegatedAdminConstraintsRequest type="domain" id="id" name="name">'
                        .'<urn1:a name="name" />'
                    .'</urn1:GetDelegatedAdminConstraintsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDevices()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDevices(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDevicesRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                    .'</ns1:GetDevicesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDevices(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDevicesRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                    .'</urn1:GetDevicesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDistributionList(
            $dl, 100, 100, true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDistributionListRequest limit="100" offset="100" sortAscending="true">'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:dl by="name">value</ns1:dl>'
                    .'</ns1:GetDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDistributionList(
            $dl, 100, 100, true, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDistributionListRequest limit="100" offset="100" sortAscending="true">'
                        .'<urn1:dl by="name">value</urn1:dl>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:GetDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionListMembership()
    {
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDistributionListMembership(
            $dl, 100, 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDistributionListMembershipRequest limit="100" offset="100">'
                        .'<ns1:dl by="name">value</ns1:dl>'
                    .'</ns1:GetDistributionListMembershipRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDistributionListMembership(
            $dl, 100, 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDistributionListMembershipRequest limit="100" offset="100">'
                        .'<urn1:dl by="name">value</urn1:dl>'
                    .'</urn1:GetDistributionListMembershipRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDomain()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDomain(
            $domain, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDomainRequest applyConfig="true" attrs="attrs">'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:GetDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDomain(
            $domain, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDomainRequest applyConfig="true" attrs="attrs">'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:GetDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDomainInfo()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getDomainInfo(
            $domain, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetDomainInfoRequest applyConfig="true">'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:GetDomainInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getDomainInfo(
            $domain, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetDomainInfoRequest applyConfig="true">'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:GetDomainInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetEffectiveRights()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getEffectiveRights(
            $target, $grantee, AttrMethod::SET_ATTRS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetEffectiveRightsRequest expandAllAttrs="setAttrs">'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                    .'</ns1:GetEffectiveRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getEffectiveRights(
            $target, $grantee, AttrMethod::SET_ATTRS()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetEffectiveRightsRequest expandAllAttrs="setAttrs">'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                    .'</urn1:GetEffectiveRightsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetFreeBusyQueueInfo()
    {
        $provider = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getFreeBusyQueueInfo(
            $provider
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetFreeBusyQueueInfoRequest>'
                        .'<ns1:provider name="name" />'
                    .'</ns1:GetFreeBusyQueueInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getFreeBusyQueueInfo(
            $provider
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetFreeBusyQueueInfoRequest>'
                        .'<urn1:provider name="name" />'
                    .'</urn1:GetFreeBusyQueueInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetGrants()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getGrants(
            $target, $grantee
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetGrantsRequest>'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                    .'</ns1:GetGrantsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getGrants(
            $target, $grantee
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetGrantsRequest>'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                    .'</urn1:GetGrantsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetIndexStats()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getIndexStats(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetIndexStatsRequest>'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:GetIndexStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getIndexStats(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetIndexStatsRequest>'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:GetIndexStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLDAPEntries()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getLDAPEntries(
            'query', 'ldapSearchBase', 'sortBy', true, 100, 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetLDAPEntriesRequest query="query" sortBy="sortBy" sortAscending="true" limit="100" offset="100">'
                        .'<ns1:ldapSearchBase>ldapSearchBase</ns1:ldapSearchBase>'
                    .'</ns1:GetLDAPEntriesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getLDAPEntries(
            'query', 'ldapSearchBase', 'sortBy', true, 100, 100
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetLDAPEntriesRequest query="query" sortBy="sortBy" sortAscending="true" limit="100" offset="100">'
                        .'<urn1:ldapSearchBase>ldapSearchBase</urn1:ldapSearchBase>'
                    .'</urn1:GetLDAPEntriesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLicenseInfo()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getLicenseInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetLicenseInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getLicenseInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetLicenseInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLoggerStats()
    {
        $hostname = new \Zimbra\Admin\Struct\HostName('host');
        $startTime = new \Zimbra\Admin\Struct\TimeAttr('time');
        $endTime = new \Zimbra\Admin\Struct\TimeAttr('time');

        $stat = new \Zimbra\Struct\NamedElement('name');
        $values = new \Zimbra\Admin\Struct\StatsValueWrapper(array($stat));
        $stats = new \Zimbra\Admin\Struct\StatsSpec($values, 'name', 'limit');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getLoggerStats(
            $hostname, $stats, $startTime, $endTime
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetLoggerStatsRequest>'
                        .'<ns1:hostname hn="host" />'
                        .'<ns1:stats name="name" limit="limit">'
                            .'<ns1:values>'
                                .'<ns1:stat name="name" />'
                            .'</ns1:values>'
                        .'</ns1:stats>'
                        .'<ns1:startTime time="time" />'
                        .'<ns1:endTime time="time" />'
                    .'</ns1:GetLoggerStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getLoggerStats(
            $hostname, $stats, $startTime, $endTime
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetLoggerStatsRequest>'
                        .'<urn1:hostname hn="host" />'
                        .'<urn1:stats name="name" limit="limit">'
                            .'<urn1:values>'
                                .'<urn1:stat name="name" />'
                            .'</urn1:values>'
                        .'</urn1:stats>'
                        .'<urn1:startTime time="time" />'
                        .'<urn1:endTime time="time" />'
                    .'</urn1:GetLoggerStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailbox()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('account-id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getMailbox(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetMailboxRequest>'
                        .'<ns1:mbox id="account-id" />'
                    .'</ns1:GetMailboxRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getMailbox(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetMailboxRequest>'
                        .'<urn1:mbox id="account-id" />'
                    .'</urn1:GetMailboxRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailboxStats()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getMailboxStats();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetMailboxStatsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getMailboxStats();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetMailboxStatsRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailQueue()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, 'name', false, 100);
        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, 'name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getMailQueue($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetMailQueueRequest>'
                        .'<ns1:server name="name">'
                            .'<ns1:queue name="name" scan="false" wait="100">'
                                .'<ns1:query limit="100" offset="100">'
                                    .'<ns1:field name="name">'
                                        .'<ns1:match value="value" />'
                                    .'</ns1:field>'
                                .'</ns1:query>'
                            .'</ns1:queue>'
                        .'</ns1:server>'
                    .'</ns1:GetMailQueueRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getMailQueue($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetMailQueueRequest>'
                        .'<urn1:server name="name">'
                            .'<urn1:queue name="name" scan="false" wait="100">'
                                .'<urn1:query limit="100" offset="100">'
                                    .'<urn1:field name="name">'
                                        .'<urn1:match value="value" />'
                                    .'</urn1:field>'
                                .'</urn1:query>'
                            .'</urn1:queue>'
                        .'</urn1:server>'
                    .'</urn1:GetMailQueueRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailQueueInfo()
    {
        $server = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getMailQueueInfo(
            $server
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetMailQueueInfoRequest>'
                        .'<ns1:server name="name" />'
                    .'</ns1:GetMailQueueInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getMailQueueInfo(
            $server
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetMailQueueInfoRequest>'
                        .'<urn1:server name="name" />'
                    .'</urn1:GetMailQueueInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMemcachedClientConfig()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getMemcachedClientConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetMemcachedClientConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getMemcachedClientConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetMemcachedClientConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetQuotaUsage()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getQuotaUsage(
            'domain', true, 10, 10, QuotaSortBy::TOTAL_USED(), true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetQuotaUsageRequest '
                        .'domain="domain" '
                        .'allServers="true" '
                        .'limit="10" '
                        .'offset="10" '
                        .'sortBy="totalUsed" '
                        .'sortAscending="true" '
                        .'refresh="false" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getQuotaUsage(
            'domain', true, 10, 10, QuotaSortBy::TOTAL_USED(), true, false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetQuotaUsageRequest '
                        .'domain="domain" '
                        .'allServers="true" '
                        .'limit="10" '
                        .'offset="10" '
                        .'sortBy="totalUsed" '
                        .'sortAscending="true" '
                        .'refresh="false" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRight()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getRight('right', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetRightRequest expandAllAttrs="true">'
                        .'<ns1:right>right</ns1:right>'
                    .'</ns1:GetRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getRight('right', true);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetRightRequest expandAllAttrs="true">'
                        .'<urn1:right>right</urn1:right>'
                    .'</urn1:GetRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRightsDoc()
    {
        $package = new \Zimbra\Admin\Struct\PackageSelector('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getRightsDoc(array($package));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetRightsDocRequest>'
                        .'<ns1:package name="name" />'
                    .'</ns1:GetRightsDocRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getRightsDoc(array($package));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetRightsDocRequest>'
                        .'<urn1:package name="name" />'
                    .'</urn1:GetRightsDocRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServer()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getServer($server, true, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetServerRequest applyConfig="true" attrs="attrs">'
                        .'<ns1:server by="name">server</ns1:server>'
                    .'</ns1:GetServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getServer($server, true, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetServerRequest applyConfig="true" attrs="attrs">'
                        .'<urn1:server by="name">server</urn1:server>'
                    .'</urn1:GetServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServerNIfs()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getServerNIfs($server, IpType::IPV4());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetServerNIfsRequest type="ipV4">'
                        .'<ns1:server by="name">server</ns1:server>'
                    .'</ns1:GetServerNIfsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getServerNIfs($server, IpType::IPV4());

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetServerNIfsRequest type="ipV4">'
                        .'<urn1:server by="name">server</urn1:server>'
                    .'</urn1:GetServerNIfsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServerStats()
    {
        $stat = new \Zimbra\Admin\Struct\Stat('name', 'description');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getServerStats(array($stat));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetServerStatsRequest>'
                        .'<ns1:stat name="name" description="description" />'
                    .'</ns1:GetServerStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getServerStats(array($stat));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetServerStatsRequest>'
                        .'<urn1:stat name="name" description="description" />'
                    .'</urn1:GetServerStatsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServiceStatus()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getServiceStatus();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetServiceStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getServiceStatus();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetServiceStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSessions()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getSessions(
            SessionType::ADMIN(), SessionsSortBy::NAME_DESC(), 10, 10, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetSessionsRequest '
                        .'type="admin" '
                        .'sortBy="nameDesc" '
                        .'limit="10" '
                        .'offset="10" '
                        .'refresh="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getSessions(
            SessionType::ADMIN(), SessionsSortBy::NAME_DESC(), 10, 10, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetSessionsRequest '
                        .'type="admin" '
                        .'sortBy="nameDesc" '
                        .'limit="10" '
                        .'offset="10" '
                        .'refresh="true" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareInfo()
    {
        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $grantee = new \Zimbra\Struct\GranteeChooser('type', 'id', 'name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getShareInfo($owner, $grantee);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetShareInfoRequest>'
                        .'<ns1:grantee type="type" id="id" name="name" />'
                        .'<ns1:owner by="name">value</ns1:owner>'
                    .'</ns1:GetShareInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getShareInfo($owner, $grantee);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetShareInfoRequest>'
                        .'<urn1:owner by="name">value</urn1:owner>'
                        .'<urn1:grantee type="type" id="id" name="name" />'
                    .'</urn1:GetShareInfoRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getSystemRetentionPolicy($cos);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetSystemRetentionPolicyRequest>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                    .'</ns1:GetSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getSystemRetentionPolicy($cos);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetSystemRetentionPolicyRequest>'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:GetSystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetUCService()
    {
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getUCService($ucservice, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetUCServiceRequest attrs="attrs">'
                        .'<ns1:ucservice by="name">value</ns1:ucservice>'
                    .'</ns1:GetUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getUCService($ucservice, 'attrs');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetUCServiceRequest attrs="attrs">'
                        .'<urn1:ucservice by="name">value</urn1:ucservice>'
                    .'</urn1:GetUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVersionInfo()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getVersionInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetVersionInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getVersionInfo();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetVersionInfoRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVolume()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getVolume(100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetVolumeRequest id="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getVolume(100);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetVolumeRequest id="100" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetXMPPComponent()
    {
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getXMPPComponent(
            $xmpp, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetXMPPComponentRequest attrs="attrs">'
                        .'<ns1:xmppcomponent by="name">value</ns1:xmppcomponent>'
                    .'</ns1:GetXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getXMPPComponent(
            $xmpp, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetXMPPComponentRequest attrs="attrs">'
                        .'<urn1:xmppcomponent by="name">value</urn1:xmppcomponent>'
                    .'</urn1:GetXMPPComponentRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetZimlet()
    {
        $zimlet = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getZimlet(
            $zimlet, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetZimletRequest attrs="attrs">'
                        .'<ns1:zimlet name="name" />'
                    .'</ns1:GetZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getZimlet(
            $zimlet, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetZimletRequest attrs="attrs">'
                        .'<urn1:zimlet name="name" />'
                    .'</urn1:GetZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetZimletStatus()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->getZimletStatus();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GetZimletStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->getZimletStatus();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GetZimletStatusRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGrantRight()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );
        $right = new \Zimbra\Admin\Struct\RightModifierInfo('value', true, false, false, true);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->grantRight(
            $target, $grantee, $right
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:GrantRightRequest>'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                        .'<ns1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">value</ns1:right>'
                    .'</ns1:GrantRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->grantRight(
            $target, $grantee, $right
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:GrantRightRequest>'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                        .'<urn1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">value</urn1:right>'
                    .'</urn1:GrantRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testMailQueueAction()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 100);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, 'name');
        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction($queue, 'name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->mailQueueAction($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:MailQueueActionRequest>'
                        .'<ns1:server name="name">'
                            .'<ns1:queue name="name">'
                                .'<ns1:action op="hold" by="query">'
                                    .'<ns1:query limit="100" offset="100">'
                                        .'<ns1:field name="name">'
                                            .'<ns1:match value="value" />'
                                        .'</ns1:field>'
                                    .'</ns1:query>'
                                .'</ns1:action>'
                            .'</ns1:queue>'
                        .'</ns1:server>'
                    .'</ns1:MailQueueActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->mailQueueAction($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:MailQueueActionRequest>'
                        .'<urn1:server name="name">'
                            .'<urn1:queue name="name">'
                                .'<urn1:action op="hold" by="query">'
                                    .'<urn1:query limit="100" offset="100">'
                                        .'<urn1:field name="name">'
                                            .'<urn1:match value="value" />'
                                        .'</urn1:field>'
                                    .'</urn1:query>'
                                .'</urn1:action>'
                            .'</urn1:queue>'
                        .'</urn1:server>'
                    .'</urn1:MailQueueActionRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testMailQueueFlush()
    {
        $server = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->mailQueueFlush($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:MailQueueFlushRequest>'
                        .'<ns1:server name="name" />'
                    .'</ns1:MailQueueFlushRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->mailQueueFlush($server);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:MailQueueFlushRequest>'
                        .'<urn1:server name="name" />'
                    .'</urn1:MailQueueFlushRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function migrateAccount()
    {
        $migrate = new \Zimbra\Admin\Struct\IdAndAction('id', 'wiki');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->migrateAccount($migrate);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:MigrateAccountRequest>'
                        .'<ns1:migrate id="id" action="wiki" />'
                    .'</ns1:MigrateAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->migrateAccount($migrate);

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:MigrateAccountRequest>'
                        .'<urn1:migrate id="id" action="wiki" />'
                    .'</urn1:MigrateAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyAccount(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyAccountRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyAccount(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyAccountRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyAdminSavedSearches()
    {
        $search = new \Zimbra\Struct\NamedValue('name', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyAdminSavedSearches(
            array($search)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyAdminSavedSearchesRequest>'
                        .'<ns1:search name="name">value</ns1:search>'
                    .'</ns1:ModifyAdminSavedSearchesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyAdminSavedSearches(
            array($search)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyAdminSavedSearchesRequest>'
                        .'<urn1:search name="name">value</urn1:search>'
                    .'</urn1:ModifyAdminSavedSearchesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyCalendarResource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyCalendarResource(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyCalendarResourceRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyCalendarResource(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyCalendarResourceRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyCalendarResourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyConfig(
            array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyConfigRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyConfig(
            array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyConfigRequest>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyConfigRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyCos()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyCos(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyCosRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:id>id</ns1:id>'
                    .'</ns1:ModifyCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyCos(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyCosRequest>'
                        .'<urn1:id>id</urn1:id>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDataSource()
    {
        $dataSource = new \Zimbra\Struct\Id('id');
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyDataSource(
            'id', $dataSource, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyDataSourceRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:dataSource id="id" />'
                    .'</ns1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyDataSource(
            'id', $dataSource, array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyDataSourceRequest id="id">'
                        .'<urn1:dataSource id="id" />'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyDataSourceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDelegatedAdminConstraints()
    {
        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues(array('value'));
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo('min', 'max', $values);
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr($constraint, 'name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyDelegatedAdminConstraints(
            TargetType::ACCOUNT(), 'id', 'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyDelegatedAdminConstraintsRequest type="account" id="id" name="name">'
                        .'<ns1:a name="name">'
                            .'<ns1:constraint>'
                                .'<ns1:min>min</ns1:min>'
                                .'<ns1:max>max</ns1:max>'
                                .'<ns1:values>'
                                    .'<ns1:v>value</ns1:v>'
                                .'</ns1:values>'
                            .'</ns1:constraint>'
                        .'</ns1:a>'
                    .'</ns1:ModifyDelegatedAdminConstraintsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyDelegatedAdminConstraints(
            TargetType::ACCOUNT(), 'id', 'name', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyDelegatedAdminConstraintsRequest type="account" id="id" name="name">'
                        .'<urn1:a name="name">'
                            .'<urn1:constraint>'
                                .'<urn1:min>min</urn1:min>'
                                .'<urn1:max>max</urn1:max>'
                                .'<urn1:values>'
                                    .'<urn1:v>value</urn1:v>'
                                .'</urn1:values>'
                            .'</urn1:constraint>'
                        .'</urn1:a>'
                    .'</urn1:ModifyDelegatedAdminConstraintsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyDistributionList(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyDistributionListRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyDistributionList(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyDistributionListRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyDistributionListRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDomain()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyDomain(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyDomainRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyDomain(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyDomainRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyDomainRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyLDAPEntry()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyLDAPEntry(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyLDAPEntryRequest dn="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyLDAPEntryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyLDAPEntry(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyLDAPEntryRequest dn="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyLDAPEntryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyServer()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyServer(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyServerRequest id="id">'
                        .'<ns1:a n="key">value</ns1:a>'
                    .'</ns1:ModifyServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyServer(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyServerRequest id="id">'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyServerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifySystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifySystemRetentionPolicy(
            $policy, $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin" xmlns:ns2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<ns1:ModifySystemRetentionPolicyRequest>'
                        .'<ns1:cos by="name">value</ns1:cos>'
                        .'<ns2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                    .'</ns1:ModifySystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifySystemRetentionPolicy(
            $policy, $cos
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                .'<env:Body>'
                    .'<urn1:ModifySystemRetentionPolicyRequest>'
                        .'<urn2:policy type="system" id="id" name="name" lifetime="lifetime" />'
                        .'<urn1:cos by="name">value</urn1:cos>'
                    .'</urn1:ModifySystemRetentionPolicyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyUCService()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyUCService(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyUCServiceRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:id>id</ns1:id>'
                    .'</ns1:ModifyUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyUCService(
            'id', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyUCServiceRequest>'
                        .'<urn1:id>id</urn1:id>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:ModifyUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyVolume()
    {
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(10, 2, 3, 4, 5, 6, 7, 'name', 'rootpath', false, true);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyVolume(
            100, $volume
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyVolumeRequest id="100">'
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
                    .'</ns1:ModifyVolumeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyVolume(
            100, $volume
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyVolumeRequest id="100">'
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
                    .'</urn1:ModifyVolumeRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyZimlet()
    {
        $acl = new \Zimbra\Admin\Struct\ZimletAcl('cos', AclType::DENY());
        $status = new \Zimbra\Admin\Struct\ValueAttrib(ZimletStatus::DISABLED);
        $priority = new \Zimbra\Admin\Struct\IntegerValueAttrib(10);
        $zimlet = new \Zimbra\Admin\Struct\ZimletAclStatusPri('name', $acl, $status, $priority);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->modifyZimlet(
            $zimlet
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ModifyZimletRequest>'
                        .'<ns1:zimlet name="name">'
                            .'<ns1:acl cos="cos" acl="deny" />'
                            .'<ns1:status value="disabled" />'
                            .'<ns1:priority value="10" />'
                        .'</ns1:zimlet>'
                    .'</ns1:ModifyZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->modifyZimlet(
            $zimlet
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ModifyZimletRequest>'
                        .'<urn1:zimlet name="name">'
                            .'<urn1:acl cos="cos" acl="deny" />'
                            .'<urn1:status value="disabled" />'
                            .'<urn1:priority value="10" />'
                        .'</urn1:zimlet>'
                    .'</urn1:ModifyZimletRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testNoOp_AuthToken()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->client()->authToken('authToken');
        $api->noOp();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin" xmlns:ns2="urn:zimbra">'
                .'<env:Header>'
                    .'<ns2:context>'
                        .'<authToken>authToken</authToken>'
                    .'</ns2:context>'
                .'</env:Header>'
                .'<env:Body>'
                    .'<ns1:NoOpRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->noOp();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:NoOpRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPing()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->ping();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:PingRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->ping();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:PingRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeAccountCalendarCache()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->purgeAccountCalendarCache('id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:PurgeAccountCalendarCacheRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->purgeAccountCalendarCache('id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:PurgeAccountCalendarCacheRequest id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeFreeBusyQueue()
    {
        $provider = new \Zimbra\Struct\NamedElement('name');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->purgeFreeBusyQueue(
            $provider
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:PurgeFreeBusyQueueRequest>'
                        .'<ns1:provider name="name" />'
                    .'</ns1:PurgeFreeBusyQueueRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->purgeFreeBusyQueue(
            $provider
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:PurgeFreeBusyQueueRequest>'
                        .'<urn1:provider name="name" />'
                    .'</urn1:PurgeFreeBusyQueueRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeMessages()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->purgeMessages(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:PurgeMessagesRequest>'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:PurgeMessagesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->purgeMessages(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:PurgeMessagesRequest>'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:PurgeMessagesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPushFreeBusy()
    {
        $domain = new \Zimbra\Admin\Struct\Names('name');
        $account = new \Zimbra\Struct\Id('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->pushFreeBusy(
            $domain, $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:PushFreeBusyRequest>'
                        .'<ns1:domain name="name" />'
                        .'<ns1:account id="id" />'
                    .'</ns1:PushFreeBusyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->pushFreeBusy(
            $domain, $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:PushFreeBusyRequest>'
                        .'<urn1:domain name="name" />'
                        .'<urn1:account id="id" />'
                    .'</urn1:PushFreeBusyRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testQueryWaitSet()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->queryWaitSet('waitSet');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:QueryWaitSetRequest waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->queryWaitSet('waitSet');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:QueryWaitSetRequest waitSet="waitSet" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRecalculateMailboxCounts()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->recalculateMailboxCounts(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RecalculateMailboxCountsRequest>'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:RecalculateMailboxCountsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->recalculateMailboxCounts(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RecalculateMailboxCountsRequest>'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:RecalculateMailboxCountsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo('id', 'task,note', 'abc,xyz');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->reIndex(
            $mbox, ReIndexAction::CANCEL()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ReIndexRequest action="cancel">'
                        .'<ns1:mbox id="id" types="task,note" ids="abc,xyz" />'
                    .'</ns1:ReIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->reIndex(
           $mbox, ReIndexAction::CANCEL()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ReIndexRequest action="cancel">'
                        .'<urn1:mbox id="id" types="task,note" ids="abc,xyz" />'
                    .'</urn1:ReIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReloadLocalConfig()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->reloadLocalConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ReloadLocalConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->reloadLocalConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ReloadLocalConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReloadMemcachedClientConfig()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->reloadMemcachedClientConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ReloadMemcachedClientConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->reloadMemcachedClientConfig();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ReloadMemcachedClientConfigRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveAccountAlias()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->removeAccountAlias('alias', 'id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RemoveAccountAliasRequest alias="alias" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->removeAccountAlias('alias', 'id');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RemoveAccountAliasRequest alias="alias" id="id" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveAccountLogger()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $logger = new \Zimbra\Admin\Struct\LoggerInfo('category', LoggingLevel::ERROR());

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->removeAccountLogger(
            $account, $logger
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RemoveAccountLoggerRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:logger category="category" level="error" />'
                    .'</ns1:RemoveAccountLoggerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->removeAccountLogger(
            $account, $logger
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RemoveAccountLoggerRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:logger category="category" level="error" />'
                    .'</urn1:RemoveAccountLoggerRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->removeDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RemoveDeviceRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:device id="id" />'
                    .'</ns1:RemoveDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->removeDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RemoveDeviceRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:device id="id" />'
                    .'</urn1:RemoveDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDistributionListAlias()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->removeDistributionListAlias('id', 'alias');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RemoveDistributionListAliasRequest id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->removeDistributionListAlias('id', 'alias');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RemoveDistributionListAliasRequest id="id" alias="alias" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDistributionListMember()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->removeDistributionListMember('id', array('dlm'));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RemoveDistributionListMemberRequest id="id">'
                        .'<ns1:dlm>dlm</ns1:dlm>'
                    .'</ns1:RemoveDistributionListMemberRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->removeDistributionListMember('id', array('dlm'));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RemoveDistributionListMemberRequest id="id">'
                        .'<urn1:dlm>dlm</urn1:dlm>'
                    .'</urn1:RemoveDistributionListMemberRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameAccount()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameAccount('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameAccountRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameAccount('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameAccountRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameCalendarResource()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameCalendarResource('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameCalendarResourceRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameCalendarResource('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameCalendarResourceRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameCos()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameCos('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameCosRequest>'
                        .'<ns1:id>id</ns1:id>'
                        .'<ns1:newName>newName</ns1:newName>'
                    .'</ns1:RenameCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameCos('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameCosRequest>'
                        .'<urn1:id>id</urn1:id>'
                        .'<urn1:newName>newName</urn1:newName>'
                    .'</urn1:RenameCosRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameDistributionList()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameDistributionList('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameDistributionListRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameDistributionList('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameDistributionListRequest id="id" newName="newName" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameLDAPEntry()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameLDAPEntry('dn', 'new_dn');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameLDAPEntryRequest dn="dn" new_dn="new_dn" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameLDAPEntry('dn', 'new_dn');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameLDAPEntryRequest dn="dn" new_dn="new_dn" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameUCService()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->renameUCService('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RenameUCServiceRequest>'
                        .'<ns1:id>id</ns1:id>'
                        .'<ns1:newName>newName</ns1:newName>'
                    .'</ns1:RenameUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->renameUCService('id', 'newName');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RenameUCServiceRequest>'
                        .'<urn1:id>id</urn1:id>'
                        .'<urn1:newName>newName</urn1:newName>'
                    .'</urn1:RenameUCServiceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testResetAllLoggers()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->resetAllLoggers();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ResetAllLoggersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->resetAllLoggers();

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ResetAllLoggersRequest />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testResumeDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->resumeDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:ResumeDeviceRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:device id="id" />'
                    .'</ns1:ResumeDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->resumeDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:ResumeDeviceRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:device id="id" />'
                    .'</urn1:ResumeDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRevokeRight()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );
        $right = new \Zimbra\Admin\Struct\RightModifierInfo('value', true, false, false, true);

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->revokeRight(
            $target, $grantee, $right
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RevokeRightRequest>'
                        .'<ns1:target type="account" by="name">value</ns1:target>'
                        .'<ns1:grantee type="usr" by="id" secret="secret" all="true">value</ns1:grantee>'
                        .'<ns1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">value</ns1:right>'
                    .'</ns1:RevokeRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->revokeRight(
            $target, $grantee, $right
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RevokeRightRequest>'
                        .'<urn1:target type="account" by="name">value</urn1:target>'
                        .'<urn1:grantee type="usr" by="id" secret="secret" all="true">value</urn1:grantee>'
                        .'<urn1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">value</urn1:right>'
                    .'</urn1:RevokeRightRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRunUnitTests()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->runUnitTests(array('test'));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:RunUnitTestsRequest>'
                        .'<ns1:test>test</ns1:test>'
                    .'</ns1:RunUnitTestsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->runUnitTests(array('test'));

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:RunUnitTestsRequest>'
                        .'<urn1:test>test</urn1:test>'
                    .'</urn1:RunUnitTestsRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchAccounts()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchAccounts(
            'query', 100, 100, 'domain', true, 'displayName', 'sortBy', 'resources', false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchAccountsRequest '
                        .'query="query" '
                        .'limit="100" '
                        .'offset="100" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'attrs="displayName" '
                        .'sortBy="sortBy" '
                        .'types="resources" '
                        .'sortAscending="false" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->searchAccounts(
            'query', 100, 100, 'domain', true, 'displayName', 'sortBy', 'resources', false
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SearchAccountsRequest '
                        .'query="query" '
                        .'limit="100" '
                        .'offset="100" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'attrs="displayName" '
                        .'sortBy="sortBy" '
                        .'types="resources" '
                        .'sortAscending="false" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchAutoProvDirectory()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchAutoProvDirectory(
            $domain, 'keyAttr', 'query', 'name', 100, 100, 100, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchAutoProvDirectoryRequest attrs="attrs" keyAttr="keyAttr" query="query" name="name" maxResults="100" limit="100" offset="100" refresh="true">'
                        .'<ns1:domain by="name">value</ns1:domain>'
                    .'</ns1:SearchAutoProvDirectoryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->searchAutoProvDirectory(
            $domain, 'keyAttr', 'query', 'name', 100, 100, 100, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SearchAutoProvDirectoryRequest keyAttr="keyAttr" query="query" name="name" maxResults="100" limit="100" offset="100" refresh="true" attrs="attrs">'
                        .'<urn1:domain by="name">value</urn1:domain>'
                    .'</urn1:SearchAutoProvDirectoryRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchCalendarResources()
    {
        $otherCond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(false, true, NULL, $otherCond);
        $cond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(true, false, $otherConds, $cond);

        $searchFilter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo($conds);
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchCalendarResources(
            $searchFilter, 10, 10, 'domain', true, 'sortBy', false, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchCalendarResourcesRequest '
                        .'limit="10" '
                        .'offset="10" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'sortBy="sortBy" '
                        .'sortAscending="false" '
                        .'attrs="attrs">'
                        .'<ns1:searchFilter>'
                            .'<ns1:conds not="true" or="false">'
                                .'<ns1:conds not="false" or="true">'
                                    .'<ns1:cond attr="attr" op="ge" value="value" not="false" />'
                                .'</ns1:conds>'
                                .'<ns1:cond attr="a" op="eq" value="v" not="true" />'
                            .'</ns1:conds>'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $searchFilter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo(null, $cond);
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchCalendarResources(
            $searchFilter, 10, 10, 'domain', true, 'sortBy', false, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchCalendarResourcesRequest '
                        .'limit="10" '
                        .'offset="10" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'sortBy="sortBy" '
                        .'sortAscending="false" '
                        .'attrs="attrs">'
                        .'<ns1:searchFilter>'
                            .'<ns1:cond attr="a" op="eq" value="v" not="true" />'
                        .'</ns1:searchFilter>'
                    .'</ns1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $searchFilter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo($conds, $cond);
        $api = new LocalAdminHttp(null);
        $api->searchCalendarResources(
            $searchFilter, 10, 10, 'domain', true, 'sortBy', false, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SearchCalendarResourcesRequest '
                        .'limit="10" '
                        .'offset="10" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'sortBy="sortBy" '
                        .'sortAscending="false" '
                        .'attrs="attrs">'
                        .'<urn1:searchFilter>'
                            .'<urn1:conds not="true" or="false">'
                                .'<urn1:conds not="false" or="true">'
                                    .'<urn1:cond attr="attr" op="ge" value="value" not="false" />'
                                .'</urn1:conds>'
                                .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                            .'</urn1:conds>'
                            .'<urn1:cond attr="a" op="eq" value="v" not="true" />'
                        .'</urn1:searchFilter>'
                    .'</urn1:SearchCalendarResourcesRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchDirectory()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchDirectory(
            'query', 10, 10, 10, 'domain', true, false, array(DirSearchType::ACCOUNTS()), 'sortBy', false, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchDirectoryRequest '
                        .'query="query" '
                        .'maxResults="10" '
                        .'limit="10" '
                        .'offset="10" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'applyConfig="false" '
                        .'types="accounts" '
                        .'sortBy="sortBy" '
                        .'sortAscending="false" '
                        .'countOnly="true" '
                        .'attrs="attrs" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->searchDirectory(
            'query', 10, 10, 10, 'domain', true, false, array(DirSearchType::ACCOUNTS()), 'sortBy', false, true, 'attrs'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SearchDirectoryRequest '
                        .'query="query" '
                        .'maxResults="10" '
                        .'limit="10" '
                        .'offset="10" '
                        .'domain="domain" '
                        .'applyCos="true" '
                        .'applyConfig="false" '
                        .'types="accounts" '
                        .'sortBy="sortBy" '
                        .'sortAscending="false" '
                        .'countOnly="true" '
                        .'attrs="attrs" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchGal()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->searchGal(
            'domain', 'name', 10, GalSearchType::ACCOUNT(), 'galAcctId'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SearchGalRequest '
                        .'domain="domain" '
                        .'name="name" '
                        .'limit="10" '
                        .'type="account" '
                        .'galAcctId="galAcctId" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->searchGal(
            'domain', 'name', 10, GalSearchType::ACCOUNT(), 'galAcctId'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SearchGalRequest '
                        .'domain="domain" '
                        .'name="name" '
                        .'limit="10" '
                        .'type="account" '
                        .'galAcctId="galAcctId" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetCurrentVolume()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->setCurrentVolume(
            100, VolumeType::SECONDARY()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SetCurrentVolumeRequest '
                        .'id="100" '
                        .'type="2" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->setCurrentVolume(
            100, VolumeType::SECONDARY()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SetCurrentVolumeRequest '
                        .'id="100" '
                        .'type="2" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetPassword()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->setPassword('id', 'newPassword');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SetPasswordRequest id="id" newPassword="newPassword" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->setPassword('id', 'newPassword');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SetPasswordRequest id="id" newPassword="newPassword" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSuspendDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->suspendDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SuspendDeviceRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:device id="id" />'
                    .'</ns1:SuspendDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->suspendDevice(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SuspendDeviceRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:device id="id" />'
                    .'</urn1:SuspendDeviceRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSyncGalAccount()
    {
        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), 'value', false, true);
        $account = new \Zimbra\Admin\Struct\SyncGalAccountSpec('id', array($ds));

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->syncGalAccount(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:SyncGalAccountRequest>'
                        .'<ns1:account id="id">'
                            .'<ns1:datasource by="name" fullSync="false" reset="true">value</ns1:datasource>'
                        .'</ns1:account>'
                    .'</ns1:SyncGalAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->syncGalAccount(
            $account
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:SyncGalAccountRequest>'
                        .'<urn1:account id="id">'
                            .'<urn1:datasource by="name" fullSync="false" reset="true">value</urn1:datasource>'
                        .'</urn1:account>'
                    .'</urn1:SyncGalAccountRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUndeployZimlet()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->undeployZimlet('name', 'action');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:UndeployZimletRequest name="name" action="action" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->undeployZimlet('name', 'action');

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:UndeployZimletRequest name="name" action="action" />'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUpdateDeviceStatus()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\IdStatus('id', 'status');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->updateDeviceStatus(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:UpdateDeviceStatusRequest>'
                        .'<ns1:account by="name">value</ns1:account>'
                        .'<ns1:device id="id" status="status" />'
                    .'</ns1:UpdateDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->updateDeviceStatus(
            $account, $device
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:UpdateDeviceStatusRequest>'
                        .'<urn1:account by="name">value</urn1:account>'
                        .'<urn1:device id="id" status="status" />'
                    .'</urn1:UpdateDeviceStatusRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUpdatePresenceSessionId()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->updatePresenceSessionId(
            $ucservice, 'username', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:UpdatePresenceSessionIdRequest>'
                        .'<ns1:a n="key">value</ns1:a>'
                        .'<ns1:ucservice by="name">value</ns1:ucservice>'
                        .'<ns1:username>username</ns1:username>'
                        .'<ns1:password>password</ns1:password>'
                    .'</ns1:UpdatePresenceSessionIdRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->updatePresenceSessionId(
            $ucservice, 'username', 'password', array($attr)
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:UpdatePresenceSessionIdRequest>'
                        .'<urn1:ucservice by="name">value</urn1:ucservice>'
                        .'<urn1:username>username</urn1:username>'
                        .'<urn1:password>password</urn1:password>'
                        .'<urn1:a n="key">value</urn1:a>'
                    .'</urn1:UpdatePresenceSessionIdRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUploadDomCert()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->uploadDomCert(
            'certAid', 'certFilename', 'keyAid', 'keyFilename'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:UploadDomCertRequest '
                        .'cert.aid="certAid" '
                        .'cert.filename="certFilename" '
                        .'key.aid="keyAid" '
                        .'key.filename="keyFilename" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->uploadDomCert(
            'certAid', 'certFilename', 'keyAid', 'keyFilename'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:UploadDomCertRequest '
                        .'cert.aid="certAid" '
                        .'cert.filename="certFilename" '
                        .'key.aid="keyAid" '
                        .'key.filename="keyFilename" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUploadProxyCA()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->uploadProxyCA(
            'certAid', 'certFilename'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:UploadProxyCARequest '
                        .'cert.aid="certAid" '
                        .'cert.filename="certFilename" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->uploadProxyCA(
            'certAid', 'certFilename'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:UploadProxyCARequest '
                        .'cert.aid="certAid" '
                        .'cert.filename="certFilename" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyCertKey()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->verifyCertKey(
            'cert', 'privkey'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:VerifyCertKeyRequest '
                        .'cert="cert" '
                        .'privkey="privkey" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->verifyCertKey(
            'cert', 'privkey'
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:VerifyCertKeyRequest '
                        .'cert="cert" '
                        .'privkey="privkey" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');

        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->verifyIndex(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:VerifyIndexRequest>'
                        .'<ns1:mbox id="id" />'
                    .'</ns1:VerifyIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->verifyIndex(
            $mbox
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:VerifyIndexRequest>'
                        .'<urn1:mbox id="id" />'
                    .'</urn1:VerifyIndexRequest>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyStoreManager()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->verifyStoreManager(
            100, 100, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:VerifyStoreManagerRequest '
                        .'fileSize="100" '
                        .'num="100" '
                        .'checkBlobs="true" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->verifyStoreManager(
            100, 100, true
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:VerifyStoreManagerRequest '
                        .'fileSize="100" '
                        .'num="100" '
                        .'checkBlobs="true" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVersionCheck()
    {
        $api = new LocalAdminWsdl(__DIR__.'/../TestData/ZimbraAdminService.wsdl');
        $api->versionCheck(
            VersionCheckAction::CHECK()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:ns1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<ns1:VersionCheckRequest '
                        .'action="check" '
                    .'/>'
                .'</env:Body>'
            .'</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $api = new LocalAdminHttp(null);
        $api->versionCheck(
            VersionCheckAction::CHECK()
        );

        $client = $api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>'."\n"
            .'<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                .'<env:Body>'
                    .'<urn1:VersionCheckRequest '
                        .'action="check" '
                    .'/>'
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
