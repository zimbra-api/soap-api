<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

/**
 * EntryType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class EntryType extends Base
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    const ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    const ALIAS = 'alias';

    /**
     * Constant for value 'distributionList'
     * @return string 'distributionList'
     */
    const DISTRIBUTION_LIST = 'distributionList';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    const COS = 'cos';

    /**
     * Constant for value 'globalConfig'
     * @return string 'globalConfig'
     */
    const GLOBAL_CONFIG = 'globalConfig';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    const SERVER = 'server';

    /**
     * Constant for value 'mimeEntry'
     * @return string 'mimeEntry'
     */
    const MIME_ENTRY = 'mimeEntry';

    /**
     * Constant for value 'zimletEntry'
     * @return string 'zimletEntry'
     */
    const ZIMLET_ENTRY = 'zimletEntry';

    /**
     * Constant for value 'calendarResource'
     * @return string 'calendarResource'
     */
    const CALENDAR_RESOURCE = 'calendarResource';

    /**
     * Constant for value 'identity'
     * @return string 'identity'
     */
    const IDENTITY = 'identity';

    /**
     * Constant for value 'dataSource'
     * @return string 'dataSource'
     */
    const DATA_SOURCE = 'dataSource';

    /**
     * Constant for value 'pop3DataSource'
     * @return string 'pop3DataSource'
     */
    const POP3_DATA_SOURCE = 'pop3DataSource';

    /**
     * Constant for value 'imapDataSource'
     * @return string 'imapDataSource'
     */
    const IMAP_DATA_SOURCE = 'imapDataSource';

    /**
     * Constant for value 'rssDataSource'
     * @return string 'rssDataSource'
     */
    const RSS_DATA_SOURCE = 'rssDataSource';

    /**
     * Constant for value 'liveDataSource'
     * @return string 'liveDataSource'
     */
    const LIVE_DATA_SOURCE = 'liveDataSource';

    /**
     * Constant for value 'galDataSource'
     * @return string 'galDataSource'
     */
    const GAL_DATA_SOURCE = 'galDataSource';

    /**
     * Constant for value 'signature'
     * @return string 'signature'
     */
    const SIGNATURE = 'signature';

    /**
     * Constant for value 'xmppComponent'
     * @return string 'xmppComponent'
     */
    const XMPP_COMPONENT = 'xmppComponent';

    /**
     * Constant for value 'aclTarget'
     * @return string 'aclTarget'
     */
    const ACL_TARGET = 'aclTarget';
}
