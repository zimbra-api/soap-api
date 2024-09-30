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
 * ParticipationStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum ParticipationStatus: string
{
    /**
     * Constant for value 'Needs-action'
     * @return string 'NE'
     */
    case NEEDS_ACTION = "NE";

    /**
     * Constant for value 'Accept'
     * @return string 'AC'
     */
    case ACCEPT = "AC";

    /**
     * Constant for value 'Tentative'
     * @return string 'TE'
     */
    case TENTATIVE = "TE";

    /**
     * Constant for value 'Declined'
     * @return string 'DE'
     */
    case DECLINED = "DE";

    /**
     * Constant for value 'delegated'
     * @return string 'DG'
     */
    case DELEGATED = "DG";

    /**
     * Constant for value 'Completed'
     * @return string 'CO'
     */
    case COMPLETED = "CO";

    /**
     * Constant for value 'In-process'
     * @return string 'IN'
     */
    case IN_PROCESS = "IN";

    /**
     * Constant for value 'Waiting'
     * @return string 'WE'
     */
    case WAITING = "WE";

    /**
     * Constant for value 'Deferred'
     * @return string 'DF'
     */
    case DEFERRED = "DF";
}
