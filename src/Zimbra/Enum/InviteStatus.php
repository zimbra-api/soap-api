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
 * InviteStatus enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class InviteStatus extends Base
{
    /**
     * Constant for value 'Tentative'
     * @return string 'TENT'
     */
    const TENTATIVE = 'TENT';

    /**
     * Constant for value 'Confirmed'
     * @return string 'CONF'
     */
    const CONFIRMED = 'CONF';

    /**
     * Constant for value 'Cancelled'
     * @return string 'CANC'
     */
    const CANCELLED = 'CANC';

    /**
     * Constant for value 'Completed'
     * @return string 'COMP'
     */
    const COMPLETED = 'COMP';

    /**
     * Constant for value 'Inprogress'
     * @return string 'INPR'
     */
    const INPROGRESS = 'INPR';

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
