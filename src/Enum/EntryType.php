<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * EntryType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class EntryType extends Enum
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    private const ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    private const ALIAS = 'alias';

    /**
     * Constant for value 'distributionList'
     * @return string 'distributionList'
     */
    private const DISTRIBUTION_LIST = 'distributionList';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    private const COS = 'cos';

    /**
     * Constant for value 'globalConfig'
     * @return string 'globalConfig'
     */
    private const GLOBAL_CONFIG = 'globalConfig';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    private const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    private const SERVER = 'server';

    /**
     * Constant for value 'mimeEntry'
     * @return string 'mimeEntry'
     */
    private const MIME_ENTRY = 'mimeEntry';

    /**
     * Constant for value 'zimletEntry'
     * @return string 'zimletEntry'
     */
    private const ZIMLET_ENTRY = 'zimletEntry';

    /**
     * Constant for value 'calendarResource'
     * @return string 'calendarResource'
     */
    private const CALENDAR_RESOURCE = 'calendarResource';

    /**
     * Constant for value 'identity'
     * @return string 'identity'
     */
    private const IDENTITY = 'identity';

    /**
     * Constant for value 'dataSource'
     * @return string 'dataSource'
     */
    private const DATA_SOURCE = 'dataSource';

    /**
     * Constant for value 'pop3DataSource'
     * @return string 'pop3DataSource'
     */
    private const POP3_DATA_SOURCE = 'pop3DataSource';

    /**
     * Constant for value 'imapDataSource'
     * @return string 'imapDataSource'
     */
    private const IMAP_DATA_SOURCE = 'imapDataSource';

    /**
     * Constant for value 'rssDataSource'
     * @return string 'rssDataSource'
     */
    private const RSS_DATA_SOURCE = 'rssDataSource';

    /**
     * Constant for value 'liveDataSource'
     * @return string 'liveDataSource'
     */
    private const LIVE_DATA_SOURCE = 'liveDataSource';

    /**
     * Constant for value 'galDataSource'
     * @return string 'galDataSource'
     */
    private const GAL_DATA_SOURCE = 'galDataSource';

    /**
     * Constant for value 'signature'
     * @return string 'signature'
     */
    private const SIGNATURE = 'signature';

    /**
     * Constant for value 'xmppComponent'
     * @return string 'xmppComponent'
     */
    private const XMPP_COMPONENT = 'xmppComponent';

    /**
     * Constant for value 'aclTarget'
     * @return string 'aclTarget'
     */
    private const ACL_TARGET = 'aclTarget';
}
