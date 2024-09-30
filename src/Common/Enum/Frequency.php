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
 * Frequency enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class Frequency extends Enum
{
    /**
     * Constant for value 'SEC'
     * @return string 'SEC'
     */
    protected const SECOND = "SEC";

    /**
     * Constant for value 'MIN'
     * @return string 'MIN'
     */
    protected const MINUTE = "MIN";

    /**
     * Constant for value 'HOU'
     * @return string 'HOU'
     */
    protected const HOUR = "HOU";

    /**
     * Constant for value 'DAI'
     * @return string 'DAI'
     */
    protected const DAY = "DAI";

    /**
     * Constant for value 'WEE'
     * @return string 'WEE'
     */
    protected const WEEK = "WEE";

    /**
     * Constant for value 'MON'
     * @return string 'MON'
     */
    protected const MONTH = "MON";

    /**
     * Constant for value 'YEA'
     * @return string 'YEA'
     */
    protected const YEAR = "YEA";
}
