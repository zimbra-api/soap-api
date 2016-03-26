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

use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\CursorInfo;
use Zimbra\Struct\EntrySearchFilterInfo as SearchFilter;
use Zimbra\Struct\GranteeChooser;

/**
 * AccountInterface is a interface which allows to connect Zimbra API account functions via SOAP
 *
 * @package   Zimbra
 * @category  Account
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
interface AccountInterface
{
    /**
     * Authenticate for an account
     *
     * @param  AccountSelector   $account The user account.
     * @param  string    $password The user password.
     * @param  PreAuth   $key Pre authentication key
     * @param  AuthToken $token The authentication token.
     * @param  string    $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @param  AuthPrefs $prefs Preference.
     * @param  AuthAttrs $attrs The attributes.
     * @param  string    $requestedSkin If specified the name of the skin requested by the client.
     * @param  string    $persistAuthTokenCookie Controls whether the auth token cookie in the response should be persisted when the browser exits.
     * @return authentication token
     */
    function auth(
        AccountSelector $account = null,
        $password = null,
        PreAuth $preauth = null,
        AuthToken $authToken = null,
        $virtualHost = null,
        AuthPrefs $prefs = null,
        AuthAttrs $attrs = null,
        $requestedSkin = null,
        $persistAuthTokenCookie = null
    );

    /**
     * Authenticate for an account
     *
     * @param  AccountSelector $account  The user account.
     * @param  string $password    The user password.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    function authByAcount(
        AccountSelector $account,
        $password,
        $virtualHost = null
    );

    /**
     * Authenticate for an account by token
     *
     * @param  AccountSelector $account The user account.
     * @param  AuthToken $token The authentication token.
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    function authByToken(
        AccountSelector $account,
        AuthToken $token,
        $virtualHost = null
    );

    /**
     * Authenticate for an account by pre authentication key
     *
     * @param  AccountSelector $account The user account.
     * @param  string $key    Pre authentication key
     * @param  string $virtualHost If specified (in conjunction with by="name"), virtual-host is used to determine the domain of the account name, if it does not include a domain component.
     * @return authentication token
     */
    function authByPre(
        AccountSelector $account,
        $key,
        $virtualHost = null
    );

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
    function autoCompleteGal(
        $name,
        $needExp = null,
        $type = null,
        $galAcctId = null,
        $limit = null
    );

    /**
     * Change password
     *
     * @param  AccountSelector $account The user account.
     * @param  string $oldPassword Old password
     * @param  string $password    New Password to assign
     * @param  string $virtualHost Virtual-host is used to determine the domain of the account name
     * @return mixed
     */
    function changePassword(
        AccountSelector $account,
        $oldPassword,
        $password,
        $virtualHost = ''
    );

    /**
     * Check if the authed user has the specified right(s) on a target.
     *
     * @param  array $targets Array of CheckRightsTargetSpec.
     * @return mixed
     */
    function checkRights(array $targets);

    /**
     * Create a Distribution List
     * Note: authed account must have the privilege to create dist lists in the domain
     *
     * @param  string $name Name for the new Distribution List
     * @param  bool   $dynamic Flag type of distribution list to create
     * @param  array  $attrs Attributes specified as key value pairs
     * @return mixed
     */
    function createDistributionList(
        $name,
        $dynamic = null,
        array $attrs = []
    );

    /**
     * Create an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    function createIdentity(Identity $identity);

    /**
     * Create a signature
     *
     * @param  Signature $signature Details of the signature to be created
     * @return mixed
     */
    function createSignature(Signature $signature);

    /**
     * Delete an Identity
     *
     * @param  NameId $identity Details of the identity to delete
     * @return mixed
     */
    function deleteIdentity(NameId $identity);

    /**
     * Delete a signature
     *
     * @param  NameId $signature Details of the signature to delete
     * @return mixed
     */
    function deleteSignature(NameId $signature);

    /**
     * Return all targets of the specified rights applicable to the requested account
     *
     * @param  array $rights The rights.
     * @return mixed
     */
    function discoverRights(array $rights);

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
    function distributionListAction(
        DLSelector $dl,
        DLAction $action,
        array $attrs = []
    );

    /**
     * End the current session, removing it from all caches.
     * Called when the browser app (or other session-using app) shuts down.
     * Has no effect if called in a <nosession> context.
     *
     * @param  bool $logoff Flag whether the exp flag is needed in the response for group entries.
     * @return mixed
     */
    function endSession($logoff = null);

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
    function getAccountDistributionLists(
        $ownerOf = null,
        $memberOf = null,
        $attrs = null
    );

    /**
     * Get Information about an account
     *
     * @param  AccountSelector $account Use to identify the account
     * @return mixed
     */
    function getAccountInfo(AccountSelector $account);

    /**
     * Returns all locales defined in the system
     *
     * @return mixed
     */
    function getAllLocales();

    /**
     * Returns the known CSV formats that can be used for import and export of addressbook.
     *
     * @return mixed
     */
    function getAvailableCsvFormats();

    /**
     * Get the intersection of all translated locales installed on the server
     * and the list specified in zimbraAvailableLocale
     * The locale list in the response is sorted by display name (name attribute).
     *
     * @return mixed
     */
    function getAvailableLocales();

    /**
     * Get the intersection of installed skins on the server and the list specified
     * in the zimbraAvailableSkin on an account (or its CoS).
     * If none is set in zimbraAvailableSkin, get the entire list of installed skins.
     * The installed skin list is obtained by a directory scan of the designated location
     * of skins on a server.
     *
     * @return mixed
     */
    function getAvailableSkins();

    /**
     * Get a distribution list, optionally with ownership information an granted rights.
     *
     * @param  string|DLSelector   $dl Specify the distribution list
     * @param  bool   $needOwners Whether to return owners, default is 0 (i.e. Don't return owners)
     * @param  string $needRights Return grants for the specified (comma-seperated) rights. 
     * @param  array  $attrs Attributes of the distribution list
     * @return mixed
     */
    function getDistributionList(
        DLSelector $dl,
        $needOwners = null,
        $needRights = null,
        array $attrs = []
    );

    /**
     * Get the list of members of a distribution list.
     *
     * @param string $ld     The name of the distribution list
     * @param int    $limit  The number of members to return (0 is default and means all)
     * @param int    $offset The starting offset (0, 25, etc)
     * @return mixed
     */
    function getDistributionListMembers($dl, $limit = null, $offset = null);

    /**
     * Get the identities for the authed account.
     *
     * @return mixed
     */
    function getIdentities();

    /**
     * Get information about an account by sections.
     * Sections are: mbox,prefs,attrs,zimlets,props,idents,sigs,dsrcs,children
     *
     * @param  string $sections Comma separated list of sections to return information about.
     * @param  string $rights   Comma separated list of rights to return information about.
     * @return mixed
     */
    function getInfo($sections = null, $rights = null);

    /**
     * Get preferences for the authenticated account 
     *
     * @param  array $prefs Array of preferences. 
     * @return mixed
     */
    function getPrefs(array $prefs = []);

    /**
     * Get account level rights. 
     *
     * @param  array $ace Specify Access Control Entries. 
     * @return mixed
     */
    function getRights(array $ace = []);

    /**
     * Get information about published shares
     *
     * @param  GranteeChooser  $grantee  Filter by the specified grantee type
     * @param  AccountSelector $owner  Specifies the owner of the share
     * @param  bool   $internal    Flags that have been proxied to this server because the specified "owner account" is homed here. Do not proxy in this case. (Used internally by ZCS)
     * @param  bool   $includeSelf Flag whether own shares should be included. 0 if shares owned by the requested account should not be included in the response. 1 (default) include shares owned by the requested account
     * @return mixed
     */
    function getShareInfo(
        GranteeChooser $grantee = null,
        AccountSelector $owner = null,
        $internal = null,
        $includeSelf = null
    );

    /**
     * Get Signatures associated with an account
     *
     * @return mixed
     */
    function getSignatures();

    /**
     * Get Signatures associated with an account
     * Note: This request will return a SOAP fault if the zimbraSoapExposeVersion
     *       server/globalconfig attribute is set to FALSE.
     *
     * @return mixed
     */
    function getVersionInfo();

    /**
     * Get the anti-spam WhiteList and BlackList addresses
     *
     * @return  mixed
     */
    function getWhiteBlackList();

    /**
     * Grant account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    function grantRights(array $aces = []);

    /**
     * Modify an Identity
     *
     * @param  Identity $identity Specify identity to be modified Must specify either "name" or "id" attribute
     * @return mixed
     */
    function modifyIdentity(Identity $identity);

    /**
     * Modify preferences
     *
     * @param  array $pref Specify the preferences to be modified
     * @return mixed
     */
    function modifyPrefs(array $pref = []);

    /**
     * Modify properties related to zimlets
     *
     * @param  array $prop Specify the properties to be modified
     * @return mixed
     */
    function modifyProperties(array $prop = []);

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
    function modifySignature(Signature $signature);

    /**
     * Modify the anti-spam WhiteList and BlackList addresses
     * Note: If no <addr> is present in a list, it means to remove all addresses in the list. 
     *
     * @param  WhiteList $whiteList White list
     * @param  BlackList $blackList Black list
     * @return mixed
     */
    function modifyWhiteBlackList(
        WhiteList $whiteList = null,
        BlackList $blackList = null
    );

    /**
     * Modify Zimlet Preferences
     *
     * @param  array $zimlet Zimlet Preference Specifications
     * @return mixed
     */
    function modifyZimletPrefs(array $zimlet = []);

    /**
     * Revoke account level rights
     *
     * @param  array $ace Specify Access Control Entries
     * @return mixed
     */
    function revokeRights(array $ace = []);

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
    function searchCalendarResources(
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
    );

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
    function searchGal(
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
    );

    /**
     * Subscribe to a distribution list
     *
     * @param SubscribeOp $op
     * @param DLSelector $dl
     * @return mixed
     */
    function subscribeDistributionList(SubscribeOp $op, DLSelector $dl);

    /**
     * Synchronize with the Global Address List
     *
     * @param string $token     The previous synchronization token if applicable
     * @param string $galAcctId GAL sync account ID
     * @param bool   $idOnly    Flag whether only the ID attributes for matching contacts should be returned. 
     * @return mixed
     */
    function syncGal($token = null, $galAcctId = null, $idOnly = null);
}
