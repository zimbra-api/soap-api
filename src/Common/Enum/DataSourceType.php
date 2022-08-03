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
 * DataSourceType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DataSourceType extends Enum
{
    /**
     * Constant for value 'pop3'
     * @return string 'pop3'
     */
    protected const POP3 = 'pop3';

    /**
     * Constant for value 'imap'
     * @return string 'imap'
     */
    protected const IMAP = 'imap';

    /**
     * Constant for value 'caldav'
     * @return string 'caldav'
     */
    protected const CALDAV = 'caldav';

    /**
     * Constant for value 'contacts'
     * @return string 'contacts'
     */
    protected const CONTACTS = 'contacts';

    /**
     * Constant for value 'yab'
     * @return string 'yab'
     */
    protected const YAB = 'yab';

    /**
     * Constant for value 'rss'
     * @return string 'rss'
     */
    protected const RSS = 'rss';

    /**
     * Constant for value 'cal'
     * @return string 'cal'
     */
    protected const CAL = 'cal';

    /**
     * Constant for value 'gal'
     * @return string 'gal'
     */
    protected const GAL = 'gal';

    /**
     * Constant for value 'xsync'
     * @return string 'xsync'
     */
    protected const XSYNC = 'xsync';

    /**
     * Constant for value 'tagmap'
     * @return string 'tagmap'
     */
    protected const TAGMAP = 'tagmap';

    /**
     * Constant for value 'unknown'
     * @return string 'unknown'
     */
    protected const UNKNOWN = 'unknown';

    /**
     * Constant for value 'oauth2contact'
     * @return string 'oauth2contact'
     */
    protected const OAUTH2CONTACT = 'oauth2contact';

    /**
     * Constant for value 'oauth2calendar'
     * @return string 'oauth2calendar'
     */
    protected const OAUTH2CALENDAR = 'oauth2calendar';

    /**
     * Constant for value 'oauth2caldav'
     * @return string 'oauth2caldav'
     */
    protected const OAUTH2CALDAV = 'oauth2caldav';

    /**
     * Constant for value 'oauth2noop'
     * @return string 'oauth2noop'
     */
    protected const OAUTH2NOOP = 'oauth2noop';
}
