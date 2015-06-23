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
    private $_api;

    public function __construct()
    {
        parent::__construct();
        $this->_api = new LocalAdminHttp(null);
    }

    public function testAdminFactory()
    {
        $httpApi = AdminFactory::instance();
        $this->assertInstanceOf('\Zimbra\Admin\Base', $httpApi);
        $this->assertInstanceOf('\Zimbra\Admin\Http', $httpApi);
    }

    public function testAddAccountAlias()
    {
        $id = self::randomName();
        $alias = self::randomName();
        $this->_api->addAccountAlias(
            $id, $alias
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddAccountAliasRequest '
                        . 'id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddAccountLogger()
    {
        $category = self::randomName();
        $value = self::randomName();

        $logger = new \Zimbra\Admin\Struct\LoggerInfo($category, LoggingLevel::ERROR());
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->addAccountLogger(
            $logger, $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddAccountLoggerRequest>'
                        . '<urn1:logger category="'  .$category . '" level="' . LoggingLevel::ERROR() . '" />'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:AddAccountLoggerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddDistributionListAlias()
    {
        $id = self::randomName();
        $alias = self::randomName();
        $this->_api->addDistributionListAlias(
            $id, $alias
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddDistributionListAliasRequest '
                        . 'id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddDistributionListMember()
    {
        $id = self::randomName();
        $member1 = self::randomName();
        $member2 = self::randomName();
        $this->_api->addDistributionListMember(
            $id, [$member1, $member2]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddDistributionListMemberRequest id="' . $id . '">'
                        . '<urn1:dlm>' . $member1 . '</urn1:dlm>'
                        . '<urn1:dlm>' . $member2 . '</urn1:dlm>'
                    . '</urn1:AddDistributionListMemberRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAddGalSyncDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $domain = self::randomName();
        $folder = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->addGalSyncDataSource(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::BOTH() . '" folder="' . $folder . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:AddGalSyncDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminCreateWaitSet()
    {
        $name = self::randomName();
        $id = self::randomName();
        $token = self::randomName();

        $a = new \Zimbra\Struct\WaitSetAddSpec(
            $name, $id, $token, [InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new \Zimbra\Struct\WaitSetSpec([$a]);

        $this->_api->adminCreateWaitSet(
            $add, [InterestType::FOLDERS(), InterestType::MESSAGES()], true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                        . '<urn1:add>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="m,c" />'
                        . '</urn1:add>'
                    . '</urn1:AdminCreateWaitSetRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminDestroyWaitSet()
    {
        $waitSet = self::randomName();
        $this->_api->adminDestroyWaitSet(
            $waitSet
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminDestroyWaitSetRequest '
                        . 'waitSet="' . $waitSet . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAdminWaitSet()
    {
        $name = self::randomName();
        $id = self::randomName();
        $token = self::randomName();
        $waitSet = self::randomName();
        $seq = self::randomName();
        $timeout = mt_rand(0, 1000);

        $a = new \Zimbra\Struct\WaitSetAddSpec(
            $name, $id, $token, [InterestType::FOLDERS(), InterestType::MESSAGES(), InterestType::CONTACTS()]
        );
        $add = new \Zimbra\Struct\WaitSetSpec([$a]);
        $update = new \Zimbra\Struct\WaitSetSpec([$a]);
        $a = new \Zimbra\Struct\Id($id);
        $remove = new \Zimbra\Struct\WaitSetId([$a]);

        $this->_api->adminWaitSet(
            $waitSet, $seq, $add, $update, $remove, true, [InterestType::FOLDERS(), InterestType::MESSAGES()], $timeout
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AdminWaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f,m" timeout="' . $timeout . '" >'
                        . '<urn1:add>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                        . '</urn1:add>'
                        . '<urn1:update>'
                            . '<urn1:a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                        . '</urn1:update>'
                        . '<urn1:remove>'
                            . '<urn1:a id="' . $id . '" />'
                        . '</urn1:remove>'
                    . '</urn1:AdminWaitSetRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuth()
    {
        $name = self::randomName();
        $password = self::randomName();
        $authToken = self::randomName();
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $name);
        $this->_api->auth(
            $name, $password, $authToken, $account, $virtualHost, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:authToken>' . $authToken . '</urn1:authToken>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $name . '</urn1:account>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByName()
    {
        $name = self::randomName();
        $password = self::randomName();
        $virtualHost = self::randomName();
        $this->_api->authByName(
            $name, $password, $virtualHost
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByAccount()
    {
        $name = self::randomName();
        $password = self::randomName();
        $virtualHost = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $name);

        $this->_api->authByAccount(
            $account, $password, $virtualHost
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest password="' . $password . '" persistAuthTokenCookie="true">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $name . '</urn1:account>'
                        . '<urn1:virtualHost>' . $virtualHost . '</urn1:virtualHost>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAuthByToken()
    {
        $authToken = self::randomName();
        $this->_api->authByToken(
            $authToken
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AuthRequest persistAuthTokenCookie="true">'
                        . '<urn1:authToken>' . $authToken . '</urn1:authToken>'
                    . '</urn1:AuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoCompleteGal()
    {
        $domain = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(0, 100);
        $this->_api->autoCompleteGal(
            $domain, $name, GalSearchType::ACCOUNT(), $galAcctId, $limit
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoCompleteGalRequest '
                        . 'domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAcctId . '" limit="' . $limit . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoProvAccount()
    {
        $value = self::randomName();
        $password = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $principal = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), $value);

        $this->_api->autoProvAccount(
            $domain, $principal, $password
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoProvAccountRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:principal by="' . PrincipalBy::DN() . '">' . $value . '</urn1:principal>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                    . '</urn1:AutoProvAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testAutoProvTaskControl()
    {
        $this->_api->autoProvTaskControl(
            TaskAction::STATUS()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:AutoProvTaskControlRequest '
                        . 'action="' . TaskAction::STATUS() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckAuthConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->checkAuthConfig(
            $name, $password, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CheckAuthConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckBlobConsistency()
    {
        $id = mt_rand(0, 100);
        $volume = new \Zimbra\Admin\Struct\IntIdAttr($id);
        $mbox = new \Zimbra\Admin\Struct\IntIdAttr($id);

        $this->_api->checkBlobConsistency(
            [$volume], [$mbox], true, false
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckBlobConsistencyRequest checkSize="true" reportUsedBlobs="false">'
                        . '<urn1:volume id="' . $id . '" />'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:CheckBlobConsistencyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckDirectory()
    {
        $path = self::randomName();
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector($path, true);

        $this->_api->checkDirectory(
            [$dir]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckDirectoryRequest>'
                        . '<urn1:directory path="' . $path . '" create="true" />'
                    . '</urn1:CheckDirectoryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckDomainMXRecord()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->checkDomainMXRecord(
            $domain
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckDomainMXRecordRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:CheckDomainMXRecordRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckExchangeAuth()
    {
        $url = self::randomName();
        $user = self::randomName();
        $pass = self::randomName();
        $type = self::randomName();
        $auth = new \Zimbra\Admin\Struct\ExchangeAuthSpec(
            $url, $user, $pass, AuthScheme::FORM(), $type
        );

        $this->_api->checkExchangeAuth(
            $auth
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckExchangeAuthRequest>'
                        . '<urn1:auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
                    . '</urn1:CheckExchangeAuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckGalConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $query = new \Zimbra\Admin\Struct\LimitedQuery($limit, $value);

        $this->_api->checkGalConfig(
            $query, GalConfigAction::SEARCH(), [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckGalConfigRequest>'
                        . '<urn1:query limit="' . $limit . '">' . $value . '</urn1:query>'
                        . '<urn1:action>' . GalConfigAction::SEARCH() . '</urn1:action>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CheckGalConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckHealth()
    {
        $this->_api->checkHealth();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckHealthRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckHostnameResolve()
    {
        $hostname = self::randomName();
        $this->_api->checkHostnameResolve(
            $hostname
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckHostnameResolveRequest '
                        . 'hostname="' . $hostname . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckPasswordStrength()
    {
        $id = self::randomName();
        $password = self::randomName();
        $this->_api->checkPasswordStrength(
            $id, $password
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckPasswordStrengthRequest '
                        . 'id="' . $id . '" password="' . $password . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCheckRight()
    {
        $key = self::randomName();
        $value = self::randomName();
        $secret = self::randomName();
        $right = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->_api->checkRight(
            $target, $grantee, $right, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CheckRightRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                        . '<urn1:right>' . $right . '</urn1:right>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CheckRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testClearCookie()
    {
        $name = self::randomName();
        $cookie = new \Zimbra\Admin\Struct\CookieSpec($name);

        $this->_api->clearCookie(
            [$cookie]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ClearCookieRequest>'
                        . '<urn1:cookie name="' . $name . '" />'
                    . '</urn1:ClearCookieRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCompactIndex()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->compactIndex(
            $mbox, IndexAction::STATUS()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CompactIndexRequest action="status">'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:CompactIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testComputeAggregateQuotaUsage()
    {
        $this->_api->computeAggregateQuotaUsage();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ComputeAggregateQuotaUsageRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testConfigureZimlet()
    {
        $aid = self::randomName();
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib($aid);

        $this->_api->configureZimlet(
            $content
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ConfigureZimletRequest>'
                        . '<urn1:content aid="' . $aid . '" />'
                    . '</urn1:ConfigureZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCopyCos()
    {
        $name = self::randomName();
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $this->_api->copyCos(
            $name, $cos
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CopyCosRequest>'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:CopyCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCountAccount()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $this->_api->countAccount(
            $domain
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CountAccountRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:CountAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCountObjects()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->_api->countObjects(
            ObjType::ACCOUNT(), $domain, $ucservice
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CountObjectsRequest type="account">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                    . '</urn1:CountObjectsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateAccount()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $this->_api->createAccount(
            $name, $password, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateCalendarResource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $this->_api->createCalendarResource(
            $name, $password, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateCalendarResourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateCos()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createCos(
            $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateCosRequest>'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dataSource = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::POP3(), $name, [$attr]);

        $this->_api->createDataSource(
            $id, $dataSource
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                            . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        . '</urn1:dataSource>'
                    . '</urn1:CreateDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createDistributionList(
            $name, true, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateDomain()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createDomain(
            $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateDomainRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateDomainRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateGalSyncAccount()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $domain = self::randomName();
        $server = self::randomName();
        $password = self::randomName();
        $folder = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->createGalSyncAccount(
            $account, $name, $domain, GalMode::LDAP(), $server, $password, $folder, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateGalSyncAccountRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::LDAP() . '" server="' . $server . '" password="' . $password . '" folder="' . $folder . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateGalSyncAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateLDAPEntry()
    {
        $key = self::randomName();
        $value = self::randomName();
        $dn = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createLDAPEntry(
            $dn, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateLDAPEntryRequest dn="' . $dn . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateLDAPEntryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateServer()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createServer(
            $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateServerRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateServerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateSystemRetentionPolicy()
    {
        $value = self::randomName();
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);

        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);
        $keep = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $policy = new \Zimbra\Admin\Struct\Policy(Type::USER(), $id, $name, $lifetime);
        $purge = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $this->_api->createSystemRetentionPolicy(
            $cos, $keep, $purge
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                . '<env:Body>'
                    . '<urn1:CreateSystemRetentionPolicyRequest>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                        . '<urn1:keep>'
                            . '<urn2:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</urn1:keep>'
                        . '<urn1:purge>'
                            . '<urn2:policy type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '</urn1:purge>'
                    . '</urn1:CreateSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateUCService()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createUCService(
            $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateUCServiceRequest>'
                        . '<urn1:name>' . $name . '</urn1:name>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateVolume()
    {
        $id = mt_rand(0, 10);
        $type = self::randomValue([1, 2, 10]);
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = self::randomName();
        $rootpath = self::randomName();

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $type, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );

        $this->_api->createVolume(
            $volume
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateVolumeRequest>'
                        . '<urn1:volume '
                            . 'id="' . $id . '" '
                            . 'type="' . $type . '" '
                            . 'compressionThreshold="' . $threshold . '" '
                            . 'mgbits="' . $mgbits . '" '
                            . 'mbits="' . $mbits . '" '
                            . 'fgbits="' . $fgbits . '" '
                            . 'fbits="' . $fbits . '" '
                            . 'name="' . $name . '" '
                            . 'rootpath="' . $rootpath . '" '
                            . 'compressBlobs="false" '
                            . 'isCurrent="true" />'
                    . '</urn1:CreateVolumeRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateXMPPComponent()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec($name, $domain, $server, [$attr]);

        $this->_api->createXMPPComponent(
            $xmpp
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateXMPPComponentRequest>'
                        . '<urn1:xmppcomponent name="' . $name . '">'
                            . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                            . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                            . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                        . '</urn1:xmppcomponent>'
                    . '</urn1:CreateXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testCreateZimlet()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->createZimlet(
            $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:CreateZimletRequest name="' . $name . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:CreateZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDedupeBlobs()
    {
        $id = mt_rand(0, 100);
        $volume = new \Zimbra\Admin\Struct\IntIdAttr($id);

        $this->_api->dedupeBlobs(
            DedupAction::STATUS(), [$volume]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DedupeBlobsRequest action="' . DedupAction::STATUS() . '">'
                        . '<urn1:volume id="' . $id . '" />'
                    . '</urn1:DedupeBlobsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDelegateAuth()
    {
        $value = self::randomName();
        $duration = mt_rand(0, 1000);
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->delegateAuth(
            $account, $duration
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DelegateAuthRequest duration="' . $duration . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:DelegateAuthRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteAccount()
    {
        $id = self::randomName();
        $this->_api->deleteAccount(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteAccountRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteCalendarResource()
    {
        $id = self::randomName();
        $this->_api->deleteCalendarResource(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteCalendarResourceRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteCos()
    {
        $id = self::randomName();
        $this->_api->deleteCos(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                    . '</urn1:DeleteCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dataSource = new \Zimbra\Struct\Id($id);

        $this->_api->deleteDataSource(
            $id, $dataSource, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource id="' . $id . '" />'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:DeleteDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDistributionList()
    {
        $id = self::randomName();
        $this->_api->deleteDistributionList(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteDistributionListRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteDomain()
    {
        $id = self::randomName();
        $this->_api->deleteDomain(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteDomainRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteGalSyncAccount()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->deleteGalSyncAccount(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteGalSyncAccountRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:DeleteGalSyncAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteLDAPEntry()
    {
        $dn = self::randomName();
        $this->_api->deleteLDAPEntry(
            $dn
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteLDAPEntryRequest dn="' . $dn . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteMailbox()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->deleteMailbox(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteMailboxRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:DeleteMailboxRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteServer()
    {
        $id = self::randomName();
        $this->_api->deleteServer(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteServerRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteSystemRetentionPolicy()
    {
        $value = self::randomName();
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $this->_api->deleteSystemRetentionPolicy(
            $policy, $cos
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                . '<env:Body>'
                    . '<urn1:DeleteSystemRetentionPolicyRequest>'
                        . '<urn2:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:DeleteSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteUCService()
    {
        $id = self::randomName();
        $this->_api->deleteUCService(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteUCServiceRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                    . '</urn1:DeleteUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteVolume()
    {
        $id = mt_rand(0, 100);
        $this->_api->deleteVolume(
            $id
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteVolumeRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteXMPPComponent()
    {
        $value = self::randomName();
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), $value);

        $this->_api->deleteXMPPComponent(
            $xmpp
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteXMPPComponentRequest>'
                        . '<urn1:xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</urn1:xmppcomponent>'
                    . '</urn1:DeleteXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeleteZimlet()
    {
        $name = self::randomName();
        $zimlet = new \Zimbra\Struct\NamedElement($name);

        $this->_api->deleteZimlet(
            $zimlet
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeleteZimletRequest>'
                        . '<urn1:zimlet name="' . $name . '" />'
                    . '</urn1:DeleteZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDeployZimlet()
    {
        $aid = self::randomName();
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib($aid);

        $this->_api->deployZimlet(
            DeployAction::DEPLOY_LOCAL(), $content, true, false
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DeployZimletRequest action="' . DeployAction::DEPLOY_LOCAL() . '" flush="true" synchronous="false">'
                        . '<urn1:content aid="' . $aid . '" />'
                    . '</urn1:DeployZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testDumpSessions()
    {
        $this->_api->dumpSessions(
            true, false
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:DumpSessionsRequest listSessions="true" groupByAccount="false" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testExportAndDeleteItems()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $exportDir = self::randomName();
        $prefix = self::randomName();

        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec($id, $version);
        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec($id, [$item]);

        $this->_api->exportAndDeleteItems(
            $mbox, $exportDir, $prefix
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ExportAndDeleteItemsRequest exportDir="' . $exportDir . '" exportFilenamePrefix="' . $prefix . '">'
                        . '<urn1:mbox id="' . $id . '">'
                            . '<urn1:item id="' . $id . '" version="' . $version . '" />'
                        . '</urn1:mbox>'
                    . '</urn1:ExportAndDeleteItemsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarEndTime()
    {
        $name = self::randomName();
        $account = new \Zimbra\Struct\NamedElement($name);

        $this->_api->fixCalendarEndTime(
            true, [$account]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FixCalendarEndTimeRequest sync="true">'
                        . '<urn1:account name="' . $name . '" />'
                    . '</urn1:FixCalendarEndTimeRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarPriority()
    {
        $name = self::randomName();
        $account = new \Zimbra\Struct\NamedElement($name);

        $this->_api->fixCalendarPriority(
            true, [$account]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FixCalendarPriorityRequest sync="true">'
                        . '<urn1:account name="' . $name . '" />'
                    . '</urn1:FixCalendarPriorityRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFixCalendarTZ()
    {
        $after = mt_rand(0, 1000);
        $name = self::randomName();
        $id = self::randomName();
        $offset = mt_rand(0, 100);
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id($id);
        $nonDst = new \Zimbra\Admin\Struct\Offset($offset);

        $rule_mon = mt_rand(1, 12);
        $rule_week = mt_rand(1, 4);
        $rule_wkday = mt_rand(1, 7);
        $rule_stdoff = mt_rand(1, 100);
        $rule_dayoff = mt_rand(1, 100);
        $rule_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rule_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule($rule_mon, $rule_week, $rule_wkday);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($rule_standard, $rule_daylight, $rule_stdoff, $rule_dayoff);

        $date_mon = mt_rand(1, 12);
        $date_mday = mt_rand(1, 31);
        $date_stdoff = mt_rand(1, 100);
        $date_dayoff = mt_rand(1, 100);
        $date_standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $date_daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate($date_mon, $date_mday);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($date_standard, $date_daylight, $date_stdoff, $date_dayoff);

        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $mon = mt_rand(1, 12);
        $hour = mt_rand(0, 23);
        $min = mt_rand(0, 59);
        $sec = mt_rand(0, 59);
        $wellKnownTz = new \Zimbra\Struct\Id($id);
        $standard = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);
        $daylight = new \Zimbra\Struct\TzOnsetInfo($mon, $hour, $min, $sec);

        $stdname = self::randomName();
        $dayname = self::randomName();
        $stdoff = mt_rand(0, 100);
        $dayoff = mt_rand(0, 100);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo($id, $stdoff, $dayoff, $daylight, $standard, $stdname, $dayname);
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);

        $tzfixup = new \Zimbra\Admin\Struct\TzFixup([$fixupRule]);
        $account = new \Zimbra\Struct\NamedElement($name);

        $this->_api->fixCalendarTZ(
            [$account], $tzfixup, true, $after
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FixCalendarTZRequest sync="true" after="' . $after . '">'
                        . '<urn1:tzfixup>'
                            . '<urn1:fixupRule>'
                                . '<urn1:match>'
                                    . '<urn1:any />'
                                    . '<urn1:tzid id="' . $id . '" />'
                                    . '<urn1:nonDst offset="' . $offset . '" />'
                                    . '<urn1:rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                                        . '<urn1:standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                        . '<urn1:daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                    . '</urn1:rules>'
                                    . '<urn1:dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                                        . '<urn1:standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                        . '<urn1:daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                    . '</urn1:dates>'
                                . '</urn1:match>'
                                . '<urn1:touch />'
                                . '<urn1:replace>'
                                    . '<urn1:wellKnownTz id="' . $id . '" />'
                                    . '<urn1:tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                                        . '<urn1:standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                        . '<urn1:daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                    . '</urn1:tz>'
                                . '</urn1:replace>'
                            . '</urn1:fixupRule>'
                        . '</urn1:tzfixup>'
                        . '<urn1:account name="' . $name . '" />'
                    . '</urn1:FixCalendarTZRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testFlushCache()
    {
        $value = self::randomName();
        $types = self::randomAttrs(\Zimbra\Enum\CacheType::enums());

        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $cache = new \Zimbra\Admin\Struct\CacheSelector($types, true, [$entry]);

        $this->_api->flushCache(
            $cache
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:FlushCacheRequest>'
                        . '<urn1:cache type="' . $types . '" allServers="true">'
                            . '<urn1:entry by="' . CacheEntryBy::NAME() . '">' . $value . '</urn1:entry>'
                        . '</urn1:cache>'
                    . '</urn1:FlushCacheRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGenCSR()
    {
        $server = self::randomName();
        $c = self::randomName();
        $st = self::randomName();
        $l = self::randomName();
        $o = self::randomName();
        $ou = self::randomName();
        $cn = self::randomName();
        $subject = self::randomName();

        $this->_api->genCSR(
            $server, true, CSRType::COMM(), CSRKeySize::SIZE_2048(), $c, $st, $l, $o, $ou, $cn, [$subject]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GenCSRRequest server="' . $server . '" new="true" type="' . CSRType::COMM() . '" keysize="' . CSRKeySize::SIZE_2048() . '">'
                        . '<urn1:C>' . $c . '</urn1:C>'
                        . '<urn1:ST>' . $st . '</urn1:ST>'
                        . '<urn1:L>' . $l . '</urn1:L>'
                        . '<urn1:O>' . $o . '</urn1:O>'
                        . '<urn1:OU>' . $ou . '</urn1:OU>'
                        . '<urn1:CN>' . $cn . '</urn1:CN>'
                        . '<urn1:SubjectAltName>' . $subject . '</urn1:SubjectAltName>'
                    . '</urn1:GenCSRRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccount()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getAccount(
            $account, true, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountRequest applyCos="true" attrs="' . $attrs . '">'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountInfo()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getAccountInfo(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountInfoRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountLoggers()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getAccountLoggers(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountLoggersRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountLoggersRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAccountMembership()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getAccountMembership(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAccountMembershipRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetAccountMembershipRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminConsoleUIComp()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $this->_api->getAdminConsoleUIComp(
            $account, $dl
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAdminConsoleUICompRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:GetAdminConsoleUICompRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminExtensionZimlets()
    {
        $this->_api->getAdminExtensionZimlets();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAdminExtensionZimletsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAdminSavedSearches()
    {
        $name = self::randomName();
        $search = new \Zimbra\Struct\NamedElement($name);

        $this->_api->getAdminSavedSearches(
            [$search]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAdminSavedSearchesRequest>'
                        . '<urn1:search name="' . $name . '" />'
                    . '</urn1:GetAdminSavedSearchesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAggregateQuotaUsageOnServer()
    {
        $this->_api->getAggregateQuotaUsageOnServer();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAggregateQuotaUsageOnServerRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAccountLoggers()
    {
        $this->_api->getAllAccountLoggers();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAccountLoggersRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAccounts()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->getAllAccounts(
            $server, $domain
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAccountsRequest>'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllAccountsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllAdminAccounts()
    {
        $this->_api->getAllAdminAccounts(true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllAdminAccountsRequest applyCos="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllCalendarResources()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->getAllCalendarResources(
            $server, $domain
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllCalendarResourcesRequest>'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllConfig()
    {
        $this->_api->getAllConfig();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllCos()
    {
        $this->_api->getAllCos();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllCosRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllDistributionLists()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->getAllDistributionLists(
            $domain
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllDistributionListsRequest>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetAllDistributionListsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllDomains()
    {
        $this->_api->getAllDomains(true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllDomainsRequest applyConfig="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllEffectiveRights()
    {
        $value = self::randomName();
        $secret = self::randomName();
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->_api->getAllEffectiveRights(
            $grantee, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllEffectiveRightsRequest expandAllAttrs="true">'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetAllEffectiveRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllFreeBusyProviders()
    {
        $this->_api->getAllFreeBusyProviders();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllFreeBusyProvidersRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllLocales()
    {
        $this->_api->getAllLocales();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllLocalesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllMailboxes()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->_api->getAllMailboxes($limit, $offset);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllMailboxesRequest limit="' . $limit . '" offset="' . $offset . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllRights()
    {
        $type = self::randomName();
        $this->_api->getAllRights($type, true, RightClass::ALL());

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllRightsRequest targetType="' . $type . '" expandAllAttrs="true" rightClass="' . RightClass::ALL() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllServers()
    {
        $service = self::randomName();
        $this->_api->getAllServers($service, true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllServersRequest service="' . $service . '" applyConfig="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllSkins()
    {
        $this->_api->getAllSkins();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllSkinsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllUCProviders()
    {
        $this->_api->getAllUCProviders();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllUCProvidersRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllUCServices()
    {
        $this->_api->getAllUCServices();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllUCServicesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllVolumes()
    {
        $this->_api->getAllVolumes();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllVolumesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllXMPPComponents()
    {
        $this->_api->getAllXMPPComponents();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllXMPPComponentsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAllZimlets()
    {
        $this->_api->getAllZimlets(ExcludeType::MAIL());

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAllZimletsRequest exclude="' . ExcludeType::MAIL() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetAttributeInfo()
    {
        $attrs = self::randomName();
        $this->_api->getAttributeInfo($attrs, [EntryType::ACCOUNT(), EntryType::ACL_TARGET()]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetAttributeInfoRequest attrs="' . $attrs  .'" entryTypes="account,aclTarget" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCalendarResource()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $calResource = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::NAME(), $value);

        $this->_api->getCalendarResource($calResource, true, [$attrs]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCalendarResourceRequest applyCos="true" attrs="' . $attrs . '">'
                        . '<urn1:calresource by="' . CalResBy::NAME() . '">' . $value . '</urn1:calresource>'
                    . '</urn1:GetCalendarResourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCert()
    {
        $server = self::randomName();
        $this->_api->getCert($server, CertType::MTA(), CSRType::COMM());

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCertRequest server="' . $server . '" type="' . CertType::MTA() . '" option="' . CSRType::COMM() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->getConfig($attr);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetConfigRequest>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCos()
    {
        $attrs = self::randomName();
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);

        $this->_api->getCos($cos, [$attrs]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCosRequest attrs="' . $attrs . '">'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:GetCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCreateObjectAttrs()
    {
        $value = self::randomName();
        $type = self::randomName();
        $target = new \Zimbra\Admin\Struct\TargetWithType($type, $value);
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);


        $this->_api->getCreateObjectAttrs($target, $domain, $cos);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCreateObjectAttrsRequest>'
                        . '<urn1:target type="' . $type . '">' . $value . '</urn1:target>'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:GetCreateObjectAttrsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCSR()
    {
        $server = self::randomName();
        $this->_api->getCSR($server, CSRType::COMM());

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCSRRequest server="' . $server . '" type="' . CSRType::COMM() . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetCurrentVolumes()
    {
        $this->_api->getCurrentVolumes();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetCurrentVolumesRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDataSources()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->getDataSources($id, [$attr]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDataSourcesRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetDataSourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDelegatedAdminConstraints()
    {
        $name = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\NamedElement($name);

        $this->_api->getDelegatedAdminConstraints(
            TargetType::DOMAIN(), $id, $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDelegatedAdminConstraintsRequest type="' . TargetType::DOMAIN() . '" id="' . $id . '" name="' . $name . '">'
                        . '<urn1:a name="' . $name . '" />'
                    . '</urn1:GetDelegatedAdminConstraintsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDevices()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $this->_api->getDevices(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDevicesRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                    . '</urn1:GetDevicesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $this->_api->getDistributionList(
            $dl, $limit, $offset, true, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListRequest limit="' . $limit . '" offset="' . $offset . '" sortAscending="true">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:GetDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDistributionListMembership()
    {
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $this->_api->getDistributionListMembership(
            $dl, $limit, $offset
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDistributionListMembershipRequest limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:dl by="' . DLBy::NAME() . '">' . $value . '</urn1:dl>'
                    . '</urn1:GetDistributionListMembershipRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDomain()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->getDomain(
            $domain, true, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDomainRequest applyConfig="true" attrs="' . $attrs . '">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetDomainRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetDomainInfo()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->getDomainInfo(
            $domain, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetDomainInfoRequest applyConfig="true">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:GetDomainInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetEffectiveRights()
    {
        $value = self::randomName();
        $secret = self::randomName();
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->_api->getEffectiveRights(
            $target, $grantee, AttrMethod::SET_ATTRS()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetEffectiveRightsRequest expandAllAttrs="' . AttrMethod::SET_ATTRS() . '">'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetEffectiveRightsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetFreeBusyQueueInfo()
    {
        $name = self::randomName();
        $provider = new \Zimbra\Struct\NamedElement($name);

        $this->_api->getFreeBusyQueueInfo(
            $provider
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetFreeBusyQueueInfoRequest>'
                        . '<urn1:provider name="' . $name . '" />'
                    . '</urn1:GetFreeBusyQueueInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetGrants()
    {
        $value = self::randomName();
        $secret = self::randomName();
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $this->_api->getGrants(
            $target, $grantee
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetGrantsRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                    . '</urn1:GetGrantsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetIndexStats()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->getIndexStats(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetIndexStatsRequest>'
                        . '<urn1:mbox id="' . $id  .'" />'
                    . '</urn1:GetIndexStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLDAPEntries()
    {
        $query = self::randomName();
        $searchBase = self::randomName();
        $sortBy = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->_api->getLDAPEntries(
            $query, $searchBase, $sortBy, true, $limit, $offset
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetLDAPEntriesRequest query="' . $query . '" sortBy="' . $sortBy . '" sortAscending="true" limit="' . $limit . '" offset="' . $offset . '">'
                        . '<urn1:ldapSearchBase>' . $searchBase . '</urn1:ldapSearchBase>'
                    . '</urn1:GetLDAPEntriesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLicenseInfo()
    {
        $this->_api->getLicenseInfo();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetLicenseInfoRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetLoggerStats()
    {
        $host = self::randomName();
        $time = self::randomName();
        $name = self::randomName();
        $limit = self::randomName();

        $hostname = new \Zimbra\Admin\Struct\HostName($host);
        $startTime = new \Zimbra\Admin\Struct\TimeAttr($time);
        $endTime = new \Zimbra\Admin\Struct\TimeAttr($time);

        $stat = new \Zimbra\Struct\NamedElement($name);
        $values = new \Zimbra\Admin\Struct\StatsValueWrapper([$stat]);
        $stats = new \Zimbra\Admin\Struct\StatsSpec($values, $name, $limit);

        $this->_api->getLoggerStats(
            $hostname, $stats, $startTime, $endTime
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetLoggerStatsRequest>'
                        . '<urn1:hostname hn="' . $host . '" />'
                        . '<urn1:stats name="' . $name . '" limit="' . $limit . '">'
                            . '<urn1:values>'
                                . '<urn1:stat name="' . $name . '" />'
                            . '</urn1:values>'
                        . '</urn1:stats>'
                        . '<urn1:startTime time="' . $time . '" />'
                        . '<urn1:endTime time="' . $time . '" />'
                    . '</urn1:GetLoggerStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailbox()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->getMailbox(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailboxRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:GetMailboxRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailboxStats()
    {
        $this->_api->getMailboxStats();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailboxStatsRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailQueue()
    {
        $name = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $wait = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, $name, false, $wait);
        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, $name);

        $this->_api->getMailQueue($server);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailQueueRequest>'
                        . '<urn1:server name="' . $name . '">'
                            . '<urn1:queue name="' . $name . '" scan="false" wait="' . $wait . '">'
                                . '<urn1:query limit="' . $limit . '" offset="' . $offset . '">'
                                    . '<urn1:field name="' . $name . '">'
                                        . '<urn1:match value="' . $value . '" />'
                                    . '</urn1:field>'
                                . '</urn1:query>'
                            . '</urn1:queue>'
                        . '</urn1:server>'
                    . '</urn1:GetMailQueueRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMailQueueInfo()
    {
        $name = self::randomName();
        $server = new \Zimbra\Struct\NamedElement($name);

        $this->_api->getMailQueueInfo(
            $server
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMailQueueInfoRequest>'
                        . '<urn1:server name="' . $name . '" />'
                    . '</urn1:GetMailQueueInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetMemcachedClientConfig()
    {
        $this->_api->getMemcachedClientConfig();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetMemcachedClientConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetQuotaUsage()
    {
        $domain = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->_api->getQuotaUsage(
            $domain, true, $limit, $offset, QuotaSortBy::TOTAL_USED(), true, false
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetQuotaUsageRequest '
                        . 'domain="' . $domain . '" '
                        . 'allServers="true" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'sortBy="' . QuotaSortBy::TOTAL_USED() . '" '
                        . 'sortAscending="true" '
                        . 'refresh="false" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRight()
    {
        $right = self::randomName();
        $this->_api->getRight($right, true);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetRightRequest expandAllAttrs="true">'
                        . '<urn1:right>' . $right . '</urn1:right>'
                    . '</urn1:GetRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetRightsDoc()
    {
        $name = self::randomName();
        $package = new \Zimbra\Admin\Struct\PackageSelector($name);

        $this->_api->getRightsDoc([$package]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetRightsDocRequest>'
                        . '<urn1:package name="' . $name . '" />'
                    . '</urn1:GetRightsDocRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServer()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);

        $this->_api->getServer($server, true, [$attrs]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerRequest applyConfig="true" attrs="' . $attrs . '">'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                    . '</urn1:GetServerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServerNIfs()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);

        $this->_api->getServerNIfs($server, IpType::IPV4());

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerNIfsRequest type="' . IpType::IPV4() . '">'
                        . '<urn1:server by="' . ServerBy::NAME() . '">' . $value . '</urn1:server>'
                    . '</urn1:GetServerNIfsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServerStats()
    {
        $value = self::randomName();
        $name = self::randomName();
        $description = self::randomName();

        $stat = new \Zimbra\Admin\Struct\Stat($value, $name, $description);

        $this->_api->getServerStats([$stat]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServerStatsRequest>'
                        . '<urn1:stat name="' . $name . '" description="' . $description . '">' . $value . '</urn1:stat>'
                    . '</urn1:GetServerStatsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetServiceStatus()
    {
        $this->_api->getServiceStatus();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetServiceStatusRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSessions()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->_api->getSessions(
            SessionType::ADMIN(), SessionsSortBy::NAME_DESC(), $limit, $offset, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetSessionsRequest '
                        . 'type="' . SessionType::ADMIN() . '" '
                        . 'sortBy="' . SessionsSortBy::NAME_DESC() . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'refresh="true" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetShareInfo()
    {
        $value = self::randomName();
        $type = self::randomName();
        $id = self::randomName();
        $name = self::randomName();

        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $grantee = new \Zimbra\Struct\GranteeChooser($type, $id, $name);

        $this->_api->getShareInfo($owner, $grantee);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetShareInfoRequest>'
                        . '<urn1:owner by="' . AccountBy::NAME() . '">' . $value . '</urn1:owner>'
                        . '<urn1:grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
                    . '</urn1:GetShareInfoRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetSystemRetentionPolicy()
    {
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);

        $this->_api->getSystemRetentionPolicy($cos);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetSystemRetentionPolicyRequest>'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:GetSystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetUCService()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->_api->getUCService($ucservice, [$attrs]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetUCServiceRequest attrs="' . $attrs . '">'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                    . '</urn1:GetUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVersionInfo()
    {
        $this->_api->getVersionInfo();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetVersionInfoRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetVolume()
    {
        $id = mt_rand(0, 100);
        $this->_api->getVolume($id);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetVolumeRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetXMPPComponent()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), $value);

        $this->_api->getXMPPComponent(
            $xmpp, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetXMPPComponentRequest attrs="' . $attrs . '">'
                        . '<urn1:xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</urn1:xmppcomponent>'
                    . '</urn1:GetXMPPComponentRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetZimlet()
    {
        $name = self::randomName();
        $attrs = self::randomName();
        $zimlet = new \Zimbra\Struct\NamedElement($name);

        $this->_api->getZimlet(
            $zimlet, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetZimletRequest attrs="' . $attrs . '">'
                        . '<urn1:zimlet name="' . $name . '" />'
                    . '</urn1:GetZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGetZimletStatus()
    {
        $this->_api->getZimletStatus();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GetZimletStatusRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testGrantRight()
    {
        $value = self::randomName();
        $secret = self::randomName();

        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );
        $right = new \Zimbra\Admin\Struct\RightModifierInfo($value, true, false, false, true);

        $this->_api->grantRight(
            $target, $grantee, $right
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:GrantRightRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                        . '<urn1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</urn1:right>'
                    . '</urn1:GrantRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testMailQueueAction()
    {
        $value = self::randomName();
        $name = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new \Zimbra\Admin\Struct\ValueAttrib($value);
        $field = new \Zimbra\Admin\Struct\QueueQueryField($name, [$attr]);
        $query = new \Zimbra\Admin\Struct\QueueQuery([$field], $limit, $offset);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, $name);
        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction($queue, $name);

        $this->_api->mailQueueAction($server);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MailQueueActionRequest>'
                        . '<urn1:server name="' . $name . '">'
                            . '<urn1:queue name="' . $name . '">'
                                . '<urn1:action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                                    . '<urn1:query limit="' . $limit . '" offset="' . $offset . '">'
                                        . '<urn1:field name="' . $name . '">'
                                            . '<urn1:match value="' . $value . '" />'
                                        . '</urn1:field>'
                                    . '</urn1:query>'
                                . '</urn1:action>'
                            . '</urn1:queue>'
                        . '</urn1:server>'
                    . '</urn1:MailQueueActionRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testMailQueueFlush()
    {
        $name = self::randomName();
        $server = new \Zimbra\Struct\NamedElement($name);

        $this->_api->mailQueueFlush($server);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MailQueueFlushRequest>'
                        . '<urn1:server name="' . $name . '" />'
                    . '</urn1:MailQueueFlushRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function migrateAccount()
    {
        $id = self::randomName();
        $action = self::randomValue(['bug72174', 'wiki', 'contactGroup']);
        $migrate = new \Zimbra\Admin\Struct\IdAndAction($id, $action);

        $this->_api->migrateAccount($migrate);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:MigrateAccountRequest>'
                        . '<urn1:migrate id="' . $id . '" action="' . $action . '" />'
                    . '</urn1:MigrateAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyAccount()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyAccount(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyAccountRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyAdminSavedSearches()
    {
        $name = self::randomName();
        $value = self::randomName();
        $search = new \Zimbra\Struct\NamedValue($name, $value);

        $this->_api->modifyAdminSavedSearches(
            [$search]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyAdminSavedSearchesRequest>'
                        . '<urn1:search name="' . $name . '">' . $value . '</urn1:search>'
                    . '</urn1:ModifyAdminSavedSearchesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyCalendarResource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyCalendarResource(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyCalendarResourceRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyCalendarResourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyConfig(
            [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyConfigRequest>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyConfigRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyCos()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyCos(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $dataSource = new \Zimbra\Struct\Id($id);
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyDataSource(
            $id, $dataSource, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDataSourceRequest id="' . $id . '">'
                        . '<urn1:dataSource id="' . $id . '" />'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyDataSourceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDelegatedAdminConstraints()
    {
        $value = self::randomName();
        $min = self::randomName();
        $max = self::randomName();
        $name = self::randomName();
        $id = self::randomName();

        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues([$value]);
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo($min, $max, $values);
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr($constraint, $name);

        $this->_api->modifyDelegatedAdminConstraints(
            TargetType::ACCOUNT(), $id, $name, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDelegatedAdminConstraintsRequest type="' . TargetType::ACCOUNT() . '" id="' . $id . '" name="' . $name . '">'
                        . '<urn1:a name="' . $name . '">'
                            . '<urn1:constraint>'
                                . '<urn1:min>' . $min . '</urn1:min>'
                                . '<urn1:max>' . $max . '</urn1:max>'
                                . '<urn1:values>'
                                    . '<urn1:v>' . $value . '</urn1:v>'
                                . '</urn1:values>'
                            . '</urn1:constraint>'
                        . '</urn1:a>'
                    . '</urn1:ModifyDelegatedAdminConstraintsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyDistributionList(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDistributionListRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyDistributionListRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyDomain()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyDomain(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyDomainRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyDomainRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyLDAPEntry()
    {
        $key = self::randomName();
        $value = self::randomName();
        $dn = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyLDAPEntry(
            $dn, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyLDAPEntryRequest dn="' . $dn . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyLDAPEntryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyServer()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyServer(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyServerRequest id="' . $id . '">'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyServerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifySystemRetentionPolicy()
    {
        $value = self::randomName();
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $this->_api->modifySystemRetentionPolicy(
            $policy, $cos
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin" xmlns:urn2="urn:zimbraMail">'
                . '<env:Body>'
                    . '<urn1:ModifySystemRetentionPolicyRequest>'
                        . '<urn2:policy type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                        . '<urn1:cos by="' . CosBy::NAME() . '">' . $value . '</urn1:cos>'
                    . '</urn1:ModifySystemRetentionPolicyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyUCService()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);

        $this->_api->modifyUCService(
            $id, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyUCServiceRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:ModifyUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyVolume()
    {
        $id = mt_rand(0, 100);
        $type = self::randomValue([1, 2, 10]);
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = self::randomName();
        $rootpath = self::randomName();

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, $type, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );

        $this->_api->modifyVolume(
            $id, $volume
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyVolumeRequest id="' . $id . '">'
                        . '<urn1:volume '
                            . 'id="' . $id . '" '
                            . 'type="' . $type . '" '
                            . 'compressionThreshold="' . $threshold . '" '
                            . 'mgbits="' . $mgbits . '" '
                            . 'mbits="' . $mbits . '" '
                            . 'fgbits="' . $fgbits . '" '
                            . 'fbits="' . $fbits . '" '
                            . 'name="' . $name . '" '
                            . 'rootpath="' . $rootpath . '" '
                            . 'compressBlobs="false" '
                            . 'isCurrent="true" />'
                    . '</urn1:ModifyVolumeRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testModifyZimlet()
    {
        $cos = self::randomName();
        $name = self::randomName();
        $value = mt_rand(0, 10);

        $acl = new \Zimbra\Admin\Struct\ZimletAcl($cos, AclType::DENY());
        $status = new \Zimbra\Admin\Struct\ValueAttrib(ZimletStatus::DISABLED()->value());
        $priority = new \Zimbra\Admin\Struct\IntegerValueAttrib($value);
        $zimlet = new \Zimbra\Admin\Struct\ZimletAclStatusPri($name, $acl, $status, $priority);

        $this->_api->modifyZimlet(
            $zimlet
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ModifyZimletRequest>'
                        . '<urn1:zimlet name="' . $name . '">'
                            . '<urn1:acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                            . '<urn1:status value="' . ZimletStatus::DISABLED() . '" />'
                            . '<urn1:priority value="' . $value . '" />'
                        . '</urn1:zimlet>'
                    . '</urn1:ModifyZimletRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testNoOp()
    {
        $this->_api->noOp();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:NoOpRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPing()
    {
        $this->_api->ping();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PingRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeAccountCalendarCache()
    {
        $id = self::randomName();
        $this->_api->purgeAccountCalendarCache($id);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeAccountCalendarCacheRequest id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeFreeBusyQueue()
    {
        $name = self::randomName();
        $provider = new \Zimbra\Struct\NamedElement($name);

        $this->_api->purgeFreeBusyQueue(
            $provider
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeFreeBusyQueueRequest>'
                        . '<urn1:provider name="' . $name . '" />'
                    . '</urn1:PurgeFreeBusyQueueRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPurgeMessages()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->purgeMessages(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PurgeMessagesRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:PurgeMessagesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testPushFreeBusy()
    {
        $name = self::randomName();
        $id = self::randomName();
        $domain = new \Zimbra\Admin\Struct\Names($name);
        $account = new \Zimbra\Struct\Id($id);

        $this->_api->pushFreeBusy(
            $domain, $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:PushFreeBusyRequest>'
                        . '<urn1:domain name="' . $name . '" />'
                        . '<urn1:account id="' . $id . '" />'
                    . '</urn1:PushFreeBusyRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testQueryWaitSet()
    {
        $waitSet = self::randomName();
        $this->_api->queryWaitSet($waitSet);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:QueryWaitSetRequest waitSet="' . $waitSet . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRecalculateMailboxCounts()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->recalculateMailboxCounts(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RecalculateMailboxCountsRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:RecalculateMailboxCountsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReIndex()
    {
        $id = self::randomName();
        $ids = self::randomName();
        $types = self::randomAttrs(\Zimbra\Enum\ReindexType::enums());
        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo($id, $types, $ids);

        $this->_api->reIndex(
           $mbox, ReIndexAction::CANCEL()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReIndexRequest action="' . ReIndexAction::CANCEL() . '">'
                        . '<urn1:mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />'
                    . '</urn1:ReIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReloadLocalConfig()
    {
        $this->_api->reloadLocalConfig();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReloadLocalConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testReloadMemcachedClientConfig()
    {
        $this->_api->reloadMemcachedClientConfig();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ReloadMemcachedClientConfigRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveAccountAlias()
    {
        $alias = self::randomName();
        $id = self::randomName();
        $this->_api->removeAccountAlias($alias, $id);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveAccountAliasRequest alias="' . $alias . '" id="' . $id . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveAccountLogger()
    {
        $value = self::randomName();
        $category = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $logger = new \Zimbra\Admin\Struct\LoggerInfo($category, LoggingLevel::ERROR());

        $this->_api->removeAccountLogger(
            $account, $logger
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveAccountLoggerRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
                    . '</urn1:RemoveAccountLoggerRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDevice()
    {
        $value = self::randomName();
        $id = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);

        $this->_api->removeDevice(
            $account, $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDeviceRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" />'
                    . '</urn1:RemoveDeviceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDistributionListAlias()
    {
        $id = self::randomName();
        $alias = self::randomName();
        $this->_api->removeDistributionListAlias($id, $alias);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRemoveDistributionListMember()
    {
        $id = self::randomName();
        $member1 = self::randomName();
        $member2 = self::randomName();
        $this->_api->removeDistributionListMember($id, [$member1, $member2]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RemoveDistributionListMemberRequest id="' . $id . '">'
                        . '<urn1:dlm>' . $member1 . '</urn1:dlm>'
                        . '<urn1:dlm>' . $member2 . '</urn1:dlm>'
                    . '</urn1:RemoveDistributionListMemberRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameAccount()
    {
        $id = self::randomName();
        $newName = self::randomName();
        $this->_api->renameAccount($id, $newName);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameAccountRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameCalendarResource()
    {
        $id = self::randomName();
        $newName = self::randomName();
        $this->_api->renameCalendarResource($id, $newName);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameCalendarResourceRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameCos()
    {
        $id = self::randomName();
        $newName = self::randomName();
        $this->_api->renameCos($id, $newName);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameCosRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:newName>' . $newName . '</urn1:newName>'
                    . '</urn1:RenameCosRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameDistributionList()
    {
        $id = self::randomName();
        $newName = self::randomName();
        $this->_api->renameDistributionList($id, $newName);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameDistributionListRequest id="' . $id . '" newName="' . $newName . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameLDAPEntry()
    {
        $dn = self::randomName();
        $newDn = self::randomName();
        $this->_api->renameLDAPEntry($dn, $newDn);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameLDAPEntryRequest dn="' . $dn . '" new_dn="' . $newDn . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRenameUCService()
    {
        $id = self::randomName();
        $newName = self::randomName();
        $this->_api->renameUCService($id, $newName);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RenameUCServiceRequest>'
                        . '<urn1:id>' . $id . '</urn1:id>'
                        . '<urn1:newName>' . $newName . '</urn1:newName>'
                    . '</urn1:RenameUCServiceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testResetAllLoggers()
    {
        $this->_api->resetAllLoggers();

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ResetAllLoggersRequest />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testResumeDevice()
    {
        $id = self::randomName();
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);

        $this->_api->resumeDevice(
            $account, $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:ResumeDeviceRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" />'
                    . '</urn1:ResumeDeviceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRevokeRight()
    {
        $value = self::randomName();
        $secret = self::randomName();

        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), $value
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );
        $right = new \Zimbra\Admin\Struct\RightModifierInfo($value, true, false, false, true);

        $this->_api->revokeRight(
            $target, $grantee, $right
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RevokeRightRequest>'
                        . '<urn1:target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</urn1:target>'
                        . '<urn1:grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</urn1:grantee>'
                        . '<urn1:right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</urn1:right>'
                    . '</urn1:RevokeRightRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testRunUnitTests()
    {
        $test1 = self::randomName();
        $test2 = self::randomName();
        $this->_api->runUnitTests([$test1, $test2]);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:RunUnitTestsRequest>'
                        . '<urn1:test>' . $test1 . '</urn1:test>'
                        . '<urn1:test>' . $test2 . '</urn1:test>'
                    . '</urn1:RunUnitTestsRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchAccounts()
    {
        $query = self::randomName();
        $domain = self::randomName();
        $attrs = self::randomAttrs(['displayName', 'zimbraId', 'zimbraAccountStatus']);
        $sortBy = self::randomName();
        $types = self::randomAttrs(['accounts', 'resources']);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $this->_api->searchAccounts(
            $query, $limit, $offset, $domain, true, $attrs, $sortBy, $types, false 
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchAccountsRequest '
                        . 'query="' . $query . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'attrs="' . $attrs . '" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'types="' . $types . '" '
                        . 'sortAscending="false" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchAutoProvDirectory()
    {
        $value = self::randomName();
        $keyAttr = self::randomName();
        $query = self::randomName();
        $name = self::randomName();
        $attrs = self::randomName();
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $this->_api->searchAutoProvDirectory(
            $domain, $keyAttr, $query, $name, $maxResults, $limit, $offset, true, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchAutoProvDirectoryRequest keyAttr="' . $keyAttr . '" query="' . $query . '" name="' . $name . '" maxResults="' . $maxResults . '" limit="' . $limit . '" offset="' . $offset . '" refresh="true" attrs="' . $attrs . '">'
                        . '<urn1:domain by="' . DomainBy::NAME() . '">' . $value . '</urn1:domain>'
                    . '</urn1:SearchAutoProvDirectoryRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchCalendarResources()
    {
        $attr = self::randomName();
        $value = self::randomName();
        $domain = self::randomName();
        $sortBy = self::randomName();
        $attrs = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $cond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::EQ(), $value, true);
        $singleCond = new \Zimbra\Struct\EntrySearchFilterSingleCond($attr, CondOp::GE(), $value, false);
        $multiConds = new \Zimbra\Struct\EntrySearchFilterMultiCond(false, true, [$singleCond]);
        $conds = new \Zimbra\Struct\EntrySearchFilterMultiCond(true, false, [$cond, $multiConds]);
        $searchFilter = new \Zimbra\Struct\EntrySearchFilterInfo($conds);

        $this->_api->searchCalendarResources(
            $searchFilter, $limit, $offset, $domain, true, $sortBy, false, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'attrs="' . $attrs . '">'
                        . '<urn1:searchFilter>'
                            . '<urn1:conds not="true" or="false">'
                                . '<urn1:conds not="false" or="true">'
                                    . '<urn1:cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                                . '</urn1:conds>'
                                . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                            . '</urn1:conds>'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $searchFilter = new \Zimbra\Struct\EntrySearchFilterInfo($cond);
        $this->_api->searchCalendarResources(
            $searchFilter, $limit, $offset, $domain, true, $sortBy, false, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchCalendarResourcesRequest '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'attrs="' . $attrs . '">'
                        . '<urn1:searchFilter>'
                            . '<urn1:cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                        . '</urn1:searchFilter>'
                    . '</urn1:SearchCalendarResourcesRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchDirectory()
    {
        $query = self::randomName();
        $domain = self::randomName();
        $sortBy = self::randomName();
        $attrs = self::randomName();
        $maxResults = mt_rand(0, 100);
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $this->_api->searchDirectory(
            $query, $maxResults, $limit, $offset, $domain, true, false, [DirSearchType::ACCOUNTS()], $sortBy, false, true, [$attrs]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchDirectoryRequest '
                        . 'query="' . $query . '" '
                        . 'maxResults="' . $maxResults . '" '
                        . 'limit="' . $limit . '" '
                        . 'offset="' . $offset . '" '
                        . 'domain="' . $domain . '" '
                        . 'applyCos="true" '
                        . 'applyConfig="false" '
                        . 'types="' . DirSearchType::ACCOUNTS() . '" '
                        . 'sortBy="' . $sortBy . '" '
                        . 'sortAscending="false" '
                        . 'countOnly="true" '
                        . 'attrs="' . $attrs . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSearchGal()
    {
        $domain = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(0, 100);
        $this->_api->searchGal(
            $domain, $name, $limit, GalSearchType::ACCOUNT(), $galAcctId
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SearchGalRequest '
                        . 'domain="' . $domain . '" '
                        . 'name="' . $name . '" '
                        . 'limit="' . $limit . '" '
                        . 'type="' . GalSearchType::ACCOUNT() . '" '
                        . 'galAcctId="' . $galAcctId . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetCurrentVolume()
    {
        $id = mt_rand(0, 100);
        $this->_api->setCurrentVolume(
            $id, VolumeType::SECONDARY()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetCurrentVolumeRequest '
                        . 'id="' . $id . '" '
                        . 'type="' . VolumeType::SECONDARY() . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSetPassword()
    {
        $id = self::randomName();
        $newPassword = self::randomName();
        $this->_api->setPassword($id, $newPassword);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SetPasswordRequest id="' . $id . '" newPassword="' . $newPassword . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSuspendDevice()
    {
        $id = self::randomName();
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);

        $this->_api->suspendDevice(
            $account, $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SuspendDeviceRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" />'
                    . '</urn1:SuspendDeviceRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testSyncGalAccount()
    {
        $id = self::randomName();
        $value = self::randomName();

        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value, false, true);
        $account = new \Zimbra\Admin\Struct\SyncGalAccountSpec($id, [$ds]);

        $this->_api->syncGalAccount(
            $account
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:SyncGalAccountRequest>'
                        . '<urn1:account id="' . $id . '">'
                            . '<urn1:datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value . '</urn1:datasource>'
                        . '</urn1:account>'
                    . '</urn1:SyncGalAccountRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUndeployZimlet()
    {
        $name = self::randomName();
        $action = self::randomName();
        $this->_api->undeployZimlet($name, $action);

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UndeployZimletRequest name="' . $name . '" action="' . $action . '" />'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUpdateDeviceStatus()
    {
        $value = self::randomName();
        $id = self::randomName();
        $status = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\IdStatus($id, $status);

        $this->_api->updateDeviceStatus(
            $account, $device
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UpdateDeviceStatusRequest>'
                        . '<urn1:account by="' . AccountBy::NAME() . '">' . $value . '</urn1:account>'
                        . '<urn1:device id="' . $id . '" status="' . $status . '" />'
                    . '</urn1:UpdateDeviceStatusRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUpdatePresenceSessionId()
    {
        $key = self::randomName();
        $value = self::randomName();
        $username = self::randomName();
        $password = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);

        $this->_api->updatePresenceSessionId(
            $ucservice, $username, $password, [$attr]
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UpdatePresenceSessionIdRequest>'
                        . '<urn1:ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</urn1:ucservice>'
                        . '<urn1:username>' . $username . '</urn1:username>'
                        . '<urn1:password>' . $password . '</urn1:password>'
                        . '<urn1:a n="' . $key . '">' . $value . '</urn1:a>'
                    . '</urn1:UpdatePresenceSessionIdRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUploadDomCert()
    {
        $certAid = self::randomName();
        $certFilename = self::randomName();
        $keyAid = self::randomName();
        $keyFilename = self::randomName();
        $this->_api->uploadDomCert(
            $certAid, $certFilename, $keyAid, $keyFilename
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UploadDomCertRequest '
                        . 'cert.aid="' . $certAid . '" '
                        . 'cert.filename="' . $certFilename . '" '
                        . 'key.aid="' . $keyAid . '" '
                        . 'key.filename="' . $keyFilename . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testUploadProxyCA()
    {
        $certAid = self::randomName();
        $certFilename = self::randomName();
        $this->_api->uploadProxyCA(
            $certAid, $certFilename
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:UploadProxyCARequest '
                        . 'cert.aid="' . $certAid . '" '
                        . 'cert.filename="' . $certFilename . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyCertKey()
    {
        $cert = self::randomName();
        $privkey = self::randomName();
        $this->_api->verifyCertKey(
            $cert, $privkey
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyCertKeyRequest '
                        . 'cert="' . $cert . '" '
                        . 'privkey="' . $privkey . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyIndex()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);

        $this->_api->verifyIndex(
            $mbox
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyIndexRequest>'
                        . '<urn1:mbox id="' . $id . '" />'
                    . '</urn1:VerifyIndexRequest>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVerifyStoreManager()
    {
        $size = mt_rand(0, 100);
        $num = mt_rand(0, 100);
        $this->_api->verifyStoreManager(
            $size, $num, true
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VerifyStoreManagerRequest '
                        . 'fileSize="' . $size . '" '
                        . 'num="' . $num . '" '
                        . 'checkBlobs="true" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
    }

    public function testVersionCheck()
    {
        $this->_api->versionCheck(
            VersionCheckAction::CHECK()
        );

        $client = $this->_api->client();
        $req = $client->lastRequest();
        $xml = '<?xml version="1.0"?>' . "\n"
            . '<env:Envelope xmlns:env="http://www.w3.org/2003/05/soap-envelope" xmlns:urn="urn:zimbra" xmlns:urn1="urn:zimbraAdmin">'
                . '<env:Body>'
                    . '<urn1:VersionCheckRequest '
                        . 'action="' . VersionCheckAction::CHECK() . '" '
                    . '/>'
                . '</env:Body>'
            . '</env:Envelope>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);
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
