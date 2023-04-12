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
 * SearchSortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum SearchSortBy: string
{
    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    case DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    case DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'idDesc'
     * @return string 'idDesc'
     */
    case ID_DESC = 'idDesc';

    /**
     * Constant for value 'idAsc'
     * @return string 'idAsc'
     */
    case ID_ASC = 'idAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    case SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    case SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    case NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    case NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'durDesc'
     * @return string 'durDesc'
     */
    case DUR_DESC = 'durDesc';

    /**
     * Constant for value 'durAsc'
     * @return string 'durAsc'
     */
    case DUR_ASC = 'durAsc';

    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    case NONE = 'none';

    /**
     * Constant for value 'taskDueAsc'
     * @return string 'taskDueAsc'
     */
    case TASK_DUE_ASC = 'taskDueAsc';

    /**
     * Constant for value 'taskDueDesc'
     * @return string 'taskDueDesc'
     */
    case TASK_DUE_DESC = 'taskDueDesc';

    /**
     * Constant for value 'taskStatusAsc'
     * @return string 'taskStatusAsc'
     */
    case TASK_STATUS_ASC = 'taskStatusAsc';

    /**
     * Constant for value 'taskStatusDesc'
     * @return string 'taskStatusDesc'
     */
    case TASK_STATUS_DESC = 'taskStatusDesc';

    /**
     * Constant for value 'taskPercCompletedAsc'
     * @return string 'taskPercCompletedAsc'
     */
    case TASK_PERC_COMPLETED_ASC = 'taskPercCompletedAsc';

    /**
     * Constant for value 'taskPercCompletedDesc'
     * @return string 'taskPercCompletedDesc'
     */
    case TASK_PERC_COMPLETED_DESC = 'taskPercCompletedDesc';

    /**
     * Constant for value 'rcptAsc'
     * @return string 'rcptAsc'
     */
    case RCPT_ASC = 'rcptAsc';

    /**
     * Constant for value 'rcptDesc'
     * @return string 'rcptDesc'
     */
    case RCPT_DESC = 'rcptDesc';

    /**
     * Constant for value 'readAsc'
     * @return string 'readAsc'
     */
    case READ_ASC = 'readAsc';

    /**
     * Constant for value 'readDesc'
     * @return string 'readDesc'
     */
    case READ_DESC = 'readDesc';

    /**
     * Constant for value 'calTzAsc'
     * @return string 'calTzAsc'
     */
    case CAL_TZ_ASC = 'calTzAsc';

    /**
     * Constant for value 'calTzDesc'
     * @return string 'calTzDesc'
     */
    case CAL_TZ_DESC = 'calTzDesc';

    /**
     * Constant for value 'flagAsc'
     * @return string 'flagAsc'
     */
    case FLAG_ASC = 'flagAsc';

    /**
     * Constant for value 'flagDesc'
     * @return string 'flagDesc'
     */
    case FLAG_DESC = 'flagDesc';

    /**
     * Constant for value 'priorityAsc'
     * @return string 'priorityAsc'
     */
    case PRIORITY_ASC = 'priorityAsc';

    /**
     * Constant for value 'priorityDesc'
     * @return string 'priorityDesc'
     */
    case PRIORITY_DESC = 'priorityDesc';
}
