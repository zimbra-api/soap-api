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
 * InviteStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class InviteStatus extends Enum
{
    /**
     * Constant for value 'Tentative'
     * @return string 'TENT'
     */
    protected const TENTATIVE = "TENT";

    /**
     * Constant for value 'Confirmed'
     * @return string 'CONF'
     */
    protected const CONFIRMED = "CONF";

    /**
     * Constant for value 'Cancelled'
     * @return string 'CANC'
     */
    protected const CANCELLED = "CANC";

    /**
     * Constant for value 'Completed'
     * @return string 'COMP'
     */
    protected const COMPLETED = "COMP";

    /**
     * Constant for value 'Inprogress'
     * @return string 'INPR'
     */
    protected const INPROGRESS = "INPR";

    /**
     * Constant for value 'Waiting'
     * @return string 'WAITING'
     */
    protected const WAITING = "WAITING";

    /**
     * Constant for value 'Deferred'
     * @return string 'DEFERRED'
     */
    protected const DEFERRED = "DEFERRED";
}
