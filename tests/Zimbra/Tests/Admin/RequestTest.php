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
        $id = self::randomName();
        $alias = self::randomName();

        $req = new \Zimbra\Admin\Request\AddAccountAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddAccountAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddAccountLogger()
    {
        $category = self::randomName();
        $value = self::randomName();

        $logger = new \Zimbra\Admin\Struct\LoggerInfo($category, LoggingLevel::ERROR());
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\AddAccountLogger($logger, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $req->setLogger($logger)
             ->setAccount($account);
        $this->assertSame($logger, $req->getLogger());
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddAccountLoggerRequest>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</AddAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddAccountLoggerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'logger' => [
                    'category' => $category,
                    'level' => LoggingLevel::ERROR()->value(),
                ],
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListAlias()
    {
        $id = self::randomName();
        $alias = self::randomName();

        $req = new \Zimbra\Admin\Request\AddDistributionListAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $req->setId($id)
            ->setAlias($alias);
        $this->assertSame($id, $req->getId());
        $this->assertSame($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddDistributionListAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAddDistributionListMember()
    {
        $id = self::randomName();
        $member1 = self::randomName();
        $member2 = self::randomName();

        $req = new \Zimbra\Admin\Request\AddDistributionListMember($id, [$member1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1], $req->getMembers()->all());

        $req->setId($id)
            ->addMember($member2);
        $this->assertSame($id, $req->getId());
        $this->assertSame([$member1, $member2], $req->getMembers()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</AddDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddDistributionListMemberRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dlm' => [
                    $member1,
                    $member2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $req = new \Zimbra\Admin\Request\AddGalSyncDataSource(
            $account, $name, $domain, GalMode::BOTH(), $folder, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getType()->is('both'));
        $this->assertSame($folder, $req->getFolder());

        $req->setAccount($account)
            ->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::ZIMBRA())
            ->setFolder($folder);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getType()->is('zimbra'));
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AddGalSyncDataSourceRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::ZIMBRA() . '" folder="' . $folder . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</AddGalSyncDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AddGalSyncDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'domain' => $domain,
                'type' => GalMode::ZIMBRA()->value(),
                'folder' => $folder,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $req = new \Zimbra\Admin\Request\AdminCreateWaitSet(
            $add, [InterestType::FOLDERS()], false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertSame($add, $req->getAccounts());
        $this->assertFalse($req->getAllAccounts());

        $req->addDefaultInterest(InterestType::MESSAGES())
            ->setAccounts($add)
            ->setAllAccounts(true);
        $this->assertSame('f,m', $req->getDefaultInterests());
        $this->assertSame($add, $req->getAccounts());
        $this->assertTrue($req->getAllAccounts());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminCreateWaitSetRequest defTypes="f,m" allAccounts="true">'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="m,c" />'
                . '</add>'
            . '</AdminCreateWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminCreateWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'defTypes' => 'f,m',
                'allAccounts' => true,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'm,c',
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAdminDestroyWaitSet()
    {
        $waitSet = self::randomName();

        $req = new \Zimbra\Admin\Request\AdminDestroyWaitSet($waitSet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $req->setWaitSetId($waitSet);
        $this->assertSame($waitSet, $req->getWaitSetId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminDestroyWaitSetRequest waitSet="' . $waitSet . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminDestroyWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\AdminWaitSet(
            $waitSet, $seq, $add, $update, $remove, false, [InterestType::FOLDERS()], $timeout
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertFalse($req->getBlock());
        $this->assertSame('f', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $req->setWaitSetId($waitSet)
            ->setLastKnownSeqNo($seq)
            ->setBlock(true)
            ->setAddAccounts($add)
            ->setUpdateAccounts($update)
            ->setRemoveAccounts($remove)
            ->addDefaultInterest(InterestType::MESSAGES())
            ->addDefaultInterest(InterestType::CONTACTS())
            ->setTimeout($timeout);
        $this->assertSame($waitSet, $req->getWaitSetId());
        $this->assertSame($seq, $req->getLastKnownSeqNo());
        $this->assertSame($add, $req->getAddAccounts());
        $this->assertSame($update, $req->getUpdateAccounts());
        $this->assertSame($remove, $req->getRemoveAccounts());
        $this->assertTrue($req->getBlock());
        $this->assertSame('f,m,c', $req->getDefaultInterests());
        $this->assertSame($timeout, $req->getTimeout());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AdminWaitSetRequest waitSet="' . $waitSet . '" seq="' . $seq . '" block="true" defTypes="f,m,c" timeout="' . $timeout . '" >'
                . '<add>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                . '</add>'
                . '<update>'
                    . '<a name="' . $name . '" id="' . $id . '" token="' . $token . '" types="f,m,c" />'
                . '</update>'
                . '<remove>'
                    . '<a id="' . $id . '" />'
                . '</remove>'
            . '</AdminWaitSetRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AdminWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
                'seq' => $seq,
                'block' => true,
                'defTypes' => 'f,m,c',
                'timeout' => $timeout,
                'add' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f,m,c',
                        ],
                    ],
                ],
                'update' => [
                    'a' => [
                        [
                            'name' => $name,
                            'id' => $id,
                            'token' => $token,
                            'types' => 'f,m,c',
                        ],
                    ],
                ],
                'remove' => [
                    'a' => [
                        [
                            'id' => $id,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAuth()
    {
        $name = self::randomName();
        $password = self::randomName();
        $authToken = self::randomName();
        $virtualHost = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $name);
        $req = new \Zimbra\Admin\Request\Auth($name, $password, $authToken, $account, $virtualHost, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertFalse($req->getPersistAuthTokenCookie());

        $req->setName($name)
            ->setPassword($password)
            ->setAuthToken($authToken)
            ->setAccount($account)
            ->setVirtualHost($virtualHost)
            ->setPersistAuthTokenCookie(true);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($authToken, $req->getAuthToken());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($virtualHost, $req->getVirtualHost());
        $this->assertTrue($req->getPersistAuthTokenCookie());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AuthRequest name="' . $name . '" password="' . $password . '" persistAuthTokenCookie="true">'
                . '<authToken>' . $authToken . '</authToken>'
                . '<account by="' . AccountBy::NAME() . '">' . $name . '</account>'
                . '<virtualHost>' . $virtualHost . '</virtualHost>'
            . '</AuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'authToken' => $authToken,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $name,
                ],
                'virtualHost' => $virtualHost,
                'persistAuthTokenCookie' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoCompleteGal()
    {
        $domain = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\AutoCompleteGal(
            $domain, $name, GalSearchType::ALL(), $galAcctId, $limit
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $req->setDomain($domain)
            ->setName($name)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccountId($galAcctId)
            ->setLimit($limit);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($name, $req->getName());
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($galAcctId, $req->getGalAccountId());
        $this->assertSame($limit, $req->getLimit());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoCompleteGalRequest domain="' . $domain . '" name="' . $name . '" type="' . GalSearchType::ACCOUNT() . '" galAcctId="' . $galAcctId . '" limit="' . $limit . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoCompleteGalRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'name' => $name,
                'type' => GalSearchType::ACCOUNT()->value(),
                'galAcctId' => $galAcctId,
                'limit' => $limit,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvAccount()
    {
        $value = self::randomName();
        $password = self::randomName();

        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $principal = new \Zimbra\Admin\Struct\PrincipalSelector(PrincipalBy::DN(), $value);
        $req = new \Zimbra\Admin\Request\AutoProvAccount($domain, $principal, $password);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $req->setDomain($domain)
            ->setPrincipal($principal)
            ->setPassword($password);
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($principal, $req->getPrincipal());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<principal by="' . PrincipalBy::DN() . '">' . $value . '</principal>'
                . '<password>' . $password . '</password>'
            . '</AutoProvAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoProvAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'principal' => [
                    'by' => PrincipalBy::DN()->value(),
                    '_content' => $value,
                ],
                'password' => $password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testAutoProvTaskControl()
    {
        $req = new \Zimbra\Admin\Request\AutoProvTaskControl(TaskAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->getAction()->value());

        $req->setAction(TaskAction::STATUS());
        $this->assertSame('status', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<AutoProvTaskControlRequest action="' . TaskAction::STATUS() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'AutoProvTaskControlRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => TaskAction::STATUS()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testBaseRequest()
    {
        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\Base');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->getXmlNamespace());

        $req = $this->getMockForAbstractClass('\Zimbra\Admin\Request\BaseAttr');
        $this->assertInstanceOf('Zimbra\Soap\Request', $req);
        $this->assertEquals('urn:zimbraAdmin', $req->getXmlNamespace());
    }

    public function testCheckAuthConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CheckAuthConfig($name, $password, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req->setName($name)
            ->setPassword($password);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckAuthConfigRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckAuthConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckAuthConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckBlobConsistency()
    {
        $id = mt_rand(0, 100);
        $volume = new \Zimbra\Admin\Struct\IntIdAttr($id);
        $mbox = new \Zimbra\Admin\Struct\IntIdAttr($id);

        $req = new \Zimbra\Admin\Request\CheckBlobConsistency([$volume], [$mbox], true, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$volume], $req->getVolumes()->all());
        $this->assertSame([$mbox], $req->getMailboxes()->all());
        $this->assertTrue($req->getCheckSize());
        $this->assertFalse($req->getReportUsedBlobs());

        $req->addVolume($volume)
            ->addMailbox($mbox)
            ->setCheckSize(false)
            ->setReportUsedBlobs(true);
        $this->assertSame([$volume, $volume], $req->getVolumes()->all());
        $this->assertSame([$mbox, $mbox], $req->getMailboxes()->all());
        $this->assertFalse($req->getCheckSize());
        $this->assertTrue($req->getReportUsedBlobs());
        $req->getVolumes()->remove(1);
        $req->getMailboxes()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckBlobConsistencyRequest checkSize="false" reportUsedBlobs="true">'
                . '<volume id="' . $id . '" />'
                . '<mbox id="' . $id . '" />'
            . '</CheckBlobConsistencyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckBlobConsistencyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'checkSize' => false,
                'reportUsedBlobs' => true,
                'volume' => [
                    [
                        'id' => $id,
                    ],
                ],
                'mbox' => [
                    [
                        'id' => $id
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDirectory()
    {
        $path = self::randomName();
        $dir = new \Zimbra\Admin\Struct\CheckDirSelector($path, true);
        $req = new \Zimbra\Admin\Request\CheckDirectory([$dir]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$dir], $req->getDirectories()->all());

        $req->addDirectory($dir);
        $this->assertSame([$dir, $dir], $req->getDirectories()->all());
        $req->getDirectories()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDirectoryRequest>'
                . '<directory path="' . $path . '" create="true" />'
            . '</CheckDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'directory' => [
                    [
                        'path' => $path,
                        'create' => true,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckDomainMXRecord()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\CheckDomainMXRecord($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());

        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckDomainMXRecordRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</CheckDomainMXRecordRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckDomainMXRecordRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $req = new \Zimbra\Admin\Request\CheckExchangeAuth($auth);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($auth, $req->getAuth());

        $req->setAuth($auth);
        $this->assertSame($auth, $req->getAuth());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckExchangeAuthRequest>'
                . '<auth url="' . $url . '" user="' . $user . '" pass="' . $pass . '" scheme="' . AuthScheme::FORM() . '" type="' . $type . '" />'
            . '</CheckExchangeAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckExchangeAuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'auth' => [
                    'url' => $url,
                    'user' => $user,
                    'pass' => $pass,
                    'scheme' => AuthScheme::FORM()->value(),
                    'type' => $type,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckGalConfig()
    {
        $key = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $query = new \Zimbra\Admin\Struct\LimitedQuery($limit, $value);

        $req = new \Zimbra\Admin\Request\CheckGalConfig($query, GalConfigAction::AUTOCOMPLETE(), [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertTrue($req->getAction()->is('autocomplete'));

        $req->setQuery($query)
            ->setAction(GalConfigAction::SEARCH());
        $this->assertSame($query, $req->getQuery());
        $this->assertTrue($req->getAction()->is('search'));

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckGalConfigRequest>'
                . '<query limit="'. $limit . '">' . $value . '</query>'
                . '<action>' . GalConfigAction::SEARCH() . '</action>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckGalConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckGalConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => [
                    'limit' => $limit,
                    '_content' => $value,
                ],
                'action' => 'search',
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckHealth()
    {
        $req = new \Zimbra\Admin\Request\CheckHealth();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHealthRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckHealthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckHostnameResolve()
    {
        $hostname = self::randomName();
        $req = new \Zimbra\Admin\Request\CheckHostnameResolve($hostname);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($hostname, $req->getHostname());
        $req->setHostname($hostname);
        $this->assertSame($hostname, $req->getHostname());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckHostnameResolveRequest hostname="' . $hostname . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckHostnameResolveRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'hostname' => $hostname,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCheckPasswordStrength()
    {
        $id = self::randomName();
        $password = self::randomName();
        $req = new \Zimbra\Admin\Request\CheckPasswordStrength($id, $password);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $req->setId($id)
            ->setPassword($password);
        $this->assertSame($id, $req->getId());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckPasswordStrengthRequest id="' . $id .'" password="' . $password . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckPasswordStrengthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'password' => $password,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\CheckRight($target, $grantee, $right, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CheckRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right>' . $right . '</right>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CheckRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CheckRightRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
                'right' => $right,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testClearCookie()
    {
        $name = self::randomName();
        $cookie = new \Zimbra\Admin\Struct\CookieSpec($name);
        $req = new \Zimbra\Admin\Request\ClearCookie([$cookie]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$cookie], $req->getCookies()->all());

        $req->addCookie($cookie);
        $this->assertSame([$cookie, $cookie], $req->getCookies()->all());
        $req->getCookies()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ClearCookieRequest>'
                . '<cookie name="' . $name . '" />'
            . '</ClearCookieRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ClearCookieRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cookie' => [
                    [
                        'name' => $name
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCompactIndex()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\CompactIndex($mbox, IndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame('start', $req->getAction()->value());

        $req->setMailbox($mbox)
            ->setAction(IndexAction::STATUS());
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame('status', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CompactIndexRequest action="' . IndexAction::STATUS() . '">'
                . '<mbox id="' . $id . '" />'
            . '</CompactIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CompactIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => IndexAction::STATUS()->value(),
                'mbox' => [
                    'id' => $id
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testComputeAggregateQuotaUsage()
    {
        $req = new \Zimbra\Admin\Request\ComputeAggregateQuotaUsage();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ComputeAggregateQuotaUsageRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ComputeAggregateQuotaUsageRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testConfigureZimlet()
    {
        $aid = self::randomName();
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib($aid);
        $req = new \Zimbra\Admin\Request\ConfigureZimlet($content);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($content, $req->getContent());

        $req->setContent($content);
        $this->assertSame($content, $req->getContent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ConfigureZimletRequest>'
                . '<content aid="' . $aid . '" />'
            . '</ConfigureZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ConfigureZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'content' => [
                    'aid' => $aid,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCopyCos()
    {
        $name = self::randomName();
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\CopyCos($name, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($name, $req->getNewName());
        $this->assertSame($cos, $req->getCos());

        $req->setNewName($name)
            ->setCos($cos);
        $this->assertSame($name, $req->getNewName());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CopyCosRequest>'
                . '<name>' . $name . '</name>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</CopyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CopyCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCountAccount()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\CountAccount($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());

        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountAccountRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</CountAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CountAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCountObjects()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\CountObjects(ObjType::USER_ACCOUNT(), $domain, $ucservice);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('userAccount', $req->getType()->value());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($ucservice, $req->getUcService());

        $req->setType(ObjType::ACCOUNT())
            ->setDomain($domain)
            ->setUcService($ucservice);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($ucservice, $req->getUcService());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CountObjectsRequest type="' . ObjType::ACCOUNT() . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</CountObjectsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CountObjectsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => ObjType::ACCOUNT()->value(),
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateAccount()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateAccount($name, $password, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req->setName($name)
            ->setPassword($password);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateAccountRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateCalendarResource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $password = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateCalendarResource($name, $password, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $req->setName($name)
            ->setPassword($password);
        $this->assertSame($name, $req->getName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCalendarResourceRequest name="' . $name . '" password="' . $password . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateCos()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateCos($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateCosRequest>'
                . '<name>' . $name . '</name>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dataSource = new \Zimbra\Admin\Struct\DataSourceSpecifier(DataSourceType::POP3(), $name, [$attr]);

        $req = new \Zimbra\Admin\Request\CreateDataSource($id, $dataSource);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDataSourceRequest id="' . $id . '">'
                . '<dataSource type="' . DataSourceType::POP3() . '" name="' . $name . '">'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</dataSource>'
            . '</CreateDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dataSource' => [
                    'type' => DataSourceType::POP3(),
                    'name' => $name,
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateDistributionList($name, false, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($name, $req->getName());
        $this->assertFalse($req->getDynamic());

        $req->setName($name)
            ->setDynamic(true);
        $this->assertSame($name, $req->getName());
        $this->assertTrue($req->getDynamic());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDistributionListRequest name="' . $name . '" dynamic="true">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'dynamic' => true,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateDomain()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateDomain($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateDomainRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\CreateGalSyncAccount(
            $account, $name, $domain, GalMode::BOTH(), $server, $password, $folder, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame('both', $req->getType()->value());
        $this->assertSame($server, $req->getServer());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($folder, $req->getFolder());

        $req->setName($name)
            ->setDomain($domain)
            ->setType(GalMode::LDAP())
            ->setServer($server)
            ->setAccount($account)
            ->setPassword($password)
            ->setFolder($folder);
        $this->assertSame($name, $req->getName());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame('ldap', $req->getType()->value());
        $this->assertSame($server, $req->getServer());
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($password, $req->getPassword());
        $this->assertSame($folder, $req->getFolder());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateGalSyncAccountRequest name="' . $name . '" domain="' . $domain . '" type="' . GalMode::LDAP() . '" server="' . $server . '" password="' . $password . '" folder="' . $folder . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateGalSyncAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'domain' => $domain,
                'type' => GalMode::LDAP()->value(),
                'server' => $server,
                'password' => $password,
                'folder' => $folder,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateLDAPEntry()
    {
        $key = self::randomName();
        $value = self::randomName();
        $dn = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateLDAPEntry($dn, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateLDAPEntryRequest dn="' . $dn . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateServer()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateServer($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->getName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateServerRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\CreateSystemRetentionPolicy($cos, $keep, $purge);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($keep, $req->getKeepPolicy());
        $this->assertSame($purge, $req->getPurgePolicy());

        $req->setCos($cos)
            ->setKeepPolicy($keep)
            ->setPurgePolicy($purge);
        $this->assertSame($cos, $req->getCos());
        $this->assertSame($keep, $req->getKeepPolicy());
        $this->assertSame($purge, $req->getPurgePolicy());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateSystemRetentionPolicyRequest>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
                . '<keep>'
                    . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '</keep>'
                . '<purge>'
                    . '<policy xmlns="urn:zimbraMail" type="' . Type::USER() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '</purge>'
            . '</CreateSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
                'keep' => [
                    'policy' => [
                        '_jsns' => 'urn:zimbraMail',
                        'type' => Type::SYSTEM()->value(),
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
                'purge' => [
                    'policy' => [
                        '_jsns' => 'urn:zimbraMail',
                        'type' => Type::USER()->value(),
                        'id' => $id,
                        'name' => $name,
                        'lifetime' => $lifetime,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateUCService()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateUCService($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateUCServiceRequest>'
                . '<name>' . $name . '</name>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateVolume()
    {
        $id = mt_rand(0, 10);
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = self::randomName();
        $rootpath = self::randomName();

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, 2, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );
        $req = new \Zimbra\Admin\Request\CreateVolume($volume);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($volume, $req->getVolume());

        $req->setVolume($volume);
        $this->assertSame($volume, $req->getVolume());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateVolumeRequest>'
                . '<volume '
                    . 'id="' . $id . '" '
                    . 'type="2" '
                    . 'compressionThreshold="' . $threshold . '" '
                    . 'mgbits="' . $mgbits . '" '
                    . 'mbits="' . $mbits . '" '
                    . 'fgbits="' . $fgbits . '" '
                    . 'fbits="' . $fbits . '" '
                    . 'name="' . $name . '" '
                    . 'rootpath="' . $rootpath . '" '
                    . 'compressBlobs="false" '
                    . 'isCurrent="true" />'
            . '</CreateVolumeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'volume' => [
                    'id' => $id,
                    'type' => 2,
                    'compressionThreshold' => $threshold,
                    'mgbits' => $mgbits,
                    'mbits' => $mbits,
                    'fgbits' => $fgbits,
                    'fbits' => $fbits,
                    'name' => $name,
                    'rootpath' => $rootpath,
                    'compressBlobs' => false,
                    'isCurrent' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateXMPPComponent()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $name);
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $name);
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSpec($name, $domain, $server, [$attr]);

        $req = new \Zimbra\Admin\Request\CreateXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateXMPPComponentRequest>'
                . '<xmppcomponent name="' . $name . '">'
                    . '<domain by="' . DomainBy::NAME() . '">' . $name . '</domain>'
                    . '<server by="' . ServerBy::NAME() . '">' . $name . '</server>'
                    . '<a n="' . $key . '">' . $value . '</a>'
                . '</xmppcomponent>'
            . '</CreateXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'xmppcomponent' => [
                    'name' => $name,
                    'domain' => [
                        'by' => DomainBy::NAME()->value(),
                        '_content' => $name,
                    ],
                    'server' => [
                        'by' => ServerBy::NAME()->value(),
                        '_content' => $name,
                    ],
                    'a' => [
                        [
                            'n' => $key,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testCreateZimlet()
    {
        $key = self::randomName();
        $value = self::randomName();
        $name = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\CreateZimlet($name, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($name, $req->getName());

        $req->setName($name);
        $this->assertSame($name, $req->getName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<CreateZimletRequest name="' . $name . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</CreateZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'CreateZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDedupeBlobs()
    {
        $id = mt_rand(0, 100);
        $volume = new \Zimbra\Admin\Struct\IntIdAttr($id);
        $req = new \Zimbra\Admin\Request\DedupeBlobs(DedupAction::START(), [$volume]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('start', $req->getAction()->value());
        $this->assertSame([$volume], $req->getVolumes()->all());

        $req->setAction(DedupAction::STATUS())
            ->addVolume($volume);
        $this->assertSame('status', $req->getAction()->value());
        $this->assertSame([$volume, $volume], $req->getVolumes()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DedupeBlobsRequest action="' . DedupAction::STATUS() . '">'
                . '<volume id="' . $id . '" />'
                . '<volume id="' . $id . '" />'
            . '</DedupeBlobsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DedupeBlobsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => DedupAction::STATUS()->value(),
                'volume' => [
                    [
                        'id' => $id,
                    ],
                    [
                        'id' => $id,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDelegateAuth()
    {
        $value = self::randomName();
        $duration = mt_rand(0, 1000);
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\DelegateAuth($account, $duration);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($duration, $req->getDuration());

        $req->setAccount($account)
            ->setDuration($duration);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($duration, $req->getDuration());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DelegateAuthRequest duration="' . $duration . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</DelegateAuthRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DelegateAuthRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'duration' => $duration,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteAccount()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteAccount($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteAccountRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCalendarResource()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteCalendarResource($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteCalendarResourceRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteCos()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteCos($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteCosRequest>'
                . '<id>' . $id . '</id>'
            . '</DeleteCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dataSource = new \Zimbra\Struct\Id($id);

        $req = new \Zimbra\Admin\Request\DeleteDataSource($id, $dataSource, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteDataSourceRequest id="' . $id . '">'
                . '<dataSource id="' . $id . '" />'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</DeleteDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dataSource' => [
                    'id' => $id,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDistributionList()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteDistributionList($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteDistributionListRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteDomain()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteDomain($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteDomainRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteGalSyncAccount()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\DeleteGalSyncAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteGalSyncAccountRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value  .'</account>'
            . '</DeleteGalSyncAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteGalSyncAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteLDAPEntry()
    {
        $dn = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteLDAPEntry($dn);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteLDAPEntryRequest dn="' . $dn . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteMailbox()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\DeleteMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteMailboxRequest>'
                . '<mbox id="' . $id . '" />'
            . '</DeleteMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteMailboxRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteServer()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteServer($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteServerRequest id="' . $id  .'" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteSystemRetentionPolicy()
    {
        $value = self::randomName();
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $req = new \Zimbra\Admin\Request\DeleteSystemRetentionPolicy($policy, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $req->setPolicy($policy)
            ->setCos($cos);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteSystemRetentionPolicyRequest>'
                . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM()  .'" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</DeleteSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'policy' => [
                    '_jsns' => 'urn:zimbraMail',
                    'type' => Type::SYSTEM()->value(),
                    'id' => $id,
                    'name' => $name,
                    'lifetime' => $lifetime,
                ],
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteUCService()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\DeleteUCService($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteUCServiceRequest>'
                . '<id>' . $id . '</id>'
            . '</DeleteUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteVolume()
    {
        $id = mt_rand(0, 100);
        $req = new \Zimbra\Admin\Request\DeleteVolume($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteVolumeRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteXMPPComponent()
    {
        $value = self::randomName();
        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\DeleteXMPPComponent($xmpp);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteXMPPComponentRequest>'
                . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>'
            . '</DeleteXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'xmppcomponent' => [
                    'by' => XmppBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeleteZimlet()
    {
        $name = self::randomName();
        $zimlet = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\DeleteZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());

        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeleteZimletRequest>'
                . '<zimlet name="' . $name . '" />'
            . '</DeleteZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeleteZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'zimlet' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDeployZimlet()
    {
        $aid = self::randomName();
        $content = new \Zimbra\Admin\Struct\AttachmentIdAttrib($aid);
        $req = new \Zimbra\Admin\Request\DeployZimlet(DeployAction::DEPLOY_ALL(), $content, false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('deployAll', $req->getAction()->value());
        $this->assertSame($content, $req->getContent());
        $this->assertFalse($req->getFlushCache());
        $this->assertTrue($req->getSynchronous());

        $req->setAction(DeployAction::DEPLOY_LOCAL())
            ->setContent($content)
            ->setFlushCache(true)
            ->setSynchronous(false);
        $this->assertSame('deployLocal', $req->getAction()->value());
        $this->assertSame($content, $req->getContent());
        $this->assertTrue($req->getFlushCache());
        $this->assertFalse($req->getSynchronous());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DeployZimletRequest action="' . DeployAction::DEPLOY_LOCAL()  .'" flush="true" synchronous="false">'
                . '<content aid="' . $aid .'" />'
            . '</DeployZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DeployZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => DeployAction::DEPLOY_LOCAL()->value(),
                'flush' => true,
                'synchronous' => false,
                'content' => [
                    'aid' => $aid,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testDumpSessions()
    {
        $req = new \Zimbra\Admin\Request\DumpSessions(false, true);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getListSessions());
        $this->assertTrue($req->getGroupByAccount());

        $req->setListSessions(true)
            ->setGroupByAccount(false);
        $this->assertTrue($req->getListSessions());
        $this->assertFalse($req->getGroupByAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<DumpSessionsRequest listSessions="true" groupByAccount="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'DumpSessionsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'listSessions' => true,
                'groupByAccount' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testExportAndDeleteItems()
    {
        $id = mt_rand(1, 100);
        $version = mt_rand(1, 100);
        $exportDir = self::randomName();
        $prefix = self::randomName();

        $item = new \Zimbra\Admin\Struct\ExportAndDeleteItemSpec($id, $version);
        $mbox = new \Zimbra\Admin\Struct\ExportAndDeleteMailboxSpec($id, [$item]);

        $req = new \Zimbra\Admin\Request\ExportAndDeleteItems($mbox, $exportDir, $prefix);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame($exportDir, $req->getExportDir());
        $this->assertSame($prefix, $req->getExportFilenamePrefix());

        $req->setMailbox($mbox)
            ->setExportDir($exportDir)
            ->getExportFilenamePrefix($prefix);
        $this->assertSame($mbox, $req->getMailbox());
        $this->assertSame($exportDir, $req->getExportDir());
        $this->assertSame($prefix, $req->getExportFilenamePrefix());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ExportAndDeleteItemsRequest exportDir="' . $exportDir . '" exportFilenamePrefix="' . $prefix . '">'
                . '<mbox id="' . $id . '">'
                    . '<item id="' . $id . '" version="' . $version . '" />'
                . '</mbox>'
            . '</ExportAndDeleteItemsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ExportAndDeleteItemsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'exportDir' => $exportDir,
                'exportFilenamePrefix' => $prefix,
                'mbox' => [
                    'id' => $id,
                    'item' => [
                        [
                            'id' => $id,
                            'version' => $version,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarEndTime()
    {
        $name = self::randomName();
        $account = new \Zimbra\Struct\NamedElement($name);

        $req = new \Zimbra\Admin\Request\FixCalendarEndTime(false, [$account]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getSync());
        $this->assertSame([$account], $req->getAccounts()->all());

        $req->setSync(true)
            ->addAccount($account);
        $this->assertTrue($req->getSync());
        $this->assertSame([$account, $account], $req->getAccounts()->all());
        $req->getAccounts()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FixCalendarEndTimeRequest sync="true">'
                . '<account name="' . $name . '" />'
            . '</FixCalendarEndTimeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FixCalendarEndTimeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'sync' => true,
                'account' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFixCalendarPriority()
    {
        $name = self::randomName();
        $account = new \Zimbra\Struct\NamedElement($name);

        $req = new \Zimbra\Admin\Request\FixCalendarPriority(false, [$account]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getSync());
        $this->assertSame([$account], $req->getAccounts()->all());

        $req->setSync(true)
            ->addAccount($account);
        $this->assertTrue($req->getSync());
        $this->assertSame([$account, $account], $req->getAccounts()->all());
        $req->getAccounts()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FixCalendarPriorityRequest sync="true">'
                . '<account name="' . $name . '" />'
            . '</FixCalendarPriorityRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FixCalendarPriorityRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'sync' => true,
                'account' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\FixCalendarTZ([$account], $tzfixup, false, $after);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$account], $req->getAccounts()->all());
        $this->assertSame($tzfixup, $req->getTzFixup());
        $this->assertFalse($req->getSync());
        $this->assertSame($after, $req->getAfter());

        $req->setSync(true)
            ->setAfter($after)
            ->addAccount($account)
            ->setTzFixup($tzfixup);
        $this->assertSame([$account, $account], $req->getAccounts()->all());
        $this->assertSame($tzfixup, $req->getTzFixup());
        $this->assertTrue($req->getSync());
        $this->assertSame($after, $req->getAfter());
        $req->getAccounts()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FixCalendarTZRequest sync="true" after="' . $after . '">'
                . '<tzfixup>'
                    . '<fixupRule>'
                        . '<match>'
                            . '<any />'
                            . '<tzid id="' . $id . '" />'
                            . '<nonDst offset="' . $offset . '" />'
                            . '<rules stdoff="' . $rule_stdoff . '" dayoff="' . $rule_dayoff . '">'
                                . '<standard mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                                . '<daylight mon="' . $rule_mon . '" week="' . $rule_week . '" wkday="' . $rule_wkday . '" />'
                            . '</rules>'
                            . '<dates stdoff="' . $date_stdoff . '" dayoff="' . $date_dayoff . '">'
                                . '<standard mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                                . '<daylight mon="' . $date_mon . '" mday="' . $date_mday . '" />'
                            . '</dates>'
                        . '</match>'
                        . '<touch />'
                        . '<replace>'
                            . '<wellKnownTz id="' . $id . '" />'
                            . '<tz id="' . $id . '" stdoff="' . $stdoff . '" dayoff="' . $dayoff . '" stdname="' . $stdname . '" dayname="' . $dayname . '">'
                                . '<standard mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                                . '<daylight mon="' . $mon . '" hour="' . $hour . '" min="' . $min . '" sec="' . $sec . '" />'
                            . '</tz>'
                        . '</replace>'
                    . '</fixupRule>'
                . '</tzfixup>'
                . '<account name="' . $name . '" />'
            . '</FixCalendarTZRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FixCalendarTZRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'sync' => true,
                'after' => $after,
                'account' => [
                    [
                        'name' => $name,
                    ],
                ],
                'tzfixup' => [
                    'fixupRule' => [
                        [
                            'match' => [
                                'any' => [],
                                'tzid' => [
                                    'id' => $id,
                                ],
                                'nonDst' => [
                                    'offset' => $offset,
                                ],
                                'rules' => [
                                    'stdoff' => $rule_stdoff,
                                    'dayoff' => $rule_dayoff,
                                    'standard' => [
                                        'mon' => $rule_mon,
                                        'week' => $rule_week,
                                        'wkday' => $rule_wkday,
                                    ],
                                    'daylight' => [
                                        'mon' => $rule_mon,
                                        'week' => $rule_week,
                                        'wkday' => $rule_wkday,
                                    ],
                                ],
                                'dates' => [
                                    'stdoff' => $date_stdoff,
                                    'dayoff' => $date_dayoff,
                                    'standard' => [
                                        'mon' => $date_mon,
                                        'mday' => $date_mday,
                                    ],
                                    'daylight' => [
                                        'mon' => $date_mon,
                                        'mday' => $date_mday,
                                    ],
                                ],
                            ],
                            'touch' => [],
                            'replace' => [
                                'wellKnownTz' => [
                                    'id' => $id,
                                ],
                                'tz' => [
                                    'id' => $id,
                                    'stdoff' => $stdoff,
                                    'dayoff' => $dayoff,
                                    'stdname' => $stdname,
                                    'dayname' => $dayname,
                                    'standard' => [
                                        'mon' => $mon,
                                        'hour' => $hour,
                                        'min' => $min,
                                        'sec' => $sec,
                                    ],
                                    'daylight' => [
                                        'mon' => $mon,
                                        'hour' => $hour,
                                        'min' => $min,
                                        'sec' => $sec,
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testFlushCache()
    {
        $value = self::randomName();
        $types = self::randomAttrs(\Zimbra\Enum\CacheType::enums());

        $entry = new \Zimbra\Admin\Struct\CacheEntrySelector(CacheEntryBy::NAME(), $value);
        $cache = new \Zimbra\Admin\Struct\CacheSelector($types, true, [$entry]);

        $req = new \Zimbra\Admin\Request\FlushCache($cache);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cache, $req->getCache());
        $req->setCache($cache);
        $this->assertSame($cache, $req->getCache());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<FlushCacheRequest>'
                . '<cache type="' . $types . '" allServers="true">'
                    . '<entry by="' . CacheEntryBy::NAME() . '">' . $value . '</entry>'
                . '</cache>'
            . '</FlushCacheRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'FlushCacheRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cache' => [
                    'type' => $types,
                    'allServers' => true,
                    'entry' => [
                        [
                            'by' => CacheEntryBy::NAME()->value(),
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $subject1 = self::randomName();
        $subject2 = self::randomName();

        $req = new \Zimbra\Admin\Request\GenCSR(
            $server, false, CSRType::SELF(), CSRKeySize::SIZE_1024(), $c, $st, $l, $o, $ou, $cn, [$subject1]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertFalse($req->getNewCSR());
        $this->assertSame('self', $req->getType()->value());
        $this->assertSame(1024, $req->getKeySize()->value());
        $this->assertSame($c, $req->getC());
        $this->assertSame($st, $req->getSt());
        $this->assertSame($l, $req->getL());
        $this->assertSame($o, $req->getO());
        $this->assertSame($ou, $req->getOu());
        $this->assertSame($cn, $req->getCn());
        $this->assertSame([$subject1], $req->getSubjectAltNames()->all());

        $req->setServer($server)
            ->setNewCSR(true)
            ->setType(CSRType::COMM())
            ->setKeySize(CSRKeySize::SIZE_2048())
            ->setC($c)
            ->setSt($st)
            ->setL($l)
            ->setO($o)
            ->setOu($ou)
            ->setCn($cn)
            ->addSubjectAltName($subject2);
        $this->assertSame($server, $req->getServer());
        $this->assertTrue($req->getNewCSR());
        $this->assertSame('comm', $req->getType()->value());
        $this->assertSame(2048, $req->getKeySize()->value());
        $this->assertSame($c, $req->getC());
        $this->assertSame($st, $req->getSt());
        $this->assertSame($l, $req->getL());
        $this->assertSame($o, $req->getO());
        $this->assertSame($ou, $req->getOu());
        $this->assertSame($cn, $req->getCn());
        $this->assertSame([$subject1, $subject2], $req->getSubjectAltNames()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GenCSRRequest server="' . $server . '" new="true" type="' . CSRType::COMM() . '" keysize="' . CSRKeySize::SIZE_2048() . '">'
                . '<C>' . $c . '</C>'
                . '<ST>' . $st . '</ST>'
                . '<L>' . $l . '</L>'
                . '<O>' . $o . '</O>'
                . '<OU>' . $ou . '</OU>'
                . '<CN>' . $cn . '</CN>'
                . '<SubjectAltName>' . $subject1 . '</SubjectAltName>'
                . '<SubjectAltName>' . $subject2 . '</SubjectAltName>'
            . '</GenCSRRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GenCSRRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'new' => true,
                'type' => CSRType::COMM()->value(),
                'keysize' => CSRKeySize::SIZE_2048()->value(),
                'C' => $c,
                'ST' => $st,
                'L' => $l,
                'O' => $o,
                'OU' => $ou,
                'CN' => $cn,
                'SubjectAltName' => [
                    $subject1,
                    $subject2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccount()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetAccount($account, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertFalse($req->getApplyCos());
        $this->assertSame($attrs, $req->getAttrs());

        $req->setAccount($account)
            ->setApplyCos(true);
        $this->assertSame($account, $req->getAccount());
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountRequest applyCos="true" attrs="' . $attrs . '">'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true,
                'attrs' => $attrs,
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountInfo()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetAccountInfo($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountInfoRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountLoggers()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetAccountLoggers($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountLoggersRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountLoggersRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountLoggersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAccountMembership()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetAccountMembership($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAccountMembershipRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetAccountMembershipRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAccountMembershipRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminConsoleUIComp()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\GetAdminConsoleUIComp($account, $dl);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($dl, $req->getDl());

        $req->setAccount($account)
            ->setDl($dl);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($dl, $req->getDl());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAdminConsoleUICompRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<dl by="' . DLBy::NAME() . '">' . $value  .'</dl>'
            . '</GetAdminConsoleUICompRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAdminConsoleUICompRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminExtensionZimlets()
    {
        $req = new \Zimbra\Admin\Request\GetAdminExtensionZimlets();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAdminExtensionZimletsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAdminExtensionZimletsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAdminSavedSearches()
    {
        $name = self::randomName();
        $search = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\GetAdminSavedSearches([$search]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$search], $req->getSearches()->all());

        $req->addSearch($search);
        $this->assertSame([$search, $search], $req->getSearches()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAdminSavedSearchesRequest>'
                . '<search name="' . $name . '" />'
                . '<search name="' . $name . '" />'
            . '</GetAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAdminSavedSearchesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'search' => [
                    [
                        'name' => $name,
                    ],
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAggregateQuotaUsageOnServer()
    {
        $req = new \Zimbra\Admin\Request\GetAggregateQuotaUsageOnServer();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAggregateQuotaUsageOnServerRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAggregateQuotaUsageOnServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAccountLoggers()
    {
        $req = new \Zimbra\Admin\Request\GetAllAccountLoggers();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAccountLoggersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAccountLoggersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAccounts()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\GetAllAccounts($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $req->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAccountsRequest>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllAccountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAccountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllAdminAccounts()
    {
        $req = new \Zimbra\Admin\Request\GetAllAdminAccounts(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getApplyCos());
        $req->setApplyCos(true);
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllAdminAccountsRequest applyCos="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllAdminAccountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllCalendarResources()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\GetAllCalendarResources($server, $domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $req->setServer($server)
            ->setDomain($domain);
        $this->assertSame($server, $req->getServer());
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllCalendarResourcesRequest>'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllCalendarResourcesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllConfig()
    {
        $req = new \Zimbra\Admin\Request\GetAllConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllCos()
    {
        $req = new \Zimbra\Admin\Request\GetAllCos();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllCosRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDistributionLists()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\GetAllDistributionLists($domain);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());

        $req->setDomain($domain);
        $this->assertSame($domain, $req->getDomain());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllDistributionListsRequest>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetAllDistributionListsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllDistributionListsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllDomains()
    {
        $req = new \Zimbra\Admin\Request\GetAllDomains(false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertFalse($req->getApplyConfig());
        $req->setApplyConfig(true);
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllDomainsRequest applyConfig="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllDomainsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllEffectiveRights()
    {
        $value = self::randomName();
        $secret = self::randomName();
        $grantee = new \Zimbra\Admin\Struct\GranteeSelector(
            $value, GranteeType::USR(), GranteeBy::ID(), $secret, true
        );

        $req = new \Zimbra\Admin\Request\GetAllEffectiveRights($grantee, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertFalse($req->getExpandAllAttrs());

        $req->setGrantee($grantee)
            ->setExpandAllAttrs(true);
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertTrue($req->getExpandAllAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllEffectiveRightsRequest expandAllAttrs="true">'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetAllEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllEffectiveRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'expandAllAttrs' => true,
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllFreeBusyProviders()
    {
        $req = new \Zimbra\Admin\Request\GetAllFreeBusyProviders();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllFreeBusyProvidersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllFreeBusyProvidersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllLocales()
    {
        $req = new \Zimbra\Admin\Request\GetAllLocales();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllLocalesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllLocalesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllMailboxes()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $req = new \Zimbra\Admin\Request\GetAllMailboxes($limit, $offset);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllMailboxesRequest limit="' . $limit . '" offset="' . $offset . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllMailboxesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllRights()
    {
        $type = self::randomName();
        $req = new \Zimbra\Admin\Request\GetAllRights($type, false, RightClass::ADMIN());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($type, $req->getTargetType());
        $this->assertFalse($req->getExpandAllAttrs());
        $this->assertSame('ADMIN', $req->getRightClass()->value());

        $req->setTargetType($type)
            ->setExpandAllAttrs(true)
            ->setRightClass(RightClass::ALL());
        $this->assertSame($type, $req->getTargetType());
        $this->assertTrue($req->getExpandAllAttrs());
        $this->assertSame('ALL', $req->getRightClass()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllRightsRequest targetType="' . $type . '" expandAllAttrs="true" rightClass="' . RightClass::ALL() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'targetType' => $type,
                'expandAllAttrs' => true,
                'rightClass' => RightClass::ALL()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllServers()
    {
        $service = self::randomName();
        $req = new \Zimbra\Admin\Request\GetAllServers($service, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($service, $req->getService());
        $this->assertFalse($req->getApplyConfig());

        $req->setService($service)
            ->setApplyConfig(true);
        $this->assertSame($service, $req->getService());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllServersRequest service="' . $service . '" applyConfig="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllServersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'service' => $service,
                'applyConfig' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllSkins()
    {
        $req = new \Zimbra\Admin\Request\GetAllSkins();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllSkinsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllSkinsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllUCProviders()
    {
        $req = new \Zimbra\Admin\Request\GetAllUCProviders();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllUCProvidersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllUCProvidersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllUCServices()
    {
        $req = new \Zimbra\Admin\Request\GetAllUCServices();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllUCServicesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllUCServicesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllVolumes()
    {
        $req = new \Zimbra\Admin\Request\GetAllVolumes();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllVolumesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllVolumesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllXMPPComponents()
    {
        $req = new \Zimbra\Admin\Request\GetAllXMPPComponents();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllXMPPComponentsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllXMPPComponentsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAllZimlets()
    {
        $req = new \Zimbra\Admin\Request\GetAllZimlets(ExcludeType::EXTENSION());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('extension', $req->getExclude()->value());

        $req->setExclude(ExcludeType::MAIL());
        $this->assertSame('mail', $req->getExclude()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAllZimletsRequest exclude="' . ExcludeType::MAIL() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAllZimletsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'exclude' => ExcludeType::MAIL()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetAttributeInfo()
    {
        $attrs = self::randomName();
        $req = new \Zimbra\Admin\Request\GetAttributeInfo(
            $attrs, [EntryType::ACCOUNT(), EntryType::ACL_TARGET()]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame('account,aclTarget', $req->getEntryTypes());

        $req->setAttrs($attrs)
            ->addEntryType(EntryType::ALIAS());
        $this->assertSame($attrs, $req->getAttrs());
        $this->assertSame('account,aclTarget,alias', $req->getEntryTypes());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetAttributeInfoRequest attrs="' . $attrs . '" entryTypes="account,aclTarget,alias" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetAttributeInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'entryTypes' => 'account,aclTarget,alias',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCalendarResource()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $calResource = new \Zimbra\Admin\Struct\CalendarResourceSelector(CalResBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetCalendarResource($calResource, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($calResource, $req->getCalResource());
        $this->assertFalse($req->getApplyCos());

        $req->setCalResource($calResource)
            ->setApplyCos(true);
        $this->assertSame($calResource, $req->getCalResource());
        $this->assertTrue($req->getApplyCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCalendarResourceRequest applyCos="true" attrs="' . $attrs . '">'
                . '<calresource by="' . CalResBy::NAME() . '">' . $value . '</calresource>'
            . '</GetCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyCos' => true,
                'attrs' => $attrs,
                'calresource' => [
                    'by' => CalResBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCert()
    {
        $server = self::randomName();
        $req = new \Zimbra\Admin\Request\GetCert($server, CertType::ALL(), CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('all', $req->getType()->value());
        $this->assertSame('self', $req->getOption()->value());

        $req->setServer($server)
            ->setType(CertType::MTA())
            ->setOption(CSRType::COMM());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('mta', $req->getType()->value());
        $this->assertSame('comm', $req->getOption()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCertRequest server="' . $server . '" type="' . CertType::MTA() . '" option="' . CSRType::COMM() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCertRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'type' => CertType::MTA()->value(),
                'option' => CSRType::COMM()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetConfig()
    {
        $key = self::randomName();
        $value = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\GetConfig($attr);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($attr, $req->getAttr());
        $req->setAttr($attr);
        $this->assertSame($attr, $req->getAttr());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetConfigRequest>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'a' => [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCos()
    {
        $value = self::randomName();
        $attrs = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetCos($cos, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());

        $req->setCos($cos);
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCosRequest attrs="' . $attrs . '">'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</GetCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCreateObjectAttrs()
    {
        $value = self::randomName();
        $type = self::randomName();
        $target = new \Zimbra\Admin\Struct\TargetWithType($type, $value);
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);

        $req = new \Zimbra\Admin\Request\GetCreateObjectAttrs($target, $domain, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($cos, $req->getCos());

        $req->setTarget($target)
            ->setDomain($domain)
            ->setCos($cos);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($domain, $req->getDomain());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCreateObjectAttrsRequest>'
                . '<target type="' . $type . '">' . $value . '</target>'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</GetCreateObjectAttrsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCreateObjectAttrsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => $type,
                    '_content' => $value,
                ],
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCSR()
    {
        $server = self::randomName();
        $req = new \Zimbra\Admin\Request\GetCSR($server, CSRType::SELF());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('self', $req->getType()->value());

        $req->setServer($server)
            ->setType(CSRType::COMM());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('comm', $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCSRRequest server="' . $server . '" type="' . CSRType::COMM() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCSRRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => $server,
                'type' => CSRType::COMM()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetCurrentVolumes()
    {
        $req = new \Zimbra\Admin\Request\GetCurrentVolumes();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetCurrentVolumesRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetCurrentVolumesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDataSources()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\GetDataSources($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDataSourcesRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetDataSourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDataSourcesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDelegatedAdminConstraints()
    {
        $name = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\GetDelegatedAdminConstraints(
            TargetType::ACCOUNT(), $id, $name, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setType(TargetType::DOMAIN())
            ->setId($id)
            ->setName($name)
            ->addAttr($attr);
        $this->assertSame('domain', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDelegatedAdminConstraintsRequest type="' . TargetType::DOMAIN() . '" id="' . $id . '" name="' . $name . '">'
                . '<a name="' . $name . '" />'
            . '</GetDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDelegatedAdminConstraintsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => TargetType::DOMAIN()->value(),
                'id' => $id,
                'name' => $name,
                'a' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDevices()
    {
        $value = self::randomName();
        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetDevices($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());

        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDevicesRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
            . '</GetDevicesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDevicesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetDistributionList($dl, $limit, $offset, false, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertFalse($req->getSortAscending());

        $req->setDl($dl)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortAscending(true);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertTrue($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListRequest limit="' . $limit . '" offset="' . $offset . '" sortAscending="true">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</GetDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'sortAscending' => true,
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDistributionListMembership()
    {
        $value = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $dl = new \Zimbra\Admin\Struct\DistributionListSelector(DLBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetDistributionListMembership($dl, $limit, $offset);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setDl($dl)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($dl, $req->getDl());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDistributionListMembershipRequest limit="' . $limit . '" offset="' . $offset . '">'
                . '<dl by="' . DLBy::NAME() . '">' . $value . '</dl>'
            . '</GetDistributionListMembershipRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDistributionListMembershipRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'dl' => [
                    'by' => DLBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomain()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetDomain($domain, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getApplyConfig());

        $req->setDomain($domain)
            ->setApplyConfig(true);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDomainRequest applyConfig="true" attrs="' . $attrs . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'attrs' => $attrs,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetDomainInfo()
    {
        $value = self::randomName();
        $domain = new \Zimbra\Admin\Struct\DomainSelector(DomainBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetDomainInfo($domain, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getApplyConfig());

        $req->setDomain($domain)
            ->setApplyConfig(true);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetDomainInfoRequest applyConfig="true">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</GetDomainInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetDomainInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GetEffectiveRights($target, $grantee, AttrMethod::GET_ATTRS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame('getAttrs', $req->getExpandAllAttrs()->value());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setExpandAllAttrs(AttrMethod::SET_ATTRS());
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame('setAttrs', $req->getExpandAllAttrs()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetEffectiveRightsRequest expandAllAttrs="' . AttrMethod::SET_ATTRS() . '">'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetEffectiveRightsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetEffectiveRightsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'expandAllAttrs' => AttrMethod::SET_ATTRS()->value(),
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetFreeBusyQueueInfo()
    {
        $name = self::randomName();
        $provider = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\GetFreeBusyQueueInfo($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($provider, $req->getProvider());

        $req->setProvider($provider);
        $this->assertSame($provider, $req->getProvider());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetFreeBusyQueueInfoRequest>'
                . '<provider name="' . $name . '" />'
            . '</GetFreeBusyQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetFreeBusyQueueInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'provider' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GetGrants($target, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());

        $req->setTarget($target)
            ->setGrantee($grantee);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetGrantsRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
            . '</GetGrantsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetGrantsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetIndexStats()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\GetIndexStats($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetIndexStatsRequest>'
                . '<mbox id="' . $id . '" />'
            . '</GetIndexStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetIndexStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLDAPEntries()
    {
        $query = self::randomName();
        $searchBase = self::randomName();
        $sortBy = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\GetLDAPEntries(
            $query, $searchBase, $sortBy, false, $limit, $offset
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($searchBase, $req->getLdapSearchBase());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $req->setQuery($query)
            ->setLdapSearchBase($searchBase)
            ->setSortBy($sortBy)
            ->setSortAscending(true)
            ->setLimit($limit)
            ->setOffset($offset);
        $this->assertSame($query, $req->getQuery());
        $this->assertSame($searchBase, $req->getLdapSearchBase());
        $this->assertSame($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetLDAPEntriesRequest query="' . $query . '" sortBy="' . $sortBy . '" sortAscending="true" limit="' . $limit . '" offset="' . $offset . '">'
                . '<ldapSearchBase>' . $searchBase . '</ldapSearchBase>'
            . '</GetLDAPEntriesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetLDAPEntriesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'ldapSearchBase' => $searchBase,
                'sortBy' => $sortBy,
                'sortAscending' => true,
                'limit' => $limit,
                'offset' => $offset,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetLicenseInfo()
    {
        $req = new \Zimbra\Admin\Request\GetLicenseInfo();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetLicenseInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetLicenseInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GetLoggerStats($hostname, $stats, $startTime, $endTime);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($hostname, $req->getHostName());
        $this->assertSame($stats, $req->getStats());
        $this->assertSame($startTime, $req->getStartTime());
        $this->assertSame($endTime, $req->getEndTime());

        $req->setHostName($hostname)
            ->setStats($stats)
            ->setStartTime($startTime)
            ->setEndTime($endTime);
        $this->assertSame($hostname, $req->getHostName());
        $this->assertSame($stats, $req->getStats());
        $this->assertSame($startTime, $req->getStartTime());
        $this->assertSame($endTime, $req->getEndTime());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetLoggerStatsRequest>'
                . '<hostname hn="' . $host.  '" />'
                . '<stats name="' . $name.  '" limit="' . $limit.  '">'
                    . '<values>'
                        . '<stat name="' . $name.  '" />'
                    . '</values>'
                . '</stats>'
                . '<startTime time="' . $time.  '" />'
                . '<endTime time="' . $time.  '" />'
            . '</GetLoggerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetLoggerStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'hostname' => [
                    'hn' => $host,
                ],
                'stats' => [
                    'name' => $name,
                    'limit' => $limit,
                    'values' => [
                        'stat' => [
                            [
                                'name' => $name
                            ],
                        ],
                    ],
                ],
                'startTime' => [
                    'time' => $time,
                ],
                'endTime' => [
                    'time' => $time,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailbox()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\GetMailbox($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailboxRequest>'
                . '<mbox id="' . $id . '" />'
            . '</GetMailboxRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailboxRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailboxStats()
    {
        $req = new \Zimbra\Admin\Request\GetMailboxStats();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailboxStatsRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailboxStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GetMailQueue($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailQueueRequest>'
                . '<server name="' . $name . '">'
                    . '<queue name="' . $name . '" scan="false" wait="' . $wait . '">'
                        . '<query limit="' . $limit . '" offset="' . $offset . '">'
                            . '<field name="' . $name . '">'
                                . '<match value="' . $value . '" />'
                            . '</field>'
                        . '</query>'
                    . '</queue>'
                . '</server>'
            . '</GetMailQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailQueueRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                    'queue' => [
                        'name' => $name,
                        'scan' => false,
                        'wait' => $wait,
                        'query' => [
                            'limit' => $limit,
                            'offset' => $offset,
                            'field' => [
                                [
                                    'name' => $name,
                                    'match' => [
                                        [
                                            'value' => $value,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMailQueueInfo()
    {
        $name = self::randomName();
        $server = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\GetMailQueueInfo($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMailQueueInfoRequest>'
                . '<server name="' . $name . '" />'
            . '</GetMailQueueInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMailQueueInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetMemcachedClientConfig()
    {
        $req = new \Zimbra\Admin\Request\GetMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetMemcachedClientConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetQuotaUsage()
    {
        $domain = self::randomName();
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\GetQuotaUsage(
            $domain, false, $limit, $offset, QuotaSortBy::PERCENT_USED(), false, true
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($domain, $req->getDomain());
        $this->assertFalse($req->getAllServers());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame('percentUsed', $req->getSortBy()->value());
        $this->assertFalse($req->getSortAscending());
        $this->assertTrue($req->getRefresh());

        $req->setDomain($domain)
            ->setAllServers(true)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setSortBy(QuotaSortBy::TOTAL_USED())
            ->setSortAscending(true)
            ->setRefresh(false);
        $this->assertSame($domain, $req->getDomain());
        $this->assertTrue($req->getAllServers());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertSame('totalUsed', $req->getSortBy()->value());
        $this->assertTrue($req->getSortAscending());
        $this->assertFalse($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetQuotaUsageRequest '
                . 'domain="' . $domain . '" '
                . 'allServers="true" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'sortBy="' . QuotaSortBy::TOTAL_USED() . '" '
                . 'sortAscending="true" '
                . 'refresh="false" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetQuotaUsageRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'allServers' => true,
                'limit' => $limit,
                'offset' => $offset,
                'sortBy' => QuotaSortBy::TOTAL_USED()->value(),
                'sortAscending' => true,
                'refresh' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRight()
    {
        $right = self::randomName();
        $req = new \Zimbra\Admin\Request\GetRight($right, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($right, $req->getRight());
        $this->assertFalse($req->getExpandAllAttrs());

        $req->setRight($right)
            ->setExpandAllAttrs(true);
        $this->assertSame($right, $req->getRight());
        $this->assertTrue($req->getExpandAllAttrs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightRequest expandAllAttrs="true">'
                . '<right>' . $right . '</right>'
            . '</GetRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'right' => $right,
                'expandAllAttrs' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetRightsDoc()
    {
        $name = self::randomName();
        $package = new \Zimbra\Admin\Struct\PackageSelector($name);
        $req = new \Zimbra\Admin\Request\GetRightsDoc([$package]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$package], $req->getPackages()->all());

        $req->addPackage($package);
        $this->assertSame([$package, $package], $req->getPackages()->all());
        $req->getPackages()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetRightsDocRequest>'
                . '<package name="' . $name . '" />'
            . '</GetRightsDocRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetRightsDocRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'package' => [
                    [
                        'name' => $name,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServer()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetServer($server, false, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertFalse($req->getApplyConfig());

        $req->setServer($server)
            ->setApplyConfig(true);
        $this->assertSame($server, $req->getServer());
        $this->assertTrue($req->getApplyConfig());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerRequest applyConfig="true" attrs="' . $attrs . '">'
                . '<server by="' . ServerBy::NAME() . '">' . $value . '</server>'
            . '</GetServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'applyConfig' => true,
                'attrs' => $attrs,
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerNIfs()
    {
        $value = self::randomName();
        $server = new \Zimbra\Admin\Struct\ServerSelector(ServerBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetServerNIfs($server, IpType::BOTH());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $this->assertSame('both', $req->getType()->value());

        $req->setServer($server)
            ->setType(IpType::IPV4());
        $this->assertSame($server, $req->getServer());
        $this->assertSame('ipV4', $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerNIfsRequest type="' . IpType::IPV4() . '">'
                . '<server by="name">' . $value . '</server>'
            . '</GetServerNIfsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerNIfsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => IpType::IPV4()->value(),
                'server' => [
                    'by' => ServerBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServerStats()
    {
        $value = self::randomName();
        $name = self::randomName();
        $description = self::randomName();

        $stat = new \Zimbra\Admin\Struct\Stat($value, $name, $description);
        $req = new \Zimbra\Admin\Request\GetServerStats([$stat]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$stat], $req->getStats()->all());
        $req->addStat($stat);
        $this->assertSame([$stat, $stat], $req->getStats()->all());
        $req->getStats()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServerStatsRequest>'
                . '<stat name="' . $name . '" description="' . $description . '">' . $value . '</stat>'
            . '</GetServerStatsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServerStatsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'stat' => [
                    [
                        'name' => $name,
                        'description' => $description,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetServiceStatus()
    {
        $req = new \Zimbra\Admin\Request\GetServiceStatus();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetServiceStatusRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetServiceStatusRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSessions()
    {
        $limit = mt_rand(0, 100);
        $offset = mt_rand(0, 100);
        $req = new \Zimbra\Admin\Request\GetSessions(
            SessionType::SOAP(), SessionsSortBy::NAME_ASC(), $limit, $offset, false
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('soap', $req->getType()->value());
        $this->assertSame('nameAsc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertFalse($req->getRefresh());

        $req->setType(SessionType::ADMIN())
            ->setSortBy(SessionsSortBy::NAME_DESC())
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(true);
        $this->assertSame('admin', $req->getType()->value());
        $this->assertSame('nameDesc', $req->getSortBy()->value());
        $this->assertSame($limit, $req->getLimit());
        $this->assertSame($offset, $req->getOffset());
        $this->assertTrue($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetSessionsRequest '
                . 'type="' . SessionType::ADMIN() . '" '
                . 'sortBy="' . SessionsSortBy::NAME_DESC() . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'refresh="true" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetSessionsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => SessionType::ADMIN()->value(),
                'sortBy' => SessionsSortBy::NAME_DESC()->value(),
                'limit' => $limit,
                'offset' => $offset,
                'refresh' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetShareInfo()
    {
        $value = self::randomName();
        $type = self::randomName();
        $id = self::randomName();
        $name = self::randomName();

        $owner = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $grantee = new \Zimbra\Struct\GranteeChooser($type, $id, $name);
     
        $req = new \Zimbra\Admin\Request\GetShareInfo($owner, $grantee);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($owner, $req->getOwner());
        $this->assertSame($grantee, $req->getGrantee());

        $req->setOwner($owner)
            ->setGrantee($grantee);
        $this->assertSame($owner, $req->getOwner());
        $this->assertSame($grantee, $req->getGrantee());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetShareInfoRequest>'
                . '<owner by="' . AccountBy::NAME() . '">' . $value . '</owner>'
                . '<grantee type="' . $type . '" id="' . $id . '" name="' . $name . '" />'
            . '</GetShareInfoRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetShareInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'owner' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'grantee' => [
                    'type' => $type,
                    'id' => $id,
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetSystemRetentionPolicy()
    {
        $value = self::randomName();
        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetSystemRetentionPolicy($cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($cos, $req->getCos());
        $req->setCos($cos);
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetSystemRetentionPolicyRequest>'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</GetSystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetSystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetUCService()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetUCService($ucservice, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($ucservice, $req->getUcService());

        $req->setUcService($ucservice);
        $this->assertSame($ucservice, $req->getUcService());


        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetUCServiceRequest attrs="' . $attrs . '">'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
            . '</GetUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVersionInfo()
    {
        $req = new \Zimbra\Admin\Request\GetVersionInfo();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetVersionInfoRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVersionInfoRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetVolume()
    {
        $id = mt_rand(0, 100);
        $req = new \Zimbra\Admin\Request\GetVolume($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetVolumeRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetXMPPComponent()
    {
        $value = self::randomName();
        $attrs = self::randomName();

        $xmpp = new \Zimbra\Admin\Struct\XmppComponentSelector(XmppBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\GetXMPPComponent($xmpp, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($xmpp, $req->getComponent());

        $req->setComponent($xmpp);
        $this->assertSame($xmpp, $req->getComponent());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetXMPPComponentRequest attrs="' . $attrs . '">'
                . '<xmppcomponent by="' . XmppBy::NAME() . '">' . $value . '</xmppcomponent>'
            . '</GetXMPPComponentRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetXMPPComponentRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'xmppcomponent' => [
                    'by' => XmppBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetZimlet()
    {
        $name = self::randomName();
        $attrs = self::randomName();

        $zimlet = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\GetZimlet($zimlet, [$attrs]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());

        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetZimletRequest attrs="' . $attrs . '">'
                . '<zimlet name="' . $name . '" />'
            . '</GetZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'attrs' => $attrs,
                'zimlet' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testGetZimletStatus()
    {
        $req = new \Zimbra\Admin\Request\GetZimletStatus();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GetZimletStatusRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GetZimletStatusRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\GrantRight($target, $grantee, $right);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<GrantRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>'
            . '</GrantRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'GrantRightRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
                'right' => [
                    'deny' => true,
                    'canDelegate' => false,
                    'disinheritSubGroups' => false,
                    'subDomain' => true,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\MailQueueAction($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MailQueueActionRequest>'
                . '<server name="' . $name . '">'
                    . '<queue name="' . $name . '">'
                        . '<action op="' . QueueAction::HOLD() . '" by="' . QueueActionBy::QUERY() . '">'
                            . '<query limit="' . $limit . '" offset="' . $offset . '">'
                                . '<field name="' . $name . '">'
                                    . '<match value="' . $value . '" />'
                                . '</field>'
                            . '</query>'
                        . '</action>'
                    . '</queue>'
                . '</server>'
            . '</MailQueueActionRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MailQueueActionRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                    'queue' => [
                        'name' => $name,
                        'action' => [
                            'op' => QueueAction::HOLD()->value(),
                            'by' => QueueActionBy::QUERY()->value(),
                            'query' => [
                                'limit' => $limit,
                                'offset' => $offset,
                                'field' => [
                                    [
                                        'name' => $name,
                                        'match' => [
                                            [
                                                'value' => $value
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testMailQueueFlush()
    {
        $name = self::randomName();
        $server = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\MailQueueFlush($server);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($server, $req->getServer());
        $req->setServer($server);
        $this->assertSame($server, $req->getServer());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MailQueueFlushRequest>'
                . '<server name="' . $name . '" />'
            . '</MailQueueFlushRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MailQueueFlushRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'server' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testMigrateAccount()
    {
        $id = self::randomName();
        $action = self::randomValue(['bug72174', 'wiki', 'contactGroup']);

        $migrate = new \Zimbra\Admin\Struct\IdAndAction($id, $action);
        $req = new \Zimbra\Admin\Request\MigrateAccount($migrate);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($migrate, $req->getMigrate());
        $req->setMigrate($migrate);
        $this->assertSame($migrate, $req->getMigrate());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<MigrateAccountRequest>'
                . '<migrate id="' . $id .'" action="' . $action . '" />'
            . '</MigrateAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'MigrateAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'migrate' => [
                    'id' => $id,
                    'action' => $action,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAccount()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyAccount($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyAccountRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyAdminSavedSearches()
    {
        $name = self::randomName();
        $value = self::randomName();

        $search = new \Zimbra\Struct\NamedValue($name, $value);
        $req = new \Zimbra\Admin\Request\ModifyAdminSavedSearches([$search]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame([$search], $req->getSearches()->all());

        $req->addSearch($search);
        $this->assertSame([$search, $search], $req->getSearches()->all());
        $req->getSearches()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyAdminSavedSearchesRequest>'
                . '<search name="' . $name . '">' . $value . '</search>'
            . '</ModifyAdminSavedSearchesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyAdminSavedSearchesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'search' => [
                    [
                        'name' => $name,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyCalendarResource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyCalendarResource($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyCalendarResourceRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyCalendarResourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyConfig()
    {
        $key = self::randomName();
        $value = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyConfig([$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyConfigRequest>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyConfigRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyCos()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyCos($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyCosRequest>'
                . '<id>' . $id . '</id>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDataSource()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $dataSource = new \Zimbra\Struct\Id($id);
        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyDataSource($id, $dataSource, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $req->setId($id)
            ->setDataSource($dataSource);
        $this->assertSame($id, $req->getId());
        $this->assertSame($dataSource, $req->getDataSource());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDataSourceRequest id="' . $id . '">'
                . '<dataSource id="' . $id . '" />'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyDataSourceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDataSourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dataSource' => [
                    'id' => $id,
                ],
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\ModifyDelegatedAdminConstraints(
            TargetType::GROUP(), $id, $name, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame('group', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr], $req->getAttrs()->all());

        $req->setType(TargetType::ACCOUNT())
            ->setId($id)
            ->setName($name)
            ->addAttr($attr);
        $this->assertSame('account', $req->getType()->value());
        $this->assertSame($id, $req->getId());
        $this->assertSame($name, $req->getName());
        $this->assertSame([$attr, $attr], $req->getAttrs()->all());
        $req->getAttrs()->remove(1);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDelegatedAdminConstraintsRequest type="' . TargetType::ACCOUNT() .'" id="' . $id . '" name="' . $name . '">'
                . '<a name="' . $name . '">'
                    . '<constraint>'
                        . '<min>' . $min . '</min>'
                        . '<max>' . $max . '</max>'
                        . '<values>'
                            . '<v>' . $value . '</v>'
                        . '</values>'
                    . '</constraint>'
                . '</a>'
            . '</ModifyDelegatedAdminConstraintsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDelegatedAdminConstraintsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'type' => TargetType::ACCOUNT()->value(),
                'id' => $id,
                'name' => $name,
                'a' => [
                    [
                        'name' => $name,
                        'constraint' => [
                            'min' => $min,
                            'max' => $max,
                            'values' => [
                                'v' => [
                                    $value,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDistributionList()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyDistributionList($id, [$attr]);

        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDistributionListRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyDistributionListRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyDomain()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyDomain($id, [$attr]);

        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyDomainRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyDomainRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyDomainRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyLDAPEntry()
    {
        $key = self::randomName();
        $value = self::randomName();
        $dn = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyLDAPEntry($dn, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($dn, $req->getDn());

        $req->setDn($dn);
        $this->assertSame($dn, $req->getDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyLDAPEntryRequest dn="' . $dn . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyLDAPEntryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyServer()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyServer($id, [$attr]);

        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyServerRequest id="' . $id . '">'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyServerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyServerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifySystemRetentionPolicy()
    {
        $value = self::randomName();
        $id = self::randomName();
        $name = self::randomName();
        $lifetime = self::randomName();

        $cos = new \Zimbra\Admin\Struct\CosSelector(CosBy::NAME(), $value);
        $policy = new \Zimbra\Admin\Struct\Policy(Type::SYSTEM(), $id, $name, $lifetime);

        $req = new \Zimbra\Admin\Request\ModifySystemRetentionPolicy($policy, $cos);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $req->setPolicy($policy)
            ->setCos($cos);
        $this->assertSame($policy, $req->getPolicy());
        $this->assertSame($cos, $req->getCos());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifySystemRetentionPolicyRequest>'
                . '<policy xmlns="urn:zimbraMail" type="' . Type::SYSTEM() . '" id="' . $id . '" name="' . $name . '" lifetime="' . $lifetime . '" />'
                . '<cos by="' . CosBy::NAME() . '">' . $value . '</cos>'
            . '</ModifySystemRetentionPolicyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifySystemRetentionPolicyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'policy' => [
                    '_jsns' => 'urn:zimbraMail',
                    'type' => Type::SYSTEM()->value(),
                    'id' => $id,
                    'name' => $name,
                    'lifetime' => $lifetime,
                ],
                'cos' => [
                    'by' => CosBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyUCService()
    {
        $key = self::randomName();
        $value = self::randomName();
        $id = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $req = new \Zimbra\Admin\Request\ModifyUCService($id, [$attr]);
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);
        $this->assertSame($id, $req->getId());

        $req->setId($id);
        $this->assertSame($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyUCServiceRequest>'
                . '<id>' . $id . '</id>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</ModifyUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testModifyVolume()
    {
        $id = mt_rand(0, 100);
        $threshold = mt_rand(0, 10);
        $mgbits = mt_rand(0, 10);
        $mbits = mt_rand(0, 10);
        $fgbits = mt_rand(0, 10);
        $fbits = mt_rand(0, 10);
        $name = self::randomName();
        $rootpath = self::randomName();

        $volume = new \Zimbra\Admin\Struct\VolumeInfo(
            $id, 2, $threshold, $mgbits, $mbits, $fgbits, $fbits, $name, $rootpath, false, true
        );
        $req = new \Zimbra\Admin\Request\ModifyVolume($id, $volume);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($id, $req->getId());
        $this->assertSame($volume, $req->getVolume());

        $req->setId($id)
            ->setVolume($volume);
        $this->assertSame($id, $req->getId());
        $this->assertSame($volume, $req->getVolume());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyVolumeRequest id="' . $id . '">'
                . '<volume '
                    . 'id="' . $id . '" '
                    . 'type="2" '
                    . 'compressionThreshold="' . $threshold . '" '
                    . 'mgbits="' . $mgbits . '" '
                    . 'mbits="' . $mbits . '" '
                    . 'fgbits="' . $fgbits . '" '
                    . 'fbits="' . $fbits . '" '
                    . 'name="' . $name . '" '
                    . 'rootpath="' . $rootpath . '" '
                    . 'compressBlobs="false" '
                    . 'isCurrent="true" />'
            . '</ModifyVolumeRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'volume' => [
                    'id' => $id,
                    'type' => 2,
                    'compressionThreshold' => $threshold,
                    'mgbits' => $mgbits,
                    'mbits' => $mbits,
                    'fgbits' => $fgbits,
                    'fbits' => $fbits,
                    'name' => $name,
                    'rootpath' => $rootpath,
                    'compressBlobs' => false,
                    'isCurrent' => true,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\ModifyZimlet($zimlet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($zimlet, $req->getZimlet());
        $req->setZimlet($zimlet);
        $this->assertSame($zimlet, $req->getZimlet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ModifyZimletRequest>'
                . '<zimlet name="' . $name . '">'
                    . '<acl cos="' . $cos . '" acl="' . AclType::DENY() . '" />'
                    . '<status value="' . ZimletStatus::DISABLED() . '" />'
                    . '<priority value="' . $value . '" />'
                . '</zimlet>'
            . '</ModifyZimletRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ModifyZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'zimlet' => [
                    'name' => $name,
                    'acl' => [
                        'cos' => $cos,
                        'acl' => AclType::DENY()->value(),
                    ],
                    'status' => [
                        'value' => ZimletStatus::DISABLED()->value(),
                    ],
                    'priority' => [
                        'value' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testNoOp()
    {
        $req = new \Zimbra\Admin\Request\NoOp();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<NoOpRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'NoOpRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPing()
    {
        $req = new \Zimbra\Admin\Request\Ping();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PingRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PingRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeAccountCalendarCache()
    {
        $id = self::randomName();
        $req = new \Zimbra\Admin\Request\PurgeAccountCalendarCache($id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $req->setId($id);
        $this->assertEquals($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeAccountCalendarCacheRequest id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeAccountCalendarCacheRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeFreeBusyQueue()
    {
        $name = self::randomName();
        $provider = new \Zimbra\Struct\NamedElement($name);
        $req = new \Zimbra\Admin\Request\PurgeFreeBusyQueue($provider);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($provider, $req->getProvider());
        $req->setProvider($provider);
        $this->assertEquals($provider, $req->getProvider());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeFreeBusyQueueRequest>'
                . '<provider name="' . $name . '" />'
            . '</PurgeFreeBusyQueueRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeFreeBusyQueueRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'provider' => [
                    'name' => $name,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPurgeMessages()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\PurgeMessages($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $req->setMailbox($mbox);
        $this->assertEquals($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PurgeMessagesRequest>'
                . '<mbox id="' . $id . '" />'
            . '</PurgeMessagesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PurgeMessagesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testPushFreeBusy()
    {
        $name = self::randomName();
        $id = self::randomName();

        $domain = new \Zimbra\Admin\Struct\Names($name);
        $account = new \Zimbra\Struct\Id($id);

        $req = new \Zimbra\Admin\Request\PushFreeBusy($domain, $account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($account, $req->getAccount());

        $req->setDomain($domain)
            ->setAccount($account);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<PushFreeBusyRequest>'
                . '<domain name="' . $name . '" />'
                . '<account id="' . $id . '" />'
            . '</PushFreeBusyRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'PushFreeBusyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => [
                    'name' => $name,
                ],
                'account' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testQueryWaitSet()
    {
        $waitSet = self::randomName();
        $req = new \Zimbra\Admin\Request\QueryWaitSet($waitSet);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($waitSet, $req->getWaitSet());
        $req->setWaitSet($waitSet);
        $this->assertEquals($waitSet, $req->getWaitSet());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<QueryWaitSetRequest waitSet="' . $waitSet . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'QueryWaitSetRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'waitSet' => $waitSet,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRecalculateMailboxCounts()
    {
        $id = self::randomName();
        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\RecalculateMailboxCounts($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $req->setMailbox($mbox);
        $this->assertEquals($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RecalculateMailboxCountsRequest>'
                . '<mbox id="' . $id . '" />'
            . '</RecalculateMailboxCountsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RecalculateMailboxCountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReIndex()
    {
        $id = self::randomName();
        $ids = self::randomName();
        $types = self::randomAttrs(\Zimbra\Enum\ReindexType::enums());

        $mbox = new \Zimbra\Admin\Struct\ReindexMailboxInfo($id, $types, $ids);
        $req = new \Zimbra\Admin\Request\ReIndex($mbox, ReIndexAction::START());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($mbox, $req->getMailbox());
        $this->assertEquals('start', $req->getAction()->value());
        $req->setMailbox($mbox)
            ->setAction(ReIndexAction::CANCEL());
        $this->assertEquals($mbox, $req->getMailbox());
        $this->assertEquals('cancel', $req->getAction()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReIndexRequest action="' . ReIndexAction::CANCEL() . '">'
                . '<mbox id="' . $id . '" types="' . $types . '" ids="' . $ids . '" />'
            . '</ReIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => ReIndexAction::CANCEL()->value(),
                'mbox' => [
                    'id' => $id,
                    'types' => $types,
                    'ids' => $ids,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadLocalConfig()
    {
        $req = new \Zimbra\Admin\Request\ReloadLocalConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReloadLocalConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReloadLocalConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testReloadMemcachedClientConfig()
    {
        $req = new \Zimbra\Admin\Request\ReloadMemcachedClientConfig();
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ReloadMemcachedClientConfigRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ReloadMemcachedClientConfigRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountAlias()
    {
        $alias = self::randomName();
        $id = self::randomName();

        $req = new \Zimbra\Admin\Request\RemoveAccountAlias($alias, $id);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($alias, $req->getAlias());
        $this->assertEquals($id, $req->getId());
        $req->setAlias($alias)
            ->setId($id);
        $this->assertEquals($alias, $req->getAlias());
        $this->assertEquals($id, $req->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveAccountAliasRequest alias="' . $alias . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveAccountAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'alias' => $alias,
                'id' => $id,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveAccountLogger()
    {
        $value = self::randomName();
        $category = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $logger = new \Zimbra\Admin\Struct\LoggerInfo($category, LoggingLevel::ERROR());
        $req = new \Zimbra\Admin\Request\RemoveAccountLogger($account, $logger);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($logger, $req->getLogger());
        $req->setAccount($account)
            ->setLogger($logger);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($logger, $req->getLogger());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveAccountLoggerRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<logger category="' . $category . '" level="' . LoggingLevel::ERROR() . '" />'
            . '</RemoveAccountLoggerRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveAccountLoggerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'logger' => [
                    'category' => $category,
                    'level' => LoggingLevel::ERROR()->value(),
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDevice()
    {
        $value = self::randomName();
        $id = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);
        $req = new \Zimbra\Admin\Request\RemoveDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDeviceRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" />'
            . '</RemoveDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDeviceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDistributionListAlias()
    {
        $id = self::randomName();
        $alias = self::randomName();

        $req = new \Zimbra\Admin\Request\RemoveDistributionListAlias($id, $alias);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($alias, $req->getAlias());
        $req->setId($id)
            ->setAlias($alias);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($alias, $req->getAlias());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDistributionListAliasRequest id="' . $id . '" alias="' . $alias . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDistributionListAliasRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'alias' => $alias,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRemoveDistributionListMember()
    {
        $id = self::randomName();
        $member1 = self::randomName();
        $member2 = self::randomName();

        $req = new \Zimbra\Admin\Request\RemoveDistributionListMember($id, [$member1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals([$member1], $req->getMembers()->all());
        $req->setId($id)
            ->addMember($member2);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals([$member1, $member2], $req->getMembers()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RemoveDistributionListMemberRequest id="' . $id . '">'
                . '<dlm>' . $member1 . '</dlm>'
                . '<dlm>' . $member2 . '</dlm>'
            . '</RemoveDistributionListMemberRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RemoveDistributionListMemberRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'dlm' => [
                    $member1,
                    $member2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameAccount()
    {
        $id = self::randomName();
        $newName = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameAccount($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameAccountRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCalendarResource()
    {
        $id = self::randomName();
        $newName = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameCalendarResource($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameCalendarResourceRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameCalendarResourceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameCos()
    {
        $id = self::randomName();
        $newName = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameCos($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameCosRequest>'
                . '<id>' . $id . '</id>'
                . '<newName>' . $newName . '</newName>'
            . '</RenameCosRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameCosRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameDistributionList()
    {
        $id = self::randomName();
        $newName = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameDistributionList($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameDistributionListRequest id="' . $id . '" newName="' . $newName . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameDistributionListRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameLDAPEntry()
    {
        $dn = self::randomName();
        $newDn = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameLDAPEntry($dn, $newDn);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($dn, $req->getDn());
        $this->assertEquals($newDn, $req->getNewDn());
        $req->setDn($dn)
            ->setNewDn($newDn);
        $this->assertEquals($dn, $req->getDn());
        $this->assertEquals($newDn, $req->getNewDn());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameLDAPEntryRequest dn="' . $dn . '" new_dn="' . $newDn . '" />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameLDAPEntryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'dn' => $dn,
                'new_dn' => $newDn,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRenameUCService()
    {
        $id = self::randomName();
        $newName = self::randomName();

        $req = new \Zimbra\Admin\Request\RenameUCService($id, $newName);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());
        $req->setId($id)
            ->setNewName($newName);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newName, $req->getNewName());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RenameUCServiceRequest>'
                . '<id>' . $id . '</id>'
                . '<newName>' . $newName . '</newName>'
            . '</RenameUCServiceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RenameUCServiceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newName' => $newName,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testResetAllLoggers()
    {
        $req = new \Zimbra\Admin\Request\ResetAllLoggers;
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ResetAllLoggersRequest />';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ResetAllLoggersRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testResumeDevice()
    {
        $id = self::randomName();
        $value = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);
        $req = new \Zimbra\Admin\Request\ResumeDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<ResumeDeviceRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" />'
            . '</ResumeDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'ResumeDeviceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\RevokeRight($target, $grantee, $right);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $req->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $req->getTarget());
        $this->assertSame($grantee, $req->getGrantee());
        $this->assertSame($right, $req->getRight());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RevokeRightRequest>'
                . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '">' . $value . '</target>'
                . '<grantee type="' . GranteeType::USR() . '" by="' . GranteeBy::ID() . '" secret="' . $secret . '" all="true">' . $value . '</grantee>'
                . '<right deny="true" canDelegate="false" disinheritSubGroups="false" subDomain="true">' . $value . '</right>'
            . '</RevokeRightRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RevokeRightRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'target' => [
                    'type' => TargetType::ACCOUNT()->value(),
                    '_content' => $value,
                    'by' => TargetBy::NAME()->value(),
                ],
                'grantee' => [
                    '_content' => $value,
                    'type' => GranteeType::USR()->value(),
                    'by' => GranteeBy::ID()->value(),
                    'secret' => $secret,
                    'all' => true,
                ],
                'right' => [
                    'deny' => true,
                    'canDelegate' => false,
                    'disinheritSubGroups' => false,
                    'subDomain' => true,
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testRunUnitTests()
    {
        $test1 = self::randomName();
        $test2 = self::randomName();

        $req = new \Zimbra\Admin\Request\RunUnitTests([$test1]);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals([$test1], $req->getTests()->all());
        $req->addTest($test2);
        $this->assertEquals([$test1, $test2], $req->getTests()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<RunUnitTestsRequest>'
                . '<test>' . $test1 . '</test>'
                . '<test>' . $test2 . '</test>'
            . '</RunUnitTestsRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'RunUnitTestsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'test' => [
                    $test1,
                    $test2,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\SearchAccounts(
            $query, $limit, $offset, $domain, false, $attrs, $sortBy, $types, true 
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertEquals($attrs, $req->getAttrs());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertEquals($types, $req->getTypes());
        $this->assertTrue($req->getSortAscending());

        $req->setQuery($query)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setAttrs($attrs)
            ->setSortBy($sortBy)
            ->setTypes($types)
            ->setSortAscending(false);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertEquals($attrs, $req->getAttrs());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertEquals($types, $req->getTypes());
        $this->assertFalse($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchAccountsRequest '
                . 'query="' . $query . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'attrs="' . $attrs . '" '
                . 'sortBy="' . $sortBy . '" '
                . 'types="' . $types . '" '
                . 'sortAscending="false" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchAccountsRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'attrs' => $attrs,
                'sortBy' => $sortBy,
                'types' => $types,
                'sortAscending' => false,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        $req = new \Zimbra\Admin\Request\SearchAutoProvDirectory(
            $domain, $keyAttr, $query, $name, $maxResults, $limit, $offset, false, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($keyAttr, $req->getKeyAttr());
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertFalse($req->getRefresh());

        $req->setDomain($domain)
            ->setKeyAttr($keyAttr)
            ->setQuery($query)
            ->setName($name)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setRefresh(true);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($keyAttr, $req->getKeyAttr());
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertTrue($req->getRefresh());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchAutoProvDirectoryRequest '
                . 'keyAttr="' . $keyAttr . '" '
                . 'query="' . $query . '" '
                . 'name="' . $name . '" '
                . 'maxResults="' . $maxResults . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'refresh="true" '
                . 'attrs="' . $attrs . '">'
                . '<domain by="' . DomainBy::NAME() . '">' . $value . '</domain>'
            . '</SearchAutoProvDirectoryRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchAutoProvDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'keyAttr' => $keyAttr,
                'query' => $query,
                'name' => $name,
                'maxResults' => $maxResults,
                'limit' => $limit,
                'offset' => $offset,
                'refresh' => true,
                'attrs' => $attrs,
                'domain' => [
                    'by' => DomainBy::NAME()->value(),
                    '_content' => $value,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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
        
        $req = new \Zimbra\Admin\Request\SearchCalendarResources(
            $searchFilter, $limit, $offset, $domain, false, $sortBy, true, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($searchFilter, $req->getSearchFilter());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());

        $req->setSearchFilter($searchFilter)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setSortBy($sortBy)
            ->setSortAscending(false);
        $this->assertEquals($searchFilter, $req->getSearchFilter());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchCalendarResourcesRequest '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'sortBy="' . $sortBy . '" '
                . 'sortAscending="false" '
                . 'attrs="' . $attrs . '">'
                . '<searchFilter>'
                    . '<conds not="true" or="false">'
                        . '<conds not="false" or="true">'
                            . '<cond attr="' . $attr . '" op="' . CondOp::GE() . '" value="' . $value . '" not="false" />'
                        . '</conds>'
                        . '<cond attr="' . $attr . '" op="' . CondOp::EQ() . '" value="' . $value . '" not="true" />'
                    . '</conds>'
                . '</searchFilter>'
            . '</SearchCalendarResourcesRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchCalendarResourcesRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'sortBy' => $sortBy,
                'sortAscending' => false,
                'attrs' => $attrs,
                'searchFilter' => [
                    'conds' => [
                        'not' => true,
                        'or' => false,
                        'conds' => [
                            [
                                'not' => false,
                                'or' => true,
                                'cond' => [
                                    [
                                        'attr' => $attr,
                                        'op' => CondOp::GE()->value(),
                                        'value' => $value,
                                        'not' => false,
                                    ],
                                ],
                            ],
                        ],
                        'cond' => [
                            [
                                'attr' => $attr,
                                'op' => CondOp::EQ()->value(),
                                'value' => $value,
                                'not' => true,
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
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

        $req = new \Zimbra\Admin\Request\SearchDirectory(
            $query, $maxResults, $limit, $offset, $domain, false, true, [DirSearchType::RESOURCES()], $sortBy, true, false, [$attrs]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertFalse($req->getApplyCos());
        $this->assertTrue($req->getApplyConfig());
        $this->assertEquals('resources', $req->getTypes());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertTrue($req->getSortAscending());
        $this->assertFalse($req->getCountOnly());

        $req->setQuery($query)
            ->setMaxResults($maxResults)
            ->setLimit($limit)
            ->setOffset($offset)
            ->setDomain($domain)
            ->setApplyCos(true)
            ->setApplyConfig(false)
            ->addType(DirSearchType::ACCOUNTS())
            ->setSortBy($sortBy)
            ->setSortAscending(false)
            ->setCountOnly(true);
        $this->assertEquals($query, $req->getQuery());
        $this->assertEquals($maxResults, $req->getMaxResults());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals($offset, $req->getOffset());
        $this->assertEquals($domain, $req->getDomain());
        $this->assertTrue($req->getApplyCos());
        $this->assertFalse($req->getApplyConfig());
        $this->assertEquals('resources,accounts', $req->getTypes());
        $this->assertEquals($sortBy, $req->getSortBy());
        $this->assertFalse($req->getSortAscending());
        $this->assertTrue($req->getCountOnly());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchDirectoryRequest '
                . 'query="' . $query . '" '
                . 'maxResults="' . $maxResults . '" '
                . 'limit="' . $limit . '" '
                . 'offset="' . $offset . '" '
                . 'domain="' . $domain . '" '
                . 'applyCos="true" '
                . 'applyConfig="false" '
                . 'types="resources,accounts" '
                . 'sortBy="' . $sortBy . '" '
                . 'sortAscending="false" '
                . 'countOnly="true" '
                . 'attrs="' . $attrs . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchDirectoryRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'query' => $query,
                'maxResults' => $maxResults,
                'limit' => $limit,
                'offset' => $offset,
                'domain' => $domain,
                'applyCos' => true,
                'applyConfig' => false,
                'types' => 'resources,accounts',
                'sortBy' => $sortBy,
                'sortAscending' => false,
                'countOnly' => true,
                'attrs' => $attrs,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSearchGal()
    {
        $domain = self::randomName();
        $name = self::randomName();
        $galAcctId = self::randomName();
        $limit = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\SearchGal(
            $domain, $name, $limit, GalSearchType::ALL(), $galAcctId
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals('all', $req->getType()->value());
        $this->assertEquals($galAcctId, $req->getGalAccounttId());

        $req->setDomain($domain)
            ->setName($name)
            ->setLimit($limit)
            ->setType(GalSearchType::ACCOUNT())
            ->setGalAccounttId($galAcctId);
        $this->assertEquals($domain, $req->getDomain());
        $this->assertEquals($name, $req->getName());
        $this->assertEquals($limit, $req->getLimit());
        $this->assertEquals('account', $req->getType()->value());
        $this->assertEquals($galAcctId, $req->getGalAccounttId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SearchGalRequest '
                . 'domain="' . $domain . '" '
                . 'name="' . $name . '" '
                . 'limit="' . $limit . '" '
                . 'type="' . GalSearchType::ACCOUNT() . '" '
                . 'galAcctId="' . $galAcctId . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SearchGalRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'domain' => $domain,
                'name' => $name,
                'limit' => $limit,
                'type' => GalSearchType::ACCOUNT()->value(),
                'galAcctId' => $galAcctId,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetCurrentVolume()
    {
        $id = mt_rand(0, 100);
        $req = new \Zimbra\Admin\Request\SetCurrentVolume($id, VolumeType::PRIMARY());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals(1, $req->getType()->value());
        $req->setId($id)
            ->setType(VolumeType::SECONDARY());
        $this->assertEquals($id, $req->getId());
        $this->assertEquals(2, $req->getType()->value());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetCurrentVolumeRequest '
                . 'id="' . $id . '" '
                . 'type="' . VolumeType::SECONDARY() . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetCurrentVolumeRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'type' => VolumeType::SECONDARY()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSetPassword()
    {
        $id = self::randomName();
        $newPassword = self::randomName();

        $req = new \Zimbra\Admin\Request\SetPassword($id, $newPassword);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newPassword, $req->getNewPassword());
        $req->setId($id)
            ->setNewPassword($newPassword);
        $this->assertEquals($id, $req->getId());
        $this->assertEquals($newPassword, $req->getNewPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SetPasswordRequest '
                . 'id="' . $id . '" '
                . 'newPassword="' . $newPassword . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SetPasswordRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'id' => $id,
                'newPassword' => $newPassword,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSuspendDevice()
    {
        $id = self::randomName();
        $value = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\DeviceId($id);
        $req = new \Zimbra\Admin\Request\SuspendDevice($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SuspendDeviceRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" />'
            . '</SuspendDeviceRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SuspendDeviceRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testSyncGalAccount()
    {
        $id = self::randomName();
        $value = self::randomName();

        $ds = new \Zimbra\Admin\Struct\SyncGalAccountDataSourceSpec(DataSourceBy::NAME(), $value, false, true);
        $account = new \Zimbra\Admin\Struct\SyncGalAccountSpec($id, [$ds]);

        $req = new \Zimbra\Admin\Request\SyncGalAccount($account);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($account, $req->getAccount());
        $req->setAccount($account);
        $this->assertSame($account, $req->getAccount());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<SyncGalAccountRequest>'
                . '<account id="' . $id . '">'
                    . '<datasource by="' . DataSourceBy::NAME() . '" fullSync="false" reset="true">' . $value . '</datasource>'
                . '</account>'
            . '</SyncGalAccountRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'SyncGalAccountRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'id' => $id,
                    'datasource' => [
                        [
                            'by' => DataSourceBy::NAME()->value(),
                            'fullSync' => false,
                            'reset' => true,
                            '_content' => $value,
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUndeployZimlet()
    {
        $name = self::randomName();
        $action = self::randomName();
        $req = new \Zimbra\Admin\Request\UndeployZimlet($name, $action);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($name, $req->getName());
        $this->assertSame($action, $req->getAction());
        $req->setName($name)
            ->setAction($action);
        $this->assertSame($name, $req->getName());
        $this->assertSame($action, $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UndeployZimletRequest '
                . 'name="' . $name . '" '
                . 'action="' . $action . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UndeployZimletRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'name' => $name,
                'action' => $action,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdateDeviceStatus()
    {
        $value = self::randomName();
        $id = self::randomName();
        $status = self::randomName();

        $account = new \Zimbra\Struct\AccountSelector(AccountBy::NAME(), $value);
        $device = new \Zimbra\Admin\Struct\IdStatus($id, $status);
        $req = new \Zimbra\Admin\Request\UpdateDeviceStatus($account, $device);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);

        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());
        $req->setAccount($account)
            ->setDevice($device);
        $this->assertSame($account, $req->getAccount());
        $this->assertSame($device, $req->getDevice());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UpdateDeviceStatusRequest>'
                . '<account by="' . AccountBy::NAME() . '">' . $value . '</account>'
                . '<device id="' . $id . '" status="' . $status . '" />'
            . '</UpdateDeviceStatusRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UpdateDeviceStatusRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'account' => [
                    'by' => AccountBy::NAME()->value(),
                    '_content' => $value,
                ],
                'device' => [
                    'id' => $id,
                    'status' => $status,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUpdatePresenceSessionId()
    {
        $key = self::randomName();
        $value = self::randomName();
        $username = self::randomName();
        $password = self::randomName();

        $attr = new \Zimbra\Struct\KeyValuePair($key, $value);
        $ucservice = new \Zimbra\Admin\Struct\UcServiceSelector(UcServiceBy::NAME(), $value);
        $req = new \Zimbra\Admin\Request\UpdatePresenceSessionId(
            $ucservice, $username, $password, [$attr]
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\BaseAttr', $req);

        $this->assertSame($ucservice, $req->getUcService());
        $this->assertSame($username, $req->getUserName());
        $this->assertSame($password, $req->getPassword());
        $req->setUcService($ucservice)
            ->setUserName($username)
            ->setPassword($password);
        $this->assertSame($ucservice, $req->getUcService());
        $this->assertSame($username, $req->getUserName());
        $this->assertSame($password, $req->getPassword());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UpdatePresenceSessionIdRequest>'
                . '<ucservice by="' . UcServiceBy::NAME() . '">' . $value . '</ucservice>'
                . '<username>' . $username . '</username>'
                . '<password>' . $password . '</password>'
                . '<a n="' . $key . '">' . $value . '</a>'
            . '</UpdatePresenceSessionIdRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UpdatePresenceSessionIdRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'ucservice' => [
                    'by' => UcServiceBy::NAME()->value(),
                    '_content' => $value,
                ],
                'username' => $username,
                'password' => $password,
                'a' => [
                    [
                        'n' => $key,
                        '_content' => $value,
                    ],
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadDomCert()
    {
        $certAid = self::randomName();
        $certFilename = self::randomName();
        $keyAid = self::randomName();
        $keyFilename = self::randomName();

        $req = new \Zimbra\Admin\Request\UploadDomCert(
            $certAid, $certFilename, $keyAid, $keyFilename
        );
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());
        $this->assertEquals($keyAid, $req->getKeyAid());
        $this->assertEquals($keyFilename, $req->getKeyFilename());

        $req->setCertAid($certAid)
            ->setCertFilename($certFilename)
            ->setKeyAid($keyAid)
            ->setKeyFilename($keyFilename);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());
        $this->assertEquals($keyAid, $req->getKeyAid());
        $this->assertEquals($keyFilename, $req->getKeyFilename());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UploadDomCertRequest '
                . 'cert.aid="' . $certAid . '" '
                . 'cert.filename="' . $certFilename . '" '
                . 'key.aid="' . $keyAid . '" '
                . 'key.filename="' . $keyFilename . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadDomCertRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert.aid' => $certAid,
                'cert.filename' => $certFilename,
                'key.aid' => $keyAid,
                'key.filename' => $keyFilename,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testUploadProxyCA()
    {
        $certAid = self::randomName();
        $certFilename = self::randomName();
        $req = new \Zimbra\Admin\Request\UploadProxyCA($certAid, $certFilename);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());

        $req->setCertAid($certAid)
            ->setCertFilename($certFilename);
        $this->assertEquals($certAid, $req->getCertAid());
        $this->assertEquals($certFilename, $req->getCertFilename());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<UploadProxyCARequest '
                . 'cert.aid="' . $certAid . '" '
                . 'cert.filename="' . $certFilename . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'UploadProxyCARequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert.aid' => $certAid,
                'cert.filename' => $certFilename,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyCertKey()
    {
        $cert = self::randomName();
        $privkey = self::randomName();
        $req = new \Zimbra\Admin\Request\VerifyCertKey($cert, $privkey);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($cert, $req->getCert());
        $this->assertEquals($privkey, $req->getPrivateKey());

        $req->setCert($cert)
            ->setPrivateKey($privkey);
        $this->assertEquals($cert, $req->getCert());
        $this->assertEquals($privkey, $req->getPrivateKey());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyCertKeyRequest '
                . 'cert="' . $cert . '" '
                . 'privkey="' . $privkey . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyCertKeyRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'cert' => $cert,
                'privkey' => $privkey,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyIndex()
    {
        $id = self::randomName();

        $mbox = new \Zimbra\Admin\Struct\MailboxByAccountIdSelector($id);
        $req = new \Zimbra\Admin\Request\VerifyIndex($mbox);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertSame($mbox, $req->getMailbox());

        $req->setMailbox($mbox);
        $this->assertSame($mbox, $req->getMailbox());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyIndexRequest>'
                . '<mbox id="' . $id . '" />'
            . '</VerifyIndexRequest>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyIndexRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'mbox' => [
                    'id' => $id,
                ],
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVerifyStoreManager()
    {
        $size = mt_rand(0, 100);
        $num = mt_rand(0, 100);

        $req = new \Zimbra\Admin\Request\VerifyStoreManager($size, $num, false);
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals($size, $req->getFileSize());
        $this->assertEquals($num, $req->getNum());
        $this->assertFalse($req->getCheckBlobs());

        $req->setFileSize($size)
            ->setNum($num)
            ->setCheckBlobs(true);
        $this->assertEquals($size, $req->getFileSize());
        $this->assertEquals($num, $req->getNum());
        $this->assertTrue($req->getCheckBlobs());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VerifyStoreManagerRequest '
                . 'fileSize="' . $size . '" '
                . 'num="' . $num . '" '
                . 'checkBlobs="true" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VerifyStoreManagerRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'fileSize' => $size,
                'num' => $num,
                'checkBlobs' => true,
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }

    public function testVersionCheck()
    {
        $req = new \Zimbra\Admin\Request\VersionCheck(VersionCheckAction::STATUS());
        $this->assertInstanceOf('Zimbra\Admin\Request\Base', $req);
        $this->assertEquals('status', $req->getAction());
        $req->setAction(VersionCheckAction::CHECK());
        $this->assertEquals('check', $req->getAction());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<VersionCheckRequest '
                . 'action="' . VersionCheckAction::CHECK() . '" '
            . '/>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $req);

        $array = [
            'VersionCheckRequest' => [
                '_jsns' => 'urn:zimbraAdmin',
                'action' => VersionCheckAction::CHECK()->value(),
            ],
        ];
        $this->assertEquals($array, $req->toArray());
    }
}
