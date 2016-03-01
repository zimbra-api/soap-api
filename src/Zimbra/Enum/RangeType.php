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
 * RangeType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class RangeType extends Base
{
    /**
     * Constant for value 'NONE'
     * @return string 1
     */
    const NONE = -1;

    /**
     * Constant for value 'THISANDFUTURE'
     * @return string 2
     */
    const THISANDFUTURE = 2;

    /**
     * Constant for value THISANDPRIOR
     * @return string 3
     */
    const THISANDPRIOR = 3;
}
