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
 * IpType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class IpType extends Enum
{
    /**
     * Constant for value 'ipV4'
     * @return string 'ipV4'
     */
    protected const IPV4 = "ipV4";

    /**
     * Constant for value 'ipV6'
     * @return string 'ipV6'
     */
    protected const IPV6 = "ipV6";

    /**
     * Constant for value 'both'
     * @return string 'both'
     */
    protected const BOTH = "both";
}
