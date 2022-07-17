<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Zimbra\Account;

use Zimbra\Account\Struct\{
    AuthAttrs,
    AuthPrefs,
    AuthToken,
    BlackList,
    DistributionListSelector,
    DistributionListAction,
    Identity,
    NameId,
    PreAuth,
    Signature,
    WhiteList
}
use Zimbra\Common\Enum\{
    AccountBy,
    DistributionListBy,
    DistributionListSubscribeOp,
    GalSearchType,
    MemberOfSelector,
    SortBy
}
use Zimbra\Common\Struct\{
    AccountSelector,
    CursorInfo,
    EntrySearchFilterInfo,
    GranteeChooser
}
use Zimbra\Soap\AbstractApi;

/**
 * Account api class
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
class AccountApi extends AbstractApi implements AccountApiInterface
{
    /**
     * {@inheritdoc}
     */
    public function auth(
        AccountSelector $account = NULL,
        $password = NULL,
        $recoveryCode = NULL,
        PreAuth $preauth = NULL,
        AuthToken $authToken = NULL,
        $jwtToken = NULL,
        $virtualHost = NULL,
        AuthPrefs $prefs = NULL,
        AuthAttrs $attrs = NULL,
        $requestedSkin = NULL,
        $persistAuthTokenCookie = NULL,
        $csrfSupported = NULL,
        $twoFactorCode = NULL,
        $deviceTrusted = NULL,
        $trustedDeviceToken = NULL,
        $deviceId = NULL,
        $generateDeviceId = NULL,
        $tokenType = NULL
    ): Message\AuthResponse
    {
        return $this->invoke(new Message\AuthRequest(
            $account,
            $password,
            $recoveryCode,
            $preauth,
            $authToken,
            $jwtToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            $persistAuthTokenCookie,
            $csrfSupported,
            $twoFactorCode,
            $deviceTrusted,
            $trustedDeviceToken,
            $deviceId,
            $generateDeviceId,
            $tokenType
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function authByName($name, $password = NULL): Message\AuthResponse
    {
        $account = new AccountSelector(AccountBy::NAME()->getValue(), $name);
        return $this->auth($account, $password);
    }

    /**
     * {@inheritdoc}
     */
    public function authByToken($authToken): Message\AuthResponse
    {
        $token = ($authToken instanceof AuthToken) ? $authToken : new AuthToken($authToken);
        return $this->auth(NULL, NULL, NULL, $token);
    }

    /**
     * {@inheritdoc}
     */
    public function autoCompleteGal(
        string $name,
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): Message\AutoCompleteGalResponse
    {
        return $this->invoke(new Message\AutoCompleteGalRequest(
            $name, $type, $needCanExpand, $galAccountId, $limit
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function changePassword(
        AccountSelector $account,
        string $oldPassword,
        string $newPassword,
        ?string $virtualHost = NULL,
        ?bool $dryRun = NULL
    ): Message\ChangePasswordResponse
    {
        return $this->invoke(new Message\ChangePasswordRequest(
            $account, $oldPassword, $newPassword, $virtualHost, $dryRun
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function checkRights(array $targets = []): Message\CheckRightsResponse
    {
        return $this->invoke(new Message\CheckRightsRequest(
            $targets
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function clientInfo(DomainSelector $domain): Message\ClientInfoResponse
    {
        return $this->invoke(new Message\ClientInfoRequest(
            $domain
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
    public function createIdentity(Identity $identity): Message\CreateIdentityResponse
    {
        return $this->invoke(new Message\CreateIdentityRequest(
            $identity
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function createSignature(Signature $signature): Message\CreateSignatureResponse
    {
        return $this->invoke(new Message\CreateSignatureRequest(
            $signature
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteIdentity(NameId $identity): Message\DeleteIdentityResponse
    {
        return $this->invoke(new Message\DeleteIdentityRequest(
            $identity
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function deleteSignature(NameId $signature): Message\DeleteSignatureResponse
    {
        return $this->invoke(new Message\DeleteSignatureRequest(
            $signature
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function discoverRights(array $rights = []): Message\DiscoverRightsResponse
    {
        return $this->invoke(new Message\DiscoverRightsRequest(
            $rights
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function distributionListAction(
        DistributionListSelector $dl, DistributionListAction $action
    ): Message\DistributionListActionResponse
    {
        return $this->invoke(new Message\DistributionListActionRequest(
            $dl, $action
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function endSession(
        ?bool $logoff = NULL,
        ?bool $clearAllSoapSessions = NULL,
        ?bool $excludeCurrentSession = NULL,
        ?string $sessionId = NULL
    ): Message\EndSessionResponse
    {
        return $this->invoke(new Message\EndSessionRequest(
            $logoff, $clearAllSoapSessions, $excludeCurrentSession, $sessionId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getAccountDistributionLists(
        ?bool $ownerOf = NULL,
        ?MemberOfSelector $memberOf = NULL,
        ?string $attrs = NULL
    ): Message\GetAccountDistributionListsResponse
    {
        return $this->invoke(new Message\GetAccountDistributionListsRequest(
            $ownerOf, $memberOf, $attrs
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
    public function getAllLocales(): Message\GetAllLocalesResponse
    {
        return $this->invoke(new Message\GetAllLocalesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableCsvFormats(): Message\GetAvailableCsvFormatsResponse
    {
        return $this->invoke(new Message\GetAvailableCsvFormatsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableLocales(): Message\GetAvailableLocalesResponse
    {
        return $this->invoke(new Message\GetAvailableLocalesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailableSkins(): Message\GetAvailableSkinsResponse
    {
        return $this->invoke(new Message\GetAvailableSkinsRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getDistributionListMembers(
        string $dl,
        ?int $limit = NULL,
        ?int $offset = NULL
    ): Message\GetDistributionListMembersResponse
    {
        return $this->invoke(new Message\GetDistributionListMembersRequest(
            $dl, $limit, $offset
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getDistributionList(
        DistributionListSelector $dl,
        ?bool $needOwners = NULL,
        ?string $needRights = NULL,
        array $attrs = []
    ): Message\GetDistributionListResponse
    {
        return $this->invoke(new Message\GetDistributionListRequest(
            $dl, $needOwners, $needRights, $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities(): Message\GetIdentitiesResponse
    {
        return $this->invoke(new Message\GetIdentitiesRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getInfo(
        string $sections = NULL, string $rights = NULL
    ): Message\GetInfoResponse
    {
        return $this->invoke(new Message\GetInfoRequest(
            $sections, $rights
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getOAuthConsumers(): Message\GetOAuthConsumersResponse
    {
        return $this->invoke(new Message\GetOAuthConsumersRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefs(array $prefs = []): Message\GetPrefsResponse
    {
        return $this->invoke(new Message\GetPrefsRequest(
            $prefs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getRights(array $aces = []): Message\GetRightsResponse
    {
        return $this->invoke(new Message\GetRightsRequest(
            $aces
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getShareInfo(
        ?GranteeChooser $grantee = NULL,
        ?AccountSelector $owner = NULL,
        ?bool $internal = NULL,
        ?bool $includeSelf = NULL
    ): Message\GetShareInfoResponse
    {
        return $this->invoke(new Message\GetShareInfoRequest(
            $grantee, $owner, $internal, $includeSelf
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatures(): Message\GetSignaturesResponse
    {
        return $this->invoke(new Message\GetSignaturesRequest());
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
    public function getWhiteBlackList(): Message\GetWhiteBlackListResponse
    {
        return $this->invoke(new Message\GetWhiteBlackListRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function grantRights(array $aces = []): Message\GrantRightsResponse
    {
        return $this->invoke(new Message\GrantRightsRequest($aces));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyIdentity(Identity $identity): Message\ModifyIdentityResponse
    {
        return $this->invoke(new Message\ModifyIdentityRequest($identity));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyPrefs(array $prefs = []): Message\ModifyPrefsResponse
    {
        return $this->invoke(new Message\ModifyPrefsRequest($prefs));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyProperties(array $props = []): Message\ModifyPropertiesResponse
    {
        return $this->invoke(new Message\ModifyPropertiesRequest($props));
    }

    /**
     * {@inheritdoc}
     */
    public function modifySignature(Signature $signature): Message\ModifySignatureResponse
    {
        return $this->invoke(new Message\ModifySignatureRequest($signature));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyWhiteBlackList(
        array $whiteListEntries = [], array $blackListEntries = []
    ): Message\ModifyWhiteBlackListResponse
    {
        return $this->invoke(new Message\ModifyWhiteBlackListRequest(
            $whiteListEntries, $blackListEntries
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function modifyZimletPrefs(array $zimlets = []): Message\ModifyZimletPrefsResponse
    {
        return $this->invoke(new Message\ModifyZimletPrefsRequest($zimlets));
    }

    /**
     * {@inheritdoc}
     */
    public function resetPassword(string $password): Message\ResetPasswordResponse
    {
        return $this->invoke(new Message\ResetPasswordRequest($password));
    }

    /**
     * {@inheritdoc}
     */
    public function revokeOAuthConsumer(string $accessToken): Message\RevokeOAuthConsumerResponse
    {
        return $this->invoke(new Message\RevokeOAuthConsumerRequest($accessToken));
    }

    /**
     * {@inheritdoc}
     */
    public function revokeRights(array $aces = []): Message\RevokeRightsResponse
    {
        return $this->invoke(new Message\RevokeRightsRequest($aces));
    }

    /**
     * {@inheritdoc}
     */
    public function searchCalendarResources(
        ?CursorInfo $cursor = NULL,
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?bool $quick = NULL,
        ?string $sortBy = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $locale = NULL,
        ?string $galAccountId = NULL,
        ?string $name = NULL,
        ?string $attrs = NULL
    ): Message\SearchCalendarResourcesResponse
    {
        return $this->invoke(new Message\SearchCalendarResourcesRequest(
            $cursor,
            $searchFilter,
            $quick,
            $sortBy,
            $limit,
            $offset,
            $locale,
            $galAccountId,
            $name,
            $attrs
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function searchGal(
        ?CursorInfo $cursor = NULL,
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?string $ref = NULL,
        ?string $name = NULL,
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?bool $needIsOwner = NULL,
        ?MemberOfSelector $needIsMember = NULL,
        ?bool $needSMIMECerts = NULL,
        ?string $galAccountId = NULL,
        ?bool $quick = NULL,
        ?string $sortBy = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $locale = NULL
    ): Message\SearchGalResponse
    {
        return $this->invoke(new Message\SearchGalRequest(
            $cursor,
            $searchFilter,
            $ref,
            $name,
            $type,
            $needCanExpand,
            $needIsOwner,
            $needIsMember,
            $needSMIMECerts,
            $galAccountId,
            $quick,
            $sortBy,
            $limit,
            $offset,
            $locale
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function subscribeDistributionList(
        DistributionListSelector $dl, DistributionListSubscribeOp $op
    ): Message\SubscribeDistributionListResponse
    {
        return $this->invoke(new Message\SubscribeDistributionListRequest($dl, $op));
    }

    /**
     * {@inheritdoc}
     */
    public function syncGal(
        ?string $token = NULL,
        ?string $galAccountId = NULL,
        ?bool $idOnly = NULL,
        ?bool $getCount = NULL,
        ?int $limit = NULL
    ): Message\SyncGalResponse
    {
        return $this->invoke(new Message\SyncGalRequest(
            $token, $galAccountId, $idOnly, $getCount, $limit
        ));
    }
}
