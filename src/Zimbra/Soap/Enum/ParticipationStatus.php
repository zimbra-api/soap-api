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
 * ParticipationStatus enum class
 * @package   Zimbra
 * @category  Soap
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ParticipationStatus extends Base
{
    /**
     * Constant for value 'Needs-action'
     * @return string 'NE'
     */
    const NE = 'NE';

    /**
     * Constant for value 'Accept'
     * @return string 'AC'
     */
    const AC = 'AC';

    /**
     * Constant for value 'Tentative'
     * @return string 'TE'
     */
    const TE = 'TE';

    /**
     * Constant for value 'Declined'
     * @return string 'DE'
     */
    const DE = 'DE';

    /**
     * Constant for value 'delegated'
     * @return string 'DG'
     */
    const DG = 'DG';

    /**
     * Constant for value 'Completed'
     * @return string 'CO'
     */
    const CO = 'CO';

    /**
     * Constant for value 'In-process'
     * @return string 'IN'
     */
    const IN = 'IN';

    /**
     * Constant for value 'Waiting'
     * @return string 'WE'
     */
    const WE = 'WE';

    /**
     * Constant for value 'Deferred'
     * @return string 'DF'
     */
    const DF = 'DF';
}
