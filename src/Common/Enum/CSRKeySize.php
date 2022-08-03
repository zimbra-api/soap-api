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
 * CSRKeySize enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class CSRKeySize extends Enum
{
    /**
     * Constant for value '1024'
     * @return string '1024'
     */
    protected const SIZE_1024 = 1024;

    /**
     * Constant for value '2048'
     * @return string '2048'
     */
    protected const SIZE_2048 = 2048;
}
