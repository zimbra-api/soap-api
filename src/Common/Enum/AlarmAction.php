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
 * AlarmAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class AlarmAction extends Enum
{
    /**
     * Constant for value 'DISPLAY'
     * @return string 'DISPLAY'
     */
    protected const DISPLAY = 'DISPLAY';

    /**
     * Constant for value 'AUDIO'
     * @return string 'AUDIO'
     */
    protected const AUDIO = 'AUDIO';

    /**
     * Constant for value 'EMAIL'
     * @return string 'EMAIL'
     */
    protected const EMAIL = 'EMAIL';

    /**
     * Constant for value 'PROCEDURE'
     * @return string 'PROCEDURE'
     */
    protected const PROCEDURE = 'PROCEDURE';

    /**
     * Constant for value 'X_YAHOO_CALENDAR_ACTION_IM'
     * @return string 'X_YAHOO_CALENDAR_ACTION_IM'
     */
    protected const YAHOO_IM = 'X_YAHOO_CALENDAR_ACTION_IM';

    /**
     * Constant for value 'X_YAHOO_CALENDAR_ACTION_MOBILE'
     * @return string 'X_YAHOO_CALENDAR_ACTION_MOBILE'
     */
    protected const YAHOO_MOBILE = 'X_YAHOO_CALENDAR_ACTION_MOBILE';
}
