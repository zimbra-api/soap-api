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
 * ParticipationStatus enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ParticipationStatus extends Base
{
    /**
     * Constant for value 'Needs-action'
     * @return string 'NE'
     */
    const NEEDS_ACTION = 'NE';

    /**
     * Constant for value 'Accept'
     * @return string 'AC'
     */
    const ACCEPT = 'AC';

    /**
     * Constant for value 'Tentative'
     * @return string 'TE'
     */
    const TENTATIVE = 'TE';

    /**
     * Constant for value 'Declined'
     * @return string 'DE'
     */
    const DECLINED = 'DE';

    /**
     * Constant for value 'delegated'
     * @return string 'DG'
     */
    const DELEGATED = 'DG';

    /**
     * Constant for value 'Completed'
     * @return string 'CO'
     */
    const COMPLETED = 'CO';

    /**
     * Constant for value 'In-process'
     * @return string 'IN'
     */
    const IN_PROCESS = 'IN';

    /**
     * Constant for value 'Waiting'
     * @return string 'WE'
     */
    const WAITING = 'WE';

    /**
     * Constant for value 'Deferred'
     * @return string 'DF'
     */
    const DEFERRED = 'DF';
}
