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
 * DataSourceType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class DataSourceType extends Enum
{
    /**
     * Constant for value 'pop3'
     * @return string 'pop3'
     */
    private const POP3 = 'pop3';

    /**
     * Constant for value 'imap'
     * @return string 'imap'
     */
    private const IMAP = 'imap';

    /**
     * Constant for value 'caldav'
     * @return string 'caldav'
     */
    private const CALDAV = 'caldav';

    /**
     * Constant for value 'contacts'
     * @return string 'contacts'
     */
    private const CONTACTS = 'contacts';

    /**
     * Constant for value 'yab'
     * @return string 'yab'
     */
    private const YAB = 'yab';

    /**
     * Constant for value 'rss'
     * @return string 'rss'
     */
    private const RSS = 'rss';

    /**
     * Constant for value 'cal'
     * @return string 'cal'
     */
    private const CAL = 'cal';

    /**
     * Constant for value 'gal'
     * @return string 'gal'
     */
    private const GAL = 'gal';

    /**
     * Constant for value 'xsync'
     * @return string 'xsync'
     */
    private const XSYNC = 'xsync';

    /**
     * Constant for value 'tagmap'
     * @return string 'tagmap'
     */
    private const TAGMAP = 'tagmap';
}
