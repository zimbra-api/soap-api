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
 * IpType enum class
 *
 * @package   Zimbra
 * @category  Enum
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class IpType extends Base
{
    /**
     * Constant for value 'ipV4'
     * @return string 'ipV4'
     */
    const IPV4 = 'ipV4';

    /**
     * Constant for value 'ipV6'
     * @return string 'ipV6'
     */
    const IPV6 = 'ipV6';

    /**
     * Constant for value 'both'
     * @return string 'both'
     */
    const BOTH = 'both';
}