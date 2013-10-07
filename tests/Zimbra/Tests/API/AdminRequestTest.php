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

    public function testGenCSR()
    {
        $req = new \Zimbra\API\Admin\Request\GenCSR(
            'server', false, 'self', 1024, 'c', 'sT', 'l', 'o', 'oU', 'cN', array('subject')
        );
        $this->assertSame('server', $req->server());
        $this->assertFalse($req->isNew());
        $this->assertSame('self', $req->type());
        $this->assertSame(1024, $req->keysize());
        $this->assertSame('c', $req->c());
        $this->assertSame('sT', $req->sT());
        $this->assertSame('l', $req->l());
        $this->assertSame('o', $req->o());
        $this->assertSame('oU', $req->oU());
        $this->assertSame('cN', $req->cN());
        $this->assertSame(array('subject'), $req->subjectAltName());

        $req->server('server')
            ->isNew(true)
            ->type('comm')
            ->keysize(2048)
            ->c('c')
            ->sT('st')
            ->l('l')
            ->o('o')
            ->oU('ou')
            ->cN('cn')
            ->subjectAltName(array('subject'));
        $this->assertSame('server', $req->server());
        $this->assertTrue($req->isNew());
        $this->assertSame('comm', $req->type());
        $this->assertSame(2048, $req->keysize());
        $this->assertSame('c', $req->c());
        $this->assertSame('st', $req->sT());
        $this->assertSame('l', $req->l());
        $this->assertSame('o', $req->o());
        $this->assertSame('ou', $req->oU());
        $this->assertSame('cn', $req->cN());
        $this->assertSame(array('subject'), $req->subjectAltName());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GenCSRRequest server="server" new="1" type="comm" keysize="2048">'
                .'<C>c</C>'
                .'<ST>st</ST>'
                .'<L>l</L>'
                .'<O>o</O>'
                .'<OU>ou</OU>'
                .'<CN>cn</CN>'
                .'<SubjectAltName>subject</SubjectAltName>'
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
                    'subject'
                ),
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccount()
    {
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetAccount($account, false, 'attrs');
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetAccountInfo($account);
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetAccountLoggers($account);
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetAccountMembership($account);
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\GetAdminConsoleUIComp($account, $dl);
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
        $req = new \Zimbra\API\Admin\Request\GetAdminExtensionZimlets();

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
        $search = new \Zimbra\Soap\Struct\NamedElement('name');
        $req = new \Zimbra\API\Admin\Request\GetAdminSavedSearches($search);
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
        $req = new \Zimbra\API\Admin\Request\GetAggregateQuotaUsageOnServer();

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
        $req = new \Zimbra\API\Admin\Request\GetAllAccountLoggers();

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
        $server = new \Zimbra\Soap\Struct\ServerSelector('name', 'value');
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\GetAllAccounts($server, $domain);
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
        $req = new \Zimbra\API\Admin\Request\GetAllAdminAccounts(false);
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
        $server = new \Zimbra\Soap\Struct\ServerSelector('name', 'value');
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\GetAllCalendarResources($server, $domain);
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
        $req = new \Zimbra\API\Admin\Request\GetAllConfig();

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
        $req = new \Zimbra\API\Admin\Request\GetAllCos();

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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\GetAllDistributionLists($domain);
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
        $req = new \Zimbra\API\Admin\Request\GetAllDomains(false);
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
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector('value', 'usr', 'id', 'secret', true);

        $req = new \Zimbra\API\Admin\Request\GetAllEffectiveRights($grantee, false);
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
        $req = new \Zimbra\API\Admin\Request\GetAllFreeBusyProviders();

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
        $req = new \Zimbra\API\Admin\Request\GetAllLocales();

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
        $req = new \Zimbra\API\Admin\Request\GetAllMailboxes(100, 100);
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
        $req = new \Zimbra\API\Admin\Request\GetAllRights('targetType', false, 'ADMIN');
        $this->assertSame('targetType', $req->targetType());
        $this->assertFalse($req->expandAllAttrs());
        $this->assertSame('ADMIN', $req->rightClass());

        $req->targetType('targetType')
            ->expandAllAttrs(true)
            ->rightClass('ALL');
        $this->assertSame('targetType', $req->targetType());
        $this->assertTrue($req->expandAllAttrs());
        $this->assertSame('ALL', $req->rightClass());

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
        $req = new \Zimbra\API\Admin\Request\GetAllServers('service', false);
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
        $req = new \Zimbra\API\Admin\Request\GetAllSkins();

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
        $req = new \Zimbra\API\Admin\Request\GetAllUCProviders();

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
        $req = new \Zimbra\API\Admin\Request\GetAllUCServices();

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
        $req = new \Zimbra\API\Admin\Request\GetAllVolumes();

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
        $req = new \Zimbra\API\Admin\Request\GetAllXMPPComponents();

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
        $req = new \Zimbra\API\Admin\Request\GetAllZimlets('extension');
        $this->assertSame('extension', $req->exclude());

        $req->exclude('mail');
        $this->assertSame('mail', $req->exclude());

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
        $req = new \Zimbra\API\Admin\Request\GetAttributeInfo('attrs', 'a,account,b,aclTarget,c');
        $this->assertSame('attrs', $req->attrs());
        $this->assertSame('account,aclTarget', $req->entryTypes());

        $req->attrs('attrs')
            ->entryTypes('x,account,y,alias,z');
        $this->assertSame('attrs', $req->attrs());
        $this->assertSame('account,alias', $req->entryTypes());

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetAttributeInfoRequest attrs="attrs" entryTypes="account,alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetAttributeInfoRequest' => array(
                'attrs' => 'attrs',
                'entryTypes' => 'account,alias',
            ),
        );
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarResource()
    {
        $calResource = new \Zimbra\Soap\Struct\CalendarResourceSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetCalendarResource($calResource, false, 'attrs');
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
        $req = new \Zimbra\API\Admin\Request\GetCert('server', 'all', 'self');
        $this->assertSame('server', $req->server());
        $this->assertSame('all', $req->type());
        $this->assertSame('self', $req->option());

        $req->server('server')
            ->type('mta')
            ->option('comm');
        $this->assertSame('server', $req->server());
        $this->assertSame('mta', $req->type());
        $this->assertSame('comm', $req->option());

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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\GetConfig(array($attr));

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
        $cos = new \Zimbra\Soap\Struct\CosSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetCos($cos, 'attrs');
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
        $target = new \Zimbra\Soap\Struct\TargetWithType('type', 'value');
        $cos = new \Zimbra\Soap\Struct\CosSelector('name', 'value');
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');

        $req = new \Zimbra\API\Admin\Request\GetCreateObjectAttrs($target, $domain, $cos);
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
        $req = new \Zimbra\API\Admin\Request\GetCSR('server', 'self');
        $this->assertSame('server', $req->server());
        $this->assertSame('self', $req->type());

        $req->server('server')
            ->type('comm');
        $this->assertSame('server', $req->server());
        $this->assertSame('comm', $req->type());

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
        $req = new \Zimbra\API\Admin\Request\GetCurrentVolumes();

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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDataSources('id', array($attr));
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
        $attr = new \Zimbra\Soap\Struct\NamedElement('name');

        $req = new \Zimbra\API\Admin\Request\GetDelegatedAdminConstraints('type', 'id', 'name', array($attr));
        $this->assertSame('type', $req->type());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr), $req->attrs());

        $req->type('type')
            ->id('id')
            ->name('name')
            ->attrs(array($attr))
            ->addAttr($attr);
        $this->assertSame('type', $req->type());
        $this->assertSame('id', $req->id());
        $this->assertSame('name', $req->name());
        $this->assertSame(array($attr, $attr), $req->attrs());

        $req->attrs(array($attr));
        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetDelegatedAdminConstraintsRequest type="type" id="id" name="name">'
                .'<a name="name" />'
            .'</GetDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetDelegatedAdminConstraintsRequest' => array(
                'type' => 'type',
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
        $account = new \Zimbra\Soap\Struct\AccountSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDevices($account);
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
        $attr = new \Zimbra\Soap\Struct\KeyValuePair('key', 'value');
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDistributionList($dl, 100, 100, false, array($attr));
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
        $dl = new \Zimbra\Soap\Struct\DistributionListSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDistributionListMembership($dl, 100, 100);
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDomain($domain, false, 'attrs');
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
        $domain = new \Zimbra\Soap\Struct\DomainSelector('name', 'value');
        $req = new \Zimbra\API\Admin\Request\GetDomainInfo($domain, false);
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
        $target = new \Zimbra\Soap\Struct\EffectiveRightsTargetSelector('account', 'value', 'name');
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector('value', 'usr', 'id', 'secret', true);

        $req = new \Zimbra\API\Admin\Request\GetEffectiveRights($target, $grantee, 'getAttrs');
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('getAttrs', $req->expandAllAttrs());

        $req->target($target)
            ->grantee($grantee)
            ->expandAllAttrs('setAttrs');
        $this->assertSame($target, $req->target());
        $this->assertSame($grantee, $req->grantee());
        $this->assertSame('setAttrs', $req->expandAllAttrs());

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
        $provider = new \Zimbra\Soap\Struct\NamedElement('name');
        $req = new \Zimbra\API\Admin\Request\GetFreeBusyQueueInfo($provider);
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
        $target = new \Zimbra\Soap\Struct\EffectiveRightsTargetSelector('account', 'value', 'name');
        $grantee = new \Zimbra\Soap\Struct\GranteeSelector('value', 'usr', 'id', 'secret', true);

        $req = new \Zimbra\API\Admin\Request\GetGrants($target, $grantee);
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
        $mbox = new \Zimbra\Soap\Struct\MailboxByAccountIdSelector('id');
        $req = new \Zimbra\API\Admin\Request\GetIndexStats($mbox);
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
        $req = new \Zimbra\API\Admin\Request\GetLDAPEntries(
            'query', 'ldapSearchBase', 'sortBy', false, 100, 100
        );
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
        $req = new \Zimbra\API\Admin\Request\GetLicenseInfo();

        $xml = '<?xml version="1.0"?>'."\n"
            .'<GetLicenseInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = array(
            'GetLicenseInfoRequest' => array(),
        );
        $this->assertEquals($array, $req->toArray());
    }
}
