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
 * FreeBusyStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum FreeBusyStatus: string
{
    /**
     * Constant for value 'Free'
     * @return string 'F'
     */
    case FREE = "F";

    /**
     * Constant for value 'Busy'
     * @return string 'B'
     */
    case BUSY = "B";

    /**
     * Constant for value 'Busy-Tentative'
     * @return string 'T'
     */
    case TENTATIVE = "T";

    /**
     * Constant for value 'OutOfOffice' (busy-unavailable)
     * @return string 'O'
     */
    case OUT_OF_OFFICE = "O";
}
