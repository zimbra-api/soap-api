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
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class SortBy extends Enum
{
    /**
     * Constant for value 'none'
     * @return string 'none'
     */
    private const NONE = 'none';

    /**
     * Constant for value 'dateAsc'
     * @return string 'dateAsc'
     */
    private const DATE_ASC = 'dateAsc';

    /**
     * Constant for value 'dateDesc'
     * @return string 'dateDesc'
     */
    private const DATE_DESC = 'dateDesc';

    /**
     * Constant for value 'subjAsc'
     * @return string 'subjAsc'
     */
    private const SUBJ_ASC = 'subjAsc';

    /**
     * Constant for value 'subjDesc'
     * @return string 'subjDesc'
     */
    private const SUBJ_DESC = 'subjDesc';

    /**
     * Constant for value 'nameAsc'
     * @return string 'nameAsc'
     */
    private const NAME_ASC = 'nameAsc';

    /**
     * Constant for value 'nameDesc'
     * @return string 'nameDesc'
     */
    private const NAME_DESC = 'nameDesc';

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
     * Constant for value 'attachAsc'
     * @return string 'attachAsc'
     */
    private const ATTACH_ASC = 'attachAsc';

    /**
     * Constant for value 'attachDesc'
     * @return string 'attachDesc'
     */
    private const ATTACH_DESC = 'attachDesc';

    /**
     * Constant for value 'flagAsc'
     * @return string 'flagAsc'
     */
    private const FLAG_ASC = 'flagAsc';

    /**
     * Constant for value 'flagDesc'
     * @return string 'flagDesc'
     */
    private const FLAG_DESC = 'flagDesc';

    /**
     * Constant for value 'priorityAsc'
     * @return string 'priorityAsc'
     */
    private const PRIORITY_ASC = 'priorityAsc';

    /**
     * Constant for value 'priorityDesc'
     * @return string 'priorityDesc'
     */
    private const PRIORITY_DESC = 'priorityDesc';
}
