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
 * SortBy enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum SortBy: string
{
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    case NONE = 'none';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    case DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    case DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    case SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    case SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    case NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    case NAME_DESC = 'nameDesc';

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
     * Constant for value 'attachAsc'
     * @return string 'attachAsc'
     */
    case ATTACH_ASC = 'attachAsc';

    /**
     * Constant for value 'attachDesc'
     * @return string 'attachDesc'
     */
    case ATTACH_DESC = 'attachDesc';

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
