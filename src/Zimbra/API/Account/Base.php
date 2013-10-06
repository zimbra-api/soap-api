<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Account;

use Zimbra\API\Account;
use Zimbra\API\Account\Request\Auth;
use Zimbra\API\Account\Request\AutoCompleteGal;
use Zimbra\API\Account\Request\ChangePassword;
use Zimbra\API\Account\Request\CheckRights;
use Zimbra\API\Account\Request\CreateDistributionList;
use Zimbra\API\Account\Request\CreateIdentity;
use Zimbra\API\Account\Request\CreateSignature;
use Zimbra\API\Account\Request\DeleteIdentity;
use Zimbra\API\Account\Request\DeleteSignature;
use Zimbra\API\Account\Request\DiscoverRights;
use Zimbra\API\Account\Request\DistributionListAction;
use Zimbra\API\Account\Request\EndSession;
use Zimbra\API\Account\Request\GetAccountDistributionLists;
use Zimbra\API\Account\Request\GetAccountInfo;
use Zimbra\API\Account\Request\GetAllLocales;
use Zimbra\API\Account\Request\GetAvailableCsvFormats;
use Zimbra\API\Account\Request\GetAvailableLocales;
use Zimbra\API\Account\Request\GetAvailableSkins;
use Zimbra\API\Account\Request\GetDistributionList;
use Zimbra\API\Account\Request\GetDistributionListMembers;
use Zimbra\API\Account\Request\GetIdentities;
use Zimbra\API\Account\Request\GetInfo;
use Zimbra\API\Account\Request\GetPrefs;
use Zimbra\API\Account\Request\GetRights;
use Zimbra\API\Account\Request\GetShareInfo;
use Zimbra\API\Account\Request\GetSignatures;
use Zimbra\API\Account\Request\GetVersionInfo;
use Zimbra\API\Account\Request\GetWhiteBlackList;
use Zimbra\API\Account\Request\GrantRights;
use Zimbra\API\Account\Request\ModifyIdentity;
use Zimbra\API\Account\Request\ModifyPrefs;
use Zimbra\API\Account\Request\ModifyProperties;
use Zimbra\API\Account\Request\ModifySignature;
use Zimbra\API\Account\Request\ModifyWhiteBlackList;
use Zimbra\API\Account\Request\ModifyZimletPrefs;
use Zimbra\API\Account\Request\RevokeRights;
use Zimbra\API\Account\Request\SearchCalendarResources;
use Zimbra\API\Account\Request\SearchGal;
use Zimbra\API\Account\Request\SubscribeDistributionList;
use Zimbra\API\Account\Request\SyncGal;

use Zimbra\Soap\Enum\AccountBy;
use Zimbra\Soap\Enum\DistListBy;
use Zimbra\Soap\Struct\AccountSelector;
use Zimbra\Soap\Struct\AuthToken;
use Zimbra\Soap\Struct\CursorInfo;
use Zimbra\Soap\Struct\DistListSelector;
use Zimbra\Soap\Struct\DistListAction;
use Zimbra\Soap\Struct\EntrySearchFilterInfo;
use Zimbra\Soap\Struct\GranteeChooser;
use Zimbra\Soap\Struct\Identity;
use Zimbra\Soap\Struct\NameId;
use Zimbra\Soap\Struct\PreAuth;
use Zimbra\Soap\Struct\Signature;

