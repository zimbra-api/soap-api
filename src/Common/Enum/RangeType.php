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
 * RangeType enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RangeType extends Enum
{
    /**
     * Constant for value 'NONE'
     * @return string 1
     */
    private const NONE = 1;

    /**
     * Constant for value 'THISANDFUTURE'
     * @return string 2
     */
    private const THISANDFUTURE = 2;

    /**
     * Constant for value THISANDPRIOR
     * @return string 3
     */
    private const THISANDPRIOR = 3;
}
