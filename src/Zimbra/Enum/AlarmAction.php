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
 * AlarmAction enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class AlarmAction extends Base
{
    /**
     * Constant for value 'DISPLAY'
     * @return string 'DISPLAY'
     */
    const DISPLAY = 'DISPLAY';

    /**
     * Constant for value 'AUDIO'
     * @return string 'AUDIO'
     */
    const AUDIO = 'AUDIO';

    /**
     * Constant for value 'EMAIL'
     * @return string 'EMAIL'
     */
    const EMAIL = 'EMAIL';

    /**
     * Constant for value 'PROCEDURE'
     * @return string 'PROCEDURE'
     */
    const PROCEDURE = 'PROCEDURE';

    /**
     * Constant for value 'X_YAHOO_CALENDAR_ACTION_IM'
     * @return string 'X_YAHOO_CALENDAR_ACTION_IM'
     */
    const YAHOO_IM = 'X_YAHOO_CALENDAR_ACTION_IM';

    /**
     * Constant for value 'X_YAHOO_CALENDAR_ACTION_MOBILE'
     * @return string 'X_YAHOO_CALENDAR_ACTION_MOBILE'
     */
    const YAHOO_MOBILE = 'X_YAHOO_CALENDAR_ACTION_MOBILE';
}
