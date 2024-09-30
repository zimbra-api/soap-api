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
 * EntryType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum EntryType: string
{
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
     * Constant for value 'distributionList'
     * @return string 'distributionList'
     */
    case DISTRIBUTION_LIST = "distributionList";

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    case COS = "cos";

    /**
     * Constant for value 'globalConfig'
     * @return string 'globalConfig'
     */
    case GLOBAL_CONFIG = "globalConfig";

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    case DOMAIN = "domain";

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    case SERVER = "server";

    /**
     * Constant for value 'mimeEntry'
     * @return string 'mimeEntry'
     */
    case MIME_ENTRY = "mimeEntry";

    /**
     * Constant for value 'zimletEntry'
     * @return string 'zimletEntry'
     */
    case ZIMLET_ENTRY = "zimletEntry";

    /**
     * Constant for value 'calendarResource'
     * @return string 'calendarResource'
     */
    case CALENDAR_RESOURCE = "calendarResource";

    /**
     * Constant for value 'identity'
     * @return string 'identity'
     */
    case IDENTITY = "identity";

    /**
     * Constant for value 'dataSource'
     * @return string 'dataSource'
     */
    case DATA_SOURCE = "dataSource";

    /**
     * Constant for value 'pop3DataSource'
     * @return string 'pop3DataSource'
     */
    case POP3_DATA_SOURCE = "pop3DataSource";

    /**
     * Constant for value 'imapDataSource'
     * @return string 'imapDataSource'
     */
    case IMAP_DATA_SOURCE = "imapDataSource";

    /**
     * Constant for value 'rssDataSource'
     * @return string 'rssDataSource'
     */
    case RSS_DATA_SOURCE = "rssDataSource";

    /**
     * Constant for value 'liveDataSource'
     * @return string 'liveDataSource'
     */
    case LIVE_DATA_SOURCE = "liveDataSource";

    /**
     * Constant for value 'galDataSource'
     * @return string 'galDataSource'
     */
    case GAL_DATA_SOURCE = "galDataSource";

    /**
     * Constant for value 'signature'
     * @return string 'signature'
     */
    case SIGNATURE = "signature";

    /**
     * Constant for value 'xmppComponent'
     * @return string 'xmppComponent'
     */
    case XMPP_COMPONENT = "xmppComponent";

    /**
     * Constant for value 'aclTarget'
     * @return string 'aclTarget'
     */
    case ACL_TARGET = "aclTarget";
}
