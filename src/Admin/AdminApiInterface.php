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
    PolicyHolder,
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
use Zimbra\Common\Enum\{
    AdminFilterType,
    AutoProvTaskAction,
    CompactIndexAction,
    ContactBackupOp,
    CountObjectsType,
    DedupAction,
    GalMode,
    GalSearchType,
    GetSessionsSortBy,
    IpType,
    LockoutOperation,
    ReIndexAction,
    RightClass,
    SessionType,
    TargetType,
    ZimletDeployAction,
    ZimletExcludeType
};
use Zimbra\Common\Struct\{
    AccountSelector,
    AccountNameSelector,
    GranteeChooser,
    Id,
    NamedElement
};
use Zimbra\Mail\Struct\Policy;
use Zimbra\Common\Soap\ApiInterface;

/**
 * AdminApiInterface interface
 *
 * @package   Zimbra
 * @category  Admin
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface AdminApiInterface extends ApiInterface
{
    /**
     * Add an alias for the account
     *
     * @param  string $id
     * @param  string $alias
     * @return Message\AddAccountAliasResponse
     */
    function addAccountAlias(
        string $id,
        string $alias
    ): ?Message\AddAccountAliasResponse;

    /**
     * Changes logging settings on a per-account basis
     *
     * @param  LoggerInfo $logger
     * @param  AccountSelector $account
     * @param  string $id
     * @return Message\AddAccountLoggerResponse
     */
    function addAccountLogger(
        LoggerInfo $logger,
        ?AccountSelector $account = null,
        ?string $id = null
    ): ?Message\AddAccountLoggerResponse;

    /**
     * Add an alias for a distribution list
     *
     * @param  string $id
     * @param  string $alias
     * @return Message\AddDistributionListAliasResponse
     */
    function addDistributionListAlias(
        string $id,
        string $alias
    ): ?Message\AddDistributionListAliasResponse;

    /**
     * Adding members to a distribution list
     *
     * @param  string $id
     * @param  array  $members
     * @return Message\AddDistributionListMemberResponse
     */
    function addDistributionListMember(
        string $id,
        array $members
    ): ?Message\AddDistributionListMemberResponse;

    /**
     * Add a GalSync data source
     *
     * @param AccountSelector $account
     * @param string  $name
     * @param string  $domain
     * @param GalMode  $type
     * @param string  $folder
     * @param array  $attrs
     * @return Message\AddGalSyncDataSourceResponse
     */
    function addGalSyncDataSource(
        AccountSelector $account,
        string $name,
        string $domain,
        GalMode $type,
        ?string $folder = null,
        array $attrs = []
    ): ?Message\AddGalSyncDataSourceResponse;

    /**
     * Create a waitset to listen for changes on one or more accounts
     * Called once to initialize a WaitSet and to set its "default interest types"
     * WaitSet: scalable mechanism for listening for changes to one or more accounts
     *
     * @param string $defaultInterests
     * @param bool $allAccounts
     * @param array $accounts
     * @return Message\AdminCreateWaitSetResponse
     */
    function adminCreateWaitSet(
        string $defaultInterests,
        ?bool $allAccounts = null,
        array $accounts = []
    ): ?Message\AdminCreateWaitSetResponse;

    /**
     * Use this to close out the waitset.
     * Note that the server will automatically time out a wait set if there is no reference to it for (default of) 20 minutes.
     *
     * @param string  $waitSetId
     * @return Message\AdminDestroyWaitSetResponse
     */
    function adminDestroyWaitSet(
        string $waitSetId
    ): ?Message\AdminDestroyWaitSetResponse;

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
     * @return Message\AdminWaitSetResponse
     */
    function adminWaitSet(
        string $waitSetId,
        string $lastKnownSeqNo,
        ?bool $block = null,
        ?bool $expand = null,
        ?string $defaultInterests = null,
        ?int $timeout = null,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ): ?Message\AdminWaitSetResponse;

    /**
     * Authenticate for administration
     *
     * @param string  $name
     * @param string  $password
     * @param string  $authToken
     * @param AccountSelector $account
     * @param string  $virtualHost
     * @param bool    $persistAuthTokenCookie
     * @param bool    $csrfSupported
     * @param string  $twoFactorCode
     * @return Message\AuthResponse
     */
    function auth(
        ?string $name = null,
        ?string $password = null,
        ?string $authToken = null,
        ?AccountSelector $account = null,
        ?string $virtualHost = null,
        ?bool $persistAuthTokenCookie = null,
        ?bool $csrfSupported = null,
        ?string $twoFactorCode = null
    ): ?Message\AuthResponse;

    /**
     * Authenticate by auth token
     *
     * @param  string $authToken
     * @return Message\AuthResponse
     */
    function authByToken(string $authToken): ?Message\AuthResponse;

    /**
     * Perform an autocomplete for a name against the Global Address List
     *
     * @param string  $domain
     * @param string  $name
     * @param GalSearchType  $type
     * @param string  $galAccountId
     * @param int     $limit
     * @return Message\AutoCompleteGalResponse
     */
    function autoCompleteGal(
        string $domain,
        string $name,
        ?GalSearchType $type = null,
        ?string $galAccountId = null,
        ?int $limit = null
    ): ?Message\AutoCompleteGalResponse;

    /**
     * Auto-provision an account
     *
     * @param DomainSelector $domain
     * @param PrincipalSelector $principal
     * @param string  $password
     * @return Message\AutoProvAccountResponse
     */
    function autoProvAccount(
        DomainSelector $domain,
        PrincipalSelector $principal,
        ?string $password = null
    ): ?Message\AutoProvAccountResponse;

    /**
     * Under normal situations, the EAGER auto provisioning task(thread) should be started/stopped automatically by the server when appropriate.
     * The task should be running when zimbraAutoProvPollingInterval is not 0 and zimbraAutoProvScheduledDomains is not empty.
     * The task should be stopped otherwise. This API is to manually force start/stop or query status of the EAGER auto provisioning task.
     * It is only for diagnosis purpose and should not be used under normal situations.
     *
     * @param AutoProvTaskAction $action
     * @return Message\AutoProvTaskControlResponse
     */
    function autoProvTaskControl(
        AutoProvTaskAction $action
    ): ?Message\AutoProvTaskControlResponse;

    /**
     * Change Account
     *
     * @param AccountSelector $account
     * @param string $newName
     * @return Message\ChangePrimaryEmailResponse
     */
    function changePrimaryEmail(
        AccountSelector $account,
        string $newName
    ): ?Message\ChangePrimaryEmailResponse;

    /**
     * Check auth config
     *
     * @param string $name
     * @param string $password
     * @param array $attrs
     * @return Message\CheckAuthConfigResponse
     */
    function checkAuthConfig(
        string $name,
        string $password,
        array $attrs = []
    ): ?Message\CheckAuthConfigResponse;

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
     * @return Message\CheckBlobConsistencyResponse
     */
    function checkBlobConsistency(
        ?bool $checkSize = null,
        ?bool $reportUsedBlobs = null,
        array $volumes = [],
        array $mailboxes = []
    ): ?Message\CheckBlobConsistencyResponse;

    /**
     * Check existence of one or more directories and optionally create them.
     *
     * @param  array  $paths
     * @return Message\CheckDirectoryResponse
     */
    function checkDirectory(array $paths = []): ?Message\CheckDirectoryResponse;

    /**
     * Check Domain MX record
     *
     * @param  DomainSelector $domain
     * @return Message\CheckDomainMXRecordResponse
     */
    function checkDomainMXRecord(
        DomainSelector $domain = null
    ): ?Message\CheckDomainMXRecordResponse;

    /**
     * Check Exchange Authorisation
     *
     * @param  ExchangeAuthSpec $auth
     * @return Message\CheckExchangeAuthResponse
     */
    function checkExchangeAuth(
        ?ExchangeAuthSpec $auth = null
    ): ?Message\CheckExchangeAuthResponse;

    /**
     * Check Global Addressbook Configuration
     *
     * @param  LimitedQuery $query
     * @param  string $action
     * @param  array  $attrs
     * @return Message\CheckGalConfigResponse
     */
    function checkGalConfig(
        ?LimitedQuery $query = null,
        ?string $action = null,
        array $attrs = []
    ): ?Message\CheckGalConfigResponse;

    /**
     * Check Health
     *
     * @return Message\CheckHealthResponse
     */
    function checkHealth(): ?Message\CheckHealthResponse;

    /**
     * Check whether a hostname can be resolved
     *
     * @param  string $hostname
     * @return Message\CheckHostnameResolveResponse
     */
    function checkHostnameResolve(
        ?string $hostname = null
    ): ?Message\CheckHostnameResolveResponse;

    /**
     * Check password strength
     *
     * @param  string $id
     * @param  string $password
     * @return Message\CheckPasswordStrengthResponse
     */
    function checkPasswordStrength(
        string $id,
        string $password
    ): ?Message\CheckPasswordStrengthResponse;

    /**
     * Check if a principal has the specified right on target.
     *
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param CheckedRight $right
     * @param array $attrs
     * @return Message\CheckRightResponse
     */
    function checkRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        CheckedRight $right,
        array $attrs = []
    ): ?Message\CheckRightResponse;

    /**
     * Clear cookie
     *
     * @param array $cookies
     * @return Message\ClearCookieResponse
     */
    function clearCookie(array $cookies = []): ?Message\ClearCookieResponse;

    /**
     * Compact index
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @param  CompactIndexAction $action
     * @return Message\CompactIndexResponse
     */
    function compactIndex(
        MailboxByAccountIdSelector $mbox,
        ?CompactIndexAction $action = null
    ): ?Message\CompactIndexResponse;

    /**
     * Computes the aggregate quota usage for all domains in the system.
     *
     * @return Message\ComputeAggregateQuotaUsageResponse
     */
    function computeAggregateQuotaUsage(): ?Message\ComputeAggregateQuotaUsageResponse;

    /**
     * Configure Zimlet
     *
     * @param  AttachmentIdAttrib $content
     * @return Message\ConfigureZimletResponse
     */
    function configureZimlet(
        AttachmentIdAttrib $content
    ): ?Message\ConfigureZimletResponse;

    /**
     * start/stop contact backup
     *
     * @param  array $servers
     * @param  ContactBackupOp $op
     * @return Message\ContactBackupResponse
     */
    function contactBackup(
        array $servers = [],
        ?ContactBackupOp $op = null
    ): ?Message\ContactBackupResponse;

    /**
     * Copy Class of service (COS)
     *
     * @param  CosSelector $cos
     * @param  string $newName
     * @return Message\CopyCosResponse
     */
    function copyCos(
        ?CosSelector $cos = null,
        ?string $newName = null
    ): ?Message\CopyCosResponse;

    /**
     * Count number of accounts by cos in a domain
     *
     * @param DomainSelector $domain
     * @return Message\CountAccountResponse
     */
    function countAccount(
        DomainSelector $domain
    ): ?Message\CountAccountResponse;

    /**
     * Count number of objects.
     *
     * @param  CountObjectsType $type
     * @param  array $domains
     * @param  UcServiceSelector $ucService
     * @param  bool $onlyRelated
     * @return Message\CountObjectsResponse
     */
    function countObjects(
        ?CountObjectsType $type = null,
        array $domains = [],
        ?UcServiceSelector $ucService = null,
        ?bool $onlyRelated = null
    ): ?Message\CountObjectsResponse;

    /**
     * Create account
     *
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return Message\CreateAccountResponse
     */
    function createAccount(
        string $name,
        ?string $password = null,
        array $attrs = []
    ): ?Message\CreateAccountResponse;

    /**
     * Create a AlwaysOnCluster
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateAlwaysOnClusterResponse
     */
    function createAlwaysOnCluster(
        string $name,
        array $attrs = []
    ): ?Message\CreateAlwaysOnClusterResponse;

    /**
     * Create a calendar resource
     *
     * @param string $name
     * @param string $password
     * @param array  $attrs
     * @return Message\CreateCalendarResourceResponse
     */
    function createCalendarResource(
        string $name,
        ?string $password = null,
        array $attrs = []
    ): ?Message\CreateCalendarResourceResponse;

    /**
     * Create a Class of Service (COS)
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateCosResponse
     */
    function createCos(
        string $name,
        array $attrs = []
    ): ?Message\CreateCosResponse;

    /**
     * Creates a data source that imports mail items into the specified folder.
     *
     * @param DataSourceSpecifier $dataSource
     * @param string $id
     * @return Message\CreateDataSourceResponse
     */
    function createDataSource(
        DataSourceSpecifier $dataSource,
        string $id = ""
    ): ?Message\CreateDataSourceResponse;

    /**
     * Create a distribution list
     *
     * @param string $name
     * @param bool   $dynamic
     * @param array  $attrs
     * @return Message\CreateDistributionListResponse
     */
    function createDistributionList(
        string $name,
        ?bool $dynamic = null,
        array $attrs = []
    ): ?Message\CreateDistributionListResponse;

    /**
     * Create a domain
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateDomainResponse
     */
    function createDomain(
        string $name,
        array $attrs = []
    ): ?Message\CreateDomainResponse;

    /**
     * Create Global Address List (GAL) Synchronisation account
     *
     * @param AccountSelector  $account
     * @param string  $name
     * @param string  $domain
     * @param string  $mailHost
     * @param GalMode $type
     * @param string  $password
     * @param string  $folder
     * @param array   $attrs
     * @return Message\CreateGalSyncAccountResponse
     */
    function createGalSyncAccount(
        AccountSelector $account,
        string $name,
        string $domain,
        string $mailHost,
        ?GalMode $type = null,
        ?string $password = null,
        ?string $folder = null,
        array $attrs = []
    ): ?Message\CreateGalSyncAccountResponse;

    /**
     * Create an LDAP entry
     *
     * @param string $dn
     * @param array  $attrs
     * @return Message\CreateLDAPEntryResponse
     */
    function createLDAPEntry(
        string $dn,
        array $attrs = []
    ): ?Message\CreateLDAPEntryResponse;

    /**
     * Create a Server
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateServerResponse
     */
    function createServer(
        string $name,
        array $attrs = []
    ): ?Message\CreateServerResponse;

    /**
     * Create a system retention policy.
     *
     * @param  CosSelector  $cos
     * @param  PolicyHolder $keep
     * @param  PolicyHolder $purge
     * @return Message\CreateSystemRetentionPolicyResponse
     */
    function createSystemRetentionPolicy(
        ?CosSelector $cos = null,
        ?PolicyHolder $keep = null,
        ?PolicyHolder $purge = null
    ): ?Message\CreateSystemRetentionPolicyResponse;

    /**
     * Create a UC service
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateUCServiceResponse
     */
    function createUCService(
        string $name,
        array $attrs = []
    ): ?Message\CreateUCServiceResponse;

    /**
     * Create a volume
     *
     * @param VolumeInfo $volume
     * @return Message\CreateVolumeResponse
     */
    function createVolume(VolumeInfo $volume): ?Message\CreateVolumeResponse;

    /**
     * Create an XMPP component
     *
     * @param XMPPComponentSpec $component
     * @return Message\CreateXMPPComponentResponse
     */
    function createXMPPComponent(
        XMPPComponentSpec $component
    ): ?Message\CreateXMPPComponentResponse;

    /**
     * Create a Zimlet
     *
     * @param string $name
     * @param array  $attrs
     * @return Message\CreateZimletResponse
     */
    function createZimlet(
        string $name,
        array $attrs = []
    ): ?Message\CreateZimletResponse;

    /**
     * Dedupe the blobs having the same digest.
     *
     * @param  DedupAction $action
     * @param  array $volumes
     * @return Message\DedupeBlobsResponse
     */
    function dedupeBlobs(
        ?DedupAction $action = null,
        array $volumes = []
    ): ?Message\DedupeBlobsResponse;

    /**
     * Used to request a new auth token that is valid for the specified account.
     * The id of the auth token will be the id of the target account, and the requesting admin's id will be stored in
     * the auth token for auditing purposes.
     *
     * @param  AccountSelector $account
     * @param  int $duration
     * @return Message\DelegateAuthResponse
     */
    function delegateAuth(
        AccountSelector $account,
        ?int $duration = null
    ): ?Message\DelegateAuthResponse;

    /**
     * Deletes the account with the given id.
     *
     * @param  string $id
     * @return Message\DeleteAccountResponse
     */
    function deleteAccount(string $id): ?Message\DeleteAccountResponse;

    /**
     * Delete a alwaysOnCluster
     *
     * @param  string $id
     * @return Message\DeleteAlwaysOnClusterResponse
     */
    function deleteAlwaysOnCluster(
        string $id
    ): ?Message\DeleteAlwaysOnClusterResponse;

    /**
     * Deletes the calendar resource with the given id.
     *
     * @param  string $id
     * @return Message\DeleteCalendarResourceResponse
     */
    function deleteCalendarResource(
        string $id
    ): ?Message\DeleteCalendarResourceResponse;

    /**
     * Delete a Class of Service (COS)
     *
     * @param  string $id
     * @return Message\DeleteCosResponse
     */
    function deleteCos(string $id): ?Message\DeleteCosResponse;

    /**
     * Deletes the given data source.
     *
     * @param Id     $dataSource
     * @param string $id
     * @param array  $attrs
     * @return Message\DeleteDataSourceResponse
     */
    function deleteDataSource(
        Id $dataSource,
        string $id,
        array $attrs = []
    ): ?Message\DeleteDataSourceResponse;

    /**
     * Delete a distribution list
     *
     * @param  string $id
     * @param  bool   $cascadeDelete
     * @return Message\DeleteDistributionListResponse
     */
    function deleteDistributionList(
        string $id,
        ?bool $cascadeDelete = null
    ): ?Message\DeleteDistributionListResponse;

    /**
     * Delete a domain
     *
     * @param  string $id
     * @return Message\DeleteDomainResponse
     */
    function deleteDomain(string $id): ?Message\DeleteDomainResponse;

    /**
     * Delete a Global Address List (GAL) Synchronisation account
     *
     * @param  AccountSelector $account
     * @return Message\DeleteGalSyncAccountResponse
     */
    function deleteGalSyncAccount(
        AccountSelector $account
    ): ?Message\DeleteGalSyncAccountResponse;

    /**
     * Delete a LDAP entry
     *
     * @param  string $dn
     * @return Message\DeleteLDAPEntryResponse
     */
    function deleteLDAPEntry(string $dn): ?Message\DeleteLDAPEntryResponse;

    /**
     * Delete a mailbox
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @return Message\DeleteMailboxResponse
     */
    function deleteMailbox(
        ?MailboxByAccountIdSelector $mbox = null
    ): ?Message\DeleteMailboxResponse;

    /**
     * Delete a server
     *
     * @param  string $id
     * @return Message\DeleteServerResponse
     */
    function deleteServer(string $id): ?Message\DeleteServerResponse;

    /**
     * Delete a system retention policy.
     *
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return Message\DeleteSystemRetentionPolicyResponse
     */
    function deleteSystemRetentionPolicy(
        Policy $policy,
        ?CosSelector $cos = null
    ): ?Message\DeleteSystemRetentionPolicyResponse;

    /**
     * Delete a UC service
     *
     * @param  string $id
     * @return Message\DeleteUCServiceResponse
     */
    function deleteUCService(string $id): ?Message\DeleteUCServiceResponse;

    /**
     * Delete a volume
     *
     * @param  int $id
     * @return Message\DeleteVolumeResponse
     */
    function deleteVolume(int $id): ?Message\DeleteVolumeResponse;

    /**
     * Delete an XMPP Component
     *
     * @param  XMPPComponentSelector $component
     * @return Message\DeleteXMPPComponentResponse
     */
    function deleteXMPPComponent(
        ?XMPPComponentSelector $component = null
    ): ?Message\DeleteXMPPComponentResponse;

    /**
     * Delete a Zimlet
     *
     * @param  NamedElement $zimlet
     * @return Message\DeleteZimletResponse
     */
    function deleteZimlet(NamedElement $zimlet): ?Message\DeleteZimletResponse;

    /**
     * Deploy Zimlet(s)
     *
     * @param  AttachmentIdAttrib $content
     * @param  ZimletDeployAction $action
     * @param  bool $flushCache
     * @param  bool $synchronous
     * @return Message\DeployZimletResponse
     */
    function deployZimlet(
        AttachmentIdAttrib $content,
        ?ZimletDeployAction $action = null,
        ?bool $flushCache = null,
        ?bool $synchronous = null
    ): ?Message\DeployZimletResponse;

    /**
     * Dump sessions
     *
     * @param  bool $includeAccounts
     * @param  bool $groupByAccount
     * @return Message\DumpSessionsResponse
     */
    function dumpSessions(
        ?bool $includeAccounts = null,
        ?bool $groupByAccount = null
    ): ?Message\DumpSessionsResponse;

    /**
     * Exports the database data for the given items with SELECT INTO OUTFILE and deletes the items from the mailbox.
     *
     * @param  ExportAndDeleteMailboxSpec $mailbox
     * @param  string $exportDir
     * @param  string $exportFilenamePrefix
     * @return Message\ExportAndDeleteItemsResponse
     */
    function exportAndDeleteItems(
        ExportAndDeleteMailboxSpec $mailbox,
        ?string $exportDir = null,
        ?string $exportFilenamePrefix = null
    ): ?Message\ExportAndDeleteItemsResponse;

    /**
     * Fix Calendar End Times
     *
     * @param  bool $sync
     * @param  array $accounts
     * @return Message\FixCalendarEndTimeResponse
     */
    function fixCalendarEndTime(
        ?bool $sync = null,
        array $accounts = []
    ): ?Message\FixCalendarEndTimeResponse;

    /**
     * Fix Calendar priority
     *
     * @param  bool $sync
     * @param  array $accounts
     * @return Message\FixCalendarPriorityResponse
     */
    function fixCalendarPriority(
        ?bool $sync = null,
        array $accounts = []
    ): ?Message\FixCalendarPriorityResponse;

    /**
     * Fix timezone definitions in appointments and tasks to reflect changes in daylight savings time rules in various timezones.
     *
     * @param  bool $sync
     * @param  int $after
     * @param  array $accounts
     * @param  TzFixup $tzFixup
     * @return Message\FixCalendarTZResponse
     */
    function fixCalendarTZ(
        ?bool $sync = null,
        ?int $after = null,
        array $accounts = [],
        ?TzFixup $tzFixup = null
    ): ?Message\FixCalendarTZResponse;

    /**
     * Flush memory cache for specified LDAP or directory scan type/entries
     *
     * @param  CacheSelector $cache
     * @return Message\FlushCacheResponse
     */
    function flushCache(
        ?CacheSelector $cache = null
    ): ?Message\FlushCacheResponse;

    /**
     * Get attributes related to an account
     *
     * @param  AccountSelector $account
     * @param  bool $applyCos
     * @param  bool $effectiveQuota
     * @param  string $attrs
     * @return Message\GetAccountResponse
     */
    function getAccount(
        AccountSelector $account,
        ?bool $applyCos = null,
        ?bool $effectiveQuota = null,
        ?string $attrs = null
    ): ?Message\GetAccountResponse;

    /**
     * Get information about an account
     *
     * @param  AccountSelector $account
     * @return Message\GetAccountInfoResponse
     */
    function getAccountInfo(
        AccountSelector $account
    ): ?Message\GetAccountInfoResponse;

    /**
     * Returns custom loggers created for the given account since the last server start.
     * If the request is sent to a server other than the one that the account resides on, it is proxied to the correct server.
     *
     * @param  string $id
     * @param  AccountSelector $account
     * @return Message\GetAccountLoggersResponse
     */
    function getAccountLoggers(
        ?string $id = null,
        ?AccountSelector $account = null
    ): ?Message\GetAccountLoggersResponse;

    /**
     * Get distribution lists an account is a member of
     *
     * @param  AccountSelector $account
     * @return Message\GetAccountMembershipResponse
     */
    function getAccountMembership(
        AccountSelector $account
    ): ?Message\GetAccountMembershipResponse;

    /**
     * Returns the union of the zimbraAdminConsoleUIComponents values on the specified account/dl entry and that on all admin groups the entry belongs to.
     *
     * @param  AccountSelector $account
     * @param  DistributionListSelector $dl
     * @return Message\GetAdminConsoleUICompResponse
     */
    function getAdminConsoleUIComp(
        ?AccountSelector $account = null,
        ?DistributionListSelector $dl = null
    ): ?Message\GetAdminConsoleUICompResponse;

    /**
     * Returns the admin extension addon Zimlets.
     *
     * @return Message\GetAdminExtensionZimletsResponse
     */
    function getAdminExtensionZimlets(): ?Message\GetAdminExtensionZimletsResponse;

    /**
     * Returns admin saved searches.
     *
     * @param array $searches
     * @return Message\GetAdminSavedSearchesResponse
     */
    function getAdminSavedSearches(
        array $searches = []
    ): ?Message\GetAdminSavedSearchesResponse;

    /**
     * Get the aggregate quota usage for all domains on the server.
     *
     * @return Message\GetAggregateQuotaUsageOnServerResponse
     */
    function getAggregateQuotaUsageOnServer(): ?Message\GetAggregateQuotaUsageOnServerResponse;

    /**
     * Returns all account loggers that have been created on the given server since the last server start.
     *
     * @return Message\GetAllAccountLoggersResponse
     */
    function getAllAccountLoggers(): ?Message\GetAllAccountLoggersResponse;

    /**
     * Get All accounts matching the selectin criteria
     *
     * @param  ServerSelector $server
     * @param  DomainSelector $domain
     * @return Message\GetAllAccountsResponse
     */
    function getAllAccounts(
        ?ServerSelector $server = null,
        ?DomainSelector $domain = null
    ): ?Message\GetAllAccountsResponse;

    /**
     * Returns all active servers.
     *
     * @return Message\GetAllActiveServersResponse
     */
    function getAllActiveServers(): ?Message\GetAllActiveServersResponse;

    /**
     * Get all Admin accounts
     *
     * @param  bool $applyCos
     * @return Message\GetAllAdminAccountsResponse
     */
    function getAllAdminAccounts(
        ?bool $applyCos = null
    ): ?Message\GetAllAdminAccountsResponse;

    /**
     * Get all alwaysOnClusters
     *
     * @return Message\GetAllAlwaysOnClustersResponse
     */
    function getAllAlwaysOnClusters(): ?Message\GetAllAlwaysOnClustersResponse;

    /**
     * Get all calendar resources that match the selection criteria
     *
     * @param  ServerSelector $server
     * @param  DomainSelector $domain
     * @return Message\GetAllCalendarResourcesResponse
     */
    function getAllCalendarResources(
        ?ServerSelector $server = null,
        ?DomainSelector $domain = null
    ): ?Message\GetAllCalendarResourcesResponse;

    /**
     * Get all config
     *
     * @return Message\GetAllConfigResponse
     */
    function getAllConfig(): ?Message\GetAllConfigResponse;

    /**
     * Get all classes of service (COS)
     *
     * @return Message\GetAllCosResponse
     */
    function getAllCos(): ?Message\GetAllCosResponse;

    /**
     * Get all distribution lists that match the selection criteria
     *
     * @param  DomainSelector $domain
     * @return Message\GetAllDistributionListsResponse
     */
    function getAllDistributionLists(
        ?DomainSelector $domain = null
    ): ?Message\GetAllDistributionListsResponse;

    /**
     * Get all domains
     *
     * @param  bool $applyConfig
     * @return Message\GetAllDomainsResponse
     */
    function getAllDomains(
        ?bool $applyConfig = null
    ): ?Message\GetAllDomainsResponse;

    /**
     * Get all effective Admin rights
     *
     * @param  GranteeSelector $grantee
     * @param  bool $expandSetAttrs
     * @param  bool $expandGetAttrs
     * @return Message\GetAllEffectiveRightsResponse
     */
    function getAllEffectiveRights(
        ?GranteeSelector $grantee = null,
        ?bool $expandSetAttrs = null,
        ?bool $expandGetAttrs = null
    ): ?Message\GetAllEffectiveRightsResponse;

    /**
     * Get all free/busy providers
     *
     * @return Message\GetAllFreeBusyProvidersResponse
     */
    function getAllFreeBusyProviders(): ?Message\GetAllFreeBusyProvidersResponse;

    /**
     * Returns all locales defined in the system.
     *
     * @return Message\GetAllLocalesResponse
     */
    function getAllLocales(): ?Message\GetAllLocalesResponse;

    /**
     * Return all mailboxes
     *
     * @param  int $limit
     * @param  int $offset
     * @return Message\GetAllMailboxesResponse
     */
    function getAllMailboxes(
        ?int $limit = null,
        ?int $offset = null
    ): ?Message\GetAllMailboxesResponse;

    /**
     * Get all system defined rights
     *
     * @param  string $targetType
     * @param  bool $expandAllAttrs
     * @param  RightClass $rightClass
     * @return Message\GetAllRightsResponse
     */
    function getAllRights(
        ?string $targetType = null,
        ?bool $expandAllAttrs = null,
        ?RightClass $rightClass = null
    ): ?Message\GetAllRightsResponse;

    /**
     * Get all servers defined in the system or all servers that have a particular service enabled (eg, mta, antispam, spell).
     *
     * @param  string $service
     * @param  string $alwaysOnClusterId
     * @param  bool $applyConfig
     * @return Message\GetAllServersResponse
     */
    function getAllServers(
        ?string $service = null,
        ?string $alwaysOnClusterId = null,
        ?bool $applyConfig = null
    ): ?Message\GetAllServersResponse;

    /**
     * Get all installed skins on the server.
     *
     * @return Message\GetAllSkinsResponse
     */
    function getAllSkins(): ?Message\GetAllSkinsResponse;

    /**
     * Get all ucservices defined in the system
     *
     * @return Message\GetAllUCServicesResponse
     */
    function getAllUCServices(): ?Message\GetAllUCServicesResponse;

    /**
     * Get all volumes
     *
     * @return Message\GetAllVolumesResponse
     */
    function getAllVolumes(): ?Message\GetAllVolumesResponse;

    /**
     * Get all XMPP components
     *
     * @return Message\GetAllXMPPComponentsResponse
     */
    function getAllXMPPComponents(): ?Message\GetAllXMPPComponentsResponse;

    /**
     * Get all Zimlets
     *
     * @param  ZimletExcludeType $exclude
     * @return Message\GetAllZimletsResponse
     */
    function getAllZimlets(
        ?ZimletExcludeType $exclude = null
    ): ?Message\GetAllZimletsResponse;

    /**
     * Get Always On Cluster
     *
     * @param  AlwaysOnClusterSelector $cluster
     * @param  string $attrs
     * @return Message\GetAlwaysOnClusterResponse
     */
    function getAlwaysOnCluster(
        ?AlwaysOnClusterSelector $cluster = null,
        ?string $attrs = null
    ): ?Message\GetAlwaysOnClusterResponse;

    /**
     * Get attribute information
     *
     * @param  string $attrs
     * @param  string $entryTypes
     * @return Message\GetAttributeInfoResponse
     */
    function getAttributeInfo(
        ?string $attrs = null,
        ?string $entryTypes = null
    ): ?Message\GetAttributeInfoResponse;

    /**
     * Get a calendar resource
     *
     * @param  CalendarResourceSelector $calResource
     * @param  bool $applyCos
     * @param  string $attrs
     * @return Message\GetCalendarResourceResponse
     */
    function getCalendarResource(
        ?CalendarResourceSelector $calResource = null,
        ?bool $applyCos = null,
        ?string $attrs = null
    ): ?Message\GetCalendarResourceResponse;

    /**
     * Get config
     *
     * @param  Attr $attr
     * @return Message\GetConfigResponse
     */
    function getConfig(?Attr $attr = null): ?Message\GetConfigResponse;

    /**
     * Get Class Of Service (COS)
     *
     * @param  CosSelector $cos
     * @param  string $attrs
     * @return Message\GetCosResponse
     */
    function getCos(
        CosSelector $cos,
        ?string $attrs = null
    ): ?Message\GetCosResponse;

    /**
     * Returns attributes, with defaults and constraints if any,  that can be set by the admin when an object is created.
     *
     * @param  TargetWithType $target
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @return Message\GetCreateObjectAttrsResponse
     */
    function getCreateObjectAttrs(
        TargetWithType $target,
        ?DomainSelector $domain = null,
        ?CosSelector $cos = null
    ): ?Message\GetCreateObjectAttrsResponse;

    /**
     * Get current volumes
     *
     * @return Message\GetCurrentVolumesResponse
     */
    function getCurrentVolumes(): ?Message\GetCurrentVolumesResponse;

    /**
     * Returns all data sources defined for the given mailbox.
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\GetDataSourcesResponse
     */
    function getDataSources(
        string $id,
        array $attrs = []
    ): ?Message\GetDataSourcesResponse;

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
     * @return Message\GetDelegatedAdminConstraintsResponse
     */
    function getDelegatedAdminConstraints(
        TargetType $type,
        ?string $id = null,
        ?string $name = null,
        array $attrs = []
    ): ?Message\GetDelegatedAdminConstraintsResponse;

    /**
     * Get a Distribution List
     *
     * @param  DistributionListSelector $dl
     * @param  int $limit
     * @param  int $offset
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return Message\GetDistributionListResponse
     */
    function getDistributionList(
        ?DistributionListSelector $dl = null,
        ?int $limit = null,
        ?int $offset = null,
        ?bool $sortAscending = null,
        ?string $attrs = null
    ): ?Message\GetDistributionListResponse;

    /**
     * Request a list of DLs that a particular DL is a member of
     *
     * @param  DistributionListSelector $dl
     * @param  int $limit
     * @param  int $offset
     * @return Message\GetDistributionListMembershipResponse
     */
    function getDistributionListMembership(
        ?DistributionListSelector $dl = null,
        ?int $limit = null,
        ?int $offset = null
    ): ?Message\GetDistributionListMembershipResponse;

    /**
     * Get information about a domain
     *
     * @param  DomainSelector $domain
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return Message\GetDomainResponse
     */
    function getDomain(
        ?DomainSelector $domain = null,
        ?bool $applyConfig = null,
        ?string $attrs = null
    ): ?Message\GetDomainResponse;

    /**
     * Get Domain information
     * This call does not require an auth token.
     * It returns attributes that are pertinent to domain settings for cases when the user is not authenticated.
     * For example, URL to direct the user to upon logging out or when auth token is expired.
     *
     * @param  DomainSelector $domain
     * @param  bool $applyConfig
     * @return Message\GetDomainInfoResponse
     */
    function getDomainInfo(
        ?DomainSelector $domain = null,
        ?bool $applyConfig = null
    ): ?Message\GetDomainInfoResponse;

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
     * @return Message\GetEffectiveRightsResponse
     */
    function getEffectiveRights(
        EffectiveRightsTargetSelector $target,
        ?GranteeSelector $grantee = null,
        ?bool $expandSetAttrs = null,
        ?bool $expandGetAttrs = null
    ): ?Message\GetEffectiveRightsResponse;

    /**
     * Get filter rules
     *
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @return Message\GetFilterRulesResponse
     */
    function getFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = null,
        ?DomainSelector $domain = null,
        ?CosSelector $cos = null,
        ?ServerSelector $server = null
    ): ?Message\GetFilterRulesResponse;

    /**
     * Get Free/Busy provider information
     * If the optional element <provider> is present in the request, the response contains the requested provider only.
     * if no provider is supplied in the request, the response contains all the providers.
     *
     * @param  NamedElement $provider
     * @return Message\GetFreeBusyQueueInfoResponse
     */
    function getFreeBusyQueueInfo(
        ?NamedElement $provider = null
    ): ?Message\GetFreeBusyQueueInfoResponse;

    /**
     * Returns all grants on the specified target entry, or all grants granted to the specified grantee entry.
     * The authenticated admin must have an effective "viewGrants" (TBD) system right on the specified target/grantee.
     * At least one of <target> or <grantee> must be specified.
     * If both <target> and <grantee> are specified, only grants that are granted on the target to the grantee are returned.
     *
     * @param  EffectiveRightsTargetSelector $target
     * @param  GranteeSelector $grantee
     * @return Message\GetGrantsResponse
     */
    function getGrants(
        ?EffectiveRightsTargetSelector $target = null,
        ?GranteeSelector $grantee = null
    ): ?Message\GetGrantsResponse;

    /**
     * Get index stats
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @return Message\GetIndexStatsResponse
     */
    function getIndexStats(
        MailboxByAccountIdSelector $mbox
    ): ?Message\GetIndexStatsResponse;

    /**
     * Fetches ldap entry (or entries) by a search-base ({ldap-search-base}) and a search query ({query}).
     *
     * @param  string $ldapSearchBase
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  int $limit
     * @param  int $offset
     * @param  string $query
     * @return Message\GetLDAPEntriesResponse
     */
    function getLDAPEntries(
        string $ldapSearchBase,
        ?string $sortBy = null,
        ?bool $sortAscending = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $query = null
    ): ?Message\GetLDAPEntriesResponse;

    /**
     * Get License information
     *
     * @return Message\GetLicenseInfoResponse
     */
    function getLicenseInfo(): ?Message\GetLicenseInfoResponse;

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
     * @return Message\GetLoggerStatsResponse
     */
    function getLoggerStats(
        ?HostName $hostName = null,
        ?StatsSpec $stats = null,
        ?TimeAttr $startTime = null,
        ?TimeAttr $endTime = null
    ): ?Message\GetLoggerStatsResponse;

    /**
     * Get a Mailbox
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @return Message\GetMailboxResponse
     */
    function getMailbox(
        ?MailboxByAccountIdSelector $mbox = null
    ): ?Message\GetMailboxResponse;

    /**
     * Get MailBox Statistics
     *
     * @return Message\GetMailboxStatsResponse
     */
    function getMailboxStats(): ?Message\GetMailboxStatsResponse;

    /**
     * Summarize and/or search a particular mail queue on a particular server.
     *
     * @param  ServerMailQueueQuery $server
     * @return Message\GetMailQueueResponse
     */
    function getMailQueue(
        ServerMailQueueQuery $server
    ): ?Message\GetMailQueueResponse;

    /**
     * Get a count of all the mail queues by counting the number of files in the queue directories.
     *
     * @param  NamedElement $server
     * @return Message\GetMailQueueInfoResponse
     */
    function getMailQueueInfo(
        NamedElement $server
    ): ?Message\GetMailQueueInfoResponse;

    /**
     * Returns the memcached client configuration on a mailbox server.
     *
     * @return Message\GetMemcachedClientConfigResponse
     */
    function getMemcachedClientConfig(): ?Message\GetMemcachedClientConfigResponse;

    /**
     * Get filter rules
     *
     * @return Message\GetOutgoingFilterRulesResponse
     */
    function getOutgoingFilterRules(): ?Message\GetOutgoingFilterRulesResponse;

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
     * @return Message\GetQuotaUsageResponse
     */
    function getQuotaUsage(
        ?string $domain = null,
        ?bool $allServers = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $sortBy = null,
        ?bool $sortAscending = null,
        ?bool $refresh = null
    ): ?Message\GetQuotaUsageResponse;

    /**
     * Get definition of a right
     *
     * @param  string $right
     * @param  bool $expandAllAttrs
     * @return Message\GetRightResponse
     */
    function getRight(
        string $right,
        ?bool $expandAllAttrs = null
    ): ?Message\GetRightResponse;

    /**
     * Get Rights Document
     *
     * @param array $pkgs
     * @return Message\GetRightsDocResponse
     */
    function getRightsDoc(array $pkgs = []): ?Message\GetRightsDocResponse;

    /**
     * Get Server
     *
     * @param  ServerSelector $server
     * @param  bool $applyConfig
     * @param  string $attrs
     * @return Message\GetServerResponse
     */
    function getServer(
        ?ServerSelector $server = null,
        ?bool $applyConfig = null,
        ?string $attrs = null
    ): ?Message\GetServerResponse;

    /**
     * Get Network Interface information for a server
     *
     * @param  ServerSelector $server
     * @param  IpType $type
     * @return Message\GetServerNIfsResponse
     */
    function getServerNIfs(
        ServerSelector $server,
        ?IpType $type = null
    ): ?Message\GetServerNIfsResponse;

    /**
     * Returns server monitoring stats.
     * These are the same stats that are logged to mailboxd.csv.
     * If no stat element is specified, all server stats are returned.
     *
     * @param array $stats
     * @return Message\GetServerStatsResponse
     */
    function getServerStats(array $stats = []): ?Message\GetServerStatsResponse;

    /**
     * Get Service Status
     *
     * @return Message\GetServiceStatusResponse
     */
    function getServiceStatus(): ?Message\GetServiceStatusResponse;

    /**
     * Get Sessions
     *
     * @param  SessionType $type
     * @param  GetSessionsSortBy $sortBy
     * @param  int $offset
     * @param  int $limit
     * @param  bool $refresh
     * @return Message\GetSessionsResponse
     */
    function getSessions(
        SessionType $type,
        ?GetSessionsSortBy $sortBy = null,
        ?int $offset = null,
        ?int $limit = null,
        ?bool $refresh = null
    ): ?Message\GetSessionsResponse;

    /**
     * Iterate through all folders of the owner's mailbox and return shares that match grantees specified by the <grantee> specifier.
     *
     * @param  AccountSelector $owner
     * @param  GranteeChooser $grantee
     * @return Message\GetShareInfoResponse
     */
    function getShareInfo(
        AccountSelector $owner,
        ?GranteeChooser $grantee = null
    ): ?Message\GetShareInfoResponse;

    /**
     * Get System Retention Policy
     * The system retention policy SOAP APIs allow the administrator to edit named system retention policies that users
     * can apply to folders and tags.
     *
     * @param  CosSelector $cos
     * @return Message\GetSystemRetentionPolicyResponse
     */
    function getSystemRetentionPolicy(
        ?CosSelector $cos = null
    ): ?Message\GetSystemRetentionPolicyResponse;

    /**
     * Get UC Service
     *
     * @param  UcServiceSelector $ucService
     * @param  string $attrs
     * @return Message\GetUCServiceResponse
     */
    function getUCService(
        UcServiceSelector $ucService,
        ?string $attrs = null
    ): ?Message\GetUCServiceResponse;

    /**
     * Get version information
     *
     * @return Message\GetVersionInfoResponse
     */
    function getVersionInfo(): ?Message\GetVersionInfoResponse;

    /**
     * Get Volume
     *
     * @param  int $id
     * @return Message\GetVolumeResponse
     */
    function getVolume(int $id): ?Message\GetVolumeResponse;

    /**
     * Get XMPP Component
     *
     * @param  XMPPComponentSelector $component
     * @param  string $attrs
     * @return Message\GetXMPPComponentResponse
     */
    function getXMPPComponent(
        XMPPComponentSelector $component,
        ?string $attrs = null
    ): ?Message\GetXMPPComponentResponse;

    /**
     * Get Zimlet
     *
     * @param  NamedElement $zimlet
     * @param  string $attrs
     * @return Message\GetZimletResponse
     */
    function getZimlet(
        NamedElement $zimlet,
        ?string $attrs = null
    ): ?Message\GetZimletResponse;

    /**
     * Get status for Zimlets
     *
     * @return Message\GetZimletStatusResponse
     */
    function getZimletStatus(): ?Message\GetZimletStatusResponse;

    /**
     * Grant a right on a target to an individual or group grantee.
     *
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param RightModifierInfo $right
     * @return Message\GrantRightResponse
     */
    function grantRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): ?Message\GrantRightResponse;

    /**
     * Puts the mailbox of the specified account into maintenance lockout or removes it from maintenance lockout
     *
     * @param  AccountNameSelector $account
     * @param  LockoutOperation $operation
     * @return Message\LockoutMailboxResponse
     */
    function lockoutMailbox(
        AccountNameSelector $account,
        ?LockoutOperation $operation = null
    ): ?Message\LockoutMailboxResponse;

    /**
     * Command to act on invidual queue files. This proxies through to postsuper.
     *
     * @param  ServerWithQueueAction $server
     * @return Message\MailQueueActionResponse
     */
    function mailQueueAction(
        ServerWithQueueAction $server
    ): ?Message\MailQueueActionResponse;

    /**
     * Command to invoke postqueue -f.
     * All queues cached in the server are stale after invoking this because this is a global operation to all the queues in a given server.
     *
     * @param  NamedElement $server
     * @return Message\MailQueueFlushResponse
     */
    function mailQueueFlush(
        NamedElement $server
    ): ?Message\MailQueueFlushResponse;

    /**
     * Migrate an account
     *
     * @param  IdAndAction $migrate
     * @return Message\MigrateAccountResponse
     */
    function migrateAccount(
        IdAndAction $migrate
    ): ?Message\MigrateAccountResponse;

    /**
     * Modify an account
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyAccountResponse
     */
    function modifyAccount(
        string $id,
        array $attrs = []
    ): ?Message\ModifyAccountResponse;

    /**
     * Modifies admin saved searches.
     * Returns the admin saved searches.
     *
     * @param array $searches
     * @return Message\ModifyAdminSavedSearchesResponse
     */
    function modifyAdminSavedSearches(
        array $searches = []
    ): ?Message\ModifyAdminSavedSearchesResponse;

    /**
     * Modify attributes for a alwaysOnCluster
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyAlwaysOnClusterResponse
     */
    function modifyAlwaysOnCluster(
        string $id,
        array $attrs = []
    ): ?Message\ModifyAlwaysOnClusterResponse;

    /**
     * Modify a calendar resource
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyCalendarResourceResponse
     */
    function modifyCalendarResource(
        string $id,
        array $attrs = []
    ): ?Message\ModifyCalendarResourceResponse;

    /**
     * Modify Configuration attributes
     *
     * @param array $attrs
     * @return Message\ModifyConfigResponse
     */
    function modifyConfig(array $attrs = []): ?Message\ModifyConfigResponse;

    /**
     * Modify Class of Service (COS) attributes
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyCosResponse
     */
    function modifyCos(
        string $id,
        array $attrs = []
    ): ?Message\ModifyCosResponse;

    /**
     * Changes attributes of the given data source.
     * Only the attributes specified in the request are modified.
     * To change the name, specify "zimbraDataSourceName" as an attribute.
     *
     * @param DataSourceInfo $dataSource
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyDataSourceResponse
     */
    function modifyDataSource(
        DataSourceInfo $dataSource,
        string $id,
        array $attrs = []
    ): ?Message\ModifyDataSourceResponse;

    /**
     * Modify constraint (zimbraConstraint) for delegated admin on global config or a COS
     * If constraints for an attribute already exists, it will be replaced by the new constraints.
     * If <constraint> is an empty element, constraints for the attribute will be removed.
     *
     * @param TargetType $type
     * @param string $id
     * @param string $name
     * @param array  $attrs
     * @return Message\ModifyDelegatedAdminConstraintsResponse
     */
    function modifyDelegatedAdminConstraints(
        ?TargetType $type = null,
        ?string $id = null,
        ?string $name = null,
        array $attrs = []
    ): ?Message\ModifyDelegatedAdminConstraintsResponse;

    /**
     * Modify attributes for a Distribution List
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyDistributionListResponse
     */
    function modifyDistributionList(
        string $id,
        array $attrs = []
    ): ?Message\ModifyDistributionListResponse;

    /**
     * Modify attributes for a domain
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyDomainResponse
     */
    function modifyDomain(
        string $id,
        array $attrs = []
    ): ?Message\ModifyDomainResponse;

    /**
     * Modify Filter rules
     *
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $filterRules
     * @return Message\ModifyFilterRulesResponse
     */
    function modifyFilterRules(
        ?AdminFilterType $type = null,
        ?AccountSelector $account = null,
        ?DomainSelector $domain = null,
        ?CosSelector $cos = null,
        ?ServerSelector $server = null,
        array $filterRules = []
    ): ?Message\ModifyFilterRulesResponse;

    /**
     * Modify a LDAP Entry
     *
     * @param string $dn
     * @param array  $attrs
     * @return Message\ModifyLDAPEntryResponse
     */
    function modifyLDAPEntry(
        string $dn,
        array $attrs = []
    ): ?Message\ModifyLDAPEntryResponse;

    /**
     * Modify Filter rules
     *
     * @param  AdminFilterType $type
     * @param  AccountSelector $account
     * @param  DomainSelector $domain
     * @param  CosSelector $cos
     * @param  ServerSelector $server
     * @param  array $filterRules
     * @return Message\ModifyOutgoingFilterRulesResponse
     */
    function modifyOutgoingFilterRules(
        ?AdminFilterType $type = null,
        ?AccountSelector $account = null,
        ?DomainSelector $domain = null,
        ?CosSelector $cos = null,
        ?ServerSelector $server = null,
        array $filterRules = []
    ): ?Message\ModifyOutgoingFilterRulesResponse;

    /**
     * Modify attributes for a server
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyServerResponse
     */
    function modifyServer(
        string $id,
        array $attrs = []
    ): ?Message\ModifyServerResponse;

    /**
     * Modify system retention policy
     *
     * @param  Policy $policy
     * @param  CosSelector $cos
     * @return Message\ModifySystemRetentionPolicyResponse
     */
    function modifySystemRetentionPolicy(
        Policy $policy,
        ?CosSelector $cos = null
    ): ?Message\ModifySystemRetentionPolicyResponse;

    /**
     * Modify attributes for a UC service
     *
     * @param string $id
     * @param array  $attrs
     * @return Message\ModifyUCServiceResponse
     */
    function modifyUCService(
        string $id,
        array $attrs = []
    ): ?Message\ModifyUCServiceResponse;

    /**
     * Modify volume
     *
     * @param int $id
     * @param VolumeInfo $volume
     * @return Message\ModifyVolumeResponse
     */
    function modifyVolume(
        VolumeInfo $volume,
        int $id = 0
    ): ?Message\ModifyVolumeResponse;

    /**
     * Modify Zimlet
     *
     * @return Message\ModifyZimletResponse
     */
    function modifyZimlet(
        ZimletAclStatusPri $zimlet
    ): ?Message\ModifyZimletResponse;

    /**
     * A request that does nothing and always returns nothing. Used to keep an admin session alive.
     *
     * @return Message\NoOpResponse
     */
    function noOp(): ?Message\NoOpResponse;

    /**
     * Ping
     *
     * @return Message\PingResponse
     */
    function ping(): ?Message\PingResponse;

    /**
     * Purge the calendar cache for an account
     *
     * @param  string $id
     * @return Message\PurgeAccountCalendarCacheResponse
     */
    function purgeAccountCalendarCache(
        string $id
    ): ?Message\PurgeAccountCalendarCacheResponse;

    /**
     * Purges the queue for the given freebusy provider on the current host
     *
     * @param  NamedElement $provider
     * @return Message\PurgeFreeBusyQueueResponse
     */
    function purgeFreeBusyQueue(
        ?NamedElement $provider = null
    ): ?Message\PurgeFreeBusyQueueResponse;

    /**
     * Purges aged messages out of trash, spam, and entire mailbox
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @return Message\PurgeMessagesResponse
     */
    function purgeMessages(
        ?MailboxByAccountIdSelector $mbox = null
    ): ?Message\PurgeMessagesResponse;

    /**
     * Push Free/Busy.
     * The request must include either <domain/> or <account/>.
     *
     * @param  Names $domains
     * @param  array $accounts
     * @return Message\PushFreeBusyResponse
     */
    function pushFreeBusy(
        ?Names $domains = null,
        array $accounts = []
    ): ?Message\PushFreeBusyResponse;

    /**
     * Query WaitSet
     *
     * @param  string $waitSetId
     * @return Message\QueryWaitSetResponse
     */
    function queryWaitSet(
        ?string $waitSetId = null
    ): ?Message\QueryWaitSetResponse;

    /**
     * Recalculate Mailbox counts.
     *
     * @param  MailboxByAccountIdSelector $mbox
     * @return Message\RecalculateMailboxCountsResponse
     */
    function recalculateMailboxCounts(
        ?MailboxByAccountIdSelector $mbox = null
    ): ?Message\RecalculateMailboxCountsResponse;

    /**
     * Deregister authtokens that have been deregistered on the sending server
     *
     * @param  array $tokens
     * @return Message\RefreshRegisteredAuthTokensResponse
     */
    function refreshRegisteredAuthTokens(
        array $tokens = []
    ): ?Message\RefreshRegisteredAuthTokensResponse;

    /**
     * ReIndex
     *
     * @param  ReindexMailboxInfo $mbox
     * @param  ReIndexAction $action
     * @return Message\ReIndexResponse
     */
    function reIndex(
        ReindexMailboxInfo $mbox,
        ?ReIndexAction $action = null
    ): ?Message\ReIndexResponse;

    /**
     * Reload LocalConfig
     *
     * @return Message\ReloadLocalConfigResponse
     */
    function reloadLocalConfig(): ?Message\ReloadLocalConfigResponse;

    /**
     * Reloads the memcached client configuration on this server.
     * Memcached client layer is reinitialized accordingly.
     * Call this command after updating the memcached server list, for example.
     *
     * @return Message\ReloadMemcachedClientConfigResponse
     */
    function reloadMemcachedClientConfig(): ?Message\ReloadMemcachedClientConfigResponse;

    /**
     * Remove Account Alias
     *
     * @param  string $id
     * @param  string $alias
     * @return Message\RemoveAccountAliasResponse
     */
    function removeAccountAlias(
        string $id,
        string $alias
    ): ?Message\RemoveAccountAliasResponse;

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
     * @return Message\RemoveAccountLoggerResponse
     */
    function removeAccountLogger(
        ?LoggerInfo $logger = null,
        ?AccountSelector $account = null,
        ?string $id = null
    ): ?Message\RemoveAccountLoggerResponse;

    /**
     * Remove Distribution List Alias
     *
     * @param  string $id
     * @param  string $alias
     * @return Message\RemoveDistributionListAliasResponse
     */
    function removeDistributionListAlias(
        string $id,
        string $alias
    ): ?Message\RemoveDistributionListAliasResponse;

    /**
     * Remove Distribution List Member
     * Unlike add, remove of a non-existent member causes an exception and no modification to the list.
     *
     * @param  string $id
     * @param  array  $members
     * @param  array  $accounts
     * @return Message\RemoveDistributionListMemberResponse
     */
    function removeDistributionListMember(
        string $id,
        array $members = [],
        array $accounts = []
    ): ?Message\RemoveDistributionListMemberResponse;

    /**
     * Rename Account
     *
     * @param string $id
     * @param string $newName
     * @return Message\RenameAccountResponse
     */
    function renameAccount(
        string $id,
        string $newName
    ): ?Message\RenameAccountResponse;

    /**
     * Rename Calendar Resource
     *
     * @param string $id
     * @param string $newName
     * @return Message\RenameCalendarResourceResponse
     */
    function renameCalendarResource(
        string $id,
        string $newName
    ): ?Message\RenameCalendarResourceResponse;

    /**
     * Rename Class of Service (COS)
     *
     * @param string $id
     * @param string $newName
     * @return Message\RenameCosResponse
     */
    function renameCos(string $id, string $newName): ?Message\RenameCosResponse;

    /**
     * Rename Distribution List
     *
     * @param string $id
     * @param string $newName
     * @return Message\RenameDistributionListResponse
     */
    function renameDistributionList(
        string $id,
        string $newName
    ): ?Message\RenameDistributionListResponse;

    /**
     * Rename LDAP Entry
     *
     * @param string $dn
     * @param string $newDn
     * @return Message\RenameLDAPEntryResponse
     */
    function renameLDAPEntry(
        string $dn,
        string $newDn
    ): ?Message\RenameLDAPEntryResponse;

    /**
     * Rename Unified Communication Service
     *
     * @param string $id
     * @param string $newName
     * @return Message\RenameUCServiceResponse
     */
    function renameUCService(
        string $id,
        string $newName
    ): ?Message\RenameUCServiceResponse;

    /**
     * Removes all account loggers and reloads /opt/zimbra/conf/log4j.properties.
     *
     * @return Message\ResetAllLoggersResponse
     */
    function resetAllLoggers(): ?Message\ResetAllLoggersResponse;

    /**
     * Reset account password
     *
     * @param AccountSelector $account
     * @return Message\ResetAccountPasswordResponse
     */
    function resetAccountPassword(
        AccountSelector $account
    ): ?Message\ResetAccountPasswordResponse;

    /**
     * Revoke a right from a target that was previously granted to an individual or group grantee.
     *
     * @param EffectiveRightsTargetSelector $target
     * @param GranteeSelector $grantee
     * @param RightModifierInfo $right
     * @return Message\RevokeRightResponse
     */
    function revokeRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): ?Message\RevokeRightResponse;

    /**
     * Runs the server-side unit test suite.
     *
     * @param  array  $tests
     * @return Message\RunUnitTestsResponse
     */
    function runUnitTests(array $tests = []): ?Message\RunUnitTestsResponse;

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
     * @return Message\SearchAccountsResponse
     */
    function searchAccounts(
        string $query,
        ?int $limit = null,
        ?int $offset = null,
        ?string $domain = null,
        ?bool $applyCos = null,
        ?string $attrs = null,
        ?string $sortBy = null,
        ?string $types = null,
        ?bool $sortAscending = null
    ): ?Message\SearchAccountsResponse;

    /**
     * Search Auto Prov Directory
     *
     * @param  DomainSelector $domain
     * @param  string $keyAttr
     * @param  string $query
     * @param  string $name
     * @param  int $maxResults
     * @param  int $limit
     * @param  int $offset
     * @param  bool $refresh
     * @param  string $attrs
     * @return Message\SearchAutoProvDirectoryResponse
     */
    function searchAutoProvDirectory(
        DomainSelector $domain,
        string $keyAttr = "",
        ?string $query = null,
        ?string $name = null,
        ?int $maxResults = null,
        ?int $limit = null,
        ?int $offset = null,
        ?bool $refresh = null,
        ?string $attrs = null
    ): ?Message\SearchAutoProvDirectoryResponse;

    /**
     * Search for Calendar Resources
     *
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  int $limit
     * @param  int $offset
     * @param  string $domain
     * @param  bool $applyCos
     * @param  string $sortBy
     * @param  bool $sortAscending
     * @param  string $attrs
     * @return Message\SearchCalendarResourcesResponse
     */
    function searchCalendarResources(
        ?EntrySearchFilterInfo $searchFilter = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $domain = null,
        ?bool $applyCos = null,
        ?string $sortBy = null,
        ?bool $sortAscending = null,
        ?string $attrs = null
    ): ?Message\SearchCalendarResourcesResponse;

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
     * @return Message\SearchDirectoryResponse
     */
    function searchDirectory(
        ?string $query = null,
        ?int $maxResults = null,
        ?int $limit = null,
        ?int $offset = null,
        ?string $domain = null,
        ?bool $applyCos = null,
        ?bool $applyConfig = null,
        ?string $sortBy = null,
        ?string $types = null,
        ?bool $sortAscending = null,
        ?bool $isCountOnly = null,
        ?string $attrs = null
    ): ?Message\SearchDirectoryResponse;

    /**
     * Search Global Address Book (GAL)
     *
     * @param  string $domain
     * @param  string $name
     * @param  int $limit
     * @param  GalSearchType $type
     * @param  string $galAccountId
     * @return Message\SearchGalResponse
     */
    function searchGal(
        string $domain,
        ?string $name = null,
        ?int $limit = null,
        ?GalSearchType $type = null,
        ?string $galAccountId = null
    ): ?Message\SearchGalResponse;

    /**
     * Set current volume.
     *
     * @param  int $id
     * @param  int $type
     * @return Message\SetCurrentVolumeResponse
     */
    function setCurrentVolume(
        int $id = 0,
        int $type = 0
    ): ?Message\SetCurrentVolumeResponse;

    /**
     * Set local server online
     *
     * @return Message\SetLocalServerOnlineResponse
     */
    function setLocalServerOnline(): ?Message\SetLocalServerOnlineResponse;

    /**
     * Set Password
     *
     * @param string $id
     * @param string $newPassword
     * @param bool $dryRun
     * @return Message\SetPasswordResponse
     */
    function setPassword(
        string $id,
        string $newPassword,
        ?bool $dryRun = null
    ): ?Message\SetPasswordResponse;

    /**
     * Set server offline
     *
     * @param  ServerSelector $server
     * @param  string $attrs
     * @return Message\SetServerOfflineResponse
     */
    function setServerOffline(
        ?ServerSelector $server = null,
        ?string $attrs = null
    ): ?Message\SetServerOfflineResponse;

    /**
     * Sync GalAccount
     * If fullSync is set to false (or unset) the default behavior is trickle sync which will pull in any new contacts or modified contacts since last sync.
     * If fullSync is set to true, then the server will go through all the contacts that appear in GAL, and resolve deleted contacts in addition to new or modified ones.
     * If reset attribute is set, then all the contacts will be populated again, regardless of the status since last sync.
     * Reset needs to be done when there is a significant change in the configuration, such as filter, attribute map, or search base.
     *
     * @param array $accounts
     * @return Message\SyncGalAccountResponse
     */
    function syncGalAccount(
        array $accounts = []
    ): ?Message\SyncGalAccountResponse;

    /**
     * Undeploy Zimlet
     *
     * @param  string $name
     * @param  string $action
     * @return Message\UndeployZimletResponse
     */
    function undeployZimlet(
        string $name,
        ?string $action = null
    ): ?Message\UndeployZimletResponse;

    /**
     * Verify index
     *
     * @param  MailboxByAccountIdSelector  $mbox
     * @return Message\VerifyIndexResponse
     */
    function verifyIndex(
        ?MailboxByAccountIdSelector $mbox = null
    ): ?Message\VerifyIndexResponse;

    /**
     * Verify Store Manager
     *
     * @param int  $fileSize
     * @param int  $num
     * @param bool  $checkBlobs
     * @return Message\VerifyStoreManagerResponse
     */
    function verifyStoreManager(
        ?int $fileSize = null,
        ?int $num = null,
        ?bool $checkBlobs = null
    ): ?Message\VerifyStoreManagerResponse;
}
