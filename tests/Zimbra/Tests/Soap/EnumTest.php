<?php

namespace Zimbra\Tests\Soap;

use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for soap enum.
 */
class EnumTest extends ZimbraTestCase
{
    public function testAccountBy()
    {
        $values = array(
            'adminName',
            'appAdminName',
            'id',
            'foreignPrincipal',
            'name',
            'krb5Principal',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AccountBy::has($value));
        }
    }

    public function testAceRightType()
    {
        $values = array(
            'viewFreeBusy',
            'invite',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AceRightType::has($value));
        }
    }

    public function testAclType()
    {
        $values = array(
            'grant',
            'deny',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AclType::has($value));
        }
    }

    public function testAction()
    {
        $values = array(
            'edit',
            'revoke',
            'expire',
            'start',
            'status',
            'stop',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\Action::has($value));
        }
    }

    public function testAttrMethod()
    {
        $values = array(
            'getAttrs',
            'setAttrs',
            'getAttrs,setAttrs',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AttrMethod::has($value));
        }
    }

    public function testAuthScheme()
    {
        $values = array(
            'basic',
            'form',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AuthScheme::has($value));
        }
    }

    public function testAutoProvPrincipalBy()
    {
        $values = array(
            'dn',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AutoProvPrincipalBy::has($value));
        }
    }

    public function testAutoProvTaskAction()
    {
        $values = array(
            'start',
            'status',
            'stop',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\AutoProvTaskAction::has($value));
        }
    }
    public function testCacheEntryBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CacheEntryBy::has($value));
        }
    }

    public function testCacheType()
    {
        $values = array(
            'skin',
            'locale',
            'account',
            'cos',
            'domain',
            'server',
            'zimlet',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CacheType::has($value));
        }
    }

    public function testCalendarResourceBy()
    {
        $values = array(
            'id',
            'foreignPrincipal',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CalendarResourceBy::has($value));
        }
    }

    public function testCompactIndexAction()
    {
        $values = array(
            'start',
            'status',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CompactIndexAction::has($value));
        }
    }

    public function testContentType()
    {
        $values = array(
            'text/plain',
            'text/html',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\ContentType::has($value));
        }
    }

    public function testCosBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CosBy::has($value));
        }
    }

    public function testCountObjectsType()
    {
        $values = array(
            'userAccount',
            'account',
            'alias',
            'dl',
            'domain',
            'cos',
            'server',
            'calresource',
            'accountOnUCService',
            'cosOnUCService',
            'domainOnUCService',
            'internalUserAccount',
            'internalArchivingAccount',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CountObjectsType::has($value));
        }
    }

    public function testCSRKeySize()
    {
        $values = array(
            1024,
            2048,
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CSRKeySize::has($value));
        }
    }

    public function testCSRType()
    {
        $values = array(
            'self',
            'comm',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\CSRType::has($value));
        }
    }

    public function testDataSourceBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DataSourceBy::has($value));
        }
    }

    public function testDataSourceType()
    {
        $values = array(
            'pop3',
            'imap',
            'caldav',
            'contacts',
            'yab',
            'rss',
            'cal',
            'gal',
            'xsync',
            'tagmap',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DataSourceType::has($value));
        }
    }

    public function testDedupAction()
    {
        $values = array(
            'start',
            'status',
            'stop',
            'reset',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DedupAction::has($value));
        }
    }

    public function testDeployZimletAction()
    {
        $values = array(
            'deployAll',
            'deployLocal',
            'status',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DeployZimletAction::has($value));
        }
    }

    public function testDistributionListBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListBy::has($value));
        }
    }

    public function testDistributionListGranteeBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListGranteeBy::has($value));
        }
    }

    public function testDistributionListSubscribeOp()
    {
        $values = array(
            'subscribe',
            'unsubscribe',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListSubscribeOp::has($value));
        }
    }

    public function testDomainBy()
    {
        $values = array(
            'id',
            'name',
            'virtualHostname',
            'krb5Realm',
            'foreignName',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\DomainBy::has($value));
        }
    }

    public function testGalConfigAction()
    {
        $values = array(
            'autocomplete',
            'search',
            'sync',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GalConfigAction::has($value));
        }
    }

    public function testGalMode()
    {
        $values = array(
            'both',
            'ldap',
            'zimbra',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GalMode::has($value));
        }
    }

    public function testGalSearchType()
    {
        $values = array(
            'all',
            'account',
            'resource',
            'group',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GalSearchType::has($value));
        }
    }

    public function testGetSessionsSortBy()
    {
        $values = array(
            'nameAsc',
            'nameDesc',
            'createdAsc',
            'createdDesc',
            'accessedAsc',
            'accessedDesc',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GetSessionsSortBy::has($value));
        }
    }

    public function testGranteeBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GranteeBy::has($value));
        }
    }

    public function testGranteeType()
    {
        $values = array(
            'usr',
            'grp',
            'egp',
            'all',
            'dom',
            'gst',
            'key',
            'pub',
            'email',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\GranteeType::has($value));
        }
    }

    public function testInterestType()
    {
        $values = array(
            'f',
            'm',
            'c',
            'a',
            't',
            'd',
            'all',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\InterestType::has($value));
        }
    }

    public function testIpType()
    {
        $values = array(
            'ipV4',
            'ipV6',
            'both',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\IpType::has($value));
        }
    }

    public function testLoggingLevel()
    {
        $values = array(
            'error',
            'warn',
            'info',
            'debug',
            'trace',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\LoggingLevel::has($value));
        }
    }

    public function testMemberOfSelector()
    {
        $values = array(
            'all',
            'directOnly',
            'none',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\MemberOfSelector::has($value));
        }
    }

    public function testOperation()
    {
        $values = array(
            'delete',
            'modify',
            'rename',
            'addOwners',
            'removeOwners',
            'setOwners',
            'grantRights',
            'revokeRights',
            'setRights',
            'addMembers',
            'removeMembers',
            'acceptSubsReq',
            'rejectSubsReq',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\Operation::has($value));
        }
    }

    public function testParticipationStatus()
    {
        $values = array(
            'NE',
            'AC',
            'TE',
            'DE',
            'DG',
            'CO',
            'IN',
            'WE',
            'DF',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\ParticipationStatus::has($value));
        }
    }

    public function testQueueAction()
    {
        $values = array(
            'hold',
            'release',
            'delete',
            'requeue',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\QueueAction::has($value));
        }
    }

    public function testQueueActionBy()
    {
        $values = array(
            'id',
            'query',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\QueueActionBy::has($value));
        }
    }

    public function testQuotaSortBy()
    {
        $values = array(
            'percentUsed',
            'totalUsed',
            'quotaLimit',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\QuotaSortBy::has($value));
        }
    }

    public function testReIndexAction()
    {
        $values = array(
            'start',
            'status',
            'cancel',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\ReIndexAction::has($value));
        }
    }

    public function testRightClass()
    {
        $values = array(
            'ADMIN',
            'USER',
            'ALL',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\RightClass::has($value));
        }
    }

    public function testSectionType()
    {
        $values = array(
            'mbox',
            'prefs',
            'attrs',
            'zimlets',
            'props',
            'idents',
            'sigs',
            'dsrcs',
            'children',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\SectionType::has($value));
        }
    }

    public function testServerBy()
    {
        $values = array(
            'id',
            'name',
            'serviceHostname',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\ServerBy::has($value));
        }
    }

    public function testSessionType()
    {
        $values = array(
            'soap',
            'imap',
            'admin',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\SessionType::has($value));
        }
    }

    public function testSortBy()
    {
        $values = array(
            'none',
            'dateAsc',
            'dateDesc',
            'subjAsc',
            'subjDesc',
            'nameAsc',
            'nameDesc',
            'rcptAsc',
            'rcptDesc',
            'attachAsc',
            'attachDesc',
            'flagAsc',
            'flagDesc',
            'priorityAsc',
            'priorityDesc',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\SortBy::has($value));
        }
    }

    public function testTargetBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\TargetBy::has($value));
        }
    }

    public function testTargetType()
    {
        $values = array(
            'account',
            'calresource',
            'cos',
            'dl',
            'group',
            'domain',
            'server',
            'ucservice',
            'xmppcomponent',
            'zimlet',
            'config',
            'global',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\TargetType::has($value));
        }
    }

    public function testType()
    {
        $values = array(
            'user',
            'system',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\Type::has($value));
        }
    }

    public function testUcServiceBy()
    {
        $values = array(
            'id',
            'name',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\UcServiceBy::has($value));
        }
    }

    public function testVersionCheckAction()
    {
        $values = array(
            'check',
            'status',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\VersionCheckAction::has($value));
        }
    }

    public function testVolumeType()
    {
        $values = array(1, 2, 10);
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\VolumeType::has($value));
        }
    }

    public function testXmppComponentBy()
    {
        $values = array(
            'id',
            'name',
            'serviceHostname',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\XmppComponentBy::has($value));
        }
    }

    public function testZimletStatus()
    {
        $values = array(
            'enabled',
            'disabled',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Soap\Enum\ZimletStatus::has($value));
        }
    }
}
