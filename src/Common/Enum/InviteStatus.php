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
 * InviteStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum InviteStatus: string
{
    /**
     * Constant for value 'Tentative'
     * @return string 'TENT'
     */
    case TENTATIVE = 'TENT';

    /**
     * Constant for value 'Confirmed'
     * @return string 'CONF'
     */
    case CONFIRMED = 'CONF';

    /**
     * Constant for value 'Cancelled'
     * @return string 'CANC'
     */
    case CANCELLED = 'CANC';

    /**
     * Constant for value 'Completed'
     * @return string 'COMP'
     */
    case COMPLETED = 'COMP';

    /**
     * Constant for value 'Inprogress'
     * @return string 'INPR'
     */
    case INPROGRESS = 'INPR';

    /**
     * Constant for value 'Waiting'
     * @return string 'WAITING'
     */
    case WAITING = 'WAITING';

    /**
     * Constant for value 'Deferred'
     * @return string 'DEFERRED'
     */
    case DEFERRED = 'DEFERRED';
}
