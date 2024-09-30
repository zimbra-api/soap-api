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
 * QueueAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum QueueAction: string
{
    /**
     * Constant for value 'hold'
     * @return string 'hold'
     */
    case HOLD = "hold";

    /**
     * Constant for value 'release'
     * @return string 'release'
     */
    case RELEASE = "release";

    /**
     * Constant for value 'delete'
     * @return string 'delete'
     */
    case DELETE = "delete";

    /**
     * Constant for value 'requeue'
     * @return string 'requeue'
     */
    case REQUEUE = "requeue";
}
