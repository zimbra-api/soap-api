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
 * Frequency enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum Frequency: string
{
    /**
     * Constant for value 'SEC'
     * @return string 'SEC'
     */
    case SECOND = "SEC";

    /**
     * Constant for value 'MIN'
     * @return string 'MIN'
     */
    case MINUTE = "MIN";

    /**
     * Constant for value 'HOU'
     * @return string 'HOU'
     */
    case HOUR = "HOU";

    /**
     * Constant for value 'DAI'
     * @return string 'DAI'
     */
    case DAY = "DAI";

    /**
     * Constant for value 'WEE'
     * @return string 'WEE'
     */
    case WEEK = "WEE";

    /**
     * Constant for value 'MON'
     * @return string 'MON'
     */
    case MONTH = "MON";

    /**
     * Constant for value 'YEA'
     * @return string 'YEA'
     */
    case YEAR = "YEA";
}
