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
 * SearchSortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SearchSortBy extends Enum
{
    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    protected const DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    protected const DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'idDesc'
     * @return string 'idDesc'
     */
    protected const ID_DESC = 'idDesc';

    /**
     * Constant for value 'idAsc'
     * @return string 'idAsc'
     */
    protected const ID_ASC = 'idAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    protected const SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    protected const SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    protected const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    protected const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'durDesc'
     * @return string 'durDesc'
     */
    protected const DUR_DESC = 'durDesc';

    /**
     * Constant for value 'durAsc'
     * @return string 'durAsc'
     */
    protected const DUR_ASC = 'durAsc';

    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    protected const NONE = 'none';

    /**
     * Constant for value 'taskDueAsc'
     * @return string 'taskDueAsc'
     */
    protected const TASK_DUE_ASC = 'taskDueAsc';

    /**
     * Constant for value 'taskDueDesc'
     * @return string 'taskDueDesc'
     */
    protected const TASK_DUE_DESC = 'taskDueDesc';

    /**
     * Constant for value 'taskStatusAsc'
     * @return string 'taskStatusAsc'
     */
    protected const TASK_STATUS_ASC = 'taskStatusAsc';

    /**
     * Constant for value 'taskStatusDesc'
     * @return string 'taskStatusDesc'
     */
    protected const TASK_STATUS_DESC = 'taskStatusDesc';

    /**
     * Constant for value 'taskPercCompletedAsc'
     * @return string 'taskPercCompletedAsc'
     */
    protected const TASK_PERC_COMPLETED_ASC = 'taskPercCompletedAsc';

    /**
     * Constant for value 'taskPercCompletedDesc'
     * @return string 'taskPercCompletedDesc'
     */
    protected const TASK_PERC_COMPLETED_DESC = 'taskPercCompletedDesc';

    /**
     * Constant for value 'rcptAsc'
     * @return string 'rcptAsc'
     */
    protected const RCPT_ASC = 'rcptAsc';

    /**
     * Constant for value 'rcptDesc'
     * @return string 'rcptDesc'
     */
    protected const RCPT_DESC = 'rcptDesc';

    /**
     * Constant for value 'readAsc'
     * @return string 'readAsc'
     */
    protected const READ_ASC = 'readAsc';

    /**
     * Constant for value 'readDesc'
     * @return string 'readDesc'
     */
    protected const READ_DESC = 'readDesc';

    /**
     * Constant for value 'calTzAsc'
     * @return string 'calTzAsc'
     */
    protected const CAL_TZ_ASC = 'calTzAsc';

    /**
     * Constant for value 'calTzDesc'
     * @return string 'calTzDesc'
     */
    protected const CAL_TZ_DESC = 'calTzDesc';

    /**
     * Constant for value 'flagAsc'
     * @return string 'flagAsc'
     */
    protected const FLAG_ASC = 'flagAsc';

    /**
     * Constant for value 'flagDesc'
     * @return string 'flagDesc'
     */
    protected const FLAG_DESC = 'flagDesc';

    /**
     * Constant for value 'priorityAsc'
     * @return string 'priorityAsc'
     */
    protected const PRIORITY_ASC = 'priorityAsc';

    /**
     * Constant for value 'priorityDesc'
     * @return string 'priorityDesc'
     */
    protected const PRIORITY_DESC = 'priorityDesc';
}
