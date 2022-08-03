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

use MyCLabs\Enum\Enum;

/**
 * EntryType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class EntryType extends Enum
{
    /**
     * Constant for value 'account'
     * @return string 'account'
     */
    protected const ACCOUNT = 'account';

    /**
     * Constant for value 'alias'
     * @return string 'alias'
     */
    protected const ALIAS = 'alias';

    /**
     * Constant for value 'distributionList'
     * @return string 'distributionList'
     */
    protected const DISTRIBUTION_LIST = 'distributionList';

    /**
     * Constant for value 'cos'
     * @return string 'cos'
     */
    protected const COS = 'cos';

    /**
     * Constant for value 'globalConfig'
     * @return string 'globalConfig'
     */
    protected const GLOBAL_CONFIG = 'globalConfig';

    /**
     * Constant for value 'domain'
     * @return string 'domain'
     */
    protected const DOMAIN = 'domain';

    /**
     * Constant for value 'server'
     * @return string 'server'
     */
    protected const SERVER = 'server';

    /**
     * Constant for value 'mimeEntry'
     * @return string 'mimeEntry'
     */
    protected const MIME_ENTRY = 'mimeEntry';

    /**
     * Constant for value 'zimletEntry'
     * @return string 'zimletEntry'
     */
    protected const ZIMLET_ENTRY = 'zimletEntry';

    /**
     * Constant for value 'calendarResource'
     * @return string 'calendarResource'
     */
    protected const CALENDAR_RESOURCE = 'calendarResource';

    /**
     * Constant for value 'identity'
     * @return string 'identity'
     */
    protected const IDENTITY = 'identity';

    /**
     * Constant for value 'dataSource'
     * @return string 'dataSource'
     */
    protected const DATA_SOURCE = 'dataSource';

    /**
     * Constant for value 'pop3DataSource'
     * @return string 'pop3DataSource'
     */
    protected const POP3_DATA_SOURCE = 'pop3DataSource';

    /**
     * Constant for value 'imapDataSource'
     * @return string 'imapDataSource'
     */
    protected const IMAP_DATA_SOURCE = 'imapDataSource';

    /**
     * Constant for value 'rssDataSource'
     * @return string 'rssDataSource'
     */
    protected const RSS_DATA_SOURCE = 'rssDataSource';

    /**
     * Constant for value 'liveDataSource'
     * @return string 'liveDataSource'
     */
    protected const LIVE_DATA_SOURCE = 'liveDataSource';

    /**
     * Constant for value 'galDataSource'
     * @return string 'galDataSource'
     */
    protected const GAL_DATA_SOURCE = 'galDataSource';

    /**
     * Constant for value 'signature'
     * @return string 'signature'
     */
    protected const SIGNATURE = 'signature';

    /**
     * Constant for value 'xmppComponent'
     * @return string 'xmppComponent'
     */
    protected const XMPP_COMPONENT = 'xmppComponent';

    /**
     * Constant for value 'aclTarget'
     * @return string 'aclTarget'
     */
    protected const ACL_TARGET = 'aclTarget';
}
