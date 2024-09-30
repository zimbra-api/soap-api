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
 * SortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class SortBy extends Enum
{
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    protected const NONE = "none";

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    protected const DATE_ASC = "dateAsc";

    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    protected const DATE_DESC = "dateDesc";

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    protected const SUBJ_ASC = "subjAsc";

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    protected const SUBJ_DESC = "subjDesc";

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    protected const NAME_ASC = "nameAsc";

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    protected const NAME_DESC = "nameDesc";

    /**
     * Constant for value 'rcptAsc'
     * @return string 'rcptAsc'
     */
    protected const RCPT_ASC = "rcptAsc";

    /**
     * Constant for value 'rcptDesc'
     * @return string 'rcptDesc'
     */
    protected const RCPT_DESC = "rcptDesc";

    /**
     * Constant for value 'attachAsc'
     * @return string 'attachAsc'
     */
    protected const ATTACH_ASC = "attachAsc";

    /**
     * Constant for value 'attachDesc'
     * @return string 'attachDesc'
     */
    protected const ATTACH_DESC = "attachDesc";

    /**
     * Constant for value 'flagAsc'
     * @return string 'flagAsc'
     */
    protected const FLAG_ASC = "flagAsc";

    /**
     * Constant for value 'flagDesc'
     * @return string 'flagDesc'
     */
    protected const FLAG_DESC = "flagDesc";

    /**
     * Constant for value 'priorityAsc'
     * @return string 'priorityAsc'
     */
    protected const PRIORITY_ASC = "priorityAsc";

    /**
     * Constant for value 'priorityDesc'
     * @return string 'priorityDesc'
     */
    protected const PRIORITY_DESC = "priorityDesc";
}
