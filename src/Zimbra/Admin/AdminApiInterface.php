<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin;

use Zimbra\Admin\Struct\{
    AlwaysOnClusterSelector,
    AttachmentIdAttrib,
    Attr,
    CacheSelector,
    CalendarResourceSelector,
    CheckedRight,
    CosSelector,
    DataSourceInfo,
    DataSourceSpecifier,
    DistributionListSelector,
    DomainSelector,
    EffectiveRightsTargetSelector,
    EntrySearchFilterInfo,
    ExchangeAuthSpec,
    ExportAndDeleteMailboxSpec,
    HostName,
    IdAndAction,
    GranteeSelector,
    LimitedQuery,
    LoggerInfo,
    MailboxByAccountIdSelector,
    Names,
    PrincipalSelector,
    RightModifierInfo,
    ReindexMailboxInfo,
    ServerMailQueueQuery,
    ServerSelector,
    ServerWithQueueAction,
    StatsSpec,
    TargetWithType,
    TimeAttr,
    TzFixup,
    UcServiceSelector,
    VolumeInfo,
    XMPPComponentSelector,
    XMPPComponentSpec,
    ZimletAclStatusPri
};

use Zimbra\Mail\Struct\{
    Policy,
    PolicyHolder
};

use Zimbra\Enum\{
    AutoProvTaskAction,
    CompactIndexAction,
    ContactBackupOp,
    CountObjectsType,
    DedupAction,
    GalMode,
    GalSearchType,
    RightClass,
    TargetType,
    ZimletDeployAction,
    ZimletExcludeType
};

use Zimbra\Soap\{ApiInterface, ResponseInterface};
use Zimbra\Struct\{
    AccountSelector,
    AccountNameSelector,
    AdminFilterType,
    GalSearchType,
    GetSessionsSortBy,
    IpType,
    LockoutOperation,
    NamedElement,
    ReIndexAction,
    SessionType
};

