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
 * Importance enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class Importance extends Base
{
    /**
     * Constant for value 'high'
     * @return string 'high'
     */
    const HIGH = 'high';

    /**
     * Constant for value 'normal'
     * @return string 'normal'
     */
    const NORMAL = 'normal';

    /**
     * Constant for value 'low'
     * @return string 'low'
     */
    const LOW = 'low';
}
