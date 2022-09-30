<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use Zimbra\Admin\Struct\DomainSelector;
use Zimbra\Account\Struct\{
    AuthAttrs,
    AuthPrefs,
    AuthToken,
    DistributionListAction,
    EntrySearchFilterInfo,
    Identity,
    NameId,
    PreAuth,
    Signature
};
use Zimbra\Common\Enum\{
    DistributionListSubscribeOp,
    GalSearchType,
    MemberOfSelector
};
use Zimbra\Common\Struct\{
    AccountSelector,
    CursorInfo,
    DistributionListSelector,
    GranteeChooser
};
use Zimbra\Common\Soap\ApiInterface;

/**
 * AccountApiInterface interface
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface AccountApiInterface extends ApiInterface
{
    /**
     * Authenticate for an account
     * when specifying an account, one of <password> or <preauth> or <recoveryCode> must be specified. See preauth.txt for a discussion of preauth.
     * An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * If {verifyAccount}="1", <account> is required and the account in the auth token is compared to the named account.
     * Mismatch results in auth failure.
     * An external app that relies on ZCS for user identification can use this to test if the auth token provided by the user belongs to that user.
     * If {verifyAccount}="0" (default), only the auth token is verified and any <account> element specified is ignored. 
     *
     * @param  AccountSelector   $account
     * @param  string    $password
     * @param  string    $recoveryCode
     * @param  PreAuth   $preauth
     * @param  AuthToken $authToken
     * @param  string    $jwtToken
     * @param  string    $virtualHost
     * @param  array $prefs
     * @param  array $attrs
     * @param  string    $requestedSkin
     * @param  bool      $persistAuthTokenCookie
     * @param  bool      $csrfSupported
     * @param  string    $twoFactorCode
     * @param  bool      $deviceTrusted
     * @param  string    $trustedDeviceToken
     * @param  string    $deviceId
     * @param  bool      $generateDeviceId
     * @param  string    $tokenType
     * @return Message\AuthResponse
     */
    function auth(
        ?AccountSelector $account = NULL,
        ?string $password = NULL,
        ?string $recoveryCode = NULL,
        ?PreAuth $preauth = NULL,
        ?AuthToken $authToken = NULL,
        ?string $jwtToken = NULL,
        ?string $virtualHost = NULL,
        array $prefs = [],
        array $attrs = [],
        ?string $requestedSkin = NULL,
        ?bool $persistAuthTokenCookie = NULL,
        ?bool $csrfSupported = NULL,
        ?string $twoFactorCode = NULL,
        ?bool $deviceTrusted = NULL,
        ?string $trustedDeviceToken = NULL,
        ?string $deviceId = NULL,
        ?bool $generateDeviceId = NULL,
        ?string $tokenType = NULL
    ): ?Message\AuthResponse;

    /**
     * Authenticate by account name
     *
     * @param  string $name
     * @param  string $password
     * @return Message\AuthResponse
     */
    function authByAccountName(string $name, string $password): ?Message\AuthResponse;

    /**
     * Authenticate by account id
     *
     * @param  string $id
     * @param  string $password
     * @return Message\AuthResponse
     */
    function authByAccountId(string $id, string $password): ?Message\AuthResponse;

    /**
     * Authenticate by auth token
     *
     * @param  string $authToken
     * @return Message\AuthResponse
     */
    function authByToken(string $authToken): ?Message\AuthResponse;

    /**
     * Authenticate by preauth
     *
     * @param  string $name
     * @param  string $preauthKey
     * @return Message\AuthResponse
     */
    function authByPreauth(string $name, string $preauthKey): ?Message\AuthResponse;

    /**
     * Perform an autocomplete for a name against the Global Address List
     * The number of entries in the response is limited by Account/COS attribute zimbraContactAutoCompleteMaxResults with
     * default value of 20.
     *
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  string $galAccountId
     * @param  int $limit
     * @return Message\AutoCompleteGalResponse
     */
    function autoCompleteGal(
        string $name,
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): ?Message\AutoCompleteGalResponse;

    /**
     * Change Password
     *
     * @param  AccountSelector $account
     * @param  string $oldPassword
     * @param  string $newPassword
     * @param  string $virtualHost
     * @param  bool   $dryRun
     * @return Message\ChangePasswordResponse
     */
    function changePassword(
        AccountSelector $account,
        string $oldPassword,
        string $newPassword,
        ?string $virtualHost = NULL,
        ?bool $dryRun = NULL
    ): ?Message\ChangePasswordResponse;

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets
     * @return Message\CheckRightsResponse
     */
    function checkRights(array $targets = []): ?Message\CheckRightsResponse;

    /**
     * Get client info
     *
     * @param  DomainSelector $domain
     * @return Message\ClientInfoResponse
     */
    function clientInfo(DomainSelector $domain): ?Message\ClientInfoResponse;

    /**
     * Create a Distribution List 
     * Notes:
     * authed account must have the privilege to create dist lists in the domain 
     *
     * @param  string $name
     * @param  bool $dynamic
     * @param  array $attrs
     * @return Message\CreateDistributionListResponse
     */
    function createDistributionList(
        string $name, ?bool $dynamic = NULL, array $attrs = []
    ): ?Message\CreateDistributionListResponse;

    /**
     * Create an Identity
     * Notes:
     * Allowed attributes (see objectclass zimbraIdentity in zimbra.schema)
     *
     * @param  Identity $identity
     * @return Message\CreateIdentityResponse
     */
    function createIdentity(Identity $identity): ?Message\CreateIdentityResponse;

    /**
     * Create a signature.
     * If an id is provided it will be honored as the id for the signature. 
     * CreateSignature will set account default signature to the signature being created
     * if there is currently no default signature for the account.
     * There can be at most one text/plain signatue and one text/html signature. 
     *
     * @param  Signature $signature
     * @return Message\CreateSignatureResponse
     */
    function createSignature(Signature $signature): ?Message\CreateSignatureResponse;

    /**
     * Delete an Identity
     * must specify either {name} or {id} attribute to <identity>
     *
     * @param  NameId $identity
     * @return Message\DeleteIdentityResponse
     */
    function deleteIdentity(NameId $identity): ?Message\DeleteIdentityResponse;

    /**
     * Delete a signature
     * must specify either {name} or {id} attribute to <identity>
     *
     * @param  NameId $signature
     * @return Message\DeleteSignatureResponse
     */
    function deleteSignature(NameId $signature): ?Message\DeleteSignatureResponse;

    /**
     * Return all targets of the specified rights applicable to the requested account.
     * Notes:
     * 1. This call only discovers grants granted on the designated target type of the specified rights.
     *    It does not return grants granted on target types the rights can inherit from. 
     * 2. For sendAs, sendOnBehalfOf, sendAsDistList, sendOnBehalfOfDistList rights, name attribute
     *    is not returned on <target> elements.
     *    Instead, addresses in the target entry's zimbraPrefAllowAddressForDelegatedSender are returned
     *    in <e a="{email-address}"/> elements under the <target> element.
     *    If zimbraPrefAllowAddressForDelegatedSender is not set on the target entry,
     *    the entry's primary email address will be return in the only <e a="{email-address}"/> element
     *    under the <target> element.
     * 3. For all other rights, name attribute is always returned on <target> elements,
     *    no <e a="{email-address}"/> will be returned. name attribute contains the entry's primary name.
     *
     * @param  array $rights
     * @return Message\DiscoverRightsResponse
     */
    function discoverRights(array $rights = []): ?Message\DiscoverRightsResponse;

    /**
     * Perform an action on a Distribution List
     * Notes:
     *  - Authorized account must be one of the list owners 
     *  - For owners/rights, only grants on the group itself will be modified,
     *    grants on domain and globalgrant (from which the right can be inherited) will not be touched.
     *    Only admins can modify grants on domains and globalgrant, owners of groups
     *    can only modify grants on the group entry.
     *
     * @param  DistributionListSelector $dl
     * @param  DistributionListAction $action
     * @return Message\DistributionListActionResponse
     */
    function distributionListAction(
        DistributionListSelector $dl, DistributionListAction $action
    ): ?Message\DistributionListActionResponse;

    /**
     * End the current session, removing it from all caches.
     * Called when the browser app (or other session-using app) shuts down.
     * Has no effect if called in a <nosession> context. 
     *
     * @param  bool $logoff
     * @param  bool $clearAllSoapSessions
     * @param  bool $excludeCurrentSession
     * @param  string $sessionId
     * @return Message\EndSessionResponse
     */
    function endSession(
        ?bool $logoff = NULL,
        ?bool $clearAllSoapSessions = NULL,
        ?bool $excludeCurrentSession = NULL,
        ?string $sessionId = NULL
    ): ?Message\EndSessionResponse;

    /**
     * Returns groups the user is either a member or an owner of. 
     * Notes:
     *  - isOwner is returned only if ownerOf on the request is 1 (true).
     *  - isMember is returned only if memberOf on the request is not "none".
     *
     * @param  bool $ownerOf
     * @param  MemberOfSelector $memberOf
     * @param  string $attrs
     * @return Message\GetAccountDistributionListsResponse
     */
    function getAccountDistributionLists(
        ?bool $ownerOf = NULL,
        ?MemberOfSelector $memberOf = NULL,
        ?string $attrs = NULL
    ): ?Message\GetAccountDistributionListsResponse;

    /**
     * Get information about an account
     *
     * @param  AccountSelector $account
     * @return Message\GetAccountInfoResponse
     */
    function getAccountInfo(AccountSelector $account): ?Message\GetAccountInfoResponse;

    /**
     * Returns all locales defined in the system.  This is the same list returned by
     * java.util.Locale.getAvailableLocales(), sorted by display name (name attribute). 
     *
     * @return Message\GetAllLocalesResponse
     */
    function getAllLocales(): ?Message\GetAllLocalesResponse;

    /**
     * Returns the known CSV formats that can be used for import and export of addressbook.
     *
     * @return Message\GetAvailableCsvFormatsResponse
     */
    function getAvailableCsvFormats(): ?Message\GetAvailableCsvFormatsResponse;

    /**
     * Get the intersection of all translated locales installed on the server and the list
     * specified in zimbraAvailableLocale. The locale list in the response is sorted by display name (name attribute).
     *
     * @return Message\GetAvailableLocalesResponse
     */
    function getAvailableLocales(): ?Message\GetAvailableLocalesResponse;

    /**
     * Get the intersection of installed skins on the server and the list specified in the
     * zimbraAvailableSkin on an account (or its CoS).  If none is set in zimbraAvailableSkin, get the entire
     * list of installed skins.  The installed skin list is obtained by a directory scan of the designated location of
     * skins on a server.
     *
     * @return Message\GetAvailableSkinsResponse
     */
    function getAvailableSkins(): ?Message\GetAvailableSkinsResponse;

    /**
     * Get the list of members of a distribution list.
     *
     * @param  string $dl
     * @param  int $limit
     * @param  int $offset
     * @return Message\GetDistributionListMembersResponse
     */
    function getDistributionListMembers(
        string $dl,
        ?int $limit = NULL,
        ?int $offset = NULL
    ): ?Message\GetDistributionListMembersResponse;

    /**
     * Get a distribution list, optionally with ownership information an granted rights.
     *
     * @param  DistributionListSelector $dl
     * @param  bool $needOwners
     * @param  string $needRights
     * @param  array $attrs
     * @return Message\GetDistributionListResponse
     */
    function getDistributionList(
        DistributionListSelector $dl,
        ?bool $needOwners = NULL,
        ?string $needRights = NULL,
        array $attrs = []
    ): ?Message\GetDistributionListResponse;

    /**
     * Get the identities for the authed account.
     *
     * @return Message\GetIdentitiesResponse
     */
    function getIdentities(): ?Message\GetIdentitiesResponse;

    /**
     * Get information about an account.
     * By default, GetInfo returns all data; to limit the returned data,
     * specify only the sections you want in the "sections" attr.
     *
     * @param  string $sections
     * @param  string $rights
     * @return Message\GetInfoResponse
     */
    function getInfo(
        ?string $sections = NULL, ?string $rights = NULL
    ): ?Message\GetInfoResponse;

    /**
     * Get OAuth consumers.
     *
     * @return Message\GetOAuthConsumersResponse
     */
    function getOAuthConsumers(): ?Message\GetOAuthConsumersResponse;

    /**
     * Get preferences for the authenticated account
     * If no <pref> elements are provided, all known prefs are returned in the response.
     * If <pref> elements are provided, only those prefs are returned in the response.
     *
     * @param  array $prefs
     * @return Message\GetPrefsResponse
     */
    function getPrefs(array $prefs = []): ?Message\GetPrefsResponse;

    /**
     * Get account level rights.
     * If no <ace> elements are provided, all ACEs are returned in the response.
     * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
     *
     * @param  array $aces
     * @return Message\GetRightsResponse
     */
    function getRights(array $aces = []): ?Message\GetRightsResponse;

    /**
     * Get information about published shares
     *
     * @param  GranteeChooser $grantee
     * @param  AccountSelector $owner
     * @param  bool $internal
     * @param  bool $includeSelf
     * @return Message\GetShareInfoResponse
     */
    function getShareInfo(
        ?GranteeChooser $grantee = NULL,
        ?AccountSelector $owner = NULL,
        ?bool $internal = NULL,
        ?bool $includeSelf = NULL
    ): ?Message\GetShareInfoResponse;

    /**
     * Get signatures associated with an account
     *
     * @return Message\GetSignaturesResponse
     */
    function getSignatures(): ?Message\GetSignaturesResponse;

    /**
     * Get version information
     *
     * @return Message\GetVersionInfoResponse
     */
    function getVersionInfo(): ?Message\GetVersionInfoResponse;

    /**
     * Get the anti-spam WhiteList and BlackList addresses
     *
     * @return Message\GetWhiteBlackListResponse
     */
    function getWhiteBlackList(): ?Message\GetWhiteBlackListResponse;

    /**
     * Grant account level rights
     *
     * @param  array $aces
     * @return Message\GrantRightsResponse
     */
    function grantRights(array $aces = []): ?Message\GrantRightsResponse;

    /**
     * Modify an Identity
     *
     * @param  Identity $identity
     * @return Message\ModifyIdentityResponse
     */
    function modifyIdentity(Identity $identity): ?Message\ModifyIdentityResponse;

    /**
     * Modify Preferences
     * Notes:
     * For multi-value prefs, just add the same attribute with 'n' different values
     * You can also add/subtract single values to/from a multi-value pref by prefixing
     * the preference name with a '+' or '-', respectively in the same way you do when using zmprov.
     *
     * @param  array $prefs
     * @return Message\ModifyPrefsResponse
     */
    function modifyPrefs(array $prefs = []): ?Message\ModifyPrefsResponse;

    /**
     * Modify properties related to zimlets
     *
     * @param  array $props
     * @return Message\ModifyPropertiesResponse
     */
    function modifyProperties(array $props = []): ?Message\ModifyPropertiesResponse;

    /**
     * Create a signature.
     * If an id is provided it will be honored as the id for the signature. 
     * CreateSignature will set account default signature to the signature being created
     * if there is currently no default signature for the account.
     * There can be at most one text/plain signatue and one text/html signature. 
     *
     * @param  Signature $signature
     * @return Message\ModifySignatureResponse
     */
    function modifySignature(Signature $signature): ?Message\ModifySignatureResponse;

    /**
     * Modify the anti-spam WhiteList and BlackList addresses
     *
     * @param  array $whiteListEntries
     * @param  array $blackListEntries
     * @return Message\ModifyWhiteBlackListResponse
     */
    function modifyWhiteBlackList(
        array $whiteListEntries = [], array $blackListEntries = []
    ): ?Message\ModifyWhiteBlackListResponse;

    /**
     * Modify zimlet preferences
     *
     * @param  array $zimlets
     * @return Message\ModifyZimletPrefsResponse
     */
    function modifyZimletPrefs(array $zimlets = []): ?Message\ModifyZimletPrefsResponse;

    /**
     * Reset password
     *
     * @param  string $password
     * @return Message\ResetPasswordResponse
     */
    function resetPassword(string $password): ?Message\ResetPasswordResponse;

    /**
     * Revoke OAuth consumer
     *
     * @param  string $accessToken
     * @return Message\RevokeOAuthConsumerResponse
     */
    function revokeOAuthConsumer(string $accessToken): ?Message\RevokeOAuthConsumerResponse;

    /**
     * Revoke account level rights
     *
     * @param  array $aces
     * @return Message\RevokeRightsResponse
     */
    function revokeRights(array $aces = []): ?Message\RevokeRightsResponse;

    /**
     * Search Global Address List (GAL) for calendar resources
     * "attrs" attribute - comma-separated list of attrs to return ("displayName", "zimbraId", "zimbraCalResType")
     *
     * @param  CursorInfo $cursor
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  bool $quick
     * @param  string $sortBy
     * @param  int $limit
     * @param  int $offset
     * @param  string $locale
     * @param  string $galAccountId
     * @param  string $name
     * @param  string $attrs
     * @return Message\SearchCalendarResourcesResponse
     */
    function searchCalendarResources(
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
    ): ?Message\SearchCalendarResourcesResponse;

    /**
     * Search Global Address List (GAL)
     *
     * @param  CursorInfo $cursor
     * @param  EntrySearchFilterInfo $searchFilter
     * @param  string $ref
     * @param  string $name
     * @param  GalSearchType $type
     * @param  bool $needCanExpand
     * @param  bool $needIsOwner
     * @param  MemberOfSelector $needIsMember
     * @param  bool $needSMIMECerts
     * @param  string $galAccountId
     * @param  bool $quick
     * @param  string $sortBy
     * @param  int $limit
     * @param  int $offset
     * @param  string $locale
     * @return Message\SearchGalResponse
     */
    function searchGal(
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
    ): ?Message\SearchGalResponse;

    /**
     * Subscribe to or unsubscribe from a distribution list 
     *
     * @param  DistributionListSelector $dl
     * @param  DistributionListSubscribeOp $op
     * @return Message\SubscribeDistributionListResponse
     */
    function subscribeDistributionList(
        DistributionListSelector $dl, DistributionListSubscribeOp $op
    ): ?Message\SubscribeDistributionListResponse;

    /**
     * Synchronize with the Global Address List
     *
     * @param  string $token
     * @param  string $galAccountId
     * @param  bool $idOnly
     * @param  bool $getCount
     * @param  int $limit
     * @return Message\SyncGalResponse
     */
    function syncGal(
        ?string $token = NULL,
        ?string $galAccountId = NULL,
        ?bool $idOnly = NULL,
        ?bool $getCount = NULL,
        ?int $limit = NULL
    ): ?Message\SyncGalResponse;
}