/**
 * AdminApiInterface interface
 *
 * @package   Zimbra
 * @category  Admin
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
interface AdminApiInterface extends ApiInterface
{
    /**
     * Add an alias for the account 
     * @param  string $id
     * @param  string $alias
     * @return ResponseInterface
     */
    function addAccountAlias(string $id, string $alias): ResponseInterface;

    /**
     * Changes logging settings on a per-account basis
     * @param  LoggerInfo $logger
     * @param  AccountSelector $account
     * @param  string $id
     * @return ResponseInterface
     */
    function addAccountLogger(
        LoggerInfo $logger, ?AccountSelector $account = NULL, ?string $id = NULL
    ): ResponseInterface;

    /**
     * Add an alias for a distribution list
     * @param  string $id
     * @param  string $alias
     * @return ResponseInterface
     */
    function addDistributionListAlias(string $id, string $alias): ResponseInterface;

    /**
     * Adding members to a distribution list
     * @param  string $id
     * @param  array  $members
     * @return ResponseInterface
     */
    function addDistributionListMember(string $id, array $members): ResponseInterface;

    /**
     * Add a GalSync data source
     * 
     * @param AccountSelector $account
     * @param string  $name
     * @param string  $domain
     * @param GalMode  $type
     * @param string  $folder
     * @return ResponseInterface
     */
    function addGalSyncDataSource(
        AccountSelector $account,
        string $name,
        string $domain,
        GalMode $type,
        ?string $folder = NULL,
        array $attrs = []
    ): ResponseInterface;

    /**
     * Create a waitset to listen for changes on one or more accounts
     * Called once to initialize a WaitSet and to set its "default interest types"
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     * 
     * @param string $defaultInterests
     * @param bool $allAccounts
     * @param array $accounts
     * @return ResponseInterface
     */
    function adminCreateWaitSet(
        string $defaultInterests, ?bool $allAccounts = NULL, array $accounts = []
    ): ResponseInterface;

    /**
     * Use this to close out the waitset.
     * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
     * 
     * @param string  $waitSetId
     * @return ResponseInterface
     */
    function adminDestroyWaitSet(string $waitSetId): ResponseInterface;

    /**
     * Modifies the wait set and checks for any notifications.
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     * 
     * @param string  $waitSetId
     * @param string  $lastKnownSeqNo
     * @param bool  $block
     * @param bool  $expand
     * @param string  $defaultInterests
     * @param int  $timeout
     * @param array  $addAccounts
     * @param array  $updateAccounts
     * @param array  $removeAccounts
     * @return ResponseInterface
     */
    function adminWaitSet(
        string $waitSetId,
        string $lastKnownSeqNo,
        ?bool $block = NULL,
        ?bool $expand = NULL,
        ?string $defaultInterests = NULL,
        ?int $timeout = NULL,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ): ResponseInterface;

    /**
     * Authenticate for administration
     *
     * @param string  $name
     * @param string  $password
     * @param string  $authToken
     * @param Account $account
     * @param string  $virtualHost
     * @param bool    $persistAuthTokenCookie
     * @param bool    $csrfSupported
     * @param string  $twoFactorCode
     * @return ResponseInterface
     */
    function auth(
        ?string $name = NULL,
        ?string $password = NULL,
        ?string $authToken = NULL,
        ?Account $account = NULL,
        ?string $virtualHost = NULL,
        ?bool $persistAuthTokenCookie = NULL,
        ?bool $csrfSupported = NULL,
        ?string $twoFactorCode = NULL
    ): ResponseInterface;

    /**
     * Perform an autocomplete for a name against the Global Address List
     * 
     * @param string  $domain
     * @param string  $name
     * @param GalSearchType  $type
     * @param string  $galAccountId
     * @param int     $limit
     * @return ResponseInterface
     */
    function autoCompleteGal(
        string $domain,
        string $name,
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): ResponseInterface;

    /**
     * Auto-provision an account
     * 
     * @param DomainSelector $domain
     * @param PrincipalSelector $principal
     * @param string  $password
     * @return ResponseInterface
     */
    function autoProvAccount(
        DomainSelector $domain,
        PrincipalSelector $principal,
        ?string $password = NULL
    ): ResponseInterface;

    /**
     * Under normal situations, the EAGER auto provisioning task(thread) should be started/stopped automatically by the server when appropriate.
     * The task should be running when zimbraAutoProvPollingInterval is not 0 and zimbraAutoProvScheduledDomains is not empty.
     * The task should be stopped otherwise. This API is to manually force start/stop or query status of the EAGER auto provisioning task.
     * It is only for diagnosis purpose and should not be used under normal situations.
     * 
     * @param AutoProvTaskAction $action
     * @return ResponseInterface
     */
    function autoProvTaskControl(AutoProvTaskAction $action): ResponseInterface;

    /**
     * Change Account
     * 
     * @param AccountSelector $account
     * @param string $newName
     * @return ResponseInterface
     */
    function changePrimaryEmail(AccountSelector $account, string $newName): ResponseInterface;

    /**
     * Check auth config
     * 
     * @param string $name
     * @param string $password
     * @param array $attrs
     * @return ResponseInterface
     */
    function checkAuthConfig(
        string $name, string $password, array $attrs = []
    ): ResponseInterface;

    /**
     * Checks for items that have no blob, blobs that have no item, and items that have an incorrect blob size stored in their metadata
     *.If no volumes are specified, all volumes are checked.
     * If no mailboxes are specified, all mailboxes are checked.
     * Blob sizes are checked by default.
     * Set checkSize to 0 (false) to * avoid the CPU overhead of uncompressing compressed blobs in order to calculate size.
     * 
     * @param  bool $checkSize
     * @param  bool $reportUsedBlobs
     * @param  array $volumes
     * @param  array $mailboxes
     * @return ResponseInterface
     */
    function checkBlobConsistency(
        ?bool $checkSize = NULL, ?bool $reportUsedBlobs = NULL, array $volumes = [], array $mailboxes = []
    ): ResponseInterface;

    /**
     * Check existence of one or more directories and optionally create them.
     * 
     * @param  array  $paths
     * @return ResponseInterface
     */
    function checkDirectory(array $paths = []): ResponseInterface;

    /**
     * Check Domain MX record
     * 
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function checkDomainMXRecord(DomainSelector $domain = NULL): ResponseInterface;

    /**
     * Check Exchange Authorisation
     * 
     * @param  ExchangeAuthSpec $auth
     * @return ResponseInterface
     */
    function checkExchangeAuth(?ExchangeAuthSpec $auth = NULL): ResponseInterface;

    /**
     * Check Global Addressbook Configuration
     * 
     * @param  LimitedQuery $query
     * @param  string $action
     * @param  array  $attrs
     * @return ResponseInterface
     */
    function checkGalConfig(
        ?LimitedQuery $query = NULL, ?string $action = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Check Health
     * 
     * @return ResponseInterface
     */
    function checkHealth(): ResponseInterface;

    /**
     * Check whether a hostname can be resolved
     * 
     * @param  string $hostname
     * @return ResponseInterface
     */
    function checkHostnameResolve(?string $hostname = NULL): ResponseInterface;

    /**
     * Check password strength
     * 
     * @param  string $id
     * @param  string $password
     * @return ResponseInterface
     */
    function checkPasswordStrength(string $id, string $password): ResponseInterface;

    /**
     * Check if a principal has the specified right on target.
     * 
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param CheckedRight $right
     * @param array $attrs
     * @return ResponseInterface
     */
    function checkRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        CheckedRight $right,
        array $attrs = []
    ): ResponseInterface;

    /**
     * Clear cookie
     * 
     * @param array $cookies
     * @return ResponseInterface
     */
    function clearCookie(array $cookies = []): ResponseInterface;

    /**
     * Compact index
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @param  CompactIndexAction $action
     * @return ResponseInterface
     */
    function compactIndex(MailboxByAccountIdSelector $mbox, ?CompactIndexAction $action = NULL): ResponseInterface;

    /**
     * Computes the aggregate quota usage for all domains in the system.
     * 
     * @return ResponseInterface
     */
    function computeAggregateQuotaUsage(): ResponseInterface;

    /**
     * Configure Zimlet
     * 
     * @param  AttachmentIdAttrib $content
     * @return ResponseInterface
     */
    function configureZimlet(AttachmentIdAttrib $content): ResponseInterface;

    /**
     * start/stop contact backup
     * 
     * @param  array $servers
     * @param  ContactBackupOp $op
     * @return ResponseInterface
     */
    function contactBackup(array $servers, ContactBackupOp $op): ResponseInterface;

    /**
     * Copy Class of service (COS)
     * 
     * @param  CosSelector $cos
     * @param  string $newName
     * @return ResponseInterface
     */
    function copyCos(?CosSelector $cos = NULL, ?string $newName = NULL): ResponseInterface;

    /**
     * Count number of accounts by cos in a domain
     * 
     * @param DomainSelector $domain
     * @return ResponseInterface
     */
    function countAccount(DomainSelector $domain): ResponseInterface;

    /**
     * Count number of objects.
     * 
     * @param  CountObjectsType $type
     * @param  array $domains
     * @param  UcServiceSelector $ucService
     * @param  bool $onlyRelated
     * @return ResponseInterface
     */
    function countObjects(
        CountObjectsType $type,
        array $domains = [],
        ?UcServiceSelector $ucService = NULL,
        ?bool $onlyRelated = NULL
    ): ResponseInterface;

    /**
     * Create account
     * 
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createAccount(
        string $name, ?string $password = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Create a AlwaysOnCluster 
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createAlwaysOnCluster(string $name, array $attrs = []): ResponseInterface;

    /**
     * Create a calendar resource
     * 
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createCalendarResource(string $name, ?string $password = NULL, array $attrs = []): ResponseInterface;

    /**
     * Create a Class of Service (COS)
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createCos(string $name, array $attrs = []): ResponseInterface;

    /**
     * Creates a data source that imports mail items into the specified folder. 
     * 
     * @param string $id
     * @param DataSourceSpecifier $dataSource
     * @return ResponseInterface
     */
    function createDataSource(string $id, DataSourceSpecifier $dataSource): ResponseInterface;

    /**
     * Create a distribution list
     * 
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createDistributionList(
        string $name, ?bool $dynamic = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Create a domain
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createDomain(string $name, array $attrs = []): ResponseInterface;

    /**
     * Create Global Address List (GAL) Synchronisation account
     * 
     * @param string  $name
     * @param string  $domain
     * @param GalMode $type
     * @param AccountSelector  $account
     * @param string  $mailHost
     * @param string  $password
     * @param string  $folder
     * @param array   $attrs
     * @return ResponseInterface
     */
    function createGalSyncAccount(
        string $name,
        string $domain,
        GalMode $type,
        AccountSelector $account,
        string $mailHost,
        ?string $password = NULL,
        ?string $folder = NULL,
        array $attrs = []
    ): ResponseInterface;

    /**
     * Create a Server
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createServer(string $name, array $attrs = []): ResponseInterface;

    /**
     * Create a system retention policy.
     * 
     * @param  CosSelector  $cos
     * @param  PolicyHolder $keep
     * @param  PolicyHolder $purge
     * @return ResponseInterface
     */
    function createSystemRetentionPolicy(
        ?CosSelector $cos = NULL, ?PolicyHolder $keep = NULL, ?PolicyHolder $purge = NULL
    ): ResponseInterface;

    /**
     * Create a UC service
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createUCService(string $name, array $attrs = []): ResponseInterface;

    /**
     * Create a volume
     * 
     * @param VolumeInfo $volume
     * @return ResponseInterface
     */
    function createVolume(VolumeInfo $volume): ResponseInterface;

    /**
     * Create an XMPP component
     * 
     * @param XMPPComponentSpec $component
     * @return ResponseInterface
     */
    function createXMPPComponent(XMPPComponentSpec $component): ResponseInterface;

    /**
     * Create a Zimlet
     * 
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function createZimlet(string $name, array $attrs = []): ResponseInterface;

    /**
     * Dedupe the blobs having the same digest.
     * 
     * @param  DedupAction $action
     * @param  array $volumes
     * @return ResponseInterface
     */
    function dedupeBlobs(DedupAction $action, array $volumes = []): ResponseInterface;

    /**
     * Used to request a new auth token that is valid for the specified account.
     * The id of the auth token will be the id of the target account, and the requesting admin's id will be stored in
     * the auth token for auditing purposes.
     * 
     * @param  AccountSelector $account
     * @param  int $duration
     * @return ResponseInterface
     */
    function delegateAuth(AccountSelector $account, ?int $duration = NULL): ResponseInterface;

    /**
     * Deletes the account with the given id.
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteAccount(string $id): ResponseInterface;

    /**
     * Delete a alwaysOnCluster
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteAlwaysOnCluster(string $id): ResponseInterface;

    /**
     * Deletes the calendar resource with the given id.
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteCalendarResource(string $id): ResponseInterface;

    /**
     * Delete a Class of Service (COS)
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteCos(string $id): ResponseInterface;

    /**
     * Deletes the given data source.
     * 
     * @param string $id
     * @param Id     $dataSource
     * @param array  $attrs
     * @return ResponseInterface
     */
    function deleteDataSource(string $id, Id $dataSource, array $attrs = []): ResponseInterface;

    /**
     * Delete a distribution list
     * 
     * @param  string $id
     * @param  bool   $cascadeDelete
     * @return ResponseInterface
     */
    function deleteDistributionList(string $id, ?bool $cascadeDelete = NULL): ResponseInterface;

    /**
     * Delete a domain
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteDomain(string $id): ResponseInterface;

    /**
     * Delete a Global Address List (GAL) Synchronisation account
     * 
     * @param  AccountSelector $account
     * @return ResponseInterface
     */
    function deleteGalSyncAccount(AccountSelector $account): ResponseInterface;

    /**
     * Delete a mailbox
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @return ResponseInterface
     */
    function deleteMailbox(?MailboxByAccountIdSelector $mbox = NULL): ResponseInterface;

    /**
     * Delete a server
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteServer(string $id): ResponseInterface;

    /**
     * Delete a system retention policy.
     * 
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return ResponseInterface
     */
    function deleteSystemRetentionPolicy(Policy $policy, ?CosSelector $cos = NULL): ResponseInterface;

    /**
     * Delete a UC service
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function deleteUCService(string $id): ResponseInterface;

    /**
     * Delete a volume
     * 
     * @param  int $id
     * @return ResponseInterface
     */
    function deleteVolume(int $id): ResponseInterface;

    /**
     * Delete an XMPP Component
     * 
     * @param  XMPPComponentSelector $component
     * @return ResponseInterface
     */
    function deleteXMPPComponent(?XMPPComponentSelector $component = NULL): ResponseInterface;

    /**
     * Delete a Zimlet
     * 
     * @param  NamedElement $zimlet
     * @return ResponseInterface
     */
    function deleteZimlet(NamedElement $zimlet): ResponseInterface;

    /**
     * Deploy Zimlet(s)
     * 
     * @param  ZimletDeployAction $action
     * @param  AttachmentIdAttrib $content
     * @param  bool $flushCache
     * @param  bool $synchronous
     * @return ResponseInterface
     */
    function deployZimlet(
        ZimletDeployAction $action, AttachmentIdAttrib $content, ?bool $flushCache = NULL, ?bool $synchronous = NULL
    ): ResponseInterface;

    /**
     * Dump sessions
     * 
     * @param  bool $includeAccounts
     * @param  bool $groupByAccount
     * @return ResponseInterface
     */
    function dumpSessions(?bool $includeAccounts = NULL, ?bool $groupByAccount = NULL): ResponseInterface;

    /**
     * Exports the database data for the given items with SELECT INTO OUTFILE and deletes the items from the mailbox.
     * 
     * @param  ExportAndDeleteMailboxSpec $mailbox
     * @param  string $exportDir
     * @param  string $exportFilenamePrefix
     * @return ResponseInterface
     */
    function exportAndDeleteItems(
        ExportAndDeleteMailboxSpec $mailbox, ?string $exportDir = NULL, ?string $exportFilenamePrefix = NULL
    ): ResponseInterface;

    /**
     * Fix Calendar End Times
     * 
     * @param  bool $sync
     * @param  array $accounts
     * @return ResponseInterface
     */
    function fixCalendarEndTime(?bool $sync = NULL, array $accounts = []): ResponseInterface;

    /**
     * Fix Calendar priority 
     * 
     * @param  bool $sync
     * @param  array $accounts
     * @return ResponseInterface
     */
    function fixCalendarPriority(?bool $sync = NULL, array $accounts = []): ResponseInterface;

    /**
     * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
     * 
     * @param  bool $sync
     * @param  int $after
     * @param  array $accounts
     * @param  TzFixup $tzFixup
     * @return ResponseInterface
     */
    function fixCalendarTZ(
        ?bool $sync = NULL, ?int $after = NULL, array $accounts = [], ?TzFixup $tzFixup = NULL
    ): ResponseInterface;

    /**
     * Flush memory cache for specified LDAP or directory scan type/entries
     * 
     * @param  CacheSelector $cache
     * @return ResponseInterface
     */
    function flushCache(?CacheSelector $cache = NULL): ResponseInterface;

    /**
     * Get attributes related to an account
     * 
     * @param  AccountSelector $account
     * @param  bool $applyCos
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getAccount(
        AccountSelector $account, ?bool $applyCos = NULL, ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get information about an account
     * 
     * @param  AccountSelector $account
     * @return ResponseInterface
     */
    function getAccountInfo(AccountSelector $account): ResponseInterface;

    /**
     * Returns custom loggers created for the given account since the last server start.
     * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
     * 
     * @param  string $id
     * @param  AccountSelector $account
     * @return ResponseInterface
     */
    function getAccountLoggers(?string $id = NULL, ?AccountSelector $account = NULL): ResponseInterface;

    /**
     * Get distribution lists an account is a member of
     * 
     * @param  AccountSelector $account
     * @return ResponseInterface
     */
    function getAccountMembership(AccountSelector $account): ResponseInterface;

    /**
     * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to. 
     * 
     * @param  AccountSelector $account
     * @param  DistributionListSelector $dl
     * @return ResponseInterface
     */
    function getAdminConsoleUI(?AccountSelector $account = NULL, ?DistributionListSelector $dl = NULL): ResponseInterface;

    /**
     * Returns the admin extension addon Zimlets.
     * 
     * @return ResponseInterface
     */
    function getAdminExtensionZimlets(): ResponseInterface;

    /**
     * Returns admin saved searches.
     * 
     * @param array $searches
     * @return ResponseInterface
     */
    function getAdminSavedSearches(array $searches = []): ResponseInterface;

    /**
     * Gets the aggregate quota usage for all domains on the server.
     * 
     * @return ResponseInterface
     */
    function getAggregateQuotaUsageOnServer(): ResponseInterface;

    /**
     * Returns all account loggers that have been created on the given server since the last server start.
     * 
     * @return ResponseInterface
     */
    function getAllAccountLoggers(): ResponseInterface;

    /**
     * Get All accounts matching the selectin criteria
     * 
     * @param  ServerSelector $server
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function getAllAccounts(?ServerSelector $server = NULL, ?DomainSelector $domain = NULL): ResponseInterface;

    /**
     * Returns all active servers.
     * 
     * @return ResponseInterface
     */
    function getAllActiveServers(): ResponseInterface;

    /**
     * Get all Admin accounts
     * 
     * @param  bool $applyCos
     * @return ResponseInterface
     */
    function getAllAdminAccounts(?bool $applyCos = NULL): ResponseInterface;

    /**
     * Get all alwaysOnClusters
     * 
     * @return ResponseInterface
     */
    function getAllAlwaysOnClusters(): ResponseInterface;

    /**
     * Get all calendar resources that match the selection criteria
     * 
     * @param  ServerSelector $server
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function getAllCalendarResources(?ServerSelector $server = NULL, ?DomainSelector $domain = NULL): ResponseInterface;

    /**
     * Get all config
     * 
     * @return ResponseInterface
     */
    function getAllConfig(): ResponseInterface;

    /**
     * Get all classes of service (COS)
     * 
     * @return ResponseInterface
     */
    function getAllCos(): ResponseInterface;

    /**
     * Get all distribution lists that match the selection criteria
     * 
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function getAllDistributionLists(?DomainSelector $domain = NULL): ResponseInterface;

    /**
     * Get all domains
     * 
     * @param  bool $applyConfig
     * @return ResponseInterface
     */
    function getAllDomains(?bool $applyConfig = NULL): ResponseInterface;

    /**
     * Get all effective Admin rights
     * 
     * @param  GranteeSelector $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return ResponseInterface
     */
    function getAllEffectiveRights(
        ?GranteeSelector $grantee = NULL, ?bool $expandSetAttrs = NULL, ?bool $expandGetAttrs = NULL
    ): ResponseInterface;

    /**
     * Get all free/busy providers
     * 
     * @return ResponseInterface
     */
    function getAllFreeBusyProviders(): ResponseInterface;

    /**
     * Returns all locales defined in the system.
     * 
     * @return ResponseInterface
     */
    function getAllLocales(): ResponseInterface;

    /**
     * Return all mailboxes
     * 
     * @param  int $limit
     * @param  int $offset
     * @return ResponseInterface
     */
    function getAllMailboxes(?int $limit = NULL, ?int $offset = NULL): ResponseInterface;

    /**
     * Get all system defined rights
     * 
     * @param  string $targetType
     * @param  bool $expandAllAttrs
     * @param  RightClass $rightClass
     * @return ResponseInterface
     */
    function getAllRights(
        ?string $targetType = NULL, ?bool $expandAllAttrs = NULL, ?RightClass $rightClass = NULL
    ): ResponseInterface;

    /**
     * Get all servers defined in the system or all servers that have a particular service enabled (eg, mta, antispam, spell).
     * 
     * @param  string $service
     * @param  string $alwaysOnClusterId
     * @param  bool $applyConfig
     * @return ResponseInterface
     */
    function getAllServers(
        ?string $service = NULL, ?string $alwaysOnClusterId = NULL, ?bool $applyConfig = NULL
    ): ResponseInterface;

    /**
     * Get all installed skins on the server.
     * 
     * @return ResponseInterface
     */
    function getAllSkins(): ResponseInterface;

    /**
     * Get all ucservices defined in the system
     * 
     * @return ResponseInterface
     */
    function getAllUCServices(): ResponseInterface;

    /**
     * Get all volumes
     * 
     * @return ResponseInterface
     */
    function getAllVolumes(): ResponseInterface;

    /**
     * Get all XMPP components
     * 
     * @return ResponseInterface
     */
    function getAllXMPPComponents(): ResponseInterface;

    /**
     * Get all Zimlets
     * 
     * @param  ZimletExcludeType $exclude
     * @return ResponseInterface
     */
    function getAllZimlets(?ZimletExcludeType $exclude = NULL): ResponseInterface;

    /**
     * Get Always On Cluster
     * 
     * @param  AlwaysOnClusterSelector $cluster
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getAlwaysOnCluster(?AlwaysOnClusterSelector $cluster = NULL, ?string $attrs = NULL): ResponseInterface;

    /**
     * Get attribute information 
     * 
     * @param  string $attrs
     * @param  string $entryTypes
     * @return ResponseInterface
     */
    function getAttributeInfo(?string $attrs = NULL, ?string $entryTypes = NULL): ResponseInterface;

    /**
     * Get a calendar resource
     * 
     * @param  CalendarResourceSelector $calResource
     * @param  bool $applyCos
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getCalendarResource(
        ?CalendarResourceSelector $calResource = NULL, ?bool $applyCos = NULL, ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get Config
     * 
     * @param  Attr $attr
     * @return ResponseInterface
     */
    function getConfig(Attr $attr = NULL): ResponseInterface;

    /**
     * Get Class Of Service (COS)
     * 
     * @param  CosSelector $cos
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getCos(CosSelector $cos, ?string $attrs = NULL): ResponseInterface;

    /**
     * Returns attributes, with defaults and constraints if any,  that can be set by the admin when an object is created.
     * 
     * @param  TargetWithType $target
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @return ResponseInterface
     */
    function getCreateObjectAttrs(
        TargetWithType $target, ?DomainSelector $domain = NULL, ?CosSelector $cos = NULL
    ): ResponseInterface;

    /**
     * Get current volumes
     * 
     * @return ResponseInterface
     */
    function getCurrentVolumes(): ResponseInterface;

    /**
     * Returns all data sources defined for the given mailbox.
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function getDataSources(string $id, array $attrs = []): ResponseInterface;

    /**
     * Get constraints (zimbraConstraint) for delegated admin on global config or a COS
     * none or several attributes can be specified for which constraints are to be returned.
     * If no attribute is specified, all constraints on the global config/cos will be returned.
     * If there is no constraint for a requested attribute, <a> element for the attribute will not appear in the response. 
     * 
     * @param  TargetType $type
     * @param  string $id
     * @param  string $name
     * @param  array $attrs
     * @return ResponseInterface
     */
    function getDelegatedAdminConstraints(
        TargetType $type, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Get a Distribution List
     * 
     * @param  DistributionListSelector $dl
     * @param  int $limit
     * @param  int $offset
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getDistributionList(
        ?DistributionListSelector $dl = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Request a list of DLs that a particular DL is a member of
     * 
     * @param  DistributionListSelector $dl
     * @param  int $limit
     * @param  int $offset
     * @return ResponseInterface
     */
    function getDistributionListMembership(
        ?DistributionListSelector $dl = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL
    ): ResponseInterface;

    /**
     * Get information about a domain 
     * 
     * @param  DomainSelector $domain
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getDomain(
        ?DomainSelector $domain = NULL,
        ?bool $applyConfig = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get Domain information
     * This call does not require an auth token.
     * It returns attributes that are pertinent to domain settings for cases when the user is not authenticated.
     * For example, URL to direct the user to upon logging out or when auth token is expired. 
     * 
     * @param  DomainSelector $domain
     * @param  bool $applyConfig
     * @return ResponseInterface
     */
    function getDomainInfo(?DomainSelector $domain = NULL, ?bool $applyConfig = NULL): ResponseInterface;

    /**
     * Returns effective ADMIN rights the authenticated admin has on the specified target entry. 
     * Returns effective ADMIN rights the authenticated admin has on the specified target entry. 
     * Effective rights are the rights the admin is actually allowed.
     * It is the net result of applying ACL checking rules given the target and grantee.
     * Specifically denied rights will not be returned.
     * The result can help the admin console decide on what tabs to display after a target is selected.
     * For example, after user1 is selected, if the admin does not have right to setPassword, it should probably hide or gray out the setPassword tab
     * 
     * @param  EffectiveRightsTargetSelector $target
     * @param  GranteeSelector $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return ResponseInterface
     */
    function getEffectiveRights(
        EffectiveRightsTargetSelector $target,
        ?GranteeSelector $grantee = NULL,
        ?bool $expandSetAttrs = NULL,
        ?bool $expandGetAttrs = NULL
    ): ResponseInterface;

    /**
     * Get filter rules
     * 
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @return ResponseInterface
     */
    function getFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL
    ): ResponseInterface;

    /**
     * Get Free/Busy provider information
     * If the optional element <provider> is present in the request, the response contains the requested provider only.
     * if no provider is supplied in the request, the response contains all the providers.
     * 
     * @param  NamedElement $provider
     * @return ResponseInterface
     */
    function getFreeBusyQueueInfo(?NamedElement $provider = NULL): ResponseInterface;

    /**
     * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
     * The authenticated admin must have an effective "viewGrants" (TBD) system right on the specified target/grantee.
     * At least one of <target> or <grantee> must be specified.
     * If both <target> and <grantee> are specified, only grants that are granted on the target to the grantee are returned.
     * 
     * @param  EffectiveRightsTargetSelector $target
     * @param  GranteeSelector $grantee
     * @return ResponseInterface
     */
    function getGrants(
        ?EffectiveRightsTargetSelector $target = NULL,
        ?GranteeSelector $grantee = NULL
    ): ResponseInterface;

    /**
     * Get index stats
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @return ResponseInterface
     */
    function getIndexStats(MailboxByAccountIdSelector $mbox): ResponseInterface;

    /**
     * Get License information
     * 
     * @return ResponseInterface
     */
    function getLicenseInfo(): ResponseInterface;

    /**
     * Query to retrieve Logger statistics in ZCS
     * Use cases:
     * - No elements specified. result: a listing of reporting host names
     * - hostname specified. result: a listing of stat groups for the specified host
     * - hostname and stats specified, text content of stats non-empty. result: a listing of columns for the given host and group
     * - hostname and stats specified, text content empty, startTime/endTime optional. result: all of the statistics for the given host/group are returned, if start and end are specified, limit/expand the timerange to the given setting. if limit=true is specified, attempt to reduce result set to under 500 records
     * 
     * @param  HostName $hostName
     * @param  StatsSpec $stats
     * @param  TimeAttr $startTime
     * @param  TimeAttr $endTime
     * @return ResponseInterface
     */
    function getLoggerStats(
        ?HostName $hostName = NULL, ?StatsSpec $stats = NULL, ?TimeAttr $startTime = NULL, ?TimeAttr $endTime = NULL
    ): ResponseInterface;

    /**
     * Get a Mailbox
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @return ResponseInterface
     */
    function getMailbox(?MailboxByAccountIdSelector $mbox = NULL): ResponseInterface;

    /**
     * Get MailBox Statistics
     * 
     * @return ResponseInterface
     */
    function getMailboxStats(): ResponseInterface;

    /**
     * Summarize and/or search a particular mail queue on a particular server.
     * 
     * @param  ServerMailQueueQuery $server
     * @return ResponseInterface
     */
    function getMailQueue(ServerMailQueueQuery $server): ResponseInterface;

    /**
     * Get a count of all the mail queues by counting the number of files in the queue directories.
     * 
     * @param  NamedElement $server
     * @return ResponseInterface
     */
    function getMailQueueInfo(NamedElement $server): ResponseInterface;

    /**
     * Returns the memcached client configuration on a mailbox server.
     * 
     * @return ResponseInterface
     */
    function getMemcachedClientConfig(): ResponseInterface;

    /**
     * Get filter rules
     * 
     * @return ResponseInterface
     */
    function getOutgoingFilterRules(): ResponseInterface;

    /**
     * Get Quota Usage
     * 
     * @param  string $domain
     * @param  bool $allServers
     * @param  int $limit
     * @param  int $offset
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  bool $refresh
     * @return ResponseInterface
     */
    function getQuotaUsage(
        ?string $domain = NULL,
        ?bool $allServers = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?bool $refresh = NULL
    ): ResponseInterface;

    /**
     * Get definition of a right 
     * 
     * @param  string $right
     * @param  bool $expandAllAttrs
     * @return ResponseInterface
     */
    function getRight(string $right, ?bool $expandAllAttrs = NULL): ResponseInterface;

    /**
     * Get Rights Document
     * 
     * @param array $pkgs
     * @return ResponseInterface
     */
    function getRightsDoc(array $pkgs = []): ResponseInterface;

    /**
     * Get Server
     * 
     * @param  ServerSelector $server
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getServer(
        ?ServerSelector $server = NULL,
        ?bool $applyConfig = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get Network Interface information for a server
     * 
     * @param  Server $server
     * @param  IpType $type
     * @return ResponseInterface
     */
    function getServerNIfs(ServerSelector $server, IpType $type = NULL): ResponseInterface;

    /**
     * Returns server monitoring stats.
     * These are the same stats that are logged to mailboxd.csv.
     * If no stat element is specified, all server stats are returned.
     * 
     * @param array $stats
     * @return ResponseInterface
     */
    function getServerStats(array $stats = []): ResponseInterface;

    /**
     * Get Service Status
     * 
     * @return ResponseInterface
     */
    function getServiceStatus(): ResponseInterface;

    /**
     * Get Sessions
     * 
     * @param  SessionType $type
     * @param  GetSessionsSortBy $sortBy
     * @param  int $offset
     * @param  int $limit
     * @param  boo $sortAscending
     * @param  boo $refresh
     * @return ResponseInterface
     */
    function getSessions(
        SessionType $type,
        ?GetSessionsSortBy $sortBy = NULL,
        ?int $offset = NULL,
        ?int $limit = NULL,
        ?bool $refresh = NULL
    ): ResponseInterface;

    /**
     * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier. 
     * 
     * @param  AccountSelector $owner
     * @param  GranteeChooser $grantee
     * @return ResponseInterface
     */
    function getShareInfo(AccountSelector $owner, ?GranteeChooser $grantee = NULL): ResponseInterface;

    /**
     * Get System Retention Policy
     * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users
     * can apply to folders and tags.
     * 
     * @param  CosSelector $cos
     * @return ResponseInterface
     */
    function getSystemRetentionPolicy(?CosSelector $cos = NULL): ResponseInterface;

    /**
     * Get UC Service
     * 
     * @param  UcServiceSelector $ucService
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getUCService(UcServiceSelector $ucService, ?string $attrs = NULL): ResponseInterface;

    /**
     * Get Version information
     * 
     * @return ResponseInterface
     */
    function getVersionInfo(): ResponseInterface;

    /**
     * Get Volume
     * 
     * @param  int $id
     * @return ResponseInterface
     */
    function getVolume(int $id): ResponseInterface;

    /**
     * Get XMPP Component
     * 
     * @param  XMPPComponentSelector $component
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getXMPPComponent(
        XMPPComponentSelector $component, ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get Zimlet
     * 
     * @param  NamedElement $zimlet
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getZimlet(NamedElement $zimlet, ?string $attrs = NULL): ResponseInterface;

    /**
     * Get status for Zimlets
     * 
     * @return ResponseInterface
     */
    function getZimletStatus(): ResponseInterface;

    /**
     * Grant a right on a target to an individual or group grantee.
     * 
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param RightModifierInfo $right
     * @return ResponseInterface
     */
    function grantRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): ResponseInterface;

    /**
     * Puts the mailbox of the specified account into maintenance lockout or removes it from maintenance lockout
     * 
     * @param  AccountNameSelector $account
     * @param  LockoutOperation $operation
     * @return ResponseInterface
     */
    function lockoutMailbox(AccountNameSelector $account, ?LockoutOperation $operation = NULL): ResponseInterface;

    /**
     * Command to act on invidual queue files. This proxies through to postsuper.
     * 
     * @param  ServerWithQueueAction $server
     * @return ResponseInterface
     */
    function mailQueueAction(ServerWithQueueAction $server): ResponseInterface;

    /**
     * Command to invoke postqueue -f.
     * All queues cached in the server are stale after invoking this because this is a global operation to all the queues in a given server.
     * 
     * @param  NamedElement $server
     * @return ResponseInterface
     */
    function mailQueueFlush(NamedElement $server): ResponseInterface;

    /**
     * Migrate an account
     * 
     * @param  IdAndAction $migrate
     * @return ResponseInterface
     */
    function migrateAccount(IdAndAction $migrate): ResponseInterface;

    /**
     * Modify an account
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyAccount(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modifies admin saved searches.
     * Returns the admin saved searches.
     * 
     * @param array $searches
     * @return ResponseInterface
     */
    function modifyAdminSavedSearches(array $searches = []): ResponseInterface;

    /**
     * Modify attributes for a alwaysOnCluster 
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyAlwaysOnCluster(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify a calendar resource
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyCalendarResource(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify Configuration attributes
     * 
     * @param array $attrs
     * @return ResponseInterface
     */
    function modifyConfig(array $attrs = []): ResponseInterface;

    /**
     * Modify Class of Service (COS) attributes
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyCos(string $id, array $attrs = []): ResponseInterface;

    /**
     * Changes attributes of the given data source.
     * Only the attributes specified in the request are modified.
     * To change the name, specify "zimbraDataSourceName" as an attribute. 
     * 
     * @param string $id
     * @param DataSourceInfo $dataSource
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyDataSource(
        string $id, DataSourceInfo $dataSource, array $attrs = []
    ): ResponseInterface;

    /**
     * Modify constraint (zimbraConstraint) for delegated admin on global config or a COS
     * If constraints for an attribute already exists, it will be replaced by the new constraints.
     * If <constraint> is an empty element, constraints for the attribute will be removed. 
     * 
     * @param TargetType $type
     * @param string $id
     * @param string $name
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyDelegatedAdminConstraints(
        TargetType $type, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Modify attributes for a Distribution List
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyDistributionList(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify attributes for a domain
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyDomain(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify Filter rules
     * 
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $filterRules
     * @return ResponseInterface
     */
    function modifyFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL,
        array $filterRules = []
    ): ResponseInterface;

    /**
     * Modify Filter rules
     * 
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $filterRules
     * @return ResponseInterface
     */
    function modifyOutgoingFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL,
        array $filterRules = []
    ): ResponseInterface;

    /**
     * Modify attributes for a server 
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyServer(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify system retention policy
     * 
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return ResponseInterface
     */
    function modifySystemRetentionPolicy(
        Policy $policy, ?CosSelector $cos = NULL
    ): ResponseInterface;

    /**
     * Modify attributes for a UC service
     * 
     * @param string $id
     * @param array  $attrs
     * @return ResponseInterface
     */
    function modifyUCService(string $id, array $attrs = []): ResponseInterface;

    /**
     * Modify volume 
     * 
     * @param int $id
     * @param VolumeInfo $volume
     * @return ResponseInterface
     */
    function modifyVolume(int $id, VolumeInfo $volume): ResponseInterface;

    /**
     * Modify Zimlet
     * 
     * @return ResponseInterface
     */
    function modifyZimlet(ZimletAclStatusPri $zimlet): ResponseInterface;

    /**
     * A request that does nothing and always returns nothing. Used to keep an admin session alive.
     * 
     * @return ResponseInterface
     */
    function noOp(): ResponseInterface;

    /**
     * Ping
     * 
     * @return ResponseInterface
     */
    function ping(): ResponseInterface;

    /**
     * Purge the calendar cache for an account 
     * 
     * @param  string $id
     * @return ResponseInterface
     */
    function purgeAccountCalendarCache(string $id): ResponseInterface;

    /**
     * Purges the queue for the given freebusy provider on the current host
     * 
     * @param  NamedElement $provider
     * @return ResponseInterface
     */
    function purgeFreeBusyQueue(?NamedElement $provider = NULL): ResponseInterface;

    /**
     * Purges aged messages out of trash, spam, and entire mailbox
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @return ResponseInterface
     */
    function purgeMessages(?MailboxByAccountIdSelector $mbox = NULL): ResponseInterface;

    /**
     * Push Free/Busy.
     * The request must include either <domain/> or <account/>.
     * 
     * @param  Names $domains
     * @param  array $accounts
     * @return ResponseInterface
     */
    function pushFreeBusy(?Names $domains = NULL, array $accounts = []): ResponseInterface;

    /**
     * Query WaitSet
     * 
     * @param  string $waitSetId
     * @return ResponseInterface
     */
    function queryWaitSet(?string $waitSetId = NULL): ResponseInterface;

    /**
     * Recalculate Mailbox counts.
     * 
     * @param  MailboxByAccountIdSelector $mbox
     * @return ResponseInterface
     */
    function recalculateMailboxCounts(?MailboxByAccountIdSelector $mbox = NULL): ResponseInterface;

    /**
     * Deregister authtokens that have been deregistered on the sending server
     * 
     * @param  array $tokens
     * @return ResponseInterface
     */
    function refreshRegisteredAuthTokens(array $tokens = []): ResponseInterface;

    /**
     * ReIndex
     * 
     * @param  ReindexMailboxInfo $mbox
     * @param  ReIndexAction $action
     * @return ResponseInterface
     */
    function reIndex(
        ReindexMailboxInfo $mbox, ?ReIndexAction $action = NULL
    ): ResponseInterface;

    /**
     * Reload LocalConfig
     * 
     * @return ResponseInterface
     */
    function reloadLocalConfig(): ResponseInterface;

    /**
     * Reloads the memcached client configuration on this server.
     * Memcached client layer is reinitialized accordingly.
     * Call this command after updating the memcached server list, for example. 
     * 
     * @return ResponseInterface
     */
    function reloadMemcachedClientConfig(): ResponseInterface;

    /**
     * Remove Account Alias
     * 
     * @param  string $id
     * @param  string $alias
     * @return ResponseInterface
     */
    function removeAccountAlias(string $id, string $alias): ResponseInterface;

    /**
     * Removes one or more custom loggers.
     * If both the account and logger are specified, removes the given account logger if it exists.
     * If only the account is specified or the category is "all", removes all custom loggers from that account.
     * If only the logger is specified, removes that custom logger from all accounts.
     * If neither element is specified, removes all custom loggers from all accounts on the server that receives the request.
     * 
     * @param  LoggerInfo $logger
     * @param  AccountSelector $account
     * @param  string $id
     * @return ResponseInterface
     */
    function removeAccountLogger(
        ?LoggerInfo $logger = NULL, ?AccountSelector $account = NULL, ?string $id = NULL
    ): ResponseInterface;

    /**
     * Remove Distribution List Alias
     * 
     * @param  string $id
     * @param  string $alias
     * @return ResponseInterface
     */
    function removeDistributionListAlias(string $id, string $alias): ResponseInterface;

    /**
     * Remove Distribution List Member
     * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
     * 
     * @param  string $id
     * @param  array  $members
     * @param  array  $accounts
     * @return ResponseInterface
     */
    function removeDistributionListMember(
        string $id, array $members = [], array $accounts = []
    ): ResponseInterface;

    /**
     * Rename Account
     * 
     * @param string $id
     * @param string $newName
     * @return ResponseInterface
     */
    function renameAccount(string $id, string $newName): ResponseInterface;

    /**
     * Rename Calendar Resource
     * 
     * @param string $id
     * @param string $newName
     * @return ResponseInterface
     */
    function renameCalendarResource(string $id, string $newName): ResponseInterface;

    /**
     * Rename Class of Service (COS)
     * 
     * @param string $id
     * @param string $newName
     * @return ResponseInterface
     */
    function renameCos(string $id, string $newName): ResponseInterface;

    /**
     * Rename Distribution List
     * 
     * @param string $id
     * @param string $newName
     * @return ResponseInterface
     */
    function renameDistributionList(string $id, string $newName): ResponseInterface;

    /**
     * Rename Unified Communication Service
     * 
     * @param string $id
     * @param string $newName
     * @return ResponseInterface
     */
    function renameUCService(string $id, string $newName): ResponseInterface;

    /**
     * Removes all account loggers and reloads /opt/zimbra/conf/log4j.properties.
     * 
     * @return ResponseInterface
     */
    function resetAllLoggers(): ResponseInterface;

    /**
     * Revoke a right from a target that was previously granted to an individual or group grantee.
     * 
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param RightModifierInfo $right
     * @return ResponseInterface
     */
    function revokeRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): ResponseInterface;

    /**
     * Runs the server-side unit test suite.
     * 
     * @param  array  $tests
     * @return ResponseInterface
     */
    function runUnitTests(array $tests = []): ResponseInterface;

    /**
     * Search Accounts
     * Note: SearchAccountsRequest is deprecated. See SearchDirectoryRequest.
     * 
     * @param  string $query
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  string $attrs
     * @param  string $sortBy
     * @param  string $types
     * @param  bool $sortAscending
     * @return ResponseInterface
     */
    function searchAccounts(
        string $query,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?string $attrs = NULL,
        ?string $sortBy = NULL,
        ?string $types = NULL,
        ?bool $sortAscending = NULL
    ): ResponseInterface;

    /**
     * Search Auto Prov Directory
     * 
     * @param  string $keyAttr
     * @param  DomainSelector $domain
     * @param  string $query
     * @param  string $name
     * @param  int $maxResults
     * @param  int $limit
     * @param  int $offset
     * @param  bool $refresh
     * @param  string $attrs
     * @return ResponseInterface
     */
    function searchAutoProvDirectory(
        string $keyAttr,
        DomainSelector $domain,
        ?string $query = NULL,
        ?string $name = NULL,
        ?int $maxResults = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $refresh = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Search for Calendar Resources
     * 
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  string $sortBy
     * @param  int $sortAscending
     * @param  string $attrs
     * @return ResponseInterface
     */
    function searchCalendarResources(
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Search directory
     * 
     * @param  string $query
     * @param  int $maxResults
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  bool $applyConfig
     * @param  string $sortBy
     * @param  string $types
     * @param  bool $sortAscending
     * @param  bool $isCountOnly
     * @param  string $attrs
     * @return ResponseInterface
     */
    function searchDirectory(
        ?string $query = NULL,
        ?int $maxResults = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?bool $applyConfig = NULL,
        ?string $sortBy = NULL,
        ?string $types = NULL,
        ?bool $sortAscending = NULL,
        ?bool $isCountOnly = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Search Global Address Book (GAL)
     * 
     * @param  string $domain
     * @param  string $name
     * @param  int $limit
     * @param  GalSearchType $type
     * @param  string $galAccountId
     * @return ResponseInterface
     */
    function searchGal(
        ?string $domain,
        ?string $name = NULL,
        ?int $limit = NULL,
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL
    ): ResponseInterface;

    /**
     * Set current volume.
     * 
     * @param  int $id
     * @param  int $type
     * @return ResponseInterface
     */
    function setCurrentVolume(int $id, int $type): ResponseInterface;

    /**
     * Set local server online
     * 
     * @return ResponseInterface
     */
    function setLocalServerOnline(): ResponseInterface;

    /**
     * Set Password
     * 
     * @param string $id
     * @param string $newPassword
     * @return ResponseInterface
     */
    function setPassword(string $id, string $newPassword): ResponseInterface;

    /**
     * Set server offline
     * 
     * @param  ServerSelector $server
     * @param  string $attrs
     * @return ResponseInterface
     */
    function setServerOffline(?ServerSelector $server = NULL, ?string $attrs = NULL): ResponseInterface;

    /**
     * Sync GalAccount
     * If fullSync is set to false (or unset) the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync. 
     * If fullSync is set to true, then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * If reset attribute is set, then all the contacts will be populated again, regardless of the status since last sync. Reset needs to be done when there is a significant change in the configuration, such as filter, attribute map, or search base.
     * 
     * @param array $accounts
     * @return ResponseInterface
     */
    function syncGalAccount(array $accounts = []): ResponseInterface;

    /**
     * Undeploy Zimlet
     * 
     * @param  string $name
     * @param  string $action
     * @return ResponseInterface
     */
    function undeployZimlet(string $name, ?string $action = NULL): ResponseInterface;

    /**
     * Verify index
     * 
     * @param  MailboxByAccountIdSelector  $mbox
     * @return ResponseInterface
     */
    function verifyIndex(?MailboxByAccountIdSelector $mbox = NULL): ResponseInterface;

    /**
     * Verify Store Manager
     * 
     * @param int  $fileSize
     * @param int  $num
     * @param bool  $checkBlobs
     * @return ResponseInterface
     */
    function verifyStoreManager(
        ?int $fileSize = NULL,
        ?int $num = NULL,
        ?bool $checkBlobs = NULL
    ): ResponseInterface;
}
