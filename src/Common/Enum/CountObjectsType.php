<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

/**
 * CountObjectsType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum CountObjectsType: string
{
    /**
     * Constant for value 'userAccount'
     * @return string 'userAccount'
     */
    case USER_ACCOUNT = "userAccount";

    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    case ACCOUNT = "account";

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    case ALIAS = "alias";

    /**
     * Constant for value 'dl'
     * @return string 'dl'
     */
    case DL = "dl";

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = "domain";

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = "cos";

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    case SERVER = "server";

    /**
     * Constant for value 'calresource'
     * @return string 'calresource'
     */
    case CALRESOURCE = "calresource";

    /**
     * Constant for value 'accountOnUCService'
     * @return string 'accountOnUCService'
     */
    case ACCOUNT_ON_UCSERVICE = "accountOnUCService";

    /**
     * Constant for value 'cosOnUCService'
     * @return string 'cosOnUCService'
     */
    case COS_ON_UCSERVICE = "cosOnUCService";

    /**
     * Constant for value 'domainOnUCService'
     * @return string 'domainOnUCService'
     */
    case DOMAIN_ON_UCSERVICE = "domainOnUCService";

    /**
     * Constant for value 'internalUserAccount'
     * @return string 'internalUserAccount'
     */
    case INTERNAL_USER_ACCOUNT = "internalUserAccount";

    /**
     * Constant for value 'internalArchivingAccount'
     * @return string 'internalArchivingAccount'
     */
    case INTERNAL_ARCHIVING_ACCOUNT = "internalArchivingAccount";

    /**
     * Constant for value 'internalUserAccountX'
     * @return string 'internalUserAccountX'
     */
    case INTERNAL_USER_ACCOUNT_X = "internalUserAccountX";

    /**
     * Constant for value 'internalUserAccountWithMobileSync'
     * @return string 'internalUserAccountWithMobileSync'
     */
    case INTERNAL_USER_ACCOUNT_WITH_MOBILE_SYNC = "internalUserAccountWithMobileSync";

    /**
     * Constant for value 'internalUserAccountWithSmime'
     * @return string 'internalUserAccountWithSmime'
     */
    case INTERNAL_USER_ACCOUNT_WITH_SMIME = "internalUserAccountWithSmime";

    /**
     * Constant for value 'internalUserAccountWithEws'
     * @return string 'internalUserAccountWithEws'
     */
    case INTERNAL_USER_ACCOUNT_WITH_EWS = "internalUserAccountWithEws";

    /**
     * Constant for value 'internalUserAccountWithZimlets'
     * @return string 'internalUserAccountWithZimlets'
     */
    case INTERNAL_USER_ACCOUNT_WITH_ZIMLETS = "internalUserAccountWithZimlets";

    /**
     * Constant for value 'internalUserAccountWithConversions'
     * @return string 'internalUserAccountWithConversions'
     */
    case INTERNAL_USER_ACCOUNT_WITH_CONVERSIONS = "internalUserAccountWithConversions";

    /**
     * Constant for value 'internalUserAccountWithTagging'
     * @return string 'internalUserAccountWithTagging'
     */
    case INTERNAL_USER_ACCOUNT_WITH_TAGGING = "internalUserAccountWithTagging";

    /**
     * Constant for value 'internalUserAccountWithCalendar'
     * @return string 'internalUserAccountWithCalendar'
     */
    case INTERNAL_USER_ACCOUNT_WITH_CALENDAR = "internalUserAccountWithCalendar";

    /**
     * Constant for value 'internalUserAccountWithGroupCalendar'
     * @return string 'internalUserAccountWithGroupCalendar'
     */
    case INTERNAL_USER_ACCOUNT_WITH_GROUP_CALENDAR = "internalUserAccountWithGroupCalendar";

    /**
     * Constant for value 'internalUserAccountWithTasks'
     * @return string 'internalUserAccountWithTasks'
     */
    case INTERNAL_USER_ACCOUNT_WITH_TASKS = "internalUserAccountWithTasks";

    /**
     * Constant for value 'internalUserAccountWithSharing'
     * @return string 'internalUserAccountWithSharing'
     */
    case INTERNAL_USER_ACCOUNT_WITH_SHARING = "internalUserAccountWithSharing";

    /**
     * Constant for value 'internalUserAccountWithBriefcases'
     * @return string 'internalUserAccountWithBriefcases'
     */
    case INTERNAL_USER_ACCOUNT_WITH_BRIEFCASES = "internalUserAccountWithBriefcases";

    /**
     * Constant for value 'internalUserAccountWithViewInHtml'
     * @return string 'internalUserAccountWithViewInHtml'
     */
    case INTERNAL_USER_ACCOUNT_WITH_VIEW_IN_HTML = "internalUserAccountWithViewInHtml";

    /**
     * Constant for value 'internalUserAccountWithChatAll'
     * @return string 'internalUserAccountWithChatAll'
     */
    case INTERNAL_USER_ACCOUNT_WITH_CHAT_ALL = "internalUserAccountWithChatAll";

    /**
     * Constant for value 'internalUserAccountWithVideoAll'
     * @return string 'internalUserAccountWithVideoAll'
     */
    case INTERNAL_USER_ACCOUNT_WITH_VIDEO_ALL = "internalUserAccountWithVideoAll";

    /**
     * Constant for value 'internalUserAccountWithDocumentEditing'
     * @return string 'internalUserAccountWithDocumentEditing'
     */
    case INTERNAL_USER_ACCOUNT_WITH_DOCUMENT_EDITING = "internalUserAccountWithDocumentEditing";

    /**
     * Constant for value 'internalUserAccountsByCosesWithLdapFeature'
     * @return string 'internalUserAccountsByCosesWithLdapFeature'
     */
    case INTERNAL_USER_ACCOUNTS_BY_COSES_WITH_LDAP_FEATURE = "internalUserAccountsByCosesWithLdapFeature";

    /**
     * Constant for value 'internalUserAccountsByCosWithLdapFeature'
     * @return string 'internalUserAccountsByCosWithLdapFeature'
     */
    case INTERNAL_USER_ACCOUNTS_BY_COS_WITH_LDAP_FEATURE = "internalUserAccountsByCosWithLdapFeature";

    /**
     * Constant for value 'internalUserAccountsWithLdapFeatureCheck'
     * @return string 'internalUserAccountsWithLdapFeatureCheck'
     */
    case INTERNAL_USER_ACCOUNTS_WITH_LDAP_FEATURE_CHECK = "internalUserAccountsWithLdapFeatureCheck";
}
