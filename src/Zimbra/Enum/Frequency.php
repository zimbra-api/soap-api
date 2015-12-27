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
 * Frequency enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Frequency extends Base
{
    /**
     * Constant for value 'SEC'
     * @return string 'SEC'
     */
    const SECOND = 'SEC';

    /**
     * Constant for value 'MIN'
     * @return string 'MIN'
     */
    const MINUTE = 'MIN';

    /**
     * Constant for value 'HOU'
     * @return string 'HOU'
     */
    const HOUR = 'HOU';

    /**
     * Constant for value 'DAI'
     * @return string 'DAI'
     */
    const DAY = 'DAI';

    /**
     * Constant for value 'WEE'
     * @return string 'WEE'
     */
    const WEEK = 'WEE';

    /**
     * Constant for value 'MON'
     * @return string 'MON'
     */
    const MONTH = 'MON';

    /**
     * Constant for value 'YEA'
     * @return string 'YEA'
     */
    const YEAR = 'YEA';
}
