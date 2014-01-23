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
 * FilterCondition enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class FilterCondition extends Base
{
    /**
     * Constant for value 'allof'
     * @return string 'allof'
     */
    const ALL_OF = 'allof';

    /**
     * Constant for value 'anyof'
     * @return string 'anyof'
     */
    const ANY_OF = 'anyof';
}
