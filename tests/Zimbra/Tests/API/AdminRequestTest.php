<?php

namespace Zimbra\Tests\API;

use Zimbra\Tests\ZimbraTestCase;
use Zimbra\Utils\SimpleXML;

/**
 * Testcase class for admin api soap request.
 */
class AdminRequestTest extends ZimbraTestCase
{
    public function testAddAccountAlias()
    {
        $req = new \Zimbra\API\Admin\Request\AddAccountAlias('i', 'a');
        $this->assertSame('i', $req->id());
        $this->assertSame('a', $req->alias());

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
        $logger = new \Zimbra\Soap\Struct\LoggerInfo('category', 'error');
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\AddAccountLogger($logger, $account);

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
        $req = new \Zimbra\API\Admin\Request\AddDistributionListAlias('i', 'a');
        $this->assertSame('i', $req->id());
        $this->assertSame('a', $req->alias());

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
        $req = new \Zimbra\API\Admin\Request\AddDistributionListMember('i', array('dlm'));
        $this->assertSame('i', $req->id());
        $this->assertSame(array('dlm'), $req->dlms());

        $req->id('id')
            ->dlms(array('member'));
        $this->assertSame('id', $req->id());
        $this->assertSame(array('member'), $req->dlms());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AddDistributionListMemberRequest id="id">'
                .'<dlm>member</dlm>'
            .'</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AddDistributionListMemberRequest' => array(
                'id' => 'id',
                'dlm' => array(
                    'member',
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddGalSyncDataSource()
    {
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\AddGalSyncDataSource($account, 'name', 'domain', 'both', 'folder', array($attr));

        $this->assertSame($account, $req->account());
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('both', $req->type());
        $this->assertSame('folder', $req->folder());

        $req->account($account)
            ->name('name')
            ->domain('domain')
            ->type('zimbra')
            ->folder('folder');
        $this->assertSame($account, $req->account());
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('zimbra', $req->type());
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
                )
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminCreateWaitSet()
    {
        $waitSet = new \Zimbra\Soap\Struct\WaitSetAddSpec('name', 'id', 'token', 'f,m,c');
        $req = new \Zimbra\API\Admin\Request\AdminCreateWaitSet('all', false, array($waitSet));
        $this->assertSame('all', $req->defTypes());
        $this->assertFalse($req->allAccounts());
        $this->assertSame(array($waitSet), $req->addWaitSets());

        $req->defTypes('f,m,c')
            ->allAccounts(true)
            ->addWaitSets(array($waitSet))
            ->addSpec($waitSet);
        $this->assertSame('f,m,c', $req->defTypes());
        $this->assertTrue($req->allAccounts());
        $this->assertSame(array($waitSet, $waitSet), $req->addWaitSets());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AdminCreateWaitSetRequest defTypes="f,m,c" allAccounts="1">'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                .'</add>'
            .'</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'AdminCreateWaitSetRequest' => array(
                'defTypes' => 'f,m,c',
                'allAccounts' => 1,
                'add' => array(
                    'a' => array(
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f,m,c',
                        ),
                        array(
                            'name' => 'name',
                            'id' => 'id',
                            'token' => 'token',
                            'types' => 'f,m,c',
                        ),
                    ),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminDestroyWaitSet()
    {
        $req = new \Zimbra\API\Admin\Request\AdminDestroyWaitSet('waitSet');
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
        $add = new \Zimbra\Soap\Struct\WaitSetAddSpec('name', 'id', 'token', 'f,m,c');
        $update = new \Zimbra\Soap\Struct\WaitSetAddSpec('name', 'id', 'token', 'f,m,c');
        $remove = new \Zimbra\Soap\Struct\Id('id');
        $req = new \Zimbra\API\Admin\Request\AdminWaitSet('waitSet', 'seq', false, 'all', 1000, array($add), array($update), array($remove));

        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertFalse($req->block());
        $this->assertSame('all', $req->defTypes());
        $this->assertSame(1000, $req->timeout());
        $this->assertSame(array($add), $req->addWaitSets());
        $this->assertSame(array($update), $req->updateWaitSets());
        $this->assertSame(array($remove), $req->removeWaitSets());

        $req->waitSet('waitSet')
            ->seq('seq')
            ->block(true)
            ->defTypes('f,m,c')
            ->timeout(1000)
            ->addWaitSets(array($add))
            ->addWaitSet($add)
            ->updateWaitSets(array($update))
            ->addUpdate($update)
            ->removeWaitSets(array($remove))
            ->addRemove($remove);
        $this->assertSame('waitSet', $req->waitSet());
        $this->assertSame('seq', $req->seq());
        $this->assertTrue($req->block());
        $this->assertSame('f,m,c', $req->defTypes());
        $this->assertSame(1000, $req->timeout());
        $this->assertSame(array($add, $add), $req->addWaitSets());
        $this->assertSame(array($update, $update), $req->updateWaitSets());
        $this->assertSame(array($remove, $remove), $req->removeWaitSets());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<AdminWaitSetRequest waitSet="waitSet" seq="seq" block="1" defTypes="f,m,c" timeout="1000" >'
                .'<add>'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                .'</add>'
                .'<update>'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                    .'<a name="name" id="id" token="token" types="f,m,c" />'
                .'</update>'
                .'<remove>'
                    .'<a id="id" />'
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\Auth('name', 'password', 'authToken', $account, 'virtualHost', false);

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
        $req = new \Zimbra\API\Admin\Request\AutoCompleteGal('domain', 'name', 'all', 'galAcctId', 100);
        $this->assertSame('domain', $req->domain());
        $this->assertSame('name', $req->name());
        $this->assertSame('all', $req->type());
        $this->assertSame('galAcctId', $req->galAcctId());
        $this->assertSame(100, $req->limit());

        $req->domain('domain')
            ->name('name')
            ->type('account')
            ->galAcctId('galAcctId')
            ->limit(100);
        $this->assertSame('domain', $req->domain());
        $this->assertSame('name', $req->name());
        $this->assertSame('account', $req->type());
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');
        $principal = new \Zimbra\Soap\Struct\PrincipalSelector('dn', 'principal');
        $req = new \Zimbra\API\Admin\Request\AutoProvAccount($domain, $principal, 'password');

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
        $req = new \Zimbra\API\Admin\Request\AutoProvTaskControl('start');
        $this->assertSame('start', $req->action());

        $req->action('status');
        $this->assertSame('status', $req->action());

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

    public function testCheckAuthConfig()
    {
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CheckAuthConfig('name', 'password', array($attr));
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
        $volume = new \Zimbra\Soap\Struct\IntIdAttr(1);
        $mbox = new \Zimbra\Soap\Struct\IntIdAttr(1);

        $req = new \Zimbra\API\Admin\Request\CheckBlobConsistency(array($volume), array($mbox), true, false);
        $this->assertSame(array($volume), $req->volumes());
        $this->assertSame(array($mbox), $req->mboxes());
        $this->assertTrue($req->checkSize());
        $this->assertFalse($req->reportUsedBlobs());

        $req->volumes(array($volume))
            ->addVolume($volume)
            ->mboxes(array($mbox))
            ->addMbox($mbox)
            ->checkSize(false)
            ->reportUsedBlobs(true);
        $this->assertSame(array($volume, $volume), $req->volumes());
        $this->assertSame(array($mbox, $mbox), $req->mboxes());
        $this->assertFalse($req->checkSize());
        $this->assertTrue($req->reportUsedBlobs());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckBlobConsistencyRequest checkSize="0" reportUsedBlobs="1">'
                .'<volume id="1" />'
                .'<volume id="1" />'
                .'<mbox id="1" />'
                .'<mbox id="1" />'
            .'</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'CheckBlobConsistencyRequest' => array(
                'checkSize' => 0,
                'reportUsedBlobs' => 1,
                'volume' => array(
                    array('id' => 1),
                    array('id' => 1),
                ),
                'mbox' => array(
                    array('id' => 1),
                    array('id' => 1),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDirectory()
    {
        $dir = new \Zimbra\Soap\Struct\CheckDirSelector('path', true);
        $req = new \Zimbra\API\Admin\Request\CheckDirectory(array($dir));
        $this->assertSame(array($dir), $req->directories());

        $req->directories(array($dir))
            ->addDirectory($dir);
        $this->assertSame(array($dir, $dir), $req->directories());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CheckDirectoryRequest>'
                .'<directory path="path" create="1" />'
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\CheckDomainMXRecord($domain);
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
        $auth = new \Zimbra\Soap\Struct\ExchangeAuthSpec('url', 'user', 'pass', 'form', 'type');
        $req = new \Zimbra\API\Admin\Request\CheckExchangeAuth($auth);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $query = new \Zimbra\Soap\Struct\LimitedQuery(100, 'value');

        $req = new \Zimbra\API\Admin\Request\CheckGalConfig($query, 'autocomplete', array($attr));
        $this->assertSame($query, $req->query());
        $this->assertSame('autocomplete', $req->action());

        $req->query($query)
            ->action('search');
        $this->assertSame($query, $req->query());
        $this->assertSame('search', $req->action());

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
        $req = new \Zimbra\API\Admin\Request\CheckHealth();

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
        $req = new \Zimbra\API\Admin\Request\CheckHostnameResolve('hostname');
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
        $req = new \Zimbra\API\Admin\Request\CheckPasswordStrength('id', 'password');
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $target = new \Zimbra\Soap\Struct\EffectiveRightsTargetSelector('account', 'value' ,'name');
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector('value', 'usr', 'id', 'secret', true);

        $req = new \Zimbra\API\Admin\Request\CheckRight($target, $grantee, 'right', array($attr));
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
        $cookie = new \Zimbra\Soap\Struct\CookieSpec('name');
        $req = new \Zimbra\API\Admin\Request\ClearCookie(array($cookie));
        $this->assertSame(array($cookie), $req->cookies());

        $req->cookies(array($cookie))
            ->addCookie($cookie);
        $this->assertSame(array($cookie, $cookie), $req->cookies());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<ClearCookieRequest>'
                .'<cookie name="name" />'
                .'<cookie name="name" />'
            .'</ClearCookieRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'ClearCookieRequest' => array(
                'cookie' => array(
                    array('name' => 'name'),
                    array('name' => 'name'),
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompactIndex()
    {
        $mbox = new \Zimbra\Soap\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\API\Admin\Request\CompactIndex($mbox, 'start');
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('start', $req->action());

        $req->mbox($mbox)
            ->action('status');
        $this->assertSame($mbox, $req->mbox());
        $this->assertSame('status', $req->action());

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
        $req = new \Zimbra\API\Admin\Request\ComputeAggregateQuotaUsage();

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
        $content = new \Zimbra\Soap\Struct\AttachmentIdAttrib('aid');
        $req = new \Zimbra\API\Admin\Request\ConfigureZimlet($content);
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
        $cos = new \Zimbra\Soap\Struct\CosSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\CopyCos('name', $cos);
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\CountAccount($domain);
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');
        $ucservice = new \Zimbra\Soap\Struct\UcServiceSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\CountObjects('userAccount', $domain, $ucservice);
        $this->assertSame('userAccount', $req->type());
        $this->assertSame($domain, $req->domain());
        $this->assertSame($ucservice, $req->ucservice());

        $req->type('account')
            ->domain($domain)
            ->ucservice($ucservice);
        $this->assertSame('account', $req->type());
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateAccount('name', 'password', array($attr));

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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateCalendarResource('name', 'password', array($attr));

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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateCos('name', array($attr));
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateCosRequest name="name">'
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Soap\Struct\DataSourceSpecifier('pop3', 'name', array($attr));

        $req = new \Zimbra\API\Admin\Request\CreateDataSource('id', $dataSource);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateDistributionList('name', false, array($attr));

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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateDomain('name', array($attr));
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\CreateGalSyncAccount(
            'name', 'domain', 'both', 'server', $account, 'password', 'folder', array($attr)
        );
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('both', $req->type());
        $this->assertSame('server', $req->server());
        $this->assertSame($account, $req->account());
        $this->assertSame('password', $req->password());
        $this->assertSame('folder', $req->folder());

        $req->name('name')
            ->domain('domain')
            ->type('ldap')
            ->server('server')
            ->account($account)
            ->password('password')
            ->folder('folder');
        $this->assertSame('name', $req->name());
        $this->assertSame('domain', $req->domain());
        $this->assertSame('ldap', $req->type());
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateLDAPEntry('dn', array($attr));
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateServer('name', array($attr));
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
        $cos = new \Zimbra\Soap\Struct\CosSelector('name', 'value');
        $keep = new \Zimbra\Soap\Struct\Policy('system', 'id', 'name', 'lifetime');
        $purge = new \Zimbra\Soap\Struct\Policy('user', 'id', 'name', 'lifetime');

        $req = new \Zimbra\API\Admin\Request\CreateSystemRetentionPolicy($cos, $keep, $purge);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateUCService('name', array($attr));
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
        $volume = new \Zimbra\Soap\Struct\VolumeInfo(1, 2, 3, 4, 5, 6, 7, 'name', 'rootpath', false, true);
        $req = new \Zimbra\API\Admin\Request\CreateVolume($volume);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'domain');
        $server = new \Zimbra\Soap\Struct\ServerSelector('name', 'server');
        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSpec('name', $domain, $server, array($attr));

        $req = new \Zimbra\API\Admin\Request\CreateXMPPComponent($xmpp);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\CreateZimlet('name', array($attr));
        $this->assertSame('name', $req->name());

        $req->name('name');
        $this->assertSame('name', $req->name());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<CreateZimletRequest>'
                .'<name>name</name>'
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
        $volume = new \Zimbra\Soap\Struct\IntIdAttr(1);
        $req = new \Zimbra\API\Admin\Request\DedupeBlobs('start', array($volume));
        $this->assertSame('start', $req->action());
        $this->assertSame(array($volume), $req->volumes());

        $req->action('status')
            ->volumes(array($volume))
            ->addVolume($volume);
        $this->assertSame('status', $req->action());
        $this->assertSame(array($volume, $volume), $req->volumes());

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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\DelegateAuth($account, 1000);
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
        $req = new \Zimbra\API\Admin\Request\DeleteAccount('id');
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
        $req = new \Zimbra\API\Admin\Request\DeleteCalendarResource('id');
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
        $req = new \Zimbra\API\Admin\Request\DeleteCos('id');
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $dataSource = new \Zimbra\Soap\Struct\Id('id');

        $req = new \Zimbra\API\Admin\Request\DeleteDataSource('id', $dataSource, array($attr));
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
        $req = new \Zimbra\API\Admin\Request\DeleteDistributionList('id');
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
        $req = new \Zimbra\API\Admin\Request\DeleteDomain('id');
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\DeleteGalSyncAccount($account);
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
        $req = new \Zimbra\API\Admin\Request\DeleteLDAPEntry('dn');
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
        $mbox = new \Zimbra\Soap\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\API\Admin\Request\DeleteMailbox($mbox);
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
        $req = new \Zimbra\API\Admin\Request\DeleteServer('id');
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
        $cos = new \Zimbra\Soap\Struct\CosSelector('name', 'value');
        $policy = new \Zimbra\Soap\Struct\Policy('system', 'id', 'name', 'lifetime');

        $req = new \Zimbra\API\Admin\Request\DeleteSystemRetentionPolicy($policy, $cos);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $req->policy($policy)
            ->cos($cos);
        $this->assertSame($policy, $req->policy());
        $this->assertSame($cos, $req->cos());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<DeleteSystemRetentionPolicyRequest>'
                .'<policy type="system" id="id" name="name" lifetime="lifetime" />'
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
        $req = new \Zimbra\API\Admin\Request\DeleteUCService('id');
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
        $req = new \Zimbra\API\Admin\Request\DeleteVolume(100);
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
        $xmpp = new \Zimbra\Soap\Struct\XmppComponentSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\DeleteXMPPComponent($xmpp);
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
        $zimlet = new \Zimbra\Soap\Struct\NamedElement('name');
        $req = new \Zimbra\API\Admin\Request\DeleteZimlet($zimlet);
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
        $content = new \Zimbra\Soap\Struct\AttachmentIdAttrib('aid');
        $req = new \Zimbra\API\Admin\Request\DeployZimlet('deployAll', $content, false, true);
        $this->assertSame('deployAll', $req->action());
        $this->assertSame($content, $req->content());
        $this->assertFalse($req->flush());
        $this->assertTrue($req->synchronous());

        $req->action('deployLocal')
            ->content($content)
            ->flush(true)
            ->synchronous(false);
        $this->assertSame('deployLocal', $req->action());
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
        $req = new \Zimbra\API\Admin\Request\DumpSessions(false, true);
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
        $item = new \Zimbra\Soap\Struct\ExportAndDeleteItemSpec(1, 2);
        $mbox = new \Zimbra\Soap\Struct\ExportAndDeleteMailboxSpec(1, array($item));

        $req = new \Zimbra\API\Admin\Request\ExportAndDeleteItems($mbox, 'exportDir', 'exportFilenamePrefix');
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
        $account = new \Zimbra\Soap\Struct\NamedElement('name');

        $req = new \Zimbra\API\Admin\Request\FixCalendarEndTime(false, array($account));
        $this->assertFalse($req->sync());
        $this->assertSame(array($account), $req->accounts());

        $req->sync(true)
            ->accounts(array($account))
            ->addAccount($account);
        $this->assertTrue($req->sync());
        $this->assertSame(array($account, $account), $req->accounts());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarEndTimeRequest sync="1">'
                .'<account name="name" />'
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
        $account = new \Zimbra\Soap\Struct\NamedElement('name');

        $req = new \Zimbra\API\Admin\Request\FixCalendarPriority(false, array($account));
        $this->assertFalse($req->sync());
        $this->assertSame(array($account), $req->accounts());

        $req->sync(true)
            ->accounts(array($account))
            ->addAccount($account);
        $this->assertTrue($req->sync());
        $this->assertSame(array($account, $account), $req->accounts());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarPriorityRequest sync="1">'
                .'<account name="name" />'
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
        $any = new \Zimbra\Soap\Struct\SimpleElement;
        $tzid = new \Zimbra\Soap\Struct\Id('id');
        $nonDst = new \Zimbra\Soap\Struct\Offset(100);
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(1, 2, 3);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchRule(3, 2, 1);
        $rules = new \Zimbra\Soap\Struct\TZFixupRuleMatchRules(1, 1, $standard, $daylight);
        $standard = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(1, 1);
        $daylight = new \Zimbra\Soap\Struct\TZFixupRuleMatchDate(2, 2);
        $dates = new \Zimbra\Soap\Struct\TZFixupRuleMatchDates(1, 1, $standard, $daylight);
        $match = new \Zimbra\Soap\Struct\TZFixupRuleMatch($any, $tzid, $nonDst, $rules, $dates);

        $wellKnownTz = new \Zimbra\Soap\Struct\Id('id');
        $standard = new \Zimbra\Soap\Struct\TzOnsetInfo(1, 2, 3, 4);
        $daylight = new \Zimbra\Soap\Struct\TzOnsetInfo(4, 3, 2, 1);
        $tz = new \Zimbra\Soap\Struct\CalTZInfo('id', 1, 1, 'stdname', 'dayname', $standard, $daylight);
        $replace = new \Zimbra\Soap\Struct\TZReplaceInfo($wellKnownTz, $tz);
        
        $touch = new \Zimbra\Soap\Struct\SimpleElement;
        $fixupRule = new \Zimbra\Soap\Struct\TZFixupRule($match, $touch, $replace);

        $account = new \Zimbra\Soap\Struct\NamedElement('name');
        $req = new \Zimbra\API\Admin\Request\FixCalendarTZ(false, 1000, array($account), array($fixupRule));
        $this->assertFalse($req->sync());
        $this->assertSame(1000, $req->after());
        $this->assertSame(array($account), $req->accounts());
        $this->assertSame(array($fixupRule), $req->fixupRules());

        $req->sync(true)
            ->after(1000)
            ->accounts(array($account))
            ->addAccount($account)
            ->fixupRules(array($fixupRule))
            ->addFixupRule($fixupRule);
        $this->assertTrue($req->sync());
        $this->assertSame(1000, $req->after());
        $this->assertSame(array($account, $account), $req->accounts());
        $this->assertSame(array($fixupRule, $fixupRule), $req->fixupRules());

        $req->sync(true)
            ->after(1000)
            ->accounts(array($account))
            ->fixupRules(array($fixupRule));

        $xml = '<?xml version="1.0"?>'."\n"
            .'<FixCalendarTZRequest sync="1" after="1000">'
                .'<account name="name" />'
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
        $entry = new \Zimbra\Soap\Struct\CacheEntrySelector('name', 'value');
        $cache = new \Zimbra\Soap\Struct\CacheSelector('skin,account', true, array($entry));

        $req = new \Zimbra\API\Admin\Request\FlushCache($cache);
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
}
