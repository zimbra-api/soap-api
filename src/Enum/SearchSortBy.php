<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Enum;

use MyCLabs\Enum\Enum;

/**
 * SearchSortBy enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SearchSortBy extends Enum
{
    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    private const DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    private const DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'idDesc'
     * @return string 'idDesc'
     */
    private const ID_DESC = 'idDesc';

    /**
     * Constant for value 'idAsc'
     * @return string 'idAsc'
     */
    private const ID_ASC = 'idAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    private const SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    private const SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    private const NAME_DESC = 'nameDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    private const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'durDesc'
     * @return string 'durDesc'
     */
    private const DUR_DESC = 'durDesc';

    /**
     * Constant for value 'durAsc'
     * @return string 'durAsc'
     */
    private const DUR_ASC = 'durAsc';

    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    private const NONE = 'none';

    /**
     * Constant for value 'taskDueAsc'
     * @return string 'taskDueAsc'
     */
    private const TASK_DUE_ASC = 'taskDueAsc';

    /**
     * Constant for value 'taskDueDesc'
     * @return string 'taskDueDesc'
     */
    private const TASK_DUE_DESC = 'taskDueDesc';

    /**
     * Constant for value 'taskStatusAsc'
     * @return string 'taskStatusAsc'
     */
    private const TASK_STATUS_ASC = 'taskStatusAsc';

    /**
     * Constant for value 'taskStatusDesc'
     * @return string 'taskStatusDesc'
     */
    private const TASK_STATUS_DESC = 'taskStatusDesc';

    /**
     * Constant for value 'taskPercCompletedAsc'
     * @return string 'taskPercCompletedAsc'
     */
    private const TASK_PERC_COMPLETED_ASC = 'taskPercCompletedAsc';

    /**
     * Constant for value 'taskPercCompletedDesc'
     * @return string 'taskPercCompletedDesc'
     */
    private const TASK_PERC_COMPLETED_DESC = 'taskPercCompletedDesc';

    /**
     * Constant for value 'rcptAsc'
     * @return string 'rcptAsc'
     */
    private const RCPT_ASC = 'rcptAsc';

    /**
     * Constant for value 'rcptDesc'
     * @return string 'rcptDesc'
     */
    private const RCPT_DESC = 'rcptDesc';

    /**
     * Constant for value 'readAsc'
     * @return string 'readAsc'
     */
    private const READ_ASC = 'readAsc';

    /**
     * Constant for value 'readDesc'
     * @return string 'readDesc'
     */
    private const READ_DESC = 'readDesc';
}
