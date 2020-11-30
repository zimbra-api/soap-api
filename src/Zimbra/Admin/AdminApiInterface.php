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
    AttachmentIdAttrib,
    CacheSelector,
    CheckedRight,
    CosSelector,
    DataSourceSpecifier,
    DistributionListSelector,
    DomainSelector,
    EffectiveRightsTargetSelector,
    ExchangeAuthSpec,
    ExportAndDeleteMailboxSpec,
    GranteeSelector,
    LimitedQuery,
    LoggerInfo,
    MailboxByAccountIdSelector,
    Policy,
    PolicyHolder,
    PrincipalSelector,
    ServerSelector,
    TzFixup,
    UcServiceSelector,
    VolumeInfo,
    XMPPComponentSelector,
    XMPPComponentSpec
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
    ZimletDeployAction,
    ZimletExcludeType
};

use Zimbra\Soap\{ApiInterface, ResponseInterface};
use Zimbra\Struct\{
    AccountSelector,
    NamedElement
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
}
