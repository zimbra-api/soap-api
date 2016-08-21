<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account;

use Zimbra\Soap\API;

use Zimbra\Enum\AccountBy;
use Zimbra\Enum\DistributionListBy as DistListBy;
use Zimbra\Enum\DistributionListSubscribeOp as SubscribeOp;
use Zimbra\Enum\GalSearchType as SearchType;
use Zimbra\Enum\MemberOfSelector as MemberOf;
use Zimbra\Enum\SortBy;

use Zimbra\Account\Struct\AuthAttrs;
use Zimbra\Account\Struct\AuthPrefs;
use Zimbra\Account\Struct\AuthToken;
use Zimbra\Account\Struct\BlackList;
use Zimbra\Account\Struct\DistributionListSelector as DLSelector;
use Zimbra\Account\Struct\DistributionListAction as DLAction;
use Zimbra\Account\Struct\Identity;
use Zimbra\Account\Struct\NameId;
use Zimbra\Account\Struct\PreAuth;
use Zimbra\Account\Struct\Signature;
use Zimbra\Account\Struct\WhiteList;
use Zimbra\Account\Struct\ZmgDeviceSpec;

use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\GranteeChooser;

/**
 * Base is a abstract class which allows to connect Zimbra API account functions via SOAP
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends API implements AccountInterface
{
    /**
     * Base constructor
     *
     * @param string $location The Zimbra api soap location.
     */
    public function __construct($location)
    {
        $this->setLocation($location);
    }

    /**
     * Authenticate for an account
     *
     * @param  AccountSelector $account Specifies the account to authenticate against
     * @param  string    $password Password to use in conjunction with an account
     * @param  PreAuth   $preauth The preauth
     * @param  AuthToken $authToken An authToken can be passed instead of account/password/preauth to validate an existing auth token.
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  AuthPrefs $prefs Preference
     * @param  AuthAttrs $attrs The attributes
     * @param  string    $requestedSkin The requestedSkin. If specified the name of the skin requested by the client.
     * @param  string    $twoFactorCode The TOTP code used for two-factor authentication
     * @param  string    $trustedDeviceToken Whether the client represents a trusted device
     * @param  string    $deviceId Unique device identifier; used to verify trusted mobile devices
     * @param  bool      $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @param  bool      $csrfTokenSecured Controls whether the client supports CSRF token.
     * @param  bool      $deviceTrusted Whether the client represents a trusted device
     * @param  bool      $generateDeviceId
     * @return authentication token
     */
    public function auth(
        AccountSelector $account = null,
        $password = null,
        PreAuth $preauth = null,
        AuthToken $authToken = null,
        $virtualHost = null,
        AuthPrefs $prefs = null,
        AuthAttrs $attrs = null,
        $requestedSkin = null,
        $twoFactorCode = null,
        $trustedDeviceToken = null,
        $deviceId = null,
        $persistAuthTokenCookie = null,
        $csrfTokenSecured = null,
        $deviceTrusted = null,
        $generateDeviceId = null
    )
    {
        $request = new \Zimbra\Account\Request\Auth(
            $account,
            $password,
            $preauth,
            $authToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            $twoFactorCode,
            $trustedDeviceToken,
            $deviceId,
            $persistAuthTokenCookie,
            $csrfTokenSecured,
            $deviceTrusted,
            $generateDeviceId
        );
        $result = $this->getClient()->doRequest($request);
        if(isset($result->authToken) && !empty($result->authToken))
        {
            $this->getClient()->setAuthToken($result->authToken);
        }
        elseif($authToken)
        {
            $this->getClient()->setAuthToken($authToken->getValue());
        }
        return $result;
    }

    /**
     * Authenticate for an account
     *
     * @param  AccountSelector $account  The user account.
     * @param  string $password The user password.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByAcount(
        AccountSelector $account,
        $password,
        $virtualHost = null
    )
    {
        return $this->auth($account, $password, null, null, $virtualHost);
    }

    /**
     * Authenticate for an account by token
     *
     * @param  AccountSelector $account The user account.
     * @param  AuthToken $token The authentication token.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByToken(
        AccountSelector $account,
        AuthToken $token,
        $virtualHost = null
    )
    {
        return $this->auth($account, null, null, $token, $virtualHost);
    }

    /**
     * Authenticate for an account by pre authentication key
     *
     * @param  string|AccountSelector $account The user account.
     * @param  string $key Pre authentication key
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByPre(
        AccountSelector $account,
        $key,
        $virtualHost = null
    )
    {
        $preAuth = new PreAuth(time() * 1000);
        $preAuth->computeValue($account, $key);

        return $this->auth($account, null, $preAuth, null, $virtualHost);
    }

    /**
     * Perform an autocomplete for a name against the Global Address List
     *
     * @param  string $name      The name to test for autocompletion
     * @param  bool   $needExp   Flag whether the {exp} flag is needed in the response for group entries.
     * @param  string $type      Type of addresses to auto-complete on
     * @param  string $galAcctId GAL Account ID
     * @param  int    $limit An  integer specifying the maximum number of results to return
     * @return mixed
     */
    public function autoCompleteGal(
        $name,
        $needExp = null,
        $type = null,
        $galAcctId = null,
        $limit = null
    )
    {
        $request = new \Zimbra\Account\Request\AutoCompleteGal(
            $name, $needExp, $type, $galAcctId, $limit
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Request is used by a mobile gateway app/client to bootstrap/initialize itself.
     *
     * @param  bool $wantAppToken Whether an "anticipatory app account" auth token is desiredentries.
     * @return mixed
     */
    public function bootstrapMobileGatewayApp($wantAppToken = null)
    {
        $request = new \Zimbra\Account\Request\BootstrapMobileGatewayApp(
            $wantAppToken
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create app specific password
     *
     * @param  bool $appName
     * @return mixed
     */
    public function createAppSpecificPassword($appName = null)
    {
        $request = new \Zimbra\Account\Request\CreateAppSpecificPassword(
            $appName
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Change password
     *
     * @param  AccountSelector $account     The user account.
     * @param  string  $oldPassword Old password
     * @param  string  $password    New Password to assign
     * @param  string  $virtualHost Virtual-host is used to determine the domain of the account name
     * @return mixed
     */
    public function changePassword(
        AccountSelector $account,
        $oldPassword,
        $password,
        $virtualHost = ''
    )
    {
        $request = new \Zimbra\Account\Request\ChangePassword(
            $account, $oldPassword, $password, $virtualHost
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets Array of CheckRightsTargetSpec.
     * @return mixed
     */
    public function checkRights(array $targets)
    {
        $request = new \Zimbra\Account\Request\CheckRights($targets);
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a Distribution List
     * Note: authed account must have the privilege to create dist lists in the domain
     *
     * @param  string $name Name for the new Distribution List
     * @param  bool   $dynamic Flag type of distribution list to create
     * @param  array  $attrs Attributes specified as key value pairs
     * @return mixed
     */
    public function createDistributionList(
        $name,
        $dynamic = null,
        array $attrs = []
    )
    {
        $request = new \Zimbra\Account\Request\CreateDistributionList(
            $name, $dynamic, $attrs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    public function createIdentity(Identity $identity)
    {
        $request = new \Zimbra\Account\Request\CreateIdentity(
            $identity
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Create a signature
     *
     * @param  Signature $signature Details of the signature to be created
     * @return mixed
     */
    public function createSignature(Signature $signature)
    {
        $request = new \Zimbra\Account\Request\CreateSignature(
            $signature
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Delete an Identity
     *
     * @param  NameId $identity Details of the identity to delete
     * @return mixed
     */
    public function deleteIdentity(NameId $identity)
    {
        $request = new \Zimbra\Account\Request\DeleteIdentity(
            $identity
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Delete a signature
     *
     * @param  NameId $signature Details of the signature to delete
     * @return mixed
     */
    public function deleteSignature(NameId $signature)
    {
        $request = new \Zimbra\Account\Request\DeleteSignature(
            $signature
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Disable two factor auth
     *
     * @return mixed
     */
    public function disableTwoFactorAuth()
    {
        $request = new \Zimbra\Account\Request\DisableTwoFactorAuth();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Return all targets of the specified rights applicable to the requested account
     *
     * @param  array $rights The rights.
     * @return mixed
     */
    public function discoverRights(array $rights)
    {
        $request = new \Zimbra\Account\Request\DiscoverRights(
            $rights
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Perform an action on a Distribution List 
     * Notes:
     *   1. Authorized account must be one of the list owners
     *   2. For owners/rights, only grants on the group itself will be modified,
     *      grants on domain and globalgrant (from which the right can be inherited) will not be touched.
     *      Only admins can modify grants on domains and globalgrant,
     *      owners of groups can only modify grants on the group entry.
     *
     * @param  DLSelector $dl Identifies the distribution list to act upon
     * @param  DLAction $action Specifies the action to perform
     * @param  array $attrs Attributes
     * @return mixed
     */
    public function distributionListAction(
        DLSelector $dl,
        DLAction $action,
        array $attrs = []
    )
    {
        $request = new \Zimbra\Account\Request\DistributionListAction(
            $dl, $action, $attrs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Enable two factor auth
     *
     * @param  string    $name  The name of the account for which to enable two-factor auth
     * @param  string    $password  Password to use in conjunction with an account
     * @param  AuthToken $authToken  Auth token issued during the first 2FA enablement step.
     * @param  bool      $csrfSupported  Whether the client supports the CSRF token.
     * @return mixed
     */
    public function enableTwoFactorAuth(
        $name,
        $password = null,
        AuthToken $authToken = null,
        $twoFactorCode = null,
        $csrfSupported = null
    )
    {
        $request = new \Zimbra\Account\Request\EnableTwoFactorAuth(
            $name,
            $password,
            $authToken,
            $twoFactorCode,
            $csrfSupported
        );
        $result = $this->getClient()->doRequest($request);
        if(isset($result->authToken) && !empty($result->authToken))
        {
            $this->getClient()->setAuthToken($result->authToken);
        }
        elseif($authToken)
        {
            $this->getClient()->setAuthToken($authToken->getValue());
        }
        return $result;
    }

    /**
     * End the current session, removing it from all caches.
     * Called when the browser app (or other session-using app) shuts down.
     * Has no effect if called in a <nosession> context.
     *
     * @param  bool $logoff Flag whether the exp flag is needed in the response for group entries.
     * @return mixed
     */
    public function endSession($logoff = null)
    {
        $request = new \Zimbra\Account\Request\EndSession($logoff);
        return $this->getClient()->doRequest($request);
    }

    /**
     * Generate scratch codes
     *
     * @return mixed
     */
    public function generateScratchCodes()
    {
        $request = new \Zimbra\Account\Request\GenerateScratchCodes();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns groups the user is either a member or an owner of.
     * Notes:
     *   1. isOwner is returned only if ownerOf on the request is 1 (true).
     *   2. For owners/rights, only grants on the group itself will be modified,
     * For example, if isOwner="1" and isMember="none" on the request,
     * and user is an owner and a member of a group,
     * the returned entry for the group will have isOwner="1",
     * but isMember will not be present.
     *
     * @param  bool   $ownerOf  Set to 1 if the response should include groups the user is an owner of. Set to 0 (default) if do not need to know which groups the user is an owner of.
     * @param  string $memberOf Possible values: all - need all groups the user is a direct or indirect member of. none - do not need groups the user is a member of. directOnly (default) - need groups the account is a direct member of.
     * @param  string $attrs    Comma-seperated attributes to return
     * @return mixed
     */
    public function getAccountDistributionLists(
        $ownerOf = null,
        $memberOf = null,
        $attrs = null
    )
    {
        $request = new \Zimbra\Account\Request\GetAccountDistributionLists(
            $ownerOf, $memberOf, $attrs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Information about an account
     *
     * @param  AccountSelector $account Use to identify the account
     * @return mixed
     */
    public function getAccountInfo(AccountSelector $account)
    {
        $request = new \Zimbra\Account\Request\GetAccountInfo(
            $account
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns all locales defined in the system
     *
     * @return mixed
     */
    public function getAllLocales()
    {
        $request = new \Zimbra\Account\Request\GetAllLocales();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get app specific passwords
     *
     * @return mixed
     */
    public function getAppSpecificPasswords()
    {
        $request = new \Zimbra\Account\Request\GetAppSpecificPasswords();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Returns the known CSV formats that can be used for import and export of addressbook.
     *
     * @return mixed
     */
    public function getAvailableCsvFormats()
    {
        $request = new \Zimbra\Account\Request\GetAvailableCsvFormats();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the intersection of all translated locales installed on the server
     * and the list specified in zimbraAvailableLocale
     * The locale list in the response is sorted by display name (name attribute).
     *
     * @return mixed
     */
    public function getAvailableLocales()
    {
        $request = new \Zimbra\Account\Request\GetAvailableLocales();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the intersection of installed skins on the server and the list specified
     * in the zimbraAvailableSkin on an account (or its CoS).
     * If none is set in zimbraAvailableSkin, get the entire list of installed skins.
     * The installed skin list is obtained by a directory scan of the designated location
     * of skins on a server.
     *
     * @return mixed
     */
    public function getAvailableSkins()
    {
        $request = new \Zimbra\Account\Request\GetAvailableSkins();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get a distribution list, optionally with ownership information an granted rights.
     *
     * @param  DLSelector   $dl Specify the distribution list
     * @param  bool   $needOwners Whether to return owners, default is 0 (i.e. Don't return owners)
     * @param  string $needRights Return grants for the specified (comma-seperated) rights. 
     * @param  array  $attrs Attributes of the distribution list
     * @return mixed
     */
    public function getDistributionList(
        DLSelector $dl,
        $needOwners = null,
        $needRights = null,
        array $attrs = []
    )
    {
        $request = new \Zimbra\Account\Request\GetDistributionList(
            $dl, $needOwners, $needRights, $attrs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the list of members of a distribution list.
     *
     * @param string $ld     The name of the distribution list
     * @param int    $limit  The number of members to return (0 is default and means all)
     * @param int    $offset The starting offset (0, 25, etc)
     * @return mixed
     */
    public function getDistributionListMembers($dl, $limit = null, $offset = null)
    {
        $request = new \Zimbra\Account\Request\GetDistributionListMembers(
            $dl, $limit, $offset
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get gcm sender id
     *
     * @return mixed
     */
    public function getGcmSenderId()
    {
        $request = new \Zimbra\Account\Request\GetGcmSenderId();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the identities for the authed account.
     *
     * @return mixed
     */
    public function getIdentities()
    {
        $request = new \Zimbra\Account\Request\GetIdentities();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get information about an account by sections.
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     *
     * @param  string $sections Comma separated list of sections to return information about.
     * @param  string $rights   Comma separated list of rights to return information about.
     * @return mixed
     */
    public function getInfo($sections = null, $rights = null)
    {
        $request = new \Zimbra\Account\Request\GetInfo(
            $sections, $rights
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get OAuth consumers
     *
     * @return mixed
     */
    public function getOAuthConsumers()
    {
        $request = new \Zimbra\Account\Request\GetOAuthConsumers();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get preferences for the authenticated account 
     *
     * @param  array $prefs Array of preferences. 
     * @return mixed
     */
    public function getPrefs(array $prefs = [])
    {
        $request = new \Zimbra\Account\Request\GetPrefs(
            $prefs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get account level rights. 
     *
     * @param  array $ace Specify Access Control Entries. 
     * @return mixed
     */
    public function getRights(array $ace = [])
    {
        $request = new \Zimbra\Account\Request\GetRights(
            $ace
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get OAuth consumers
     *
     * @return mixed
     */
    public function getScratchCodes()
    {
        $request = new \Zimbra\Account\Request\GetScratchCodes();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get information about published shares
     *
     * @param  GranteeChooser  $grantee Filter by the specified grantee type
     * @param  AccountSelector $owner   Specifies the owner of the share
     * @param  bool   $internal    Flags that have been proxied to this server because the specified "owner account" is homed here. Do not proxy in this case. (Used internally by ZCS)
     * @param  bool   $includeSelf Flag whether own shares should be included. 0 if shares owned by the requested account should not be included in the response. 1 (default) include shares owned by the requested account
     * @return mixed
     */
    public function getShareInfo(
        GranteeChooser $grantee = null,
        AccountSelector $owner = null,
        $internal = null,
        $includeSelf = null
    )
    {
        $request = new \Zimbra\Account\Request\GetShareInfo(
            $grantee, $owner, $internal, $includeSelf
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Signatures associated with an account
     *
     * @return mixed
     */
    public function getSignatures()
    {
        $request = new \Zimbra\Account\Request\GetSignatures();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get OAuth consumers
     *
     * @return mixed
     */
    public function getTrustedDevices()
    {
        $request = new \Zimbra\Account\Request\GetTrustedDevices();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get Signatures associated with an account
     * Note: This request will return a SOAP fault if the zimbraSoapExposeVersion
     *       server/globalconfig attribute is set to FALSE.
     *
     * @return mixed
     */
    public function getVersionInfo()
    {
        $request = new \Zimbra\Account\Request\GetVersionInfo();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Get the anti-spam WhiteList and BlackList addresses
     *
     * @return  mixed
     */
    public function getWhiteBlackList()
    {
        $request = new \Zimbra\Account\Request\GetWhiteBlackList();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Grant account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    public function grantRights(array $aces = [])
    {
        $request = new \Zimbra\Account\Request\GrantRights(
            $aces
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    public function modifyIdentity(Identity $identity)
    {
        $request = new \Zimbra\Account\Request\ModifyIdentity(
            $identity
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify preferences
     *
     * @param  array $pref Specify the preferences to be modified
     * @return mixed
     */
    public function modifyPrefs(array $pref = [])
    {
        $request = new \Zimbra\Account\Request\ModifyPrefs(
            $pref
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify properties related to zimlets
     *
     * @param  array $prop Specify the properties to be modified
     * @return mixed
     */
    public function modifyProperties(array $prop = [])
    {
        $request = new \Zimbra\Account\Request\ModifyProperties(
            $prop
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Change attributes of the given signature
     * Only the attributes specified in the request are modified.
     * Note: The Server identifies the signature by id,
     *       if the name attribute is present and is different from the current name of the signature,
     *       the signature will be renamed.
     *
     * @param  Signature $signature Specifies the changes to the signature
     * @return mixed
     */
    public function modifySignature(Signature $signature)
    {
        $request = new \Zimbra\Account\Request\ModifySignature(
            $signature
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify the anti-spam WhiteList and BlackList addresses
     * Note: If no <addr> is present in a list, it means to remove all addresses in the list. 
     *
     * @param  WhiteList $whiteList White list
     * @param  BlackList $blackList Black list
     * @return mixed
     */
    public function modifyWhiteBlackList(
        WhiteList $whiteList = null,
        BlackList $blackList = null
    )
    {
        $request = new \Zimbra\Account\Request\ModifyWhiteBlackList(
            $whiteList, $blackList
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Modify Zimlet Preferences
     *
     * @param  array $zimlet Zimlet Preference Specifications
     * @return mixed
     */
    public function modifyZimletPrefs(array $zimlet = [])
    {
        $request = new \Zimbra\Account\Request\ModifyZimletPrefs(
            $zimlet
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Registering app/device to receive push notifications 
     *
     * @param  ZmgDeviceSpec $zmgDevice Zmg device specification
     * @return mixed
     */
    public function registerMobileGatewayApp(ZmgDeviceSpec $zmgDevice)
    {
        $request = new \Zimbra\Account\Request\RegisterMobileGatewayApp(
            $zmgDevice
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * When the app auth token expires, the app can request a new auth token.
     *
     * @param  string $appId App ID
     * @param  string $appKey App secret key
     * @return mixed
     */
    public function renewMobileGatewayAppToken($appId, $appKey)
    {
        $request = new \Zimbra\Account\Request\RenewMobileGatewayAppToken(
            $appId, $appKey
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke app specific password
     *
     * @param  string $appName App name
     * @return mixed
     */
    public function revokeAppSpecificPassword($appName = null)
    {
        $request = new \Zimbra\Account\Request\RevokeAppSpecificPassword(
            $appName
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke OAuth consumer
     *
     * @param  string $accessToken access token
     * @return mixed
     */
    public function revokeOAuthConsumer($accessToken)
    {
        $request = new \Zimbra\Account\Request\RevokeOAuthConsumer(
            $accessToken
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke other trusted devices
     *
     * @return mixed
     */
    public function revokeOtherTrustedDevices()
    {
        $request = new \Zimbra\Account\Request\RevokeOtherTrustedDevices();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    public function revokeRights(array $ace = [])
    {
        $request = new \Zimbra\Account\Request\RevokeRights(
            $ace
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Revoke trusted device
     *
     * @return mixed
     */
    public function revokeTrustedDevice()
    {
        $request = new \Zimbra\Account\Request\RevokeTrustedDevice();
        return $this->getClient()->doRequest($request);
    }

    /**
     * Search Global Address List (GAL) for calendar resources
     * "attrs" attribute - comma-separated list of attrs to
     * return ("displayName", "zimbraId", "zimbraCalResType")
     *
     * @param string $locale    Client locale identification. 
     * @param CursorInfo $cursor Cursor specification
     * @param string $name      If specified, passed through to the GAL search as the search key
     * @param SearchFilter $searchFilter Search filter specification
     * @param bool   $quick     "Quick" flag. 
     * @param string $sortBy    Name of attribute to sort on. default is the calendar resource name.
     * @param int    $limit     An integer specifying the 0-based offset into the results list to return as the first result for this search operation
     * @param int    $offset    The 0-based offset into the results list to return as the first result for this search operation.
     * @param string $galAcctId GAL Account ID
     * @param string $attrs     Comma separated list of attributes
     * @return mixed
     */
    public function searchCalendarResources(
        $locale = null,
        CursorInfo $cursor = null,
        $name = null,
        SearchFilter $searchFilter = null,
        $quick = null,
        $sortBy = null,
        $limit = null,
        $offset = null,
        $galAcctId = null,
        $attrs = null
    )
    {
        $request = new \Zimbra\Account\Request\SearchCalendarResources(
            $locale, $cursor, $name, $searchFilter, $quick,
            $sortBy, $limit, $offset, $galAcctId, $attrs
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Search Global Address List (GAL)
     *
     * @param string $locale      Client locale identification. 
     * @param CursorInfo $cursor  Cursor specification
     * @param SearchFilter $searchFilter Search filter specification
     * @param string $ref         If set then search GAL by this ref, which is a dn. If specified then "name" attribute is ignored.
     * @param string $name        Query string. Note: ignored if {gal-search-ref-DN} is specified
     * @param SearchType $type        Type of addresses to auto-complete on
     * @param bool   $needExp     flag whether the {exp} flag is needed in the response for group entries. Default is unset.
     * @param bool   $needIsOwner Set this if the "isOwner" flag is needed in the response for group entries. Default is unset.
     * @param MemberOf $needIsMember Specify if the "isMember" flag is needed in the response for group entries.
     * @param bool   $needSMIMECerts Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     * @param string $galAcctId   GAL Account ID
     * @param bool   $quick       "Quick" flag.
     * @param string $sortBy      SortBy setting. Default value is "dateDesc"
     * @param int    $limit       The maximum number of results to return. It defaults to 10 if not specified, and is
     * @param int    $offset      Specifies the 0-based offset into the results list to return as the first result for this search operation. 
     * @return mixed
     */
    public function searchGal(
        $locale = null,
        CursorInfo $cursor = null,
        SearchFilter $searchFilter = null,
        $ref = null,
        $name = null,
        SearchType $type = null,
        $needExp = null,
        $needIsOwner = null,
        MemberOf $needIsMember = null,
        $needSMIMECerts = null,
        $galAcctId = null,
        $quick = null,
        SortBy $sortBy = null,
        $limit = null,
        $offset = null
    )
    {
        $request = new \Zimbra\Account\Request\SearchGal(
            $locale, $cursor, $searchFilter, $ref, $name, $type,
            $needExp, $needIsOwner, $needIsMember, $needSMIMECerts,
            $galAcctId, $quick, $sortBy, $limit, $offset
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Subscribe to a distribution list
     *
     * @param SubscribeOp $op
     * @param DLSelector $dl
     * @return mixed
     */
    public function subscribeDistributionList(SubscribeOp $op, DLSelector $dl)
    {
        $request = new \Zimbra\Account\Request\SubscribeDistributionList(
            $op, $dl
        );
        return $this->getClient()->doRequest($request);
    }

    /**
     * Synchronize with the Global Address List
     *
     * @param string $token     The previous synchronization token if applicable
     * @param string $galAcctId GAL sync account ID
     * @param bool   $idOnly    Flag whether only the ID attributes for matching contacts should be returned. 
     * @return mixed
     */
    public function syncGal($token = null, $galAcctId = null, $idOnly = null)
    {
        $request = new \Zimbra\Account\Request\SyncGal(
            $token, $galAcctId, $idOnly
        );
        return $this->getClient()->doRequest($request);
    }
}
