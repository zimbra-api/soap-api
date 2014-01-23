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
 * SortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class SortBy extends Base
{
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    const NONE = 'none';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    const DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    const DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    const SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    const SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'rcptAsc'
     * @return string 'rcptAsc'
     */
    const RCPT_ASC = 'rcptAsc';

    /**
     * Constant for value 'rcptDesc'
     * @return string 'rcptDesc'
     */
    const RCPT_DESC = 'rcptDesc';

    /**
     * Constant for value 'attachAsc'
     * @return string 'attachAsc'
     */
    const ATTACH_ASC = 'attachAsc';

    /**
     * Constant for value 'attachDesc'
     * @return string 'attachDesc'
     */
    const ATTACH_DESC = 'attachDesc';

    /**
     * Constant for value 'flagAsc'
     * @return string 'flagAsc'
     */
    const FLAG_ASC = 'flagAsc';

    /**
     * Constant for value 'flagDesc'
     * @return string 'flagDesc'
     */
    const FLAG_DESC = 'flagDesc';

    /**
     * Constant for value 'priorityAsc'
     * @return string 'priorityAsc'
     */
    const PRIORITY_ASC = 'priorityAsc';

    /**
     * Constant for value 'priorityDesc'
     * @return string 'priorityDesc'
     */
    const PRIORITY_DESC = 'priorityDesc';
}