/**
 * Base is a abstract class which allows to connect Zimbra API account functions via SOAP
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
abstract class Base extends Account implements AccountInterface
{
    /**
     * Base constructor
     *
     * @param string $location The Zimbra api soap location.
     */
    public function __construct($location)
    {
        $this->_location = $location;
        $this->_namespace = 'urn:zimbraAccount';
    }

    /**
     * Authenticate for an account
     *
     * @param  string|AccountSelector   $account The user account.
     * @param  string    $password The user password.
     * @param  PreAuth   $key Pre authentication key
     * @param  AuthToken $token The authentication token.
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  array     $prefs Preference.
     * @param  array     $attrs The attributes.
     * @param  string    $requestedSkin If specified the name of the skin requested by the client.
     * @param  string    $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @return authentication token
     */
    public function auth(
        AccountSelector $account = null,
        $password = null,
        PreAuth $preauth = null,
        AuthToken $authToken = null,
        $virtualHost = null,
        array $prefs = array(),
        array $attrs = array(),
        $requestedSkin = null,
        $persistAuthTokenCookie = null
    )
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
        $request = new Auth(
            $account,
            $password,
            $preauth,
            $authToken,
            $virtualHost,
            $prefs,
            $attrs,
            $requestedSkin,
            $persistAuthTokenCookie
        );
        $result = $this->_client->doRequest($request);
        $authToken = $result->authToken;
        if($authToken) $this->_client->authToken($authToken);
        return $result;
    }

    /**
     * Authenticate for an account
     *
     * @param  string|AccountSelector $account  The user account.
     * @param  string $password    The user password.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByAcount($account, $password, $virtualHost = null)
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
        return $this->auth($account, $password, null, null, $virtualHost);
    }

    /**
     * Authenticate for an account by token
     *
     * @param  string|AccountSelector $account The user account.
     * @param  string|AuthToken    $token The authentication token.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByToken($account, $token, $virtualHost = null)
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
        if(!($token instanceof AuthToken))
        {
            $token = new AuthToken((string) $token, TRUE);
        }
        return $this->auth($account, null, null, $token, $virtualHost);
    }

    /**
     * Authenticate for an account by pre authentication key
     *
     * @param  string|AccountSelector $account The user account.
     * @param  string $key         Pre authentication key
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    public function authByPre($account, $key, $virtualHost = null)
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
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
    public function autoCompleteGal($name, $needExp = null, $type = null, $galAcctId = null, $limit = null)
    {
        $request = new AutoCompleteGal($name, $needExp, $type, $galAcctId, $limit);
        return $this->_client->doRequest($request);
    }

    /**
     * Change password
     *
     * @param  string|AccountSelector $account The user account.
     * @param  string $oldPassword Old password
     * @param  string $password    New Password to assign
     * @param  string $virtualHost Virtual-host is used to determine the domain of the account name
     * @return mixed
     */
    public function changePassword($account, $oldPassword, $password, $virtualHost = '')
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
        $request = new ChangePassword($account, $oldPassword, $password, $virtualHost);
        return $this->_client->doRequest($request);
    }

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets Array of CheckRightsTargetSpec.
     * @return mixed
     */
    public function checkRights(array $targets)
    {
        return $this->_client->doRequest(new CheckRights($targets));
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
    public function createDistributionList($name, $dynamic = null, array $attrs = array())
    {
        $request = new CreateDistributionList($name, $dynamic, $attrs);
        return $this->_client->doRequest($request);
    }

    /**
     * Create an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    public function createIdentity(Identity $identity)
    {
        return $this->_client->doRequest(new CreateIdentity($identity));
    }

    /**
     * Create a signature
     *
     * @param  Signature $signature Details of the signature to be created
     * @return mixed
     */
    public function createSignature(Signature $signature)
    {
        return $this->_client->doRequest(new CreateSignature($signature));
    }

    /**
     * Delete an Identity
     *
     * @param  NameId $identity Details of the identity to delete
     * @return mixed
     */
    public function deleteIdentity(NameId $identity)
    {
        return $this->_client->doRequest(new DeleteIdentity($identity));
    }

    /**
     * Delete a signature
     *
     * @param  NameId $signature Details of the signature to delete
     * @return mixed
     */
    public function deleteSignature(NameId $signature)
    {
        return $this->_client->doRequest(new DeleteSignature($signature));
    }

    /**
     * Return all targets of the specified rights applicable to the requested account
     *
     * @param  array $rights The rights.
     * @return mixed
     */
    public function discoverRights(array $rights)
    {
        return $this->_client->doRequest(new DiscoverRights($rights));
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
     * @param  string|DistListSelector $dl Identifies the distribution list to act upon
     * @param  DistListAction $action Specifies the action to perform
     * @param  array $attrs Attributes
     * @return mixed
     */
    public function distributionListAction($dl, DistListAction $action, array $attrs = array())
    {
        if(!($dl instanceof DistListSelector))
        {
            $dl = new DistListSelector(DistListBy::NAME, (string) $dl);
        }
        $request = new DistributionListAction($dl, $action, $attrs);
        return $this->_client->doRequest($request);
    }

    /**
     * End the current session, removing it from all caches.
     * Called when the browser app (or other session-using app) shuts down.
     * Has no effect if called in a <nosession> context.
     *
     * @return mixed
     */
    public function endSession()
    {
        return $this->_client->doRequest(new EndSession);
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
    public function getAccountDistributionLists($ownerOf = null, $memberOf = null, $attrs = null)
    {
        $request = new GetAccountDistributionLists($ownerOf, $memberOf, $attrs);
        return $this->_client->doRequest($request);
    }

    /**
     * Get Information about an account
     *
     * @param  string|AccountSelector $account Use to identify the account
     * @return mixed
     */
    public function getAccountInfo($account)
    {
        if(!($account instanceof AccountSelector))
        {
            $account = new AccountSelector(AccountBy::NAME, (string) $account);
        }
        return $this->_client->doRequest(new GetAccountInfo($account));
    }

    /**
     * Returns all locales defined in the system
     *
     * @return mixed
     */
    public function getAllLocales()
    {
        return $this->_client->doRequest(new GetAllLocales);
    }

    /**
     * Returns the known CSV formats that can be used for import and export of addressbook.
     *
     * @return mixed
     */
    public function getAvailableCsvFormats()
    {
        return $this->_client->doRequest(new GetAvailableCsvFormats);
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
        return $this->_client->doRequest(new GetAvailableLocales);
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
        return $this->_client->doRequest(new GetAvailableSkins);
    }

    /**
     * Get a distribution list, optionally with ownership information an granted rights.
     *
     * @param  string|DistListSelector   $dl Specify the distribution list
     * @param  bool   $needOwners Whether to return owners, default is 0 (i.e. Don't return owners)
     * @param  string $needRights Return grants for the specified (comma-seperated) rights. 
     * @param  array  $attrs Attributes of the distribution list
     * @return mixed
     */
    public function getDistributionList($dl, $needOwners = null, $needRights = null, array $attrs = array())
    {
        if(!($dl instanceof DistListSelector))
        {
            $dl = new DistListSelector(DistListBy::NAME, (string) $dl);
        }
        $request = new GetDistributionList($dl, $needOwners, $needRights, $attrs);
        return $this->_client->doRequest($request);
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
        $request = new GetDistributionListMembers($dl, $limit, $offset);
        return $this->_client->doRequest($request);
    }

    /**
     * Get the identities for the authed account.
     *
     * @param array $identities array of Identity
     * @return mixed
     */
    public function getIdentities(array $identities = array())
    {
        return $this->_client->doRequest(new GetIdentities($identities));
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
        $request = new GetInfo($sections, $rights);
        return $this->_client->doRequest($request);
    }

    /**
     * Get preferences for the authenticated account 
     *
     * @param  array $prefs Array of preferences. 
     * @return mixed
     */
    public function getPrefs(array $prefs = array())
    {
        return $this->_client->doRequest(new GetPrefs($prefs));
    }

    /**
     * Get account level rights. 
     *
     * @param  array $rights Specify Access Control Entries. 
     * @return mixed
     */
    public function getRights(array $rights = array())
    {
        return $this->_client->doRequest(new GetRights($rights));
    }

    /**
     * Get information about published shares
     *
     * @param  GranteeChooser $grantee Filter by the specified grantee type
     * @param  string|AccountSelector $owner  Specifies the owner of the share
     * @param  bool   $internal    Flags that have been proxied to this server because the specified "owner account" is homed here. Do not proxy in this case. (Used internally by ZCS)
     * @param  bool   $includeSelf Flag whether own shares should be included. 0 if shares owned by the requested account should not be included in the response. 1 (default) include shares owned by the requested account
     * @return mixed
     */
    public function getShareInfo(GranteeChooser $grantee = null, $owner = null, $internal = null, $includeSelf = null)
    {
        if(!($owner instanceof AccountSelector))
        {
            $owner = new AccountSelector(AccountBy::NAME, (string) $owner);
        }
        $request = new GetShareInfo($grantee, $owner, $internal, $includeSelf);
        return $this->_client->doRequest($request);
    }

    /**
     * Get Signatures associated with an account
     *
     * @return mixed
     */
    public function getSignatures()
    {
        return $this->_client->doRequest(new GetSignatures);
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
        return $this->_client->doRequest(new GetVersionInfo);
    }

    /**
     * Get the anti-spam WhiteList and BlackList addresses
     *
     * @return  mixed
     */
    public function getWhiteBlackList()
    {
        return $this->_client->doRequest(new GetWhiteBlackList);
    }

    /**
     * Grant account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    public function grantRights(array $aces = array())
    {
        return $this->_client->doRequest(new GrantRights($aces));
    }

    /**
     * Modify an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    public function modifyIdentity(Identity $identity)
    {
        return $this->_client->doRequest(new ModifyIdentity($identity));
    }

    /**
     * Modify preferences
     *
     * @param  array $prefs Specify the preferences to be modified
     * @return mixed
     */
    public function modifyPrefs(array $prefs = array())
    {
        return $this->_client->doRequest(new ModifyPrefs($prefs));
    }

    /**
     * Modify properties related to zimlets
     *
     * @param  array $props Specify the preferences to be modified
     * @return mixed
     */
    public function modifyProperties(array $props = array())
    {
        return $this->_client->doRequest(new ModifyProperties($props));
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
        return $this->_client->doRequest(new ModifySignature($signature));
    }

    /**
     * Modify the anti-spam WhiteList and BlackList addresses
     * Note: If no <addr> is present in a list, it means to remove all addresses in the list. 
     *
     * @param  array $whiteList White list
     * @param  array $blackList Black list
     * @return mixed
     */
    public function modifyWhiteBlackList(array $whiteList, array $blackList = array())
    {
        $request = new ModifyWhiteBlackList($whiteList, $blackList);
        return $this->_client->doRequest($request);
    }

    /**
     * Modify Zimlet Preferences
     *
     * @param  array $zimlets Zimlet Preference Specifications
     * @return mixed
     */
    public function modifyZimletPrefs(array $zimlets = array())
    {
        return $this->_client->doRequest(new ModifyZimletPrefs($zimlets));
    }

    /**
     * Revoke account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    function revokeRights(array $aces = array())
    {
        return $this->_client->doRequest(new RevokeRights($aces));
    }

    /**
     * Search Global Address List (GAL) for calendar resources
     * "attrs" attribute - comma-separated list of attrs to
     * return ("displayName", "zimbraId", "zimbraCalResType")
     *
     * @param CursorInfo $cursor Cursor specification
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param string $name      If specified, passed through to the GAL search as the search key
     * @param string $locale    Client locale identification. 
     * @param bool   $quick     "Quick" flag. 
     * @param string $sortBy    Name of attribute to sort on. default is the calendar resource name.
     * @param int    $limit     An integer specifying the 0-based offset into the results list to return as the first result for this search operation
     * @param int    $offset    The 0-based offset into the results list to return as the first result for this search operation.
     * @param string $galAcctId GAL Account ID
     * @param string $attrs     Comma separated list of attributes
     * @return mixed
     */
    public function searchCalendarResources(CursorInfo $cursor = null, EntrySearchFilterInfo $searchFilter = null, $name = null, $locale = null, $quick = null, $sortBy = null, $limit = null, $offset = null, $galAcctId = null, $attrs = null)
    {
        $request = new SearchCalendarResources($cursor, $searchFilter, $name, $locale, $quick, $sortBy, $limit, $offset, $galAcctId, $attrs);
        return $this->_client->doRequest($request);
    }

    /**
     * Search Global Address List (GAL)
     *
     * @param CursorInfo $cursor  Cursor specification
     * @param EntrySearchFilterInfo $searchFilter Search filter specification
     * @param string $locale      Client locale identification. 
     * @param string $ref         If set then search GAL by this ref, which is a dn. If specified then "name" attribute is ignored.
     * @param string $name        Query string. Note: ignored if {gal-search-ref-DN} is specified
     * @param string $type        Type of addresses to auto-complete on
     * @param bool   $needExp     flag whether the {exp} flag is needed in the response for group entries. Default is unset.
     * @param bool   $needIsOwner Set this if the "isOwner" flag is needed in the response for group entries. Default is unset.
     * @param string $needIsMember Specify if the "isMember" flag is needed in the response for group entries.
     * @param bool   $needSMIMECerts Internal attr, for proxied GSA search from GetSMIMEPublicCerts only
     * @param string $galAcctId   GAL Account ID
     * @param bool   $quick       "Quick" flag.
     * @param string $sortBy      SortBy setting. Default value is "dateDesc"
     * @param int    $limit       The maximum number of results to return. It defaults to 10 if not specified, and is
     * @param int    $offset      Specifies the 0-based offset into the results list to return as the first result for this search operation. 
     * @return mixed
     */
    public function searchGal(CursorInfo $cursor = null, EntrySearchFilterInfo $searchFilter = null, $locale = null, $ref = null, $name = null, $type = null, $needExp = null, $needIsOwner = null, $needIsMember = null, $needSMIMECerts = null, $galAcctId = null, $quick = null, $sortBy = null, $limit = null, $offset = null)
    {
        $request = new SearchGal($cursor, $searchFilter, $locale, $ref, $name, $type, $needExp, $needIsOwner, $needIsMember, $needSMIMECerts, $galAcctId, $quick, $sortBy, $limit, $offset);
        return $this->_client->doRequest($request);
    }

    /**
     * Subscribe to a distribution list
     *
     * @param string $op
     * @param string|DistListSelector $dl
     * @return mixed
     */
    public function subscribeDistributionList($op, $dl)
    {
        if(!($dl instanceof DistListSelector))
        {
            $dl = new DistListSelector(DistListBy::NAME, (string) $dl);
        }
        $request = new SubscribeDistributionList($op, $dl);
        return $this->_client->doRequest($request);
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
        $request = new SyncGal($token, $galAcctId, $idOnly);
        return $this->_client->doRequest($request);
    }
}
