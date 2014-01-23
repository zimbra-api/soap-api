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
 * DataSourceType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class DataSourceType extends Base
{
    /**
     * Constant for value 'pop3'
     * @return string 'pop3'
     */
    const POP3 = 'pop3';

    /**
     * Constant for value 'imap'
     * @return string 'imap'
     */
    const IMAP = 'imap';

    /**
     * Constant for value 'caldav'
     * @return string 'caldav'
     */
    const CALDAV = 'caldav';

    /**
     * Constant for value 'contacts'
     * @return string 'contacts'
     */
    const CONTACTS = 'contacts';

    /**
     * Constant for value 'yab'
     * @return string 'yab'
     */
    const YAB = 'yab';

    /**
     * Constant for value 'rss'
     * @return string 'rss'
     */
    const RSS = 'rss';

    /**
     * Constant for value 'cal'
     * @return string 'cal'
     */
    const CAL = 'cal';

    /**
     * Constant for value 'gal'
     * @return string 'gal'
     */
    const GAL = 'gal';

    /**
     * Constant for value 'xsync'
     * @return string 'xsync'
     */
    const XSYNC = 'xsync';

    /**
     * Constant for value 'tagmap'
     * @return string 'tagmap'
     */
    const TAGMAP = 'tagmap';
}
