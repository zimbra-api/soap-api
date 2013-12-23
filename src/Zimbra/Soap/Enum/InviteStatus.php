<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Soap\Enum;

/**
 * InviteStatus enum class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteStatus extends Base
{
    /**
     * Constant for value 'Tentative'
     * @return string 'TENT'
     */
    const TENT = 'TENT';

    /**
     * Constant for value 'Confirmed'
     * @return string 'CONF'
     */
    const CONF = 'CONF';

    /**
     * Constant for value 'Cancelled'
     * @return string 'CANC'
     */
    const CANC = 'CANC';

    /**
     * Constant for value 'Completed'
     * @return string 'COMP'
     */
    const COMP = 'COMP';

    /**
     * Constant for value 'Inprogress'
     * @return string 'INPR'
     */
    const INPR = 'INPR';

    /**
     * Constant for value 'Waiting'
     * @return string 'WAITING'
     */
    const WAITING = 'WAITING';

    /**
     * Constant for value 'Deferred'
     * @return string 'DEFERRED'
     */
    const DEFERRED = 'DEFERRED';
}
