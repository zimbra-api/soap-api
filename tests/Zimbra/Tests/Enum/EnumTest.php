<?php

namespace Zimbra\Tests\Enum;

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
            $this->assertTrue(\Zimbra\Enum\AccountBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AceRightType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AclType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\Action::has($value));
        }
    }

    public function testAlarmAction()
    {
        $values = array(
            'DISPLAY',
            'AUDIO',
            'EMAIL',
            'PROCEDURE',
            'X_YAHOO_CALENDAR_ACTION_IM',
            'X_YAHOO_CALENDAR_ACTION_MOBILE',
        );

        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\AlarmAction::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AttrMethod::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AuthScheme::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AutoProvPrincipalBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\AutoProvTaskAction::has($value));
        }
    }

    public function testBrowseBy()
    {
        $values = array(
            'domains',
            'attachments',
            'objects',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\BrowseBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CacheEntryBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CacheType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CalendarResourceBy::has($value));
        }
    }

    public function testCertType()
    {
        $values = array(
            'all',
            'mta',
            'ldap',
            'mailboxd',
            'proxy',
            'staged',
        );

        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\CertType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CompactIndexAction::has($value));
        }
    }

    public function testContactActionOp()
    {
        $values = array(
            'move',
            'delete',
            'flag',
            'trash',
            'tag',
            'update',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\ContactActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\ContentType::has($value));
        }
    }

    public function testConvActionOp()
    {
        $values = array(
            'delete',
            'read',
            'flag',
            'priority',
            'tag',
            'move',
            'spam',
            'trash',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\ConvActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CosBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CountObjectsType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CSRKeySize::has($value));
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
            $this->assertTrue(\Zimbra\Enum\CSRType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DataSourceBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DataSourceType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DedupAction::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DeployZimletAction::has($value));
        }
    }

    public function testDirectorySearchType()
    {
        $values = array(
            'accounts',
            'distributionlists',
            'aliases',
            'resources',
            'domains',
            'coses',
        );

        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\DirectorySearchType::has($value));
        }
    }

    public function testDistributionListActionOp()
    {
        $values = array(
            'delete',
            'rename',
            'modify',
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
            $this->assertTrue(\Zimbra\Enum\DistributionListActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DistributionListBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DistributionListGranteeBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DistributionListSubscribeOp::has($value));
        }
    }

    public function testDocumentActionOp()
    {
        $values = array(
            'watch',
            '!watch',
            'grant',
            '!grant',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\DocumentActionOp::has($value));
        }
    }

    public function testDocumentGrantType()
    {
        $values = array(
            'all',
            'pub',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\DocumentGrantType::has($value));
        }
    }

    public function testDocumentPermission()
    {
        $values = array(
            'r',
            'w',
            'd',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\DocumentPermission::has($value));
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
            $this->assertTrue(\Zimbra\Enum\DomainBy::has($value));
        }
    }

    public function testEntryType()
    {
        $values = array(
            'account',
            'alias',
            'distributionList',
            'cos',
            'globalConfig',
            'domain',
            'server',
            'mimeEntry',
            'zimletEntry',
            'calendarResource',
            'identity',
            'dataSource',
            'pop3DataSource',
            'imapDataSource',
            'rssDataSource',
            'liveDataSource',
            'galDataSource',
            'signature',
            'xmppComponent',
            'aclTarget',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\EntryType::has($value));
        }
    }

    public function testFilterCondition()
    {
        $values = array(
            'allof',
            'anyof',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\FilterCondition::has($value));
        }
    }

    public function testFolderActionOp()
    {
        $values = array(
            'read',
            'delete',
            'rename',
            'move',
            'trash',
            'empty',
            'color',
            'grant',
            '!grant',
            'revokeorphangrants',
            'url',
            'import',
            'sync',
            'fb',
            'check',
            '!check',
            'update',
            'syncon',
            '!syncon',
            'retentionpolicy',
            'disableactivesync',
            '!disableactivesync',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\FolderActionOp::has($value));
        }
    }

    public function testFreeBusyStatus()
    {
         $values = array(
            'F',
            'B',
            'T',
            'U',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\FreeBusyStatus::has($value));
        }
   }

   public function testFrequency()
   {
        $values = array(
            'SEC',
            'MIN',
            'HOU',
            'DAI',
            'WEE',
            'MON',
            'YEA',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\Frequency::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GalConfigAction::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GalMode::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GalSearchType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GetSessionsSortBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GranteeBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\GranteeType::has($value));
        }
    }

    public function testImportance()
    {
        $values = array(
            'high',
            'normal',
            'low',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\Importance::has($value));
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
            $this->assertTrue(\Zimbra\Enum\InterestType::has($value));
        }
    }

    public function testInviteChange()
    {
        $values = array(
            'subject',
            'location',
            'time',
            'recurrence',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\InviteChange::has($value));
        }
    }

    public function testInviteClass()
    {
        $values = array(
            'PUB',
            'PRI',
            'CON',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\InviteClass::has($value));
        }
    }

    public function testInviteStatus()
    {
        $values = array(
            'TENT',
            'CONF',
            'CANC',
            'COMP',
            'INPR',
            'WAITING',
            'DEFERRED',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\InviteStatus::has($value));
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
            $this->assertTrue(\Zimbra\Enum\IpType::has($value));
        }
    }

    public function testItemActionOp()
    {
        $values = array(
            'delete',
            'dumpsterdelete',
            'recover',
            'read',
            'flag',
            'priority',
            'tag',
            'move',
            'trash',
            'rename',
            'update',
            'color',
            'lock',
            'unlock',
        );
        
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\ItemActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\LoggingLevel::has($value));
        }
    }

    public function testMdsConnectionType()
    {
        $values = array(
            'cleartext',
            'ssl',
            'tls',
            'tls_is_available',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\MdsConnectionType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\MemberOfSelector::has($value));
        }
    }

    public function testMsgActionOp()
    {
        $values = array(
            'delete',
            'read',
            'flag',
            'tag',
            'move',
            'update',
            'spam',
            'trash',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\MsgActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\Operation::has($value));
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
            $this->assertTrue(\Zimbra\Enum\ParticipationStatus::has($value));
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
            $this->assertTrue(\Zimbra\Enum\QueueAction::has($value));
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
            $this->assertTrue(\Zimbra\Enum\QueueActionBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\QuotaSortBy::has($value));
        }
    }

    public function testRankingActionOp()
    {
        $values = array(
            'reset',
            'delete',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\RankingActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\ReIndexAction::has($value));
        }
    }

    public function testReindexType()
    {
        $values = array(
            'conversation',
            'message',
            'contact',
            'appointment',
            'task',
            'note',
            'wiki',
            'document',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\ReindexType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\RightClass::has($value));
        }
    }

    public function testSearchType()
    {
        $values = array(
            'conversation',
            'message',
            'contact',
            'appointment',
            'task',
            'wiki',
            'document',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\SearchType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\SectionType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\ServerBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\SessionType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\SortBy::has($value));
        }
    }

    public function testTagActionOp()
    {
        $values = array(
            'read',
            'rename',
            'color',
            'delete',
            'update',
            'retentionpolicy',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\TagActionOp::has($value));
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
            $this->assertTrue(\Zimbra\Enum\TargetBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\TargetType::has($value));
        }
    }

    public function testTransparency()
    {
         $values = array(
            'O',
            'T',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\Transparency::has($value));
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
            $this->assertTrue(\Zimbra\Enum\Type::has($value));
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
            $this->assertTrue(\Zimbra\Enum\UcServiceBy::has($value));
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
            $this->assertTrue(\Zimbra\Enum\VersionCheckAction::has($value));
        }
    }

    public function testVolumeType()
    {
        $values = array(1, 2, 10);
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\VolumeType::has($value));
        }
    }

    public function testWeekDay()
    {
        $values = array(
            'SU',
            'MO',
            'TU',
            'WE',
            'TH',
            'FR',
            'SA',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\WeekDay::has($value));
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
            $this->assertTrue(\Zimbra\Enum\XmppComponentBy::has($value));
        }
    }

    public function testZimletExcludeType()
    {
        $values = array(
            'extension',
            'mail',
            'none',
        );
        foreach ($values as $value)
        {
            $this->assertTrue(\Zimbra\Enum\ZimletExcludeType::has($value));
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
            $this->assertTrue(\Zimbra\Enum\ZimletStatus::has($value));
        }
    }
}