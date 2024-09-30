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
 * TaskStatus enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
enum TaskStatus: string
{
    /**
     * Constant for value 'NEED'
     * @return string 'NEED'
     */
    case NEED = "NEED";

    /**
     * Constant for value 'INPR'
     * @return string 'INPR'
     */
    case INPR = "INPR";

    /**
     * Constant for value 'WAITING'
     * @return string 'WAITING'
     */
    case WAITING = "WAITING";

    /**
     * Constant for value 'DEFERRED'
     * @return string 'DEFERRED'
     */
    case DEFERRED = "DEFERRED";

    /**
     * Constant for value 'COMP'
     * @return string 'COMP'
     */
    case COMP = "COMP";
}
