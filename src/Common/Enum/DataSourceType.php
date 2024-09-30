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
 * DataSourceType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum DataSourceType: string
{
    /**
     * Constant for value 'pop3'
     * @return string 'pop3'
     */
    case POP3 = "pop3";

    /**
     * Constant for value 'imap'
     * @return string 'imap'
     */
    case IMAP = "imap";

    /**
     * Constant for value 'caldav'
     * @return string 'caldav'
     */
    case CALDAV = "caldav";

    /**
     * Constant for value 'contacts'
     * @return string 'contacts'
     */
    case CONTACTS = "contacts";

    /**
     * Constant for value 'yab'
     * @return string 'yab'
     */
    case YAB = "yab";

    /**
     * Constant for value 'rss'
     * @return string 'rss'
     */
    case RSS = "rss";

    /**
     * Constant for value 'cal'
     * @return string 'cal'
     */
    case CAL = "cal";

    /**
     * Constant for value 'gal'
     * @return string 'gal'
     */
    case GAL = "gal";

    /**
     * Constant for value 'xsync'
     * @return string 'xsync'
     */
    case XSYNC = "xsync";

    /**
     * Constant for value 'tagmap'
     * @return string 'tagmap'
     */
    case TAGMAP = "tagmap";

    /**
     * Constant for value 'unknown'
     * @return string 'unknown'
     */
    case UNKNOWN = "unknown";

    /**
     * Constant for value 'oauth2contact'
     * @return string 'oauth2contact'
     */
    case OAUTH2CONTACT = "oauth2contact";

    /**
     * Constant for value 'oauth2calendar'
     * @return string 'oauth2calendar'
     */
    case OAUTH2CALENDAR = "oauth2calendar";

    /**
     * Constant for value 'oauth2caldav'
     * @return string 'oauth2caldav'
     */
    case OAUTH2CALDAV = "oauth2caldav";

    /**
     * Constant for value 'oauth2noop'
     * @return string 'oauth2noop'
     */
    case OAUTH2NOOP = "oauth2noop";
}
