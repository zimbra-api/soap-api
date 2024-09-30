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
 * WeekDay enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum WeekDay: string
{
    /**
     * Constant for value 'SU'
     * @return string 'SU'
     */
    case SUNDAY = "SU";

    /**
     * Constant for value 'MO'
     * @return string 'MO'
     */
    case MONDAY = "MO";

    /**
     * Constant for value 'TU'
     * @return string 'TU'
     */
    case TUESDAY = "TU";

    /**
     * Constant for value 'WE'
     * @return string 'WE'
     */
    case WEDNESDAY = "WE";

    /**
     * Constant for value 'TH'
     * @return string 'TH'
     */
    case THURSDAY = "TH";

    /**
     * Constant for value 'FR'
     * @return string 'FR'
     */
    case FRIDAY = "FR";

    /**
     * Constant for value 'SA'
     * @return string 'SA'
     */
    case SATURDAY = "SA";
}
