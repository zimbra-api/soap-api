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

use Zimbra\Account\Struct\{
    AuthToken,
    DistributionListAction,
    EntrySearchFilterInfo,
    Identity,
    NameId,
    PreAuth,
    Signature
};
use Zimbra\Enum\{
    DistributionListSubscribeOp,
    GalSearchType,
    MemberOfSelector
};
use Zimbra\Struct\{
    AccountSelector,
    CursorInfo,
    DistributionListSelector,
    GranteeChooser
};
use Zimbra\Soap\{ApiInterface, ResponseInterface};

/**
 * AccountApiInterface interface
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
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
     * @return ResponseInterface
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
    ): ResponseInterface;

    /**
     * Authenticate for an account
     *
     * @param  string $name
     * @param  string $password
     * @return ResponseInterface
     */
    function authByName(string $name, string $password): ResponseInterface;

    /**
     * Authenticate for an account
     *
     * @param  string $authToken
     * @return ResponseInterface
     */
    function authByToken(string $authToken): ResponseInterface;

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
     * @return ResponseInterface
     */
    function autoCompleteGal(
        string $name,
        ?GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?string $galAccountId = NULL,
        ?int $limit = NULL
    ): ResponseInterface;

    /**
     * Change Password
     *
     * @param  AccountSelector $account
     * @param  string $oldPassword
     * @param  string $newPassword
     * @param  string $virtualHost
     * @param  bool   $dryRun
     * @return ResponseInterface
     */
    function changePassword(
        AccountSelector $account,
        string $oldPassword,
        string $newPassword,
        ?string $virtualHost = NULL,
        ?bool $dryRun = NULL
    ): ResponseInterface;

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets
     * @return ResponseInterface
     */
    function checkRights(array $targets = []): ResponseInterface;

    /**
     * clientInfo
     *
     * @param  DomainSelector $domain
     * @return ResponseInterface
     */
    function clientInfo(DomainSelector $domain): ResponseInterface;

    /**
     * Create a Distribution List 
     * Notes:
     * authed account must have the privilege to create dist lists in the domain 
     *
     * @param  string $name
     * @param  bool $dynamic
     * @param  array $attrs
     * @return ResponseInterface
     */
    function createDistributionList(
        string $name, ?bool $dynamic = NULL, array $attrs = []
    ): ResponseInterface;

    /**
     * Create an Identity
     * Notes:
     * Allowed attributes (see objectclass zimbraIdentity in zimbra.schema)
     *
     * @param  Identity $identity
     * @return ResponseInterface
     */
    function createIdentity(Identity $identity): ResponseInterface;

    /**
     * Create a signature.
     * If an id is provided it will be honored as the id for the signature. 
     * CreateSignature will set account default signature to the signature being created
     * if there is currently no default signature for the account.
     * There can be at most one text/plain signatue and one text/html signature. 
     *
     * @param  Signature $signature
     * @return ResponseInterface
     */
    function createSignature(Signature $signature): ResponseInterface;

    /**
     * Delete an Identity
     * must specify either {name} or {id} attribute to <identity>
     *
     * @param  NameId $identity
     * @return ResponseInterface
     */
    function deleteIdentity(NameId $identity): ResponseInterface;

    /**
     * Delete a signature
     * must specify either {name} or {id} attribute to <identity>
     *
     * @param  NameId $signature
     * @return ResponseInterface
     */
    function deleteSignature(NameId $signature): ResponseInterface;

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
     * @return ResponseInterface
     */
    function discoverRights(array $rights = []): ResponseInterface;

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
     * @return ResponseInterface
     */
    function distributionListAction(
        DistributionListSelector $dl, DistributionListAction $action
    ): ResponseInterface;

    /**
     * End the current session, removing it from all caches.
     * Called when the browser app (or other session-using app) shuts down.
     * Has no effect if called in a <nosession> context. 
     *
     * @param  bool $logoff
     * @param  bool $clearAllSoapSessions
     * @param  bool $excludeCurrentSession
     * @param  string $sessionId
     * @return ResponseInterface
     */
    function endSession(
        ?bool $logoff = NULL,
        ?bool $clearAllSoapSessions = NULL,
        ?bool $excludeCurrentSession = NULL,
        ?string $sessionId = NULL
    ): ResponseInterface;

    /**
     * Returns groups the user is either a member or an owner of. 
     * Notes:
     *  - isOwner is returned only if ownerOf on the request is 1 (true).
     *  - isMember is returned only if memberOf on the request is not "none".
     *
     * @param  string $ownerOf
     * @param  MemberOfSelector $memberOf
     * @param  string $attrs
     * @return ResponseInterface
     */
    function getAccountDistributionLists(
        ?bool $ownerOf = NULL,
        ?MemberOfSelector $memberOf = NULL,
        ?string $attrs = NULL
    ): ResponseInterface;

    /**
     * Get information about an account
     *
     * @param  AccountSelector $account
     * @return ResponseInterface
     */
    function getAccountInfo(AccountSelector $account): ResponseInterface;

    /**
     * Returns all locales defined in the system.  This is the same list returned by
     * java.util.Locale.getAvailableLocales(), sorted by display name (name attribute). 
     *
     * @return ResponseInterface
     */
    function getAllLocales(): ResponseInterface;

    /**
     * Returns the known CSV formats that can be used for import and export of addressbook.
     *
     * @return ResponseInterface
     */
    function getAvailableCsvFormats(): ResponseInterface;

    /**
     * Get the intersection of all translated locales installed on the server and the list
     * specified in zimbraAvailableLocale. The locale list in the response is sorted by display name (name attribute).
     *
     * @return ResponseInterface
     */
    function getAvailableLocales(): ResponseInterface;

    /**
     * Get the intersection of installed skins on the server and the list specified in the
     * zimbraAvailableSkin on an account (or its CoS).  If none is set in zimbraAvailableSkin, get the entire
     * list of installed skins.  The installed skin list is obtained by a directory scan of the designated location of
     * skins on a server.
     *
     * @return ResponseInterface
     */
    function getAvailableSkins(): ResponseInterface;

    /**
     * Get the list of members of a distribution list.
     *
     * @param  string $dl
     * @param  int $limit
     * @param  int $offset
     * @return ResponseInterface
     */
    function getDistributionListMembers(
        string $dl,
        ?int $limit = NULL,
        ?int $offset = NULL
    ): ResponseInterface;

    /**
     * Get a distribution list, optionally with ownership information an granted rights.
     *
     * @param  getDistributionList $dl
     * @param  bool $needOwners
     * @param  string $needRights
     * @param  array $attrs
     * @return ResponseInterface
     */
    function getDistributionList(
        DistributionListSelector $dl,
        ?bool $needOwners = NULL,
        ?string $needRights = NULL,
        array $attrs = []
    ): ResponseInterface;

    /**
     * Get the identities for the authed account.
     *
     * @return ResponseInterface
     */
    function getIdentities(): ResponseInterface;

    /**
     * Get information about an account.
     * By default, GetInfo returns all data; to limit the returned data,
     * specify only the sections you want in the "sections" attr.
     *
     * @param  string $sections
     * @param  string $rights
     * @return ResponseInterface
     */
    function getInfo(
        string $sections = NULL, string $rights = NULL
    ): ResponseInterface;

    /**
     * Get OAuth consumers.
     *
     * @return ResponseInterface
     */
    function getOAuthConsumers(): ResponseInterface;

    /**
     * Get preferences for the authenticated account
     * If no <pref> elements are provided, all known prefs are returned in the response.
     * If <pref> elements are provided, only those prefs are returned in the response.
     *
     * @param  array $prefs
     * @return ResponseInterface
     */
    function getPrefs(array $prefs = []): ResponseInterface;

    /**
     * Get account level rights.
     * If no <ace> elements are provided, all ACEs are returned in the response.
     * If <ace> elements are provided, only those ACEs with specified rights are returned in the response.
     *
     * @param  array $aces
     * @return ResponseInterface
     */
    function getRights(array $aces = []): ResponseInterface;

    /**
     * Get information about published shares
     *
     * @param  GranteeChooser $grantee
     * @param  AccountSelector $owner
     * @param  bool $internal
     * @param  bool $includeSelf
     * @return ResponseInterface
     */
    function getShareInfo(
        ?GranteeChooser $grantee = NULL,
        ?AccountSelector $owner = NULL,
        ?bool $internal = NULL,
        ?bool $includeSelf = NULL
    ): ResponseInterface;

    /**
     * Get signatures associated with an account
     *
     * @return ResponseInterface
     */
    function getSignatures(): ResponseInterface;

    /**
     * Get version information
     *
     * @return ResponseInterface
     */
    function getVersionInfo(): ResponseInterface;

    /**
     * Get the anti-spam WhiteList and BlackList addresses
     *
     * @return ResponseInterface
     */
    function getWhiteBlackList(): ResponseInterface;

    /**
     * Grant account level rights
     *
     * @param  array $aces
     * @return ResponseInterface
     */
    function grantRights(array $aces = []): ResponseInterface;

    /**
     * Modify an Identity
     *
     * @param  Identity $identity
     * @return ResponseInterface
     */
    function modifyIdentity(Identity $identity): ResponseInterface;

    /**
     * Modify Preferences
     * Notes:
     * For multi-value prefs, just add the same attribute with 'n' different values
     * You can also add/subtract single values to/from a multi-value pref by prefixing
     * the preference name with a '+' or '-', respectively in the same way you do when using zmprov.
     *
     * @param  array $prefs
     * @return ResponseInterface
     */
    function modifyPrefs(array $prefs = []): ResponseInterface;

    /**
     * Modify properties related to zimlets
     *
     * @param  array $props
     * @return ResponseInterface
     */
    function modifyProperties(array $props = []): ResponseInterface;

    /**
     * Create a signature.
     * If an id is provided it will be honored as the id for the signature. 
     * CreateSignature will set account default signature to the signature being created
     * if there is currently no default signature for the account.
     * There can be at most one text/plain signatue and one text/html signature. 
     *
     * @param  Signature $signature
     * @return ResponseInterface
     */
    function modifySignature(Signature $signature): ResponseInterface;

    /**
     * Modify the anti-spam WhiteList and BlackList addresses
     *
     * @param  array $whiteListEntries
     * @param  array $blackListEntries
     * @return ResponseInterface
     */
    function modifyWhiteBlackList(
        array $whiteListEntries = [], array $blackListEntries = []
    ): ResponseInterface;

    /**
     * Modify zimlet preferences
     *
     * @param  array $zimlets
     * @return ResponseInterface
     */
    function modifyZimletPrefs(array $zimlets = []): ResponseInterface;

    /**
     * Reset password
     *
     * @param  string $password
     * @return ResponseInterface
     */
    function resetPassword(string $password): ResponseInterface;

    /**
     * Revoke OAuth consumer
     *
     * @param  string $accessToken
     * @return ResponseInterface
     */
    function revokeOAuthConsumer(string $accessToken): ResponseInterface;

    /**
     * Revoke account level rights
     *
     * @param  array $aces
     * @return ResponseInterface
     */
    function revokeRights(array $aces = []): ResponseInterface;

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
     * @return ResponseInterface
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
    ): ResponseInterface;

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
     * @return ResponseInterface
     */
    function searchGal(
        ?CursorInfo $cursor = NULL,
        ?EntrySearchFilterInfo $searchFilter = NULL,
        ?string $ref = NULL,
        ?string $name = NULL,
        GalSearchType $type = NULL,
        ?bool $needCanExpand = NULL,
        ?bool $needIsOwner = NULL,
        MemberOfSelector $needIsMember = NULL,
        ?bool $needSMIMECerts = NULL,
        ?string $galAccountId = NULL,
        ?bool $quick = NULL,
        ?string $sortBy = NULL,
        ?int $limit = NULL,
        ?int $offset = NULL,
        ?string $locale = NULL
    ): ResponseInterface;

    /**
     * Subscribe to or unsubscribe from a distribution list 
     *
     * @param  DistributionListSelector $dl
     * @param  DistributionListSubscribeOp $op
     * @return ResponseInterface
     */
    function subscribeDistributionList(
        DistributionListSelector $dl, DistributionListSubscribeOp $op
    ): ResponseInterface;

    /**
     * Synchronize with the Global Address List
     *
     * @param  string $token
     * @param  string $galAccountId
     * @param  bool $idOnly
     * @param  bool $getCount
     * @param  int $limit
     * @return ResponseInterface
     */
    function syncGal(
        ?string $token = NULL,
        ?string $galAccountId = NULL,
        ?bool $idOnly = NULL,
        ?bool $getCount = NULL,
        ?int $limit = NULL
    ): ResponseInterface;
}
