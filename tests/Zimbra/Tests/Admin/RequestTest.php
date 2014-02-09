<?php

namespace Zimbra\Tests\Admin;

use Zimbra\Tests\ZimbraTestCase;

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

/**
 * Testcase class for admin request.
 */
class RequestTest extends ZimbraTestCase
{
    public function testAddAccountAlias()
    {
        $req = new \Zimbra\Admin\Request\AddAccountAlias('id', 'alias');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame('alias', $req->alias());

        $req->id('id')
            ->alias('alias');
        $this->assertSame('id', $req->id());
        $this->assertSame('alias', $req->alias());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddAccountAliasRequest id="id" alias="alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddAccountAliasRequest' => array(
                'id' => 'id',
                'alias' => 'alias',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddAccountLogger()
    {
        $logger = new \Zimbra\Admin\Struct\LoggerInfo('category', LoggingLevel::ERROR());
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\AddAccountLogger($logger, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($logger, $req->logger());
        $this->assertSame($account, $req->account());

        $req->logger($logger)
             ->account($account);
        $this->assertSame($logger, $req->logger());
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddAccountLoggerRequest>'
                .'<logger category="category" level="error" />'
                .'<account by="name">value</account>'
            .'</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddAccountLoggerRequest' => array(
                'logger' => array(
                    'category' => 'category',
                    'level' => 'error',
                ),
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListAlias()
    {
        $req = new \Zimbra\Admin\Request\AddDistributionListAlias('id', 'alias');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame('alias', $req->alias());

        $req->id('id')
            ->alias('alias');
        $this->assertSame('id', $req->id());
        $this->assertSame('alias', $req->alias());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddDistributionListAliasRequest id="id" alias="alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddDistributionListAliasRequest' => array(
                'id' => 'id',
                'alias' => 'alias',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListMember()
    {
        $req = new \Zimbra\Admin\Request\AddDistributionListMember('id', array('member1'));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame(array('member1'), $req->dlm()->all());

        $req->id('id')
            ->addDlm('member2');
        $this->assertSame('id', $req->id());
        $this->assertSame(array('member1', 'member2'), $req->dlm()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddDistributionListMemberRequest id="id">'
                .'<dlm>member1</dlm>'
                .'<dlm>member2</dlm>'
            .'</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddDistributionListMemberRequest' => array(
                'id' => 'id',
                'dlm' => array(
                    'member1',
                    'member2',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddGalSyncDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\AddGalSyncDataSource(
            $account, 'name', 'domain', GalMode::BOTH(), 'folder', array($attr)
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertTrue($req->type()->is('both'));
        $this->assertSame('folder', $req->folder());

        $req->account($account)
            ->name('name')
            ->domain('domain')
            ->type(GalMode::ZIMBRA())
            ->folder('folder');
        $this->assertSame($account, $req->account());
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertTrue($req->type()->is('zimbra'));
        $this->assertSame('folder', $req->folder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddGalSyncDataSourceRequest name="name" domain="domain" type="zimbra" folder="folder">'
                .'<account by="name">value</account>'
                .'<a n="key">value</a>'
            .'</AddGalSyncDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddGalSyncDataSourceRequest' => array(
                'name' => 'name',
                'domain' => 'domain',
                'type' => 'zimbra',
                'folder' => 'folder',
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminCreateWaitSet()
    {
        $a = new \Zimbra\Admin\Struct\WaitSetAddSpec(
        	'name', 'id', 'token', array(InterestType::MESSAGES(), InterestType::CONTACTS())
    	);
        $add = new \Zimbra\Admin\Struct\WaitSetSpec(array($a));
        $req = new \Zimbra\Admin\Request\AdminCreateWaitSet(
            $add, array(InterestType::FOLDERS()), false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('f', $req->defTypes());
        $this->assertSame($add, $req->add());
        $this->assertFalse($req->allAccounts());

        $req->addDefType(InterestType::MESSAGES())
            ->add($add)
            ->allAccounts(true);
        $this->assertSame('f,m', $req->defTypes());
        $this->assertSame($add, $req->add());
        $this->assertTrue($req->allAccounts());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AdminCreateWaitSetRequest defTypes="f,m" allAccounts="1">'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="m,c" />'
                .'</add>'
            .'</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AdminCreateWaitSetRequest' => array(
                'defTypes' => 'f,m',
                'allAccounts' => 1,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'm,c',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminDestroyWaitSet()
    {
        $req = new \Zimbra\Admin\Request\AdminDestroyWaitSet('waitSet');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('waitSet', $req->waitSet());

        $req->waitSet('waitSet');
        $this->assertSame('waitSet', $req->waitSet());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AdminDestroyWaitSetRequest waitSet="waitSet" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AdminDestroyWaitSetRequest' => array(
                'waitSet' => 'waitSet',
            ),
        );
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\AdminWaitSet(
            'waitSet', 'seq', $add, $update, $remove, false, array(InterestType::FOLDERS()), 1000
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertSame($add, $req->add());
        $this->assertSame($update, $req->update());
        $this->assertSame($remove, $req->remove());
        $this->assertFalse($req->block());
        $this->assertSame('f', $req->defTypes());
        $this->assertSame(1000, $req->timeout());

        $req->waitSet('waitSet')
            ->seq('seq')
            ->block(true)
            ->add($add)
            ->update($update)
            ->remove($remove)
            ->addDefType(InterestType::MESSAGES())
            ->addDefType(InterestType::CONTACTS())
            ->timeout(1000);
        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertSame($add, $req->add());
        $this->assertSame($update, $req->update());
        $this->assertSame($remove, $req->remove());
        $this->assertTrue($req->block());
        $this->assertSame('f,m,c', $req->defTypes());
        $this->assertSame(1000, $req->timeout());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AdminWaitSetRequest waitSet="waitSet" seq="seq" block="1" defTypes="f,m,c" timeout="1000" >'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                .'</add>'
                .'<update>'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                .'</update>'
                .'<remove>'
                    .'<a id="id" />'
                .'</remove>'
            .'</AdminWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AdminWaitSetRequest' => array(
                'waitSet' => 'waitSet',
                'seq' => 'seq',
                'block' => 1,
                'defTypes' => 'f,m,c',
                'timeout' => 1000,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f,m,c',
                        ),
                    ),
                ),
                'update' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f,m,c',
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
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAuth()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\Auth('name', 'password', 'authToken', $account, 'virtualHost', false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());
        $this->assertSame('authToken', $req->authToken());
        $this->assertSame($account, $req->account());
        $this->assertSame('virtualHost', $req->virtualHost());
        $this->assertFalse($req->persistAuthTokenCookie());

        $req->name('name')
            ->password('password')
            ->authToken('authToken')
            ->account($account)
            ->virtualHost('virtualHost')
            ->persistAuthTokenCookie(true);
        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());
        $this->assertSame('authToken', $req->authToken());
        $this->assertSame($account, $req->account());
        $this->assertSame('virtualHost', $req->virtualHost());
        $this->assertTrue($req->persistAuthTokenCookie());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AuthRequest name="name" password="password" persistAuthTokenCookie="1">'
                .'<authToken>authToken</authToken>'
                .'<account by="name">value</account>'
                .'<virtualHost>virtualHost</virtualHost>'
            .'</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AuthRequest' => array(
                'name' => 'name',
                'password' => 'password',
                'authToken' => 'authToken',
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'virtualHost' => 'virtualHost',
                'persistAuthTokenCookie' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGal()
    {
        $req = new \Zimbra\Admin\Request\AutoCompleteGal(
            'domain', 'name', GalSearchType::ALL(), 'galAcctId', 100
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('domain', $req->domain());
        $this->assertSame('name', $req->name());
        $this->assertSame('all', $req->type()->value());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame(100, $req->limit());

        $req->domain('domain')
            ->name('name')
            ->type(GalSearchType::ACCOUNT())
            ->galAcctId('galAcctId')
            ->limit(100);
        $this->assertSame('domain', $req->domain());
        $this->assertSame('name', $req->name());
        $this->assertSame('account', $req->type()->value());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame(100, $req->limit());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoCompleteGalRequest domain="domain" name="name" type="account" galAcctId="galAcctId" limit="100" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoCompleteGalRequest' => array(
                'domain' => 'domain',
                'name' => 'name',
                'type' => 'account',
                'galAcctId' => 'galAcctId',
                'limit' => 100,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvAccount()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $principal = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), 'principal');
        $req = new \Zimbra\Admin\Request\AutoProvAccount($domain, $principal, 'password');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($domain, $req->domain());
        $this->assertSame($principal, $req->principal());
        $this->assertSame('password', $req->password());

        $req->domain($domain)
            ->principal($principal)
            ->password('password');
        $this->assertSame($domain, $req->domain());
        $this->assertSame($principal, $req->principal());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoProvAccountRequest>'
                .'<domain by="name">value</domain>'
                .'<principal by="dn">principal</principal>'
                .'<password>password</password>'
            .'</AutoProvAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoProvAccountRequest' => array(
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'principal' => array(
                    'by' => 'dn',
                    '_' => 'principal',
                ),
                'password' => 'password',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvTaskControl()
    {
        $req = new \Zimbra\Admin\Request\AutoProvTaskControl(TaskAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->action()->value());

        $req->action(TaskAction::STATUS());
        $this->assertSame('status', $req->action()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AutoProvTaskControlRequest action="status" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AutoProvTaskControlRequest' => array(
                'action' => 'status',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->requestNamespace());

        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\BaseAttr');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->requestNamespace());
    }

    public function testCheckAuthConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CheckAuthConfig('name', 'password', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $req->name('name')
            ->password('password');
        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckAuthConfigRequest name="name" password="password">'
                .'<a n="key">value</a>'
            .'</CheckAuthConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckAuthConfigRequest' => array(
                'name' => 'name',
                'password' => 'password',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckBlobConsistency()
    {
        $volume = new \Zimbra\Admin\Struct\IntIdAttr(1);
        $mbox = new \Zimbra\Admin\Struct\IntIdAttr(1);

        $req = new \Zimbra\Admin\Request\CheckBlobConsistency(array($volume), array($mbox), true, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($volume), $req->volume()->all());
        $this->assertSame(array($mbox), $req->mbox()->all());
        $this->assertTrue($req->checkSize());
        $this->assertFalse($req->reportUsedBlobs());

        $req->addVolume($volume)
            ->addMbox($mbox)
            ->checkSize(false)
            ->reportUsedBlobs(true);
        $this->assertSame(array($volume, $volume), $req->volume()->all());
        $this->assertSame(array($mbox, $mbox), $req->mbox()->all());
        $this->assertFalse($req->checkSize());
        $this->assertTrue($req->reportUsedBlobs());
        $req->volume()->remove(1);
        $req->mbox()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckBlobConsistencyRequest checkSize="0" reportUsedBlobs="1">'
                .'<volume id="1" />'
                .'<mbox id="1" />'
            .'</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckBlobConsistencyRequest' => array(
                'checkSize' => 0,
                'reportUsedBlobs' => 1,
                'volume' => array(
                    array('id' => 1),
                ),
                'mbox' => array(
                    array('id' => 1),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDirectory()
    {
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector('path', true);
        $req = new \Zimbra\Admin\Request\CheckDirectory(array($dir));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($dir), $req->directory()->all());

        $req->addDirectory($dir);
        $this->assertSame(array($dir, $dir), $req->directory()->all());
        $req->directory()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckDirectoryRequest>'
                .'<directory path="path" create="1" />'
            .'</CheckDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckDirectoryRequest' => array(
                'directory' => array(
                    array(
                        'path' => 'path',
                        'create' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDomainMXRecord()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\CheckDomainMXRecord($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->domain());

        $req->domain($domain);
        $this->assertSame($domain, $req->domain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckDomainMXRecordRequest>'
                .'<domain by="name">value</domain>'
            .'</CheckDomainMXRecordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckDomainMXRecordRequest' => array(
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckExchangeAuth()
    {
        $auth = new \Zimbra\Admin\Struct\ExchangeAuthSpec(
            'url', 'user', 'pass', AuthScheme::FORM(), 'type'
        );
        $req = new \Zimbra\Admin\Request\CheckExchangeAuth($auth);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($auth, $req->auth());

        $req->auth($auth);
        $this->assertSame($auth, $req->auth());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckExchangeAuthRequest>'
                .'<auth url="url" user="user" pass="pass" scheme="form" type="type" />'
            .'</CheckExchangeAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckExchangeAuthRequest' => array(
                'auth' => array(
                    'url' => 'url',
                    'user' => 'user',
                    'pass' => 'pass',
                    'scheme' => 'form',
                    'type' => 'type',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckGalConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $query = new \Zimbra\Admin\Struct\LimitedQuery(100, 'value');

        $req = new \Zimbra\Admin\Request\CheckGalConfig($query, GalConfigAction::AUTOCOMPLETE(), array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($query, $req->query());
        $this->assertTrue($req->action()->is('autocomplete'));

        $req->query($query)
            ->action(GalConfigAction::SEARCH());
        $this->assertSame($query, $req->query());
        $this->assertTrue($req->action()->is('search'));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckGalConfigRequest>'
                .'<query limit="100">value</query>'
                .'<action>search</action>'
                .'<a n="key">value</a>'
            .'</CheckGalConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckGalConfigRequest' => array(
                'query' => array(
                    'limit' => 100,
                    '_' => 'value',
                ),
                'action' => 'search',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckHealth()
    {
        $req = new \Zimbra\Admin\Request\CheckHealth();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckHealthRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckHealthRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckHostnameResolve()
    {
        $req = new \Zimbra\Admin\Request\CheckHostnameResolve('hostname');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('hostname', $req->hostname());
        $req->hostname('hostname');
        $this->assertSame('hostname', $req->hostname());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckHostnameResolveRequest hostname="hostname" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckHostnameResolveRequest' => array(
                'hostname' => 'hostname',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckPasswordStrength()
    {
        $req = new \Zimbra\Admin\Request\CheckPasswordStrength('id', 'password');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame('password', $req->password());

        $req->id('id')
            ->password('password');
        $this->assertSame('id', $req->id());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckPasswordStrengthRequest id="id" password="password" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckPasswordStrengthRequest' => array(
                'id' => 'id',
                'password' => 'password',
            ),
        );
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\CheckRight($target, $grantee, 'right', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('right', $req->right());

        $req->target($target)
            ->grantee($grantee)
            ->right('right');
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('right', $req->right());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckRightRequest>'
                .'<target type="account" by="name">value</target>'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
                .'<right>right</right>'
                .'<a n="key">value</a>'
            .'</CheckRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckRightRequest' => array(
                'target' => array(
                    'type' => 'account',
                    '_' => 'value',
                    'by' => 'name',
                ),
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
                'right' => 'right',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testClearCookie()
    {
        $cookie = new \Zimbra\Admin\Struct\CookieSpec('name');
        $req = new \Zimbra\Admin\Request\ClearCookie(array($cookie));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($cookie), $req->cookie()->all());

        $req->addCookie($cookie);
        $this->assertSame(array($cookie, $cookie), $req->cookie()->all());
        $req->cookie()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ClearCookieRequest>'
                .'<cookie name="name" />'
            .'</ClearCookieRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ClearCookieRequest' => array(
                'cookie' => array(
                    array('name' => 'name'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompactIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\CompactIndex($mbox, IndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('start', $req->action()->value());

        $req->mbox($mbox)
            ->action(IndexAction::STATUS());
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('status', $req->action()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CompactIndexRequest action="status">'
                .'<mbox id="id" />'
            .'</CompactIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CompactIndexRequest' => array(
                'action' => 'status',
                'mbox' => array(
                    'id' => 'id'
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testComputeAggregateQuotaUsage()
    {
        $req = new \Zimbra\Admin\Request\ComputeAggregateQuotaUsage();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ComputeAggregateQuotaUsageRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ComputeAggregateQuotaUsageRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testConfigureZimlet()
    {
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib('aid');
        $req = new \Zimbra\Admin\Request\ConfigureZimlet($content);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($content, $req->content());

        $req->content($content);
        $this->assertSame($content, $req->content());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ConfigureZimletRequest>'
                .'<content aid="aid" />'
            .'</ConfigureZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ConfigureZimletRequest' => array(
                'content' => array(
                    'aid' => 'aid',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCopyCos()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\CopyCos('name', $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('name', $req->name());
        $this->assertSame($cos, $req->cos());

        $req->name('name')
            ->cos($cos);
        $this->assertSame('name', $req->name());
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CopyCosRequest>'
                .'<name>name</name>'
                .'<cos by="name">value</cos>'
            .'</CopyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CopyCosRequest' => array(
                'name' => 'name',
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCountAccount()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\CountAccount($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->domain());

        $req->domain($domain);
        $this->assertSame($domain, $req->domain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CountAccountRequest>'
                .'<domain by="name">value</domain>'
            .'</CountAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CountAccountRequest' => array(
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCountObjects()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\CountObjects(ObjType::USER_ACCOUNT(), $domain, $ucservice);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('userAccount', $req->type()->value());
        $this->assertSame($domain, $req->domain());
        $this->assertSame($ucservice, $req->ucservice());

        $req->type(ObjType::ACCOUNT())
            ->domain($domain)
            ->ucservice($ucservice);
        $this->assertSame('account', $req->type()->value());
        $this->assertSame($domain, $req->domain());
        $this->assertSame($ucservice, $req->ucservice());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CountObjectsRequest type="account">'
                .'<domain by="name">value</domain>'
                .'<ucservice by="name">value</ucservice>'
            .'</CountObjectsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CountObjectsRequest' => array(
                'type' => 'account',
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'ucservice' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateAccount('name', 'password', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $req->name('name')
            ->password('password');
        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateAccountRequest name="name" password="password">'
                .'<a n="key">value</a>'
            .'</CreateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateAccountRequest' => array(
                'name' => 'name',
                'password' => 'password',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateCalendarResource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateCalendarResource('name', 'password', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $req->name('name')
            ->password('password');
        $this->assertSame('name', $req->name());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateCalendarResourceRequest name="name" password="password">'
                .'<a n="key">value</a>'
            .'</CreateCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateCalendarResourceRequest' => array(
                'name' => 'name',
                'password' => 'password',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateCos()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateCos('name', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateCosRequest>'
            	.'<name>name</name>'
                .'<a n="key">value</a>'
            .'</CreateCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateCosRequest' => array(
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::POP3(), 'name', array($attr));

        $req = new \Zimbra\Admin\Request\CreateDataSource('id', $dataSource);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());

        $req->id('id')
            ->dataSource($dataSource);
        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDataSourceRequest id="id">'
                .'<dataSource type="pop3" name="name">'
                    .'<a n="key">value</a>'
                .'</dataSource>'
            .'</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDataSourceRequest' => array(
                'id' => 'id',
                'dataSource' => array(
                    'type' => 'pop3',
                    'name' => 'name',
                    'a' => array(
                        array(
                            'n' => 'key',
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateDistributionList('name', false, array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('name', $req->name());
        $this->assertFalse($req->dynamic());

        $req->name('name')
            ->dynamic(true);
        $this->assertSame('name', $req->name());
        $this->assertTrue($req->dynamic());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDistributionListRequest name="name" dynamic="1">'
                .'<a n="key">value</a>'
            .'</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDistributionListRequest' => array(
                'name' => 'name',
                'dynamic' => 1,
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDomain()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateDomain('name', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateDomainRequest name="name">'
                .'<a n="key">value</a>'
            .'</CreateDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateDomainRequest' => array(
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateGalSyncAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\CreateGalSyncAccount(
            $account, 'name', 'domain', GalMode::BOTH(), 'server', 'password', 'folder', array($attr)
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('both', $req->type()->value());
        $this->assertSame('server', $req->server());
        $this->assertSame($account, $req->account());
        $this->assertSame('password', $req->password());
        $this->assertSame('folder', $req->folder());

        $req->name('name')
            ->domain('domain')
            ->type(GalMode::LDAP())
            ->server('server')
            ->account($account)
            ->password('password')
            ->folder('folder');
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('ldap', $req->type()->value());
        $this->assertSame('server', $req->server());
        $this->assertSame($account, $req->account());
        $this->assertSame('password', $req->password());
        $this->assertSame('folder', $req->folder());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateGalSyncAccountRequest name="name" domain="domain" type="ldap" server="server" password="password" folder="folder">'
                .'<account by="name">value</account>'
                .'<a n="key">value</a>'
            .'</CreateGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateGalSyncAccountRequest' => array(
                'name' => 'name',
                'domain' => 'domain',
                'type' => 'ldap',
                'server' => 'server',
                'password' => 'password',
                'folder' => 'folder',
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateLDAPEntry()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateLDAPEntry('dn', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('dn', $req->dn());

        $req->dn('dn');
        $this->assertSame('dn', $req->dn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateLDAPEntryRequest dn="dn">'
                .'<a n="key">value</a>'
            .'</CreateLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateLDAPEntryRequest' => array(
                'dn' => 'dn',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateServer()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateServer('name', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateServerRequest name="name">'
                .'<a n="key">value</a>'
            .'</CreateServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateServerRequest' => array(
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');

        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');
        $keep = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $policy = new \Zimbra\Admin\Struct\Policy(Type::USER(), 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Admin\Struct\PolicyHolder($policy);

        $req = new \Zimbra\Admin\Request\CreateSystemRetentionPolicy($cos, $keep, $purge);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->cos());
        $this->assertSame($keep, $req->keep());
        $this->assertSame($purge, $req->purge());

        $req->cos($cos)
            ->keep($keep)
            ->purge($purge);
        $this->assertSame($cos, $req->cos());
        $this->assertSame($keep, $req->keep());
        $this->assertSame($purge, $req->purge());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateSystemRetentionPolicyRequest>'
                .'<cos by="name">value</cos>'
                .'<keep>'
                    .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
                .'</keep>'
                .'<purge>'
                    .'<policy type="user" id="id" name="name" lifetime="lifetime" />'
                .'</purge>'
            .'</CreateSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateSystemRetentionPolicyRequest' => array(
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'keep' => array(
                    'policy' => array(
                        'type' => 'system',
                        'id' => 'id',
                        'name' => 'name',
                        'lifetime' => 'lifetime',
                    ),
                ),
                'purge' => array(
                    'policy' => array(
                        'type' => 'user',
                        'id' => 'id',
                        'name' => 'name',
                        'lifetime' => 'lifetime',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateUCService()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateUCService('name', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateUCServiceRequest>'
                .'<name>name</name>'
                .'<a n="key">value</a>'
            .'</CreateUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateUCServiceRequest' => array(
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateVolume()
    {
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(1, 2, 3, 4, 5, 6, 7, 'name', 'rootpath', false, true);
        $req = new \Zimbra\Admin\Request\CreateVolume($volume);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($volume, $req->volume());

        $req->volume($volume);
        $this->assertSame($volume, $req->volume());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateVolumeRequest>'
                .'<volume '
                    .'id="1" '
                    .'type="2" '
                    .'compressionThreshold="3" '
                    .'mgbits="4" '
                    .'mbits="5" '
                    .'fgbits="6" '
                    .'fbits="7" '
                    .'name="name" '
                    .'rootpath="rootpath" '
                    .'compressBlobs="0" '
                    .'isCurrent="1" />'
            .'</CreateVolumeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateVolumeRequest' => array(
                'volume' => array(
                    'id' => 1,
                    'type' => 2,
                    'compressionThreshold' => 3,
                    'mgbits' => 4,
                    'mbits' => 5,
                    'fgbits' => 6,
                    'fbits' => 7,
                    'name' => 'name',
                    'rootpath' => 'rootpath',
                    'compressBlobs' => 0,
                    'isCurrent' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateXMPPComponent()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'domain');
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec('name', $domain, $server, array($attr));

        $req = new \Zimbra\Admin\Request\CreateXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->xmpp());

        $req->xmpp($xmpp);
        $this->assertSame($xmpp, $req->xmpp());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateXMPPComponentRequest>'
                .'<xmppcomponent name="name">'
                    .'<domain by="name">domain</domain>'
                    .'<server by="name">server</server>'
                    .'<a n="key">value</a>'
                .'</xmppcomponent>'
            .'</CreateXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateXMPPComponentRequest' => array(
                'xmppcomponent' => array(
                    'name' => 'name',
                    'domain' => array(
                        'by' => 'name',
                        '_' => 'domain',
                    ),
                    'server' => array(
                        'by' => 'name',
                        '_' => 'server',
                    ),
                    'a' => array(
                        array(
                            'n' => 'key',
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateZimlet()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\CreateZimlet('name', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateZimletRequest name="name">'
                .'<a n="key">value</a>'
            .'</CreateZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CreateZimletRequest' => array(
                'name' => 'name',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDedupeBlobs()
    {
        $volume = new \Zimbra\Admin\Struct\IntIdAttr(1);
        $req = new \Zimbra\Admin\Request\DedupeBlobs(DedupAction::START(), array($volume));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->action()->value());
        $this->assertSame(array($volume), $req->volume()->all());

        $req->action(DedupAction::STATUS())
            ->addVolume($volume);
        $this->assertSame('status', $req->action()->value());
        $this->assertSame(array($volume, $volume), $req->volume()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DedupeBlobsRequest action="status">'
                .'<volume id="1" />'
                .'<volume id="1" />'
            .'</DedupeBlobsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DedupeBlobsRequest' => array(
                'action' => 'status',
                'volume' => array(
                    array(
                        'id' => 1,
                    ),
                    array(
                        'id' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDelegateAuth()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\DelegateAuth($account, 1000);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());
        $this->assertSame(1000, $req->duration());

        $req->account($account)
            ->duration(1000);
        $this->assertSame($account, $req->account());
        $this->assertSame(1000, $req->duration());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DelegateAuthRequest duration="1000">'
                .'<account by="name">value</account>'
            .'</DelegateAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DelegateAuthRequest' => array(
                'duration' => 1000,
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteAccount()
    {
        $req = new \Zimbra\Admin\Request\DeleteAccount('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteAccountRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteAccountRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCalendarResource()
    {
        $req = new \Zimbra\Admin\Request\DeleteCalendarResource('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteCalendarResourceRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteCalendarResourceRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCos()
    {
        $req = new \Zimbra\Admin\Request\DeleteCos('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteCosRequest>'
                .'<id>id</id>'
            .'</DeleteCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteCosRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDataSource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Struct\Id('id');

        $req = new \Zimbra\Admin\Request\DeleteDataSource('id', $dataSource, array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());

        $req->id('id')
            ->dataSource($dataSource);
        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());


        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDataSourceRequest id="id">'
                .'<dataSource id="id" />'
                .'<a n="key">value</a>'
            .'</DeleteDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDataSourceRequest' => array(
                'id' => 'id',
                'dataSource' => array(
                    'id' => 'id',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDistributionList()
    {
        $req = new \Zimbra\Admin\Request\DeleteDistributionList('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDistributionListRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDistributionListRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDomain()
    {
        $req = new \Zimbra\Admin\Request\DeleteDomain('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteDomainRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteDomainRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteGalSyncAccount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\DeleteGalSyncAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteGalSyncAccountRequest>'
                .'<account by="name">value</account>'
            .'</DeleteGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteGalSyncAccountRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteLDAPEntry()
    {
        $req = new \Zimbra\Admin\Request\DeleteLDAPEntry('dn');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('dn', $req->dn());

        $req->dn('dn');
        $this->assertSame('dn', $req->dn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteLDAPEntryRequest dn="dn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteLDAPEntryRequest' => array(
                'dn' => 'dn',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteMailbox()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\DeleteMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());

        $req->mbox($mbox);
        $this->assertSame($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteMailboxRequest>'
                .'<mbox id="id" />'
            .'</DeleteMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteMailboxRequest' => array(
                'mbox' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteServer()
    {
        $req = new \Zimbra\Admin\Request\DeleteServer('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteServerRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteServerRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');

        $req = new \Zimbra\Admin\Request\DeleteSystemRetentionPolicy($policy, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $req->policy($policy)
            ->cos($cos);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteSystemRetentionPolicyRequest>'
                .'<policy xmlns="urn:zimbraMail" type="system" id="id" name="name" lifetime="lifetime" />'
                .'<cos by="name">value</cos>'
            .'</DeleteSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteSystemRetentionPolicyRequest' => array(
                'policy' => array(
                    'type' => 'system',
                    'id' => 'id',
                    'name' => 'name',
                    'lifetime' => 'lifetime',
                ),
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteUCService()
    {
        $req = new \Zimbra\Admin\Request\DeleteUCService('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteUCServiceRequest>'
                .'<id>id</id>'
            .'</DeleteUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteUCServiceRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteVolume()
    {
        $req = new \Zimbra\Admin\Request\DeleteVolume(100);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(100, $req->id());

        $req->id(100);
        $this->assertSame(100, $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteVolumeRequest id="100" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteVolumeRequest' => array(
                'id' => 100,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteXMPPComponent()
    {
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\DeleteXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->xmpp());

        $req->xmpp($xmpp);
        $this->assertSame($xmpp, $req->xmpp());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteXMPPComponentRequest>'
                .'<xmppcomponent by="name">value</xmppcomponent>'
            .'</DeleteXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteXMPPComponentRequest' => array(
                'xmppcomponent' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteZimlet()
    {
        $zimlet = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\DeleteZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->zimlet());

        $req->zimlet($zimlet);
        $this->assertSame($zimlet, $req->zimlet());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteZimletRequest>'
                .'<zimlet name="name" />'
            .'</DeleteZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeleteZimletRequest' => array(
                'zimlet' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeployZimlet()
    {
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib('aid');
        $req = new \Zimbra\Admin\Request\DeployZimlet(DeployAction::DEPLOY_ALL(), $content, false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('deployAll', $req->action()->value());
        $this->assertSame($content, $req->content());
        $this->assertFalse($req->flush());
        $this->assertTrue($req->synchronous());

        $req->action(DeployAction::DEPLOY_LOCAL())
            ->content($content)
            ->flush(true)
            ->synchronous(false);
        $this->assertSame('deployLocal', $req->action()->value());
        $this->assertSame($content, $req->content());
        $this->assertTrue($req->flush());
        $this->assertFalse($req->synchronous());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeployZimletRequest action="deployLocal" flush="1" synchronous="0">'
                .'<content aid="aid" />'
            .'</DeployZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DeployZimletRequest' => array(
                'action' => 'deployLocal',
                'flush' => 1,
                'synchronous' => 0,
                'content' => array(
                    'aid' => 'aid',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testDumpSessions()
    {
        $req = new \Zimbra\Admin\Request\DumpSessions(false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->listSessions());
        $this->assertTrue($req->groupByAccount());

        $req->listSessions(true)
            ->groupByAccount(false);
        $this->assertTrue($req->listSessions());
        $this->assertFalse($req->groupByAccount());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DumpSessionsRequest listSessions="1" groupByAccount="0" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'DumpSessionsRequest' => array(
                'listSessions' => 1,
                'groupByAccount' => 0,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testExportAndDeleteItems()
    {
        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec(1, 2);
        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec(1, array($item));

        $req = new \Zimbra\Admin\Request\ExportAndDeleteItems($mbox, 'exportDir', 'exportFilenamePrefix');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('exportDir', $req->exportDir());
        $this->assertSame('exportFilenamePrefix', $req->exportFilenamePrefix());

        $req->mbox($mbox)
            ->exportDir('exportDir')
            ->exportFilenamePrefix('exportFilenamePrefix');
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('exportDir', $req->exportDir());
        $this->assertSame('exportFilenamePrefix', $req->exportFilenamePrefix());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ExportAndDeleteItemsRequest exportDir="exportDir" exportFilenamePrefix="exportFilenamePrefix">'
                .'<mbox id="1">'
                    .'<item id="1" version="2" />'
                .'</mbox>'
            .'</ExportAndDeleteItemsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ExportAndDeleteItemsRequest' => array(
                'exportDir' => 'exportDir',
                'exportFilenamePrefix' => 'exportFilenamePrefix',
                'mbox' => array(
                    'id' => 1,
                    'item' => array(
                        array(
                            'id' => 1,
                            'version' => 2,
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarEndTime()
    {
        $account = new \Zimbra\Struct\NamedElement('name');

        $req = new \Zimbra\Admin\Request\FixCalendarEndTime(false, array($account));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->sync());
        $this->assertSame(array($account), $req->account()->all());

        $req->sync(true)
            ->addAccount($account);
        $this->assertTrue($req->sync());
        $this->assertSame(array($account, $account), $req->account()->all());
        $req->account()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarEndTimeRequest sync="1">'
                .'<account name="name" />'
            .'</FixCalendarEndTimeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FixCalendarEndTimeRequest' => array(
                'sync' => 1,
                'account' => array(
                    array(
                        'name' => 'name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarPriority()
    {
        $account = new \Zimbra\Struct\NamedElement('name');

        $req = new \Zimbra\Admin\Request\FixCalendarPriority(false, array($account));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->sync());
        $this->assertSame(array($account), $req->account()->all());

        $req->sync(true)
            ->addAccount($account);
        $this->assertTrue($req->sync());
        $this->assertSame(array($account, $account), $req->account()->all());
        $req->account()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarPriorityRequest sync="1">'
                .'<account name="name" />'
            .'</FixCalendarPriorityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FixCalendarPriorityRequest' => array(
                'sync' => 1,
                'account' => array(
                    array(
                        'name' => 'name',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarTZ()
    {
        $any = new \Zimbra\Admin\Struct\SimpleElement;
        $tzid = new \Zimbra\Struct\Id('id');
        $nonDst = new \Zimbra\Admin\Struct\Offset(100);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchRule(3, 2, 1);
        $rules = new \Zimbra\Admin\Struct\TzFixupRuleMatchRules($standard, $daylight, 1, 1);
        $standard = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Admin\Struct\TzFixupRuleMatchDate(2, 2);
        $dates = new \Zimbra\Admin\Struct\TzFixupRuleMatchDates($standard, $daylight, 1, 1);
        $match = new \Zimbra\Admin\Struct\TzFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Struct\Id('id');
        $standard = new \Zimbra\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Admin\Struct\CalTZInfo('id', 1, 1, $standard, $daylight, 'stdname', 'dayname');
        $replace = new \Zimbra\Admin\Struct\TzReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Admin\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Admin\Struct\TzFixupRule($match, $touch, $replace);

        $tzfixup = new \Zimbra\Admin\Struct\TzFixup(array($fixupRule));
        $account = new \Zimbra\Struct\NamedElement('name');

        $req = new \Zimbra\Admin\Request\FixCalendarTZ(array($account), $tzfixup, false, 1000);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($account), $req->account()->all());
        $this->assertSame($tzfixup, $req->tzfixup());
        $this->assertFalse($req->sync());
        $this->assertSame(1000, $req->after());

        $req->sync(true)
            ->after(1000)
            ->addAccount($account)
            ->tzfixup($tzfixup);
        $this->assertSame(array($account, $account), $req->account()->all());
        $this->assertSame($tzfixup, $req->tzfixup());
        $this->assertTrue($req->sync());
        $this->assertSame(1000, $req->after());
        $req->account()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarTZRequest sync="1" after="1000">'
                .'<tzfixup>'
                    .'<fixupRule>'
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
                        .'</match>'
                        .'<touch />'
                        .'<replace>'
                            .'<wellKnownTz id="id" />'
                            .'<tz id="id" stdoff="1" dayoff="1" stdname="stdname" dayname="dayname">'
                                .'<standard mon="1" hour="2" min="3" sec="4" />'
                                .'<daylight mon="4" hour="3" min="2" sec="1" />'
                            .'</tz>'
                        .'</replace>'
                    .'</fixupRule>'
                .'</tzfixup>'
                .'<account name="name" />'
            .'</FixCalendarTZRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FixCalendarTZRequest' => array(
                'sync' => 1,
                'after' => 1000,
                'account' => array(
                    array(
                        'name' => 'name',
                    ),
                ),
                'tzfixup' => array(
                    'fixupRule' => array(
                        array(
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
                            'touch' => array(),
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
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testFlushCache()
    {
        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), 'value');
        $cache = new \Zimbra\Admin\Struct\CacheSelector('skin,account', true, array($entry));

        $req = new \Zimbra\Admin\Request\FlushCache($cache);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cache, $req->cache());
        $req->cache($cache);
        $this->assertSame($cache, $req->cache());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FlushCacheRequest>'
                .'<cache type="skin,account" allServers="1">'
                    .'<entry by="name">value</entry>'
                .'</cache>'
            .'</FlushCacheRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'FlushCacheRequest' => array(
                'cache' => array(
                    'type' => 'skin,account',
                    'allServers' => 1,
                    'entry' => array(
                        array(
                            'by' => 'name',
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGenCSR()
    {
        $req = new \Zimbra\Admin\Request\GenCSR(
            'server', false, CSRType::SELF(), CSRKeySize::SIZE_1024(), 'c', 'sT', 'l', 'o', 'oU', 'cN', array('subject1')
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('server', $req->server());
        $this->assertFalse($req->new_());
        $this->assertSame('self', $req->type()->value());
        $this->assertSame(1024, $req->keysize()->value());
        $this->assertSame('c', $req->C());
        $this->assertSame('sT', $req->ST());
        $this->assertSame('l', $req->L());
        $this->assertSame('o', $req->O());
        $this->assertSame('oU', $req->OU());
        $this->assertSame('cN', $req->CN());
        $this->assertSame(array('subject1'), $req->subjectAltName()->all());

        $req->server('server')
            ->new_(true)
            ->type(CSRType::COMM())
            ->keysize(CSRKeySize::SIZE_2048())
            ->C('c')
            ->ST('st')
            ->L('l')
            ->O('o')
            ->OU('ou')
            ->CN('cn')
            ->addSubjectAltName('subject2');
        $this->assertSame('server', $req->server());
        $this->assertTrue($req->new_());
        $this->assertSame('comm', $req->type()->value());
        $this->assertSame(2048, $req->keysize()->value());
        $this->assertSame('c', $req->C());
        $this->assertSame('st', $req->ST());
        $this->assertSame('l', $req->L());
        $this->assertSame('o', $req->O());
        $this->assertSame('ou', $req->OU());
        $this->assertSame('cn', $req->CN());
        $this->assertSame(array('subject1', 'subject2'), $req->subjectAltName()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GenCSRRequest server="server" new="1" type="comm" keysize="2048">'
                .'<C>c</C>'
                .'<ST>st</ST>'
                .'<L>l</L>'
                .'<O>o</O>'
                .'<OU>ou</OU>'
                .'<CN>cn</CN>'
                .'<SubjectAltName>subject1</SubjectAltName>'
                .'<SubjectAltName>subject2</SubjectAltName>'
            .'</GenCSRRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GenCSRRequest' => array(
                'server' => 'server',
                'new' => 1,
                'type' => 'comm',
                'keysize' => 2048,
                'C' => 'c',
                'ST' => 'st',
                'L' => 'l',
                'O' => 'o',
                'OU' => 'ou',
                'CN' => 'cn',
                'SubjectAltName' => array(
                    'subject1',
                    'subject2',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccount()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetAccount($account, false, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());
        $this->assertFalse($req->applyCos());
        $this->assertSame('attrs', $req->attrs());

        $req->account($account)
            ->applyCos(true)
            ->attrs('attrs');
        $this->assertSame($account, $req->account());
        $this->assertTrue($req->applyCos());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountRequest applyCos="1" attrs="attrs">'
                .'<account by="name">value</account>'
            .'</GetAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountRequest' => array(
                'applyCos' => 1,
                'attrs' => 'attrs',
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountInfo()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetAccountInfo($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountInfoRequest>'
                .'<account by="name">value</account>'
            .'</GetAccountInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountInfoRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountLoggers()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetAccountLoggers($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountLoggersRequest>'
                .'<account by="name">value</account>'
            .'</GetAccountLoggersRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountLoggersRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountMembership()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetAccountMembership($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAccountMembershipRequest>'
                .'<account by="name">value</account>'
            .'</GetAccountMembershipRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAccountMembershipRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminConsoleUIComp()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\GetAdminConsoleUIComp($account, $dl);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());
        $this->assertSame($dl, $req->dl());

        $req->account($account)
            ->dl($dl);
        $this->assertSame($account, $req->account());
        $this->assertSame($dl, $req->dl());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAdminConsoleUICompRequest>'
                .'<account by="name">value</account>'
                .'<dl by="name">value</dl>'
            .'</GetAdminConsoleUICompRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAdminConsoleUICompRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminExtensionZimlets()
    {
        $req = new \Zimbra\Admin\Request\GetAdminExtensionZimlets();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAdminExtensionZimletsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAdminExtensionZimletsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminSavedSearches()
    {
        $search = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\GetAdminSavedSearches($search);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($search, $req->search());

        $req->search($search);
        $this->assertSame($search, $req->search());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAdminSavedSearchesRequest>'
                .'<search name="name" />'
            .'</GetAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAdminSavedSearchesRequest' => array(
                'search' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAggregateQuotaUsageOnServer()
    {
        $req = new \Zimbra\Admin\Request\GetAggregateQuotaUsageOnServer();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAggregateQuotaUsageOnServerRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAggregateQuotaUsageOnServerRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAccountLoggers()
    {
        $req = new \Zimbra\Admin\Request\GetAllAccountLoggers();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllAccountLoggersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllAccountLoggersRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAccounts()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\GetAllAccounts($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $this->assertSame($domain, $req->domain());

        $req->server($server)
            ->domain($domain);
        $this->assertSame($server, $req->server());
        $this->assertSame($domain, $req->domain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllAccountsRequest>'
                .'<server by="name">value</server>'
                .'<domain by="name">value</domain>'
            .'</GetAllAccountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllAccountsRequest' => array(
                'server' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAdminAccounts()
    {
        $req = new \Zimbra\Admin\Request\GetAllAdminAccounts(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->applyCos());
        $req->applyCos(true);
        $this->assertTrue($req->applyCos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllAdminAccountsRequest applyCos="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllAdminAccountsRequest' => array(
                'applyCos' => 1
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllCalendarResources()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\GetAllCalendarResources($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $this->assertSame($domain, $req->domain());

        $req->server($server)
            ->domain($domain);
        $this->assertSame($server, $req->server());
        $this->assertSame($domain, $req->domain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllCalendarResourcesRequest>'
                .'<server by="name">value</server>'
                .'<domain by="name">value</domain>'
            .'</GetAllCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllCalendarResourcesRequest' => array(
                'server' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllConfig()
    {
        $req = new \Zimbra\Admin\Request\GetAllConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllConfigRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllCos()
    {
        $req = new \Zimbra\Admin\Request\GetAllCos();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllCosRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllCosRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDistributionLists()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\GetAllDistributionLists($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->domain());

        $req->domain($domain);
        $this->assertSame($domain, $req->domain());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllDistributionListsRequest>'
                .'<domain by="name">value</domain>'
            .'</GetAllDistributionListsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllDistributionListsRequest' => array(
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDomains()
    {
        $req = new \Zimbra\Admin\Request\GetAllDomains(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->applyConfig());
        $req->applyConfig(true);
        $this->assertTrue($req->applyConfig());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllDomainsRequest applyConfig="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllDomainsRequest' => array(
                'applyConfig' => 1
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllEffectiveRights()
    {
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $req = new \Zimbra\Admin\Request\GetAllEffectiveRights($grantee, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($grantee, $req->grantee());
        $this->assertFalse($req->expandAllAttrs());

        $req->grantee($grantee)
            ->expandAllAttrs(true);
        $this->assertSame($grantee, $req->grantee());
        $this->assertTrue($req->expandAllAttrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllEffectiveRightsRequest expandAllAttrs="1">'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
            .'</GetAllEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllEffectiveRightsRequest' => array(
                'expandAllAttrs' => 1,
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllFreeBusyProviders()
    {
        $req = new \Zimbra\Admin\Request\GetAllFreeBusyProviders();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllFreeBusyProvidersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllFreeBusyProvidersRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllLocales()
    {
        $req = new \Zimbra\Admin\Request\GetAllLocales();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllLocalesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllMailboxes()
    {
        $req = new \Zimbra\Admin\Request\GetAllMailboxes(100, 100);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $req->limit(100)
            ->offset(100);
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllMailboxesRequest limit="100" offset="100" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllMailboxesRequest' => array(
                'limit' => 100,
                'offset' => 100,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllRights()
    {
        $req = new \Zimbra\Admin\Request\GetAllRights('targetType', false, RightClass::ADMIN());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('targetType', $req->targetType());
        $this->assertFalse($req->expandAllAttrs());
        $this->assertSame('ADMIN', $req->rightClass()->value());

        $req->targetType('targetType')
            ->expandAllAttrs(true)
            ->rightClass(RightClass::ALL());
        $this->assertSame('targetType', $req->targetType());
        $this->assertTrue($req->expandAllAttrs());
        $this->assertSame('ALL', $req->rightClass()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllRightsRequest targetType="targetType" expandAllAttrs="1" rightClass="ALL" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllRightsRequest' => array(
                'targetType' => 'targetType',
                'expandAllAttrs' => 1,
                'rightClass' => 'ALL',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllServers()
    {
        $req = new \Zimbra\Admin\Request\GetAllServers('service', false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('service', $req->service());
        $this->assertFalse($req->applyConfig());

        $req->service('service')
            ->applyConfig(true);
        $this->assertSame('service', $req->service());
        $this->assertTrue($req->applyConfig());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllServersRequest service="service" applyConfig="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllServersRequest' => array(
                'service' => 'service',
                'applyConfig' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllSkins()
    {
        $req = new \Zimbra\Admin\Request\GetAllSkins();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllSkinsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllUCProviders()
    {
        $req = new \Zimbra\Admin\Request\GetAllUCProviders();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllUCProvidersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllUCProvidersRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllUCServices()
    {
        $req = new \Zimbra\Admin\Request\GetAllUCServices();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllUCServicesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllUCServicesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllVolumes()
    {
        $req = new \Zimbra\Admin\Request\GetAllVolumes();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllVolumesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllVolumesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllXMPPComponents()
    {
        $req = new \Zimbra\Admin\Request\GetAllXMPPComponents();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllXMPPComponentsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllXMPPComponentsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllZimlets()
    {
        $req = new \Zimbra\Admin\Request\GetAllZimlets(ExcludeType::EXTENSION());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('extension', $req->exclude()->value());

        $req->exclude(ExcludeType::MAIL());
        $this->assertSame('mail', $req->exclude()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAllZimletsRequest exclude="mail" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAllZimletsRequest' => array(
                'exclude' => 'mail',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAttributeInfo()
    {
        $req = new \Zimbra\Admin\Request\GetAttributeInfo(
            'attrs', array(EntryType::ACCOUNT(), EntryType::ACL_TARGET())
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('attrs', $req->attrs());
        $this->assertSame('account,aclTarget', $req->entryTypes());

        $req->attrs('attrs')
            ->addEntryType(EntryType::ALIAS());
        $this->assertSame('attrs', $req->attrs());
        $this->assertSame('account,aclTarget,alias', $req->entryTypes());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAttributeInfoRequest attrs="attrs" entryTypes="account,aclTarget,alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAttributeInfoRequest' => array(
                'attrs' => 'attrs',
                'entryTypes' => 'account,aclTarget,alias',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarResource()
    {
        $calResource = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetCalendarResource($calResource, false, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($calResource, $req->calResource());
        $this->assertFalse($req->applyCos());
        $this->assertSame('attrs', $req->attrs());

        $req->calResource($calResource)
            ->applyCos(true)
            ->attrs('attrs');
        $this->assertSame($calResource, $req->calResource());
        $this->assertTrue($req->applyCos());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCalendarResourceRequest applyCos="1" attrs="attrs">'
                .'<calresource by="name">value</calresource>'
            .'</GetCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCalendarResourceRequest' => array(
                'applyCos' => 1,
                'attrs' => 'attrs',
                'calresource' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCert()
    {
        $req = new \Zimbra\Admin\Request\GetCert('server', CertType::ALL(), CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('server', $req->server());
        $this->assertSame('all', $req->type()->value());
        $this->assertSame('self', $req->option()->value());

        $req->server('server')
            ->type(CertType::MTA())
            ->option(CSRType::COMM());
        $this->assertSame('server', $req->server());
        $this->assertSame('mta', $req->type()->value());
        $this->assertSame('comm', $req->option()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCertRequest server="server" type="mta" option="comm" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCertRequest' => array(
                'server' => 'server',
                'type' => 'mta',
                'option' => 'comm',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\GetConfig(array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetConfigRequest>'
                .'<a n="key">value</a>'
            .'</GetConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetConfigRequest' => array(
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCos()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetCos($cos, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->cos());
        $this->assertSame('attrs', $req->attrs());

        $req->cos($cos)
            ->attrs('attrs');
        $this->assertSame($cos, $req->cos());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCosRequest attrs="attrs">'
                .'<cos by="name">value</cos>'
            .'</GetCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCosRequest' => array(
                'attrs' => 'attrs',
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCreateObjectAttrs()
    {
        $target = new \Zimbra\Admin\Struct\TargetWithType('type', 'value');
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');

        $req = new \Zimbra\Admin\Request\GetCreateObjectAttrs($target, $domain, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($domain, $req->domain());
        $this->assertSame($cos, $req->cos());

        $req->target($target)
            ->domain($domain)
            ->cos($cos);
        $this->assertSame($target, $req->target());
        $this->assertSame($domain, $req->domain());
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCreateObjectAttrsRequest>'
                .'<target type="type">value</target>'
                .'<domain by="name">value</domain>'
                .'<cos by="name">value</cos>'
            .'</GetCreateObjectAttrsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCreateObjectAttrsRequest' => array(
                'target' => array(
                    'type' => 'type',
                    '_' => 'value',
                ),
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCSR()
    {
        $req = new \Zimbra\Admin\Request\GetCSR('server', CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('server', $req->server());
        $this->assertSame('self', $req->type()->value());

        $req->server('server')
            ->type(CSRType::COMM());
        $this->assertSame('server', $req->server());
        $this->assertSame('comm', $req->type()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCSRRequest server="server" type="comm" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCSRRequest' => array(
                'server' => 'server',
                'type' => 'comm',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCurrentVolumes()
    {
        $req = new \Zimbra\Admin\Request\GetCurrentVolumes();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetCurrentVolumesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetCurrentVolumesRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDataSources()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\GetDataSources('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDataSourcesRequest id="id">'
                .'<a n="key">value</a>'
            .'</GetDataSourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDataSourcesRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDelegatedAdminConstraints()
    {
        $attr = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\GetDelegatedAdminConstraints(
            TargetType::ACCOUNT(), 'id', 'name', array($attr)
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('account', $req->type()->value());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr), $req->attr()->all());

        $req->type(TargetType::DOMAIN())
            ->id('id')
            ->name('name')
            ->addAttr($attr);
        $this->assertSame('domain', $req->type()->value());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr, $attr), $req->attr()->all());
        $req->attr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDelegatedAdminConstraintsRequest type="domain" id="id" name="name">'
                .'<a name="name" />'
            .'</GetDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDelegatedAdminConstraintsRequest' => array(
                'type' => 'domain',
                'id' => 'id',
                'name' => 'name',
                'a' => array(
                    array(
                        'name' => 'name',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDevices()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetDevices($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());

        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDevicesRequest>'
                .'<account by="name">value</account>'
            .'</GetDevicesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDevicesRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetDistributionList($dl, 100, 100, false, array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($dl, $req->dl());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());
        $this->assertFalse($req->sortAscending());

        $req->dl($dl)
            ->limit(100)
            ->offset(100)
            ->sortAscending(true);
        $this->assertSame($dl, $req->dl());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());
        $this->assertTrue($req->sortAscending());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDistributionListRequest limit="100" offset="100" sortAscending="1">'
                .'<dl by="name">value</dl>'
                .'<a n="key">value</a>'
            .'</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDistributionListRequest' => array(
                'limit' => 100,
                'offset' => 100,
                'sortAscending' => 1,
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }


    public function testGetDistributionListMembership()
    {
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetDistributionListMembership($dl, 100, 100);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($dl, $req->dl());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $req->dl($dl)
            ->limit(100)
            ->offset(100);
        $this->assertSame($dl, $req->dl());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDistributionListMembershipRequest limit="100" offset="100">'
                .'<dl by="name">value</dl>'
            .'</GetDistributionListMembershipRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDistributionListMembershipRequest' => array(
                'limit' => 100,
                'offset' => 100,
                'dl' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomain()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetDomain($domain, false, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->domain());
        $this->assertFalse($req->applyConfig());
        $this->assertSame('attrs', $req->attrs());

        $req->domain($domain)
            ->applyConfig(true)
            ->attrs('attrs');
        $this->assertSame($domain, $req->domain());
        $this->assertTrue($req->applyConfig());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDomainRequest applyConfig="1" attrs="attrs">'
                .'<domain by="name">value</domain>'
            .'</GetDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDomainRequest' => array(
                'applyConfig' => 1,
                'attrs' => 'attrs',
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomainInfo()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetDomainInfo($domain, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->domain());
        $this->assertFalse($req->applyConfig());

        $req->domain($domain)
            ->applyConfig(true);
        $this->assertSame($domain, $req->domain());
        $this->assertTrue($req->applyConfig());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDomainInfoRequest applyConfig="1">'
                .'<domain by="name">value</domain>'
            .'</GetDomainInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDomainInfoRequest' => array(
                'applyConfig' => 1,
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetEffectiveRights()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $req = new \Zimbra\Admin\Request\GetEffectiveRights($target, $grantee, AttrMethod::GET_ATTRS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('getAttrs', $req->expandAllAttrs()->value());

        $req->target($target)
            ->grantee($grantee)
            ->expandAllAttrs(AttrMethod::SET_ATTRS());
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('setAttrs', $req->expandAllAttrs()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetEffectiveRightsRequest expandAllAttrs="setAttrs">'
                .'<target type="account" by="name">value</target>'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
            .'</GetEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetEffectiveRightsRequest' => array(
                'expandAllAttrs' => 'setAttrs',
                'target' => array(
                    'type' => 'account',
                    '_' => 'value',
                    'by' => 'name',
                ),
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFreeBusyQueueInfo()
    {
        $provider = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\GetFreeBusyQueueInfo($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($provider, $req->provider());

        $req->provider($provider);
        $this->assertSame($provider, $req->provider());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetFreeBusyQueueInfoRequest>'
                .'<provider name="name" />'
            .'</GetFreeBusyQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetFreeBusyQueueInfoRequest' => array(
                'provider' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetGrants()
    {
        $target = new \Zimbra\Admin\Struct\EffectiveRightsTargetSelector(
            TargetType::ACCOUNT(), TargetBy::NAME(), 'value'
        );
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            'value', GranteeType::USR(), GranteeBy::ID(), 'secret', true
        );

        $req = new \Zimbra\Admin\Request\GetGrants($target, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());

        $req->target($target)
            ->grantee($grantee);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetGrantsRequest>'
                .'<target type="account" by="name">value</target>'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
            .'</GetGrantsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetGrantsRequest' => array(
                'target' => array(
                    'type' => 'account',
                    '_' => 'value',
                    'by' => 'name',
                ),
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetIndexStats()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\GetIndexStats($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());

        $req->mbox($mbox);
        $this->assertSame($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetIndexStatsRequest>'
                .'<mbox id="id" />'
            .'</GetIndexStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetIndexStatsRequest' => array(
                'mbox' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLDAPEntries()
    {
        $req = new \Zimbra\Admin\Request\GetLDAPEntries(
            'query', 'ldapSearchBase', 'sortBy', false, 100, 100
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('query', $req->query());
        $this->assertSame('ldapSearchBase', $req->ldapSearchBase());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertFalse($req->sortAscending());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $req->query('query')
            ->ldapSearchBase('ldapSearchBase')
            ->sortBy('sortBy')
            ->sortAscending(true)
            ->limit(100)
            ->offset(100);
        $this->assertSame('query', $req->query());
        $this->assertSame('ldapSearchBase', $req->ldapSearchBase());
        $this->assertSame('sortBy', $req->sortBy());
        $this->assertTrue($req->sortAscending());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetLDAPEntriesRequest query="query" sortBy="sortBy" sortAscending="1" limit="100" offset="100">'
                .'<ldapSearchBase>ldapSearchBase</ldapSearchBase>'
            .'</GetLDAPEntriesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetLDAPEntriesRequest' => array(
                'query' => 'query',
                'ldapSearchBase' => 'ldapSearchBase',
                'sortBy' => 'sortBy',
                'sortAscending' => 1,
                'limit' => 100,
                'offset' => 100,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLicenseInfo()
    {
        $req = new \Zimbra\Admin\Request\GetLicenseInfo();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetLicenseInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetLicenseInfoRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLoggerStats()
    {
        $hostname = new \Zimbra\Admin\Struct\HostName('host');
        $startTime = new \Zimbra\Admin\Struct\TimeAttr('time');
        $endTime = new \Zimbra\Admin\Struct\TimeAttr('time');

        $stat = new \Zimbra\Struct\NamedElement('name');
        $values = new \Zimbra\Admin\Struct\StatsValueWrapper(array($stat));
        $stats = new \Zimbra\Admin\Struct\StatsSpec($values, 'name', 'limit');

        $req = new \Zimbra\Admin\Request\GetLoggerStats($hostname, $stats, $startTime, $endTime);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($hostname, $req->hostname());
        $this->assertSame($stats, $req->stats());
        $this->assertSame($startTime, $req->startTime());
        $this->assertSame($endTime, $req->endTime());

        $req->hostname($hostname)
            ->stats($stats)
            ->startTime($startTime)
            ->endTime($endTime);
        $this->assertSame($hostname, $req->hostname());
        $this->assertSame($stats, $req->stats());
        $this->assertSame($startTime, $req->startTime());
        $this->assertSame($endTime, $req->endTime());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetLoggerStatsRequest>'
                .'<hostname hn="host" />'
                .'<stats name="name" limit="limit">'
                    .'<values>'
                        .'<stat name="name" />'
                    .'</values>'
                .'</stats>'
                .'<startTime time="time" />'
                .'<endTime time="time" />'
            .'</GetLoggerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetLoggerStatsRequest' => array(
                'hostname' => array(
                    'hn' => 'host',
                ),
                'stats' => array(
                    'name' => 'name',
                    'limit' => 'limit',
                    'values' => array(
                        'stat' => array(
                            array('name' => 'name'),
                        ),
                    ),
                ),
                'startTime' => array(
                    'time' => 'time',
                ),
                'endTime' => array(
                    'time' => 'time',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailbox()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('account-id');
        $req = new \Zimbra\Admin\Request\GetMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());

        $req->mbox($mbox);
        $this->assertSame($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailboxRequest>'
                .'<mbox id="account-id" />'
            .'</GetMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailboxRequest' => array(
                'mbox' => array(
                    'id' => 'account-id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxStats()
    {
        $req = new \Zimbra\Admin\Request\GetMailboxStats();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailboxStatsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailboxStatsRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailQueue()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 0);
        $queue = new \Zimbra\Admin\Struct\MailQueueQuery($query, 'name', 0, 1);
        $server = new \Zimbra\Admin\Struct\ServerMailQueueQuery($queue, 'name');

        $req = new \Zimbra\Admin\Request\GetMailQueue($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $req->server($server);
        $this->assertSame($server, $req->server());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailQueueRequest>'
                .'<server name="name">'
                    .'<queue name="name" scan="0" wait="1">'
                        .'<query limit="100" offset="0">'
                            .'<field name="name">'
                                .'<match value="value" />'
                            .'</field>'
                        .'</query>'
                    .'</queue>'
                .'</server>'
            .'</GetMailQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailQueueRequest' => array(
                'server' => array(
                    'name' => 'name',
                    'queue' => array(
                        'name' => 'name',
                        'scan' => 0,
                        'wait' => 1,
                        'query' => array(
                            'limit' => 100,
                            'offset' => 0,
                            'field' => array(
                                array(
                                    'name' => 'name',
                                    'match' => array(
                                        array('value' => 'value'),
                                    )
                                )
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailQueueInfo()
    {
        $server = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\GetMailQueueInfo($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $req->server($server);
        $this->assertSame($server, $req->server());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMailQueueInfoRequest>'
                .'<server name="name" />'
            .'</GetMailQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMailQueueInfoRequest' => array(
                'server' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMemcachedClientConfig()
    {
        $req = new \Zimbra\Admin\Request\GetMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetMemcachedClientConfigRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetQuotaUsage()
    {
        $req = new \Zimbra\Admin\Request\GetQuotaUsage(
            'domain', false, 100, 100, QuotaSortBy::PERCENT_USED(), false, true
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('domain', $req->domain());
        $this->assertFalse($req->allServers());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());
        $this->assertSame('percentUsed', $req->sortBy()->value());
        $this->assertFalse($req->sortAscending());
        $this->assertTrue($req->refresh());

        $req->domain('domain')
            ->allServers(true)
            ->limit(10)
            ->offset(0)
            ->sortBy(QuotaSortBy::TOTAL_USED())
            ->sortAscending(true)
            ->refresh(false);
        $this->assertSame('domain', $req->domain());
        $this->assertTrue($req->allServers());
        $this->assertSame(10, $req->limit());
        $this->assertSame(0, $req->offset());
        $this->assertSame('totalUsed', $req->sortBy()->value());
        $this->assertTrue($req->sortAscending());
        $this->assertFalse($req->refresh());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetQuotaUsageRequest '
                .'domain="domain" '
                .'allServers="1" '
                .'limit="10" '
                .'offset="0" '
                .'sortBy="totalUsed" '
                .'sortAscending="1" '
                .'refresh="0" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetQuotaUsageRequest' => array(
                'domain' => 'domain',
                'allServers' => 1,
                'limit' => 10,
                'offset' => 0,
                'sortBy' => 'totalUsed',
                'sortAscending' => 1,
                'refresh' => 0,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRight()
    {
        $req = new \Zimbra\Admin\Request\GetRight('right', false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('right', $req->right());
        $this->assertFalse($req->expandAllAttrs());

        $req->right('right')
            ->expandAllAttrs(true);
        $this->assertSame('right', $req->right());
        $this->assertTrue($req->expandAllAttrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetRightRequest right="right" expandAllAttrs="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetRightRequest' => array(
                'right' => 'right',
                'expandAllAttrs' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRightsDoc()
    {
        $package = new \Zimbra\Admin\Struct\PackageSelector('name');
        $req = new \Zimbra\Admin\Request\GetRightsDoc(array($package));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($package), $req->package()->all());

        $req->addPackage($package);
        $this->assertSame(array($package, $package), $req->package()->all());
        $req->package()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetRightsDocRequest>'
                .'<package name="name" />'
            .'</GetRightsDocRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetRightsDocRequest' => array(
                'package' => array(
                    array('name' => 'name'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServer()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');
        $req = new \Zimbra\Admin\Request\GetServer($server, false, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $this->assertFalse($req->applyConfig());
        $this->assertSame('attrs', $req->attrs());

        $req->server($server)
            ->applyConfig(true)
            ->attrs('attrs');
        $this->assertSame($server, $req->server());
        $this->assertTrue($req->applyConfig());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetServerRequest applyConfig="1" attrs="attrs">'
                .'<server by="name">server</server>'
            .'</GetServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetServerRequest' => array(
                'applyConfig' => 1,
                'attrs' => 'attrs',
                'server' => array(
                    'by' => 'name',
                    '_' => 'server',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerNIfs()
    {
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), 'server');
        $req = new \Zimbra\Admin\Request\GetServerNIfs($server, IpType::BOTH());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $this->assertSame('both', $req->type()->value());

        $req->server($server)
            ->type(IpType::IPV4());
        $this->assertSame($server, $req->server());
        $this->assertSame('ipV4', $req->type()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetServerNIfsRequest type="ipV4">'
                .'<server by="name">server</server>'
            .'</GetServerNIfsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetServerNIfsRequest' => array(
                'type' => 'ipV4',
                'server' => array(
                    'by' => 'name',
                    '_' => 'server',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerStats()
    {
        $stat = new \Zimbra\Admin\Struct\Stat('name', 'description');
        $req = new \Zimbra\Admin\Request\GetServerStats(array($stat));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($stat), $req->stat()->all());
        $req->addStat($stat);
        $this->assertSame(array($stat, $stat), $req->stat()->all());
        $req->stat()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetServerStatsRequest>'
                .'<stat name="name" description="description" />'
            .'</GetServerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetServerStatsRequest' => array(
                'stat' => array(
                    array(
                        'name' => 'name',
                        'description' => 'description',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServiceStatus()
    {
        $req = new \Zimbra\Admin\Request\GetServiceStatus();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetServiceStatusRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetServiceStatusRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSessions()
    {
        $req = new \Zimbra\Admin\Request\GetSessions(
            SessionType::SOAP(), SessionsSortBy::NAME_ASC(), 100, 100, false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('soap', $req->type()->value());
        $this->assertSame('nameAsc', $req->sortBy()->value());
        $this->assertSame(100, $req->limit());
        $this->assertSame(100, $req->offset());
        $this->assertFalse($req->refresh());

        $req->type(SessionType::ADMIN())
            ->sortBy(SessionsSortBy::NAME_DESC())
            ->limit(10)
            ->offset(0)
            ->refresh(true);
        $this->assertSame('admin', $req->type()->value());
        $this->assertSame('nameDesc', $req->sortBy()->value());
        $this->assertSame(10, $req->limit());
        $this->assertSame(0, $req->offset());
        $this->assertTrue($req->refresh());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSessionsRequest '
                .'type="admin" '
                .'sortBy="nameDesc" '
                .'limit="10" '
                .'offset="0" '
                .'refresh="1" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSessionsRequest' => array(
                'type' => 'admin',
                'sortBy' => 'nameDesc',
                'limit' => 10,
                'offset' => 0,
                'refresh' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareInfo()
    {
        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $grantee = new \Zimbra\Struct\GranteeChooser('type', 'id', 'name');
     
        $req = new \Zimbra\Admin\Request\GetShareInfo($owner, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($owner, $req->owner());
        $this->assertSame($grantee, $req->grantee());

        $req->owner($owner)
            ->grantee($grantee);
        $this->assertSame($owner, $req->owner());
        $this->assertSame($grantee, $req->grantee());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetShareInfoRequest>'
                .'<owner by="name">value</owner>'
                .'<grantee type="type" id="id" name="name" />'
            .'</GetShareInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetShareInfoRequest' => array(
                'owner' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'grantee' => array(
                    'type' => 'type',
                    'id' => 'id',
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetSystemRetentionPolicy($cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->cos());
        $req->cos($cos);
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetSystemRetentionPolicyRequest>'
                .'<cos by="name">value</cos>'
            .'</GetSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetSystemRetentionPolicyRequest' => array(
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCService()
    {
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetUCService($ucservice, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($ucservice, $req->ucservice());
        $this->assertSame('attrs', $req->attrs());

        $req->ucservice($ucservice)
            ->attrs('attrs');
        $this->assertSame($ucservice, $req->ucservice());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetUCServiceRequest attrs="attrs">'
                .'<ucservice by="name">value</ucservice>'
            .'</GetUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetUCServiceRequest' => array(
                'attrs' => 'attrs',
                'ucservice' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVersionInfo()
    {
        $req = new \Zimbra\Admin\Request\GetVersionInfo();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVersionInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVersionInfoRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVolume()
    {
        $req = new \Zimbra\Admin\Request\GetVolume(100);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(100, $req->id());
        $req->id(100);
        $this->assertSame(100, $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetVolumeRequest id="100" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetVolumeRequest' => array(
                'id' => 100
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetXMPPComponent()
    {
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\GetXMPPComponent($xmpp, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->xmpp());
        $this->assertSame('attrs', $req->attrs());

        $req->xmpp($xmpp)
            ->attrs('attrs');
        $this->assertSame($xmpp, $req->xmpp());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetXMPPComponentRequest attrs="attrs">'
                .'<xmppcomponent by="name">value</xmppcomponent>'
            .'</GetXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetXMPPComponentRequest' => array(
                'attrs' => 'attrs',
                'xmppcomponent' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetZimlet()
    {
        $zimlet = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\GetZimlet($zimlet, 'attrs');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->zimlet());
        $this->assertSame('attrs', $req->attrs());

        $req->zimlet($zimlet)
            ->attrs('attrs');
        $this->assertSame($zimlet, $req->zimlet());
        $this->assertSame('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetZimletRequest attrs="attrs">'
                .'<zimlet name="name" />'
            .'</GetZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetZimletRequest' => array(
                'attrs' => 'attrs',
                'zimlet' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetZimletStatus()
    {
        $req = new \Zimbra\Admin\Request\GetZimletStatus();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetZimletStatusRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetZimletStatusRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GrantRight($target, $grantee, $right);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame($right, $req->right());

        $req->target($target)
            ->grantee($grantee)
            ->right($right);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame($right, $req->right());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GrantRightRequest>'
                .'<target type="account" by="name">value</target>'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
                .'<right deny="1" canDelegate="0" disinheritSubGroups="0" subDomain="1">value</right>'
            .'</GrantRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GrantRightRequest' => array(
                'target' => array(
                    'type' => 'account',
                    '_' => 'value',
                    'by' => 'name',
                ),
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
                'right' => array(
                    'deny' => 1,
                    'canDelegate' => 0,
                    'disinheritSubGroups' => 0,
                    'subDomain' => 1,
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailQueueAction()
    {
        $attr = new \Zimbra\Admin\Struct\ValueAttrib('value');
        $field = new \Zimbra\Admin\Struct\QueueQueryField('name', array($attr));
        $query = new \Zimbra\Admin\Struct\QueueQuery(array($field), 100, 0);
        $action = new \Zimbra\Admin\Struct\MailQueueAction($query, QueueAction::HOLD(), QueueActionBy::QUERY());
        $queue = new \Zimbra\Admin\Struct\MailQueueWithAction($action, 'name');
        $server = new \Zimbra\Admin\Struct\ServerWithQueueAction($queue, 'name');

        $req = new \Zimbra\Admin\Request\MailQueueAction($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $req->server($server);
        $this->assertSame($server, $req->server());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MailQueueActionRequest>'
                .'<server name="name">'
                    .'<queue name="name">'
                        .'<action op="hold" by="query">'
                            .'<query limit="100" offset="0">'
                                .'<field name="name">'
                                    .'<match value="value" />'
                                .'</field>'
                            .'</query>'
                        .'</action>'
                    .'</queue>'
                .'</server>'
            .'</MailQueueActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MailQueueActionRequest' => array(
                'server' => array(
                    'name' => 'name',
                    'queue' => array(
                        'name' => 'name',
                        'action' => array(
                            'op' => 'hold',
                            'by' => 'query',
                            'query' => array(
                                'limit' => 100,
                                'offset' => 0,
                                'field' => array(
                                    array(
                                        'name' => 'name',
                                        'match' => array(
                                            array('value' => 'value'),
                                        )
                                    )
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailQueueFlush()
    {
        $server = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\MailQueueFlush($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->server());
        $req->server($server);
        $this->assertSame($server, $req->server());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MailQueueFlushRequest>'
                .'<server name="name" />'
            .'</MailQueueFlushRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MailQueueFlushRequest' => array(
                'server' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testMigrateAccount()
    {
        $migrate = new \Zimbra\Admin\Struct\IdAndAction('id', 'wiki');
        $req = new \Zimbra\Admin\Request\MigrateAccount($migrate);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($migrate, $req->migrate());
        $req->migrate($migrate);
        $this->assertSame($migrate, $req->migrate());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<MigrateAccountRequest>'
                .'<migrate id="id" action="wiki" />'
            .'</MigrateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'MigrateAccountRequest' => array(
                'migrate' => array(
                    'id' => 'id',
                    'action' => 'wiki',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAccount()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyAccount('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyAccountRequest id="id">'
                .'<a n="key">value</a>'
            .'</ModifyAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyAccountRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAdminSavedSearches()
    {
        $search = new \Zimbra\Struct\NamedValue('name', 'value');
        $req = new \Zimbra\Admin\Request\ModifyAdminSavedSearches(array($search));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(array($search), $req->search()->all());

        $req->addSearch($search);
        $this->assertSame(array($search, $search), $req->search()->all());
        $req->search()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyAdminSavedSearchesRequest>'
                .'<search name="name">value</search>'
            .'</ModifyAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyAdminSavedSearchesRequest' => array(
                'search' => array(
                    array(
                        'name' => 'name',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyCalendarResource()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyCalendarResource('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyCalendarResourceRequest id="id">'
                .'<a n="key">value</a>'
            .'</ModifyCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyCalendarResourceRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyConfig()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyConfig(array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyConfigRequest>'
                .'<a n="key">value</a>'
            .'</ModifyConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyConfigRequest' => array(
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyCos()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyCos('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyCosRequest>'
                .'<id>id</id>'
                .'<a n="key">value</a>'
            .'</ModifyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyCosRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDataSource()
    {
        $dataSource = new \Zimbra\Struct\Id('id');
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyDataSource('id', $dataSource, array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());

        $req->id('id')
            ->dataSource($dataSource);
        $this->assertSame('id', $req->id());
        $this->assertSame($dataSource, $req->dataSource());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDataSourceRequest id="id">'
                .'<dataSource id="id" />'
                .'<a n="key">value</a>'
            .'</ModifyDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDataSourceRequest' => array(
                'id' => 'id',
                'dataSource' => array(
                    'id' => 'id',
                ),
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDelegatedAdminConstraints()
    {
        $values = new \Zimbra\Admin\Struct\ConstraintInfoValues(array('value'));
        $constraint = new \Zimbra\Admin\Struct\ConstraintInfo('min', 'max', $values);
        $attr = new \Zimbra\Admin\Struct\ConstraintAttr($constraint, 'name');

        $req = new \Zimbra\Admin\Request\ModifyDelegatedAdminConstraints(
            TargetType::GROUP(), 'id', 'name', array($attr)
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('group', $req->type()->value());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr), $req->attr()->all());

        $req->type(TargetType::ACCOUNT())
            ->id('id')
            ->name('name')
            ->addAttr($attr);
        $this->assertSame('account', $req->type()->value());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr, $attr), $req->attr()->all());
        $req->attr()->remove(1);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDelegatedAdminConstraintsRequest type="account" id="id" name="name">'
                .'<a name="name">'
                    .'<constraint>'
                        .'<min>min</min>'
                        .'<max>max</max>'
                        .'<values>'
                            .'<v>value</v>'
                        .'</values>'
                    .'</constraint>'
                .'</a>'
            .'</ModifyDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDelegatedAdminConstraintsRequest' => array(
                'type' => 'account',
                'id' => 'id',
                'name' => 'name',
                'a' => array(
                    array(
                        'name' => 'name',
                        'constraint' => array(
                            'min' => 'min',
                            'max' => 'max',
                            'values' => array(
                                'v' => array(
                                    'value',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDistributionList()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyDistributionList('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDistributionListRequest id="id">'
                .'<a n="key">value</a>'
            .'</ModifyDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDistributionListRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDomain()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyDomain('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyDomainRequest id="id">'
                .'<a n="key">value</a>'
            .'</ModifyDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyDomainRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyLDAPEntry()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyLDAPEntry('dn', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('dn', $req->dn());

        $req->dn('dn');
        $this->assertSame('dn', $req->dn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyLDAPEntryRequest dn="dn">'
                .'<a n="key">value</a>'
            .'</ModifyLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyLDAPEntryRequest' => array(
                'dn' => 'dn',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyServer()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyServer('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyServerRequest id="id">'
                .'<a n="key">value</a>'
            .'</ModifyServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyServerRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySystemRetentionPolicy()
    {
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), 'value');
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), 'id', 'name', 'lifetime');

        $req = new \Zimbra\Admin\Request\ModifySystemRetentionPolicy($policy, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $req->policy($policy)
            ->cos($cos);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifySystemRetentionPolicyRequest>'
                .'<policy xmlns="urn:zimbraMail" type="system" id="id" name="name" lifetime="lifetime" />'
                .'<cos by="name">value</cos>'
            .'</ModifySystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifySystemRetentionPolicyRequest' => array(
                'policy' => array(
                    'type' => 'system',
                    'id' => 'id',
                    'name' => 'name',
                    'lifetime' => 'lifetime',
                ),
                'cos' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyUCService()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\Admin\Request\ModifyUCService('id', array($attr));
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame('id', $req->id());

        $req->id('id');
        $this->assertSame('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyUCServiceRequest>'
                .'<id>id</id>'
                .'<a n="key">value</a>'
            .'</ModifyUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyUCServiceRequest' => array(
                'id' => 'id',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVolume()
    {
        $volume = new \Zimbra\Admin\Struct\VolumeInfo(1, 2, 3, 4, 5, 6, 7, 'name', 'rootpath', false, true);
        $req = new \Zimbra\Admin\Request\ModifyVolume(100, $volume);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame(100, $req->id());
        $this->assertSame($volume, $req->volume());

        $req->id(100)
            ->volume($volume);
        $this->assertSame(100, $req->id());
        $this->assertSame($volume, $req->volume());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyVolumeRequest id="100">'
                .'<volume '
                    .'id="1" '
                    .'type="2" '
                    .'compressionThreshold="3" '
                    .'mgbits="4" '
                    .'mbits="5" '
                    .'fgbits="6" '
                    .'fbits="7" '
                    .'name="name" '
                    .'rootpath="rootpath" '
                    .'compressBlobs="0" '
                    .'isCurrent="1" />'
            .'</ModifyVolumeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyVolumeRequest' => array(
                'id' => 100,
                'volume' => array(
                    'id' => 1,
                    'type' => 2,
                    'compressionThreshold' => 3,
                    'mgbits' => 4,
                    'mbits' => 5,
                    'fgbits' => 6,
                    'fbits' => 7,
                    'name' => 'name',
                    'rootpath' => 'rootpath',
                    'compressBlobs' => 0,
                    'isCurrent' => 1,
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyZimlet()
    {
        $acl = new \Zimbra\Admin\Struct\ZimletAcl('cos', AclType::DENY());
        $status = new \Zimbra\Admin\Struct\ValueAttrib(ZimletStatus::DISABLED);
        $priority = new \Zimbra\Admin\Struct\IntegerValueAttrib(1);
        $zimlet = new \Zimbra\Admin\Struct\ZimletAclStatusPri('name', $acl, $status, $priority);

        $req = new \Zimbra\Admin\Request\ModifyZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->zimlet());
        $req->zimlet($zimlet);
        $this->assertSame($zimlet, $req->zimlet());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ModifyZimletRequest>'
                .'<zimlet name="name">'
                    .'<acl cos="cos" acl="deny" />'
                    .'<status value="disabled" />'
                    .'<priority value="1" />'
                .'</zimlet>'
            .'</ModifyZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ModifyZimletRequest' => array(
                'zimlet' => array(
                    'name' => 'name',
                    'acl' => array(
                        'cos' => 'cos',
                        'acl' => 'deny',
                    ),
                    'status' => array(
                        'value' => 'disabled',
                    ),
                    'priority' => array(
                        'value' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoOp()
    {
        $req = new \Zimbra\Admin\Request\NoOp();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<NoOpRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'NoOpRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPing()
    {
        $req = new \Zimbra\Admin\Request\Ping();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PingRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PingRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeAccountCalendarCache()
    {
        $req = new \Zimbra\Admin\Request\PurgeAccountCalendarCache('id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $req->id('id');
        $this->assertEquals('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeAccountCalendarCacheRequest id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeAccountCalendarCacheRequest' => array(
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeFreeBusyQueue()
    {
        $provider = new \Zimbra\Struct\NamedElement('name');
        $req = new \Zimbra\Admin\Request\PurgeFreeBusyQueue($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($provider, $req->provider());
        $req->provider($provider);
        $this->assertEquals($provider, $req->provider());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeFreeBusyQueueRequest>'
                .'<provider name="name" />'
            .'</PurgeFreeBusyQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeFreeBusyQueueRequest' => array(
                'provider' => array(
                    'name' => 'name',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeMessages()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\PurgeMessages($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->mbox());
        $req->mbox($mbox);
        $this->assertEquals($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PurgeMessagesRequest>'
                .'<mbox id="id" />'
            .'</PurgeMessagesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PurgeMessagesRequest' => array(
                'mbox' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testPushFreeBusy()
    {
        $domain = new \Zimbra\Admin\Struct\Names('name');
        $account = new \Zimbra\Struct\Id('id');

        $req = new \Zimbra\Admin\Request\PushFreeBusy($domain, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->domain());
        $this->assertEquals($account, $req->account());

        $req->domain($domain)
            ->account($account);
        $this->assertEquals($domain, $req->domain());
        $this->assertEquals($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<PushFreeBusyRequest>'
                .'<domain name="name" />'
                .'<account id="id" />'
            .'</PushFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'PushFreeBusyRequest' => array(
                'domain' => array(
                    'name' => 'name',
                ),
                'account' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testQueryWaitSet()
    {
        $req = new \Zimbra\Admin\Request\QueryWaitSet('waitSet');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('waitSet', $req->waitSet());
        $req->waitSet('waitSet');
        $this->assertEquals('waitSet', $req->waitSet());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<QueryWaitSetRequest waitSet="waitSet" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'QueryWaitSetRequest' => array(
                'waitSet' => 'waitSet',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRecalculateMailboxCounts()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\RecalculateMailboxCounts($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->mbox());
        $req->mbox($mbox);
        $this->assertEquals($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RecalculateMailboxCountsRequest>'
                .'<mbox id="id" />'
            .'</RecalculateMailboxCountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RecalculateMailboxCountsRequest' => array(
                'mbox' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testReIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo('id', 'task,note', 'abc,xyz');
        $req = new \Zimbra\Admin\Request\ReIndex($mbox, ReIndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->mbox());
        $this->assertEquals('start', $req->action()->value());
        $req->mbox($mbox)
            ->action(ReIndexAction::CANCEL());
        $this->assertEquals($mbox, $req->mbox());
        $this->assertEquals('cancel', $req->action()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ReIndexRequest action="cancel">'
                .'<mbox id="id" types="task,note" ids="abc,xyz" />'
            .'</ReIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ReIndexRequest' => array(
                'action' => 'cancel',
                'mbox' => array(
                    'id' => 'id',
                    'types' => 'task,note',
                    'ids' => 'abc,xyz',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadLocalConfig()
    {
        $req = new \Zimbra\Admin\Request\ReloadLocalConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ReloadLocalConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ReloadLocalConfigRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadMemcachedClientConfig()
    {
        $req = new \Zimbra\Admin\Request\ReloadMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ReloadMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ReloadMemcachedClientConfigRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountAlias()
    {
        $req = new \Zimbra\Admin\Request\RemoveAccountAlias('alias', 'id');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('alias', $req->alias());
        $this->assertEquals('id', $req->id());
        $req->alias('alias')
            ->id('id');
        $this->assertEquals('alias', $req->alias());
        $this->assertEquals('id', $req->id());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveAccountAliasRequest alias="alias" id="id" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveAccountAliasRequest' => array(
                'alias' => 'alias',
                'id' => 'id',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountLogger()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $logger = new \Zimbra\Admin\Struct\LoggerInfo('category', LoggingLevel::ERROR());
        $req = new \Zimbra\Admin\Request\RemoveAccountLogger($account, $logger);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame($logger, $req->logger());
        $req->account($account)
            ->logger($logger);
        $this->assertSame($account, $req->account());
        $this->assertSame($logger, $req->logger());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveAccountLoggerRequest>'
                .'<account by="name">value</account>'
                .'<logger category="category" level="error" />'
            .'</RemoveAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveAccountLoggerRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'logger' => array(
                    'category' => 'category',
                    'level' => 'error',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');
        $req = new \Zimbra\Admin\Request\RemoveDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());
        $req->account($account)
            ->device($device);
        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveDeviceRequest>'
                .'<account by="name">value</account>'
                .'<device id="id" />'
            .'</RemoveDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveDeviceRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'device' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDistributionListAlias()
    {
        $req = new \Zimbra\Admin\Request\RemoveDistributionListAlias('id', 'alias');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('alias', $req->alias());
        $req->id('id')
            ->alias('alias');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('alias', $req->alias());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveDistributionListAliasRequest id="id" alias="alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveDistributionListAliasRequest' => array(
                'id' => 'id',
                'alias' => 'alias',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDistributionListMember()
    {
        $req = new \Zimbra\Admin\Request\RemoveDistributionListMember('id', array('dlm'));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals(array('dlm'), $req->dlm()->all());
        $req->id('id')
            ->addDlm('dlm1');
        $this->assertEquals('id', $req->id());
        $this->assertEquals(array('dlm', 'dlm1'), $req->dlm()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RemoveDistributionListMemberRequest id="id">'
                .'<dlm>dlm</dlm>'
                .'<dlm>dlm1</dlm>'
            .'</RemoveDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RemoveDistributionListMemberRequest' => array(
                'id' => 'id',
                'dlm' => array(
                    'dlm',
                    'dlm1',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameAccount()
    {
        $req = new \Zimbra\Admin\Request\RenameAccount('id', 'newName');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());
        $req->id('id')
            ->newName('newName');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameAccountRequest id="id" newName="newName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameAccountRequest' => array(
                'id' => 'id',
                'newName' => 'newName',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCalendarResource()
    {
        $req = new \Zimbra\Admin\Request\RenameCalendarResource('id', 'newName');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());
        $req->id('id')
            ->newName('newName');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameCalendarResourceRequest id="id" newName="newName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameCalendarResourceRequest' => array(
                'id' => 'id',
                'newName' => 'newName',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCos()
    {
        $req = new \Zimbra\Admin\Request\RenameCos('id', 'newName');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());
        $req->id('id')
            ->newName('newName');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameCosRequest>'
                .'<id>id</id>'
                .'<newName>newName</newName>'
            .'</RenameCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameCosRequest' => array(
                'id' => 'id',
                'newName' => 'newName',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameDistributionList()
    {
        $req = new \Zimbra\Admin\Request\RenameDistributionList('id', 'newName');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());
        $req->id('id')
            ->newName('newName');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameDistributionListRequest id="id" newName="newName" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameDistributionListRequest' => array(
                'id' => 'id',
                'newName' => 'newName',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameLDAPEntry()
    {
        $req = new \Zimbra\Admin\Request\RenameLDAPEntry('dn', 'new_dn');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('dn', $req->dn());
        $this->assertEquals('new_dn', $req->new_dn());
        $req->dn('dn')
            ->new_dn('new_dn');
        $this->assertEquals('dn', $req->dn());
        $this->assertEquals('new_dn', $req->new_dn());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameLDAPEntryRequest dn="dn" new_dn="new_dn" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameLDAPEntryRequest' => array(
                'dn' => 'dn',
                'new_dn' => 'new_dn',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameUCService()
    {
        $req = new \Zimbra\Admin\Request\RenameUCService('id', 'newName');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());
        $req->id('id')
            ->newName('newName');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newName', $req->newName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RenameUCServiceRequest>'
                .'<id>id</id>'
                .'<newName>newName</newName>'
            .'</RenameUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RenameUCServiceRequest' => array(
                'id' => 'id',
                'newName' => 'newName',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testResetAllLoggers()
    {
        $req = new \Zimbra\Admin\Request\ResetAllLoggers;
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ResetAllLoggersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ResetAllLoggersRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testResumeDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');
        $req = new \Zimbra\Admin\Request\ResumeDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());
        $req->account($account)
            ->device($device);
        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ResumeDeviceRequest>'
                .'<account by="name">value</account>'
                .'<device id="id" />'
            .'</ResumeDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ResumeDeviceRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'device' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\RevokeRight($target, $grantee, $right);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame($right, $req->right());

        $req->target($target)
            ->grantee($grantee)
            ->right($right);
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame($right, $req->right());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RevokeRightRequest>'
                .'<target type="account" by="name">value</target>'
                .'<grantee type="usr" by="id" secret="secret" all="1">value</grantee>'
                .'<right deny="1" canDelegate="0" disinheritSubGroups="0" subDomain="1">value</right>'
            .'</RevokeRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RevokeRightRequest' => array(
                'target' => array(
                    'type' => 'account',
                    '_' => 'value',
                    'by' => 'name',
                ),
                'grantee' => array(
                    '_' => 'value',
                    'type' => 'usr',
                    'by' => 'id',
                    'secret' => 'secret',
                    'all' => 1,
                ),
                'right' => array(
                    'deny' => 1,
                    'canDelegate' => 0,
                    'disinheritSubGroups' => 0,
                    'subDomain' => 1,
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testRunUnitTests()
    {
        $req = new \Zimbra\Admin\Request\RunUnitTests(array('test'));
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals(array('test'), $req->test()->all());
        $req->addTest('test1');
        $this->assertEquals(array('test', 'test1'), $req->test()->all());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<RunUnitTestsRequest>'
                .'<test>test</test>'
                .'<test>test1</test>'
            .'</RunUnitTestsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'RunUnitTestsRequest' => array(
                'test' => array(
                    'test',
                    'test1',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchAccounts()
    {
        $req = new \Zimbra\Admin\Request\SearchAccounts(
            'query', 100, 100, 'domain', false, 'displayName', 'sortBy', 'resources', true 
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('query', $req->query());
        $this->assertEquals(100, $req->limit());
        $this->assertEquals(100, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertFalse($req->applyCos());
        $this->assertEquals('displayName', $req->attrs());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertEquals('resources', $req->types());
        $this->assertTrue($req->sortAscending());

        $req->query('query')
            ->limit(100)
            ->offset(100)
            ->domain('domain')
            ->applyCos(true)
            ->attrs('zimbraId')
            ->sortBy('sortBy')
            ->types('accounts')
            ->sortAscending(false);
        $this->assertEquals('query', $req->query());
        $this->assertEquals(100, $req->limit());
        $this->assertEquals(100, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertTrue($req->applyCos());
        $this->assertEquals('zimbraId', $req->attrs());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertEquals('accounts', $req->types());
        $this->assertFalse($req->sortAscending());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchAccountsRequest '
                .'query="query" '
                .'limit="100" '
                .'offset="100" '
                .'domain="domain" '
                .'applyCos="1" '
                .'attrs="zimbraId" '
                .'sortBy="sortBy" '
                .'types="accounts" '
                .'sortAscending="0" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchAccountsRequest' => array(
                'query' => 'query',
                'limit' => 100,
                'offset' => 100,
                'domain' => 'domain',
                'applyCos' => 1,
                'attrs' => 'zimbraId',
                'sortBy' => 'sortBy',
                'types' => 'accounts',
                'sortAscending' => 0,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchAutoProvDirectory()
    {
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\SearchAutoProvDirectory(
            $domain, 'keyAttr', 'query', 'name', 100, 10, 0, false, 'attrs'
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->domain());
        $this->assertEquals('keyAttr', $req->keyAttr());
        $this->assertEquals('query', $req->query());
        $this->assertEquals('name', $req->name());
        $this->assertEquals(100, $req->maxResults());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertFalse($req->refresh());
        $this->assertEquals('attrs', $req->attrs());

        $req->domain($domain)
            ->keyAttr('keyAttr')
            ->query('query')
            ->name('name')
            ->maxResults(100)
            ->limit(10)
            ->offset(0)
            ->refresh(true)
            ->attrs('attrs');
        $this->assertEquals($domain, $req->domain());
        $this->assertEquals('keyAttr', $req->keyAttr());
        $this->assertEquals('query', $req->query());
        $this->assertEquals('name', $req->name());
        $this->assertEquals(100, $req->maxResults());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertTrue($req->refresh());
        $this->assertEquals('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchAutoProvDirectoryRequest '
                .'keyAttr="keyAttr" '
                .'query="query" '
                .'name="name" '
                .'maxResults="100" '
                .'limit="10" '
                .'offset="0" '
                .'refresh="1" '
                .'attrs="attrs">'
                .'<domain by="name">value</domain>'
            .'</SearchAutoProvDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchAutoProvDirectoryRequest' => array(
                'keyAttr' => 'keyAttr',
                'query' => 'query',
                'name' => 'name',
                'maxResults' => 100,
                'limit' => 10,
                'offset' => 0,
                'refresh' => 1,
                'attrs' => 'attrs',
                'domain' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchCalendarResources()
    {
        $otherCond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('attr', CondOp::GE(), 'value', false);
        $otherConds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(0, 1, NULL, $otherCond);
        $cond = new \Zimbra\Admin\Struct\EntrySearchFilterSingleCond('a', CondOp::EQ(), 'v', true);
        $conds = new \Zimbra\Admin\Struct\EntrySearchFilterMultiCond(1, 0, $otherConds, $cond);
        $searchFilter = new \Zimbra\Admin\Struct\EntrySearchFilterInfo($conds, $cond);
        
        $req = new \Zimbra\Admin\Request\SearchCalendarResources(
            $searchFilter, 10, 0, 'domain', false, 'sortBy', true, 'attrs'
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($searchFilter, $req->searchFilter());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertFalse($req->applyCos());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertTrue($req->sortAscending());
        $this->assertEquals('attrs', $req->attrs());

        $req->searchFilter($searchFilter)
            ->limit(10)
            ->offset(0)
            ->domain('domain')
            ->applyCos(true)
            ->sortBy('sortBy')
            ->sortAscending(false)
            ->attrs('attrs');
        $this->assertEquals($searchFilter, $req->searchFilter());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertTrue($req->applyCos());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertFalse($req->sortAscending());
        $this->assertEquals('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchCalendarResourcesRequest '
                .'limit="10" '
                .'offset="0" '
                .'domain="domain" '
                .'applyCos="1" '
                .'sortBy="sortBy" '
                .'sortAscending="0" '
                .'attrs="attrs">'
                .'<searchFilter>'
                    .'<conds not="1" or="0">'
                        .'<conds not="0" or="1">'
                            .'<cond attr="attr" op="ge" value="value" not="0" />'
                        .'</conds>'
                        .'<cond attr="a" op="eq" value="v" not="1" />'
                    .'</conds>'
                    .'<cond attr="a" op="eq" value="v" not="1" />'
                .'</searchFilter>'
            .'</SearchCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchCalendarResourcesRequest' => array(
                'limit' => 10,
                'offset' => 0,
                'domain' => 'domain',
                'applyCos' => 1,
                'sortBy' => 'sortBy',
                'sortAscending' => 0,
                'attrs' => 'attrs',
                'searchFilter' => array(
                    'conds' => array(
                        'not' => 1,
                        'or' => 0,
                        'conds' => array(
                            'not' => 0,
                            'or' => 1,
                            'cond' => array(
                                'attr' => 'attr',
                                'op' => 'ge',
                                'value' => 'value',
                                'not' => 0,
                            ),
                        ),
                        'cond' => array(
                            'attr' => 'a',
                            'op' => 'eq',
                            'value' => 'v',
                            'not' => 1,
                        ),
                    ),
                    'cond' => array(
                        'attr' => 'a',
                        'op' => 'eq',
                        'value' => 'v',
                        'not' => 1,
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchDirectory()
    {
        $req = new \Zimbra\Admin\Request\SearchDirectory(
            'query', 100, 10, 0, 'domain', false, true, array(DirSearchType::RESOURCES()), 'sortBy', true, false, 'attrs'
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('query', $req->query());
        $this->assertEquals(100, $req->maxResults());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertFalse($req->applyCos());
        $this->assertTrue($req->applyConfig());
        $this->assertEquals('resources', $req->types());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertTrue($req->sortAscending());
        $this->assertFalse($req->countOnly());
        $this->assertEquals('attrs', $req->attrs());

        $req->query('query')
            ->maxResults(100)
            ->limit(10)
            ->offset(0)
            ->domain('domain')
            ->applyCos(true)
            ->applyConfig(false)
            ->addType(DirSearchType::ACCOUNTS())
            ->sortBy('sortBy')
            ->sortAscending(false)
            ->countOnly(true)
            ->attrs('attrs');
        $this->assertEquals('query', $req->query());
        $this->assertEquals(100, $req->maxResults());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals(0, $req->offset());
        $this->assertEquals('domain', $req->domain());
        $this->assertTrue($req->applyCos());
        $this->assertFalse($req->applyConfig());
        $this->assertEquals('resources,accounts', $req->types());
        $this->assertEquals('sortBy', $req->sortBy());
        $this->assertFalse($req->sortAscending());
        $this->assertTrue($req->countOnly());
        $this->assertEquals('attrs', $req->attrs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchDirectoryRequest '
                .'query="query" '
                .'maxResults="100" '
                .'limit="10" '
                .'offset="0" '
                .'domain="domain" '
                .'applyCos="1" '
                .'applyConfig="0" '
                .'types="resources,accounts" '
                .'sortBy="sortBy" '
                .'sortAscending="0" '
                .'countOnly="1" '
                .'attrs="attrs" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchDirectoryRequest' => array(
                'query' => 'query',
                'maxResults' => 100,
                'limit' => 10,
                'offset' => 0,
                'domain' => 'domain',
                'applyCos' => 1,
                'applyConfig' => 0,
                'types' => 'resources,accounts',
                'sortBy' => 'sortBy',
                'sortAscending' => 0,
                'countOnly' => 1,
                'attrs' => 'attrs',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchGal()
    {
        $req = new \Zimbra\Admin\Request\SearchGal(
            'domain', 'name', 10, GalSearchType::ALL(), 'galAcctId'
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('domain', $req->domain());
        $this->assertEquals('name', $req->name());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals('all', $req->type()->value());
        $this->assertEquals('galAcctId', $req->galAcctId());

        $req->domain('domain')
            ->name('name')
            ->limit(10)
            ->type(GalSearchType::ACCOUNT())
            ->galAcctId('galAcctId');
        $this->assertEquals('domain', $req->domain());
        $this->assertEquals('name', $req->name());
        $this->assertEquals(10, $req->limit());
        $this->assertEquals('account', $req->type()->value());
        $this->assertEquals('galAcctId', $req->galAcctId());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SearchGalRequest '
                .'domain="domain" '
                .'name="name" '
                .'limit="10" '
                .'type="account" '
                .'galAcctId="galAcctId" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SearchGalRequest' => array(
                'domain' => 'domain',
                'name' => 'name',
                'limit' => 10,
                'type' => 'account',
                'galAcctId' => 'galAcctId',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetCurrentVolume()
    {
        $req = new \Zimbra\Admin\Request\SetCurrentVolume(100, VolumeType::PRIMARY());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals(100, $req->id());
        $this->assertEquals(1, $req->type()->value());
        $req->id(100)
            ->type(VolumeType::SECONDARY());
        $this->assertEquals(100, $req->id());
        $this->assertEquals(2, $req->type()->value());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetCurrentVolumeRequest '
                .'id="100" '
                .'type="2" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetCurrentVolumeRequest' => array(
                'id' => 100,
                'type' => 2,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetPassword()
    {
        $req = new \Zimbra\Admin\Request\SetPassword('id', 'newPassword');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newPassword', $req->newPassword());
        $req->id('id')
            ->newPassword('newPassword');
        $this->assertEquals('id', $req->id());
        $this->assertEquals('newPassword', $req->newPassword());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SetPasswordRequest '
                .'id="id" '
                .'newPassword="newPassword" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SetPasswordRequest' => array(
                'id' => 'id',
                'newPassword' => 'newPassword',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSuspendDevice()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\DeviceId('id');
        $req = new \Zimbra\Admin\Request\SuspendDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());
        $req->account($account)
            ->device($device);
        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SuspendDeviceRequest>'
                .'<account by="name">value</account>'
                .'<device id="id" />'
            .'</SuspendDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SuspendDeviceRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'device' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGalAccount()
    {
        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), 'value', false, true);
        $account = new \Zimbra\Admin\Struct\SyncGalAccountSpec('id', array($ds));

        $req = new \Zimbra\Admin\Request\SyncGalAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->account());
        $req->account($account);
        $this->assertSame($account, $req->account());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<SyncGalAccountRequest>'
                .'<account id="id">'
                    .'<datasource by="name" fullSync="0" reset="1">value</datasource>'
                .'</account>'
            .'</SyncGalAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'SyncGalAccountRequest' => array(
                'account' => array(
                    'id' => 'id',
                    'datasource' => array(
                        array(
                            'by' => 'name',
                            'fullSync' => 0,
                            'reset' => 1,
                            '_' => 'value',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUndeployZimlet()
    {
        $req = new \Zimbra\Admin\Request\UndeployZimlet('name', 'action');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('name', $req->name());
        $this->assertSame('action', $req->action());
        $req->name('name')
            ->action('action');
        $this->assertSame('name', $req->name());
        $this->assertSame('action', $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UndeployZimletRequest '
                .'name="name" '
                .'action="action" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UndeployZimletRequest' => array(
                'name' => 'name',
                'action' => 'action',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdateDeviceStatus()
    {
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), 'value');
        $device = new \Zimbra\Admin\Struct\IdStatus('id', 'status');
        $req = new \Zimbra\Admin\Request\UpdateDeviceStatus($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());
        $req->account($account)
            ->device($device);
        $this->assertSame($account, $req->account());
        $this->assertSame($device, $req->device());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UpdateDeviceStatusRequest>'
                .'<account by="name">value</account>'
                .'<device id="id" status="status" />'
            .'</UpdateDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UpdateDeviceStatusRequest' => array(
                'account' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'device' => array(
                    'id' => 'id',
                    'status' => 'status',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdatePresenceSessionId()
    {
        $attr = new \Zimbra\Struct\KeyValuePair('key', 'value');
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), 'value');
        $req = new \Zimbra\Admin\Request\UpdatePresenceSessionId(
            $ucservice, 'username', 'password', array($attr)
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($ucservice, $req->ucservice());
        $this->assertSame('username', $req->username());
        $this->assertSame('password', $req->password());
        $req->ucservice($ucservice)
            ->username('username')
            ->password('password');
        $this->assertSame($ucservice, $req->ucservice());
        $this->assertSame('username', $req->username());
        $this->assertSame('password', $req->password());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UpdatePresenceSessionIdRequest>'
                .'<ucservice by="name">value</ucservice>'
                .'<username>username</username>'
                .'<password>password</password>'
                .'<a n="key">value</a>'
            .'</UpdatePresenceSessionIdRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UpdatePresenceSessionIdRequest' => array(
                'ucservice' => array(
                    'by' => 'name',
                    '_' => 'value',
                ),
                'username' => 'username',
                'password' => 'password',
                'a' => array(
                    array(
                        'n' => 'key',
                        '_' => 'value',
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadDomCert()
    {
        $req = new \Zimbra\Admin\Request\UploadDomCert(
            'certAid', 'certFilename', 'keyAid', 'keyFilename'
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('certAid', $req->certAid());
        $this->assertEquals('certFilename', $req->certFilename());
        $this->assertEquals('keyAid', $req->keyAid());
        $this->assertEquals('keyFilename', $req->keyFilename());

        $req->certAid('certAid')
            ->certFilename('certFilename')
            ->keyAid('keyAid')
            ->keyFilename('keyFilename');
        $this->assertEquals('certAid', $req->certAid());
        $this->assertEquals('certFilename', $req->certFilename());
        $this->assertEquals('keyAid', $req->keyAid());
        $this->assertEquals('keyFilename', $req->keyFilename());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UploadDomCertRequest '
                .'cert.aid="certAid" '
                .'cert.filename="certFilename" '
                .'key.aid="keyAid" '
                .'key.filename="keyFilename" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UploadDomCertRequest' => array(
                'cert.aid' => 'certAid',
                'cert.filename' => 'certFilename',
                'key.aid' => 'keyAid',
                'key.filename' => 'keyFilename',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadProxyCA()
    {
        $req = new \Zimbra\Admin\Request\UploadProxyCA('certAid', 'certFilename');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('certAid', $req->certAid());
        $this->assertEquals('certFilename', $req->certFilename());

        $req->certAid('certAid')
            ->certFilename('certFilename');
        $this->assertEquals('certAid', $req->certAid());
        $this->assertEquals('certFilename', $req->certFilename());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<UploadProxyCARequest '
                .'cert.aid="certAid" '
                .'cert.filename="certFilename" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'UploadProxyCARequest' => array(
                'cert.aid' => 'certAid',
                'cert.filename' => 'certFilename',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyCertKey()
    {
        $req = new \Zimbra\Admin\Request\VerifyCertKey('cert', 'privkey');
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('cert', $req->cert());
        $this->assertEquals('privkey', $req->privkey());

        $req->cert('cert')
            ->privkey('privkey');
        $this->assertEquals('cert', $req->cert());
        $this->assertEquals('privkey', $req->privkey());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VerifyCertKeyRequest '
                .'cert="cert" '
                .'privkey="privkey" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VerifyCertKeyRequest' => array(
                'cert' => 'cert',
                'privkey' => 'privkey',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyIndex()
    {
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\Admin\Request\VerifyIndex($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->mbox());

        $req->mbox($mbox);
        $this->assertSame($mbox, $req->mbox());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VerifyIndexRequest>'
                .'<mbox id="id" />'
            .'</VerifyIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VerifyIndexRequest' => array(
                'mbox' => array(
                    'id' => 'id',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyStoreManager()
    {
        $req = new \Zimbra\Admin\Request\VerifyStoreManager(100, 100, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals(100, $req->fileSize());
        $this->assertEquals(100, $req->num());
        $this->assertFalse($req->checkBlobs());

        $req->fileSize(100)
            ->num(100)
            ->checkBlobs(true);
        $this->assertEquals(100, $req->fileSize());
        $this->assertEquals(100, $req->num());
        $this->assertTrue($req->checkBlobs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VerifyStoreManagerRequest '
                .'fileSize="100" '
                .'num="100" '
                .'checkBlobs="1" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VerifyStoreManagerRequest' => array(
                'fileSize' => 100,
                'num' => 100,
                'checkBlobs' => 1,
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testVersionCheck()
    {
        $req = new \Zimbra\Admin\Request\VersionCheck(VersionCheckAction::STATUS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('status', $req->action());
        $req->action(VersionCheckAction::CHECK());
        $this->assertEquals('check', $req->action());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<VersionCheckRequest '
                .'action="check" '
            .'/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'VersionCheckRequest' => array(
                'action' => 'check',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }
}
