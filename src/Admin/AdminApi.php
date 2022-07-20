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
    Id,
    NamedElement
};
use Zimbra\Mail\Struct\{
    Policy,
    PolicyHolder
};
use Zimbra\Soap\AbstractApi;

/**
 * Admin api class
 *
 * @package   Zimbra
 * @category  Admin
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class AdminApi extends AbstractApi implements AdminApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function addAccountAlias(string $id, string $alias): Message\AddAccountAliasResponse
    {
        return $this->invoke(new Message\AddAccountAliasRequest(
            $id, $alias
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function addAccountLogger(
        LoggerInfo $logger, ?AccountSelector $account = NULL, ?string $id = NULL
    ): Message\AddAccountLoggerResponse
    {
        return $this->invoke(new Message\AddAccountLoggerRequest(
            $logger, $account, $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function addDistributionListAlias(
        string $id, string $alias
    ): Message\AddDistributionListAliasResponse
    {
        return $this->invoke(new Message\AddDistributionListAliasRequest(
            $id, $alias
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function addDistributionListMember(
        string $id, array $members
    ): Message\AddDistributionListMemberResponse
    {
        return $this->invoke(new Message\AddDistributionListMemberRequest(
            $id, $members
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function addGalSyncDataSource(
        AccountSelector $account,
        string $name,
        string $domain,
        GalMode $type,
        ?string $folder = NULL,
        array $attrs = []
    ): Message\AddGalSyncDataSourceResponse
    {
        return $this->invoke(new Message\AddGalSyncDataSourceRequest(
            $account, $name, $domain, $type, $folder, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function adminCreateWaitSet(
        string $defaultInterests, ?bool $allAccounts = NULL, array $accounts = []
    ): Message\AdminCreateWaitSetResponse
    {
        return $this->invoke(new Message\AdminCreateWaitSetRequest(
            $defaultInterests, $allAccounts, $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function adminDestroyWaitSet(string $waitSetId): Message\AdminDestroyWaitSetResponse
    {
        return $this->invoke(new Message\AdminDestroyWaitSetRequest(
            $waitSetId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function adminWaitSet(
        string $waitSetId,
        string $lastKnownSeqNo,
        ?bool $block = NULL,
        ?bool $expand = NULL,
        ?string $defaultInterests = NULL,
        ?int $timeout = NULL,
        array $addAccounts = [],
        array $updateAccounts = [],
        array $removeAccounts = []
    ): Message\AdminWaitSetResponse
    {
        return $this->invoke(new Message\AdminWaitSetRequest(
            $waitSetId,
            $lastKnownSeqNo,
            $block,
            $expand,
            $defaultInterests,
            $timeout,
            $addAccounts,
            $updateAccounts,
            $removeAccounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function auth(
        ?string $name = NULL,
        ?string $password = NULL,
        ?string $authToken = NULL,
        ?AccountSelector $account = NULL,
        ?string $virtualHost = NULL,
        ?bool $persistAuthTokenCookie = NULL,
        ?bool $csrfSupported = NULL,
        ?string $twoFactorCode = NULL
    ): Message\AuthResponse
    {
        return $this->invoke(new Message\AuthRequest(
            $name,
            $password,
            $authToken,
            $account,
            $virtualHost,
            $persistAuthTokenCookie,
            $csrfSupported,
            $twoFactorCode
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function autoCompleteGal(
        string $domain,
        string $name,
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): Message\AutoCompleteGalResponse
    {
        return $this->invoke(new Message\AutoCompleteGalRequest(
            $domain, $name, $type, $galAccountId, $limit
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function autoProvAccount(
        DomainSelector $domain,
        PrincipalSelector $principal,
        ?string $password = NULL
    ): Message\AutoProvAccountResponse
    {
        return $this->invoke(new Message\AutoProvAccountRequest(
            $domain, $principal, $password
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function autoProvTaskControl(AutoProvTaskAction $action): Message\AutoProvTaskControlResponse
    {
        return $this->invoke(new Message\AutoProvTaskControlRequest(
            $action
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function changePrimaryEmail(
        AccountSelector $account, string $newName
    ): Message\ChangePrimaryEmailResponse
    {
        return $this->invoke(new Message\ChangePrimaryEmailRequest(
            $account, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkAuthConfig(
        string $name, string $password, array $attrs = []
    ): Message\CheckAuthConfigResponse
    {
        return $this->invoke(new Message\CheckAuthConfigRequest(
            $name, $password, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkBlobConsistency(
        ?bool $checkSize = NULL, ?bool $reportUsedBlobs = NULL, array $volumes = [], array $mailboxes = []
    ): Message\CheckBlobConsistencyResponse
    {
        return $this->invoke(new Message\CheckBlobConsistencyRequest(
            $checkSize, $reportUsedBlobs, $volumes, $mailboxes
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkDirectory(array $paths = []): Message\CheckDirectoryResponse
    {
        return $this->invoke(new Message\CheckDirectoryRequest(
            $paths
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkDomainMXRecord(DomainSelector $domain = NULL): Message\CheckDomainMXRecordResponse
    {
        return $this->invoke(new Message\CheckDomainMXRecordRequest(
            $domain
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkExchangeAuth(?ExchangeAuthSpec $auth = NULL): Message\CheckExchangeAuthResponse
    {
        return $this->invoke(new Message\CheckExchangeAuthRequest(
            $auth
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkGalConfig(
        ?LimitedQuery $query = NULL, ?string $action = NULL, array $attrs = []
    ): Message\CheckGalConfigResponse
    {
        return $this->invoke(new Message\CheckGalConfigRequest(
            $query, $action, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkHealth(): Message\CheckHealthResponse
    {
        return $this->invoke(new Message\CheckHealthRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function checkHostnameResolve(?string $hostname = NULL): Message\CheckHostnameResolveResponse
    {
        return $this->invoke(new Message\CheckHostnameResolveRequest(
            $hostname
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkPasswordStrength(string $id, string $password): Message\CheckPasswordStrengthResponse
    {
        return $this->invoke(new Message\CheckPasswordStrengthRequest(
            $id, $password
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        CheckedRight $right,
        array $attrs = []
    ): Message\CheckRightResponse
    {
        return $this->invoke(new Message\CheckRightRequest(
            $target, $grantee, $right, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function clearCookie(array $cookies = []): Message\ClearCookieResponse
    {
        return $this->invoke(new Message\ClearCookieRequest(
            $cookies
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function compactIndex(
        MailboxByAccountIdSelector $mbox, ?CompactIndexAction $action = NULL
    ): Message\CompactIndexResponse
    {
        return $this->invoke(new Message\CompactIndexRequest(
            $mbox, $action
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function computeAggregateQuotaUsage(): Message\ComputeAggregateQuotaUsageResponse
    {
        return $this->invoke(new Message\ComputeAggregateQuotaUsageRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function configureZimlet(AttachmentIdAttrib $content): Message\ConfigureZimletResponse
    {
        return $this->invoke(new Message\ConfigureZimletRequest(
            $content
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function contactBackup(array $servers = [], ?ContactBackupOp $op = NULL): Message\ContactBackupResponse
    {
        return $this->invoke(new Message\ContactBackupRequest(
            $servers, $op
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function copyCos(?CosSelector $cos = NULL, ?string $newName = NULL): Message\CopyCosResponse
    {
        return $this->invoke(new Message\CopyCosRequest(
            $cos, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function countAccount(DomainSelector $domain): Message\CountAccountResponse
    {
        return $this->invoke(new Message\CountAccountRequest(
            $domain
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function countObjects(
        ?CountObjectsType $type = NULL,
        array $domains = [],
        ?UcServiceSelector $ucService = NULL,
        ?bool $onlyRelated = NULL
    ): Message\CountObjectsResponse
    {
        return $this->invoke(new Message\CountObjectsRequest(
            $type, $domains, $ucService, $onlyRelated
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createAccount(
        string $name, ?string $password = NULL, array $attrs = []
    ): Message\CreateAccountResponse
    {
        return $this->invoke(new Message\CreateAccountRequest(
            $name, $password, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createAlwaysOnCluster(
        string $name, array $attrs = []
    ): Message\CreateAlwaysOnClusterResponse
    {
        return $this->invoke(new Message\CreateAlwaysOnClusterRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createCalendarResource(
        string $name, ?string $password = NULL, array $attrs = []
    ): Message\CreateCalendarResourceResponse
    {
        return $this->invoke(new Message\CreateCalendarResourceRequest(
            $name, $password, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createCos(string $name, array $attrs = []): Message\CreateCosResponse
    {
        return $this->invoke(new Message\CreateCosRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createDataSource(
        DataSourceSpecifier $dataSource, string $id = ''
    ): Message\CreateDataSourceResponse
    {
        return $this->invoke(new Message\CreateDataSourceRequest(
            $dataSource, $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createDistributionList(
        string $name, ?bool $dynamic = NULL, array $attrs = []
    ): Message\CreateDistributionListResponse
    {
        return $this->invoke(new Message\CreateDistributionListRequest(
            $name, $dynamic, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createDomain(string $name, array $attrs = []): Message\CreateDomainResponse
    {
        return $this->invoke(new Message\CreateDomainRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createGalSyncAccount(
        AccountSelector $account,
        string $name,
        string $domain,
        string $mailHost,
        ?GalMode $type = NULL,
        ?string $password = NULL,
        ?string $folder = NULL,
        array $attrs = []
    ): Message\CreateGalSyncAccountResponse
    {
        return $this->invoke(new Message\CreateGalSyncAccountRequest(
            $account, $name, $domain, $mailHost, $type, $password, $folder, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createLDAPEntry(string $dn, array $attrs = []): Message\CreateLDAPEntryResponse
    {
        return $this->invoke(new Message\CreateLDAPEntryRequest(
            $dn, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createServer(string $name, array $attrs = []): Message\CreateServerResponse
    {
        return $this->invoke(new Message\CreateServerRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createSystemRetentionPolicy(
        ?CosSelector $cos = NULL, ?PolicyHolder $keep = NULL, ?PolicyHolder $purge = NULL
    ): Message\CreateSystemRetentionPolicyResponse
    {
        return $this->invoke(new Message\CreateSystemRetentionPolicyRequest(
            $cos, $keep, $purge
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createUCService(string $name, array $attrs = []): Message\CreateUCServiceResponse
    {
        return $this->invoke(new Message\CreateUCServiceRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createVolume(VolumeInfo $volume): Message\CreateVolumeResponse
    {
        return $this->invoke(new Message\CreateVolumeRequest(
            $volume
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createXMPPComponent(XMPPComponentSpec $component): Message\CreateXMPPComponentResponse
    {
        return $this->invoke(new Message\CreateXMPPComponentRequest(
            $component
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createZimlet(string $name, array $attrs = []): Message\CreateZimletResponse
    {
        return $this->invoke(new Message\CreateZimletRequest(
            $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function dedupeBlobs(?DedupAction $action = NULL, array $volumes = []): Message\DedupeBlobsResponse
    {
        return $this->invoke(new Message\DedupeBlobsRequest(
            $action, $volumes
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function delegateAuth(AccountSelector $account, ?int $duration = NULL): Message\DelegateAuthResponse
    {
        return $this->invoke(new Message\DelegateAuthRequest(
            $account, $duration
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAccount(string $id): Message\DeleteAccountResponse
    {
        return $this->invoke(new Message\DeleteAccountRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAlwaysOnCluster(string $id): Message\DeleteAlwaysOnClusterResponse
    {
        return $this->invoke(new Message\DeleteAlwaysOnClusterRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCalendarResource(string $id): Message\DeleteCalendarResourceResponse
    {
        return $this->invoke(new Message\DeleteCalendarResourceRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCos(string $id): Message\DeleteCosResponse
    {
        return $this->invoke(new Message\DeleteCosRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteDataSource(
        Id $dataSource, string $id, array $attrs = []
    ): Message\DeleteDataSourceResponse
    {
        return $this->invoke(new Message\DeleteDataSourceRequest(
            $dataSource, $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteDistributionList(
        string $id, ?bool $cascadeDelete = NULL
    ): Message\DeleteDistributionListResponse
    {
        return $this->invoke(new Message\DeleteDistributionListRequest(
            $id, $cascadeDelete
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteDomain(string $id): Message\DeleteDomainResponse
    {
        return $this->invoke(new Message\DeleteDomainRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteGalSyncAccount(AccountSelector $account): Message\DeleteGalSyncAccountResponse
    {
        return $this->invoke(new Message\DeleteGalSyncAccountRequest(
            $account
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteLDAPEntry(string $dn): Message\DeleteLDAPEntryResponse
    {
        return $this->invoke(new Message\DeleteLDAPEntryRequest(
            $dn
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteMailbox(
        ?MailboxByAccountIdSelector $mbox = NULL
    ): Message\DeleteMailboxResponse
    {
        return $this->invoke(new Message\DeleteMailboxRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteServer(string $id): Message\DeleteServerResponse
    {
        return $this->invoke(new Message\DeleteServerRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteSystemRetentionPolicy(
        Policy $policy, ?CosSelector $cos = NULL
    ): Message\DeleteSystemRetentionPolicyResponse
    {
        return $this->invoke(new Message\DeleteSystemRetentionPolicyRequest(
            $policy, $cos
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteUCService(string $id): Message\DeleteUCServiceResponse
    {
        return $this->invoke(new Message\DeleteUCServiceRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteVolume(int $id): Message\DeleteVolumeResponse
    {
        return $this->invoke(new Message\DeleteVolumeRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteXMPPComponent(
        ?XMPPComponentSelector $component = NULL
    ): Message\DeleteXMPPComponentResponse
    {
        return $this->invoke(new Message\DeleteXMPPComponentRequest(
            $component
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteZimlet(NamedElement $zimlet): Message\DeleteZimletResponse
    {
        return $this->invoke(new Message\DeleteZimletRequest(
            $zimlet
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deployZimlet(
        AttachmentIdAttrib $content,
        ?ZimletDeployAction $action = NULL,
        ?bool $flushCache = NULL,
        ?bool $synchronous = NULL
    ): Message\DeployZimletResponse
    {
        return $this->invoke(new Message\DeployZimletRequest(
            $content, $action, $flushCache, $synchronous
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function dumpSessions(
        ?bool $includeAccounts = NULL, ?bool $groupByAccount = NULL
    ): Message\DumpSessionsResponse
    {
        return $this->invoke(new Message\DumpSessionsRequest(
            $includeAccounts, $groupByAccount
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function exportAndDeleteItems(
        ExportAndDeleteMailboxSpec $mailbox, ?string $exportDir = NULL, ?string $exportFilenamePrefix = NULL
    ): Message\ExportAndDeleteItemsResponse
    {
        return $this->invoke(new Message\ExportAndDeleteItemsRequest(
            $mailbox, $exportDir, $exportFilenamePrefix
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function fixCalendarEndTime(?bool $sync = NULL, array $accounts = []): Message\FixCalendarEndTimeResponse
    {
        return $this->invoke(new Message\FixCalendarEndTimeRequest(
            $sync, $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function fixCalendarPriority(?bool $sync = NULL, array $accounts = []): Message\FixCalendarPriorityResponse
    {
        return $this->invoke(new Message\FixCalendarPriorityRequest(
            $sync, $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function fixCalendarTZ(
        ?bool $sync = NULL, ?int $after = NULL, array $accounts = [], ?TzFixup $tzFixup = NULL
    ): Message\FixCalendarTZResponse
    {
        return $this->invoke(new Message\FixCalendarTZRequest(
            $sync, $after, $accounts, $tzFixup
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function flushCache(?CacheSelector $cache = NULL): Message\FlushCacheResponse
    {
        return $this->invoke(new Message\FlushCacheRequest(
            $cache
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAccount(
        AccountSelector $account, ?bool $applyCos = NULL, ?string $attrs = NULL
    ): Message\GetAccountResponse
    {
        return $this->invoke(new Message\GetAccountRequest(
            $account, $applyCos, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountInfo(AccountSelector $account): Message\GetAccountInfoResponse
    {
        return $this->invoke(new Message\GetAccountInfoRequest(
            $account
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountLoggers(
        ?string $id = NULL, ?AccountSelector $account = NULL
    ): Message\GetAccountLoggersResponse
    {
        return $this->invoke(new Message\GetAccountLoggersRequest(
            $id, $account
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountMembership(AccountSelector $account): Message\GetAccountMembershipResponse
    {
        return $this->invoke(new Message\GetAccountMembershipRequest(
            $account
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminConsoleUI(
        ?AccountSelector $account = NULL, ?DistributionListSelector $dl = NULL
    ): Message\GetAdminConsoleUIResponse
    {
        return $this->invoke(new Message\GetAdminConsoleUIRequest(
            $account, $dl
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminExtensionZimlets(): Message\GetAdminExtensionZimletsResponse
    {
        return $this->invoke(new Message\GetAdminExtensionZimletsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAdminSavedSearches(array $searches = []): Message\GetAdminSavedSearchesResponse
    {
        return $this->invoke(new Message\GetAdminSavedSearchesRequest(
            $searches
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAggregateQuotaUsageOnServer(): Message\GetAggregateQuotaUsageOnServerResponse
    {
        return $this->invoke(new Message\GetAggregateQuotaUsageOnServerRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllAccountLoggers(): Message\GetAllAccountLoggersResponse
    {
        return $this->invoke(new Message\GetAllAccountLoggersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllAccounts(
        ?ServerSelector $server = NULL, ?DomainSelector $domain = NULL
    ): Message\GetAllAccountsResponse
    {
        return $this->invoke(new Message\GetAllAccountsRequest(
            $server, $domain
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllActiveServers(): Message\GetAllActiveServersResponse
    {
        return $this->invoke(new Message\GetAllActiveServersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllAdminAccounts(?bool $applyCos = NULL): Message\GetAllAdminAccountsResponse
    {
        return $this->invoke(new Message\GetAllAdminAccountsRequest(
            $applyCos
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllAlwaysOnClusters(): Message\GetAllAlwaysOnClustersResponse
    {
        return $this->invoke(new Message\GetAllAlwaysOnClustersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCalendarResources(
        ?ServerSelector $server = NULL, ?DomainSelector $domain = NULL
    ): Message\GetAllCalendarResourcesResponse
    {
        return $this->invoke(new Message\GetAllCalendarResourcesRequest(
            $server, $domain
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllConfig(): Message\GetAllConfigResponse
    {
        return $this->invoke(new Message\GetAllConfigRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllCos(): Message\GetAllCosResponse
    {
        return $this->invoke(new Message\GetAllCosRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllDistributionLists(
        ?DomainSelector $domain = NULL
    ): Message\GetAllDistributionListsResponse
    {
        return $this->invoke(new Message\GetAllDistributionListsRequest(
            $domain
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllDomains(?bool $applyConfig = NULL): Message\GetAllDomainsResponse
    {
        return $this->invoke(new Message\GetAllDomainsRequest(
            $applyConfig
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllEffectiveRights(
        ?GranteeSelector $grantee = NULL, ?bool $expandSetAttrs = NULL, ?bool $expandGetAttrs = NULL
    ): Message\GetAllEffectiveRightsResponse
    {
        return $this->invoke(new Message\GetAllEffectiveRightsRequest(
            $grantee, $expandSetAttrs, $expandGetAttrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllFreeBusyProviders(): Message\GetAllFreeBusyProvidersResponse
    {
        return $this->invoke(new Message\GetAllFreeBusyProvidersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllLocales(): Message\GetAllLocalesResponse
    {
        return $this->invoke(new Message\GetAllLocalesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllMailboxes(?int $limit = NULL, ?int $offset = NULL): Message\GetAllMailboxesResponse
    {
        return $this->invoke(new Message\GetAllMailboxesRequest(
            $limit, $offset
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllRights(
        ?string $targetType = NULL, ?bool $expandAllAttrs = NULL, ?RightClass $rightClass = NULL
    ): Message\GetAllRightsResponse
    {
        return $this->invoke(new Message\GetAllRightsRequest(
            $targetType, $expandAllAttrs, $rightClass
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllServers(
        ?string $service = NULL, ?string $alwaysOnClusterId = NULL, ?bool $applyConfig = NULL
    ): Message\GetAllServersResponse
    {
        return $this->invoke(new Message\GetAllServersRequest(
            $service, $alwaysOnClusterId, $applyConfig
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAllSkins(): Message\GetAllSkinsResponse
    {
        return $this->invoke(new Message\GetAllSkinsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllUCServices(): Message\GetAllUCServicesResponse
    {
        return $this->invoke(new Message\GetAllUCServicesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllVolumes(): Message\GetAllVolumesResponse
    {
        return $this->invoke(new Message\GetAllVolumesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllXMPPComponents(): Message\GetAllXMPPComponentsResponse
    {
        return $this->invoke(new Message\GetAllXMPPComponentsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAllZimlets(?ZimletExcludeType $exclude = NULL): Message\GetAllZimletsResponse
    {
        return $this->invoke(new Message\GetAllZimletsRequest(
            $exclude
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAlwaysOnCluster(
        ?AlwaysOnClusterSelector $cluster = NULL, ?string $attrs = NULL
    ): Message\GetAlwaysOnClusterResponse
    {
        return $this->invoke(new Message\GetAlwaysOnClusterRequest(
            $cluster, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeInfo(
        ?string $attrs = NULL, ?string $entryTypes = NULL
    ): Message\GetAttributeInfoResponse
    {
        return $this->invoke(new Message\GetAttributeInfoRequest(
            $attrs, $entryTypes
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCalendarResource(
        ?CalendarResourceSelector $calResource = NULL, ?bool $applyCos = NULL, ?string $attrs = NULL
    ): Message\GetCalendarResourceResponse
    {
        return $this->invoke(new Message\GetCalendarResourceRequest(
            $calResource, $applyCos, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getConfig(Attr $attr = NULL): Message\GetConfigResponse
    {
        return $this->invoke(new Message\GetConfigRequest(
            $attr
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCos(CosSelector $cos, ?string $attrs = NULL): Message\GetCosResponse
    {
        return $this->invoke(new Message\GetCosRequest(
            $cos, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCreateObjectAttrs(
        TargetWithType $target, ?DomainSelector $domain = NULL, ?CosSelector $cos = NULL
    ): Message\GetCreateObjectAttrsResponse
    {
        return $this->invoke(new Message\GetCreateObjectAttrsRequest(
            $target, $domain, $cos
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getCurrentVolumes(): Message\GetCurrentVolumesResponse
    {
        return $this->invoke(new Message\GetCurrentVolumesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getDataSources(string $id, array $attrs = []): Message\GetDataSourcesResponse
    {
        return $this->invoke(new Message\GetDataSourcesRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDelegatedAdminConstraints(
        TargetType $type, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    ): Message\GetDelegatedAdminConstraintsResponse
    {
        return $this->invoke(new Message\GetDelegatedAdminConstraintsRequest(
            $type, $id, $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDistributionList(
        ?DistributionListSelector $dl = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    ): Message\GetDistributionListResponse
    {
        return $this->invoke(new Message\GetDistributionListRequest(
            $dl, $limit, $offset, $sortAscending, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDistributionListMembership(
        ?DistributionListSelector $dl = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL
    ): Message\GetDistributionListMembershipResponse
    {
        return $this->invoke(new Message\GetDistributionListMembershipRequest(
            $dl, $limit, $offset
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDomain(
        ?DomainSelector $domain = NULL,
        ?bool $applyConfig = NULL,
        ?string $attrs = NULL
    ): Message\GetDomainResponse
    {
        return $this->invoke(new Message\GetDomainRequest(
            $domain, $applyConfig, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDomainInfo(
        ?DomainSelector $domain = NULL, ?bool $applyConfig = NULL
    ): Message\GetDomainInfoResponse
    {
        return $this->invoke(new Message\GetDomainInfoRequest(
            $domain, $applyConfig
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getEffectiveRights(
        EffectiveRightsTargetSelector $target,
        ?GranteeSelector $grantee = NULL,
        ?bool $expandSetAttrs = NULL,
        ?bool $expandGetAttrs = NULL
    ): Message\GetEffectiveRightsResponse
    {
        return $this->invoke(new Message\GetEffectiveRightsRequest(
            $target, $grantee, $expandSetAttrs, $expandGetAttrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL
    ): Message\GetFilterRulesResponse
    {
        return $this->invoke(new Message\GetFilterRulesRequest(
            $type, $account, $domain, $cos, $server
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getFreeBusyQueueInfo(?NamedElement $provider = NULL): Message\GetFreeBusyQueueInfoResponse
    {
        return $this->invoke(new Message\GetFreeBusyQueueInfoRequest(
            $provider
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getGrants(
        ?EffectiveRightsTargetSelector $target = NULL,
        ?GranteeSelector $grantee = NULL
    ): Message\GetGrantsResponse
    {
        return $this->invoke(new Message\GetGrantsRequest(
            $target, $grantee
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getIndexStats(MailboxByAccountIdSelector $mbox): Message\GetIndexStatsResponse
    {
        return $this->invoke(new Message\GetIndexStatsRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getLDAPEntries(
        string $ldapSearchBase,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $query = NULL
    ): Message\GetLDAPEntriesResponse
    {
        return $this->invoke(new Message\GetLDAPEntriesRequest(
            $ldapSearchBase, $sortBy, $sortAscending, $limit, $offset, $query
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getLicenseInfo(): Message\GetLicenseInfoResponse
    {
        return $this->invoke(new Message\GetLicenseInfoRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getLoggerStats(
        ?HostName $hostName = NULL, ?StatsSpec $stats = NULL, ?TimeAttr $startTime = NULL, ?TimeAttr $endTime = NULL
    ): Message\GetLoggerStatsResponse
    {
        return $this->invoke(new Message\GetLoggerStatsRequest(
            $hostName, $stats, $startTime, $endTime
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getMailbox(?MailboxByAccountIdSelector $mbox = NULL): Message\GetMailboxResponse
    {
        return $this->invoke(new Message\GetMailboxRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getMailboxStats(): Message\GetMailboxStatsResponse
    {
        return $this->invoke(new Message\GetMailboxStatsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getMailQueue(ServerMailQueueQuery $server): Message\GetMailQueueResponse
    {
        return $this->invoke(new Message\GetMailQueueRequest(
            $server
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getMailQueueInfo(NamedElement $server): Message\GetMailQueueInfoResponse
    {
        return $this->invoke(new Message\GetMailQueueInfoRequest(
            $server
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getMemcachedClientConfig(): Message\GetMemcachedClientConfigResponse
    {
        return $this->invoke(new Message\GetMemcachedClientConfigRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getOutgoingFilterRules(): Message\GetOutgoingFilterRulesResponse
    {
        return $this->invoke(new Message\GetOutgoingFilterRulesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getQuotaUsage(
        ?string $domain = NULL,
        ?bool $allServers = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?bool $refresh = NULL
    ): Message\GetQuotaUsageResponse
    {
        return $this->invoke(new Message\GetQuotaUsageRequest(
            $domain, $allServers, $limit, $offset, $sortBy, $sortAscending, $refresh
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getRight(string $right, ?bool $expandAllAttrs = NULL): Message\GetRightResponse
    {
        return $this->invoke(new Message\GetRightRequest(
            $right, $expandAllAttrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getRightsDoc(array $pkgs = []): Message\GetRightsDocResponse
    {
        return $this->invoke(new Message\GetRightsDocRequest(
            $pkgs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getServer(
        ?ServerSelector $server = NULL,
        ?bool $applyConfig = NULL,
        ?string $attrs = NULL
    ): Message\GetServerResponse
    {
        return $this->invoke(new Message\GetServerRequest(
            $server, $applyConfig, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getServerNIfs(ServerSelector $server, IpType $type = NULL): Message\GetServerNIfsResponse
    {
        return $this->invoke(new Message\GetServerNIfsRequest(
            $server, $type
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getServerStats(array $stats = []): Message\GetServerStatsResponse
    {
        return $this->invoke(new Message\GetServerStatsRequest(
            $stats
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceStatus(): Message\GetServiceStatusResponse
    {
        return $this->invoke(new Message\GetServiceStatusRequest(
            $stats
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getSessions(
        SessionType $type,
        ?GetSessionsSortBy $sortBy = NULL,
        ?int $offset = NULL,
        ?int $limit = NULL,
        ?bool $refresh = NULL
    ): Message\GetSessionsResponse
    {
        return $this->invoke(new Message\GetSessionsRequest(
            $type, $sortBy, $offset, $limit, $refresh
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getShareInfo(
        AccountSelector $owner, ?GranteeChooser $grantee = NULL
    ): Message\GetShareInfoResponse
    {
        return $this->invoke(new Message\GetShareInfoRequest(
            $owner, $grantee
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getSystemRetentionPolicy(?CosSelector $cos = NULL): Message\GetSystemRetentionPolicyResponse
    {
        return $this->invoke(new Message\GetSystemRetentionPolicyRequest(
            $cos
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getUCService(UcServiceSelector $ucService, ?string $attrs = NULL): Message\GetUCServiceResponse
    {
        return $this->invoke(new Message\GetUCServiceRequest(
            $ucService, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getVersionInfo(): Message\GetVersionInfoResponse
    {
        return $this->invoke(new Message\GetVersionInfoRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getVolume(int $id): Message\GetVolumeResponse
    {
        return $this->invoke(new Message\GetVolumeRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getXMPPComponent(
        XMPPComponentSelector $component, ?string $attrs = NULL
    ): Message\GetXMPPComponentResponse
    {
        return $this->invoke(new Message\GetXMPPComponentRequest(
            $component, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getZimlet(NamedElement $zimlet, ?string $attrs = NULL): Message\GetZimletResponse
    {
        return $this->invoke(new Message\GetZimletRequest(
            $zimlet, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getZimletStatus(): Message\GetZimletStatusResponse
    {
        return $this->invoke(new Message\GetZimletStatusRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function grantRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): Message\GrantRightResponse
    {
        return $this->invoke(new Message\GrantRightRequest(
            $target, $grantee, $right
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function lockoutMailbox(
        AccountNameSelector $account, ?LockoutOperation $operation = NULL
    ): Message\LockoutMailboxResponse
    {
        return $this->invoke(new Message\LockoutMailboxRequest(
            $account, $operation
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function mailQueueAction(ServerWithQueueAction $server): Message\MailQueueActionResponse
    {
        return $this->invoke(new Message\MailQueueActionRequest(
            $server
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function mailQueueFlush(NamedElement $server): Message\MailQueueFlushResponse
    {
        return $this->invoke(new Message\MailQueueFlushRequest(
            $server
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function migrateAccount(IdAndAction $migrate): Message\MigrateAccountResponse
    {
        return $this->invoke(new Message\MigrateAccountRequest(
            $migrate
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyAccount(string $id, array $attrs = []): Message\ModifyAccountResponse
    {
        return $this->invoke(new Message\ModifyAccountRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyAdminSavedSearches(array $searches = []): Message\ModifyAdminSavedSearchesResponse
    {
        return $this->invoke(new Message\ModifyAdminSavedSearchesRequest(
            $searches
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyAlwaysOnCluster(string $id, array $attrs = []): Message\ModifyAlwaysOnClusterResponse
    {
        return $this->invoke(new Message\ModifyAlwaysOnClusterRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyCalendarResource(string $id, array $attrs = []): Message\ModifyCalendarResourceResponse
    {
        return $this->invoke(new Message\ModifyCalendarResourceRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyConfig(array $attrs = []): Message\ModifyConfigResponse
    {
        return $this->invoke(new Message\ModifyConfigRequest(
            $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyCos(string $id, array $attrs = []): Message\ModifyCosResponse
    {
        return $this->invoke(new Message\ModifyCosRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDataSource(
        string $id, DataSourceInfo $dataSource, array $attrs = []
    ): Message\ModifyDataSourceResponse
    {
        return $this->invoke(new Message\ModifyDataSourceRequest(
            $id, $dataSource, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDelegatedAdminConstraints(
        TargetType $type, ?string $id = NULL, ?string $name = NULL, array $attrs = []
    ): Message\ModifyDelegatedAdminConstraintsResponse
    {
        return $this->invoke(new Message\ModifyDelegatedAdminConstraintsRequest(
            $type, $id, $name, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDistributionList(string $id, array $attrs = []): Message\ModifyDistributionListResponse
    {
        return $this->invoke(new Message\ModifyDistributionListRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyDomain(string $id, array $attrs = []): Message\ModifyDomainResponse
    {
        return $this->invoke(new Message\ModifyDomainRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL,
        array $filterRules = []
    ): Message\ModifyFilterRulesResponse
    {
        return $this->invoke(new Message\ModifyFilterRulesRequest(
            $type, $account, $domain, $cos, $server, $filterRules
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyLDAPEntry(string $dn, array $attrs = []): Message\ModifyLDAPEntryResponse
    {
        return $this->invoke(new Message\ModifyLDAPEntryRequest(
            $dn, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyOutgoingFilterRules(
        AdminFilterType $type,
        ?AccountSelector $account = NULL,
        ?DomainSelector $domain = NULL,
        ?CosSelector $cos = NULL,
        ?ServerSelector $server = NULL,
        array $filterRules = []
    ): Message\ModifyOutgoingFilterRulesResponse
    {
        return $this->invoke(new Message\ModifyOutgoingFilterRulesRequest(
            $type, $account, $domain, $cos, $server, $filterRules
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyServer(string $id, array $attrs = []): Message\ModifyServerResponse
    {
        return $this->invoke(new Message\ModifyServerRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifySystemRetentionPolicy(
        Policy $policy, ?CosSelector $cos = NULL
    ): Message\ModifySystemRetentionPolicyResponse
    {
        return $this->invoke(new Message\ModifySystemRetentionPolicyRequest(
            $policy, $cos
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyUCService(string $id, array $attrs = []): Message\ModifyUCServiceResponse
    {
        return $this->invoke(new Message\ModifyUCServiceRequest(
            $id, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyVolume(int $id, VolumeInfo $volume): Message\ModifyVolumeResponse
    {
        return $this->invoke(new Message\ModifyVolumeRequest(
            $id, $volume
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyZimlet(ZimletAclStatusPri $zimlet): Message\ModifyZimletResponse
    {
        return $this->invoke(new Message\ModifyZimletRequest(
            $zimlet
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function noOp(): Message\NoOpResponse
    {
        return $this->invoke(new Message\NoOpRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function ping(): Message\PingResponse
    {
        return $this->invoke(new Message\PingRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function purgeAccountCalendarCache(string $id): Message\PurgeAccountCalendarCacheResponse
    {
        return $this->invoke(new Message\PurgeAccountCalendarCacheRequest(
            $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function purgeFreeBusyQueue(?NamedElement $provider = NULL): Message\PurgeFreeBusyQueueResponse
    {
        return $this->invoke(new Message\PurgeFreeBusyQueueRequest(
            $provider
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function purgeMessages(?MailboxByAccountIdSelector $mbox = NULL): Message\PurgeMessagesResponse
    {
        return $this->invoke(new Message\PurgeMessagesRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function pushFreeBusy(?Names $domains = NULL, array $accounts = []): Message\PushFreeBusyResponse
    {
        return $this->invoke(new Message\PushFreeBusyRequest(
            $domains, $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function queryWaitSet(?string $waitSetId = NULL): Message\QueryWaitSetResponse
    {
        return $this->invoke(new Message\QueryWaitSetRequest(
            $waitSetId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function recalculateMailboxCounts(
        ?MailboxByAccountIdSelector $mbox = NULL
    ): Message\RecalculateMailboxCountsResponse
    {
        return $this->invoke(new Message\RecalculateMailboxCountsRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshRegisteredAuthTokens(
        array $tokens = []
    ): Message\RefreshRegisteredAuthTokensResponse
    {
        return $this->invoke(new Message\RefreshRegisteredAuthTokensRequest(
            $tokens
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function reIndex(
        ReindexMailboxInfo $mbox, ?ReIndexAction $action = NULL
    ): Message\ReIndexResponse
    {
        return $this->invoke(new Message\ReIndexRequest(
            $mbox, $action
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function reloadLocalConfig(): Message\ReloadLocalConfigResponse
    {
        return $this->invoke(new Message\ReloadLocalConfigRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function reloadMemcachedClientConfig(): Message\ReloadMemcachedClientConfigResponse
    {
        return $this->invoke(new Message\ReloadMemcachedClientConfigRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function removeAccountAlias(string $id, string $alias): Message\RemoveAccountAliasResponse
    {
        return $this->invoke(new Message\RemoveAccountAliasRequest(
            $id, $alias
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function removeAccountLogger(
        ?LoggerInfo $logger = NULL, ?AccountSelector $account = NULL, ?string $id = NULL
    ): Message\RemoveAccountLoggerResponse
    {
        return $this->invoke(new Message\RemoveAccountLoggerRequest(
            $logger, $account, $id
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function removeDistributionListAlias(
        string $id, string $alias
    ): Message\RemoveDistributionListAliasResponse
    {
        return $this->invoke(new Message\RemoveDistributionListAliasRequest(
            $id, $alias
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function removeDistributionListMember(
        string $id, array $members = [], array $accounts = []
    ): Message\RemoveDistributionListMemberResponse
    {
        return $this->invoke(new Message\RemoveDistributionListMemberRequest(
            $id, $members, $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameAccount(string $id, string $newName): Message\RenameAccountResponse
    {
        return $this->invoke(new Message\RenameAccountRequest(
            $id, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameCalendarResource(string $id, string $newName): Message\RenameCalendarResourceResponse
    {
        return $this->invoke(new Message\RenameCalendarResourceRequest(
            $id, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameCos(string $id, string $newName): Message\RenameCosResponse
    {
        return $this->invoke(new Message\RenameCosRequest(
            $id, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameDistributionList(string $id, string $newName): Message\RenameDistributionListResponse
    {
        return $this->invoke(new Message\RenameDistributionListRequest(
            $id, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameLDAPEntry(string $dn, string $newDn): Message\RenameLDAPEntryResponse
    {
        return $this->invoke(new Message\RenameLDAPEntryRequest(
            $dn, $newDn
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function renameUCService(string $id, string $newName): Message\RenameUCServiceResponse
    {
        return $this->invoke(new Message\RenameUCServiceyRequest(
            $id, $newName
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function resetAllLoggers(): Message\ResetAllLoggersResponse
    {
        return $this->invoke(new Message\ResetAllLoggersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function revokeRight(
        EffectiveRightsTargetSelector $target,
        GranteeSelector $grantee,
        RightModifierInfo $right
    ): Message\RevokeRightResponse
    {
        return $this->invoke(new Message\RevokeRightRequest(
            $target, $grantee, $right
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function runUnitTests(array $tests = []): Message\RunUnitTestsResponse
    {
        return $this->invoke(new Message\RunUnitTestsRequest(
            $target, $grantee, $right
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchAccounts(
        string $query,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?string $attrs = NULL,
        ?string $sortBy = NULL,
        ?string $types = NULL,
        ?bool $sortAscending = NULL
    ): Message\SearchAccountsResponse
    {
        return $this->invoke(new Message\SearchAccountsRequest(
            $query,
            $limit,
            $offset,
            $domain,
            $applyCos,
            $attrs,
            $sortBy,
            $types,
            $sortAscending
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchAutoProvDirectory(
        string $keyAttr,
        DomainSelector $domain,
        ?string $query = NULL,
        ?string $name = NULL,
        ?int $maxResults = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?bool $refresh = NULL,
        ?string $attrs = NULL
    ): Message\SearchAutoProvDirectoryResponse
    {
        return $this->invoke(new Message\SearchAutoProvDirectoryRequest(
            $keyAttr,
            $domain,
            $query,
            $name,
            $maxResults,
            $limit,
            $offset,
            $refresh,
            $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchCalendarResources(
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $domain = NULL,
        ?bool $applyCos = NULL,
        ?string $sortBy = NULL,
        ?bool $sortAscending = NULL,
        ?string $attrs = NULL
    ): Message\SearchCalendarResourcesResponse
    {
        return $this->invoke(new Message\SearchCalendarResourcesRequest(
            $searchFilter,
            $limit,
            $offset,
            $domain,
            $applyCos,
            $sortBy,
            $sortAscending,
            $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchDirectory(
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
    ): Message\SearchDirectoryResponse
    {
        return $this->invoke(new Message\SearchDirectoryRequest(
            $query,
            $maxResults,
            $limit,
            $offset,
            $domain,
            $applyCos,
            $applyConfig,
            $sortBy,
            $types,
            $sortAscending,
            $isCountOnly,
            $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchGal(
        ?string $domain,
        ?string $name = NULL,
        ?int $limit = NULL,
        ?GalSearchType $type = NULL,
        ?string $galAccountId = NULL
    ): Message\SearchGalResponse
    {
        return $this->invoke(new Message\SearchGalRequest(
            $domain, $name, $limit, $type, $galAccountId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setCurrentVolume(int $id, int $type): Message\SetCurrentVolumeResponse
    {
        return $this->invoke(new Message\SetCurrentVolumeRequest(
            $id, $type
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setLocalServerOnline(): Message\SetLocalServerOnlineResponse
    {
        return $this->invoke(new Message\SetLocalServerOnlineRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword(string $id, string $newPassword): Message\SetPasswordResponse
    {
        return $this->invoke(new Message\SetPasswordRequest(
            $id, $newPassword
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function setServerOffline(
        ?ServerSelector $server = NULL, ?string $attrs = NULL
    ): Message\SetServerOfflineResponse
    {
        return $this->invoke(new Message\SetServerOfflineRequest(
            $server, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function syncGalAccount(array $accounts = []): Message\SyncGalAccountResponse
    {
        return $this->invoke(new Message\SyncGalAccountRequest(
            $accounts
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function undeployZimlet(string $name, ?string $action = NULL): Message\UndeployZimletResponse
    {
        return $this->invoke(new Message\UndeployZimletRequest(
            $name, $action
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function verifyIndex(?MailboxByAccountIdSelector $mbox = NULL): Message\VerifyIndexResponse
    {
        return $this->invoke(new Message\VerifyIndexRequest(
            $mbox
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function verifyStoreManager(
        ?int $fileSize = NULL,
        ?int $num = NULL,
        ?bool $checkBlobs = NULL
    ): Message\VerifyStoreManagerResponse
    {
        return $this->invoke(new Message\VerifyStoreManagerRequest(
            $fileSize, $num, $checkBlobs
        ));
    }
}
