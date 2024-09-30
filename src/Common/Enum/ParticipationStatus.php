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
 * ParticipationStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class ParticipationStatus extends Enum
{
    /**
     * Constant for value 'Needs-action'
     * @return string 'NE'
     */
    protected const NEEDS_ACTION = "NE";

    /**
     * Constant for value 'Accept'
     * @return string 'AC'
     */
    protected const ACCEPT = "AC";

    /**
     * Constant for value 'Tentative'
     * @return string 'TE'
     */
    protected const TENTATIVE = "TE";

    /**
     * Constant for value 'Declined'
     * @return string 'DE'
     */
    protected const DECLINED = "DE";

    /**
     * Constant for value 'delegated'
     * @return string 'DG'
     */
    protected const DELEGATED = "DG";

    /**
     * Constant for value 'Completed'
     * @return string 'CO'
     */
    protected const COMPLETED = "CO";

    /**
     * Constant for value 'In-process'
     * @return string 'IN'
     */
    protected const IN_PROCESS = "IN";

    /**
     * Constant for value 'Waiting'
     * @return string 'WE'
     */
    protected const WAITING = "WE";

    /**
     * Constant for value 'Deferred'
     * @return string 'DF'
     */
    protected const DEFERRED = "DF";
}
