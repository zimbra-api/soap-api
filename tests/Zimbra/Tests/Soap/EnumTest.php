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
            $this->assertTrue(\Zimbra\Soap\Enum\AccountBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\Action::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\AuthScheme::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\AutoProvPrincipalBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\CacheEntryBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\CalendarResourceBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\CosBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\CountObjectsType::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DataSourceType::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DedupAction::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListGranteeBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DistributionListSubscribeOp::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\DomainBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\GalMode::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\GalSearchType::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\GetSessionsSortBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\GranteeBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\GranteeType::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\LoggingLevel::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\MemberOfSelector::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\Operation::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\QueueAction::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\QueueActionBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\ServerBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\TargetBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\TargetType::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\Type::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\UcServiceBy::isValid($value));
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
            $this->assertTrue(\Zimbra\Soap\Enum\XmppComponentBy::isValid($value));
        }
    }
}
